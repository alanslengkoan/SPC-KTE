<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_satuan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Satuan', 'satuan', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_satuan->getAllDataDt();
    }

    // untuk ambil kode satuan
    public function kd_satuan()
    {
        $response = [
            'kd_satuan' => get_kode_urut('tb_satuan', 'kd_satuan', 'KDE-S-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_satuan', ['id_satuan' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);
        
        $data = [
            'kd_satuan' => $post['inpkdsatuan'],
            'nama'      => $post['inpnama'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidsatuan'])) {
            $this->crud->i('tb_satuan', $data);
        } else {
            $this->crud->u('tb_satuan', $data, ['id_satuan' => $post['inpidsatuan']]);
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

        $check = checking_data('si_sc_riskiabadi', 'tb_satuan', 'id_satuan', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_satuan', $post['id'], 'id_satuan');
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
