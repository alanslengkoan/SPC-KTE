<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_jenis extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT j.id_jenis, j.nama FROM tb_jenis AS j ORDER BY j.ins ASC");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('j.id_jenis, j.nama');
        $this->datatables->order_by('j.ins', 'desc');
        $this->datatables->from('tb_jenis AS j');
        return print_r($this->datatables->generate());
    }
}
