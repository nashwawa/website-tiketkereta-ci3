<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role')<>'admin'){
            redirect('beranda');
        }

        // Pastikan memuat library template
        $this->load->library('template'); // <-- ini wajib
    }

    public function index() {
        $data = array(
            'judul_halaman'   => 'Dashboard',

        );
        $this->template->load('template', 'beranda', $data); 
    }
}
