<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('template');
    }

    public function cari()
    {
        $asal    = $this->input->get('asal');
        $tujuan  = $this->input->get('tujuan');
        $tanggal = $this->input->get('tanggal');
        $sort    = $this->input->get('sort'); // ambil parameter sort
    
        $this->db->select('jadwal.*, kereta.nama as nama_kereta, gerbong.nama_kode as nama_gerbong, gerbong.jumlah_kursi');
        $this->db->from('jadwal');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $this->db->join('gerbong', 'gerbong.kereta_id = kereta.kereta_id', 'left');
    
        // filter asal
        if (!empty($asal)) {
            $this->db->where('stasiun_awal', $asal);
        }
        // filter tujuan
        if (!empty($tujuan)) {
            $this->db->where('stasiun_akhir', $tujuan);
        }
        // filter tanggal
        if (!empty($tanggal)) {
            $this->db->where('DATE(jam_berangkat)', $tanggal);
        }
    
        // urutkan hasil
        if (!empty($sort)) {
            switch ($sort) {
                case 'gerbong':
                    $this->db->order_by('gerbong.nama_kode', 'ASC');
                    break;
                case 'stasiun_awal':
                    $this->db->order_by('stasiun_awal', 'ASC');
                    break;
                case 'stasiun_akhir':
                    $this->db->order_by('stasiun_akhir', 'ASC');
                    break;
                case 'nama_kereta':
                    $this->db->order_by('nama_kereta', 'ASC');
                    break;
                case 'jam_berangkat':
                    $this->db->order_by('jam_berangkat', 'ASC');
                    break;
                case 'harga':
                    $this->db->order_by('harga', 'ASC');
                    break;
            }
        } else {
            // default: urutkan berdasarkan jam berangkat
            $this->db->order_by('jam_berangkat', 'ASC');
        }
    
        $jadwal = $this->db->get()->result_array();
    
        $data = [
            'judul_halaman' => 'Hasil Pencarian Jadwal',
            'jadwal'        => $jadwal
        ];
        $this->load->view('user/hasil_pencarian', $data);
    }
    
    
}
