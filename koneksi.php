<?php
error_reporting(0);
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$nama_db = "traveler";
$koneksi = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);
if (!$koneksi)
    echo "koneksi gagal";
?>