<?php
require_once 'koneksi.php';

$gambar = $_FILES['gambar']['name'];
$subjek = $_POST['subjek'];
$tempat = $_POST['tempat'];
$IdUser = $_POST['IdUser'];
$Idkegiatan = $_POST['Idkegiatan'];
$tglubah = $_POST['tglubah'];


if(isset($_POST['send'])) {
 
  $eks_dibolehkan = ['png', 'jpg', 'jpeg', 'bmp']; // ekstensi yang diperbolehkan
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // cek ekstensi yang dibolehkan
  if (empty($_FILES['gambar']['name']) && empty($_FILES['gambar']['tmp_name'])){
        // jalankan query insert
      $query = "UPDATE tbl_kegiatan SET subjek_kegiatan='$subjek', tempat_kegiatan='$tempat',tgl_kegiatan=now(), bukti_kegiatan=NULL, 
                id_user='$IdUser' WHERE id_kegiatan='$Idkegiatan'";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
      header('Location:daftar-kegiatan.php?pesan=sukses');
      } 
      else {
      header('Location:daftar-kegiatan.php?pesan=gagal');
      } 
  }
  else{
   if(in_array($ekstensi, $eks_dibolehkan) === true) {
      move_uploaded_file($file_tmp, 'buktifoto/' . $gambar); // memindahkan file gambar
   
      // jalankan query insert
      $query = "UPDATE tbl_kegiatan SET subjek_kegiatan='$subjek', tempat_kegiatan='$tempat',tgl_kegiatan=now(), bukti_kegiatan='$gambar', 
                id_user='$IdUser' WHERE id_kegiatan='$Idkegiatan'";
      $hasil = mysqli_query($koneksi, $query);

      if($hasil) {
         header('Location:daftar-kegiatan.php?pesan=sukses');
      } 
      else {
         header('Location:daftar-kegiatan.php?pesan=gagal');
      }
      } 
      else {
         header('Location:daftar-kegiatan.php?pesan=ekstensi');
      }
   }
} 
else {
   header('Location:daftar-kegiatan.php?pesan=lengkapi');
}