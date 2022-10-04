<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_konsumen extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_konsumen, k.nama, k.telepon, k.email, k.alamat FROM tb_konsumen AS k ORDER BY k.ins DESC");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_konsumen, k.nama, k.telepon, k.email, k.alamat');
        $this->datatables->order_by('k.ins', 'desc');
        $this->datatables->from('tb_konsumen AS k');
        return print_r($this->datatables->generate());
    }
}
