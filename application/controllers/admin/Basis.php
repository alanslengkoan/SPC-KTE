<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basis extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_basis');
        $this->load->model('m_klasifikasi');
    }

    // untuk default
    public function index()
    {
        $data = [
            'klasifikasi' => $this->m_klasifikasi->get_all(),
        ];
        // untuk load view
        $this->template->load('admin', 'Basis Pengetahuan', 'basis', 'view', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $this->m_basis->get_all_data_dt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('basis', ['id_basis' => $post['id']]);

        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['id_basis'])) {
            // untuk tambah
            $image = add_picture('image');

            if ($image['status']) {
                $image_loc = upload_path('gambar') . $image['data']['file_name'];

                $this->imagesampler->image($image_loc);
                $this->imagesampler->set_steps(1);
                $this->imagesampler->init();
                $rgb = $this->imagesampler->sample();

                $data = [
                    'id_klasifikasi' => $post['id_klasifikasi'],
                    'image'          => $image['data']['file_name'],
                    'r'              => $rgb[0][0][0],
                    'g'              => $rgb[0][0][1],
                    'b'              => $rgb[0][0][2],
                ];

                $this->db->trans_start();
                $this->crud->i('basis', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            } else {
                $response = ['title' => 'Gagal!', 'text' => $image['message'], 'type' => 'error', 'button' => 'Ok!'];
            }
        } else {
            // untuk ubah
            if (isset($post['ubah_gambar']) && $post['ubah_gambar'] === 'on') {
                $get = $this->crud->gda('basis', ['id_basis' => $post['id_basis']]);

                del_picture($get['image']);

                $image = add_picture('image');

                if ($image['status']) {
                    $image_loc = upload_path('gambar') . $image['data']['file_name'];

                    $this->imagesampler->image($image_loc);
                    $this->imagesampler->set_steps(1);
                    $this->imagesampler->init();
                    $rgb = $this->imagesampler->sample();

                    $data = [
                        'id_klasifikasi' => $post['id_klasifikasi'],
                        'image'          => $image['data']['file_name'],
                        'r'              => $rgb[0][0][0],
                        'g'              => $rgb[0][0][1],
                        'b'              => $rgb[0][0][2],
                    ];

                    $this->db->trans_start();
                    $this->crud->u('basis', $data, ['id_basis' => $post['id_basis']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                } else {
                    $response = ['title' => 'Gagal!', 'text' => $image['message'], 'type' => 'error', 'button' => 'Ok!'];
                }
            } else {
                $data = [
                    'id_klasifikasi' => $post['id_klasifikasi'],
                ];
                $this->db->trans_start();
                $this->crud->u('basis', $data, ['id_basis' => $post['id_basis']]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        }
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->crud->gda('basis', ['id_basis' => $post['id']]);

        $check = checking_data('spc_kualitastelur', 'basis', 'id_basis', $post['id']);

        if ($check > 0) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf data yang Anda hapus masih digunakan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $this->db->trans_start();

            del_picture($get['image']);

            $this->crud->d('basis', $post['id'], 'id_basis');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }

        $this->_response($response);
    }
}
