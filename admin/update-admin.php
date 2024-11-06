<?php
require_once '../koneksi.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$IdAdmin = $_POST['IdAdmin'];


if(isset($_POST['ubah'])) {

  // cek pw
  if ($pass1 == $pass2){
      $query = "UPDATE tbl_admin SET nama='$nama', email='$email', telepon='$telepon' WHERE id_admin='$IdAdmin'";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
         header('Location:daftar-admin.php?pesan=sukses');
      } 
      else {
         header('Location:daftar-admin.php?pesan=gagal');
      } 
  }
  else {
   header('Location:daftar-admin.php?pesan=sama');
  }
} 
else {
   header('Location:daftar-admin.php?pesan=lengkapi');
}