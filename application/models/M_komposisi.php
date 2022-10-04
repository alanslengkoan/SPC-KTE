<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_komposisi extends CI_Model
{
    // public function getAll()
    // {
    //     $result = $this->db->query("SELECT b.id_barang, b.kd_barang, b.nama, b.harga, s.nama AS satuan, j.nama AS jenis FROM tb_barang AS b LEFT JOIN tb_satuan AS s ON b.id_satuan = s.id_satuan LEFT JOIN tb_jenis AS j ON b.id_jenis = j.id_jenis ORDER BY b.ins ASC");
    //     return $result;
    // }

    public function getAllData()
    {
        $result = $this->db->query("SELECT k.id_komposisi, k.kd_barang, b.nama, k.stok_barang FROM tb_komposisi AS k LEFT JOIN tb_barang AS b ON b.kd_barang = k.kd_barang ORDER BY k.ins ASC");
        return $result;
    }

    // public function getAllDataPembelianSupplier($id_users)
    // {
    //     $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama, pe.id_pembayaran, pe.jenis_transaksi,( SELECT SUM( tpd.jumlah) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian ) AS total FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi WHERE s.id_users = '$id_users' ORDER BY p.ins ASC");
    //     return $result;
    // }

    // public function getWherePembayaranSupplier($id_pembelian)
    // {
    //     $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama,( SELECT SUM( tpd.jumlah) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian) AS jumlah_stok,( SELECT SUM( tpd.jumlah * tpd.harga) FROM tb_pembelian_detail AS tpd WHERE tpd.id_pembelian = p.id_pembelian ) AS total FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users WHERE p.id_pembelian = '$id_pembelian'");
    //     return $result;
    // }

    // public function getWhereInvoiceSupplier($id_pembelian)
    // {
    //     $result = $this->db->query("SELECT p.id_pembelian, p.id_supplier, p.no_transaksi, p.status_approve, p.status_invoice, p.status_pembayaran, u.nama, u.email, s.kd_pos, s.npwp, s.fax, s.telepon, s.alamat, pe.total_bayar, tmk.no_invoice, tmk.cetak FROM tb_pembelian AS p LEFT JOIN tb_supplier AS s ON p.id_supplier = s.id_supplier LEFT JOIN tb_users AS u ON s.id_users = u.id_users LEFT JOIN tb_pembayaran AS pe ON p.no_transaksi = pe.no_transaksi LEFT JOIN tb_transaksi AS tmk ON p.no_transaksi = tmk.no_transaksi WHERE p.id_pembelian = '$id_pembelian'");
    //     return $result;
    // }


    public function checkKomposisiStok($kd_barang)
    {
        $result = $this->db->query("SELECT tk.kd_barang, tkd.kd_bahan_baku, tbb.nama, tkd.stok_bahan_baku,( IFNULL( m.stok_in, 0) - IFNULL( k.stok_out, 0)) AS stok_tersedia FROM tb_komposisi_detail AS tkd LEFT JOIN tb_bahan_baku AS tbb ON tbb.kd_bahan_baku = tkd.kd_bahan_baku LEFT JOIN tb_komposisi AS tk ON tk.id_komposisi = tkd.id_komposisi LEFT JOIN stok_in AS m ON m.kd_barang_or_bahan_baku = tkd.kd_bahan_baku LEFT JOIN stok_out AS k ON k.kd_barang_or_bahan_baku = tkd.kd_bahan_baku WHERE tk.kd_barang = '$kd_barang' ORDER BY tkd.kd_bahan_baku ASC");
        return $result;
    }

    public function getWhereKomposisiData($id_komposisi)
    {
        $result = $this->db->query("SELECT k.id_komposisi, k.kd_barang, b.nama, k.stok_barang FROM tb_komposisi AS k LEFT JOIN tb_barang AS b ON b.kd_barang = k.kd_barang WHERE k.id_komposisi = '$id_komposisi'");
        return $result;
    }

    public function getWhereKomposisiDetailData($id_komposisi)
    {
        $result = $this->db->query("SELECT tkd.id_komposisi_detail, tkd.kd_bahan_baku, tkd.stok_bahan_baku, b.nama AS bahan_baku, j.nama AS jenis, s.nama AS satuan FROM tb_komposisi_detail AS tkd LEFT JOIN tb_bahan_baku AS b ON b.kd_bahan_baku = tkd.kd_bahan_baku LEFT JOIN tb_satuan AS s ON s.id_satuan = b.id_satuan LEFT JOIN tb_jenis AS j ON j.id_jenis = b.id_jenis WHERE tkd.id_komposisi = '$id_komposisi'");
        return $result;
    }

    public function getAllDataTemp()
    {
        $result = $this->db->query("SELECT tpk.id_t_komposisi, tpk.kd_bahan_baku, tpk.stok_bahan_baku, b.nama AS bahan_baku, j.nama AS jenis, s.nama AS satuan FROM tb_t_komposisi AS tpk LEFT JOIN tb_bahan_baku AS b ON tpk.kd_bahan_baku = b.kd_bahan_baku LEFT JOIN tb_satuan AS s ON s.id_satuan = b.id_satuan LEFT JOIN tb_jenis AS j ON j.id_jenis = b.id_jenis ORDER BY tpk.id_t_komposisi ASC");
        return $result;
    }
}
