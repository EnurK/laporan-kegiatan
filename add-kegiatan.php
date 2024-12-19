<?php
require_once 'koneksi.php';

$subjek = $_POST['subjek'];
$tempat = $_POST['tempat'];
$IdUser = $_POST['IdUser'];
$balasan = $_POST['status'];
$id_kegiatan = isset($_POST['id_kegiatan']) ? $_POST['id_kegiatan'] : null; // Cek jika ada ID kegiatan yang disediakan

if (isset($_POST['send'])) {
    $allowed_image_extension = array("png", "jpg", "jpeg", "bmp");
    $upload_image_dir = "buktifoto/images/";

    $image_files = $_FILES['gambar'];
    $image_upload_status = true;
    $uploaded_file_names = array();

    // Batasi jumlah gambar yang diunggah
    if (count($image_files['name']) > 3) {
        header("Location: create-kegiatan.php?laporan=jumlah_gambar");
        exit();
    }

    // Buat direktori jika belum ada
    if (!is_dir($upload_image_dir)) {
        mkdir($upload_image_dir, 0777, true);
    }

    // Proses upload gambar
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
        // Serialisasi nama file gambar untuk disimpan di database
        $serialized_file_names = serialize($uploaded_file_names);

        if ($id_kegiatan) {
            // Jika `id_kegiatan` ada, lakukan `UPDATE` untuk memperbarui data yang sudah ada
            $query = "UPDATE tbl_kegiatan 
                      SET subjek_kegiatan = '$subjek', 
                          tempat_kegiatan = '$tempat', 
                          tgl_kegiatan = NOW(), 
                          bukti_kegiatan = '$serialized_file_names', 
                          id_user = '$IdUser' 
                      WHERE id_kegiatan = '$id_kegiatan'";
        } else {
            // Jika `id_kegiatan` tidak ada, lakukan `INSERT` untuk menambah data baru
            $query = "INSERT INTO tbl_kegiatan (subjek_kegiatan, tempat_kegiatan, tgl_kegiatan, bukti_kegiatan, id_user) 
                      VALUES ('$subjek', '$tempat', NOW(), '$serialized_file_names', '$IdUser')";
        }

        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            header("Location: confirm-kegiatan.php?msg=berhasil");
        } else {
            header("Location: create-kegiatan.php?pesan=gagal_db");
        }
    } else {
        header("Location: create-kegiatan.php?pesan=gagal_upload");
    }
} else {
    header("Location: create-kegiatan.php?pesan=lengkapi");
}
?>
