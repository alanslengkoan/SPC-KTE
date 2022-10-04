<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_bahan_baku_supplier extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_bahan_baku AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in_supplier AS m ON m.kd_bahan_baku = b.kd_bahan_baku LEFT JOIN stok_out_supplier AS k ON k.kd_bahan_baku = b.kd_bahan_baku ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhereSupplier($id_supplier)
    {
        $result = $this->db->query("SELECT b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0) AS stok_in, IFNULL( k.stok_out, 0) AS stok_out FROM tb_bahan_baku AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis LEFT JOIN stok_in_supplier AS m ON m.kd_bahan_baku = b.kd_bahan_baku LEFT JOIN stok_out_supplier AS k ON k.kd_bahan_baku = b.kd_bahan_baku WHERE m.id_supplier = '$id_supplier' OR k.id_supplier = '$id_supplier' ORDER BY b.ins ASC");
        return $result;
    }

    public function getWhere($id_supplier, $kd_bahan_baku)
    {
        $result = $this->db->query("SELECT b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL(( SELECT stok_in FROM stok_in_supplier AS m WHERE m.id_supplier = '$id_supplier' AND m.kd_bahan_baku = '$kd_bahan_baku'), 0) AS stok_in, IFNULL(( SELECT stok_out FROM stok_out_supplier AS m WHERE m.id_supplier = '$id_supplier' AND m.kd_bahan_baku = '$kd_bahan_baku'), 0 ) AS stok_out FROM tb_bahan_baku AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis WHERE b.kd_bahan_baku = '$kd_bahan_baku'")->row();
        return $result;
    }

    public function getAllDataSupplierDt($id_supplier)
    {
        $this->datatables->select('b.id_bahan_baku, b.kd_bahan_baku, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis, IFNULL( m.stok_in, 0 ) AS stok_in, IFNULL( k.stok_out, 0 ) AS stok_out');
        $this->datatables->from('tb_bahan_baku AS b');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        $this->datatables->join('stok_in_supplier AS m', 'm.kd_bahan_baku = b.kd_bahan_baku', 'left');
        $this->datatables->join('stok_out_supplier AS k', 'k.kd_bahan_baku = b.kd_bahan_baku', 'left');
        $this->datatables->where('m.id_supplier', $id_supplier);
        $this->datatables->or_where('k.id_supplier', $id_supplier);
        $this->datatables->order_by('b.ins', 'desc');
        return print_r($this->datatables->generate());
    }

    public function getAllDataDt($id_supplier, $jenis)
    {
        $this->datatables->select('bbs.id_bahan_baku_supplier, bbs.kd_bahan_baku, bb.nama, bbs.jumlah');
        $this->datatables->from('tb_bahan_baku_supplier AS bbs');
        $this->datatables->join('tb_bahan_baku AS bb', 'bb.kd_bahan_baku = bbs.kd_bahan_baku', 'left');
        $this->datatables->where('bbs.id_supplier', $id_supplier);
        $this->datatables->where('bbs.jenis', $jenis);
        $this->datatables->order_by('bbs.ins', 'desc');
        return print_r($this->datatables->generate());
    }
}
