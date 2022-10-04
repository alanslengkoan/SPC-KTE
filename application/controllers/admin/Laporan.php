<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_supplier');
        $this->load->model('m_distribusi');
    }

    // untuk laporan barang
    public function barang()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Barang', 'laporan/barang', 'view');
    }

    public function barang_pdf()
    {
        $data = [
            'barang' => $this->m_barang->getAll(),
        ];
        
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian', 'admin/laporan/barang/pdf', $data);
    }

    // untuk ambil data barang
    public function get_data_barang_dt()
    {
        $this->m_barang->getAllDataDt();
    }

    // untuk laporan supplier
    public function supplier()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Supplier', 'laporan/supplier', 'view');
    }

    // untuk ambil data supplier
    public function get_data_supplier_dt()
    {
        $this->m_supplier->getAllDataDt();
    }

    // untuk laporan distribusi
    public function distribusi()
    {
        // untuk load view
        $this->template->load('admin', 'Laporan Distribusi', 'laporan/distribusi', 'view');
    }

    // untuk ambil data distribusi
    public function get_data_distribusi_dt()
    {
        $this->m_distribusi->getAllDataDt();
    }
}
