<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['supplier']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pembelian');
        $this->load->model('m_pembayaran');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('supplier', 'Pembayaran', 'pembayaran', 'view');
    }

    // untuk halaman invoice
    public function invoice()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $data = [
            'id_pembelian' => $id_pembelian,
            'pembelian'    => $this->m_pembelian->getWhereInvoiceSupplier($id_pembelian)->row(),
        ];
        // untuk load view
        $this->template->load('supplier', 'Invoice', 'pembayaran', 'invoice', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        return $this->m_pembayaran->getWhereDataPembayaranSupplierDt($this->id_users);
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
}