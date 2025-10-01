<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {


    public function insertKamar($data)
    {
        $this->db->insert('kamar', $data);
        return $this->db->insert_id(); 
    }

    
    public function insertKamarFasilitas($data)
    {
        $this->db->insert_batch('kamar_fasilitas', $data);
    }
}
