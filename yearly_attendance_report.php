<form method="post" action="report.php">
    <label for="rombel">Pilih Rombel:</label>
    <select name="rombel" id="rombel" required>
        <!-- Daftar rombel yang diambil dari database -->
        <?php
        $query_rombel = "SELECT DISTINCT `Tingkat - Rombel` FROM siswa";
        $result_rombel = mysqli_query($conn, $query_rombel);
        while ($row = mysqli_fetch_assoc($result_rombel)) {
            echo '<option value="' . $row['Tingkat - Rombel'] . '">' . $row['Tingkat - Rombel'] . '</option>';
        }
        ?>
    </select><br><br>

    <label for="start_date">Tanggal Mulai:</label>
    <input type="date" name="start_date" required><br><br>

    <label for="end_date">Tanggal Akhir:</label>
    <input type="date" name="end_date" required><br><br>

    <button type="submit" name="export" value="excel">Export ke Excel</button>
    <button type="submit" name="export" value="pdf">Export ke PDF</button>
</form>
