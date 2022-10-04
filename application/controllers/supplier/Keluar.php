<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['supplier']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_bahan_baku');
        $this->load->model('m_bahan_baku_supplier');
    }

    // untuk default
    public function index()
    {
        $data = [
            'bahan_baku' => $this->m_bahan_baku->getAll(),
        ];
        // untuk load view
        $this->template->load('supplier', 'Stok bahan baku keluar', 'keluar', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $this->m_bahan_baku_supplier->getAllDataDt($supplier['id_supplier'], 'keluar');
    }
}