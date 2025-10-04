<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    private $table = 'pemesanan';

    // Ambil kamar yang tersedia berdasarkan tanggal
    public function getAvailableRooms($check_in, $check_out) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->where('status', 'tersedia');

        // Hindari kamar yang sedang dipesan pada rentang tanggal tersebut
        $this->db->where("id_kamar NOT IN (
            SELECT id_kamar FROM {$this->table} 
            WHERE status IN ('dipesan', 'dihuni')
            AND (
                (tanggal_masuk <= ? AND tanggal_keluar >= ?) 
                OR 
                (tanggal_masuk <= ? AND tanggal_keluar >= ?)
            )
        )", [$check_out, $check_in, $check_in, $check_out], FALSE);

        $query = $this->db->get();
        return $query->result();
    }

    // Ambil data kamar berdasarkan ID
    public function getRoomById($id_kamar) {
        $this->db->where('id_kamar', $id_kamar);
        $room = $this->db->get('kamar')->row_array();

        if (!$room) return null;

        // Ambil fasilitas kamar
        $this->db->select('f.nama_fasilitas');
        $this->db->from('kamar_fasilitas kf');
        $this->db->join('fasilitas_kos f', 'kf.id_fasilitas = f.id_fasilitas', 'left');
        $this->db->where('kf.id_kamar', $id_kamar);
        $fasilitas = $this->db->get()->result_array();

        $room['fasilitas'] = array_column($fasilitas, 'nama_fasilitas');
        return $room;
    }

    // Simpan data pemesanan baru
    public function insertBooking($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update status penghuni jadi aktif
    public function activateTenant($id_penghuni) {
        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->update('penghuni', ['status' => 'aktif']);
    }
}
