<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_model extends CI_Model {

    public function getAllFasilitas()
    {
        return $this->db->get('fasilitas_kos')->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('fasilitas_kos', ['id_fasilitas' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('fasilitas_kos', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_fasilitas', $id);
        return $this->db->update('fasilitas_kos', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_fasilitas', $id);
        return $this->db->delete('fasilitas_kos');
    }

}


