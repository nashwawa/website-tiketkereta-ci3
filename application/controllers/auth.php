<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {                        
        $this->load->view('login');
    }

    public function login() {
        $name     = $this->input->post('name', true);
        $password = md5($this->input->post('password', true)); // cek pakai md5

        // Ambil data dari database
        $cek = $this->db->where('LOWER(name)', strtolower($name))->get('users')->row();

        if (!$cek) {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert"><span>×</span></button>
                        Username tidak ditemukan.
                    </div>
                </div>
            ');
            redirect('auth');
        }

        // cek password (md5)
        if ($password === $cek->password) {
            $data = array(
                'id_user'   => $cek->id_user,
                'name'      => $cek->name,
                'role'      => strtolower($cek->role),
            );
            $this->session->set_userdata($data);
        
            // arahkan sesuai role
            if ($data['role'] === 'admin') {
                redirect('beranda');
            } else if ($data['role'] === 'user') {
                redirect('home');
            } else {
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-dark alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert"><span>×</span></button>
                        Password salah.
                    </div>
                </div>
            ');
            redirect('auth');
        }
    }
    public function register() {
        if ($this->input->method() == 'post') {
            $name     = $this->input->post('name', true);
            $password = md5($this->input->post('password', true));
            $role     = "user"; // default role
    
            // cek apakah username sudah dipakai
            $cekUser = $this->db->get_where('users', ['name' => $name])->row();
            if ($cekUser) {
                $this->session->set_flashdata('notifikasi', '
                    <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>×</span></button>
                            Username sudah terdaftar, gunakan nama lain.
                        </div>
                    </div>
                ');
                redirect('auth/register');
            }
    
            // insert ke tabel users
            $data = [
                'name'     => $name,
                'nik' => $nik,
                'no_tlp' => $no_tlp,
                'password' => $password,
                'role'     => $role,
            ];
            $this->db->where('users', $data);
    
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-success alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert"><span>×</span></button>
                        Registrasi berhasil, silakan login.
                    </div>
                </div>
            ');
            redirect('auth');
        } else {
            $this->load->view('register');
        }
    }
    

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
