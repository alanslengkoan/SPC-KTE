<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_distribusi');
        $this->load->model('m_penjualan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Penjualan', 'penjualan', 'view');
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
        $this->template->load('admin', 'Detail Penjualan', 'penjualan', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $get_penjualan = $this->m_penjualan->getAllData();
        $num_penjualan = $get_penjualan->num_rows();

        $result = [];
        if ($num_penjualan > 0) {
            foreach ($get_penjualan->result() as $key => $value) {
                $result[] = [
                    'id_penjualan'      => $value->id_penjualan,
                    'id_pengiriman'     => $value->id_pengiriman,
                    'id_pembayaran'     => $value->id_pembayaran,
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

    // untuk get detail penjualan
    public function get_data_detail_dt()
    {
        $id_penjualan = base64url_decode($this->uri->segment(4));

        $get = $this->m_penjualan->getWherePenjualanDetailData($id_penjualan);
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $total  = ((int) $value->jumlah * (int) $value->harga);

                $result[] = [
                    'id_penjualan' => $value->id_penjualan,
                    'kd_barang'    => $value->kd_barang,
                    'nama'         => $value->nama,
                    'jumlah'       => $value->jumlah,
                    'harga'        => $value->harga,
                    'total'        => $total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk approve transaksi
    public function process_approve()
    {
        $post   = $this->input->post(NULL, TRUE);

        $id_penjualan = base64url_decode($post['id_penjualan']);
        $no_transaksi = $post['no_transaksi'];
        $status       = $post['status'];

        $penjualan = [
            'status_approve'     => ($status === '0' || $status === '' ? '1' : '0'),
            'status_pengantaran' => '1'
        ];

        $pengiriman = [
            'no_transaksi' => $no_transaksi,
            'no_resi'      => acak_id('tb_pengiriman', 'no_resi')
        ];

        $this->db->trans_start();
        // untuk update penjualan
        $this->crud->u('tb_penjualan', $penjualan, ['id_penjualan' => $id_penjualan]);
        // untuk insert pengiriman
        $this->crud->i('tb_pengiriman', $pengiriman);
        $id_pengiriman = $this->db->insert_id();
        // untuk pengiriman detail
        $pengiriman_detail = [
            'id_pengiriman' => $id_pengiriman,
            'status'        => '0'
        ];
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

    // untuk invoice transaksi
    public function process_invoice()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_penjualan  = base64url_decode($post['id_penjualan']);
        $id_pembayaran = $post['id_pembayaran'];
        $id_pengiriman = $post['id_pengiriman'];
        $no_transaksi  = $post['no_transaksi'];
        $status        = $post['status'];

        // untuk ambil penjualan
        $penjualan = $this->m_penjualan->getWherePenjualanData($id_penjualan)->row();
        // untuk ambil detail penjualan
        $get_penjualan_detail = $this->m_penjualan->getWherePenjualanDetailData($id_penjualan);
        foreach ($get_penjualan_detail->result() as $key => $value) {
            // untuk simpan riwayat keluar masuk barang
            $this->_insert_in_out_item($no_transaksi, 'penjualan', $value->kd_barang, $value->jumlah);

            $barang_distribusi[] = [
                'id_distribusi' => $penjualan->id_distribusi,
                'jenis'         => 'masuk',
                'kd_barang'     => $value->kd_barang,
                'jumlah'        => $value->jumlah
            ];
        }

        $this->db->insert_batch('tb_barang_distribusi', $barang_distribusi);

        $penjualan = [
            'status_invoice'     => ($status === '0' || $status === '' ? '1' : '0'),
            'status_pengantaran' => '3'
        ];

        $transaksi = [
            'id_pembayaran' => $id_pembayaran,
            'no_invoice'    => get_kode_urut('tb_transaksi', 'no_invoice', 'INV-IN-'),
            'no_transaksi'  => $no_transaksi,
        ];

        $pengiriman_detail = [
            'id_pengiriman' => $id_pengiriman,
            'status'        => '2'
        ];

        $this->db->trans_start();
        // untuk update penjualan
        $this->crud->u('tb_penjualan', $penjualan, ['id_penjualan' => $id_penjualan]);
        // untuk insert transaksi
        $this->crud->i('tb_transaksi', $transaksi);
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
}
