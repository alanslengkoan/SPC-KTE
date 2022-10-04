<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['distribusi']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_barang_distribusi');
    }

    // untuk default
    public function index()
    {
        $distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $data = [
            'id_distribusi' => $distribusi['id_distribusi'],
            'barang'        => $this->m_barang->getAll(),
        ];
        // untuk load view
        $this->template->load('distribusi', 'Stok Barang Keluar', 'keluar', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $this->m_barang_distribusi->getAllDataDt($distribusi['id_distribusi'], 'keluar');
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $distribusi = $this->crud->gda('tb_distribusi', ['id_users' => $this->id_users]);

        $data = [
            'id_distribusi' => $distribusi['id_distribusi'],
            'kd_barang'     => $post['inpkdbarang'],
            'jumlah'        => $post['inpjumlah'],
            'jenis'         => 'keluar',
        ];

        $this->db->trans_start();
        $this->crud->i('tb_barang_distribusi', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk mencari barang
    public function search_barang()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_barang_distribusi->getWhere($post['id_distribusi'], $post['id']);

        $response = [
            "id_barang" => $get->id_barang,
            "kd_barang" => $get->kd_barang,
            "nama"      => $get->nama,
            "harga"     => $get->harga,
            "satuan"    => $get->satuan,
            "jenis"     => $get->jenis,
            "stok"      => (int) ($get->stok_in - $get->stok_out),
        ];
        // untuk response json
        $this->_response($response);
    }
}