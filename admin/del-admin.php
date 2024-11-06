<?php
include "../koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_admin where id_admin='$id'");
  if ($data){
    header('Location:daftar-admin.php?pesan=hapus');
  }
  ?>