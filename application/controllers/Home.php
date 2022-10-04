<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_distribusi');
    }

    public function index()
    {
        $data = [
            'title'   => 'Home',
            'content'   => 'home/home/view',
            'css'       => '',
            'js'        => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function tentang()
    {
        $data = [
            'title' => 'Tentang Kami',
            'content' => 'home/tentang/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak Kami',
            'content' => 'home/kontak/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function distributor()
    {
        $data = [
            'title'   => 'Distribusi Kami',
            'data'    => $this->m_distribusi->getAll(),
            'content' => 'home/distribusi/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }
}
