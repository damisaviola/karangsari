<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waiting_list_model extends CI_Model {

    protected $table = 'waiting_list';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_waiting($data)
    {
        return $this->db->insert($this->table, $data);
    }


    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }


    public function get_by_id($id_waiting)
    {
        return $this->db->get_where($this->table, ['id_waiting' => $id_waiting])->row();
    }

    public function update_waiting($id_waiting, $data)
    {
        $this->db->where('id_waiting', $id_waiting);
        return $this->db->update($this->table, $data);
    }


    public function delete_waiting($id_waiting)
    {
        return $this->db->delete($this->table, ['id_waiting' => $id_waiting]);
    }
}
