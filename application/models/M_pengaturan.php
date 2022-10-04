<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengaturan extends CI_Model
{
    public function getFirstRecord()
    {
        $result = $this->db->query("SELECT tp.id_pengaturan, tp.logo, tp.nama, tp.email, tp.alamat, tp.telepon, tp.facebook, tp.instagram, tp.twitter, tp.youtube FROM tb_pengaturan AS tp LIMIT 1")->row();
        return $result;
    }
}