<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_baku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_jenis');
        $this->load->model('m_satuan');
        $this->load->model('m_bahan_baku');
    }

    // untuk default
    public function index()
    {
        $data = [
            'satuan'  => $this->m_satuan->getAll(),
            'jenis'   => $this->m_jenis->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Bahan Baku', 'bahan_baku', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_bahan_baku->getAllDataDt();
    }

    // untuk ambil kode barang
    public function kd_bahan_baku()
    {
        $response = [
            'kd_bahan_baku' => get_kode_urut('tb_bahan_baku', 'kd_bahan_baku', 'KDE-BB-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_bahan_baku', ['id_bahan_baku' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_satuan' => $post['inpidsatuan'],
            'id_jenis'  => $post['inpidjenis'],
            'kd_bahan_baku' => $post['inpkdbahanbaku'],
            'nama'      => $post['inpnama'],
            'harga'     => remove_separator($post['inpharga']),
        ];

        $this->db->trans_start();
        if (empty($post['inpidbahanbaku'])) {
            $this->crud->i('tb_bahan_baku', $data);
        } else {
            $this->crud->u('tb_bahan_baku', $data, ['id_bahan_baku' => $post['inpidbahanbaku']]);
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

        $get = $this->crud->gda('tb_bahan_baku', ['id_bahan_baku' => $post['id']]);

        $check = checking_data('si_sc_riskiabadi', 'tb_bahan_baku', 'kd_bahan_baku', $get['kd_bahan_baku']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();
            $this->crud->d('tb_bahan_baku', $post['id'], 'id_bahan_baku');
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
