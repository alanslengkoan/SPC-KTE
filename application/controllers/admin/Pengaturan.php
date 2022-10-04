<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{
    public $users;

    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk mengambil detail user
        $this->users = get_users_detail($this->id);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pengaturan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'data' => $this->m_pengaturan->getFirstRecord(),
        ];
        // untuk load view
        $this->template->load('admin', 'Penngaturan', 'pengaturan', 'view', $data);
    }

    // untuk ubah foto
    public function upd_foto()
    {
        $id_pengaturan = $this->uri->segment('4');

        $_FILES['inpfoto']['name']     = $_FILES['inplogo']['name'][0];
        $_FILES['inpfoto']['type']     = $_FILES['inplogo']['type'][0];
        $_FILES['inpfoto']['tmp_name'] = $_FILES['inplogo']['tmp_name'][0];
        $_FILES['inpfoto']['error']    = $_FILES['inplogo']['error'][0];
        $_FILES['inpfoto']['size']     = $_FILES['inplogo']['size'][0];

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpfoto')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $this->db->trans_start();
            if ($id_pengaturan === null) {
                $data = [
                    'id_pengaturan' => acak_id('tb_pengaturan', 'id_pengaturan'),
                    'logo'          => $detailFile['file_name'],
                ];

                $this->crud->i('tb_pengaturan',
                    $data
                );
            } else {
                $data = [
                    'logo' => $detailFile['file_name'],
                ];

                $this->crud->u('tb_pengaturan', $data, ['id_pengaturan' => $id_pengaturan]);
            }
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

    // untuk update profil
    public function upd_profil()
    {
        $post = $this->input->post(NULL, TRUE);
        $id_pengaturan = $this->uri->segment('4');

        $this->db->trans_start();
        if ($id_pengaturan === null) {
            $data = [
                'id_pengaturan' => acak_id('tb_pengaturan', 'id_pengaturan'),
                'nama'          => $post['inpnama'],
                'email'         => $post['inpemail'],
                'alamat'        => $post['inpalamat'],
                'telepon'       => $post['inptelepon'],
                'facebook'      => $post['inplinkfacebook'],
                'instagram'     => $post['inplinkinstagram'],
                'twitter'       => $post['inplinktwitter'],
                'youtube'       => $post['inplinkyoutube'],
            ];

            $this->crud->i('tb_pengaturan', $data);
        } else {
            $data = [
                'nama'          => $post['inpnama'],
                'email'         => $post['inpemail'],
                'alamat'        => $post['inpalamat'],
                'telepon'       => $post['inptelepon'],
                'facebook'      => $post['inplinkfacebook'],
                'instagram'     => $post['inplinkinstagram'],
                'twitter'       => $post['inplinktwitter'],
                'youtube'       => $post['inplinkyoutube'],
            ];

            $this->crud->u('tb_pengaturan', $data, ['id_pengaturan' => $id_pengaturan]);
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
}
