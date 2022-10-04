<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
	{
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['supplier']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_bahan_baku_supplier');
	}

    // untuk default
    public function index()
    {
        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $data = [
            'bahan_baku' => $this->m_bahan_baku_supplier->getWhereSupplier($supplier['id_supplier'])
        ];

        // untuk load view
        $this->template->load('supplier', 'Dashboard Supplier', 'dashboard', 'view', $data);
    }
}
