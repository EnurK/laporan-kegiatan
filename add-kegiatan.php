<?php
require_once 'koneksi.php';

$subjek = $_POST['subjek'];
$tempat = $_POST['tempat'];
$IdUser = $_POST['IdUser'];
$balasan = $_POST['status'];
$id_kegiatan = $_POST['id_kegiatan']; // Ambil ID kegiatan yang akan diubah

if (isset($_POST['send'])) {
    $allowed_image_extension = array("png", "jpg", "jpeg", "bmp");
    $upload_image_dir = "buktifoto/images/";

    $image_files = $_FILES['gambar'];
    $image_upload_status = true;
    $uploaded_file_names = array();

    // Check if the number of images exceeds the limit
    if (count($image_files['name']) > 3) {
        header("Location: create-kegiatan.php?laporan=jumlah_gambar");
        exit();
    }

    // Create directory if not exist
    if (!is_dir($upload_image_dir)) {
        mkdir($upload_image_dir, 0777, true);
    }

    // Handle image uploads
    for ($i = 0; $i < count($image_files['name']); $i++) {
        $file_name = $image_files['name'][$i];
        $file_temp = $image_files['tmp_name'][$i];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_image_extension)) {
            $upload_file_path = $upload_image_dir . basename($file_name);
            if (move_uploaded_file($file_temp, $upload_file_path)) {
                $uploaded_file_names[] = $file_name;
            } else {
                $image_upload_status = false;
                break;
            }
        } else {
            header("Location: create-kegiatan.php?laporan=ekstensi");
            exit();
        }
    }

    if ($image_upload_status) {
        // Serialize the array of file names to store in the database
        $serialized_file_names = serialize($uploaded_file_names);

        // Update activity data in the database
        $query = "UPDATE tbl_kegiatan 
                  SET subjek_kegiatan = '$subjek', 
                      tempat_kegiatan = '$tempat', 
                      tgl_kegiatan = NOW(), 
                      bukti_kegiatan = '$serialized_file_names', 
                      id_user = '$IdUser' 
                  WHERE id_kegiatan = '$id_kegiatan'";
        
        if (mysqli_query($koneksi, $query)) {
            header("Location: confirm-kegiatan.php?msg=berhasil");
        } else {
            header("Location: create-kegiatan.php?pesan=gagal");
        }
    } else {
        header("Location: create-kegiatan.php?pesan=gagal");
    }
} else {
    header("Location: create-kegiatan.php?pesan=lengkapi");
}
?>
