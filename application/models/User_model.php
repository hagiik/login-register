<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function insert_user($data) {
        return $this->db->insert('users', $data) ? $this->db->insert_id() : false;
    }

    public function get_user_by_code($activation_code) {
        return $this->db->get_where('users', ['activation_code' => $activation_code, 'is_active' => 0])->row();
    }

    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');  // Pastikan nama tabel benar
        return $query->num_rows() > 0;
    }

    // Memeriksa apakah nomor telepon sudah ada
    public function phone_exists($phone)
    {
        $this->db->where('phone', $phone);
        $query = $this->db->get('users');  // Pastikan nama tabel benar
        return $query->num_rows() > 0;
    }

    // Memeriksa apakah username sudah ada
    public function username_exists($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');  // Pastikan nama tabel benar
        return $query->num_rows() > 0;
    }

    public function activate_user($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['is_active' => 1, 'activation_code' => NULL]);
    }

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row();
    
        // Pastikan user ditemukan dan password cocok
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

     // Mendapatkan pengguna berdasarkan email
     public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function get_user_by_id($user_id) {
        // Pastikan hasil query berupa objek
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }
    

    // Menyimpan token reset password
    public function save_password_reset_token($user_id, $token) {
        $data = array(
            'reset_token' => $token,
            'reset_token_expiry' => date('Y-m-d H:i:s', strtotime('+1 hour')) // Token berlaku 1 jam
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    // Mendapatkan pengguna berdasarkan token
    public function get_user_by_token($token) {
        $this->db->where('reset_token', $token);
        $this->db->where('reset_token_expiry >', date('Y-m-d H:i:s')); // Token belum kedaluwarsa
        return $this->db->get('users')->row();
    }

    // Memperbarui password pengguna
    public function update_password($token, $new_password) {
        $this->db->where('reset_token', $token);
        $this->db->update('users', [
            'password' => $new_password,
            'reset_token' => NULL,
            'reset_token_expiry' => NULL
        ]);
        return $this->db->affected_rows() > 0;
    }

    // Mendapatkan semua data pengguna
    public function get_all_users() {
        return $this->db->get('users')->result(); // Pastikan tabelnya benar, misalnya 'users'
    }

    // Reset password pengguna
    public function reset_user_password($user_id, $new_password) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', array('password' => $new_password));
    }
}
