<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');

        // Cek login admin
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth'); 
        }
    }

    public function index() {
        // Ambil data pemesanan join penumpang dan jadwal
        $this->db->select('pemesanan.*, 
                   penumpang.nama, penumpang.email, penumpang.no_tlp,
                   jadwal.jam_berangkat, jadwal.jam_sampai, jadwal.stasiun_awal, jadwal.stasiun_akhir, jadwal.harga,
                   kereta.nama as nama_kereta');
        $this->db->from('pemesanan');
        $this->db->join('penumpang', 'penumpang.penumpang_id = pemesanan.user_id', 'left');
        $this->db->join('jadwal', 'jadwal.jadwal_id = pemesanan.jadwal_id', 'left');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $data['pemesanan'] = $this->db->get()->result();

        $data['judul_halaman'] = "Data Pemesanan";

        // load view dengan template mazer
        $this->template->load('template', 'admin/data_pemesanan', $data);
    }

    // ✅ Function untuk konfirmasi pembayaran
    public function konfirmasi($id) {
        // Update status jadi "lunas"
        $this->db->where('pemesanan_id', $id);
        $this->db->update('pemesanan', ['status_pembayaran' => 'lunas']);

        // kasih notifikasi flashdata
        $this->session->set_flashdata('alert', 
            '<div class="alert alert-success">Pembayaran berhasil dikonfirmasi.</div>'
        );

        redirect('pemesanan'); // kembali ke daftar pemesanan
    }

    // ❌ Optional: kalau butuh batalkan konfirmasi
    public function batalkan($id) {
        $this->db->where('pemesanan_id', $id);
        $this->db->update('pemesanan', ['status_pembayaran' => 'menunggu_konfirmasi']);

        $this->session->set_flashdata('alert', 
            '<div class="alert alert-warning">Konfirmasi pembayaran dibatalkan.</div>'
        );

        redirect('pemesanan');
    }
}
