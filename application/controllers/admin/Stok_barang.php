<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_barang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_komposisi');
        $this->load->model('m_masuk_n_keluar');
    }

    // untuk default
    public function index()
    {
        $data = [
            'barang' => $this->m_barang->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Produksi', 'stok_barang', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_masuk_n_keluar->getAllDataBarangDt('masuk');
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $check = $this->m_komposisi->checkKomposisiStok($post['inpkdbarang']);

        foreach ($check->result() as $key => $value) {
            if ($value->stok_tersedia < $value->stok_bahan_baku) {
                $text[] = "Untuk bahan baku {$value->nama} tidak cukup dengan kondisi Stok {$value->stok_tersedia} !";
            }
        }

        if (!empty($text)) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => implode(', ', $text), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();

            // untuk barang
            $masuk = [
                'no_transaksi'            => null,
                'jenis_transaksi'         => 'masuk',
                'kd_barang_or_bahan_baku' => $post['inpkdbarang'],
                'jumlah'                  => $post['inpstokbarang'],
            ];
            $this->crud->i('tb_barang_masuk_keluar', $masuk);

            // untuk bahan baku
            foreach ($check->result() as $key => $value) {
                $keluar = [
                    'no_transaksi'            => null,
                    'jenis_transaksi'         => 'keluar',
                    'kd_barang_or_bahan_baku' => $value->kd_bahan_baku,
                    'jumlah'                  => $value->stok_bahan_baku,
                ];
                $this->crud->i('tb_barang_masuk_keluar', $keluar);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk mencari barang
    public function check_komposisi()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'barang' => $this->crud->gd('tb_komposisi', ['kd_barang' => $post['id']]),
            'check'  => $this->m_komposisi->checkKomposisiStok($post['id']),
        ];

        $this->load->view('admin/stok_barang/check', $data);
    }
}
