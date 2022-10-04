<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_satuan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT s.id_satuan, s.kd_satuan, s.nama FROM tb_satuan AS s ORDER BY s.ins ASC");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('s.id_satuan, s.kd_satuan, s.nama');
        $this->datatables->order_by('s.ins', 'desc');
        $this->datatables->from('tb_satuan AS s');
        return print_r($this->datatables->generate());
    }
}
