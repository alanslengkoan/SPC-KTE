<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pembelian');
        $this->load->model('m_pembayaran');
    }

    // untuk halaman default
    // public function index()
    // {
     
    // }

    // untuk halaman pembayaran
    public function add()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $pembelian = $this->m_pembelian->getWherePembayaranSupplier($id_pembelian)->row();

        $total_akhir = $pembelian->total;

        $data = [
            'id_pembelian' => $id_pembelian,
            'total_akhir'  => $total_akhir,
            'pembelian'    => $pembelian,
        ];
        // untuk load view
        $this->template->load('admin', 'Pembayaran Pembelian', 'pembayaran', 'add', $data);
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
        $this->template->load('admin', 'Invoice', 'pembayaran', 'invoice', $data);
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

        $pembelian = [
            'status_pembayaran' => '1'
        ];

        $this->db->trans_start();
        // untuk insert pembayaran
        $this->crud->i('tb_pembayaran', $pembayaran);
        // untuk update pembayaran
        $this->crud->u('tb_pembelian', $pembelian, ['id_pembelian' => $post['inpidpembelian']]);
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
