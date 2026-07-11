<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kereta extends CI_Controller {

    public function index() {
        $this->db->from('kereta');
        $this->db->order_by('nama', 'ASC');
        $kereta = $this->db->get()->result_array();
        $data = array(
            'judul_halaman' => 'Data Kereta',
            'kereta' => $kereta
        );
        $this->template->load('template', 'admin/data_kereta', $data);
    }

    public function simpan() {
        // cek apakah nama kereta sudah ada
        $this->db->where('nama', $this->input->post('nama'));
        $cek = $this->db->get('kereta')->row();

        if ($cek) {
            $this->session->set_flashdata('alert','Kereta sudah ada.');
        } else {
            $data = [
                'nama'           => $this->input->post('nama'),   
                'jumlah_gerbong' => $this->input->post('jumlah_gerbong'),
            ];
            $this->db->insert('kereta', $data);
            $this->session->set_flashdata('alert','Berhasil menambahkan Kereta.');
        }
        redirect('admin/kereta');
    }

    public function delete_data($id) {
        $this->db->delete('kereta', ['kereta_id' => $id]);
        $this->session->set_flashdata('alert','Berhasil menghapus Kereta.');
        redirect('admin/kereta');
    }

    public function update() {
        $id             = $this->input->post('kereta_id');
        $nama           = $this->input->post('nama');
        $jumlah_gerbong = $this->input->post('jumlah_gerbong');

        $data = [
            'nama'           => $nama,
            'jumlah_gerbong' => $jumlah_gerbong
        ];

        $this->db->where('kereta_id', $id);
        $this->db->update('kereta', $data);
        $this->session->set_flashdata('alert','Berhasil mengupdate Kereta.');
        redirect('admin/kereta');
    }
    public function edit($id) {
        $kereta = $this->db->get_where('kereta', ['kereta_id' => $id])->row();
        $data = array(
            'judul_halaman' => 'Edit Data Kereta',
            'kereta' => $kereta
        );
        $this->template->load('template', 'admin/data_kereta_edit', $data);
    }
}
