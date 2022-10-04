<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_penjualan');
        $this->load->model('m_pembayaran');
    }

    // untuk halaman default
    public function index()
    {
        // untuk load view
        $this->template->load('distribusi', 'Pembayaran', 'pembayaran', 'view');
    }

    // untuk halaman pembayaran
    public function add()
    {
        $id_penjualan = base64url_decode($this->uri->segment(4));

        $penjualan = $this->m_penjualan->getWherePembayaranDistribusi($id_penjualan)->row();

        $total_akhir = $penjualan->total;

        $data = [
            'id_penjualan' => $id_penjualan,
            'total_akhir'  => $total_akhir,
            'penjualan'    => $penjualan,
        ];
        // untuk load view
        $this->template->load('distribusi', 'Pembayaran Penjualan', 'pembayaran', 'add', $data);
    }

    // untuk halaman invoice
    public function invoice()
    {
        $id_penjualan = base64url_decode($this->uri->segment(4));

        $data = [
            'id_penjualan' => $id_penjualan,
            'penjualan'    => $this->m_penjualan->getWhereInvoiceDistribusi($id_penjualan)->row(),
        ];
        // untuk load view
        $this->template->load('distribusi', 'Pembayaran Penjualan', 'pembayaran', 'invoice', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        return $this->m_pembayaran->getWhereDataPembayaranDistribusiDt($this->id_users);
    }

    // untuk proses simpan
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $file = add_picture('inpbuktibayar');

        $pembayaran = [
            'no_transaksi'    => $post['inpnotransaksi'],
            'jenis_transaksi' => strtolower($post['inpjenistransaksi']),
            'total_bayar'     => remove_separator($post['inptotalbayar']),
            'bukti_bayar'     => $file['file_name'],
        ];

        $penjualan = [
            'status_pembayaran'  => '1',
            'status_pengantaran' => '2'
        ];

        $pengiriman_detail = [
            'id_pengiriman' => $post['inpidpengiriman'],
            'status'        => '1'
        ];

        $this->db->trans_start();
        // untuk insert pembayaran
        $this->crud->i('tb_pembayaran', $pembayaran);
        // untuk update pembayaran
        $this->crud->u('tb_penjualan', $penjualan, ['id_penjualan' => $post['inpidpenjualan']]);
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
