<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth'); 
        }
        
    }

    public function index()
    {
        $this->pembayaran();
    }

    public function pembayaran()
    {
        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
    
        $this->db->select('p.*, 
                           u.name as nama_user, u.nik as nik_user, u.no_telp, 
                           j.stasiun_awal, j.stasiun_akhir, j.jam_berangkat, j.jam_sampai, 
                           k.nama as nama_kereta');
        $this->db->from('pemesanan p');
        $this->db->join('users u', 'u.id_user = p.user_id');
        $this->db->join('jadwal j', 'j.jadwal_id = p.jadwal_id');
        $this->db->join('kereta k', 'k.kereta_id = j.kereta_id');
    
        // filter tanggal berdasarkan jam berangkat
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('DATE(j.jam_berangkat) >=', $tgl_awal);
            $this->db->where('DATE(j.jam_berangkat) <=', $tgl_akhir);
        }

        // urutkan berdasarkan jadwal keberangkatan
        $this->db->order_by('j.jam_berangkat', 'DESC');
    
        $laporan = $this->db->get()->result();

        // ambil penumpang per pemesanan
        foreach ($laporan as &$l) {
            $this->db->select('penumpang.*');
            $this->db->from('detail_pemesanan dp');
            $this->db->join('penumpang', 'penumpang.penumpang_id = dp.penumpang_id');
            $this->db->where('dp.pemesanan_id', $l->pemesanan_id);
            $l->penumpang = $this->db->get()->result();
        }
    
        $data = [
            'judul_halaman' => "Laporan Pembayaran",
            'laporan'       => $laporan,
            'tgl_awal'      => $tgl_awal,
            'tgl_akhir'     => $tgl_akhir,
        ];
    
        $this->load->view('admin/laporan_pembayaran', $data);
    }
}
