<?php 
session_start();

// cek apakah yang mengakses halaman ini sudah login
if(empty($_SESSION['email'])){
    header("location:login.php?pesan=no");
    exit();
}

if(empty($_GET['msg'])){
    header("location:create-kegiatan.php");
    exit();
}

include "koneksi.php";
$page = "Buat";

// Ambil data dari tabel kegiatan
$data = mysqli_query($koneksi,"SELECT * FROM tbl_kegiatan ORDER BY id_kegiatan DESC LIMIT 1");
if (!$data || mysqli_num_rows($data) == 0) {
    echo "Data tidak ditemukan.";
    exit();
}
$row = mysqli_fetch_array($data);

// Mendekode data yang diserialisasi
$bukti_kegiatan = unserialize($row['bukti_kegiatan']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo bawaslu.png" rel="icon">
  <title>BawasluDoc - Konfirmasi Kirim</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon"></div>
        <div class="sidebar-brand-text mx-3">BawasluDoc</div>
      </a>

      <?php include "menu.php"; ?>

      <hr class="sidebar-divider">
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['nama']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <h1 class="h3 mb-0 text-gray-800">Konfirmasi Kirim kegiatan</h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                <?php
                  if(isset($_GET['msg'])){
                    if($_GET['msg'] == "gagal"){
                     echo "<div class='alert alert-danger' role='alert'>
                            Data gagal disimpan. Pastikan anda sudah mengisinya dengan benar.
                          </div>";
                    }
                    else if($_GET['msg'] == "sukses"){
                      echo "<div class='alert alert-success' role='alert'>
                            Data berhasil dikirim. <a class='text-dark' href='daftar-kegiatan.php'><b>Cek Daftar kegiatan</b></a>
                           </div>";                   
                    }
                    else if($_GET['msg'] == "ekstensi"){
                      echo "<div class='alert alert-danger' role='alert'>
                            Format gambar hanya .PNG, .JPEG, .JPG dan .BMP
                           </div>";                   
                    }
                    else if($_GET['msg'] == "lengkapi"){
                      echo "<div class='alert alert-danger' role='alert'>
                           Pastikan anda sudah mengisi data dengan lengkap.
                           </div>";                   
                    }
                    else if($_GET['msg'] == "konfirmasi"){
                      echo "<div class='alert alert-warning' role='alert'>
                           Pastikan anda sudah mengisi data dengan lengkap. Lalu klik tombol Kirim untuk mengirim laporan.
                           </div>";                   
                    }
                    else if($_GET['msg'] == "berhasil"){
                      echo "<div class='alert alert-success' role='alert'>
                          Kirim kegiatan berhasil.
                           </div>";                   
                    }
                  }
                ?>

                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Tanggal kegiatan </label>
                      </div>
                      <div class="col-lg-7">
                       <label class="text-default"><?php echo tgl_indo($row['tgl_kegiatan']);?> </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Subjek kegiatan </label>
                      </div>
                      <div class="col-lg-7">
                       <input type="text" class="form-control" value="<?php echo $row['subjek_kegiatan'];?>" readonly>
                    </div>
                    </div>

                    <div class="form-group row">
                     <div class="col-lg-3">
                      <label class="text-primary">Tempat kegiatan </label>
                    </div>
                     <div class="col-lg-7">
                      <textarea name="tempat" class="form-control" readonly><?php echo $row['tempat_kegiatan'];?></textarea>
                     </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                       <label for="subjek" class="text-primary">Bukti Dokumen</label>
                      </div>
                      <div class="col-lg-7">
                       <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn"><?php echo $row['bukti_kegiatan'];?></button>
                        <!-- Modal Bukti -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bukti kegiatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
    <p class="text-center">
        <?php 
        // Pastikan bahwa $row['bukti_kegiatan'] memiliki nilai yang benar
        if (!empty($bukti_kegiatan)) {
            foreach ($bukti_kegiatan as $gambar) {
                // Buat path ke gambar
                $image_path = "buktifoto/images/" . $gambar;

                // Tampilkan gambar
                echo "<img src='$image_path' width='400' height='240' style='margin-bottom: 10px;'>";

                // Cetak path gambar untuk debugging
                echo "<p>Path Gambar: $image_path</p>";
            }
        } else {
            echo "Gambar tidak ditemukan.";
        }
        ?>
    </p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
</div>
<br>
<div class="form-group">
<a href="daftar-kegiatan.php?id=<?php echo $row['id_kegiatan']; ?>" class="btn btn-primary">Kembali</a>
</div>
<br><br>
</form>
</div>
</div>
</div>
</div>
<!--Row-->
</div>
<!---Container Fluid-->
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> -  by
              <b><a href="">Bawaslu</a></b>
            </span>
          </div>
        </div>
      </footer>
<!-- Footer -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>

</html>
