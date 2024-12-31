<?php
include 'db_connect.php';

// Fungsi untuk mengambil data jadwal pelajaran
function getJadwalPelajaran($conn) {
    $query = "SELECT s.*, mp.nama AS nama_mapel 
              FROM schedule s
              JOIN mata_pelajaran mp ON s.mata_pelajaran_id = mp.id";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Fungsi untuk mengambil data mata pelajaran
function getMataPelajaran($conn) {
    $query = "SELECT * FROM mata_pelajaran";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Tambah Jadwal
if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah' && $_SERVER['REQUEST_METHOD'] == 'POST') {
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
    exit;
}

// Edit Jadwal
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
    exit;
}

// Hapus Jadwal
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM schedule WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "Jadwal pelajaran berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    exit;
}

// Ambil data jadwal untuk edit
if (isset($_GET['aksi']) && $_GET['aksi'] == 'get_jadwal' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM schedule WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $jadwal = mysqli_fetch_assoc($result);
    echo json_encode($jadwal);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Jadwal Pelajaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>

<?php include 'navbar.php'; ?> 

<div class="container">
    <h2 class="text-center mb-5">Kelola Jadwal Pelajaran</h2>

    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahJadwalModal">
        Tambah Jadwal Pelajaran
    </button>

    <table class="table" id="tabelJadwal">
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Tingkat</th>
                <th>Kode</th>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jadwalPelajaran = getJadwalPelajaran($conn);
            foreach ($jadwalPelajaran as $row) {
                echo "<tr>";
                echo "<td>" . $row['hari'] . "</td>";
                echo "<td>" . $row['jam_mulai'] . "</td>";
                echo "<td>" . $row['jam_selesai'] . "</td>";
                echo "<td>" . $row['tingkat'] . "</td>";
                echo "<td>" . $row['kode'] . "</td>";
                echo "<td>" . $row['nama_mapel'] . "</td>";
                echo "<td>
                        <button type='button' class='btn btn-sm btn-primary edit-jadwal' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editJadwalModal'>Edit</button>
                        <button type='button' class='btn btn-sm btn-danger hapus-jadwal' data-id='" . $row['id'] . "'>Hapus</button>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="tambahJadwalModal" tabindex="-1" role="dialog" aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJadwalModalLabel">Tambah Jadwal Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahJadwal">
                    <div class="form-group">
                        <label for="hari">Hari:</label>
                        <select class="form-control" id="hari" name="hari">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai:</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai:</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                    </div>
                    <div class="form-group">
                        <label for="tingkat">Tingkat-Rombel:</label>
                        <select class="form-control" id="tingkat" name="tingkat">
                            <?php
                            $kelas = mysqli_query($conn, "SELECT DISTINCT `Tingkat - Rombel` FROM siswa");
                            while ($row = mysqli_fetch_assoc($kelas)) {
                                echo "<option value='" . $row['Tingkat - Rombel'] . "'>" . $row['Tingkat - Rombel'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode:</label>
                        <input type="number" class="form-control" id="kode" name="kode">
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran_id">Mata Pelajaran:</label>
                        <select class="form-control" id="mata_pelajaran_id" name="mata_pelajaran_id">
                            <?php
                            $mataPelajaran = getMataPelajaran($conn);
                            foreach ($mataPelajaran as $row) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="simpanJadwal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editJadwalModal" tabindex="-1" role="dialog" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditJadwal">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_hari">Hari:</label>
                        <select class="form-control" id="edit_hari" name="hari">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_jam_mulai">Jam Mulai:</label>
                        <input type="time" class="form-control" id="edit_jam_mulai" name="jam_mulai">
                    </div>
                    <div class="form-group">
                        <label for="edit_jam_selesai">Jam Selesai:</label>
                        <input type="time" class="form-control" id="edit_jam_selesai" name="jam_selesai">
                    </div>
                    <div class="form-group">
                        <label for="edit_tingkat">Tingkat-Rombel:</label>
                        <select class="form-control" id="edit_tingkat" name="tingkat">
                            <?php
                            $kelas = mysqli_query($conn, "SELECT DISTINCT `Tingkat - Rombel` FROM siswa");
                            while ($row = mysqli_fetch_assoc($kelas)) {
                                echo "<option value='" . $row['Tingkat - Rombel'] . "'>" . $row['Tingkat - Rombel'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_kode">Kode:</label>
                        <input type="number" class="form-control" id="edit_kode" name="kode">
                    </div>
                    <div class="form-group">
                        <label for="edit_mata_pelajaran_id">Mata Pelajaran:</label>
                        <select class="form-control" id="edit_mata_pelajaran_id" name="mata_pelajaran_id">
                            <?php
                            foreach ($mataPelajaran as $row) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="updateJadwal">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Tambah Jadwal
    $('#simpanJadwal').click(function() {
        $.ajax({
            url: 'kelola_jadwal.php?aksi=tambah',
            type: 'POST',
            data: $('#formTambahJadwal').serialize(),
            success: function(response) {
                alert(response);
                $('#tambahJadwalModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Edit Jadwal
    $(document).on('click', '.edit-jadwal', function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'kelola_jadwal.php?aksi=get_jadwal&id=' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#edit_id').val(response.id);
                $('#edit_hari').val(response.hari);
                $('#edit_jam_mulai').val(response.jam_mulai);
                $('#edit_jam_selesai').val(response.jam_selesai);
                $('#edit_tingkat').val(response.tingkat);
                $('#edit_kode').val(response.kode);
                $('#edit_mata_pelajaran_id').val(response.mata_pelajaran_id);
                $('#editJadwalModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#updateJadwal').click(function() {
        $.ajax({
            url: 'kelola_jadwal.php?aksi=edit',
            type: 'POST',
            data: $('#formEditJadwal').serialize(),
            success: function(response) {
                alert(response);
                $('#editJadwalModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Hapus Jadwal
    $(document).on('click', '.hapus-jadwal', function() {
        var id = $(this).data('id');
        console.log("ID Jadwal:", id);
        if (confirm("Apakah Anda yakin ingin menghapus jadwal ini?")) {
            $.ajax({
                url: 'kelola_jadwal.php?aksi=hapus&id=' + id,
                type: 'GET',
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
</script>

<?php include 'footer.php'; ?> 

</body>
</html>