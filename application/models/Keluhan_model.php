<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Keluhan_model extends CI_Model {

    public function get_all()
    {
        $this->db->select('keluhan.*, penghuni.nama AS nama_penghuni');
        $this->db->from('keluhan');
        $this->db->join('penghuni', 'penghuni.id_penghuni = keluhan.id_penghuni', 'left');
        $this->db->order_by('keluhan.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_penghuni($id_penghuni)
    {
        $this->db->select('keluhan.*, penghuni.nama AS nama_penghuni');
        $this->db->from('keluhan');
        $this->db->join('penghuni', 'penghuni.id_penghuni = keluhan.id_penghuni', 'left');
        $this->db->where('keluhan.id_penghuni', $id_penghuni);
        $this->db->order_by('keluhan.created_at', 'DESC');
        return $this->db->get()->result();
    }
   public function insert($data)
    {
        return $this->db->insert('keluhan', $data);
    }

      public function update_status($id_keluhan, $status)
    {
        $this->db->where('id_keluhan', $id_keluhan);
        return $this->db->update('keluhan', ['status' => $status]);
    }

    public function delete($id_keluhan)
    {
        $this->db->where('id_keluhan', $id_keluhan);
        return $this->db->delete('keluhan');
    }


}
?>