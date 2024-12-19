<?php 
	session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION == ""){
      header("location:login.php?pesan=daftar");
    }
  $page = "kegiatan";
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
  <title>BawasluDoc - Daftar Laporan Kegiatan</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

  <!-- Data Table -->
  <link href="../vendor/datatables/dataTables.bootstrap4.css"  rel="stylesheet" type="text/css">
  <!-- END Data Table -->
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    
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
            <h1 class="h3 mb-0 text-gray-800">Daftar Laporan Kegiatan</h1>
          </div>

          <div class="row">
         ` <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row col-lg-12">
                  
                </div>  
                <div class="table-responsive p-3">
                <?php
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                     echo "<div class='alert alert-danger' role='alert'>
                            Data gagal diubah. Pastikan anda sudah mengisinya dengan benar.
                          </div>";
                    }
                    else if($_GET['pesan'] == "sukses"){
                      echo "<div class='alert alert-success alert-dismissible' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                            </button>
                              Selamat! Data berhasil diubah.
                            </div>";                   
                    }
                    else if($_GET['pesan'] == "ekstensi"){
                      echo "<div class='alert alert-danger' role='alert'>
                            Format gambar hanya .PNG, .JPEG, .JPG dan .BMP
                           </div>";                   
                    }
                    else if($_GET['pesan'] == "lengkapi"){
                      echo "<div class='alert alert-danger' role='alert'>
                           Pastikan anda sudah mengisi data dengan lengkap.
                           </div>";                   
                    }
                    else if($_GET['pesan'] == "hapus"){
                      echo "<div class='alert alert-danger' role='alert'>
                          Data berhasil dihapus.
                           </div>";                   
                    }
                  }
                ?>
                  <table class="table align-items-center table-bordered table-flush table-hover" id="tabel-kegiatan">
                    <thead class="thead-light">
                      <tr align="center">
                          <th>No</th>
                          <th>Subjek</th>
                          <th>Tanggal Kegiatan</th>
                          <th>Pengirim</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                      include '../koneksi.php';
                      $no = 1;
                      $_SESSION == ['id_admin'];

                      $data = mysqli_query($koneksi, "SELECT * FROM tbl_kegiatan JOIN tbl_user USING(id_user)");
                      if ($data) {
                          while($row = mysqli_fetch_array($data))
                          { 
                              echo "<tr align='center'>
                              <td>$no</td>
                              <td><a href='detail-kegiatan.php?id=".$row['id_kegiatan']."'> ".$row['subjek_kegiatan']." </a></td>
                              <td>".tgl_indo($row['tgl_kegiatan'])."</td>
                              <td>".$row['nama']."</td>
                              
                              <td>
                                <a class='btn btn-sm btn-info' href='detail-kegiatan.php?id=".$row['id_kegiatan']."'> Detail </a>
                              </td>
                          </tr>";
                          $no++;
                          }
                      } else {
                          echo "Error: " . mysqli_error($koneksi);
                      }
                  ?>
                  </tbody>
                </table>
                </div>
              </div>
             </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
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

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - by
            <b><a href="">Bawaslu</a></b>
            </span>
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
     $(document).ready(function(){
     $('#tabel-kegiatan').DataTable();
     })
  </script>
  <!-- END Data Table -->

</body>

</html>
