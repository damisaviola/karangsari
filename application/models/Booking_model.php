<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    private $table = 'booking';

   
    public function getAvailableRooms($check_in, $check_out) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->where('status', 'tersedia');

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

    public function get_booking_by_id($id_booking) {
        return $this->db->get_where('booking', ['id_booking' => $id_booking])->row();
    }

    public function get_all() {
            $this->db->select('
                booking.*, 
                penghuni.nama AS nama_penghuni, 
                kamar.nomor_kamar, 
                kamar.harga
            ');
            $this->db->from($this->table);
            $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni');
            $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
            $this->db->order_by('booking.created_at', 'DESC');
            return $this->db->get()->result();
        }

         public function get_by_id($id_booking) {
        $this->db->select('
            booking.*, 
            penghuni.nama AS nama_penghuni, 
            kamar.nomor_kamar, 
            kamar.harga
        ');
        $this->db->from($this->table);
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->where('booking.id_booking', $id_booking);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('booking', $data);
    }

    public function getRoomById($id_kamar) {
        $this->db->where('id_kamar', $id_kamar);
        $room = $this->db->get('kamar')->row_array();

        if (!$room) return null;

        $this->db->select('f.nama_fasilitas');
        $this->db->from('kamar_fasilitas kf');
        $this->db->join('fasilitas_kos f', 'kf.id_fasilitas = f.id_fasilitas', 'left');
        $this->db->where('kf.id_kamar', $id_kamar);
        $fasilitas = $this->db->get()->result_array();

        $room['fasilitas'] = array_column($fasilitas, 'nama_fasilitas');
        return $room;
    }

    public function insertBooking($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function activateTenant($id_penghuni) {
        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->update('penghuni', ['status' => 'aktif']);
    }

    public function get_by_id1($id)
{
    return $this->db->get_where('booking', ['id_booking' => $id])->row();
}

 public function getById($id_booking) {
        return $this->db->get_where('booking', ['id_booking' => $id_booking])->row();
    }

     public function update($id_booking, $data) {
        $this->db->where('id_booking', $id_booking);
        return $this->db->update('booking', $data);
    }

}
