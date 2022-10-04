<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_distribusi');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Distribusi', 'distribusi', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_distribusi->getAllDataDt();
    }

    // untuk ambil kode distribusi
    public function kd_distribusi()
    {
        $response = [
            'kd_distribusi' => get_kode_urut('tb_distribusi', 'kd_distribusi', 'KDE-DIS-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->m_distribusi->getWhere($post['id'])->row();
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $distribusi = [
            'kd_distribusi' => $post['inpkddistribusi'],
            'kd_pos'        => $post['inpkdpos'],
            'npwp'          => $post['inpnpwp'],
            'fax'           => $post['inpfax'],
            'telepon'       => $post['inptelepon'],
            'alamat'        => $post['inpalamat'],
        ];

        $this->db->trans_start();
        if (empty($post['inpiddistribusi'])) {
            $distribusi['id_users'] = acak_id('users', 'id_users');

            $users = [
                'id_users' => $distribusi['id_users'],
                'nama'     => $post['inpnama'],
                'email'    => $post['inpemail'],
                'username' => create_character(5),
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'roles'    => 'distribusi',
            ];
            // insert tabel users
            $this->crud->i('users', $users);
            // insert tabel dsitribusi
            $this->crud->i('tb_distribusi', $distribusi);
        } else {
            $users = [
                'nama'  => $post['inpnama'],
                'email' => $post['inpemail'],
            ];
            // update tabel users
            $this->crud->u('users', $users, ['id_users' => $post['inpidusers']]);
            // update tabel distribusi
            $this->crud->u('tb_distribusi', $distribusi, ['id_users' => $post['inpidusers'], 'id_distribusi' => $post['inpiddistribusi']]);
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

        $check = checking_data('si_sc_riskiabadi', 'tb_distribusi', 'id_distribusi', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_distribusi', $post['id'], 'id_distribusi');
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
