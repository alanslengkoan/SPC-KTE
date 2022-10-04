<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komposisi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_barang');
        $this->load->model('m_komposisi');
        $this->load->model('m_bahan_baku');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('admin', 'Komposisi', 'komposisi', 'view');
    }

    // untuk tambah komposisi
    public function add()
    {
        $data = [
            'barang'     => $this->m_barang->getAll(),
            'bahan_baku' => $this->m_bahan_baku->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Komposisi', 'komposisi', 'add', $data);
    }

    // untuk tambah komposisi
    public function upd()
    {
        $id_komposisi = base64url_decode($this->uri->segment(4));

        $data = [
            'id_komposisi' => $id_komposisi,
            'komposisi'    => $this->m_komposisi->getWhereKomposisiData($id_komposisi)->row(),
            'barang'       => $this->m_barang->getAll(),
            'bahan_baku'   => $this->m_bahan_baku->getAll(),
        ];
        // untuk load view
        $this->template->load('admin', 'Ubah Komposisi', 'komposisi', 'upd', $data);
    }

    // untuk halaman detail
    public function detail()
    {
        $id_komposisi = base64url_decode($this->uri->segment(4));

        $data = [
            'id_komposisi' => $id_komposisi,
            'komposisi'    => $this->m_komposisi->getWhereKomposisiData($id_komposisi)->row(),
        ];
        // untuk load view
        $this->template->load('admin', 'Detail Komposisi', 'komposisi', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $get_komposisi = $this->m_komposisi->getAllData();
        $num_komposisi = $get_komposisi->num_rows();

        $result = [];
        if ($num_komposisi > 0) {
            foreach ($get_komposisi->result() as $key => $value) {
                $result[] = [
                    'id_komposisi' => $value->id_komposisi,
                    'kd_barang'    => $value->kd_barang,
                    'nama'         => $value->nama,
                    'stok_barang'  => $value->stok_barang,
                ];
            }
        }
        $response = ['data' => $result];
        // untuk response json
        $this->_response($response);
    }

    // untuk get detail komposisi
    public function get_data_detail_dt()
    {
        $id_komposisi = base64url_decode($this->uri->segment(4));

        $get = $this->m_komposisi->getWhereKomposisiDetailData($id_komposisi);
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $result[] = [
                    'id_komposisi_detail' => $value->id_komposisi_detail,
                    'kd_bahan_baku'       => $value->kd_bahan_baku,
                    'bahan_baku'          => $value->bahan_baku,
                    'jenis'               => $value->jenis,
                    'satuan'              => $value->satuan,
                    'stok'                => $value->stok_bahan_baku
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk get data by id
    public function get_det()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_komposisi_detail', ['id_komposisi_detail' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_det()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_komposisi'    => $post['inpidkomposisi'],
            'kd_bahan_baku'   => $post['inpkdbahanbaku'],
            'stok_bahan_baku' => $post['inpstokbahanbaku'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidkomposisidetail'])) {
            $this->crud->i('tb_komposisi_detail', $data);
        } else {
            $this->crud->u('tb_komposisi_detail', $data, ['id_komposisi_detail' => $post['inpidkomposisidetail']]);
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

    // untuk proses hapus data temp
    public function process_del_det()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_komposisi_detail', $post['id'], 'id_komposisi_detail');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $komposisi = [
            'kd_barang'   => $post['inpkdbarang'],
            'stok_barang' => $post['inpstokbarang'],
        ];

        if (empty($post['inpidkomposisi'])) {
            // tambah
            $check = $this->crud->gda('tb_komposisi', ['kd_barang' => $post['inpkdbarang']]);

            if ($check === null) {
                $this->db->trans_start();
                // simpan komposisi
                $this->crud->i('tb_komposisi', $komposisi);
                $id_komposisi = $this->db->insert_id();

                $get_t_komposisi = $this->m_komposisi->getAllDataTemp();
                foreach ($get_t_komposisi->result() as $key => $value) {
                    $komposisi_detail[] = [
                        'id_komposisi'    => $id_komposisi,
                        'kd_bahan_baku'   => $value->kd_bahan_baku,
                        'stok_bahan_baku' => $value->stok_bahan_baku,
                    ];
                }
                // simpan komposisi detail
                $this->db->insert_batch('tb_komposisi_detail', $komposisi_detail);
                // hapus temp komposisi detail
                $this->db->truncate('tb_t_komposisi');
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $id_komposisi];
                }
            } else {
                $response = ['title' => 'Gagal!', 'text' => 'Kode Barang Sudah Ada!', 'type' => 'error', 'button' => 'Ok!'];
            }
        } else {
            // ubah
            $this->db->trans_start();
            $this->crud->u('tb_komposisi', $komposisi, ['id_komposisi' => $post['inpidkomposisi']]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }

        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_komposisi', base64url_decode($post['id']) , 'id_komposisi');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk get data temp
    public function get_data_temp_dt()
    {
        $get = $this->m_komposisi->getAllDataTemp();
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $result[] = [
                    'id_t_komposisi' => $value->id_t_komposisi,
                    'kd_bahan_baku'  => $value->kd_bahan_baku,
                    'bahan_baku'     => $value->bahan_baku,
                    'jenis'          => $value->jenis,
                    'satuan'         => $value->satuan,
                    'stok'           => $value->stok_bahan_baku
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk get data by id
    public function get_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_t_komposisi', ['id_t_komposisi' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_bahan_baku'   => $post['inpkdbahanbaku'],
            'stok_bahan_baku' => $post['inpstokbahanbaku'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidtkomposisi'])) {
            $this->crud->i('tb_t_komposisi', $data);
        } else {
            $this->crud->u('tb_t_komposisi', $data, ['id_t_komposisi' => $post['inpidtkomposisi']]);
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

    // untuk proses hapus data temp
    public function process_del_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_t_komposisi', $post['id'], 'id_t_komposisi');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}