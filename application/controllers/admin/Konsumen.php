<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_users');
        $this->load->model('m_konsumen');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Konsumen', 'konsumen', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_konsumen->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_konsumen', ['id_konsumen' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }
}
