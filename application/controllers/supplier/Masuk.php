<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masuk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['supplier']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_bahan_baku');
        $this->load->model('m_bahan_baku_supplier');
    }

    // untuk default
    public function index()
    {
        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $data = [
            'id_supplier' => $supplier['id_supplier'],
            'bahan_baku'  => $this->m_bahan_baku->getAll(),
        ];
        // untuk load view
        $this->template->load('supplier', 'Stok bahan baku masuk', 'masuk', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $this->m_bahan_baku_supplier->getAllDataDt($supplier['id_supplier'], 'masuk');
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $supplier = $this->crud->gda('tb_supplier', ['id_users' => $this->id_users]);

        $data = [
            'id_supplier'   => $supplier['id_supplier'],
            'kd_bahan_baku' => $post['inpkdbahanbaku'],
            'jumlah'        => $post['inpjumlah'],
            'jenis'         => 'masuk',
        ];

        $this->db->trans_start();
        $this->crud->i('tb_bahan_baku_supplier', $data);
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
    public function search_bahan_baku()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_bahan_baku_supplier->getWhere($post['id_supplier'], $post['id']);

        $response = [
            "id_bahan_baku" => $get->id_bahan_baku,
            "kd_bahan_baku" => $get->kd_bahan_baku,
            "nama"          => $get->nama,
            "harga"         => $get->harga,
            "satuan"        => $get->satuan,
            "jenis"         => $get->jenis,
            "stok"          => (int) ($get->stok_in - $get->stok_out),
        ];
        // untuk response json
        $this->_response($response);
    }
}