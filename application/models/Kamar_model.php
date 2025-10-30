<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {


     public function get_by_id($id_kamar) {
        return $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row();
    }


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



public function delete($id_kamar) {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->delete('kamar_fasilitas');

        $this->db->where('id_kamar', $id_kamar);
        $this->db->delete('booking');
        return $this->db->delete('kamar', ['id_kamar' => $id_kamar]);
    }


public function get_all() {
    $this->db->select('*');
    $this->db->from('kamar');
    $this->db->order_by('nomor_kamar', 'ASC');
    return $this->db->get()->result();

}

public function get_kamar_by_id($id_kamar)
    {
        return $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row();
    }

public function getFasilitasByKamar($id_kamar)
{
    $this->db->select('f.*');
    $this->db->from('fasilitas_kos f');
    $this->db->join('kamar_fasilitas kf', 'kf.id_fasilitas = f.id_fasilitas');
    $this->db->where('kf.id_kamar', $id_kamar);
    $query = $this->db->get();
    return $query->result();
}




}
