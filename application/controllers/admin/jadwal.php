<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function index() {
        // Ambil jadwal
        $this->db->select('jadwal.*, kereta.nama as nama_kereta');
        $this->db->from('jadwal');
        $this->db->join('kereta', 'kereta.kereta_id = jadwal.kereta_id', 'left');
        $jadwal = $this->db->get()->result_array();
    
        // Ambil stasiun unik
        $stasiun_awal  = $this->db->query("SELECT DISTINCT stasiun_awal FROM jadwal")->result();
        $stasiun_akhir = $this->db->query("SELECT DISTINCT stasiun_akhir FROM jadwal")->result();
        $kereta = $this->db->get('kereta')->result();
    
        $data = [
            'judul_halaman' => 'Cari Jadwal',
            'jadwal'        => $jadwal,
            'stasiun_awal'  => $stasiun_awal,
            'stasiun_akhir' => $stasiun_akhir,
            'kereta'        => $kereta
        ];
        $this->template->load('template', 'admin/data_jadwal', $data);
    }
    

    public function simpan() {
        $data = [
            'kereta_id'     => $this->input->post('kereta_id'),
            'jam_berangkat' => $this->input->post('jam_berangkat'),
            'jam_sampai'    => $this->input->post('jam_sampai'),
            'stasiun_awal'  => $this->input->post('stasiun_awal'),
            'stasiun_akhir' => $this->input->post('stasiun_akhir'),
            'harga'         => $this->input->post('harga')
        ];
        $this->db->insert('jadwal', $data);

        $this->session->set_flashdata('alert','Berhasil menginput jadwal.');
        redirect('admin/jadwal');
    }

    public function delete_data($id) {
        $this->db->delete('jadwal', ['jadwal_id' => $id]);
        $this->session->set_flashdata('alert',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 15px;">
                Jadwal berhasil dihapus.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>'
        );
        redirect('admin/jadwal');
    }

    public function edit($id) {
        $jadwal = $this->db->get_where('jadwal', ['jadwal_id' => $id])->row();
        $kereta = $this->db->get('kereta')->result(); // untuk dropdown pilih kereta
        $data = array(
            'judul_halaman' => 'Edit Jadwal',
            'jadwal' => $jadwal,
            'kereta' => $kereta
        );
        $this->template->load('template', 'admin/data_jadwal_edit', $data);
    }

    public function update() {
        $id = $this->input->post('jadwal_id');
        $data = [
            'kereta_id'     => $this->input->post('kereta_id'),
            'jam_berangkat' => $this->input->post('jam_berangkat'),
            'jam_sampai'    => $this->input->post('jam_sampai'),
            'stasiun_awal'  => $this->input->post('stasiun_awal'),
            'stasiun_akhir' => $this->input->post('stasiun_akhir'),
            'harga'         => $this->input->post('harga')
        ];

        $this->db->where('jadwal_id', $id);
        $this->db->update('jadwal', $data);

        $this->session->set_flashdata('alert',
            '<div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 15px;">
                Data jadwal berhasil diupdate.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>'
        );
        redirect('admin/jadwal');
    }
   
    
}
