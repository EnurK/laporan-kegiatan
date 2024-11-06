<?php
include "../koneksi.php";
  $id = $_GET['id'];
  $data = mysqli_query($koneksi,"DELETE from tbl_user where id_user='$id'");
  if ($data){
    header('Location:daftar-user.php?pesan=hapus');
  }
  ?>