<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataDiri extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'user') {
            redirect('auth'); 
        }
    }

    // Tampilkan form data diri
    public function index() {
        $jadwal_id    = $this->input->post('jadwal_id');
        $jumlah_tiket = $this->input->post('jumlah_tiket');
    
        if (!$jadwal_id) {
            show_404();
        }

        // Ambil detail jadwal
        $this->db->select('jadwal.*, kereta.nama as nama_kereta, gerbong.nama_kode as nama_gerbong, gerbong.jumlah_kursi');
        $this->db->from('jadwal');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $this->db->join('gerbong', 'gerbong.kereta_id = kereta.kereta_id', 'left');
        $this->db->where('jadwal.jadwal_id', $jadwal_id);
        $jadwal = $this->db->get()->row_array();

        if (!$jadwal) {
            show_404();
        }

        if (empty($jumlah_tiket)) {
            $jumlah_tiket = 1;
        }

        $data = [
            'judul_halaman' => "Isi Data Diri Pemesan",
            'jadwal'        => $jadwal,
            'jumlah_tiket'  => $jumlah_tiket
        ];

        $this->load->view('user/data_diri', $data);
    }

    public function simpan() {
        $post      = $this->input->post();
        $jadwal_id = $post['jadwal_id'];
        $user_id   = $this->session->userdata('id_user'); // dari tabel users/login
    
        // --- Ambil harga dari jadwal ---
        $jadwal = $this->db->get_where('jadwal', ['jadwal_id' => $jadwal_id])->row_array();
    
        // --- Hitung jumlah penumpang ---
        $jumlah_penumpang = 1; // pemesan utama
        if (!empty($post['penumpang'])) {
            $jumlah_penumpang += count($post['penumpang']);
        }
        $total_harga = $jadwal['harga'] * $jumlah_penumpang;
    
        // --- Simpan ke tabel pemesanan dulu ---
        $pemesanan = [
            'jadwal_id'        => $jadwal_id,
            'user_id'          => $user_id,
            'jumlah_penumpang' => $jumlah_penumpang,
            'total_harga'      => $total_harga,
            'status_pembayaran'=> 'belum_bayar'
        ];
        $this->db->insert('pemesanan', $pemesanan);
        $pemesanan_id = $this->db->insert_id();
    
        // --- Simpan penumpang utama ---
        $pemesan = [
            'nik'    => $post['nik'],
            'nama'   => $post['nama'],
            'email'  => $post['email'],
            'no_tlp' => $post['no_tlp']
        ];
        $this->db->insert('penumpang', $pemesan);
        $penumpang_id = $this->db->insert_id();
    
        // Hubungkan ke detail_pemesanan
        $detail = [
            'pemesanan_id' => $pemesanan_id,
            'penumpang_id' => $penumpang_id,
            'kode'         => uniqid('KODE'),
            'status'       => 'aktif'
        ];
        $this->db->insert('detail_pemesanan', $detail);
    
        // --- Simpan penumpang tambahan (jika ada) ---
        if (!empty($post['penumpang'])) {
            foreach ($post['penumpang'] as $p) {
                $data = [
                    'nik'    => $p['nik'],
                    'nama'   => $p['nama'],
                    'email'  => $pemesan['email'],  // pakai email/telp pemesan
                    'no_tlp' => $pemesan['no_tlp']
                ];
                $this->db->insert('penumpang', $data);
                $penumpang_id = $this->db->insert_id();
    
                $detail = [
                    'pemesanan_id' => $pemesanan_id,
                    'penumpang_id' => $penumpang_id,
                    'kode'         => uniqid('KODE'),
                    'status'       => 'aktif'
                ];
                $this->db->insert('detail_pemesanan', $detail);
            }
        }
    
        // --- Redirect ke halaman pembayaran ---
        redirect('user/pembayaran/detail/'.$pemesanan_id);
    }
    
}
