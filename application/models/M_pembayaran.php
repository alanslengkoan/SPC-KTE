<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pembayaran extends CI_Model
{
    public function getWhereDataPembayaranSupplierDt($id_users)
    {
        $this->datatables->select('pe.id_pembayaran, pe.no_transaksi, pe.jenis_transaksi, pe.total_bayar, t.no_invoice, t.cetak, p.id_pembelian, p.id_supplier, p.status_invoice');
        $this->datatables->where('s.id_users', $id_users);
        $this->datatables->from('tb_pembayaran AS pe');
        $this->datatables->join('tb_transaksi AS t', 'pe.no_transaksi = t.no_transaksi', 'left');
        $this->datatables->join('tb_pembelian AS p', 'pe.no_transaksi = p.no_transaksi', 'left');
        $this->datatables->join('tb_supplier AS s', 'p.id_supplier = s.id_supplier', 'left');
        return print_r($this->datatables->generate());
    }

    public function getWhereDataPembayaranDistribusiDt($id_users)
    {
        $this->datatables->select('pe.id_pembayaran, pe.no_transaksi, pe.jenis_transaksi, pe.total_bayar, t.no_invoice, t.cetak, p.id_penjualan, p.status_invoice');
        $this->datatables->where('d.id_users', $id_users);
        $this->datatables->from('tb_pembayaran AS pe');
        $this->datatables->join('tb_transaksi AS t', 'pe.no_transaksi = t.no_transaksi', 'left');
        $this->datatables->join('tb_penjualan AS p', 'pe.no_transaksi = p.no_transaksi', 'left');
        $this->datatables->join('tb_distribusi AS d', 'p.id_distribusi = d.id_distribusi', 'left');
        return print_r($this->datatables->generate());
    }
}