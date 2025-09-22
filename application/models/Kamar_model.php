<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {

    // simpan data kamar
    public function insertKamar($data)
    {
        $this->db->insert('kamar', $data);
        return $this->db->insert_id(); // return id kamar yang baru disimpan
    }

    
    public function insertKamarFasilitas($data)
    {
        $this->db->insert_batch('kamar_fasilitas', $data);
    }
}
