<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund_model extends CI_Model
{
    // Ambil semua data refund (admin)
    public function getAllRefunds()
    {
        $this->db->select('
            refund.*, 
            booking.id_booking, 
            booking.total_harga, 
            penghuni.nama AS nama_penghuni
        ');
        $this->db->from('refund');
        $this->db->join('booking', 'booking.id_booking = refund.id_booking', 'left');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
        $this->db->order_by('refund.tanggal_refund', 'DESC');
        return $this->db->get()->result();
    }


    public function get_detail_booking($id_booking)
{
    $this->db->select('booking.id_booking, booking.total_harga, booking.tanggal_booking, penghuni.nama AS nama_penghuni');
    $this->db->from('booking');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->where('booking.id_booking', $id_booking);
    return $this->db->get()->row();
}

public function get_booking_detail($id_booking)
{
    $this->db->select('
        booking.id_booking,
        booking.total_harga,
        booking.created_at AS tanggal_booking,
        penghuni.nama AS nama_penghuni
    ');
    $this->db->from('booking');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->where('booking.id_booking', $id_booking);
    $this->db->where('booking.status_pembayaran', 'lunas'); // hanya ambil yang lunas
    return $this->db->get()->row();
}


    public function get_booking_lunas()
{
    $this->db->select('booking.*, penghuni.nama AS nama_penghuni');
    $this->db->from('booking');
    $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
    $this->db->where('booking.status_pembayaran', 'lunas');
    return $this->db->get()->result();
}



public function insert_refund($data)
{
    return $this->db->insert('refund', $data);
}

    // Ambil refund berdasarkan penghuni (user)
    public function getRefundByUser($id_penghuni)
    {
        $this->db->select('
            refund.*, 
            booking.id_booking, 
            booking.total_harga, 
            penghuni.nama AS nama_penghuni
        ');
        $this->db->from('refund');
        $this->db->join('booking', 'booking.id_booking = refund.id_booking', 'left');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
        $this->db->where('booking.id_penghuni', $id_penghuni);
        $this->db->order_by('refund.tanggal_refund', 'DESC');
        return $this->db->get()->result();
    }


    public function insertRefund($data)
    {
        return $this->db->insert('refund', $data);
    }

    public function updateStatus($id_refund, $status)
    {
        $this->db->where('id_refund', $id_refund);
        return $this->db->update('refund', [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }


    public function getRefundById($id_refund)
    {
        $this->db->select('refund.*, booking.total_harga, penghuni.nama AS nama_penghuni');
        $this->db->from('refund');
        $this->db->join('booking', 'booking.id_booking = refund.id_booking', 'left');
        $this->db->join('penghuni', 'penghuni.id_penghuni = booking.id_penghuni', 'left');
        $this->db->where('refund.id_refund', $id_refund);
        return $this->db->get()->row();
    }
}
