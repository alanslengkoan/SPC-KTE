<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_masuk_n_keluar extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("");
        return $result;
    }

    public function getAllDataBarangDt($jenis)
    {
        $this->datatables->select('bmk.id_barang_masuk_keluar, bmk.no_transaksi, bmk.jenis_transaksi, bmk.kd_barang_or_bahan_baku, bmk.jumlah, bmk.ins AS tgl_pembelian, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis');
        $this->datatables->order_by('bmk.ins', 'desc');
        $this->datatables->where('bmk.jenis_transaksi', $jenis);
        $this->datatables->from('tb_barang_masuk_keluar AS bmk');
        $this->datatables->join('tb_barang AS b', 'bmk.kd_barang_or_bahan_baku = b.kd_barang', 'left');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        return print_r($this->datatables->generate());
    }

    public function getAllDataBahanBakuDt($jenis)
    {
        $this->datatables->select('bmk.id_barang_masuk_keluar, bmk.no_transaksi, bmk.jenis_transaksi, bmk.kd_barang_or_bahan_baku, bmk.jumlah, bmk.ins AS tgl_pembelian, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis');
        $this->datatables->order_by('bmk.ins', 'desc');
        $this->datatables->where('bmk.jenis_transaksi', $jenis);
        $this->datatables->from('tb_barang_masuk_keluar AS bmk');
        $this->datatables->join('tb_bahan_baku AS b', 'bmk.kd_barang_or_bahan_baku = b.kd_bahan_baku', 'left');
        $this->datatables->join('tb_satuan AS s', 'b.id_satuan = s.id_satuan', 'left');
        $this->datatables->join('tb_jenis AS j', 'b.id_jenis = j.id_jenis', 'left');
        return print_r($this->datatables->generate());
    }
}
