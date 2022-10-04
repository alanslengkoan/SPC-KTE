<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
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
        $distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $data = [
            'barang' => $this->m_barang_distribusi->getWhereDistribusi($distribusi['id_distribusi'])
        ];
        // untuk load view
        $this->template->load('distribusi', 'Dashboard Distribusi', 'dashboard', 'view', $data);
    }
}
