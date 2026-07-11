<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    
    public function __construct(){
        parent::__construct();
        $this->load->library('template');
        $this->load->database(); 
    }

    public function index()
    {
        // Hitung jumlah user
        $user = $this->db->get('users');

        // Ambil distinct stasiun awal dan akhir
        $stasiun_awal  = $this->db->distinct()->select('stasiun_awal')->from('jadwal')->get()->result();

        $stasiun_akhir = $this->db->distinct()->select('stasiun_akhir')->from('jadwal')->get()->result();

        $data = array(
            'judul_halaman'  => 'Dashboard Pengunjung',
            'user'           => $user->num_rows(),
            'stasiun_awal'   => $stasiun_awal,
            'stasiun_akhir'  => $stasiun_akhir
        );

        $this->template->load('templates', 'berandap', $data);
    }
}
