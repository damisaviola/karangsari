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

    public function update_status($id_kamar, $status)
    {
        $this->db->where('id_kamar', $id_kamar);
        return $this->db->update('kamar', ['status' => $status]);
    }

    public function get_kamar_tersedia()
{
    $this->db->select('*');
    $this->db->from('kamar');
    $this->db->where('status !=', 'dihuni'); 
    return $this->db->get()->result();
}


public function get_all() {
    $this->db->select('*');
    $this->db->from('kamar');
    $this->db->order_by('nomor_kamar', 'ASC');
    return $this->db->get()->result();

}



}
