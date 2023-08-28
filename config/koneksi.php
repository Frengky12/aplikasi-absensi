<?php
// koneksi ke database
$host       = 'localhost';
$username   = 'root'; // username phpmyadmin
$password   = ''; // password phpmyadmin
$dbname     = 'aplikasi-absensi'; // nama database di phpmyadmin

// koneksi disimpan di $db
$db = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_connect_error());

// check koneksi database 
// if (!$db) {
//     echo 'koneksi gagal';
// } else {
//     echo 'koneksi berhasil';
// }