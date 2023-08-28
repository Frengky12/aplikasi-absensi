<?php
error_reporting(1); // mematikan pesan error


session_start();
// jika berhasil login
if (isset($_SESSION['login']) == true) {
    $id        = $_SESSION["id"];
    $nama      = $_SESSION["nama"];
    $username  = $_SESSION["username"];
    $level     = $_SESSION["level"];
}

require_once 'control.php'; 
require_once 'koneksi.php'; 