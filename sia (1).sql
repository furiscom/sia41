-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 04:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `Tingkat - Rombel` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`, `Tingkat - Rombel`) VALUES
(1, 1, '2024-12-01', 'Hadir', ''),
(2, 3, '2024-12-01', 'Hadir', ''),
(3, 2, '2024-12-01', 'Hadir', ''),
(4, 20, '2024-12-01', 'Tidak Hadir', 'Kelas 8 - 01'),
(5, 21, '2024-12-01', 'Tidak Hadir', 'Kelas 8 - 01'),
(6, 22, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(7, 23, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(8, 24, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(9, 25, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(10, 26, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(11, 27, '2024-12-01', 'Hadir', 'Kelas 8 - 01'),
(76, 45, '2024-12-01', 'Sakit', 'Kelas 9 - 01'),
(77, 46, '2024-12-01', 'Sakit', 'Kelas 9 - 01'),
(78, 47, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(79, 48, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(80, 49, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(81, 50, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(82, 51, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(83, 52, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(84, 53, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(85, 54, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(86, 55, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(87, 56, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(88, 57, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(89, 58, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(90, 59, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(91, 60, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(92, 61, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(93, 62, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(94, 63, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(95, 64, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(96, 65, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(97, 66, '2024-12-01', 'Hadir', 'Kelas 9 - 01'),
(98, 67, '2024-12-01', 'Hadir', 'Kelas 9 - 01');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `report_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `No` varchar(512) DEFAULT NULL,
  `Nama Lengkap` varchar(512) DEFAULT NULL,
  `NISN` varchar(512) DEFAULT NULL,
  `NIK` varchar(512) DEFAULT NULL,
  `Tempat Lahir` varchar(512) DEFAULT NULL,
  `Tanggal Lahir` varchar(512) DEFAULT NULL,
  `Tingkat - Rombel` varchar(512) DEFAULT NULL,
  `Umur` varchar(512) DEFAULT NULL,
  `Status` varchar(512) DEFAULT NULL,
  `Jenis Kelamin` varchar(512) DEFAULT NULL,
  `Alamat` varchar(512) DEFAULT NULL,
  `No Telepon` varchar(512) DEFAULT NULL,
  `Kebutuhan Khusus` varchar(512) DEFAULT NULL,
  `Disabilitas` varchar(512) DEFAULT NULL,
  `Nomor KIP/PIP` varchar(512) DEFAULT NULL,
  `Nama Ayah Kandung` varchar(512) DEFAULT NULL,
  `Nama Ibu Kandung` varchar(512) DEFAULT NULL,
  `Nama Wali` varchar(512) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`No`, `Nama Lengkap`, `NISN`, `NIK`, `Tempat Lahir`, `Tanggal Lahir`, `Tingkat - Rombel`, `Umur`, `Status`, `Jenis Kelamin`, `Alamat`, `No Telepon`, `Kebutuhan Khusus`, `Disabilitas`, `Nomor KIP/PIP`, `Nama Ayah Kandung`, `Nama Ibu Kandung`, `Nama Wali`, `id`) VALUES
('1', 'SILMI KHAIRUNNISA', '3107733239', '\'1571024107100041', 'JAMBI', '2010-07-01', 'Kelas 7 - 01', '14 th, 1 bln', 'Aktif', 'Perempuan', 'Jl. Jambi Suak Kandis km.16 TARIKAN, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6282290325050', 'Tidak Ada', 'Tidak Ada', '', 'AMIRUDDIN', 'SILPI INDRAYENI', 'SILPI INDRAYENI', 1),
('2', 'ZIDANE ADITAMA', '3127818747', '\'1505061109120003', 'JAMBI', '2012-09-11', 'Kelas 7 - 01', '11 th, 11 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Rt. 01 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'SANDI', 'HARDIYANTI', 'SANDI', 2),
('3', 'RISKI NAFAZI', '3110770714', '\'1505062611110003', 'MUARA KUMPEH', '2011-11-26', 'Kelas 7 - 01', '12 th, 8 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Talang Duku, Km. 05, Rt. 10 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'HODI', 'SITI FATIMAH', 'HODI', 3),
('4', 'RAHMAD SYAWALDI', '0113536682', '\'1571021709110003', 'JAMBI', '2011-09-17', 'Kelas 7 - 01', '12 th, 10 bln', 'Aktif', 'Laki-laki', 'Jln.H.M.Yusuf Nasri Rt 22 WIJAYA PURA, JAMBI SELATAN, KOTA JAMBI, JAMBI, 36131, 36131', '6283172068260', 'Tidak Ada', 'Tidak Ada', '11157120000609', 'RINTO USDANI', 'LELI SAPRIDA', 'RINTO USDANI', 4),
('5', 'FAID QORI ANNIZAM', '3123801957', '\'1505070207120002', 'MUARO JAMBI', '2012-07-02', 'Kelas 7 - 01', '12 th, 1 bln', 'Aktif', 'Laki-laki', 'Jl. Prabu Siliwangi, Rt. 23 TANJUNG SARI, JAMBI TIMUR, KOTA JAMBI, JAMBI, 36147, 36147', '', 'Tidak Ada', 'Tidak Ada', '', 'MARSIDI', 'SITI MUZAIKAH', 'MARSIDI', 5),
('6', 'ABDUL GOFUR', '3124888054', '\'1571020502120001', 'JAMBI', '2012-02-05', 'Kelas 7 - 01', '12 th, 6 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Rt. 06 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'SAKDI', 'MARFU\'AH', 'SAKDI', 6),
('7', 'M. Alfarizi Putra Pratama', '0121681254', '\'1571022208120004', 'Jambi', '2012-08-22', 'Kelas 7 - 01', '11 th, 11 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Zairiah', '-', 7),
('8', 'Nailah Sari', '0122129932', '\'1505066904120001', 'Muaro Jambi', '2012-04-29', 'Kelas 7 - 01', '12 th, 3 bln', 'Aktif', 'Perempuan', ' , , , , , ', '', '', '', '', '-', 'Teti Arwanti', '-', 8),
('9', 'Suendra Ramadani', '0128872774', '\'1571031208120001', 'Jambi', '2012-08-12', 'Kelas 7 - 01', '12 th, 0 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Sudarsih', '-', 9),
('10', 'M.Zaidi Al Kadafi', '0129962681', '\'1505061209120003', 'Muara Kumpeh', '2012-09-12', 'Kelas 7 - 01', '11 th, 11 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Martina', '-', 10),
('11', 'Khairan Nathan', '0123257175', '\'1505021104120002', 'Muaro Jambi', '2012-04-11', 'Kelas 7 - 01', '12 th, 4 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Heidi Diana', '-', 11),
('12', 'Syahidan Alfahrizi Butar-butar', '0117112094', '\'1505020411110001', 'Tunas Baru', '2011-11-04', 'Kelas 7 - 01', '12 th, 9 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Junaida', '-', 12),
('13', 'Yasir Obama Marpaung', '0114151497', '\'1209152011110001', 'Gunung Berkat', '2011-11-20', 'Kelas 7 - 01', '12 th, 8 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Nur Islamiah', '-', 13),
('14', 'IRVAN', '3128371094', '\'1505063006120004', 'MUARO KUMPEH', '2012-06-30', 'Kelas 7 - 01', '12 th, 1 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'MARTINA', '-', 14),
('15', 'ABDUL GHOFAR', '3127006914', '\'1505060502120003', 'MUARA KUMPEH', '2012-02-05', 'Kelas 7 - 01', '12 th, 6 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Rt.04, Km.05 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'M. HATTA', 'MAILAWATI', 'M. HATTA', 15),
('16', 'FIINA FAZILA TATYANA', '0102567161', '\'1571025207100061', 'JAMBI', '2010-07-12', 'Kelas 7 - 01', '14 th, 1 bln', 'Aktif', 'Perempuan', ' , , , , , ', '', '', '', '', '-', 'SRI RAHMA DHANI', '-', 16),
('17', 'Zainal Fajar \'Alam', '3125741126', '\'1505063005120001', 'Muaro Jambi', '2012-05-30', 'Kelas 7 - 01', '12 th, 2 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Riska', '-', 17),
('18', 'Muhammad Thoriq Al Firdaus', '3124927628', '\'1505060509120002', 'Jambi', '2012-09-05', 'Kelas 7 - 01', '11 th, 11 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Melda Oktavia', '-', 18),
('19', 'Zikri Al Rosyid', '0117440442', '\'1571010811110021', 'JAMBI', '2011-11-08', 'Kelas 7 - 01', '12 th, 9 bln', 'Aktif', 'Laki-laki', ' , , , , , ', '', '', '', '', '-', 'Sumiati Dasniar', '-', 19),
('1', 'M.NAZRIL SYAWAL', '3113529407', '\'1505061409110001', 'JAMBI', '2011-09-14', 'Kelas 8 - 01', '12 th, 10 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Rt. 10 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'AMIRUDIN', 'SUSIANA', 'SUSIANA', 20),
('2', 'NAJWA SYAHIRA', '0121600928', '\'1505064501120002', 'MUARO JAMBI', '2012-01-05', 'Kelas 8 - 01', '12 th, 7 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Raya, Rt. 08 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'RUDI', 'MASITOH', 'RUDI', 21),
('3', 'MUSYARI RASYID AZZIKRI', '3118534149', '\'1571030408110002', 'JAMBI', '2011-08-04', 'Kelas 8 - 01', '13 th, 0 bln', 'Aktif', 'Laki-laki', 'Jl. Kerajaan Melayu RT 010 TANJUNG SARI, JAMBI TIMUR, KOTA JAMBI, JAMBI, 36147, 36147', '6281274984766', 'Tidak Ada', 'Tidak Ada', '', 'BAMBANG HERMANTO', 'EVITA JUNAEDHY', 'BAMBANG HERMANTO', 22),
('4', 'M. ZIKRI ALFARIZI', '0111798708', '\'1404091009110001', 'PASAR KEMBANG', '2011-09-10', 'Kelas 8 - 01', '12 th, 11 bln', 'Aktif', 'Laki-laki', 'Desa Nuara Kumpeh, Rt.004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 29274, 29274', '0', 'Tidak Ada', 'Tidak Ada', '', 'SARI HARTO PURNOMO', 'SALMIAH', 'SARI HARTO PURNOMO', 23),
('5', 'AQIILAH NURUL HUDAH', '3115080065', '\'1505066210110001', 'MUARA KUMPEH', '2011-10-22', 'Kelas 8 - 01', '12 th, 9 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Raya, Rt. 10 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'MARJUNI', 'SRI NINGSI', 'MARJUNI', 24),
('6', 'DHIYA UL HUDA', '0118981916', '\'1505060206110003', 'JAMBI', '2011-06-02', 'Kelas 8 - 01', '13 th, 2 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Rt. 07 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'HAIRUL', 'ERNITA', 'HAIRUL', 25),
('7', 'KHOIRIYA HUMAIRO', '3126191004', '\'1505064603120003', 'MUARO JAMBI', '2012-03-06', 'Kelas 8 - 01', '12 th, 5 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Raya, Rt. 05 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'A. ZAIRONI', 'FADILA', 'A. ZAIRONI', 26),
('8', 'ZHOHIROH ADI IBAH', '0119030848', '\'1505066206110002', 'MUARA KUMPEH', '2011-06-22', 'Kelas 8 - 01', '13 th, 1 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Raya, Rt. 03 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'ABANG MASHURI', 'IDA YATI', 'ABANG MASHURI', 27),
('9', 'NAZIFA ULFA', '3128293523', '\'1505066803120001', 'JAMBI', '2012-03-28', 'Kelas 8 - 01', '12 th, 4 bln', 'Aktif', 'Perempuan', 'Muaro Kumpeh MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'HAIDAN', 'SUSANTI', 'HAIDAN', 28),
('10', 'NURMA HIDAYAH', '0113092601', '\'1505065604110004', 'JAMBI', '2011-04-16', 'Kelas 8 - 01', '13 th, 3 bln', 'Aktif', 'Perempuan', 'Jl. Jambi - Suak Kandis, Rt. 13 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'AZHARI', 'HAMSA KUSMAWATI', 'AZHARI', 29),
('11', 'M. RAKA ARYA DARMA', '0117612156', '\'1505060805110002', 'MUARO KUMPEH', '2011-05-08', 'Kelas 8 - 01', '13 th, 3 bln', 'Aktif', 'Laki-laki', 'Jl. Jambi - Suak Kandis, Rt. 14 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'ARI AFRIZAL', 'ERYATI', 'ARI AFRIZAL', 30),
('12', 'LATIFATUL HUSNA.S', '3102621425', '\'1505044510100003', 'MUARO JAMBI', '2010-11-05', 'Kelas 8 - 01', '13 th, 9 bln', 'Aktif', 'Perempuan', 'DESA MUARO JAMBI, RT. 06 MUARO JAMBI, MARO SEBO, MUARO JAMBI, JAMBI, 36391, 36391', '', 'Tidak Ada', 'Tidak Ada', '', 'LAHMUDIN SIRAIT', 'YUSNAWATI', 'YUSNAWATI', 31),
('13', 'PARAH SYAKIRAH', '0105520216', '\'1571055004100001', 'JAMBI', '2010-04-10', 'Kelas 8 - 01', '14 th, 4 bln', 'Aktif', 'Perempuan', 'Jl. Majapahit, Rt. 03 PAYO SELINCAH, PAAL MERAH, KOTA JAMBI, JAMBI, 36135, 36135', '', 'Tidak Ada', 'Tidak Ada', '', 'MUHAMMAD ALI', 'YUSRO', 'MUHAMMAD ALI', 32),
('14', 'KHOLILURROHMAN', '3101614483', '\'1505062007100010', 'MUARA KUMPEH', '2010-07-20', 'Kelas 8 - 01', '14 th, 0 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Raya, Km. 05, Rt.06 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'TOIP DAMUR', 'SAHIDA', 'TOIP DAMUR', 33),
('15', 'ROIHAN AR RABBANI', '3102752435', '\'1404091712100001', 'JAMBI', '2010-12-17', 'Kelas 8 - 01', '13 th, 7 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Talang Duku, Rt. 04, Km. 05 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'FATHUL HIDAYAH', 'SALAMIAH', 'TOIP DAMUR', 34),
('16', 'M.SHORIM SYARIF MUBARAK', '3119064669', '\'1505060201110006', 'JAMBI', '2011-01-02', 'Kelas 8 - 01', '13 th, 7 bln', 'Aktif', 'Laki-laki', 'Jl. Jambi-Suak Kandis, Rt.01 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SALMAN', 'NURUL UYUNI', 'SALMAN', 35),
('17', 'SHOFWATUN NIDA BARAQBAH', '0115973272', '\'1571025104110001', 'JAMBI', '2011-04-11', 'Kelas 8 - 01', '13 th, 4 bln', 'Aktif', 'Perempuan', 'Jl. Sersan Darfin Blok A1 No.04, Perum Fatimah EKA JAYA, PAAL MERAH, KOTA JAMBI, JAMBI, 36136, 36136', '', 'Tidak Ada', 'Tidak Ada', '', 'MUHAMMAD TAUFIK', 'SARIFA BADIAH', 'MUHAMMAD TAUFIK', 36),
('18', 'SASKIA ANGGRAINI', '0096258160', '\'1505066012090002', 'MUARA KUMPEH', '2009-12-20', 'Kelas 8 - 01', '14 th, 7 bln', 'Aktif', 'Perempuan', 'MUARA KUMPEH MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', '', 'Tidak Ada', '', 'AFRIZAL', 'ERNI', 'AFRIZAL', 37),
('19', 'ALLIFA ZAHARA LAZUARDI', '0113211625', '\'1571016909110021', 'JAMBI', '2011-09-29', 'Kelas 8 - 01', '12 th, 10 bln', 'Aktif', 'Perempuan', 'JL. LET. M. TAHER LRG.CENDANA SOLOK SIPIN, DANAU SIPIN, KOTA JAMBI, JAMBI, 36121, 36121', '', '', 'Tidak Ada', '', 'AHMAD LAZUARDI', 'IKE TRINI WAHYU', 'AHMAD LAZUARDI', 38),
('20', 'ALFARISZI RAAFIYANTO', '0112756053', '\'1571021903110002', 'JAMBI', '2011-03-19', 'Kelas 8 - 01', '13 th, 4 bln', 'Aktif', 'Perempuan', 'JL. MARENE EKA JAYA, PAAL MERAH, KOTA JAMBI, JAMBI, 36135, 36135', '', '', 'Tidak Ada', '', 'HENDRI YANTO', 'NUR AINI', 'HENDRI YANTO', 39),
('21', 'SYAMSIDH DHUHA ANNURA', '0118066059', '\'1505011804112001', 'JAMBI', '2011-04-18', 'Kelas 8 - 01', '13 th, 3 bln', 'Aktif', 'Laki-laki', 'KEMBAR LESTARI BQ 17 MENDALO DARAT, JAMBI LUAR KOTA, MUARO JAMBI, JAMBI, 36361, 36361', '', '', 'Tidak Ada', '', 'RANU SITO', 'NUZUL LIANA', 'RANU SITO', 40),
('22', 'ALIF ALFIRIZKY', '0101114509', '\'1404091007100002', 'KOTABARU SEBERIDA', '2010-07-10', 'Kelas 8 - 01', '14 th, 1 bln', 'Aktif', 'Laki-laki', 'Desa Muara Kumpeh, Rt. 004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', '', '', '', 'USMAN ALI', 'RINI PUSPITA', 'USMAN ALI', 41),
('23', 'M. ZAHRAN FIRZATULLAH', '0126138425', '\'1571021712120010', 'JAMBI', '2012-04-17', 'Kelas 8 - 01', '12 th, 3 bln', 'Aktif', 'Laki-laki', 'JL. LIPOSOS I EKA JAYA, PAAL MERAH, KOTA JAMBI, JAMBI, 36135, 36135', '', '', 'Tidak Ada', '', 'FERI FADLI', 'NUNUNG SETIAWATI', 'FERI FADLI', 42),
('24', 'ZAHRA AZKIA', '0111449517', '\'1409026604110003', 'SELANGOR', '2011-04-26', 'Kelas 8 - 01', '13 th, 3 bln', 'Aktif', 'Perempuan', 'Desa muara kumpeh, Rt. 004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Hervrizal', 'RAUDATUL JANNAH', 'Hervrizal', 43),
('25', 'LAILATUL SYAHADA', '0093527445', '\'1571075509090022', 'JAMBI', '2009-09-15', 'Kelas 8 - 01', '14 th, 10 bln', 'Aktif', 'Perempuan', 'Jl. Kapt. Patimura, RT.04 KENALI ASAM BAWAH, KOTA BARU, KOTA JAMBI, JAMBI, 36129, 36129', '0', 'Tidak Ada', 'Tidak Ada', '', 'TEGUH ARDI PRASETYO', 'SITITI LUGENA', 'SITITI LUGENA', 44),
('1', 'SAHADAT SATRIA', '3107772313', '\'1505060110100006', 'JAMBI', '2010-10-01', 'Kelas 9 - 01', '13 th, 10 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan  Tlang Duku, RT. 16 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6288286844089', 'Tidak Ada', 'Tidak Ada', '', 'ABD. RAHMAN', 'ERMAWATI', 'ABD. RAHMAN', 45),
('2', 'FATHUL KAROMAH', '3092050026', '\'1571072806090081', 'JAMBI', '2009-06-28', 'Kelas 9 - 01', '15 th, 1 bln', 'Aktif', 'Laki-laki', 'PERUM KOTA BARU INDAH BLOK B3 NO.96/97 KENALI ASAM BAWAH, KOTA BARU, KOTA JAMBI, JAMBI, 36129, 36129', '6288286844126', 'Tidak Ada', 'Tidak Ada', '', 'FAYUMI, M.PD.I', 'N I S Y A T I', 'NISYATI M.PD.I', 46),
('3', 'FADILAH NAJJEMA U JAWAID', '3105392519', '\'1505067007100001', 'JAMBI', '2010-07-30', 'Kelas 9 - 01', '14 th, 0 bln', 'Aktif', 'Perempuan', 'Kasang Pudak RT 032 KASANG KOTA KARANG, KUMPEH ULU, MUARO JAMBI, JAMBI, 36361, 36361', '6281320606505', 'Tidak Ada', 'Tidak Ada', '', 'ALI MURDOMO', 'SUGIYANTI', 'ALI MURDOMO', 47),
('4', 'SHODIQOH SABRINA', '3105685495', '\'123456789       ', 'JAMBI', '2010-10-30', 'Kelas 9 - 01', '13 th, 9 bln', 'Aktif', 'Perempuan', 'Jl. Lintas Jambi - Suak Kandis, RT. 014 ARANG ARANG, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '0', 'Tidak Ada', 'Tidak Ada', '', 'SOPIAN', 'YULIANA SST', 'SOPIAN', 48),
('5', 'RTS. NURIFA SARI', '3105274933', '\'1505065612100003', 'MUARA KUMPEH', '2010-12-16', 'Kelas 9 - 01', '13 th, 7 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Talang Duku, RT.03 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6288286844086', 'Tidak Ada', 'Tidak Ada', '', 'SARKONI', 'NURAIDA', 'SARKONI', 49),
('6', 'VIVY SEFTY NUR AINI', '3101450420', '\'1505066509100003', 'JAMBI', '2010-09-25', 'Kelas 9 - 01', '13 th, 10 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Talang Duku, Km.05, Rt. 13 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6288286844505', 'Tidak Ada', 'Tidak Ada', '', 'NICO LAUS', 'LENI PURWANTI', 'NICO LAUS', 50),
('7', 'SIGIT SURYA SAPUTRA', '0098056704', '\'1507041812090002', 'RANTAU RASAU', '2009-12-18', 'Kelas 9 - 01', '14 th, 7 bln', 'Aktif', 'Laki-laki', 'EKA JAYA, RT. 12 EKA JAYA, PAAL MERAH, KOTA JAMBI, JAMBI, 36139, 36139', '6283847126083', 'Tidak Ada', 'Tidak Ada', '', 'Sugianto', 'SUSANTI', 'Sugianto', 51),
('8', 'RESTY AGGRAINI', '0102254829', '\'1505065507100010', 'PUDAK', '2010-01-17', 'Kelas 9 - 01', '14 th, 6 bln', 'Aktif', 'Perempuan', 'Pudak, Rt/Rw. 002/001 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Sukirman', 'YULI SUMARTI', 'Sukirman', 52),
('9', 'SINTIA', '0106336302', '\'1505065212080003', 'PUDAK', '2010-10-06', 'Kelas 9 - 01', '13 th, 10 bln', 'Aktif', 'Perempuan', 'Pudak, Rt. 001 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36668, 36668', '', 'Tidak Ada', 'Tidak Ada', '', 'HERMAN', 'YENI', 'HERMAN', 53),
('10', 'REIHAN FALAJ', '0099427681', '\'1571030412090041', 'JAMBI', '2009-12-04', 'Kelas 9 - 01', '14 th, 8 bln', 'Aktif', 'Laki-laki', 'Muara Kumpeh, Rt. 004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36147, 36147', '', 'Tidak Ada', 'Tidak Ada', '', 'Mustofa Husein Hasibuan', 'ENTIN RUSTINI', 'Mustofa Husein Hasibuan', 54),
('11', 'MILLA RODHIYA', '0102946140', '\'1505066509100001', 'PUDAK', '2010-09-26', 'Kelas 9 - 01', '13 th, 10 bln', 'Aktif', 'Perempuan', 'Pudak, Rt. 006 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Zazuli', 'SITI S', 'Zazuli', 55),
('12', 'MADIL PRATAMA', '0102788897', '\'1245679006787899', 'MUARA KUMPEH', '2010-04-17', 'Kelas 9 - 01', '14 th, 3 bln', 'Aktif', 'Laki-laki', 'MUARA KUMPEH, Rt/Rw. 004/001 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'MASRONI', 'YENI RAHMA WATI', 'MASRONI', 56),
('13', 'DHIYA UL HUSNA', '0103376626', '\'1505060112070002', 'MUARA KUMPEH', '2010-06-18', 'Kelas 9 - 01', '14 th, 1 bln', 'Aktif', 'Perempuan', 'Muara Kumpeh, Rt/Rw. 009/002 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SALMANSYAH', 'SAIDAH', 'SALMANSYAH', 57),
('14', 'PURI YUSNAINI', '0096338608', '\'1505065812090004', 'MUARA KUMPEH', '2009-12-18', 'Kelas 9 - 01', '14 th, 7 bln', 'Aktif', 'Perempuan', 'Muara Kumpeh, Rt. 005 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36668, 36668', '', 'Tidak Ada', 'Tidak Ada', '', 'YUSDI', 'HAMDANA', 'YUSDI', 58),
('15', 'LINDA APRILIA ANGRAINI', '0101933346', '\'1505034504100002', 'BETUNG', '2010-04-05', 'Kelas 9 - 01', '14 th, 4 bln', 'Aktif', 'Perempuan', 'SIMPANG, Rt/Rw. 015/004 SIMPANG, BERBAK, TANJUNG JABUNG TIMUR, JAMBI, 36572, 36572', '', 'Tidak Ada', 'Tidak Ada', '', 'SUNANDAR', 'NELI AGUSTIN', 'SUNANDAR', 59),
('16', 'NAZHIFAH AURORA', '0109513152', '\'1505066612100001', 'MUARO JAMBI', '2010-12-26', 'Kelas 9 - 01', '13 th, 7 bln', 'Aktif', 'Perempuan', 'Lrg. Rimba Sakti, Rt. 20 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6283157631874', 'Tidak Ada', 'Tidak Ada', '', 'MULYADI', 'FITRIA', 'MULYADI', 60),
('17', 'MUHAMMAD ROZAQUN', '3117990891', '\'1571080603110001', 'KEBUN JATI LAHAT', '2011-03-06', 'Kelas 9 - 01', '13 th, 5 bln', 'Aktif', 'Laki-laki', 'Jl. Lintas Jambi-Suak Kandis, Rt.15, Rw.03 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '628993004207', 'Tidak Ada', 'Tidak Ada', '', 'NOVIZAR', 'TITIN SUMANTI', 'NOVIZAR', 61),
('18', 'RIF\'AH AULIAH RAMADANI', '3108630559', '\'1505064609100002', 'JAMBI', '2010-09-08', 'Kelas 9 - 01', '13 th, 11 bln', 'Aktif', 'Perempuan', 'Jl. Pelabuhan Talang Duku, Km.5, RT. 08 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '6288286844096', 'Tidak Ada', 'Tidak Ada', '', 'SOPIAN SAFI`I', 'TITIN ARITA', 'SOPIAN SAFI`I', 62),
('19', 'MUHAMMAD FIQRI', '0091114874', '\'1508052610090001', 'MUARA BUNGO', '2009-10-26', 'Kelas 9 - 01', '14 th, 9 bln', 'Aktif', 'Laki-laki', 'PASIBAN TANAH, RT.001 CANDI, TANAH SEPENGGAL, BUNGO, JAMBI, 37263, 37263', '', 'Tidak Ada', 'Tidak Ada', '', 'AAN GUSTIAN', 'LINDA SURYANI', 'AAN GUSTIAN', 63),
('20', 'MARDIANA AYU PUTRI', '0084946677', '\'1505064206080001', 'JAMBI', '2008-06-02', 'Kelas 9 - 01', '16 th, 2 bln', 'Aktif', 'Perempuan', 'Pudak RT 01 SUNGAI TERAP, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'MARKONI', 'MAHDALENA', 'MARKONI', 64),
('21', 'Anggin April Prihatiwi', '0108237808', '\'1571035404100022', 'Jambi', '2010-04-14', 'Kelas 9 - 01', '14 th, 3 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'ASNAWI', 'Prihatin', 'ASNAWI', 65),
('22', 'Aby Rizky Pratama', '3109981512', '\'1571080101100001', 'Jambi', '2010-01-01', 'Kelas 9 - 01', '14 th, 7 bln', 'Aktif', 'Laki-laki', 'Jl. SUNAN GUNUNG JATI KENALI ASAM BAWAH, KOTA BARU, KOTA JAMBI, JAMBI, 36129, 36129', '', 'Tidak Ada', 'Tidak Ada', '', 'ZULFA UMRA', 'Lely Maheny Purba', 'ZULFA UMRA', 66),
('23', 'SHOFWA HUMAIRO', '0107278051', '\'1505066208100001', 'Muaro Kumpeh', '2010-08-22', 'Kelas 9 - 01', '13 th, 11 bln', 'Aktif', 'Perempuan', 'MUARA KUMOEH MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36668, 36668', '', 'Tidak Ada', 'Tidak Ada', '', 'A. ZAIRONI', 'Fadila', 'A. ZAIRONI', 67),
(NULL, 'a', 'a', 'a', 'a', '1991-02-01', '1', '1', '1', 'Laki-laki', '1', '1', '1', '1', '1', '1', '1', '1', 68),
('2', 'a', 'a', '2', '2', '1331-02-02', 'Kelas 8 - 01', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'b', 'a', 69),
('1', 'M.FAHMI IRSYAD', '0091537885', '\'1571022308090001', 'JAMBI', '2009-08-23', 'Kelas 9 - 02', '14 th, 11 bln', 'Aktif', 'Laki-laki', 'Muara Kumpeh, Rt.04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SUJADI', 'MUNFA\'ATI', 'SUJADI', 70),
('2', 'ABDUL HAFIZ ANSORI', '0101940958', '\'1505061001100002', 'MUARA KUMPEH', '2010-01-10', 'Kelas 9 - 02', '14 th, 7 bln', 'Aktif', 'Laki-laki', 'muara kumpeh, Rt/Rw. 004/000 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Sarpani', 'ZURYANI', 'Sarpani', 71),
('3', 'QUROTA AKYUN', '0118665701', '\'1571034805110001', 'JAMBI', '2011-05-08', 'Kelas 9 - 02', '13 th, 3 bln', 'Aktif', 'Perempuan', 'Jl. Kerajaan Melayu Dusun Tanjung Sari TANJUNG SARI, JAMBI TIMUR, KOTA JAMBI, JAMBI, 36147, 36147', '', 'Tidak Ada', 'Tidak Ada', '', 'SUNARTO', 'KOMALA DEWI', 'SUNARTO', 72),
('4', 'DARWAN SANI', '0105523458', '\'1507100104100003', 'LAGAN TENGAH', '2010-04-01', 'Kelas 9 - 02', '14 th, 4 bln', 'Aktif', 'Laki-laki', 'Desa Muara Kumpeh, Rt. 004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'USMAN', 'KHAIRUN NISAR', 'USMAN', 73),
('5', 'AHMAD AZZAM', '0106721413', '\'1508050704100001', 'MUARA BUNGO', '2010-04-07', 'Kelas 9 - 02', '14 th, 4 bln', 'Aktif', 'Laki-laki', 'DESA MUARA KUMPEH RT.04 CANDI, TANAH SEPENGGAL, BUNGO, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'M. AHMAD  YANI', 'HJ. NOR ASIAH', 'M. AHMAD  YANI', 74),
('6', 'M. ZIQRY RAMADHAN', '0105695091', '\'1571030608100081', 'JAMBI', '2010-08-06', 'Kelas 9 - 02', '14 th, 0 bln', 'Aktif', 'Laki-laki', 'LR. Hidayat Dusun Rajawali RAJAWALI, JAMBI TIMUR, KOTA JAMBI, JAMBI, 36143, 36143', '', 'Tidak Ada', 'Tidak Ada', '', 'MUHAMAD SAPRI', 'DINA WISMA', 'MUHAMAD SAPRI', 75),
('7', 'RIFKY RAMADHAN', '0105145542', '\'1571023108100041', 'JAMBI', '2010-08-31', 'Kelas 9 - 02', '13 th, 11 bln', 'Aktif', 'Laki-laki', 'JL. Marene, Rt. 019 EKA JAYA, PAAL MERAH, KOTA JAMBI, JAMBI, 36135, 36135', '', 'Tidak Ada', 'Tidak Ada', '', 'EKO HARIYANTO', 'LISMAYANTI', 'EKO HARIYANTO', 76),
('8', 'MUHAMMAD AL IQBAL', '0101403421', '\'1505112106100002', 'MUARO JAMBI', '2010-06-21', 'Kelas 9 - 02', '14 th, 1 bln', 'Aktif', 'Laki-laki', 'JL. H.M.YUSUF NASRI NO.37 WIJAYA PURA, JAMBI SELATAN, KOTA JAMBI, JAMBI, 36131, 36131', '', 'Tidak Ada', 'Tidak Ada', '', 'RAHMAT', 'IDA YANI', 'RAHMAT', 77),
('9', 'MUHAMAD SOLEH', '0092935053', '\'1505022802090003', 'JAMBI', '2009-02-28', 'Kelas 9 - 02', '15 th, 5 bln', 'Aktif', 'Laki-laki', 'SUKO AWIN JAYO, Rt.009 SUKO AWIN JAYA, SEKERNAN, MUARO JAMBI, JAMBI, 36381, 36381', '', 'Tidak Ada', 'Tidak Ada', '', 'ADI SAPUTRA', 'JUWITA ANGGRAINI', 'ADI SAPUTRA', 78),
('10', 'ANNISA USHOLEHA', '0093176976', '\'1505054404080001', 'JAMBI', '2009-04-04', 'Kelas 9 - 02', '15 th, 4 bln', 'Aktif', 'Perempuan', 'Desa Muara Kumpeh, Rt. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'ROHADI', 'MATURIAH', 'MATURIAH', 79),
('11', 'Sri Mulyati', '0093860566', '\'1502175509090001', 'Kampung Limo', '2009-06-15', 'Kelas 9 - 02', '15 th, 1 bln', 'Aktif', 'Perempuan', 'Desa Muara kumpeh, Rt. 004 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Ardison', 'Martini', 'Ardison', 80),
('12', 'NABILA THOYBA', '0091049243', '\'1505065303090002', 'JAMBI', '2009-03-13', 'Kelas 9 - 02', '15 th, 4 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'HAZIRIN', 'EVI FITRIANI', 'HAZIRIN', 81),
('13', 'CHIKA WARDANA PUTRI', '0102213460', '\'1505066901100001', 'MUARA KUMPEH', '2010-01-29', 'Kelas 9 - 02', '14 th, 6 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SOFYAN HADI', 'ANALIA', 'SOFYAN HADI', 82),
('14', 'KALILAH IRMA PUTRI', '0108097250', '\'1505116004100001', 'MUARO JAMBI', '2010-04-20', 'Kelas 9 - 02', '14 th, 3 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'IRMANSYAH', 'SITI KHASANAH', 'IRMANSYAH', 83),
('15', 'Neiza Grezz', '0087232518', '\'1571035007080081', 'Jambi', '2008-07-10', 'Kelas 9 - 02', '16 th, 1 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SAMIN', 'Sunarsih', 'SAMIN', 84),
('16', 'Febriansyah Al Fikri', '0094327092', '', 'Jambi', '2009-02-06', 'Kelas 9 - 02', '15 th, 6 bln', 'Aktif', 'Laki-laki', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Taufik hidayat', 'Fitriani', 'Taufik hidayat', 85),
('17', 'SYAIFULLAH ARROSIDI', '0107393000', '\'1505061108100002', 'JAMBI', '2010-08-11', 'Kelas 9 - 02', '14 th, 0 bln', 'Aktif', 'Laki-laki', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'FAHRUL ROZI', 'PARTIWI', 'FAHRUL ROZI', 86),
('18', 'LUTHFI FATHURRAHMAN', '3109488839', '\'1505061510100001', 'Muaro Jambi', '2010-10-15', 'Kelas 9 - 02', '13 th, 9 bln', 'Aktif', 'Laki-laki', 'Jl. Pudak, Rt. 04 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SUJAMIN', 'ERNI', 'SUJAMIN', 87),
('19', 'MUHAMMAD ZAKI MUBAROK', '0041872025', '', 'PUDAK', '2004-11-20', 'Kelas 9 - 02', '19 th, 8 bln', 'Aktif', 'Laki-laki', 'Jl. Pudak, Rt. 22 PUDAK, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'SALMAN', 'NURUL UYUNI', 'SALMAN', 88),
('20', 'ILHAM SURYA FITRAH', '0095994547', '\'1571020410090061', 'Jambi', '2009-10-04', 'Kelas 9 - 02', '14 th, 10 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Talang Duku, Rt. 10 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'BAMBANG UTORO', 'Mila Karmila', 'BAMBANG UTORO', 89),
('21', 'Nizhan Pradipta', '0099241675', '\'1504012602090002', 'Simpang Rantau Gedang', '2009-02-26', 'Kelas 9 - 02', '15 th, 5 bln', 'Aktif', 'Laki-laki', 'Jl. Pelabuhan Talang Duku, Rt. 08 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'FAUZI', 'Roma Yana', 'FAUZI', 90),
('22', 'NURIZATUL KHOTIMA', '0099826630', '\'1504024906090001', 'RAMBUTAN MASAM', '2009-06-09', 'Kelas 9 - 02', '15 th, 2 bln', 'Aktif', 'Perempuan', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Fatihi', 'SITI AMINAH', 'Fatihi', 91),
('23', 'WAHYU BRYLIANDO PRATAMA', '0103075996', '\'1571013006100021', 'Jambi', '2010-06-30', 'Kelas 9 - 02', '14 th, 1 bln', 'Aktif', 'Laki-laki', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Hendra kusuma wardana', 'LANI PURNAMA SARI', 'Hendra kusuma wardana', 92),
('24', 'M. LATIF SIDDIQ', '0101390347', '\'1404100408100002', 'Tanah Merah', '2010-08-04', 'Kelas 9 - 02', '14 th, 0 bln', 'Aktif', 'Laki-laki', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Helman', 'Dahrumiyana, S.Pd', 'Helman', 93),
('25', 'DEKA SAPUTRA', '0103754783', '\'1218092401100001', 'LAMPUNG', '2010-01-24', 'Kelas 9 - 02', '14 th, 6 bln', 'Aktif', 'Laki-laki', 'JL. PELABUHAN RAYA KM.5, RT. 04 MUARA KUMPEH, KUMPEH ULU, MUARO JAMBI, JAMBI, 36373, 36373', '', 'Tidak Ada', 'Tidak Ada', '', 'Enggar wansyah', 'NURLINAWATI HASIBUAN', 'Enggar wansyah', 94);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','wali_kelas','kepala_sekolah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'guru', 'guru123', 'guru'),
(3, 'walikelas', 'walikelas123', 'wali_kelas'),
(4, 'koordinator', 'koordinator123', ''),
(5, 'kepalasekolah', 'kepalasekolah123', 'kepala_sekolah'),
(6, '1', '$2y$10$nCaC4XWzyJHsJSFrhITV8uAbqx1vQCrkxjulBL4wno9zN5SziaUF2', 'admin'),
(7, '2', '$2y$10$7dmx11Sc4icmbz9KWCxkEeCwvfjoUbSH1WxFRiAXlVpKfwwx0ukDi', 'admin'),
(8, '3', '$2y$10$Q/mE0ciKneAYPXnvXiGF/.25.LoMy78D6rIL0A3obE64VrK3ZsAuq', 'admin'),
(9, '4', '$2y$10$GjoCQ8GyDLK5/4A5PyQ05OoAzr1muBCqmDYX6IkhqMPNwjffbJPzW', 'guru'),
(10, 'g', '$2y$10$q5wV0dcnz6rwjFKKIBT2rOlrks0X8nGglRXMi/fYRrJJdGOuEKF/.', 'guru'),
(11, 'g', '$2y$10$jXvccaasRnZEW/zRQkCOyu.aMKSmmVNrKrvk9k5FyQsXr5oowpfVy', 'guru'),
(12, 'a', '$2y$10$b.W5y9L5vLs4qSYiWaUgv.43cK.CjIi1Oj/IPIES5Wt665lkKwMBC', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_ibfk_1` (`student_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `siswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
