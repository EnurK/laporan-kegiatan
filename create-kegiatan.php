<?php 
	session_start();

    // cek apakah yang mengakses halaman ini sudah login
	if(empty($_SESSION['email'])){
		header("location:login.php?pesan=no");
	}

  include "koneksi.php";
  $page = "Buat";

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
  <title>BawasluDoc - Buat Baru</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          
        </div>
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
            <h1 class="h3 mb-0 text-gray-800">Buat laporan Kegiatan</h1>
          </div>
          <div class="row">
         ` <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                <?php
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                     echo "<div class='alert alert-danger' role='alert'>
                            Data gagal disimpan. Pastikan anda sudah mengisinya dengan benar.
                          </div>";
                    }
                    else if($_GET['pesan'] == "sukses"){
                      echo "<div class='alert alert-success' role='alert'>
                            Data berhasil dikirim.  </div>";                   
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
                  }
                ?>

<form action="add-kegiatan.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="IdUser" value="<?php echo $_SESSION['id_user']; ?>">
    </div>
    <div class="form-group row">
        <div class="col-lg-3">
            <label for="tgl" class="text-primary">Tanggal Kegiatan</label>
        </div>
        <div class="col-lg-7">
        <input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-3">
            <label for="subjek" class="text-primary">Subjek kegiatan </label>
        </div>
        <div class="col-lg-7">
            <input type="text" class="form-control" name="subjek" id="subjek" aria-describedby="subjekdesc">
            <small id="subjekdesc" class="form-text text-muted">Subjek merupakan judul kegiatan.</small>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-7">
            <label class="text-primary">Tempat kegiatan </label>
            <textarea name="tempat" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="text-primary" aria-describedby="buktidoc">Upload Bukti Dokumen</label>
        <small id="buktidoc" class="form-text text-muted">Unggah Foto </small>
    </div>
    <div class="form-group row">
          <div class="col-lg-5">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="gambar[]" id="customFile" multiple>
              <label class="custom-file-label" for="customFile">Upload gambar</label>
            </div>
          </div>
        </div>
        </div>
                <div id="preview-container" class="row mt-3"></div> 
        
    <br>
    
    <center>
        <button type="reset" class="btn btn-lg btn-danger">Reset</button> &nbsp;
        <button type="submit" name="send" class="btn btn-lg btn-success" onClick='return confirmSubmit()'>Kirim</button>
    </center>
    <br>
</form>

<script>
        document.addEventListener("DOMContentLoaded", function() {
          document.getElementById('customFile').addEventListener('change', handleFileSelect, false);
        });

        function handleFileSelect(event) {
          var files = event.target.files;
          var previewContainer = document.getElementById('preview-container');

          // Clear previous previews
          previewContainer.innerHTML = '';

          // Check if the number of files exceeds the limit
          if (files.length > 3) {
            alert("Maksimal 3 gambar yang dapat diunggah");
            event.target.value = ''; // Clear the input
            return;
          }

          for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var card = document.createElement('div');
            card.classList.add('card', 'mb-4');

            if (file.type.startsWith('image/')) {
              var reader = new FileReader();
              reader.onload = (function(theFile) {
                return function(e) {
                  var img = document.createElement('img');
                  img.src = e.target.result;
                  img.classList.add('card-img-top');
                  card.appendChild(img);
                };
              })(file);
              reader.readAsDataURL(file);
            }

            previewContainer.appendChild(card);
          }
        }
      </script>


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
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> -  by
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
  <script LANGUAGE="JavaScript">
    function confirmSubmit()
    {
      var agree=confirm("Pastikan anda sudah mengisi data dengan benar! Tekan tombol OK untuk mengirim pesan.");
      if (agree)
      return true ;
      else
      return false ;
    }
  </script>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>