<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('./auth/login'); // Arahkan ke halaman login jika belum login
        }
    }

    // Menampilkan data pengguna di dashboard
    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('dashboard/index', $data);
    }

    // Reset password pengguna ke password default
    public function reset_password($user_id) {
        $default_password = password_hash('Default123', PASSWORD_DEFAULT);

        if ($this->User_model->reset_user_password($user_id, $default_password)) {
            $this->session->set_flashdata('message', 'Password berhasil di-reset ke default.');
        } else {
            $this->session->set_flashdata('message', 'Gagal reset password.');
        }
        redirect('dashboard');
    }
}
