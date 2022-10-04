<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_bahan_baku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_bahan_baku');
        $this->load->model('m_masuk_n_keluar');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Stok Bahan Baku Keluar', 'stok_bahan_baku', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_masuk_n_keluar->getAllDataBahanBakuDt('keluar');
    }
}