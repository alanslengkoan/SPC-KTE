<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_supplier');
        $this->load->model('m_pembelian');
        $this->load->model('m_bahan_baku');
        $this->load->model('m_bahan_baku_supplier');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Pembelian', 'pembelian', 'view');
    }

    // untuk tambah pembelian
    public function add()
    {
        $data = [
            'no_transaksi' => get_kode_urut('tb_pembelian', 'no_transaksi', 'TRANS-IN-'),
            'bahan_baku'   => $this->m_bahan_baku->getAll(),
            'supplier'     => $this->m_supplier->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Pembelian', 'pembelian', 'add', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $data = [
            'id_pembelian' => $id_pembelian,
            'pembelian'    => $this->m_pembelian->getWherePembelianData($id_pembelian)->row(),
        ];
        // untuk load view
        $this->template->load('admin', 'Detail Pembelian', 'pembelian', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $get_pembelian = $this->m_pembelian->getAllData();
        $num_pembelian = $get_pembelian->num_rows();

        $result = [];
        if ($num_pembelian > 0) {
            foreach ($get_pembelian->result() as $key => $value) {
                $result[] = [
                    'id_pembelian'      => $value->id_pembelian,
                    'no_transaksi'      => $value->no_transaksi,
                    'nama'              => $value->nama,
                    'jumlah_stok'       => $value->jumlah_stok,
                    'status_invoice'    => $value->status_invoice,
                    'status_approve'    => $value->status_approve,
                    'status_pembayaran' => $value->status_pembayaran,
                    'total_akhir'       => (int) $value->total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk response json
        $this->_response($response);
    }

    // untuk get detail pembelian
    public function get_data_detail_dt()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $get = $this->m_pembelian->getWherePembelianDetailData($id_pembelian);
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $total = ((int) $value->jumlah * (int) $value->harga);

                $result[] = [
                    'id_pembelian'  => $value->id_pembelian,
                    'kd_bahan_baku' => $value->kd_bahan_baku,
                    'nama'          => $value->nama,
                    'jumlah'        => $value->jumlah,
                    'harga'         => $value->harga,
                    'total'         => $total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $pembelian = [
            'no_transaksi'      => $post['inpnotransaksi'],
            'id_supplier'       => $post['inpidsupplier'],
            'status_approve'    => '0',
            'status_pembayaran' => '0',
            'status_invoice'    => '0',
        ];

        // simpan pembelian
        $this->crud->i('tb_pembelian', $pembelian);
        $id_pembelian = $this->db->insert_id();

        $get_t_pembelian = $this->m_pembelian->getAllDataTemp();
        foreach ($get_t_pembelian->result() as $key => $value) {
            $pembelian_detail[] = [
                'id_pembelian'  => $id_pembelian,
                'kd_bahan_baku' => $value->kd_bahan_baku,
                'jumlah'        => $value->jumlah,
                'harga'         => $value->harga,
            ];
        }
        // simpan pembelian detail
        $this->db->insert_batch('tb_pembelian_detail', $pembelian_detail);
        // hapus temp pembelian detail
        $this->db->truncate('tb_t_pembelian');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $id_pembelian];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk get data temp
    public function get_data_temp_dt()
    {
        $get = $this->m_pembelian->getAllDataTemp();
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $total  = ((int) $value->jumlah * (int) $value->harga);

                $result[] = [
                    'id_t_pembelian' => $value->id_t_pembelian,
                    'kd_bahan_baku'  => $value->kd_bahan_baku,
                    'nama'           => $value->nama,
                    'jumlah'         => $value->jumlah,
                    'harga'          => $value->harga,
                    'total'          => $total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk get data by id
    public function get_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_t_pembelian', ['id_t_pembelian' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_bahan_baku' => $post['inpkdbahanbaku'],
            'jumlah'        => $post['inpjumlah'],
            'harga'         => remove_separator($post['inpharga']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidtpembelian'])) {
            $this->crud->i('tb_t_pembelian', $data);
        } else {
            $this->crud->u('tb_t_pembelian', $data, ['id_t_pembelian' => $post['inpidtpembelian']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data temp
    public function process_del_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_t_pembelian', $post['id'], 'id_t_pembelian');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk mencari barang
    public function search_bahan_baku()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_bahan_baku_supplier->getWhere($post['id_supplier'], $post['id']);

        $response = [
            "id_bahan_baku" => $get->id_bahan_baku,
            "kd_bahan_baku" => $get->kd_bahan_baku,
            "nama"          => $get->nama,
            "harga"         => $get->harga,
            "satuan"        => $get->satuan,
            "jenis"         => $get->jenis,
            "stok"          => (int) ($get->stok_in - $get->stok_out),
        ];
        // untuk response json
        $this->_response($response);
    }
}
