<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengiriman extends CI_Model
{
    public function getWhereDataPengirimanDistribusiDt($id_users)
    {
        $this->datatables->select('pe.id_pengiriman, pe.no_resi, pe.no_transaksi, t.no_invoice, u.nama AS distribusi');
        $this->datatables->where('d.id_users', $id_users);
        $this->datatables->from('tb_pengiriman AS pe');
        $this->datatables->join('tb_transaksi AS t', 'pe.no_transaksi = t.no_transaksi', 'left');
        $this->datatables->join('tb_penjualan AS p', 'pe.no_transaksi = p.no_transaksi', 'left');
        $this->datatables->join('tb_distribusi AS d', 'p.id_distribusi = d.id_distribusi', 'left');
        $this->datatables->join('tb_users AS u', 'd.id_users = u.id_users', 'left');
        return print_r($this->datatables->generate());
    }

    public function getWherePengirimanDetail($id_pengiriman)
    {
        $result = $this->db->query("SELECT pe.id_pengiriman, pe.no_resi, pe.no_transaksi, ped.status, ped.ins FROM tb_pengiriman AS pe LEFT JOIN tb_pengiriman_detail AS ped ON pe.id_pengiriman = ped.id_pengiriman WHERE pe.id_pengiriman = '$id_pengiriman'");
        return $result;
    }
    
    public function getWherePengirimanLacak($no_resi)
    {
        $result = $this->db->query("SELECT p.id_penjualan, p.status_pengantaran, pe.id_pengiriman, pe.no_resi, pe.no_transaksi, t.no_invoice, k.nama AS konsumen, u.nama AS distribusi FROM tb_pengiriman AS pe LEFT JOIN tb_transaksi AS t ON pe.no_transaksi = t.no_transaksi LEFT JOIN tb_penjualan AS p ON pe.no_transaksi = p.no_transaksi LEFT JOIN tb_konsumen AS k ON p.id_konsumen = k.id_konsumen LEFT JOIN tb_distribusi AS d ON p.id_distribusi = d.id_distribusi LEFT JOIN tb_users AS u ON d.id_users = u.id_users WHERE pe.no_resi = '$no_resi'");
        return $result;
    }
}
