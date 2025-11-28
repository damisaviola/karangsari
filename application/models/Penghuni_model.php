<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni_model extends CI_Model {

    protected $table = 'penghuni';

    public function __construct() {
        parent::__construct();
    }

    public function update_status($id_penghuni, $status) {
        return $this->db->where('id_penghuni', $id_penghuni)
                        ->update($this->table, [
                            'status' => $status,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
    }
}
