<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerbong extends CI_Controller {

    public function index() {
        // Ambil data gerbong + join kereta
        $this->db->select('gerbong.*, kereta.nama as nama_kereta');
        $this->db->from('gerbong');
        $this->db->join('kereta', 'kereta.kereta_id = gerbong.kereta_id', 'left');
        $gerbong = $this->db->get()->result_array();

        // Ambil data kereta untuk dropdown
        $kereta = $this->db->get('kereta')->result();

        $data = array(
            'judul_halaman' => 'Data Gerbong',
            'gerbong'       => $gerbong,
            'kereta'        => $kereta
        );
        $this->template->load('template', 'admin/data_gerbong', $data);
    }

    public function simpan() {
        $data = [
            'kereta_id'    => $this->input->post('kereta_id'),
            'nama_kode'    => $this->input->post('nama_kode'),
            'jumlah_kursi' => $this->input->post('jumlah_kursi')
        ];
        $this->db->insert('gerbong', $data);

        $this->session->set_flashdata('alert',' Berhasil ditambahkan Kereta.');
        redirect('admin/gerbong');
    }

    public function delete_data($id) {
        $this->db->delete('gerbong', ['gerbong_id' => $id]);
        $this->session->set_flashdata('alert','Berhasil menghapus Kereta.');
        redirect('admin/gerbong');
    }

    public function edit($id) {
        $gerbong = $this->db->get_where('gerbong', ['gerbong_id' => $id])->row();
        $kereta = $this->db->get('kereta')->result(); // untuk dropdown pilih kereta
        $data = array(
            'judul_halaman' => 'Edit Gerbong',
            'gerbong' => $gerbong,
            'kereta' => $kereta
        );
        $this->template->load('template', 'admin/data_gerbong_edit', $data);
    }

    public function update() {
        $id = $this->input->post('gerbong_id');
        $data = [
            'kereta_id'    => $this->input->post('kereta_id'),
            'nama_kode'    => $this->input->post('nama_kode'),
            'jumlah_kursi' => $this->input->post('jumlah_kursi')
        ];

        $this->db->where('gerbong_id', $id);
        $this->db->update('gerbong', $data);

        $this->session->set_flashdata('alert','Berhasil mengupdate Kereta.');
        redirect('admin/gerbong');
    }
}
