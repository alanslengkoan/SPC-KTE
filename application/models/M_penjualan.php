<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis ORDER BY b.ins ASC");
        return $result;
    }

    public function getAllData()
    {
        $result = $this->db->query("SELECT p.id_penjualan, pi.id_pengiriman, p.id_distribusi, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS total FROM tb_penjualan AS p LEFT JOIN tb_distribusi AS d ON d.id_distribusi = p.id_distribusi LEFT JOIN tb_users AS u ON u.id_users = d.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_pengiriman AS pi ON p.no_transaksi = pi.no_transaksi ORDER BY p.ins ASC");
        return $result;
    }

    public function getAllDataPembelianDistribusi($id_users)
    {
        $result = $this->db->query("SELECT p.id_penjualan, pi.id_pengiriman, p.id_distribusi, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, p.status_pengantaran, u.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS total FROM tb_penjualan AS p LEFT JOIN tb_distribusi AS d ON d.id_distribusi = p.id_distribusi LEFT JOIN tb_users AS u ON u.id_users = d.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_pengiriman AS pi ON p.no_transaksi = pi.no_transaksi WHERE d.id_users = '$id_users' ORDER BY p.ins ASC");
        return $result;
    }

    // public function getAllDetailData($id_distribusi)
    // {
    //     $result = $this->db->query("SELECT p.id_penjualan, pi.id_pengiriman, p.id_konsumen, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, k.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS total FROM tb_penjualan AS p LEFT JOIN tb_konsumen AS k ON p.id_konsumen = k.id_konsumen LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_pengiriman AS pi ON p.no_transaksi = pi.no_transaksi WHERE p.id_distribusi = '$id_distribusi' ORDER BY p.ins ASC");
    //     return $result;
    // }

    // public function getAllDataPembelianKonsumen($id_users)
    // {
    //     $result = $this->db->query("SELECT p.id_penjualan, p.id_konsumen, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, k.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga ) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS sub_total,( SELECT SUM(( tpd.diskon / 100 ) *( tpd.jumlah * tpd.harga )) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS sub_diskon,( SELECT SUM( tpd.jumlah * tpd.harga ) - SUM(( tpd.diskon / 100 ) *( tpd.jumlah * tpd.harga )) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS sub_ppn,( SELECT( p.pajak / 100 ) *( SUM( tpd.jumlah * tpd.harga ) - SUM(( tpd.diskon / 100 ) *( tpd.jumlah * tpd.harga ))) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS set_ppn FROM tb_penjualan AS p LEFT JOIN tb_konsumen AS k ON p.id_konsumen = k.id_konsumen LEFT JOIN tb_distribusi AS d ON p.id_distribusi = d.id_distribusi LEFT JOIN tb_users AS u ON d.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi WHERE s.id_users = '$id_users' ORDER BY p.ins ASC");
    //     return $result;
    // }

    public function getWherePembayaranDistribusi($id_penjualan)
    {
        $result = $this->db->query("SELECT p.id_penjualan, pi.id_pengiriman, p.id_distribusi, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama,( SELECT SUM( tpd.jumlah) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_penjualan_detail AS tpd WHERE tpd.id_penjualan = p.id_penjualan ) AS total FROM tb_penjualan AS p LEFT JOIN tb_distribusi AS d ON p.id_distribusi = d.id_distribusi LEFT JOIN tb_users AS u ON d.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_pengiriman AS pi ON p.no_transaksi = pi.no_transaksi WHERE p.id_penjualan = '$id_penjualan'");
        return $result;
    }

    public function getWhereInvoiceDistribusi($id_penjualan)
    {
        $result = $this->db->query("SELECT p.id_penjualan, p.id_distribusi, p.no_transaksi, p.ins AS tgl_penjualan, p.status_approve, p.status_invoice, p.status_pembayaran, pe.total_bayar, tmk.no_invoice, tmk.cetak AS tgl_invoice, pen.no_resi, u.nama, u.email, d.telepon, d.alamat FROM tb_penjualan AS p LEFT JOIN tb_distribusi AS d ON p.id_distribusi = d.id_distribusi LEFT JOIN tb_users AS u ON d.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_transaksi AS tmk ON p.no_transaksi = tmk.no_transaksi LEFT JOIN tb_pengiriman AS pen ON p.no_transaksi = pen.no_transaksi WHERE p.id_penjualan = '$id_penjualan'");
        return $result;
    }

    public function getWherePenjualanData($id_penjualan)
    {
        $result = $this->db->query("SELECT p.id_penjualan, p.id_distribusi, p.no_transaksi, p.status_approve, p.status_pembayaran, p.status_invoice, d.kd_distribusi, d.kd_pos, d.npwp, d.fax, d.telepon, d.alamat, u.nama,  u.email FROM tb_penjualan AS p LEFT JOIN tb_distribusi AS d ON d.id_distribusi = p.id_distribusi LEFT JOIN tb_users AS u ON u.id_users = d.id_users WHERE p.id_penjualan = '$id_penjualan'");
        return $result;
    }

    public function getWherePenjualanDetailData($id_penjualan)
    {
        $result = $this->db->query("SELECT tpd.id_penjualan_detail, tpd.id_penjualan, tpd.kd_barang, tpd.jumlah, tpd.harga, b.nama FROM tb_penjualan_detail AS tpd LEFT JOIN tb_barang AS b ON tpd.kd_barang = b.kd_barang WHERE tpd.id_penjualan = '$id_penjualan'");
        return $result;
    }

    public function getAllDataTemp()
    {
        $result = $this->db->query("SELECT tpu.id_t_penjualan, tpu.kd_barang, tpu.jumlah, tpu.harga, b.nama, s.nama AS satuan, j.nama AS jenis FROM tb_t_penjualan AS tpu LEFT JOIN tb_barang AS b ON tpu.kd_barang = b.kd_barang LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis ORDER BY tpu.id_t_penjualan");
        return $result;
    }
}