<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang_distribusi');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('distribusi', 'Barang', 'barang', 'view');
    }

    // untuk get datas
    public function get_data_dt()
    {
        $distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $this->m_barang_distribusi->getAllDataDistribusiDt($distribusi['id_distribusi']);
    }
}
