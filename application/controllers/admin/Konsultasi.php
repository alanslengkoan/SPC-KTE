<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_basis');
        $this->load->model('m_konsultasi');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Konsultasi', 'konsultasi', 'view');
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_konsultasi->get_all_data_dt();
    }

    // untuk proses
    public function process()
    {
        $image = add_picture('image');

        if ($image['status']) {

            $data = [
                'image' => $image['data']['file_name'],
            ];

            $this->db->trans_start();
            $this->crud->i('konsultasi', $data);
            $id = $this->db->insert_id();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $id];
            }
        } else {
            $response = ['title' => 'Gagal!', 'text' => $image['message'], 'type' => 'error', 'button' => 'Ok!'];
        }
        $this->_response($response);
    }

    // untuk proses algoritma
    public function results($id)
    {
        $get_konsultasi = $this->crud->gda('konsultasi', ['id_konsultasi' => $id]);
        $get_basis      = $this->m_basis->get_all();
        $image_loc      = upload_path('gambar') . $get_konsultasi['image'];

        $this->imagesampler->image($image_loc);
        $this->imagesampler->set_steps(1);
        $this->imagesampler->init();

        $rgb   = $this->imagesampler->sample();
        $objek = $rgb[0][0];

        $result = [];
        $sort   = [];
        $basis  = [];
        foreach ($get_basis->result_array() as $key => $value) {
            $hitung = sqrt(pow($objek[0] - $value['r'], 2) + pow($objek[1] - $value['g'], 2) + pow($objek[2] - $value['b'], 2));

            $basis[$value['id_basis']] = $value;
            $result[$value['id_basis']] = $hitung;
            $sort[$value['id_basis']] = $hitung;
        }

        $konsultasi = [
            'image' => $get_konsultasi['image'],
            'r'     => $objek[0],
            'g'     => $objek[1],
            'b'     => $objek[2],
        ];

        uasort($sort, function ($a, $b) {
            return $a - $b;
        });

        $data = [
            'basis'      => $basis,
            'result'     => $result,
            'sort'       => $sort,
            'konsultasi' => $konsultasi,
        ];

        // untuk load view
        $this->template->load('admin', 'Hasil Konsultasi', 'konsultasi', 'result', $data);
    }
}
