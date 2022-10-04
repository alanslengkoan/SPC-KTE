<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pembelian extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis ORDER BY b.ins ASC");
        return $result;
    }

    public function getAllData()
    {
        $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama,( SELECT SUM( tpd.jumlah) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian ) AS total FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users ORDER BY p.ins ASC");
        return $result;
    }

    public function getAllDataPembelianSupplier($id_users)
    {
        $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian ) AS total FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi WHERE s.id_users = '$id_users' ORDER BY p.ins ASC");
        return $result;
    }

    public function getWherePembayaranSupplier($id_pembelian)
    {
        $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama,( SELECT SUM( tpd.jumlah) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian ) AS total FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users WHERE p.id_pembelian = '$id_pembelian'");
        return $result;
    }

    public function getWhereInvoiceSupplier($id_pembelian)
    {
        $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama, u.email, s.kd_pos, s.npwp, s.fax, s.telepon, s.alamat, pe.total_bayar, tmk.no_invoice, tmk.cetak FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_transaksi AS tmk ON p.no_transaksi = tmk.no_transaksi WHERE p.id_pembelian = '$id_pembelian'");
        return $result;
    }

    public function getWherePembelianData($id_pembelian)
    {
        $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_pembayaran, s.kd_supplier, s.kd_pos, s.npwp, s.fax, s.telepon, s.alamat, u.nama, u.email FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users WHERE p.id_pembelian = '$id_pembelian'");
        return $result;
    }

    public function getWherePembelianDetailData($id_pembelian)
    {
        $result = $this->db->query("SELECT tpd.id_pembelian_detail, tpd.id_pembelian, tpd.kd_bahan_baku, tpd.jumlah, tpd.harga, b.nama FROM tb_pembelian_detail AS tpd LEFT JOIN tb_bahan_baku AS b ON tpd.kd_bahan_baku = b.kd_bahan_baku WHERE tpd.id_pembelian = '$id_pembelian'");
        return $result;
    }

    public function getAllDataTemp()
    {
        $result = $this->db->query("SELECT tpu.id_t_pembelian, tpu.kd_bahan_baku, tpu.jumlah, tpu.harga, b.nama FROM tb_t_pembelian AS tpu LEFT JOIN tb_bahan_baku AS b ON tpu.kd_bahan_baku = b.kd_bahan_baku");
        return $result;
    }
}