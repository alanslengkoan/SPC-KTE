<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('m_pengiriman');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('distribusi', 'Pengiriman', 'pengiriman', 'view');
    }

    public function detail()
    {
        $id_pengiriman = base64url_decode($this->uri->segment(4));

        $data = [
            'pengiriman' => $this->m_pengiriman->getWherePengirimanDetail($id_pengiriman),
        ];
        // untuk load view
        $this->template->load('distribusi', 'Detail Pengiriman', 'pengiriman', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        return $this->m_pengiriman->getWhereDataPengirimanDistribusiDt($this->id_users);
    }
}