<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_bahan_baku extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis FROM tb_bahan_baku AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhere($kd_bahan_baku)
    {
        $result = $this->db->query("SELECT b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis FROM tb_bahan_baku AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis WHERE b.kd_bahan_baku = '$kd_bahan_baku'")->row();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0 ) AS stok_in, IFNULL( k.stok_out, 0 ) AS stok_out');
        $this->datatables->order_by('b.ins', 'desc');
        $this->datatables->from('tb_bahan_baku AS b');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        $this->datatables->join('stok_in AS m', 'm.kd_barang_or_bahan_baku = b.kd_bahan_baku', 'left');
        $this->datatables->join('stok_out AS k', 'k.kd_barang_or_bahan_baku = b.kd_bahan_baku', 'left');
        return print_r($this->datatables->generate());
    }
}
