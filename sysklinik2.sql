-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2019 at 01:20 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sysklinik2`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_karyawan`
--

CREATE TABLE `absen_karyawan` (
  `id_absen` int(11) NOT NULL,
  `id_pegawai` varchar(10) DEFAULT NULL,
  `tgl` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `ket_izin` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen_karyawan`
--

INSERT INTO `absen_karyawan` (`id_absen`, `id_pegawai`, `tgl`, `jam_masuk`, `jam_keluar`, `ket_izin`) VALUES
(1, '0101001', '2019-08-13', '09:18:49', '15:30:16', ''),
(2, 'TW001', '2019-08-05', '05:51:18', '11:36:09', ''),
(3, 'AD001', '2019-08-06', '08:15:37', '21:22:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `alat_in`
--

CREATE TABLE `alat_in` (
  `id_pb` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `jml_barang` int(5) NOT NULL,
  `no_kwitansi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_in`
--

INSERT INTO `alat_in` (`id_pb`, `id_barang`, `tgl`, `jml_barang`, `no_kwitansi`) VALUES
(1, 'K001', '2019-08-12', 110, '284');

-- --------------------------------------------------------

--
-- Table structure for table `alat_out`
--

CREATE TABLE `alat_out` (
  `id_pj` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `jml_barang` int(5) NOT NULL,
  `no_kwitansi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_out`
--

INSERT INTO `alat_out` (`id_pj`, `id_barang`, `tgl`, `jml_barang`, `no_kwitansi`) VALUES
(1, 'K001', '2019-08-13', 10, '435');

-- --------------------------------------------------------

--
-- Table structure for table `alat_terapi`
--

CREATE TABLE `alat_terapi` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat_terapi`
--

INSERT INTO `alat_terapi` (`id_barang`, `nama_barang`, `stok`) VALUES
('K001', 'Kartu Bermain', NULL),
('K002', 'Buku Gambar', NULL),
('K003', 'Puzzle Gambar', 100);

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `id_asses` int(11) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `id_pegawai` varchar(15) DEFAULT NULL,
  `tgl_mulai_terapi` date DEFAULT NULL,
  `tgl_selesai_terapi` date DEFAULT NULL,
  `diagnosa` text,
  `status_pasien` enum('Daftar','Asses','Pasien','Lulus','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`id_asses`, `id_pasien`, `id_pegawai`, `tgl_mulai_terapi`, `tgl_selesai_terapi`, `diagnosa`, `status_pasien`) VALUES
(190830150, '1111111', 'T190828267', '2019-10-11', '2019-10-31', NULL, 'Asses'),
(190830153, '1001001', 'T190828267', '2019-10-06', '2019-10-31', NULL, 'Asses');

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id_daftar` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `keluhan` text NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`id_daftar`, `id_pasien`, `tgl`, `keluhan`, `status`) VALUES
(1, 1001001, '2019-10-08', 'hai', '1'),
(2, 1111111, '2019-10-10', 'as', '1');

-- --------------------------------------------------------

--
-- Table structure for table `d_billing`
--

CREATE TABLE `d_billing` (
  `id_bukti` varchar(10) NOT NULL,
  `id_bill` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` int(10) NOT NULL,
  `tgl_denda` date DEFAULT NULL,
  `denda` int(10) DEFAULT NULL,
  `foto` varchar(10) NOT NULL,
  `status_bayarbill` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_pasien`
--

CREATE TABLE `d_pasien` (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan','','','') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Protestan','Hindu','Buddha') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tlp` int(15) NOT NULL,
  `keluhan` varchar(200) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nik_ayah` int(20) NOT NULL,
  `agama_ayah` enum('Islam','Kristen','Protestan','Hindu','Buddha') NOT NULL,
  `alamat_ayah` varchar(200) NOT NULL,
  `pend_ayah` varchar(10) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `tlp_ayah` int(15) NOT NULL,
  `email_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `nik_ibu` int(20) NOT NULL,
  `agama_ibu` enum('Islam','Kristen','Protestan','Hindu','Buddha') NOT NULL,
  `alamat_ibu` varchar(200) NOT NULL,
  `pend_ibu` varchar(10) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `tlp_ibu` int(15) NOT NULL,
  `email_ibu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_pasien`
--

INSERT INTO `d_pasien` (`id`, `id_pasien`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `alamat`, `tlp`, `keluhan`, `foto`, `nama_ayah`, `nik_ayah`, `agama_ayah`, `alamat_ayah`, `pend_ayah`, `pekerjaan`, `tlp_ayah`, `email_ayah`, `nama_ibu`, `nik_ibu`, `agama_ibu`, `alamat_ibu`, `pend_ibu`, `pekerjaan_ibu`, `tlp_ibu`, `email_ibu`) VALUES
(2, '1001001', 'Fulani', 'tangerang', '2015-08-03', 'Perempuan', 'Islam', 'Jl. Jalan Gg. Gang RT 000 RW 999 No. 09, Kel. Kelurahan, Kec. Kecamatan, Jakarta Timur, DKI Jakarta', 22342423, 'kurang lancar berbicara', '1001001', 'kasino', 342, 'Islam', 'Jl. Jalan Gg. Gang RT 000 RW 999 No. 09, Kel. Kelurahan, Kec. Kecamatan, Jakarta Timur, DKI Jakarta', 'D3', 'karyawan', 234232, 'ayah@gmail.com', 'kiki', 23421, 'Islam', 'Jl. Jalan Gg. Gang RT 000 RW 999 No. 09, Kel. Kelurahan, Kec. Kecamatan, Jakarta Timur, DKI Jakarta', 'D3', 'guru', 321311121, 'ibu@gmail.com'),
(3, '1111111', 'demoo', 'ciputat', '2010-01-27', 'Laki-laki', 'Islam', 'Kp.Maruga RT 05/04', 3234234, 'susah bersosialisasi', '1111111', 'koko', 3423, 'Islam', 'Kp.Maruga RT 05/04', 'S2', 'apaja', 3423, 'ayah@gmail.com', 'kiko', 4234, 'Islam', 'Kp.Maruga RT 05/04', 'S1', 'guru', 342, 'ibu@gmail.com'),
(6, '1111114', 'indro', '', '2019-07-03', 'Laki-laki', 'Buddha', 'alamatnya', 2342234, 'kepo', '', 'aayah', 4435464, 'Islam', '', '', 'karyawan swasta', 3453242, 'ayah@gmail.com', 'iibu', 35434656, 'Islam', '', '', '', 65345344, 'ibu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `d_pegawai`
--

CREATE TABLE `d_pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_terapi` varchar(5) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan','','') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Protestan','Hindu','Buddha') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `pend_akhir` varchar(100) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `tgl_masuk` date NOT NULL,
  `gaji` int(10) NOT NULL,
  `observasi` int(10) DEFAULT NULL,
  `asses` int(10) DEFAULT NULL,
  `konsumsi` int(10) DEFAULT NULL,
  `bpjs` int(13) DEFAULT NULL,
  `npwp` int(13) DEFAULT NULL,
  `transport` int(10) DEFAULT NULL,
  `bonus` int(10) DEFAULT NULL,
  `lembur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_pegawai`
--

INSERT INTO `d_pegawai` (`id_pegawai`, `id_jabatan`, `id_terapi`, `nama`, `nik`, `tgl_lahir`, `jk`, `agama`, `alamat`, `tlp`, `pend_akhir`, `foto`, `tgl_masuk`, `gaji`, `observasi`, `asses`, `konsumsi`, `bpjs`, `npwp`, `transport`, `bonus`, `lembur`) VALUES
('K190828357', 3, 'FT', 'Muhammad hasby ash shiddieqy', '23123412', '2019-08-22', 'Laki-laki', 'Islam', 'kampung', '081937373742', 'D3', 'K190828357', '2019-08-20', 4000000, 100000, 200000, 2000000, 0, 0, 1000000, 500000, 1000000),
('T190828267', 5, 'AT', 'hasby', '3243243243243', '1999-08-14', 'Laki-laki', 'Islam', 'maruga', '081937373742', 'D3', 'T190828267', '2019-08-26', 3000000, 100000, 200000, 100000, 0, 0, 1000000, 500000, 1000000),
('T190829045', 4, NULL, 'dian', '1213123213232', '1996-08-01', 'Perempuan', 'Islam', 'Cipete raya', '081904057464', 'S1', 'T190829045', '2019-08-29', 2500000, 400000, 100000, 250000, 0, 0, 150000, 200000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `d_rekam_medis`
--

CREATE TABLE `d_rekam_medis` (
  `id_sesirm` int(11) NOT NULL,
  `id_rm` varchar(10) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `area_stimulasi` varchar(225) NOT NULL,
  `keterangan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_billing`
--

CREATE TABLE `h_billing` (
  `id_bill` varchar(10) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_izin` int(11) NOT NULL,
  `biaya` int(10) NOT NULL,
  `sisa_tagihan` int(10) NOT NULL,
  `denda` int(10) NOT NULL,
  `sisa_sesi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_pasien`
--

CREATE TABLE `h_pasien` (
  `id_pasien` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_pasien`
--

INSERT INTO `h_pasien` (`id_pasien`, `password`) VALUES
('1001001', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1111111', '5f4dcc3b5aa765d61d8327deb882cf99'),
('1111114', 'e09f1c1ba45b8a826fd563996b8925fb');

-- --------------------------------------------------------

--
-- Table structure for table `h_pegawai`
--

CREATE TABLE `h_pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hakakses` enum('super user','admin','user','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_pegawai`
--

INSERT INTO `h_pegawai` (`id_pegawai`, `password`, `hakakses`) VALUES
('K190828357', '7e004c87114319ae34060060ee092855', 'admin'),
('T190828267', 'b9ecaa239d711d46e0a4f74972c034bb', 'user'),
('T190829045', '28e93e0ed2dfe58935ce6b6520cb0ccb', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `h_rekam_medis`
--

CREATE TABLE `h_rekam_medis` (
  `id_rm` varchar(10) NOT NULL,
  `id_pasien` varchar(10) NOT NULL,
  `id_asses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_rekam_medis`
--

INSERT INTO `h_rekam_medis` (`id_rm`, `id_pasien`, `id_asses`) VALUES
('RM001', '0101001', 0),
('RM002', '1001001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Ketua Yayasan'),
(2, 'Pimpinan'),
(3, 'General Affair'),
(4, 'Front Dest/Operator'),
(5, 'Terapis'),
(6, 'Koperasi/Kebersihan'),
(7, 'Kebersihan');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_terapis`
--

CREATE TABLE `jadwal_terapis` (
  `id_jadwal` int(11) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `id_asses` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_terapi`
--

CREATE TABLE `jenis_terapi` (
  `id_terapi` varchar(5) NOT NULL,
  `terapi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_terapi`
--

INSERT INTO `jenis_terapi` (`id_terapi`, `terapi`) VALUES
('AT', 'Aquarobic Terapi'),
('DK', 'Dokter'),
('FT', 'Fisio Terapi'),
('OP', 'Orthopedagogic Terapi'),
('OT/SI', 'Okupasi Terapi/Sensor Integration'),
('ST', 'Snoezelen Terapi'),
('TW', 'Terapi Wicara');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `tgl_login` date NOT NULL,
  `tgl_logout` date NOT NULL,
  `jam_login` time NOT NULL,
  `jam_logout` time NOT NULL,
  `durasi` time NOT NULL,
  `hakakses` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id_payroll` int(11) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `gaji` int(10) DEFAULT NULL,
  `observasi` int(10) DEFAULT NULL,
  `asses` int(10) DEFAULT NULL,
  `konsumsi` int(10) DEFAULT NULL,
  `transport` int(10) DEFAULT NULL,
  `bonus` int(10) DEFAULT NULL,
  `lembur` int(10) DEFAULT NULL,
  `gaji_kotor` int(10) NOT NULL,
  `pph` int(10) DEFAULT NULL,
  `asuransi` int(10) DEFAULT NULL,
  `lainnya` int(10) DEFAULT NULL,
  `total_pengeluaran` int(10) NOT NULL,
  `gaji_bersih` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_income` int(11) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kategori` enum('Saldo','Billing','Uang Pangkal','Assessment','BB/Cashbon') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_income`, `id_karyawan`, `tgl`, `keterangan`, `jumlah`, `kategori`) VALUES
(1, 'TW001', '2019-08-12', 'Uang Pangkal', 100, 'Uang Pangkal');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_outcome` int(11) NOT NULL,
  `id_karyawan` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kategori` enum('Listrik','Telkom','Pajak','Intensif Terapi','Fee Staff','Bonus','Beban lainnya') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_outcome`, `id_karyawan`, `tgl`, `keterangan`, `jumlah`, `kategori`) VALUES
(1, 'TW001', '2019-08-13', 'Makan', 10, 'Beban lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `record_izin`
--

CREATE TABLE `record_izin` (
  `id_izin` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `status_absen` enum('Hadir','Izin','Sisa','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record_status_pasien`
--

CREATE TABLE `record_status_pasien` (
  `id_status` int(11) NOT NULL,
  `id_asses` int(11) DEFAULT NULL,
  `id_pasien` varchar(10) DEFAULT NULL,
  `keterangan` text,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_status_pasien`
--

INSERT INTO `record_status_pasien` (`id_status`, `id_asses`, `id_pasien`, `keterangan`, `tgl`) VALUES
(3, NULL, '1001001', 'daftar', '2019-10-08'),
(4, 190830150, '1111111', 'daftar', '2019-10-10'),
(10, 190830153, '1001001', NULL, '2019-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `request_izin`
--

CREATE TABLE `request_izin` (
  `id_requestizin` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `ket_izin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_jadwal`
--

CREATE TABLE `request_jadwal` (
  `id_requestjadwal` int(11) NOT NULL,
  `id_pegawai` varchar(10) DEFAULT NULL,
  `id_pasien` varchar(10) DEFAULT NULL,
  `hari` text NOT NULL,
  `waktu` text NOT NULL,
  `deksripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `saldo_awal` int(10) NOT NULL,
  `billing` int(10) NOT NULL,
  `uang_pangkal` int(10) NOT NULL,
  `assesment` int(10) NOT NULL,
  `piutang` int(10) NOT NULL,
  `listrik` int(10) NOT NULL,
  `telkom` int(10) NOT NULL,
  `pajak` int(10) NOT NULL,
  `insentif_terapis` int(10) NOT NULL,
  `fee` int(10) NOT NULL,
  `bonus` int(10) NOT NULL,
  `lainnya` int(10) NOT NULL,
  `total_pemasukan` int(10) NOT NULL,
  `total_pengeluaran` int(10) NOT NULL,
  `saldo_akhir` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `tgl`, `saldo_awal`, `billing`, `uang_pangkal`, `assesment`, `piutang`, `listrik`, `telkom`, `pajak`, `insentif_terapis`, `fee`, `bonus`, `lainnya`, `total_pemasukan`, `total_pengeluaran`, `saldo_akhir`) VALUES
(1, '2019-08-31', 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 900);

-- --------------------------------------------------------

--
-- Table structure for table `terapi_pasien`
--

CREATE TABLE `terapi_pasien` (
  `id_terapipasien` int(11) NOT NULL,
  `id_asses` varchar(225) NOT NULL,
  `id_terapi` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terapi_pasien`
--

INSERT INTO `terapi_pasien` (`id_terapipasien`, `id_asses`, `id_terapi`, `status`) VALUES
(1, '190830150', 'AT', '0'),
(2, '190830150', 'OP', '0'),
(3, '190830150', 'TW', '0'),
(4, '190830153', 'FT', '0'),
(5, '190830153', 'TW', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_karyawan`
--
ALTER TABLE `absen_karyawan`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `alat_in`
--
ALTER TABLE `alat_in`
  ADD PRIMARY KEY (`id_pb`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `alat_out`
--
ALTER TABLE `alat_out`
  ADD PRIMARY KEY (`id_pj`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `alat_terapi`
--
ALTER TABLE `alat_terapi`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`id_asses`),
  ADD KEY `id_terapi` (`id_pegawai`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id_daftar`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `d_billing`
--
ALTER TABLE `d_billing`
  ADD PRIMARY KEY (`id_bukti`),
  ADD KEY `id_bill` (`id_bill`);

--
-- Indexes for table `d_pasien`
--
ALTER TABLE `d_pasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `d_pegawai`
--
ALTER TABLE `d_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_terapi` (`id_terapi`);

--
-- Indexes for table `d_rekam_medis`
--
ALTER TABLE `d_rekam_medis`
  ADD PRIMARY KEY (`id_sesirm`),
  ADD KEY `id_rm` (`id_rm`),
  ADD KEY `id_terapis` (`id_jadwal`);

--
-- Indexes for table `h_billing`
--
ALTER TABLE `h_billing`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_tambah` (`id_izin`);

--
-- Indexes for table `h_pasien`
--
ALTER TABLE `h_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `h_pegawai`
--
ALTER TABLE `h_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `h_rekam_medis`
--
ALTER TABLE `h_rekam_medis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_asses` (`id_asses`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jadwal_terapis`
--
ALTER TABLE `jadwal_terapis`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_terapi_pasien` (`id_asses`);

--
-- Indexes for table `jenis_terapi`
--
ALTER TABLE `jenis_terapi`
  ADD PRIMARY KEY (`id_terapi`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id_payroll`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_income`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_outcome`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `record_izin`
--
ALTER TABLE `record_izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `record_status_pasien`
--
ALTER TABLE `record_status_pasien`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_asses` (`id_asses`);

--
-- Indexes for table `request_izin`
--
ALTER TABLE `request_izin`
  ADD PRIMARY KEY (`id_requestizin`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `request_jadwal`
--
ALTER TABLE `request_jadwal`
  ADD PRIMARY KEY (`id_requestjadwal`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `terapi_pasien`
--
ALTER TABLE `terapi_pasien`
  ADD PRIMARY KEY (`id_terapipasien`),
  ADD KEY `id_asses` (`id_asses`),
  ADD KEY `id_terapi` (`id_terapi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_karyawan`
--
ALTER TABLE `absen_karyawan`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `alat_in`
--
ALTER TABLE `alat_in`
  MODIFY `id_pb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `alat_out`
--
ALTER TABLE `alat_out`
  MODIFY `id_pj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `id_asses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190830154;
--
-- AUTO_INCREMENT for table `daftar`
--
ALTER TABLE `daftar`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `d_pasien`
--
ALTER TABLE `d_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `d_rekam_medis`
--
ALTER TABLE `d_rekam_medis`
  MODIFY `id_sesirm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jadwal_terapis`
--
ALTER TABLE `jadwal_terapis`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id_payroll` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_outcome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `record_izin`
--
ALTER TABLE `record_izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `record_status_pasien`
--
ALTER TABLE `record_status_pasien`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `request_izin`
--
ALTER TABLE `request_izin`
  MODIFY `id_requestizin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_jadwal`
--
ALTER TABLE `request_jadwal`
  MODIFY `id_requestjadwal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `terapi_pasien`
--
ALTER TABLE `terapi_pasien`
  MODIFY `id_terapipasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `h_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `d_pegawai`
--
ALTER TABLE `d_pegawai`
  ADD CONSTRAINT `d_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `h_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
