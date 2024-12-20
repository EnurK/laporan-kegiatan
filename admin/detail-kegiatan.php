<?php 
  session_start();

  // cek apakah yang mengakses halaman ini sudah login
  if ($_SESSION == "") {
    header("location:login.php?pesan=daftar");
  }
  $page = "kegiatan";
  include '../koneksi.php';

  $id = $_GET['id'];
  $data = mysqli_query($koneksi, "SELECT * FROM tbl_kegiatan JOIN tbl_user USING (id_user) WHERE id_kegiatan='$id'");
  $row = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/logo bawaslu.png" rel="icon">
  <title>BawasluDoc - Detail kegiatan</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

  <!-- Data Table -->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
       
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
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="../img/boy.png" style="max-width: 60px">
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
            <h1 class="h3 mb-0 text-gray-800">Detail kegiatan <?php echo $row['subjek_kegiatan'];?></h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                  <form action="add-kegiatan.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <a class='btn btn-sm btn-danger' href='daftar-kegiatan.php'> Kembali </a>
                      <hr>
                      <h5 class="text-secondary"><b>Kegiatan</b></h5>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Pengirim</label>
                      </div>
                      <div class="col-lg-7">
                        <label class="text-default"><?php echo $row['nama']; ?> (<?php echo $row['kecamatan']; ?>)</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="tgl" class="text-primary">Tanggal kegiatan</label>
                      </div>
                      <div class="col-lg-7">
                        <label class="text-default"><?php echo tgl_indo($row['tgl_kegiatan']); ?></label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="subjek" class="text-primary">Subjek Kegiatan</label>
                      </div>
                      <div class="col-lg-7">
                        <label class="text-default"><?php echo $row['subjek_kegiatan']; ?></label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="subjek" class="text-primary">Tempat Kegiatan</label>
                      </div>
                      <div class="col-lg-7">
                        <textarea class="form-control" readonly><?php echo $row['tempat_kegiatan']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-3">
                        <label for="subjek" class="text-primary">Bukti Dokumen</label>
                      </div>
                      <div class="col-lg-7">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#exampleModal" id="#myBtn">Lihat Bukti</button>
                       <!-- Modal Bukti -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Bukti kegiatan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">
                            <?php
                            // Unserialize data bukti kegiatan
                            $buktiKegiatan = unserialize($row['bukti_kegiatan']);

                            // Cek apakah unserialize berhasil
                            if ($buktiKegiatan !== false && is_array($buktiKegiatan)) {
                                foreach ($buktiKegiatan as $fileName) {
                                    // Jalur file (sesuaikan jika diperlukan)
                                    $imagePath = "../buktifoto/images/$fileName";

                                    // Tampilkan gambar jika file ada
                                    if (file_exists($imagePath)) {
                                        echo "<img src='$imagePath' alt='$fileName' style='max-width: 400px; max-height: 240px; margin: 10px;'><br>";
                                    } else {
                                        echo "<p>File tidak ditemukan: $imagePath</p>";
                                    }
                                }
                            } else {
                                echo "<p>Tidak ada bukti kegiatan yang valid ditemukan.</p>";
                            }
                          ?>
                              <br>
                              <a href="<?php echo $imagePath; ?>" class="btn btn-primary mt-3" download>Download Bukti</a>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      </div>
                    </div>

                    <hr>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin akan logout?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                            <a href="logout.php" class="btn btn-primary">Logout</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - by <b><a href="">Bawaslu</a></b></span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <!-- Data Table -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#tabel-kegiatan').DataTable();
    })
  </script>
</body>

</html>
