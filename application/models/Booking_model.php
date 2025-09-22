<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

  
    public function getAvailableRooms($check_in, $check_out) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->where('status', 'tersedia');

        // Filter kamar yang tidak sedang dipesan/dihuni di tanggal yang sama
        $this->db->where("id_kamar NOT IN (
            SELECT id_kamar FROM booking 
            WHERE status IN ('dipesan', 'dihuni')
            AND (check_in <= '$check_out' AND check_out >= '$check_in')
        )", NULL, FALSE);

        $query = $this->db->get();
        return $query->result();
    }
}
