<?php
require_once '../koneksi.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$IdAdmin = $_POST['IdAdmin'];
$pass1 = md5($_POST['password1']);
$pass2 = md5($_POST['password2']);


if(isset($_POST['send'])) {

  // cek pw
  if ($pass1 == $pass2){
      $query = "UPDATE tbl_admin SET nama='$nama', telepon='$telepon', password='$pass1' WHERE id_admin='$IdAdmin'";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
         header('Location:ubah-akun.php?pesan=sukses');
      } 
      else {
         header('Location:ubah-akun.php?pesan=gagal');
      } 
  }
  else {
   header('Location:ubah-akun.php?pesan=sama');
  }
} 
else {
   header('Location:ubah-akun.php?pesan=lengkapi');
}