<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->library(['form_validation', 'email']);
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    // Form Register
    public function register() {
        // $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
        // $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        // $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_check');
        // $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        // $this->form_validation->set_rules('phone', 'Nomor Telephone', 'required');

        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|callback_check_phone_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_path/front_head');
            $this->load->view('Auth/register');
            $this->load->view('_path/front_foot');

        } else {
            $data = [
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'phone' => $this->input->post('phone'),
                'is_active' => 0,
                'activation_code' => md5(rand())
            ];

            $insert_id = $this->User_model->insert_user($data);

            if ($insert_id) {
                $this->_send_email($data['email'], $data['activation_code']);
                $this->session->set_flashdata('message', 'Registrasi berhasil, silakan cek email untuk aktivasi akun.');
                redirect('auth/login');
            }
        }
    }

    public function password_check($str) {
        if (!preg_match('/^[A-Z].*[0-9]/', $str)) {
            $this->form_validation->set_message('password_check', 'Password harus dimulai dengan huruf kapital dan mengandung angka.');
            return FALSE;
        }
        return TRUE;
    }

        // Callback untuk memeriksa ketersediaan email
    public function check_email_exists($email)
    {
        $this->load->model('User_model');
        if ($this->User_model->email_exists($email)) {
            $this->form_validation->set_message('check_email_exists', 'Email ini sudah terdaftar, gunakan email lain.');
            return FALSE;
        }
        return TRUE;
    }

    // Callback untuk memeriksa ketersediaan nomor telepon
    public function check_phone_exists($phone)
    {
        $this->load->model('User_model');
        if ($this->User_model->phone_exists($phone)) {
            $this->form_validation->set_message('check_phone_exists', 'Nomor telepon ini sudah terdaftar, gunakan nomor lain.');
            return FALSE;
        }
        return TRUE;
    }

    // Callback untuk memeriksa ketersediaan username
    public function check_username_exists($username)
    {
        $this->load->model('User_model');
        if ($this->User_model->username_exists($username)) {
            $this->form_validation->set_message('check_username_exists', 'Username ini sudah digunakan, pilih username lain.');
            return FALSE;
        }
        return TRUE;
    }


    private function _send_email($email, $activation_code) {
        // Tentukan path ke template HTML
        $path = APPPATH . 'views/templates/message.html';
    
        // Muat template HTML
        $message = file_get_contents($path);
    
        // Buat link aktivasi
        $activation_link = base_url("auth/activate/" . $activation_code);
    
        // Ganti placeholder dengan link aktivasi di dalam template
        $message = str_replace('{{activation_link}}', $activation_link, $message);
    
        // Konfigurasi email
        $this->email->from('hagiihsan27@gmail.com', 'Admin');
        $this->email->to($email);
        $this->email->subject('Aktivasi Akun');
        $this->email->message($message);
    
        // Kirim email
        $this->email->send();
    }
    

    public function activate($activation_code) {
        $user = $this->User_model->get_user_by_code($activation_code);
        if ($user) {
            $this->User_model->activate_user($user->id);
            $this->session->set_flashdata('message', 'Akun Anda berhasil diaktifkan, silakan login.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('message', 'Kode aktivasi tidak valid.');
            redirect('auth/register');
        }
    }


    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_path/front_head');
            $this->load->view('auth/login');
            $this->load->view('_path/front_foot');
        } else {
            $user = $this->User_model->check_login($this->input->post('username'), $this->input->post('password'));

            if ($user && $user->is_active) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'logged_in' => TRUE
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', 'Username atau password salah, atau akun belum diaktifkan.');
                redirect('auth/login');
            }
            
        }
    }

    public function reset_password_form($token) {
        $user = $this->User_model->get_user_by_token($token);
    
        if ($user) {
            $data['token'] = $token;
            $this->load->view('_path/front_head');
            $this->load->view('auth/reset_password_form', $data);
            $this->load->view('_path/front_foot');
        } else {
            $this->session->set_flashdata('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
            redirect('auth/forgot_password');
        }
    }

    public function save_new_password() {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        // $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
    
        if ($this->form_validation->run() == FALSE) {
            $data['token'] = $this->input->post('token');
            $this->load->view('auth/reset_password_form', $data);
        } else {
            $token = $this->input->post('token');
            $new_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    
            if ($this->User_model->update_password($token, $new_password)) {
                $this->session->set_flashdata('message', 'Password berhasil diubah. Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Token tidak valid atau sudah kedaluwarsa.');
                redirect('auth/forgot_password');
            }
        }
    }
    
    
    public function forgot_password() {
        // Validasi email
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_path/front_head');
            $this->load->view('auth/forgot_password');
            $this->load->view('_path/front_foot');

        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_user_by_email($email);
    
            if ($user) {
                // Buat token untuk reset password
                $token = bin2hex(random_bytes(50));
                $this->User_model->save_password_reset_token($user->id, $token);
    
                // Kirim email reset password
                $this->_send_reset_email($email, $token);
                $this->session->set_flashdata('message', 'Email reset password telah dikirim. Periksa kotak masuk Anda.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar.');
                redirect('auth/forgot_password');
            }
        }
    }

    
    private function _send_reset_email($email, $token) {
        // Muat template email reset password
        $path = APPPATH . 'views/templates/reset-password.html';
        $message = file_get_contents($path);
    
        // Buat link reset password
        $reset_link = base_url("auth/reset_password_form/" . $token);
    
        // Ganti placeholder dengan link reset password di dalam template
        $message = str_replace('{{reset_link}}', $reset_link, $message);
    
        // Konfigurasi email
        $this->email->from('hagiihsan27@gmail.com', 'Admin');
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $this->email->message($message);
    
        // Kirim email
        $this->email->send();
    }
    

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('auth/login');
    }
    
}
