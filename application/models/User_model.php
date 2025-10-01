<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'penghuni';
    protected $otp_table = 'otp_verifikasi'; 


    public function insertUser($data)
    {
        return $this->db->insert($this->table, $data);
    }

  
    public function checkDuplicate($email, $no_hp) 
    {
        $this->db->where('email', $email);
        $this->db->or_where('no_hp', $no_hp);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }


    public function get_by_email($email_md5) {
        return $this->db->where('email', $email_md5)->get('penghuni')->row();
    }

    public function get_by_login($email, $password) {
    $this->db->where('email', md5($email));     
    $this->db->where('password', md5($password));
    return $this->db->get('penghuni')->row();
}

    


    public function update_last_login($id_penghuni, $ip_address) {
        $data = [
            'last_login' => date('Y-m-d H:i:s'),
            'ip_login'   => $ip_address,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_penghuni', $id_penghuni);
        return $this->db->update($this->table, $data);
    }

     public function set_failed_attempt($id_penghuni) {
        $this->db->set('failed_attempts', 'failed_attempts+1', FALSE);
        $this->db->set('last_failed_attempt', date('Y-m-d H:i:s'));
        $this->db->where('id_penghuni', $id_penghuni);
        return $this->db->update($this->table);
    }

    public function reset_failed_attempt($id_penghuni) {
        $this->db->set('failed_attempts', 0);
        $this->db->set('last_failed_attempt', NULL);
        $this->db->where('id_penghuni', $id_penghuni);
        return $this->db->update($this->table);
    }

    public function getUserByPhone($phone) 
    {
        return $this->db->get_where($this->table, ['no_hp' => $phone])->row_array();
    }


    public function insertOtp($data) 
    {
        return $this->db->insert($this->otp_table, $data);
    }


    public function verifyOtp($email, $otp) 
    {
        $row = $this->db->get_where($this->otp_table, [
            'email' => $email,
            'otp' => $otp,
            'status' => 'pending'
        ])->row_array();

        if ($row && strtotime($row['expired_at']) > time()) {
            $this->db->where('id', $row['id']);
            $this->db->update($this->otp_table, ['status' => 'verified']);
            return true;
        }
        return false;
    }


  
public function existsByEmailOrPhone($email_plain, $no_hp_plain)
{
    $email_hashed = md5($email_plain);
    $nohp_hashed  = md5($no_hp_plain);

    $this->db->from($this->table);
    $this->db->group_start();
    $this->db->where('email', $email_hashed);
    $this->db->or_where('no_hp', $nohp_hashed);
    $this->db->group_end();

    return $this->db->count_all_results() > 0;
}

}
