<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_barang_distribusi extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in_distribusi AS m ON m.kd_barang = b.kd_barang LEFT JOIN stok_out_distribusi AS k ON k.kd_barang = b.kd_barang ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhereDistribusi($id_distribusi)
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in_distribusi AS m ON m.kd_barang = b.kd_barang LEFT JOIN stok_out_distribusi AS k ON k.kd_barang = b.kd_barang WHERE m.id_distribusi = '$id_distribusi' OR k.id_distribusi = '$id_distribusi' ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhere($id_distribusi, $kd_barang)
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL(( SELECT stok_in FROM stok_in_distribusi AS m WHERE m.id_distribusi = '$id_distribusi' AND m.kd_barang = '$kd_barang'), 0) AS stok_in, IFNULL(( SELECT stok_out FROM stok_out_distribusi AS m WHERE m.id_distribusi = '$id_distribusi' AND m.kd_barang = '$kd_barang'), 0) AS stok_out FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis WHERE b.kd_barang = '$kd_barang'")->row();
        return $result;
    }

    public function getAllDataDistribusiDt($id_distribusi)
    {
        $this->datatables->select('b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out');
        $this->datatables->from('tb_barang AS b ');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        $this->datatables->join('stok_in_distribusi AS m', 'm.kd_barang = b.kd_barang', 'left');
        $this->datatables->join('stok_out_distribusi AS k', 'k.kd_barang = b.kd_barang', 'left');
        $this->datatables->where('m.id_distribusi', $id_distribusi);
        $this->datatables->or_where('k.id_distribusi', $id_distribusi);
        $this->datatables->order_by('b.ins', 'desc');
        return print_r($this->datatables->generate());
    }

    public function getAllDataDt($id_distribusi, $jenis)
    {
        $this->datatables->select('bd.id_barang_distribusi, bd.kd_barang, bd.jenis, bd.jumlah, bb.nama');
        $this->datatables->from('tb_barang_distribusi AS bd');
        $this->datatables->join('tb_barang AS bb', 'bb.kd_barang = bd.kd_barang', 'left');
        $this->datatables->where('bd.id_distribusi', $id_distribusi);
        $this->datatables->where('bd.jenis', $jenis);
        $this->datatables->order_by('bd.ins', 'desc');
        return print_r($this->datatables->generate());
    }
}
