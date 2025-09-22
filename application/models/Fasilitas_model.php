<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_model extends CI_Model {

    // ambil semua data fasilitas
    public function getAllFasilitas()
    {
        return $this->db->get('fasilitas_kos')->result();
    }
}


