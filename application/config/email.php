<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';  // Ubah sesuai penyedia SMTP
$config['smtp_user'] = 'Youremail@gmail.com';  // Email Anda
$config['smtp_pass'] = 'Password Aplication';  // Password email Anda
$config['smtp_port'] = 587;  // Port untuk Gmail (587 atau 465)
$config['smtp_crypto'] = 'tls';  // Gunakan 'ssl' jika perlu
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
