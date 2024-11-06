<?php
include('../koneksi.php');
require_once("../vendor/autoload.php"); // Pastikan path ke autoload.php benar

use Dompdf\Dompdf;

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Query untuk mendapatkan data user
$query = mysqli_query($koneksi, "SELECT * FROM tbl_admin");

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
$html .= '<center><h1><b>Admin Kabupaten Tasikmalaya</b></h1></center><br><br/>';
$html .= '<center><h2><b>Daftar Admin</b></h2></center><hr/><br/>';
$html .= '<table>
 <tr>
 <th>No</th>
 <th>Nama</th>
 <th>Email</th>
 <th>Telepon</th>
 </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr>
 <td>".$no."</td>
 <td>".$row['nama']."</td>
 <td>".$row['email']."</td>
 <td>".$row['telepon']."</td>
 </tr>";
 $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_daftar_admin.pdf');
?>