<?php
require 'vendor/autoload.php'; // Include Composer autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// Include database connection
include('db_connect.php');

// Get the available rombel (class) options from the database
$query_rombel = "SELECT DISTINCT `Tingkat - Rombel` FROM siswa";
$result_rombel = mysqli_query($conn, $query_rombel);

// Initialize variables
$rombel_filter = '';
$date_filter = '';

// Process form submission (when rombel and date are selected)
if (isset($_POST['rombel'])) {
    $rombel_filter = $_POST['rombel'];
    $date_filter = isset($_POST['date']) ? $_POST['date'] : '';

    // Query to fetch attendance data based on rombel and date
    $query_absensi = "SELECT a.id, a.student_id, a.status, a.date, s.`Nama Lengkap`, s.`Tingkat - Rombel`
                      FROM attendance a
                      JOIN siswa s ON a.student_id = s.id
                      WHERE s.`Tingkat - Rombel` = '$rombel_filter'";

    if ($date_filter) {
        $query_absensi .= " AND a.date = '$date_filter'";
    }

    $result_absensi = mysqli_query($conn, $query_absensi);
} else {
    $result_absensi = [];
}

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set properties for the spreadsheet
$spreadsheet->getProperties()->setCreator("Muhammad Furqan")
                              ->setTitle("Attendance Report");

// Add headers
$sheet->setCellValue('A1', 'Nama Siswa')
      ->setCellValue('B1', 'Status Kehadiran')
      ->setCellValue('C1', 'Tanggal')
      ->setCellValue('D1', 'Rombel');

// Populate the data into the sheet
$row = 2;
if (mysqli_num_rows($result_absensi) > 0) {
    while ($attendance = mysqli_fetch_assoc($result_absensi)) {
        $sheet->setCellValue('A' . $row, $attendance['Nama Lengkap']);
        $sheet->setCellValue('B' . $row, $attendance['status']);
        $sheet->setCellValue('C' . $row, $attendance['date']);
        $sheet->setCellValue('D' . $row, $attendance['Tingkat - Rombel']);
        $row++;
    }
} else {
    // If no data is found, provide a message or leave it blank
    $sheet->setCellValue('A2', 'No data found for the selected rombel or date');
}

// Set header for Excel output
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="attendance_report.xls"');
header('Cache-Control: max-age=0');

// Save the file to PHP output
$writer = new Xls($spreadsheet);
$writer->save('php://output');
exit;
?>
