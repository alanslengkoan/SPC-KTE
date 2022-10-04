<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_penjualan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('distribusi', 'Pembelian', 'pembelian', 'view');
    }

    public function add()
    {
        $data = [
            'no_transaksi' => get_kode_urut('tb_penjualan', 'no_transaksi', 'TRANS-OUT-'),
            'barang'       => $this->m_barang->getAll(),
        ];
        // untuk load view
        $this->template->load('distribusi', 'Pembelian', 'pembelian', 'add', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_penjualan = base64url_decode($this->uri->segment(4));

        $penjualan  = $this->m_penjualan->getWherePenjualanData($id_penjualan)->row();
        $pembayaran = $this->crud->gda('tb_pembayaran', ['no_transaksi' => $penjualan->no_transaksi]);

        $data = [
            'id_penjualan' => $id_penjualan,
            'penjualan'    => $penjualan,
            'pembayaran'   => $pembayaran,
        ];
        // untuk load view
        $this->template->load('distribusi', 'Detail Pembelian', 'pembelian', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $get_pembelian = $this->m_penjualan->getAllDataPembelianDistribusi($this->id_users);
        $num_pembelian = $get_pembelian->num_rows();

        $result = [];
        if ($num_pembelian > 0) {
            foreach ($get_pembelian->result() as $key => $value) {
                $result[] = [
                    'id_penjualan'       => $value->id_penjualan,
                    'id_pengiriman'      => $value->id_pengiriman,
                    'no_transaksi'       => $value->no_transaksi,
                    'nama'               => $value->nama,
                    'jumlah_stok'        => $value->jumlah_stok,
                    'status_invoice'     => $value->status_invoice,
                    'status_approve'     => $value->status_approve,
                    'status_pembayaran'  => $value->status_pembayaran,
                    'status_pengantaran' => $value->status_pengantaran,
                    'total_akhir'        => (int) $value->total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk response json
        $this->_response($response);
    }

    public function setor()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_pengiriman = base64url_decode($post['id_pengiriman']);
        $id_penjualan  = base64url_decode($post['id_penjualan']);

        $penjualan = [
            'status_pengantaran' => '4'
        ];

        $pengiriman_detail = [
            'id_pengiriman' => $id_pengiriman,
            'status'        => '3'
        ];

        $this->db->trans_start();
        // untuk update penjualan
        $this->crud->u('tb_penjualan', $penjualan, ['id_penjualan' => $id_penjualan]);
        // untuk insert pengiriman detail
        $this->crud->i('tb_pengiriman_detail', $pengiriman_detail);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $distribusi = $this->crud->gd('tb_distribusi', ['id_users' => $this->id_users]);

        $this->db->trans_start();
        $penjualan = [
            'no_transaksi'       => $post['inpnotransaksi'],
            'id_distribusi'      => $distribusi->id_distribusi,
            'status_approve'     => '0',
            'status_pembayaran'  => '0',
            'status_pengantaran' => '0',
            'status_invoice'     => '0',
        ];

        $this->crud->i('tb_penjualan', $penjualan);
        $id_penjualan = $this->db->insert_id();


        $get_t_penjualan = $this->m_penjualan->getAllDataTemp();
        foreach ($get_t_penjualan->result() as $key => $value) {
            $penjualan_detail[] = [
                'id_penjualan' => $id_penjualan,
                'kd_barang'    => $value->kd_barang,
                'jumlah'       => $value->jumlah,
                'harga'        => $value->harga,
            ];
        }
        // simpan penjualan detail
        $this->db->insert_batch('tb_penjualan_detail', $penjualan_detail);
        // hapus temp penjualan detail
        $this->db->truncate('tb_t_penjualan');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $id_penjualan];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk get data temp
    public function get_data_temp_dt()
    {
        $get = $this->m_penjualan->getAllDataTemp();
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $total = ((int) $value->jumlah * (int) $value->harga);

                $result[] = [
                    'id_t_penjualan' => $value->id_t_penjualan,
                    'kd_barang'      => $value->kd_barang,
                    'nama'           => $value->nama,
                    'satuan'         => $value->satuan,
                    'jenis'          => $value->jenis,
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

        $response = $this->crud->gda('tb_t_penjualan', ['id_t_penjualan' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_barang' => $post['inpkdbarang'],
            'jumlah'    => $post['inpjumlah'],
            'harga'     => remove_separator($post['inpharga']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidtpenjualan'])) {
            $this->crud->i('tb_t_penjualan', $data);
        } else {
            $this->crud->u('tb_t_penjualan', $data, ['id_t_penjualan' => $post['inpidtpenjualan']]);
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
        $this->crud->d('tb_t_penjualan', $post['id'], 'id_t_penjualan');
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
    public function search_barang()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_barang->getWhere($post['id']);
        
        $response = [
            "id_barang" => $get->id_barang,
            "kd_barang" => $get->kd_barang,
            "nama"      => $get->nama,
            "harga"     => $get->harga,
            "satuan"    => $get->satuan,
            "jenis"     => $get->jenis,
            "stok"      => (int) ($get->stok_in - $get->stok_out),
        ];
        // untuk response json
        $this->_response($response);
    }
}