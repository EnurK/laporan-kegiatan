<?php
require_once '../koneksi.php';

$isitanggapan      = $_POST['isitanggapan'];
$IdAdmin           = $_POST['IdAdmin'];
$Idkegiatan  = $_POST['Idkegiatan'];
$status            = $_POST['status'];

if(isset($_POST['balas'])) {

  // cek form takut kosong
  if (!empty($isitanggapan) && !empty($IdAdmin) && !empty($Idkegiatan) && !empty($status))
  {
      $query = "INSERT INTO tbl_tanggapan (tgl_balas_tanggapan,status_tanggapan,isi_tanggapan,id_admin,id_kegiatan) 
               VALUES (now(),'$status','$isitanggapan','$IdAdmin','$Idkegiatan')";
      $hasil = mysqli_query($koneksi, $query);
      if($hasil) {
         header('Location:pesan-kegiatan.php?pesan=sukses');
      } 
      else {
         header('Location:pesan-kegiatan.php?pesan=gagal');
      } 
  }
  else {
   header('Location:pesan-kegiatan.php?pesan=sama');
  }
} 
else {
   header('Location:pesan-kegiatan.php?pesan=lengkapi');
}