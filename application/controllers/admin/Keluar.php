<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_masuk_n_keluar');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Barang Keluar', 'keluar', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        return $this->m_masuk_n_keluar->getAllDataBarangDt('penjualan');
    }
}
