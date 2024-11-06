<?php
include "koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_kegiatan where id_kegiatan='$id'");
  if ($data){
    header('Location:daftar-kegiatan.php?pesan=hapus');
  }
  ?>