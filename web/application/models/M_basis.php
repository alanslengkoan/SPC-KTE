<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_basis extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->query("SELECT b.id_basis, k.nama, b.image, b.r, b.g, b.b, k.nama, k.deskripsi FROM basis AS b LEFT JOIN klasifikasi AS k ON k.id_klasifikasi = b.id_klasifikasi ORDER BY b.created_at DESC");
        return $result;
    }

    public function get_all_data_dt()
    {
        $this->datatables->select('b.id_basis, b.image, b.r, b.g, b.b, k.nama, k.deskripsi');
        $this->datatables->join('klasifikasi AS k', 'k.id_klasifikasi = b.id_klasifikasi', 'left');
        $this->datatables->order_by('b.created_at', 'desc');
        $this->datatables->from('basis AS b');
        return print_r($this->datatables->generate());
    }
}
