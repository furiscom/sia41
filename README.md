

# Sistem Informasi Absensi Siswa

Sistem Informasi Absensi Siswa ini dirancang untuk membantu sekolah dalam mencatat dan mengelola data absensi siswa. Sistem ini memungkinkan admin untuk memonitor kehadiran siswa berdasarkan **Rombel** (kelas dan kelompok) serta **tanggal** tertentu. Sistem ini juga menyediakan fitur untuk **mengekspor data absensi** ke dalam format **Excel** dan **PDF**.

## Fitur Utama

- **Manajemen Absensi**: Mencatat kehadiran siswa berdasarkan rombel dan tanggal tertentu.
- **Filter Berdasarkan Rombel**: Admin dapat memfilter data absensi berdasarkan **Rombel** (kelas dan kelompok).
- **Filter Berdasarkan Tanggal**: Data absensi dapat difilter berdasarkan tanggal tertentu.
- **Ekspor Data**: Admin dapat mengekspor data absensi ke dalam format **Excel** atau **PDF**.
  
## Teknologi yang Digunakan

- **PHP**: Digunakan untuk backend pengelolaan data dan logika aplikasi.
- **MySQL**: Digunakan untuk menyimpan data absensi siswa dan informasi rombel.
- **PhpSpreadsheet**: Digunakan untuk mengekspor data ke format Excel.
- **mPDF**: Digunakan untuk mengekspor data ke format PDF.
- **Bootstrap**: Digunakan untuk desain antarmuka pengguna yang responsif dan modern.
  
## Instalasi

### Prasyarat

Pastikan Anda memiliki perangkat lunak berikut yang terpasang:
- **PHP 7.x** atau versi yang lebih baru.
- **MySQL**.
- **Composer** (untuk mengelola dependensi).

### Langkah-Langkah Instalasi

1. **Clone Repository**:
   Clone repository ini ke dalam folder di komputer Anda:
   ```bash
   git clone <URL_REPOSITORY>
   ```

2. **Instalasi Dependensi**:
   Instal dependensi menggunakan **Composer**:
   ```bash
   composer install
   ```

3. **Konfigurasi Database**:
   - Buat database baru di MySQL, misalnya `absensi_siswa`.
   - Impor struktur tabel yang diperlukan ke dalam database menggunakan skrip SQL yang disediakan (jika ada).
   - Konfigurasikan file `db_connect.php` dengan detail koneksi database Anda.

4. **Jalankan Aplikasi**:
   Jalankan aplikasi menggunakan server lokal seperti **XAMPP**, **MAMP**, atau **WAMP**.
   
5. Akses aplikasi melalui browser Anda pada `localhost` atau alamat yang Anda tentukan:
   ```http://localhost/nama_folder_aplikasi```

## Penggunaan

### **1. Menambahkan Absensi Siswa**
- Admin dapat menambahkan data absensi siswa melalui antarmuka aplikasi.
- Pilih rombel dan status kehadiran (misalnya hadir, izin, sakit, alpa).
  
### **2. Melihat Data Absensi**
- Admin dapat memilih **Rombel** dan **Tanggal** tertentu untuk melihat data absensi siswa.
- Data yang sesuai akan ditampilkan dalam tabel dengan rincian **Nama Siswa**, **Status Kehadiran**, dan **Tanggal**.

### **3. Mengekspor Data**
- Admin dapat mengekspor data absensi ke dalam **Excel** atau **PDF** dengan memilih format yang diinginkan di bagian bawah tabel.

### **4. Filter Berdasarkan Tanggal**
- Admin dapat memilih tanggal tertentu untuk memfilter data absensi.

## Struktur Direktori

```bash
/
|-- assets/                   # Folder untuk menyimpan gambar, CSS, dan JavaScript
|-- db_connect.php            # Koneksi ke database
|-- index.php                 # Halaman utama aplikasi
|-- attendance_report.php     # Halaman untuk laporan absensi
|-- add_student.php           # Halaman untuk menambahkan siswa
|-- edit_student.php          # Halaman untuk mengedit siswa
|-- vendor/                   # Dependensi Composer
|-- footer.php                # Footer aplikasi
|-- navbar.php                # Navbar aplikasi
|-- README.md                 # Dokumentasi aplikasi (ini)
```

## Kontribusi

Jika Anda ingin berkontribusi pada pengembangan sistem ini, harap mengikuti langkah-langkah berikut:

1. Fork repositori ini.
2. Buat cabang (branch) baru untuk fitur yang ingin Anda tambahkan.
3. Lakukan perubahan pada cabang tersebut.
4. Kirim pull request untuk melakukan merge dengan cabang utama.

## Lisensi

Sistem Informasi Absensi ini dilisensikan di bawah **MIT License** - lihat file **LICENSE** untuk detail lebih lanjut.

---


