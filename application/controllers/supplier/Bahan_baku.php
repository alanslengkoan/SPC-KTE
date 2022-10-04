<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_baku extends MY_Controller
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
        // untuk load view
        $this->template->load('supplier', 'Bahan Baku', 'bahan_baku', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $this->m_bahan_baku_supplier->getAllDataSupplierDt($supplier['id_supplier']);
    }
}
