<?php
require 'vendor/autoload.php'; // Include Composer autoload

// Include database connection
include('db_connect.php');

// Use the mPDF namespace
use \Mpdf\Mpdf;

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

// Create a new mPDF instance
$mpdf = new Mpdf();

// Set document properties (optional)
$mpdf->SetTitle("Attendance Report");
$mpdf->SetAuthor("Muhammad Furqan");

// Check if attendance data exists
if (mysqli_num_rows($result_absensi) > 0) {
    // Start building the HTML content for the PDF
    $html = '<h2>Attendance Report</h2>';
    $html .= '<p><strong>Rombel: </strong>' . htmlspecialchars($rombel_filter) . '</p>';
    $html .= '<p><strong>Date: </strong>' . htmlspecialchars($date_filter) . '</p>';

    // Create a table for the attendance data
    $html .= '<table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Status Kehadiran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>';

    // Populate the data into the table
    while ($attendance = mysqli_fetch_assoc($result_absensi)) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($attendance['Nama Lengkap']) . '</td>
                    <td>' . htmlspecialchars($attendance['status']) . '</td>
                    <td>' . htmlspecialchars($attendance['date']) . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    // Write HTML to mPDF
    $mpdf->WriteHTML($html);

    // Output the PDF to the browser
    $mpdf->Output('attendance_report.pdf', 'D'); // 'D' for download, 'I' for inline display

} else {
    // Handle case where no data is found for the given filters
    $html = '<h2>No Data Found</h2>';
    $html .= '<p>No attendance data found for the selected rombel or date.</p>';
    
    // Write the no data message to mPDF
    $mpdf->WriteHTML($html);
    
    // Output the PDF with the no data message
    $mpdf->Output('no_data_report.pdf', 'D');
}

exit;
?>
