<?php
include "koneksi.php"; // Menghubungkan ke database

$registrationSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $kecamatan = $_POST['kecamatan'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mengenkripsi password

    // Memasukkan data ke tabel
    $sql = "INSERT INTO tbl_user (nik, nama, kecamatan, email, password) VALUES (?, ?, ?, ?, ?)";
    
    // Mempersiapkan statement
    if ($stmt = $koneksi->prepare($sql)) {
        // Mengikat parameter ke statement
        $stmt->bind_param("sssss", $nik, $nama, $kecamatan, $email, $password);
        
        // Menjalankan statement
        if ($stmt->execute()) {
            $registrationSuccess = true;
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
        
        // Menutup statement
        $stmt->close();
    } else {
        echo "Error: " . $koneksi->error;
    }
    
    // Menutup koneksi
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo_bawaslu.png" rel="icon">
  <title>Register Akun</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fc;
    }
    .register-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .register-box {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }
    .register-box h2 {
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-box">
      <div class="text-center">
        <h1 class="h2 text-gray-900 mb-4">Register Panwascam</h1>
      </div>
      <form action="register.php" method="post">
        <div class="form-group">
          <label for="nik">NIK:</label>
          <input type="text" id="nik" name="nik" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="nama">Nama:</label>
          <input type="text" id="nama" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="kecamatan">Kecamatan:</label>
          <input type="text" id="kecamatan" name="kecamatan" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
      </form>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrasi Berhasil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Registrasi Anda berhasil. Klik OK untuk menuju halaman login.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="modal-ok-button">OK</button>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script>
    $(document).ready(function() {
      <?php if ($registrationSuccess): ?>
      $('#successModal').modal('show');
      $('#modal-ok-button').click(function() {
        window.location.href = 'login.php';
      });
      <?php endif; ?>
    });
  </script>
</body>
</html>
