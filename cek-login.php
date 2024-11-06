<?php 
// Mengaktifkan session pada PHP
session_start();

// Menghubungkan PHP dengan koneksi database
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Menyeleksi data admin dengan email yang sesuai
$query = $koneksi->prepare("SELECT * FROM tbl_user WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Jika login berhasil
    $_SESSION['email'] = $user['email'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['id_user'] = $user['id_user'];
    header("location:index.php");
} else {
    // Jika login gagal
    header("location:login.php?pesan=gagal");
}
?>
