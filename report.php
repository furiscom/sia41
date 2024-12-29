<?php
require 'vendor/autoload.php'; // Memuat autoload dari Composer

// Menyertakan koneksi ke database
include('db_connect.php');

// Menyertakan library PhpSpreadsheet dan mPDF
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Mpdf\Mpdf;

// Menangani input form
$rombel_filter = '';
$date_filter = '';
if (isset($_POST['rombel'])) {
    $rombel_filter = $_POST['rombel'];
}
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
} else {
    $start_date = '';
    $end_date = '';
}

// Query untuk mendapatkan data absensi berdasarkan rombel dan rentang tanggal
$query_absensi = "SELECT a.id, a.student_id, a.status, a.date, s.`Nama Lengkap`, s.`Tingkat - Rombel`
                  FROM attendance a
                  JOIN siswa s ON a.student_id = s.id
                  WHERE s.`Tingkat - Rombel` = '$rombel_filter'";

if ($start_date && $end_date) {
    $query_absensi .= " AND a.date BETWEEN '$start_date' AND '$end_date'";
}

$result_absensi = mysqli_query($conn, $query_absensi);

// Memeriksa jika ada hasil query
if (!$result_absensi) {
    die("Query Error: " . mysqli_error($conn));
}

// Pilihan untuk ekspor ke format Excel atau PDF
if (isset($_POST['export']) && $_POST['export'] == 'excel') {

    // Membuat objek Spreadsheet untuk Excel
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("Your Name")
                                 ->setTitle("Laporan Absensi");

    // Menambahkan header untuk Excel
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Rombel: ' . $rombel_filter) // Header rombel
                ->setCellValue('A2', 'Tanggal: ' . $start_date . ' s/d ' . $end_date) // Header tanggal
                ->setCellValue('A3', 'Nama Siswa')
                ->setCellValue('B3', 'Status Kehadiran')
                ->setCellValue('C3', 'Tanggal');

    // Isi data absensi ke dalam spreadsheet
    $row = 4; // Mulai dari baris 4 karena baris 1 untuk rombel, baris 2 untuk tanggal, baris 3 untuk header kolom
    while ($attendance = mysqli_fetch_assoc($result_absensi)) {
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $attendance['Nama Lengkap']);
        $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $attendance['status']);
        $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $attendance['date']);
        $row++;
    }

    // Set header untuk output Excel
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="attendance_report.xls"');
    header('Cache-Control: max-age=0');

    // Simpan file ke output PHP
    $writer = new Xls($spreadsheet);
    $writer->save('php://output');
    exit;

} elseif (isset($_POST['export']) && $_POST['export'] == 'pdf') {

    // Membuat objek mPDF
    $mpdf = new Mpdf();
    $html = '<h1>Laporan Absensi</h1>';
    $html .= '<h2>Rombel: ' . $rombel_filter . '</h2>'; // Menampilkan rombel
    $html .= '<h3>Rentang Tanggal: ' . $start_date . ' s/d ' . $end_date . '</h3>'; // Menampilkan tanggal
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr><th>Nama Siswa</th><th>Status Kehadiran</th><th>Tanggal</th></tr>';

    // Isi data absensi ke dalam tabel PDF
    mysqli_data_seek($result_absensi, 0); // Reset pointer hasil query ke awal
    while ($attendance = mysqli_fetch_assoc($result_absensi)) {
        $html .= '<tr>';
        $html .= '<td>' . $attendance['Nama Lengkap'] . '</td>';
        $html .= '<td>' . $attendance['status'] . '</td>';
        $html .= '<td>' . $attendance['date'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Tulis HTML ke PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('attendance_report.pdf', 'D');
    exit;
} else {
    // Jika tidak ada aksi ekspor
    echo "Pilih jenis ekspor (Excel atau PDF).";
}
?>
