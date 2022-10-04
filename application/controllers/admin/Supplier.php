<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_supplier');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Supplier', 'supplier', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_supplier->getAllDataDt();
    }

    // untuk ambil kode supplier
    public function kd_supplier()
    {
        $response = [
            'kd_supplier' => get_kode_urut('tb_supplier', 'kd_supplier', 'KDE-SU-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->m_supplier->getWhere($post['id'])->row();
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $supplier = [
            'kd_supplier' => $post['inpkdsupplier'],
            'kd_pos'      => $post['inpkdpos'],
            'npwp'        => $post['inpnpwp'],
            'fax'         => $post['inpfax'],
            'telepon'     => $post['inptelepon'],
            'alamat'      => $post['inpalamat'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidsupplier'])) {
            $supplier['id_users'] = acak_id('tb_users', 'id_users');

            $users = [
                'id_users' => $supplier['id_users'],
                'nama'     => $post['inpnama'],
                'email'    => $post['inpemail'],
                'username' => create_character(5),
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'roles'    => 'supplier',
            ];
            // insert tabel users
            $this->crud->i('tb_users', $users);
            // insert tabel supplier
            $this->crud->i('tb_supplier', $supplier);
        } else {
            $users = [
                'nama'  => $post['inpnama'],
                'email' => $post['inpemail'],
            ];
            // update tabel users
            $this->crud->u('tb_users', $users, ['id_users' => $post['inpidusers']]);
            // update tabel supplier
            $this->crud->u('tb_supplier', $supplier, ['id_users' => $post['inpidusers'], 'id_supplier' => $post['inpidsupplier']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $check = checking_data('si_sc_riskiabadi', 'tb_supplier', 'id_supplier', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_supplier', $post['id'], 'id_supplier');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }
}
