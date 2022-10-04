<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in AS m ON m.kd_barang_or_bahan_baku = b.kd_barang LEFT JOIN stok_out AS k ON k.kd_barang_or_bahan_baku = b.kd_barang ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhere($kd_barang)
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in AS m ON m.kd_barang_or_bahan_baku = b.kd_barang LEFT JOIN stok_out AS k ON k.kd_barang_or_bahan_baku = b.kd_barang WHERE b.kd_barang = '$kd_barang'")->row();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0 ) AS stok_in, IFNULL( k.stok_out, 0 ) AS stok_out');
        $this->datatables->order_by('b.ins', 'desc');
        $this->datatables->from('tb_barang AS b');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        $this->datatables->join('stok_in AS m', 'm.kd_barang_or_bahan_baku = b.kd_barang', 'left');
        $this->datatables->join('stok_out AS k', 'k.kd_barang_or_bahan_baku = b.kd_barang', 'left');
        return print_r($this->datatables->generate());
    }
}
