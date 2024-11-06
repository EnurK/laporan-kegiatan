<?php
include('../koneksi.php');
require_once("../vendor/autoload.php"); // Pastikan path ke autoload.php benar

use Dompdf\Dompdf;

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Query untuk mendapatkan data user
$query = mysqli_query($koneksi, "SELECT * FROM tbl_user");

// Membuat struktur HTML
$html = '<html><head><style>
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 8px;
    text-align: center;
    border: 1px solid #000;
}
</style></head><body>';
$html .= '<center><h1><b>Panwascam Kabupaten Tasikmalaya</b></h1></center><br><br/>';
$html .= '<center><h2><b>Daftar User</b></h2></center><hr/><br/>';
$html .= '<table>
 <tr>
     <th>No</th>
     <th>NIK</th>
     <th>Nama</th>
     <th>Kecamatan</th>
     <th>Email</th>
 </tr>';

$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
     <td>".$no."</td>
     <td>".$row['nik']."</td>
     <td>".$row['nama']."</td>
     <td>".$row['kecamatan']."</td>
     <td>".$row['email']."</td>
    </tr>";
    $no++;
}

$html .= '</table></body></html>';

// Memuat HTML ke Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Merender HTML menjadi PDF
$dompdf->render();

// Output file PDF
$dompdf->stream('laporan_daftar_panwascam.pdf');
?>
