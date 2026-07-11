<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'user') {
            redirect('auth'); 
        }
        $this->load->database();
        $this->load->helper(['url','form']);
        $this->load->library('session');
    }

    // Daftar semua pemesanan milik user yang login
    public function index() {
        $user_id = $this->session->userdata('id_user');

        $this->db->select('pemesanan.*, jadwal.stasiun_awal, jadwal.stasiun_akhir, 
                           jadwal.jam_berangkat, jadwal.jam_sampai,
                           kereta.nama as nama_kereta');
        $this->db->from('pemesanan');
        $this->db->join('jadwal', 'jadwal.jadwal_id = pemesanan.jadwal_id', 'left');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $this->db->where('pemesanan.user_id', $user_id);
        $pemesanan = $this->db->get()->result(); // pakai object

        $data = [
            'judul_halaman' => "Pembayaran Saya",
            'pemesanan'     => $pemesanan
        ];

        $this->load->view('user/pembayaran', $data);
    }

    // Detail satu pemesanan
    public function detail($id_pemesanan)
    {
        // Ambil data pemesanan + jadwal + kereta
        $pemesanan = $this->db->select('p.*, j.jam_berangkat, j.jam_sampai, j.stasiun_awal, j.stasiun_akhir, j.harga, k.nama as nama_kereta')
                              ->from('pemesanan p')
                              ->join('jadwal j', 'p.jadwal_id = j.jadwal_id')
                              ->join('kereta k', 'j.kereta_id = k.kereta_id')
                              ->where('p.pemesanan_id', $id_pemesanan)
                              ->get()
                              ->row();

        // Ambil daftar penumpang lewat detail_pemesanan
        $penumpang = $this->db->select('penumpang.*')
                              ->from('detail_pemesanan dp')
                              ->join('penumpang', 'dp.penumpang_id = penumpang.penumpang_id')
                              ->where('dp.pemesanan_id', $id_pemesanan)
                              ->get()
                              ->result();

        if (!$pemesanan) {
            show_404();
        }

        $data = [
            'judul_halaman' => "Pembayaran Saya",
            'pemesanan' => $pemesanan,
            'penumpang' => $penumpang
        ];

        $this->load->view('user/pembayaran_detail', $data);
    }


    // Proses upload bukti pembayaran
    public function proses_bayar()
    {
        $id_pemesanan = $this->input->post('id_pemesanan');
        $metode = $this->input->post('metode_pembayaran');
    
        // Upload bukti pembayaran
        $config['upload_path']   = 'assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $this->session->set_flashdata('alert',
                '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
            redirect('user/pembayaran/detail/'.$id_pemesanan);
        } else {
            $upload_data = $this->upload->data();
            $bukti = $upload_data['file_name'];
    
            // update pemesanan
            $data = [
                'metode_pembayaran' => $metode,
                'bukti_pembayaran'  => $bukti,
                'status_pembayaran' => 'menunggu_konfirmasi' // <== ini kuncinya
            ];
            $this->db->where('pemesanan_id', $id_pemesanan);
            $this->db->update('pemesanan', $data);
    
            $this->session->set_flashdata('alert',
                '<div class="alert alert-success">Bukti pembayaran berhasil diupload, tunggu konfirmasi admin.</div>');
            redirect('user/pembayaran/detail/'.$id_pemesanan);
        }
    }
    
}
