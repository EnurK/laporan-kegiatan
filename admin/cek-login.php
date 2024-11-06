<?php 
// Mengaktifkan session pada PHP
session_start();

// Menghubungkan PHP dengan koneksi database
include_once '../koneksi.php';

// Menangkap data yang dikirim dari form login
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Menyeleksi data admin dengan email yang sesuai
$data = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE email='$email'");
$see = mysqli_fetch_assoc($data);

// Memeriksa jika data admin ditemukan dan password sesuai
if ($see && password_verify($_POST['password'], $see['password'])) {
    // Menyimpan data ke dalam session
    $_SESSION['email'] = $email;
    $_SESSION['nama'] = $see['nama'];
    $_SESSION['id_admin'] = $see['id_admin'];
    header("location:index.php");
    exit;
} else {
    // Redirect ke halaman login dengan pesan gagal
    header("location:login.php?pesan=gagal");
    exit;
}
?>
