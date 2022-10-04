<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['supplier']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pembelian');
        $this->load->model('m_pembayaran');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load('supplier', 'Pemesanan', 'pemesanan', 'view');
    }

    // untuk halaman detail
    public function detail()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $pembelian  = $this->m_pembelian->getWherePembelianData($id_pembelian)->row();
        $pembayaran = $this->crud->gda('tb_pembayaran', ['no_transaksi' => $pembelian->no_transaksi]);

        $data = [
            'id_pembelian' => $id_pembelian,
            'pembelian'    => $pembelian,
            'pembayaran'   => $pembayaran,
        ];

        // untuk load view
        $this->template->load('supplier', 'Pemesanan', 'pemesanan', 'detail', $data);
    }

    // untuk get data
    public function get_data_dt()
    {
        $id_users = $this->id_users;
        $get_pemesanan = $this->m_pembelian->getAllDataPembelianSupplier($id_users);
        $num_pembelian = $get_pemesanan->num_rows();

        $result = [];
        if ($num_pembelian > 0) {
            foreach ($get_pemesanan->result() as $key => $value) {
                $result[] = [
                    'id_pembelian'      => $value->id_pembelian,
                    'id_pembayaran'     => $value->id_pembayaran,
                    'no_transaksi'      => $value->no_transaksi,
                    'nama'              => $value->nama,
                    'jumlah_stok'       => $value->jumlah_stok,
                    'status_invoice'    => $value->status_invoice,
                    'status_approve'    => $value->status_approve,
                    'status_pembayaran' => $value->status_pembayaran,
                    'total_akhir'       => (int)  $value->total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk response json
        $this->_response($response);
    }

    // untuk get detail pembelian
    public function get_data_detail_dt()
    {
        $id_pembelian = base64url_decode($this->uri->segment(4));

        $get = $this->m_pembelian->getWherePembelianDetailData($id_pembelian);
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $total = ((int) $value->jumlah * (int) $value->harga);

                $result[] = [
                    'id_pembelian'  => $value->id_pembelian,
                    'kd_bahan_baku' => $value->kd_bahan_baku,
                    'nama'          => $value->nama,
                    'jumlah'        => $value->jumlah,
                    'harga'         => $value->harga,
                    'total'         => $total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk approve transaksi
    public function process_approve()
    {
        $post   = $this->input->post(NULL, TRUE);
        $id     = base64url_decode($post['id']);
        $status = $post['status'];

        $pembelian = [
            'status_approve' => ($status === '0' || $status === '' ? '1' : '0')
        ];

        $this->db->trans_start();
        $this->crud->u('tb_pembelian', $pembelian, ['id_pembelian' => $id]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk invoice transaksi
    public function process_invoice()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_pembelian  = base64url_decode($post['id_pembelian']);
        $id_pembayaran = $post['id_pembayaran'];
        $no_transaksi  = $post['no_transaksi'];
        $status        = $post['status'];

        // untuk ambil pembelian
        $pembelian  = $this->m_pembelian->getWherePembelianData($id_pembelian)->row();
        // untuk ambil detail pembelian
        $get_pembelian_detail = $this->m_pembelian->getWherePembelianDetailData($id_pembelian);

        foreach ($get_pembelian_detail->result() as $key => $value) {
            // untuk simpan riwayat keluar masuk barang
            $this->_insert_in_out_item($no_transaksi, 'pembelian', $value->kd_bahan_baku, $value->jumlah);

            $bahan_baku_supplier[] = [
                'id_supplier'   => $pembelian->id_supplier,
                'jenis'         => 'keluar',
                'kd_bahan_baku' => $value->kd_bahan_baku,
                'jumlah'        => $value->jumlah
            ];
        }

        $this->db->insert_batch('tb_bahan_baku_supplier', $bahan_baku_supplier);

        $pembelian = [
            'status_invoice' => ($status === '0' || $status === '' ? '1' : '0')
        ];

        $transaksi = [
            'id_pembayaran' => $id_pembayaran,
            'no_invoice'    => get_kode_urut('tb_transaksi', 'no_invoice', 'INV-IN-'),
            'no_transaksi'  => $no_transaksi,
        ];

        $this->db->trans_start();
        // untuk update pembelian
        $this->crud->u('tb_pembelian', $pembelian, ['id_pembelian' => $id_pembelian]);
        // untuk insert transaksi
        $this->crud->i('tb_transaksi', $transaksi);
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
