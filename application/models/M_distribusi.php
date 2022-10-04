<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_distribusi extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT dis.id_distribusi, dis.kd_distribusi, dis.kd_pos, dis.npwp, dis.fax, dis.telepon, dis.alamat, u.nama, u.email FROM tb_distribusi AS dis LEFT JOIN tb_users AS u ON dis.id_users = u.id_users ORDER BY dis.ins ASC");
        return $result;
    }

    public function getWhere($id_distribusi)
    {
        $result = $this->db->query("SELECT dis.id_distribusi, dis.id_users, dis.kd_distribusi, dis.kd_pos, dis.npwp, dis.fax, dis.telepon, dis.alamat, u.nama, u.email FROM tb_distribusi AS dis LEFT JOIN tb_users AS u ON dis.id_users = u.id_users WHERE dis.id_distribusi = '$id_distribusi'");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('dis.id_distribusi, dis.kd_distribusi, dis.kd_pos, dis.npwp, dis.fax, dis.telepon, dis.alamat, u.nama, u.email, u.username');
        $this->datatables->order_by('dis.ins', 'desc');
        $this->datatables->from('tb_distribusi AS dis');
        $this->datatables->join('tb_users AS u', 'dis.id_users = u.id_users', 'left');
        return print_r($this->datatables->generate());
    }
}
