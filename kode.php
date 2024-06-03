<?php
include ("koneksi.php");

session_start();
$err = "";
$username = "";

if (isset($_COOKIE['cookie_username'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_fullname = $_COOKIE['cookie_fullname'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "SELECT * FROM user WHERE name = ?"; // Ubah query agar sesuai dengan struktur tabel
    $stmt = $koneksi->prepare($sql1);
    $stmt->bind_param("s", $cookie_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $r1 = $result->fetch_assoc();

    if ($r1 && md5($r1['Password']) == $cookie_password) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_fullname'] = $cookie_fullname;
        $_SESSION['session_password'] = $cookie_password;
        header("location:asdwj.php");
        exit();
    }
}

if (isset($_SESSION['session_username'])) {
    $username = $_SESSION['session_username'];
    $sql1 = "SELECT * FROM user WHERE name = ?";
    $stmt = $koneksi->prepare($sql1);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $r1 = $result->fetch_assoc();
    if ($r1) {
        $fullname = $r1['fullname'];
    }
}

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "SELECT * FROM user WHERE name = ? and status = 'user'";
        $stmt = $koneksi->prepare($sql1);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $r1 = $result->fetch_assoc();

        if (!$r1) {
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        } elseif (md5($password) != $r1['Password']) {
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_fullname'] = $fullname;
            $_SESSION['session_password'] = md5($password);
            header("location:booking.php");
            exit();
        }
    }
}

if (isset($_POST['admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "SELECT * FROM user WHERE name = ? and status = 'admin'";
        $stmt = $koneksi->prepare($sql1);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $r1 = $result->fetch_assoc();

        if (!$r1) {
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        } elseif (md5($password) != $r1['Password']) {
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = md5($password);
            header("location:dashboard.php");
            exit();
        }
    }
}


function tambahHari($tanggal, $jumlahHari)
{
    return date('Y-m-d', strtotime($tanggal . ' + ' . $jumlahHari . ' days'));
}

if (isset($_POST['submit-book'])) {
    $destination = $_POST['destination'];
    $departure_date = $_POST['date_start_dep'];
    $days = (int) $_POST['date_start_ret'];

    // Query data destinasi berdasarkan provinsi yang dipilih
    $query3 = "SELECT * FROM tempat_wisata WHERE provinsi = ?";
    $stmt3 = $koneksi->prepare($query3);
    $stmt3->bind_param("s", $destination);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    if (!$result3) {
        die("Query error: " . $koneksi->error);
    }
}




?>