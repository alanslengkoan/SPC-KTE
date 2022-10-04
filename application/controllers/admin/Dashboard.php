<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
	{
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_supplier');
        $this->load->model('m_distribusi');
        $this->load->model('m_barang_distribusi');
        $this->load->model('m_bahan_baku_supplier');
	}

    // untuk default
    public function index()
    {
        $data = [
            'supplier'   => $this->m_supplier->getAll()->num_rows(),
            'distribusi' => $this->m_distribusi->getAll()->num_rows(),
            'barang'     => $this->m_barang_distribusi->getAll(),
            'bahan_baku' => $this->m_bahan_baku_supplier->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Dashboard Admin', 'dashboard', 'view', $data);
    }
}
