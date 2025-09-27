<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'penghuni';

    public function insertUser($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }

    public function checkDuplicate($email, $no_hp) {
        $this->db->where('email', $email);
        $this->db->or_where('no_hp', $no_hp);
        $query = $this->db->get('penghuni');
        return $query->num_rows() > 0;
    }


}
