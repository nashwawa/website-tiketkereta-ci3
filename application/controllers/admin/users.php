<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index() {
        $this->db->from('users');
        $this->db->order_by('name', 'ASC');
        $user = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Data User',
            'user' => $user
        );
        $this->template->load('template', 'admin/data_user', $data);
    }

    public function simpan() {
        // cek username sudah ada
        $this->db->where('name', $this->input->post('name'));
        $cek = $this->db->get('users')->row();
        if ($cek) {
            $this->session->set_flashdata('alert','Kereta sudah ada.');
        } else {
            $data = [
                'name'     => $this->input->post('name'),
                'password' => md5($this->input->post('password')),
                'nik'      => $this->input->post('nik'),
                'no_telp'  => $this->input->post('no_telp'),
                'role'     => $this->input->post('role'),
            ];
            $this->db->insert('users', $data);
            $this->session->set_flashdata('alert','Berhasil menambahkan Kereta.');
        }
        redirect('admin/users');
    }

    public function delete_data($id) {
        $this->db->delete('users', ['id_user' => $id]);
        $this->session->set_flashdata('alert','Berhasil menghapus Kereta.');
        redirect('admin/users');
    }

    public function edit($id_user) {
        $user = $this->db->get_where('users', ['id_user' => $id])->row();
        $data = array(
            'judul_halaman' => 'Edit Data User',
            'user' => $user
        );
        $this->template->load('template', 'admin/data_user_edit', $data);
    }

    public function update() {
        $id       = $this->input->post('id_user');
        $name     = $this->input->post('name');
        $password = $this->input->post('password');
        $nik      = $this->input->post('nik');
        $no_telp  = $this->input->post('no_telp');
        $role     = $this->input->post('role');
        $user_lama = $this->db->get_where('users', ['id_user' => $id])->row();
        $password_hash = !empty($password) ? md5($password) : $user_lama->password;

        $data = [
            'nama'     => $nama,
            'password' => $password_hash,
            'nik'      => $nik,
            'no_telp'  => $no_telp,
            'role'     => $role
        ];

        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
        $this->session->set_flashdata('alert','Berhasil mengupdate Kereta.');
        redirect('admin/users');
    }
}
