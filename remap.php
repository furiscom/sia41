<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "sia");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Map grades to specific classes
$classMapping = [
    '7' => 'Kelas 7 - 01',
    '8' => 'Kelas 8 - 01',
    '9' => 'Kelas 9 - 01'
];

// Update schedule for Kelas 7 - 01, Kelas 8 - 01, and Kelas 9 - 01
foreach ($classMapping as $grade => $className) {
    $sql = "UPDATE schedule SET 'Tingkat - Rombel' = '$className' WHERE grade = '$grade'";
    if ($conn->query($sql) === TRUE) {
        echo "Schedule updated for $className.<br>";
    } else {
        echo "Error updating schedule for $className: " . $conn->error . "<br>";
    }
}

// Duplicate schedule from Kelas 9 - 01 to Kelas 9 - 02
$kelas9ScheduleQuery = "SELECT * FROM schedule WHERE class_name = 'Kelas 9 - 01'";
$result = $conn->query($kelas9ScheduleQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newClass = 'Kelas 9 - 02';
        $insertQuery = "INSERT INTO schedule (class_name, subject, teacher, time) VALUES (
            '$newClass', 
            '{$row['subject']}', 
            '{$row['teacher']}', 
            '{$row['time']}'
        )";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Schedule duplicated for $newClass.<br>";
        } else {
            echo "Error duplicating schedule for $newClass: " . $conn->error . "<br>";
        }
    }
} else {
    echo "No schedule found for Kelas 9 - 01.<br>";
}

// Close connection
$conn->close();
?>
