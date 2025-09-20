<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
    private $table = 'admin';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_username($username) {
        $hashed_username = md5($username);
        return $this->db->get_where($this->table, ['username' => $hashed_username])->row();
    }

    public function update_password($id_admin, $new_password) {
        $hashed = md5($new_password);
        $this->db->where('id_admin', $id_admin);
        return $this->db->update($this->table, ['password' => $hashed]);
    }

     public function update_last_login($id_admin) {
        return $this->db->where('id_admin', $id_admin)
                        ->update($this->table, [
                            'last_login' => date('Y-m-d H:i:s'),
                            'ip_address' => $this->input->ip_address() 
                        ]);
    }

    public function set_failed_attempt($id_admin) {
        $admin = $this->db->get_where($this->table, ['id_admin' => $id_admin])->row();
        if ($admin) {
            $attempts = isset($admin->failed_attempts) ? $admin->failed_attempts + 1 : 1;
            $this->db->where('id_admin', $id_admin);
            $this->db->update($this->table, [
                'failed_attempts' => $attempts,
                'last_failed_attempt' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function reset_failed_attempt($id_admin) {
        $this->db->where('id_admin', $id_admin);
        $this->db->update($this->table, [
            'failed_attempts' => 0,
            'last_failed_attempt' => null
        ]);
    }
}
