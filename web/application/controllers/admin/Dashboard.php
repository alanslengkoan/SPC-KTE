<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Dashboard Admin', 'dashboard', 'view');
    }
}
