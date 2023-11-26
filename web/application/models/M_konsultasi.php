<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_konsultasi extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->query("SELECT k.id_konsultasi, u.nama, k.image FROM konsultasi AS k LEFT JOIN users AS u ON u.id_users = k.id_users ORDER BY k.created_at DESC");
        return $result;
    }

    public function get_all_user($id)
    {
        $result = $this->db->query(" SELECT k.id_konsultasi, k.id_users, u.nama, k.image, k.created_at FROM konsultasi AS k LEFT JOIN users AS u ON u.id_users = k.id_users WHERE k.id_users = '$id' ORDER BY k.created_at DESC");
        return $result;
    }

    public function get_all_data_dt()
    {
        $this->datatables->select('k.id_konsultasi, u.nama, k.image');
        $this->datatables->join('users AS u', 'u.id_users = k.id_users', 'left');
        $this->datatables->order_by('k.created_at', 'desc');
        $this->datatables->from('konsultasi AS k');
        return print_r($this->datatables->generate());
    }
}
