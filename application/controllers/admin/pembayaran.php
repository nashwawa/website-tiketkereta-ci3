<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth'); 
        }
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    // Halaman konfirmasi pembayaran
    public function index($pemesanan_id) {
        // Ambil data pemesanan + relasi
        $this->db->select('pemesanan.*, users.name, jadwal.jam_berangkat, jadwal.jam_sampai, 
                           jadwal.stasiun_awal, jadwal.stasiun_akhir, jadwal.harga, kereta.nama as nama_kereta');
        $this->db->from('pemesanan');
        $this->db->join('users', 'users.id_user = pemesanan.user_id', 'left');
        $this->db->join('jadwal', 'jadwal.jadwal_id = pemesanan.jadwal_id', 'left');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $this->db->where('pemesanan.pemesanan_id', $pemesanan_id);
        $pemesanan = $this->db->get()->row_array();

        if (!$pemesanan) {
            show_404();
        }

        $data = [
            'judul_halaman' => "Konfirmasi Pembayaran",
            'pemesanan'     => $pemesanan
        ];
        $this->load->view('admin/pembayaran', $data);
    }

    // Proses update status pembayaran
    public function konfirmasi($pemesanan_id) {
        $this->db->where('pemesanan_id', $pemesanan_id);
        $this->db->update('pemesanan', ['status_pembayaran' => 'lunas']);

        $this->session->set_flashdata('alert', '<div class="alert alert-success">Pembayaran berhasil dikonfirmasi!</div>');
        redirect('admin/pembayaran/'.$pemesanan_id);
    }
}
