<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data jadwal pelajaran
    $query = "SELECT * FROM schedule WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $jadwal = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        $tingkat = $_POST['tingkat']; 
        $kode = $_POST['kode']; 
        $mata_pelajaran_id = $_POST['mata_pelajaran_id'];

        $query = "UPDATE schedule SET 
                  hari = '$hari', 
                  jam_mulai = '$jam_mulai', 
                  jam_selesai = '$jam_selesai', 
                  tingkat = '$tingkat',
                  kode = '$kode',
                  mata_pelajaran_id = '$mata_pelajaran_id'
                  WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "Jadwal pelajaran berhasil diubah.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // Query untuk mengambil data mata pelajaran
    $mata_pelajaran = mysqli_query($conn, "SELECT * FROM mata_pelajaran");
} else {
    echo "ID jadwal pelajaran tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal Pelajaran</title>
</head>
<body>

<h2>Edit Jadwal Pelajaran</h2>
<form method="post">
    <div>
        <label for="hari">Hari:</label>
        <select id="hari" name="hari">
            <option value="Senin" <?php if ($jadwal['hari'] == 'Senin') echo 'selected'; ?>>Senin</option>
            <option value="Selasa" <?php if ($jadwal['hari'] == 'Selasa') echo 'selected'; ?>>Selasa</option>
            </select>
    </div>
    <div>
        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" id="jam_mulai" name="jam_mulai" value="<?php echo $jadwal['jam_mulai']; ?>">
    </div>
    <div>
        <label for="jam_selesai">Jam Selesai:</label>
        <input type="time" id="jam_selesai" name="jam_selesai" value="<?php echo $jadwal['jam_selesai']; ?>">
    </div>
    <div>
        <label for="tingkat">Tingkat:</label>
        <input type="text" id="tingkat" name="tingkat" value="<?php echo $jadwal['tingkat']; ?>">
    </div>
    <div>
        <label for="kode">Kode:</label>
        <input type="number" id="kode" name="kode" value="<?php echo $jadwal['kode']; ?>">
    </div>
    <div>
        <label for="mata_pelajaran_id">Mata Pelajaran:</label>
        <select id="mata_pelajaran_id" name="mata_pelajaran_id">
            <?php while ($row = mysqli_fetch_assoc($mata_pelajaran)) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($jadwal['mata_pelajaran_id'] == $row['id']) echo 'selected'; ?>><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>

</body>
</html>