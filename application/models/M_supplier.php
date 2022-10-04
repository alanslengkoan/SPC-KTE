<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT su.id_supplier, su.kd_supplier, su.kd_pos, su.npwp, su.fax, su.telepon, su.alamat, u.nama, u.email FROM tb_supplier AS su LEFT JOIN tb_users AS u ON su.id_users = u.id_users ORDER BY su.ins");
        return $result;
    }

    public function getWhere($id_supplier)
    {
        $result = $this->db->query("SELECT su.id_supplier, su.id_users, su.kd_supplier, su.kd_pos, su.npwp, su.fax, su.telepon, su.alamat, u.nama, u.email FROM tb_supplier AS su LEFT JOIN tb_users AS u ON su.id_users = u.id_users WHERE su.id_supplier = '$id_supplier'");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('su.id_supplier, su.kd_supplier, su.kd_pos, su.npwp, su.fax, su.telepon, su.alamat, u.nama, u.email, u.username');
        $this->datatables->order_by('su.ins', 'desc');
        $this->datatables->from('tb_supplier AS su');
        $this->datatables->join('tb_users AS u', 'su.id_users = u.id_users', 'left');
        return print_r($this->datatables->generate());
    }
}
