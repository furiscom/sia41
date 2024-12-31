<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $tingkat = $_POST['tingkat']; 
    $kode = $_POST['kode']; 
    $mata_pelajaran_id = $_POST['mata_pelajaran_id'];

    $query = "INSERT INTO schedule (hari, jam_mulai, jam_selesai, tingkat, kode, mata_pelajaran_id) 
              VALUES ('$hari', '$jam_mulai', '$jam_selesai', '$tingkat', '$kode', '$mata_pelajaran_id')";

    if (mysqli_query($conn, $query)) {
        echo "Jadwal pelajaran berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Query untuk mengambil data mata pelajaran
$mata_pelajaran = mysqli_query($conn, "SELECT * FROM mata_pelajaran");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jadwal Pelajaran</title>
</head>
<body>

<h2>Tambah Jadwal Pelajaran</h2>
<form method="post">
    <div>
        <label for="hari">Hari:</label>
        <select id="hari" name="hari">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            </select>
    </div>
    <div>
        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" id="jam_mulai" name="jam_mulai">
    </div>
    <div>
        <label for="jam_selesai">Jam Selesai:</label>
        <input type="time" id="jam_selesai" name="jam_selesai">
    </div>
    <div>
        <label for="tingkat">Tingkat:</label>
        <input type="text" id="tingkat" name="tingkat">
    </div>
    <div>
        <label for="kode">Kode:</label>
        <input type="number" id="kode" name="kode">
    </div>
    <div>
        <label for="mata_pelajaran_id">Mata Pelajaran:</label>
        <select id="mata_pelajaran_id" name="mata_pelajaran_id">
            <?php while ($row = mysqli_fetch_assoc($mata_pelajaran)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>

</body>
</html>