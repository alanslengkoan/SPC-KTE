<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basis extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_basis');
        $this->load->model('m_klasifikasi');
    }

    // untuk default
    public function index()
    {
        $data = [
            'klasifikasi' => $this->m_klasifikasi->get_all(),
        ];
        // untuk load view
        $this->template->load('admin', 'Basis Pengetahuan', 'basis', 'view', $data);
    }
}
