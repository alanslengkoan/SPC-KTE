<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_penjualan');
        $this->load->model('m_distribusi');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('distribusi', 'Penjualan', 'penjualan', 'view');
    }

    // untuk halaman detail
    public function detail()
    {
        $id_penjualan = base64url_decode($this->uri->segment(4));

        $penjualan  = $this->m_penjualan->getWherepenjualanData($id_penjualan)->row();
        $pembayaran = $this->crud->gda('tb_pembayaran', ['no_transaksi' => $penjualan->no_transaksi]);

        $data = [
            'id_penjualan' => $id_penjualan,
            'penjualan'    => $penjualan,
            'pembayaran'   => $pembayaran,
        ];
        // untuk load view
        $this->template->load('distribusi', 'Detail Penjualan', 'penjualan', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $get_distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $get_penjualan = $this->m_penjualan->getAllDetailData($get_distribusi['id_distribusi']);
        $num_penjualan = $get_penjualan->num_rows();

        $result = [];
        if ($num_penjualan > 0) {
            foreach ($get_penjualan->result() as $key => $value) {
                $result[] = [
                    'id_penjualan'      => $value->id_penjualan,
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
                $total = ((int) $value->jumlah * (int) $value->harga);

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
}
