<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model 
{
    private $table = 'users'; 


    public function get_by_username($username) 
    {
        return $this->db->where('username', $username)
                        ->get($this->table)
                        ->row();
    }


    public function register($data) 
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert($this->table, $data);
    }
}
