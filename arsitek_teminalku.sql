-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Mar 2022 pada 13.44
-- Versi server: 10.5.15-MariaDB-cll-lve
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsitek_teminalku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `budgeting`
--

CREATE TABLE `budgeting` (
  `id_budgeting` int(30) NOT NULL,
  `proyek` varchar(500) NOT NULL,
  `biaya_total` varchar(30) NOT NULL DEFAULT '0',
  `fk_id_kontruksi` varchar(30) NOT NULL,
  `biaya_kontruksi` varchar(30) NOT NULL DEFAULT '0',
  `biaya_honorium` varchar(30) NOT NULL DEFAULT '0',
  `biaya_perjalanan` varchar(30) NOT NULL DEFAULT '0',
  `biaya_habis_pakai` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `budgeting`
--

INSERT INTO `budgeting` (`id_budgeting`, `proyek`, `biaya_total`, `fk_id_kontruksi`, `biaya_kontruksi`, `biaya_honorium`, `biaya_perjalanan`, `biaya_habis_pakai`) VALUES
(38, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', '33633596000', '2021.08.04.14.10.37', '33633596000', '0', '0', '0'),
(41, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', '23687523000', '2021.08.04.15.32.13', '23687523000', '0', '0', '0'),
(48, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', '15848944000', '2021.08.04.18.54.06', '15848944000', '0', '0', '0'),
(49, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', '50900027000', '2021.08.04.21.06.28', '50900027000', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `budgeting_kontruksi`
--

CREATE TABLE `budgeting_kontruksi` (
  `id_kontruksi` varchar(30) NOT NULL,
  `proyek` varchar(500) NOT NULL,
  `perencana` varchar(30) NOT NULL DEFAULT '0',
  `pengawas` varchar(30) NOT NULL DEFAULT '0',
  `pelaksana` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `budgeting_kontruksi`
--

INSERT INTO `budgeting_kontruksi` (`id_kontruksi`, `proyek`, `perencana`, `pengawas`, `pelaksana`) VALUES
('2021.08.04.14.10.37', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', '0', '0', '33633596000'),
('2021.08.04.15.32.13', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', '0', '0', '23687523000'),
('2021.08.04.18.54.06', 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', '0', '0', '15848944000'),
('2021.08.04.21.06.28', 'Revitalisasi Terminal Penumpang Tipe A Kebumen', '0', '0', '50900027000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_reimbursement`
--

CREATE TABLE `claim_reimbursement` (
  `id_claim_reimbursement` int(255) NOT NULL,
  `jenis_transaksi` int(1) DEFAULT NULL,
  `atas_nama` varchar(150) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `jumlah` float(24,0) DEFAULT NULL,
  `bukti` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_harga`
--

CREATE TABLE `daftar_harga` (
  `id_daftar_harga` int(255) NOT NULL,
  `id_toko` int(255) DEFAULT NULL,
  `nama_barang` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga` float(25,0) DEFAULT NULL,
  `merk` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_harga`
--

INSERT INTO `daftar_harga` (`id_daftar_harga`, `id_toko`, `nama_barang`, `satuan`, `harga`, `merk`) VALUES
(10, 7, 'Besi D10', 'Lonjor', 45000, 'KS'),
(11, 7, 'Besi D12', 'Lonjor', 86000, 'KS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `idfoto` int(11) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `section` varchar(500) NOT NULL,
  `subpekerjaan` varchar(500) NOT NULL,
  `idminggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `proyek` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_pekerjaan`
--

CREATE TABLE `item_pekerjaan` (
  `id_item_pekerjaan` int(255) NOT NULL,
  `id_pekerjaan` int(255) DEFAULT NULL,
  `id_sub_pekerjaan` int(255) DEFAULT NULL,
  `no_refrensi_item_pekerjaan` varchar(25) DEFAULT NULL,
  `nama_item_pekerjaan` varchar(150) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_pekerjaan`
--

INSERT INTO `item_pekerjaan` (`id_item_pekerjaan`, `id_pekerjaan`, `id_sub_pekerjaan`, `no_refrensi_item_pekerjaan`, `nama_item_pekerjaan`, `satuan`) VALUES
(38, 7, 23, '1.', 'Pas. Usuk 5/7 Ky Kruing, Reng 2/3 Ky Kamper', 'm2'),
(39, 7, 23, '2.', 'Pas. Listplang 3/30 Kayu', 'm1'),
(40, 7, 24, '1.', 'Pas. Kusen Kayu', 'm3'),
(41, 7, 24, '2.', 'Pas. Daun Pintu Panil', 'm2'),
(42, 7, 24, '3.', 'Pas. Daun Jendela dan Kaca Kayu', 'm2'),
(43, 7, 24, '4.', 'Pas. Kaca Bening 5mm', 'm2'),
(44, 10, 26, '1', 'item kerja', 'kilo'),
(45, 11, 29, '1', 'galian', 'lonjor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(255) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `no_telpn` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `email`, `no_telpn`, `alamat`) VALUES
(4, 'tes', 'tes@mail.com', '098', 'genteng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(255) NOT NULL,
  `tanggal` datetime(6) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `masuk` float(25,0) DEFAULT NULL,
  `keluar` float(25,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_bobot_pekerjaan`
--

CREATE TABLE `new_bobot_pekerjaan` (
  `id` int(11) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `fk_id_minggu` int(11) NOT NULL,
  `bobot_pekerjaan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_bobot_uraian_kerja`
--

CREATE TABLE `new_bobot_uraian_kerja` (
  `id` int(11) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `fk_id_minggu` int(11) NOT NULL,
  `fk_id_new_pekerjaan` int(11) NOT NULL,
  `volume_detail` double DEFAULT 0,
  `bobot_detail` double DEFAULT 0,
  `keterangan` varchar(255) NOT NULL,
  `volume_akhir` double DEFAULT 0,
  `bobot_akhir` double DEFAULT 0,
  `dokumentasi` varchar(500) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_bobot_uraian_kerja_dephub`
--

CREATE TABLE `new_bobot_uraian_kerja_dephub` (
  `id` int(15) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `fk_id_minggu` int(11) NOT NULL,
  `fk_idnew_pekerjaan_dephub` int(11) NOT NULL,
  `persentase_detail` double NOT NULL,
  `persentase_akhir` double NOT NULL,
  `bobot_persentase_detail` double NOT NULL,
  `bobot_persentase_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `new_bobot_uraian_kerja_dephub`
--

INSERT INTO `new_bobot_uraian_kerja_dephub` (`id`, `proyek`, `fk_id_minggu`, `fk_idnew_pekerjaan_dephub`, `persentase_detail`, `persentase_akhir`, `bobot_persentase_detail`, `bobot_persentase_akhir`) VALUES
(365, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 374, 0, 0, 0, 0),
(366, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 375, 0, 0, 0, 0),
(367, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 376, 0, 0, 0, 0),
(368, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 377, 0, 0, 0, 0),
(369, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 378, 0, 0, 0, 0),
(370, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 379, 0, 0, 0, 0),
(371, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 380, 0, 0, 0, 0),
(372, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 381, 0, 0, 0, 0),
(373, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 382, 0, 0, 0, 0),
(374, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 383, 0, 0, 0, 0),
(375, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 384, 0, 0, 0, 0),
(376, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 385, 0, 0, 0, 0),
(377, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 386, 0, 0, 0, 0),
(378, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 387, 0, 0, 0, 0),
(379, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 388, 0, 0, 0, 0),
(380, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 389, 0, 0, 0, 0),
(381, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 390, 0, 0, 0, 0),
(382, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 391, 0, 0, 0, 0),
(383, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 392, 0, 0, 0, 0),
(384, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 393, 0, 0, 0, 0),
(385, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 394, 0, 0, 0, 0),
(386, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 395, 0, 0, 0, 0),
(387, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 396, 0, 0, 0, 0),
(388, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 397, 0, 0, 0, 0),
(389, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 398, 0, 0, 0, 0),
(390, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 399, 0, 0, 0, 0),
(391, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 400, 0, 0, 0, 0),
(392, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 228, 401, 0, 0, 0, 0),
(459, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 502, 0, 0, 0, 0),
(460, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 503, 0.002, 0.002, 40, 40),
(461, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 504, 0.08, 0.08, 39.60396039604, 39.60396039604),
(462, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 505, 0.08, 0.08, 37.209302325581, 37.209302325581),
(463, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 506, 0.018, 0.018, 24.324324324324, 24.324324324324),
(464, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 507, 0.055, 0.055, 33.742331288344, 33.742331288344),
(465, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 508, 0.002, 0.002, 3.7037037037037, 3.7037037037037),
(466, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 509, 0.008, 0.008, 3.3236393851267, 3.3236393851267),
(467, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 510, 0.005, 0.005, 3.7037037037037, 3.7037037037037),
(468, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 511, 0, 0, 0, 0),
(469, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 512, 0, 0, 0, 0),
(470, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 513, 0, 0, 0, 0),
(471, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 514, 0, 0, 0, 0),
(472, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 515, 0, 0, 0, 0),
(473, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 516, 0, 0, 0, 0),
(474, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 517, 0, 0, 0, 0),
(475, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 518, 0, 0, 0, 0),
(476, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 519, 0, 0, 0, 0),
(477, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 520, 0, 0, 0, 0),
(478, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 521, 0, 0, 0, 0),
(479, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 522, 0, 0, 0, 0),
(480, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 523, 0, 0, 0, 0),
(481, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 524, 0, 0, 0, 0),
(482, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 525, 0, 0, 0, 0),
(483, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 526, 0, 0, 0, 0),
(484, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 527, 0, 0, 0, 0),
(485, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 528, 0, 0, 0, 0),
(486, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 529, 0, 0, 0, 0),
(487, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 530, 0, 0, 0, 0),
(488, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 531, 0, 0, 0, 0),
(489, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 532, 0, 0, 0, 0),
(490, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 533, 0, 0, 0, 0),
(491, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 534, 0, 0, 0, 0),
(492, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 535, 0, 0, 0, 0),
(493, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 536, 0, 0, 0, 0),
(494, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 537, 0, 0, 0, 0),
(495, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 538, 0, 0, 0, 0),
(496, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 539, 0, 0, 0, 0),
(497, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 540, 0, 0, 0, 0),
(498, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 541, 0, 0, 0, 0),
(499, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 542, 0, 0, 0, 0),
(500, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 543, 0, 0, 0, 0),
(501, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 544, 0, 0, 0, 0),
(502, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 545, 0, 0, 0, 0),
(503, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 546, 0, 0, 0, 0),
(504, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 547, 0, 0, 0, 0),
(505, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 548, 0, 0, 0, 0),
(506, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 549, 0, 0, 0, 0),
(507, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 550, 0, 0, 0, 0),
(508, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 306, 551, 0, 0, 0, 0),
(583, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 640, 0.002, 0.002, 0.074934432371675, 0.074934432371675),
(584, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 641, 0, 0, 0, 0),
(585, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 642, 0, 0, 0, 0),
(586, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 643, 0, 0, 0, 0),
(587, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 644, 0, 0, 0, 0),
(588, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 645, 0, 0, 0, 0),
(589, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 646, 0, 0, 0, 0),
(590, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 647, 0, 0, 0, 0),
(591, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 648, 0, 0, 0, 0),
(592, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 649, 0, 0, 0, 0),
(593, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 650, 0, 0, 0, 0),
(594, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 651, 0, 0, 0, 0),
(595, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 495, 652, 0, 0, 0, 0),
(598, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 374, 0.173, 0.173, 8.3939835031538, 8.3939835031538),
(599, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 375, 0, 0, 0, 0),
(600, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 376, 0, 0, 0, 0),
(601, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 377, 0, 0, 0, 0),
(602, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 378, 0, 0, 0, 0),
(603, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 379, 0, 0, 0, 0),
(604, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 380, 0, 0, 0, 0),
(605, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 381, 0, 0, 0, 0),
(606, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 382, 0, 0, 0, 0),
(607, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 383, 0, 0, 0, 0),
(608, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 384, 0, 0, 0, 0),
(609, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 385, 0, 0, 0, 0),
(610, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 386, 0, 0, 0, 0),
(611, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 387, 0, 0, 0, 0),
(612, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 388, 0, 0, 0, 0),
(613, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 389, 0, 0, 0, 0),
(614, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 390, 0, 0, 0, 0),
(615, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 391, 0, 0, 0, 0),
(616, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 392, 0, 0, 0, 0),
(617, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 393, 0, 0, 0, 0),
(618, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 394, 0, 0, 0, 0),
(619, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 395, 0, 0, 0, 0),
(620, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 396, 0, 0, 0, 0),
(621, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 397, 0, 0, 0, 0),
(622, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 398, 0, 0, 0, 0),
(623, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 399, 0, 0, 0, 0),
(624, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 400, 0, 0, 0, 0),
(625, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 229, 401, 0, 0, 0, 0),
(629, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 374, 0.252, 0.425, 12.227074235808, 20.621057738962),
(630, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 375, 0.295, 0.295, 1.6974509465447, 1.6974509465447),
(631, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 376, 0, 0, 0, 0),
(632, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 377, 0, 0, 0, 0),
(633, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 378, 0, 0, 0, 0),
(634, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 379, 0, 0, 0, 0),
(635, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 380, 0, 0, 0, 0),
(636, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 381, 0, 0, 0, 0),
(637, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 382, 0, 0, 0, 0),
(638, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 383, 0, 0, 0, 0),
(639, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 384, 0, 0, 0, 0),
(640, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 385, 0, 0, 0, 0),
(641, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 386, 0, 0, 0, 0),
(642, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 387, 0, 0, 0, 0),
(643, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 388, 0, 0, 0, 0),
(644, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 389, 0, 0, 0, 0),
(645, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 390, 0, 0, 0, 0),
(646, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 391, 0, 0, 0, 0),
(647, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 392, 0, 0, 0, 0),
(648, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 393, 0, 0, 0, 0),
(649, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 394, 0, 0, 0, 0),
(650, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 395, 0, 0, 0, 0),
(651, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 396, 0, 0, 0, 0),
(652, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 397, 0, 0, 0, 0),
(653, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 398, 0, 0, 0, 0),
(654, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 399, 0, 0, 0, 0),
(655, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 400, 0, 0, 0, 0),
(656, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 230, 401, 0, 0, 0, 0),
(660, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 374, 0.284, 0.709, 13.779718583212, 34.400776322174),
(661, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 375, 0.495, 0.79, 2.8482651475919, 4.5457160941366),
(662, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 376, 0, 0, 0, 0),
(663, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 377, 0, 0, 0, 0),
(664, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 378, 0, 0, 0, 0),
(665, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 379, 0, 0, 0, 0),
(666, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 380, 0, 0, 0, 0),
(667, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 381, 0, 0, 0, 0),
(668, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 382, 0, 0, 0, 0),
(669, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 383, 0, 0, 0, 0),
(670, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 384, 0, 0, 0, 0),
(671, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 385, 0, 0, 0, 0),
(672, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 386, 0.509, 0.509, 3.8944146901301, 3.8944146901301),
(673, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 387, 0, 0, 0, 0),
(674, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 388, 0, 0, 0, 0),
(675, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 389, 0, 0, 0, 0),
(676, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 390, 0, 0, 0, 0),
(677, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 391, 0, 0, 0, 0),
(678, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 392, 0, 0, 0, 0),
(679, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 393, 0, 0, 0, 0),
(680, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 394, 0, 0, 0, 0),
(681, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 395, 0, 0, 0, 0),
(682, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 396, 0, 0, 0, 0),
(683, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 397, 0, 0, 0, 0),
(684, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 398, 0, 0, 0, 0),
(685, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 399, 0, 0, 0, 0),
(686, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 400, 0, 0, 0, 0),
(687, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 231, 401, 0, 0, 0, 0),
(691, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 653, 0, 0, 0, 0),
(692, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 654, 0, 0, 0, 0),
(693, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 655, 0, 0, 0, 0),
(694, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 656, 0, 0, 0, 0),
(695, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 657, 0, 0, 0, 0),
(696, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 658, 0, 0, 0, 0),
(697, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 659, 0, 0, 0, 0),
(698, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 660, 0, 0, 0, 0),
(699, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 661, 0, 0, 0, 0),
(700, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 662, 0, 0, 0, 0),
(701, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 663, 0, 0, 0, 0),
(702, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 664, 0, 0, 0, 0),
(703, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 665, 0, 0, 0, 0),
(704, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 666, 0, 0, 0, 0),
(705, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 667, 0, 0, 0, 0),
(706, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 668, 0, 0, 0, 0),
(707, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 669, 0, 0, 0, 0),
(708, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 670, 0, 0, 0, 0),
(709, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 671, 0, 0, 0, 0),
(710, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 672, 0, 0, 0, 0),
(711, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 673, 0, 0, 0, 0),
(712, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 674, 0, 0, 0, 0),
(713, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 675, 0, 0, 0, 0),
(714, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 676, 0, 0, 0, 0),
(715, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 677, 0, 0, 0, 0),
(716, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 678, 0, 0, 0, 0),
(717, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 679, 0, 0, 0, 0),
(718, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 680, 0, 0, 0, 0),
(719, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 522, 681, 0, 0, 0, 0),
(722, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 502, 0, 0, 0, 0),
(723, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 503, 0.002, 0.004, 40, 80),
(724, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 504, 0.097, 0.177, 48.019801980198, 87.623762376238),
(725, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 505, 0.081, 0.161, 37.674418604651, 74.883720930233),
(726, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 506, 0.019, 0.037, 25.675675675676, 50),
(727, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 507, 0.054, 0.109, 33.128834355828, 66.871165644172),
(728, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 508, 0.001, 0.003, 1.8518518518519, 5.5555555555556),
(729, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 509, 0.009, 0.017, 3.7390943082676, 7.0627336933943),
(730, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 510, 0.005, 0.01, 3.7037037037037, 7.4074074074074),
(731, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 511, 0, 0, 0, 0),
(732, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 512, 0, 0, 0, 0),
(733, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 513, 0, 0, 0, 0),
(734, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 514, 0, 0, 0, 0),
(735, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 515, 0, 0, 0, 0),
(736, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 516, 0, 0, 0, 0),
(737, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 517, 0, 0, 0, 0),
(738, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 518, 0, 0, 0, 0),
(739, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 519, 0, 0, 0, 0),
(740, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 520, 0, 0, 0, 0),
(741, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 521, 0, 0, 0, 0),
(742, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 522, 0, 0, 0, 0),
(743, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 523, 0, 0, 0, 0),
(744, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 524, 0, 0, 0, 0),
(745, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 525, 0, 0, 0, 0),
(746, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 526, 0, 0, 0, 0),
(747, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 527, 0, 0, 0, 0),
(748, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 528, 0, 0, 0, 0),
(749, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 529, 0, 0, 0, 0),
(750, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 530, 0, 0, 0, 0),
(751, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 531, 0, 0, 0, 0),
(752, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 532, 0, 0, 0, 0),
(753, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 533, 0, 0, 0, 0),
(754, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 534, 0, 0, 0, 0),
(755, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 535, 0, 0, 0, 0),
(756, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 536, 0, 0, 0, 0),
(757, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 537, 0, 0, 0, 0),
(758, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 538, 0, 0, 0, 0),
(759, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 539, 0, 0, 0, 0),
(760, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 540, 0, 0, 0, 0),
(761, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 541, 0, 0, 0, 0),
(762, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 542, 0, 0, 0, 0),
(763, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 543, 0, 0, 0, 0),
(764, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 544, 0, 0, 0, 0),
(765, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 545, 0, 0, 0, 0),
(766, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 546, 0, 0, 0, 0),
(767, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 547, 0, 0, 0, 0),
(768, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 548, 0, 0, 0, 0),
(769, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 549, 0, 0, 0, 0),
(770, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 550, 0, 0, 0, 0),
(771, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 307, 551, 0, 0, 0, 0),
(785, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 502, 0, 0, 0, 0),
(786, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 503, 0.001, 0.005, 20, 100),
(787, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 504, 0.025, 0.202, 12.376237623762, 100),
(788, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 505, 0.054, 0.215, 25.116279069767, 100),
(789, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 506, 0.037, 0.074, 50, 100),
(790, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 507, 0.054, 0.163, 33.128834355828, 100),
(791, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 508, 0.019, 0.022, 35.185185185185, 40.740740740741),
(792, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 509, 0.009, 0.026, 3.7390943082676, 10.801828001662),
(793, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 510, 0.006, 0.016, 4.4444444444444, 11.851851851852),
(794, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 511, 0, 0, 0, 0),
(795, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 512, 0, 0, 0, 0),
(796, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 513, 0, 0, 0, 0),
(797, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 514, 0, 0, 0, 0),
(798, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 515, 0, 0, 0, 0),
(799, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 516, 0, 0, 0, 0),
(800, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 517, 0, 0, 0, 0),
(801, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 518, 0, 0, 0, 0),
(802, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 519, 0.62, 0.62, 21.009827177228, 21.009827177228),
(803, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 520, 0, 0, 0, 0),
(804, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 521, 0, 0, 0, 0),
(805, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 522, 0, 0, 0, 0),
(806, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 523, 0, 0, 0, 0),
(807, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 524, 0, 0, 0, 0),
(808, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 525, 0, 0, 0, 0),
(809, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 526, 0, 0, 0, 0),
(810, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 527, 0, 0, 0, 0),
(811, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 528, 0, 0, 0, 0),
(812, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 529, 0, 0, 0, 0),
(813, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 530, 0, 0, 0, 0),
(814, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 531, 0, 0, 0, 0),
(815, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 532, 0, 0, 0, 0),
(816, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 533, 0, 0, 0, 0),
(817, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 534, 0, 0, 0, 0),
(818, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 535, 5.16, 5.16, 30.829897831153, 30.829897831153),
(819, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 536, 0, 0, 0, 0),
(820, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 537, 0, 0, 0, 0),
(821, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 538, 0, 0, 0, 0),
(822, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 539, 0, 0, 0, 0),
(823, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 540, 0, 0, 0, 0),
(824, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 541, 0, 0, 0, 0),
(825, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 542, 0, 0, 0, 0),
(826, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 543, 0, 0, 0, 0),
(827, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 544, 0, 0, 0, 0),
(828, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 545, 0, 0, 0, 0),
(829, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 546, 0, 0, 0, 0),
(830, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 547, 0.114, 0.114, 15.745856353591, 15.745856353591),
(831, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 548, 0.136, 0.136, 16.248506571087, 16.248506571087),
(832, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 549, 0.073, 0.073, 36.138613861386, 36.138613861386),
(833, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 550, 0, 0, 0, 0),
(834, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 308, 551, 0.718, 0.718, 2.4776562338245, 2.4776562338245),
(848, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 502, 0, 0, 0, 0),
(849, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 503, 0, 0.005, 0, 100),
(850, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 504, 0, 0.202, 0, 100),
(851, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 505, 0, 0.215, 0, 100),
(852, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 506, 0, 0.074, 0, 100),
(853, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 507, 0, 0.163, 0, 100),
(854, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 508, 0.013, 0.035, 24.074074074074, 64.814814814815),
(855, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 509, 0.009, 0.035, 3.7390943082676, 14.540922309929),
(856, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 510, 0.005, 0.021, 3.7037037037037, 15.555555555556),
(857, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 511, 0, 0, 0, 0),
(858, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 512, 0, 0, 0, 0),
(859, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 513, 0, 0, 0, 0),
(860, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 514, 0, 0, 0, 0),
(861, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 515, 0, 0, 0, 0),
(862, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 516, 0, 0, 0, 0),
(863, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 517, 0, 0, 0, 0),
(864, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 518, 0.781, 0.781, 16.376598867687, 16.376598867687),
(865, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 519, 0, 0.62, 0, 21.009827177228),
(866, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 520, 0, 0, 0, 0),
(867, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 521, 0, 0, 0, 0),
(868, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 522, 0, 0, 0, 0),
(869, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 523, 0, 0, 0, 0),
(870, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 524, 0, 0, 0, 0),
(871, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 525, 0, 0, 0, 0),
(872, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 526, 0, 0, 0, 0),
(873, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 527, 0, 0, 0, 0),
(874, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 528, 0, 0, 0, 0),
(875, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 529, 0, 0, 0, 0),
(876, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 530, 0, 0, 0, 0),
(877, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 531, 0, 0, 0, 0),
(878, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 532, 0, 0, 0, 0),
(879, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 533, 0, 0, 0, 0),
(880, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 534, 0, 0, 0, 0),
(881, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 535, 1.048, 6.208, 6.2615761486527, 37.091473979805),
(882, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 536, 0, 0, 0, 0),
(883, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 537, 0, 0, 0, 0),
(884, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 538, 0, 0, 0, 0),
(885, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 539, 0, 0, 0, 0),
(886, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 540, 0, 0, 0, 0),
(887, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 541, 0, 0, 0, 0),
(888, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 542, 0, 0, 0, 0),
(889, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 543, 0, 0, 0, 0),
(890, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 544, 0, 0, 0, 0),
(891, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 545, 0, 0, 0, 0),
(892, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 546, 0, 0, 0, 0),
(893, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 547, 0.114, 0.228, 15.745856353591, 31.491712707182),
(894, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 548, 0.209, 0.345, 24.970131421744, 41.218637992832),
(895, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 549, 0, 0.073, 0, 36.138613861386),
(896, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 550, 0, 0, 0, 0),
(897, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 309, 551, 0.94, 1.658, 3.2437282169847, 5.7213844508092),
(911, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 640, 0.08, 0.082, 2.997377294867, 3.0723117272387),
(912, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 641, 0.325, 0.325, 4.6688694153139, 4.6688694153139),
(913, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 642, 0, 0, 0, 0),
(914, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 643, 0, 0, 0, 0),
(915, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 644, 0, 0, 0, 0),
(916, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 645, 0, 0, 0, 0),
(917, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 646, 0, 0, 0, 0),
(918, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 647, 0, 0, 0, 0),
(919, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 648, 0, 0, 0, 0),
(920, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 649, 0, 0, 0, 0),
(921, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 650, 0, 0, 0, 0),
(922, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 651, 0, 0, 0, 0),
(923, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 496, 652, 0.676, 0.676, 2.4977830328111, 2.4977830328111),
(926, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 640, 0.167, 0.249, 6.2570251030348, 9.3293368302735),
(927, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 641, 0.484, 0.809, 6.9530239908059, 11.62189340612),
(928, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 642, 0, 0, 0, 0),
(929, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 643, 0, 0, 0, 0),
(930, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 644, 0, 0, 0, 0),
(931, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 645, 0, 0, 0, 0),
(932, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 646, 0, 0, 0, 0),
(933, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 647, 0, 0, 0, 0),
(934, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 648, 0, 0, 0, 0),
(935, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 649, 0, 0, 0, 0),
(936, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 650, 0, 0, 0, 0),
(937, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 651, 0, 0, 0, 0),
(938, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 497, 652, 1.156, 1.832, 4.2713567839196, 6.7691398167307),
(941, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 640, 0.838, 1.087, 31.397527163732, 40.726863994005),
(942, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 641, 0.691, 1.5, 9.9267346645597, 21.548628070679),
(943, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 642, 0, 0, 0, 0),
(944, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 643, 0.069, 0.069, 0.53738317757009, 0.53738317757009),
(945, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 644, 0, 0, 0, 0),
(946, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 645, 0, 0, 0, 0),
(947, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 646, 0, 0, 0, 0),
(948, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 647, 0, 0, 0, 0),
(949, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 648, 0, 0, 0, 0),
(950, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 649, 0, 0, 0, 0),
(951, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 650, 0, 0, 0, 0),
(952, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 651, 0.158, 0.158, 2.3480457720315, 2.3480457720315),
(953, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 498, 652, 0, 1.832, 0, 6.7691398167307),
(956, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 640, 0.779, 1.866, 29.186961408767, 69.913825402773),
(957, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 641, 0.472, 1.972, 6.7806349662405, 28.32926303692),
(958, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 642, 0.007, 0.007, 0.075366063738157, 0.075366063738157),
(959, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 643, 0.206, 0.275, 1.6043613707165, 2.1417445482866),
(960, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 644, 0, 0, 0, 0),
(961, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 645, 1.422, 1.422, 49.443671766342, 49.443671766342),
(962, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 646, 0, 0, 0, 0),
(963, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 647, 0, 0, 0, 0),
(964, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 648, 0.008, 0.008, 0.83945435466946, 0.83945435466946),
(965, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 649, 0, 0, 0, 0),
(966, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 650, 0, 0, 0, 0),
(967, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 651, 0.105, 0.263, 1.5604101649576, 3.9084559369892),
(968, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 499, 652, 0, 1.832, 0, 6.7691398167307),
(971, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 502, 0, 0, 0, 0),
(972, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 503, 0, 0.005, 0, 100),
(973, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 504, 0, 0.202, 0, 100),
(974, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 505, 0, 0.215, 0, 100),
(975, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 506, 0, 0.074, 0, 100),
(976, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 507, 0, 0.163, 0, 100),
(977, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 508, 0.013, 0.048, 24.074074074074, 88.888888888889),
(978, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 509, 0.009, 0.044, 3.7390943082676, 18.280016618197),
(979, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 510, 0.005, 0.026, 3.7037037037037, 19.259259259259),
(980, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 511, 0, 0, 0, 0),
(981, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 512, 0, 0, 0, 0),
(982, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 513, 0, 0, 0, 0),
(983, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 514, 0, 0, 0, 0),
(984, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 515, 0, 0, 0, 0),
(985, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 516, 0, 0, 0, 0),
(986, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 517, 0, 0, 0, 0),
(987, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 518, 0, 0.781, 0, 16.376598867687),
(988, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 519, 0.146, 0.766, 4.9474754320569, 25.957302609285),
(989, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 520, 0, 0, 0, 0),
(990, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 521, 0, 0, 0, 0),
(991, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 522, 0, 0, 0, 0),
(992, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 523, 0, 0, 0, 0),
(993, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 524, 0, 0, 0, 0),
(994, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 525, 0, 0, 0, 0),
(995, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 526, 0, 0, 0, 0),
(996, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 527, 0, 0, 0, 0),
(997, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 528, 0, 0, 0, 0),
(998, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 529, 0, 0, 0, 0),
(999, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 530, 0, 0, 0, 0),
(1000, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 531, 0, 0, 0, 0),
(1001, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 532, 0, 0, 0, 0),
(1002, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 533, 0, 0, 0, 0),
(1003, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 534, 0, 0, 0, 0),
(1004, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 535, 1.901, 8.109, 11.358068949035, 48.44954292884),
(1005, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 536, 0, 0, 0, 0),
(1006, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 537, 0, 0, 0, 0),
(1007, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 538, 0, 0, 0, 0),
(1008, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 539, 0, 0, 0, 0),
(1009, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 540, 0, 0, 0, 0),
(1010, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 541, 0, 0, 0, 0),
(1011, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 542, 0, 0, 0, 0),
(1012, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 543, 0, 0, 0, 0),
(1013, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 544, 0, 0, 0, 0),
(1014, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 545, 0, 0, 0, 0),
(1015, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 546, 0, 0, 0, 0),
(1016, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 547, 0, 0.228, 0, 31.491712707182),
(1017, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 548, 0, 0.345, 0, 41.218637992832),
(1018, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 549, 0, 0.073, 0, 36.138613861386),
(1019, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 550, 0, 0, 0, 0),
(1020, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 310, 551, 1.659, 3.317, 5.7248352255081, 11.446219676317),
(1034, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 640, 0.028, 1.894, 1.0490820532034, 70.962907455976),
(1035, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 641, 0.062, 2.034, 0.89067662692142, 29.219939663841),
(1036, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 642, 2.52, 2.527, 27.131782945736, 27.207149009475),
(1037, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 643, 2.204, 2.479, 17.165109034268, 19.306853582555),
(1038, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 644, 0.359, 0.359, 5.6678244395327, 5.6678244395327),
(1039, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 645, 0.119, 1.541, 4.1376912378303, 53.581363004172),
(1040, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 646, 4.329, 4.329, 45.645297342893, 45.645297342893),
(1041, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 647, 0.319, 0.319, 13.985094256905, 13.985094256905),
(1042, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 648, 0.112, 0.12, 11.752360965373, 12.591815320042),
(1043, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 649, 1.75, 1.75, 19.564002235886, 19.564002235886),
(1044, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 650, 0, 0, 0, 0),
(1045, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 651, 1.851, 2.114, 27.507802050825, 31.416257987814),
(1046, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 500, 652, 1.197, 3.029, 4.4228495418268, 11.191989358557),
(1049, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 640, 0.012, 1.906, 0.44960659423005, 71.412514050206),
(1050, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 641, 0, 2.034, 0, 29.219939663841),
(1051, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 642, 1.252, 3.779, 13.479758828596, 40.686907838071),
(1052, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 643, 0.394, 2.873, 3.0685358255452, 22.3753894081),
(1053, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 644, 1.836, 2.195, 28.986422481844, 34.654246921377),
(1054, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 645, 0.154, 1.695, 5.3546592489569, 58.936022253129),
(1055, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 646, 0, 4.329, 0, 45.645297342893),
(1056, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 647, 0, 0.319, 0, 13.985094256905),
(1057, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 648, 0.208, 0.328, 21.825813221406, 34.417628541448),
(1058, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 649, 0, 1.75, 0, 19.564002235886),
(1059, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 650, 0, 0, 0, 0),
(1060, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 651, 0.25, 2.364, 3.7152622975182, 35.131520285332),
(1061, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 501, 652, 1.916, 4.945, 7.0795152231747, 18.271504581732),
(1064, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 640, 0.023, 1.929, 0.86174597227426, 72.27426002248),
(1065, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 641, 0.017, 2.051, 0.24421778480103, 29.464157448642),
(1066, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 642, 1.34, 5.119, 14.42721791559, 55.114125753661),
(1067, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 643, 2.014, 4.887, 15.685358255452, 38.060747663551),
(1068, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 644, 1.098, 3.293, 17.335017366593, 51.98926428797),
(1069, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 645, 0.131, 1.826, 4.5549374130737, 63.490959666203),
(1070, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 646, 0.06, 4.389, 0.63264445381695, 46.27794179671),
(1071, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 647, 0, 0.319, 0, 13.985094256905),
(1072, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 648, 0.066, 0.394, 6.9254984260231, 41.343126967471),
(1073, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 649, 0, 1.75, 0, 19.564002235886),
(1074, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 650, 1.551, 1.551, 43.372483221477, 43.372483221477),
(1075, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 651, 0.704, 3.068, 10.462178629811, 45.593698915143),
(1076, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 502, 652, 4.386, 9.331, 16.206030150754, 34.477534732486),
(1079, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 502, 0, 0, 0, 0),
(1080, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 503, 0, 0.005, 0, 100),
(1081, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 504, 0, 0.202, 0, 100),
(1082, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 505, 0, 0.215, 0, 100),
(1083, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 506, 0, 0.074, 0, 100),
(1084, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 507, 0, 0.163, 0, 100),
(1085, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 508, 0.004, 0.052, 7.4074074074074, 96.296296296296),
(1086, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 509, 0.009, 0.053, 3.7390943082676, 22.019110926464),
(1087, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 510, 0.005, 0.031, 3.7037037037037, 22.962962962963),
(1088, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 511, 0, 0, 0, 0),
(1089, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 512, 0, 0, 0, 0),
(1090, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 513, 0, 0, 0, 0),
(1091, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 514, 0, 0, 0, 0),
(1092, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 515, 0, 0, 0, 0),
(1093, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 516, 0, 0, 0, 0),
(1094, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 517, 0, 0, 0, 0),
(1095, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 518, 0.669, 1.45, 14.028098133781, 30.404697001468),
(1096, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 519, 0.327, 1.093, 11.080989495086, 37.038292104371),
(1097, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 520, 0, 0, 0, 0),
(1098, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 521, 0, 0, 0, 0),
(1099, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 522, 0, 0, 0, 0),
(1100, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 523, 0.285, 0.285, 20.028109627547, 20.028109627547),
(1101, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 524, 0, 0, 0, 0),
(1102, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 525, 0, 0, 0, 0),
(1103, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 526, 0, 0, 0, 0),
(1104, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 527, 0, 0, 0, 0),
(1105, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 528, 0, 0, 0, 0),
(1106, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 529, 0, 0, 0, 0),
(1107, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 530, 0, 0, 0, 0),
(1108, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 531, 0, 0, 0, 0),
(1109, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 532, 0, 0, 0, 0),
(1110, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 533, 0, 0, 0, 0),
(1111, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 534, 0, 0, 0, 0),
(1112, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 535, 1.393, 9.502, 8.3228774571309, 56.772420385971),
(1113, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 536, 0, 0, 0, 0),
(1114, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 537, 0, 0, 0, 0),
(1115, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 538, 0, 0, 0, 0),
(1116, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 539, 0, 0, 0, 0),
(1117, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 540, 0, 0, 0, 0),
(1118, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 541, 0, 0, 0, 0),
(1119, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 542, 0, 0, 0, 0),
(1120, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 543, 0, 0, 0, 0),
(1121, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 544, 0, 0, 0, 0),
(1122, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 545, 0, 0, 0, 0),
(1123, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 546, 0, 0, 0, 0),
(1124, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 547, 0, 0.228, 0, 31.491712707182),
(1125, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 548, 0, 0.345, 0, 41.218637992832),
(1126, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 549, 0, 0.073, 0, 36.138613861386),
(1127, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 550, 0, 0, 0, 0),
(1128, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 311, 551, 1.659, 4.976, 5.7248352255081, 17.171054901825),
(1142, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 653, 0, 0, 0, 0),
(1143, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 654, 0, 0, 0, 0),
(1144, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 655, 0, 0, 0, 0),
(1145, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 656, 0, 0, 0, 0),
(1146, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 657, 0, 0, 0, 0),
(1147, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 658, 0, 0, 0, 0),
(1148, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 659, 0, 0, 0, 0),
(1149, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 660, 0, 0, 0, 0),
(1150, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 661, 0, 0, 0, 0),
(1151, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 662, 0, 0, 0, 0),
(1152, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 663, 0, 0, 0, 0),
(1153, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 664, 0, 0, 0, 0),
(1154, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 665, 0, 0, 0, 0),
(1155, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 666, 0, 0, 0, 0),
(1156, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 667, 0, 0, 0, 0),
(1157, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 668, 0, 0, 0, 0),
(1158, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 669, 0, 0, 0, 0),
(1159, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 670, 0, 0, 0, 0),
(1160, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 671, 0, 0, 0, 0),
(1161, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 672, 0, 0, 0, 0),
(1162, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 673, 0, 0, 0, 0),
(1163, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 674, 0, 0, 0, 0),
(1164, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 675, 0, 0, 0, 0),
(1165, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 676, 0, 0, 0, 0),
(1166, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 677, 0, 0, 0, 0);
INSERT INTO `new_bobot_uraian_kerja_dephub` (`id`, `proyek`, `fk_id_minggu`, `fk_idnew_pekerjaan_dephub`, `persentase_detail`, `persentase_akhir`, `bobot_persentase_detail`, `bobot_persentase_akhir`) VALUES
(1167, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 678, 0, 0, 0, 0),
(1168, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 679, 0, 0, 0, 0),
(1169, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 680, 0, 0, 0, 0),
(1170, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 553, 681, 0, 0, 0, 0),
(1173, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 653, 0.015, 0.915, 1.0217983651226, 62.32970027248),
(1174, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 654, 0, 0, 0, 0),
(1175, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 655, 0, 0.302, 0, 100),
(1176, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 656, 0, 15.799, 0, 100),
(1177, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 657, 0.023, 3.672, 0.55582406959884, 88.73852102465),
(1178, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 658, 0.012, 7.172, 0.085082246171299, 50.850822461713),
(1179, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 659, 0, 0, 0, 0),
(1180, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 660, 0, 0, 0, 0),
(1181, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 661, 0, 0, 0, 0),
(1182, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 662, 0, 0, 0, 0),
(1183, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 663, 0, 0, 0, 0),
(1184, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 664, 0, 0, 0, 0),
(1185, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 665, 0, 0, 0, 0),
(1186, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 666, 0, 0, 0, 0),
(1187, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 667, 0, 0, 0, 0),
(1188, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 668, 0, 0, 0, 0),
(1189, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 669, 0, 0, 0, 0),
(1190, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 670, 0, 0, 0, 0),
(1191, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 671, 0, 0, 0, 0),
(1192, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 672, 0, 0, 0, 0),
(1193, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 673, 0, 0, 0, 0),
(1194, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 674, 0, 0, 0, 0),
(1195, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 675, 0, 0, 0, 0),
(1196, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 676, 0, 0, 0, 0),
(1197, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 677, 0, 0, 0, 0),
(1198, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 678, 0, 0, 0, 0),
(1199, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 679, 0, 0, 0, 0),
(1200, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 680, 0, 0, 0, 0),
(1201, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 556, 681, 0, 0, 0, 0),
(1204, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 653, 0.9, 0.9, 61.307901907357, 61.307901907357),
(1205, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 654, 0, 0, 0, 0),
(1206, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 655, 0.302, 0.302, 100, 100),
(1207, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 656, 15.799, 15.799, 100, 100),
(1208, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 657, 3.649, 3.649, 88.182696955051, 88.182696955051),
(1209, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 658, 7.16, 7.16, 50.765740215542, 50.765740215542),
(1210, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 659, 0, 0, 0, 0),
(1211, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 660, 0, 0, 0, 0),
(1212, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 661, 0, 0, 0, 0),
(1213, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 662, 0, 0, 0, 0),
(1214, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 663, 0, 0, 0, 0),
(1215, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 664, 0, 0, 0, 0),
(1216, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 665, 0, 0, 0, 0),
(1217, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 666, 0, 0, 0, 0),
(1218, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 667, 0, 0, 0, 0),
(1219, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 668, 0, 0, 0, 0),
(1220, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 669, 0, 0, 0, 0),
(1221, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 670, 0, 0, 0, 0),
(1222, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 671, 0, 0, 0, 0),
(1223, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 672, 0, 0, 0, 0),
(1224, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 673, 0, 0, 0, 0),
(1225, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 674, 0, 0, 0, 0),
(1226, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 675, 0, 0, 0, 0),
(1227, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 676, 0, 0, 0, 0),
(1228, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 677, 0, 0, 0, 0),
(1229, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 678, 0, 0, 0, 0),
(1230, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 679, 0, 0, 0, 0),
(1231, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 680, 0, 0, 0, 0),
(1232, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 555, 681, 0, 0, 0, 0),
(1235, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 653, 0.001, 0.916, 0.068119891008174, 62.397820163488),
(1236, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 654, 0, 0, 0, 0),
(1237, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 655, 0, 0.302, 0, 100),
(1238, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 656, 0, 15.799, 0, 100),
(1239, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 657, 0, 3.672, 0, 88.73852102465),
(1240, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 658, 0.194, 7.366, 1.3754963131027, 52.226318774816),
(1241, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 659, 0, 0, 0, 0),
(1242, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 660, 0, 0, 0, 0),
(1243, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 661, 0, 0, 0, 0),
(1244, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 662, 0, 0, 0, 0),
(1245, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 663, 0, 0, 0, 0),
(1246, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 664, 0, 0, 0, 0),
(1247, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 665, 0, 0, 0, 0),
(1248, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 666, 0, 0, 0, 0),
(1249, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 667, 0, 0, 0, 0),
(1250, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 668, 0, 0, 0, 0),
(1251, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 669, 0, 0, 0, 0),
(1252, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 670, 0, 0, 0, 0),
(1253, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 671, 0, 0, 0, 0),
(1254, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 672, 0, 0, 0, 0),
(1255, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 673, 0, 0, 0, 0),
(1256, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 674, 0, 0, 0, 0),
(1257, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 675, 0, 0, 0, 0),
(1258, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 676, 0, 0, 0, 0),
(1259, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 677, 0, 0, 0, 0),
(1260, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 678, 0, 0, 0, 0),
(1261, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 679, 0, 0, 0, 0),
(1262, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 680, 0.74, 0.74, 22.370012091898, 22.370012091898),
(1263, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 557, 681, 0, 0, 0, 0),
(1266, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 653, 0.001, 0.917, 0.068119891008174, 62.465940054496),
(1267, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 654, 0, 0, 0, 0),
(1268, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 655, 0, 0.302, 0, 100),
(1269, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 656, 0, 15.799, 0, 100),
(1270, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 657, 0, 3.672, 0, 88.73852102465),
(1271, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 658, 0.633, 7.999, 4.488088485536, 56.714407260352),
(1272, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 659, 0, 0, 0, 0),
(1273, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 660, 0, 0, 0, 0),
(1274, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 661, 0, 0, 0, 0),
(1275, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 662, 0, 0, 0, 0),
(1276, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 663, 0, 0, 0, 0),
(1277, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 664, 0, 0, 0, 0),
(1278, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 665, 0, 0, 0, 0),
(1279, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 666, 0, 0, 0, 0),
(1280, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 667, 0, 0, 0, 0),
(1281, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 668, 0, 0, 0, 0),
(1282, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 669, 0, 0, 0, 0),
(1283, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 670, 0, 0, 0, 0),
(1284, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 671, 0, 0, 0, 0),
(1285, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 672, 0, 0, 0, 0),
(1286, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 673, 0, 0, 0, 0),
(1287, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 674, 0, 0, 0, 0),
(1288, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 675, 0, 0, 0, 0),
(1289, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 676, 0, 0, 0, 0),
(1290, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 677, 0, 0, 0, 0),
(1291, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 678, 0, 0, 0, 0),
(1292, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 679, 0, 0, 0, 0),
(1293, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 680, 0, 0, 0, 0),
(1294, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 558, 681, 0, 0, 0, 0),
(1295, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 502, 0, 0, 0, 0),
(1296, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 503, 0, 0.005, 0, 100),
(1297, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 504, 0, 0.202, 0, 100),
(1298, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 505, 0, 0.215, 0, 100),
(1299, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 506, 0, 0.074, 0, 100),
(1300, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 507, 0, 0.163, 0, 100),
(1301, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 508, 0, 0.052, 0, 96.296296296296),
(1302, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 509, 0.009, 0.062, 3.7390943082676, 25.758205234732),
(1303, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 510, 0.005, 0.036, 3.7037037037037, 26.666666666667),
(1304, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 511, 0, 0, 0, 0),
(1305, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 512, 0, 0, 0, 0),
(1306, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 513, 0, 0, 0, 0),
(1307, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 514, 0, 0, 0, 0),
(1308, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 515, 0, 0, 0, 0),
(1309, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 516, 0, 0, 0, 0),
(1310, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 517, 0, 0, 0, 0),
(1311, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 518, 0.675, 2.125, 14.153910673097, 44.558607674565),
(1312, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 519, 0.378, 1.471, 12.809217214504, 49.847509318875),
(1313, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 520, 0, 0, 0, 0),
(1314, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 521, 0, 0, 0, 0),
(1315, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 522, 0, 0, 0, 0),
(1316, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 523, 0.285, 0.57, 20.028109627547, 40.056219255095),
(1317, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 524, 0, 0, 0, 0),
(1318, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 525, 0, 0, 0, 0),
(1319, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 526, 0, 0, 0, 0),
(1320, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 527, 0, 0, 0, 0),
(1321, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 528, 0, 0, 0, 0),
(1322, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 529, 0, 0, 0, 0),
(1323, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 530, 0, 0, 0, 0),
(1324, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 531, 0, 0, 0, 0),
(1325, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 532, 0, 0, 0, 0),
(1326, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 533, 0, 0, 0, 0),
(1327, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 534, 0, 0, 0, 0),
(1328, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 535, 2.934, 12.436, 17.530023301667, 74.302443687638),
(1329, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 536, 0, 0, 0, 0),
(1330, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 537, 0, 0, 0, 0),
(1331, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 538, 0, 0, 0, 0),
(1332, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 539, 0, 0, 0, 0),
(1333, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 540, 0, 0, 0, 0),
(1334, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 541, 0, 0, 0, 0),
(1335, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 542, 0, 0, 0, 0),
(1336, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 543, 0, 0, 0, 0),
(1337, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 544, 0, 0, 0, 0),
(1338, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 545, 0, 0, 0, 0),
(1339, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 546, 0, 0, 0, 0),
(1340, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 547, 0, 0.228, 0, 31.491712707182),
(1341, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 548, 0, 0.345, 0, 41.218637992832),
(1342, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 549, 0, 0.073, 0, 36.138613861386),
(1343, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 550, 0, 0, 0, 0),
(1344, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 312, 551, 2.054, 7.03, 7.0878912315815, 24.258946133407),
(1358, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 640, 0.012, 1.941, 0.44960659423005, 72.72386661671),
(1359, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 641, 0.037, 2.088, 0.53153282574343, 29.995690274386),
(1360, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 642, 2.632, 7.751, 28.337639965547, 83.451765719208),
(1361, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 643, 2.988, 7.875, 23.271028037383, 61.331775700935),
(1362, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 644, 0.211, 3.504, 3.3312282917588, 55.320492579728),
(1363, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 645, 0.477, 2.303, 16.585535465925, 80.076495132128),
(1364, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 646, 0, 4.389, 0, 46.27794179671),
(1365, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 647, 0.074, 0.393, 3.244191144235, 17.22928540114),
(1366, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 648, 0.04, 0.434, 4.1972717733473, 45.540398740818),
(1367, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 649, 1.75, 3.5, 19.564002235886, 39.128004471772),
(1368, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 650, 0.065, 1.616, 1.8176733780761, 45.190156599553),
(1369, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 651, 0.062, 3.13, 0.92138504978451, 46.515083964928),
(1370, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 503, 652, 0.04, 9.371, 0.14779781259237, 34.625332545078),
(1373, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 374, 0.284, 0.993, 13.779718583212, 48.180494905386),
(1374, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 375, 2.561, 3.351, 14.73617584441, 19.281891938547),
(1375, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 376, 0, 0, 0, 0),
(1376, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 377, 0, 0, 0, 0),
(1377, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 378, 0, 0, 0, 0),
(1378, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 379, 0, 0, 0, 0),
(1379, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 380, 0, 0, 0, 0),
(1380, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 381, 0, 0, 0, 0),
(1381, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 382, 0, 0, 0, 0),
(1382, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 383, 0, 0, 0, 0),
(1383, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 384, 0, 0, 0, 0),
(1384, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 385, 0, 0, 0, 0),
(1385, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 386, 0, 0.509, 0, 3.8944146901301),
(1386, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 387, 0, 0, 0, 0),
(1387, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 388, 0, 0, 0, 0),
(1388, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 389, 0, 0, 0, 0),
(1389, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 390, 0, 0, 0, 0),
(1390, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 391, 0, 0, 0, 0),
(1391, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 392, 0, 0, 0, 0),
(1392, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 393, 0, 0, 0, 0),
(1393, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 394, 0, 0, 0, 0),
(1394, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 395, 0, 0, 0, 0),
(1395, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 396, 0, 0, 0, 0),
(1396, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 397, 0, 0, 0, 0),
(1397, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 398, 0, 0, 0, 0),
(1398, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 399, 0, 0, 0, 0),
(1399, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 400, 0, 0, 0, 0),
(1400, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 232, 401, 0, 0, 0, 0),
(1401, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 502, 0, 0, 0, 0),
(1402, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 503, 0, 0.005, 0, 100),
(1403, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 504, 0, 0.202, 0, 100),
(1404, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 505, 0, 0.215, 0, 100),
(1405, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 506, 0, 0.074, 0, 100),
(1406, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 507, 0, 0.163, 0, 100),
(1407, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 508, 0, 0.052, 0, 96.296296296296),
(1408, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 509, 0.009, 0.071, 3.7390943082676, 29.497299543),
(1409, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 510, 0.005, 0.041, 3.7037037037037, 30.37037037037),
(1410, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 511, 0, 0, 0, 0),
(1411, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 512, 0, 0, 0, 0),
(1412, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 513, 0, 0, 0, 0),
(1413, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 514, 0, 0, 0, 0),
(1414, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 515, 0, 0, 0, 0),
(1415, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 516, 0.949, 0.949, 15.433403805497, 15.433403805497),
(1416, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 517, 0, 0, 0, 0),
(1417, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 518, 0.473, 2.598, 9.9182218494443, 54.476829524009),
(1418, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 519, 0.341, 1.812, 11.555404947475, 61.40291426635),
(1419, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 520, 0, 0, 0, 0),
(1420, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 521, 0, 0, 0, 0),
(1421, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 522, 0, 0, 0, 0),
(1422, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 523, 0.285, 0.855, 20.028109627547, 60.084328882642),
(1423, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 524, 0, 0, 0, 0),
(1424, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 525, 0, 0, 0, 0),
(1425, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 526, 0, 0, 0, 0),
(1426, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 527, 0, 0, 0, 0),
(1427, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 528, 0.028, 0.028, 28.865979381443, 28.865979381443),
(1428, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 529, 0, 0, 0, 0),
(1429, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 530, 0, 0, 0, 0),
(1430, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 531, 0, 0, 0, 0),
(1431, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 532, 0, 0, 0, 0),
(1432, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 533, 0, 0, 0, 0),
(1433, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 534, 0, 0, 0, 0),
(1434, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 535, 0.715, 13.151, 4.2719722769911, 78.574415964629),
(1435, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 536, 0, 0, 0, 0),
(1436, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 537, 0, 0, 0, 0),
(1437, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 538, 0, 0, 0, 0),
(1438, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 539, 0, 0, 0, 0),
(1439, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 540, 0, 0, 0, 0),
(1440, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 541, 0, 0, 0, 0),
(1441, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 542, 0, 0, 0, 0),
(1442, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 543, 0, 0, 0, 0),
(1443, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 544, 0, 0, 0, 0),
(1444, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 545, 0, 0, 0, 0),
(1445, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 546, 0, 0, 0, 0),
(1446, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 547, 0, 0.228, 0, 31.491712707182),
(1447, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 548, 0, 0.345, 0, 41.218637992832),
(1448, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 549, 0, 0.073, 0, 36.138613861386),
(1449, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 550, 0, 0, 0, 0),
(1450, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 313, 551, 2.548, 9.578, 8.7925739328479, 33.051520066255),
(1464, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 502, 0, 0, 0, 0),
(1465, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 503, 0, 0.005, 0, 100),
(1466, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 504, 0, 0.202, 0, 100),
(1467, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 505, 0, 0.215, 0, 100),
(1468, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 506, 0, 0.074, 0, 100),
(1469, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 507, 0.018, 0.181, 11.042944785276, 111.04294478528),
(1470, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 508, 0, 0.052, 0, 96.296296296296),
(1471, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 509, 0, 0.071, 0, 29.497299543),
(1472, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 510, 0, 0.041, 0, 30.37037037037),
(1473, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 511, 0, 0, 0, 0),
(1474, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 512, 0, 0, 0, 0),
(1475, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 513, 0, 0, 0, 0),
(1476, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 514, 0, 0, 0, 0),
(1477, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 515, 0, 0, 0, 0),
(1478, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 516, 0, 0.949, 0, 15.433403805497),
(1479, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 517, 0, 0, 0, 0),
(1480, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 518, 0, 2.598, 0, 54.476829524009),
(1481, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 519, 0, 1.812, 0, 61.40291426635),
(1482, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 520, 0, 0, 0, 0),
(1483, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 521, 0, 0, 0, 0),
(1484, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 522, 0, 0, 0, 0),
(1485, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 523, 0, 0.855, 0, 60.084328882642),
(1486, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 524, 0, 0, 0, 0),
(1487, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 525, 0, 0, 0, 0),
(1488, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 526, 0, 0, 0, 0),
(1489, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 527, 0, 0, 0, 0),
(1490, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 528, 0, 0.028, 0, 28.865979381443),
(1491, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 529, 0, 0, 0, 0),
(1492, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 530, 0, 0, 0, 0),
(1493, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 531, 0, 0, 0, 0),
(1494, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 532, 0, 0, 0, 0),
(1495, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 533, 0, 0, 0, 0),
(1496, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 534, 0, 0, 0, 0),
(1497, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 535, 0, 13.151, 0, 78.574415964629),
(1498, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 536, 0, 0, 0, 0),
(1499, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 537, 0, 0, 0, 0),
(1500, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 538, 0, 0, 0, 0),
(1501, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 539, 0, 0, 0, 0),
(1502, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 540, 0, 0, 0, 0),
(1503, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 541, 0, 0, 0, 0),
(1504, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 542, 0, 0, 0, 0),
(1505, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 543, 0, 0, 0, 0),
(1506, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 544, 0, 0, 0, 0),
(1507, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 545, 0, 0, 0, 0),
(1508, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 546, 0, 0, 0, 0),
(1509, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 547, 0, 0.228, 0, 31.491712707182),
(1510, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 548, 0, 0.345, 0, 41.218637992832),
(1511, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 549, 0, 0.073, 0, 36.138613861386),
(1512, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 550, 0, 0, 0, 0),
(1513, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 314, 551, 0, 9.578, 0, 33.051520066255),
(1514, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 653, 0.244, 1.161, 16.621253405995, 79.08719346049),
(1515, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 654, 0, 0, 0, 0),
(1516, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 655, 0, 0.302, 0, 100),
(1517, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 656, 0, 15.799, 0, 100),
(1518, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 657, 0, 3.672, 0, 88.73852102465),
(1519, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 658, 0, 7.999, 0, 56.714407260352),
(1520, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 659, 0, 0, 0, 0),
(1521, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 660, 0, 0, 0, 0),
(1522, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 661, 0, 0, 0, 0),
(1523, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 662, 0, 0, 0, 0),
(1524, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 663, 0, 0, 0, 0),
(1525, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 664, 0, 0, 0, 0),
(1526, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 665, 0, 0, 0, 0),
(1527, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 666, 0, 0, 0, 0),
(1528, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 667, 0, 0, 0, 0),
(1529, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 668, 0, 0, 0, 0),
(1530, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 669, 0, 0, 0, 0),
(1531, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 670, 0, 0, 0, 0),
(1532, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 671, 0, 0, 0, 0),
(1533, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 672, 0, 0, 0, 0),
(1534, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 673, 0, 0, 0, 0),
(1535, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 674, 0, 0, 0, 0),
(1536, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 675, 0, 0, 0, 0),
(1537, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 676, 0, 0, 0, 0),
(1538, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 677, 0, 0, 0, 0),
(1539, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 678, 0, 0, 0, 0),
(1540, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 679, 0, 0, 0, 0),
(1541, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 680, 0, 0, 0, 0),
(1542, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 559, 681, 0, 0, 0, 0),
(1545, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 640, 0.246, 2.187, 9.216935181716, 81.940801798426),
(1546, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 641, 0, 2.088, 0, 29.995690274386),
(1547, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 642, 0.553, 8.304, 5.9539190353144, 89.405684754522),
(1548, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 643, 2.807, 10.682, 21.861370716511, 83.193146417445),
(1549, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 644, 1.409, 4.913, 22.24502683928, 77.565519419009),
(1550, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 645, 0.119, 2.422, 4.1376912378303, 84.214186369958),
(1551, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 646, 0, 4.389, 0, 46.27794179671),
(1552, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 647, 0.241, 0.634, 10.565541429198, 27.794826830338),
(1553, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 648, 0.22, 0.654, 23.08499475341, 68.625393494229),
(1554, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 649, 0.875, 4.375, 9.782001117943, 48.910005589715),
(1555, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 650, 0, 1.616, 0, 45.190156599553),
(1556, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 651, 1.442, 4.572, 21.429632932085, 67.944716897013),
(1557, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 504, 652, 1.637, 11.008, 6.0486254803429, 40.673958025421),
(1558, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 502, 0, 0, 0, 0),
(1559, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 503, 0, 0, 0, 0),
(1560, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 504, 0, 0, 0, 0),
(1561, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 505, 0, 0, 0, 0),
(1562, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 506, 0, 0, 0, 0),
(1563, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 507, 0, 0, 0, 0),
(1564, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 508, 0, 0, 0, 0),
(1565, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 509, 0, 0, 0, 0),
(1566, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 510, 0, 0, 0, 0),
(1567, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 511, 0, 0, 0, 0),
(1568, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 512, 0, 0, 0, 0),
(1569, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 513, 0, 0, 0, 0),
(1570, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 514, 0, 0, 0, 0),
(1571, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 515, 0, 0, 0, 0),
(1572, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 516, 0, 0, 0, 0),
(1573, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 517, 0, 0, 0, 0),
(1574, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 518, 0, 0, 0, 0),
(1575, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 519, 0, 0, 0, 0),
(1576, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 520, 0, 0, 0, 0),
(1577, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 521, 0, 0, 0, 0),
(1578, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 522, 0, 0, 0, 0),
(1579, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 523, 0, 0, 0, 0),
(1580, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 524, 0, 0, 0, 0),
(1581, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 525, 0, 0, 0, 0),
(1582, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 526, 0, 0, 0, 0),
(1583, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 527, 0, 0, 0, 0),
(1584, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 528, 0, 0, 0, 0),
(1585, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 529, 0, 0, 0, 0),
(1586, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 530, 0, 0, 0, 0),
(1587, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 531, 0, 0, 0, 0),
(1588, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 532, 0, 0, 0, 0),
(1589, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 533, 0, 0, 0, 0),
(1590, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 534, 0, 0, 0, 0),
(1591, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 535, 0, 0, 0, 0),
(1592, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 536, 0, 0, 0, 0),
(1593, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 537, 0, 0, 0, 0),
(1594, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 538, 0, 0, 0, 0),
(1595, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 539, 0, 0, 0, 0),
(1596, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 540, 0, 0, 0, 0),
(1597, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 541, 0, 0, 0, 0),
(1598, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 542, 0, 0, 0, 0),
(1599, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 543, 0, 0, 0, 0),
(1600, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 544, 0, 0, 0, 0),
(1601, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 545, 0, 0, 0, 0),
(1602, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 546, 0, 0, 0, 0),
(1603, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 547, 0, 0, 0, 0),
(1604, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 548, 0, 0, 0, 0),
(1605, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 549, 0, 0, 0, 0),
(1606, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 550, 0, 0, 0, 0),
(1607, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 324, 551, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_dokumentasi_dephub`
--

CREATE TABLE `new_dokumentasi_dephub` (
  `id` int(11) NOT NULL,
  `foto1` varchar(500) NOT NULL,
  `foto2` varchar(500) NOT NULL,
  `foto3` varchar(500) NOT NULL,
  `foto4` varchar(500) NOT NULL,
  `foto5` varchar(500) NOT NULL,
  `foto6` varchar(500) NOT NULL,
  `fk_idminggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `keterangan1` varchar(500) NOT NULL,
  `keterangan2` varchar(500) NOT NULL,
  `keterangan3` varchar(500) NOT NULL,
  `keterangan4` varchar(500) NOT NULL,
  `keterangan5` varchar(500) NOT NULL,
  `keterangan6` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `new_dokumentasi_dephub`
--

INSERT INTO `new_dokumentasi_dephub` (`id`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`, `foto6`, `fk_idminggu`, `tanggal`, `proyek`, `keterangan1`, `keterangan2`, `keterangan3`, `keterangan4`, `keterangan5`, `keterangan6`) VALUES
(2, '1_copy.jpg', '1_copy1.jpg', '1_copy2.jpg', '1_copy3.jpg', '1_copy4.jpg', '1_copy5.jpg', 228, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', '', '', '', '', '', ''),
(3, 'WhatsApp_Image_2021-07-17_at_17_08_13_(1)1.jpeg', 'WhatsApp_Image_2021-07-17_at_17_08_131.jpeg', 'WhatsApp_Image_2021-07-17_at_17_08_14_(1)1.jpeg', 'WhatsApp_Image_2021-07-17_at_17_08_141.jpeg', '11.jpg', '21.jpg', 229, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'Pengukuran Lokasi', 'Pengukuran Lokasi', 'Pengukuran Topografi', 'Pengukuran Topografi', 'Pembuatan Direksi Keet', 'Pembuatan Pagar Pengaman'),
(4, 'WhatsApp_Image_2021-07-27_at_09_19_16.jpeg', 'WhatsApp_Image_2021-07-26_at_16_16_34_(1).jpeg', 'WhatsApp_Image_2021-07-27_at_19_19_07.jpeg', 'WhatsApp_Image_2021-07-26_at_16_16_34.jpeg', 'WhatsApp_Image_2021-07-26_at_16_16_33.jpeg', 'WhatsApp_Image_2021-07-26_at_16_16_31.jpeg', 230, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'Toolbox Meeting', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian'),
(5, 'WhatsApp_Image_2021-07-31_at_19_06_18.jpeg', 'WhatsApp_Image_2021-07-31_at_19_06_18_(1).jpeg', 'WhatsApp_Image_2021-07-31_at_19_06_16.jpeg', 'WhatsApp_Image_2021-08-02_at_17_21_171.jpeg', 'WhatsApp_Image_2021-08-02_at_10_56_52.jpeg', 'WhatsApp_Image_2021-08-02_at_10_56_511.jpeg', 231, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian', 'Pekerjaan Bekisting', 'Pekerjaan Bekisting'),
(6, 'WhatsApp_Image_2021-08-04_at_21_54_13_(1).jpeg', 'WhatsApp_Image_2021-08-04_at_21_54_13.jpeg', 'WhatsApp_Image_2021-08-04_at_21_54_42.jpeg', 'WhatsApp_Image_2021-08-04_at_21_54_13_(2).jpeg', 'WhatsApp_Image_2021-08-04_at_21_55_35.jpeg', 'WhatsApp_Image_2021-08-04_at_21_54_42_(1).jpeg', 308, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Lansekap', 'Pekerjaan Lansekap', 'Pembesian Kolom', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian'),
(7, 'WhatsApp_Image_2021-08-04_at_22_11_15_(5).jpeg', 'WhatsApp_Image_2021-08-04_at_22_11_15_(2).jpeg', 'WhatsApp_Image_2021-08-04_at_21_55_351.jpeg', 'WhatsApp_Image_2021-08-04_at_22_11_15.jpeg', 'WhatsApp_Image_2021-08-04_at_22_11_15_(4).jpeg', 'WhatsApp_Image_2021-08-04_at_22_11_15_(3).jpeg', 309, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pembesian Kolom', 'Pembesian Kolom', 'Pekerjaan Pembesian', 'Pagar Pembatas', 'Pagar Pembatas', 'Pagar Pembatas'),
(8, 'WhatsApp_Image_2021-08-04_at_22_20_59_(2).jpeg', 'WhatsApp_Image_2021-08-04_at_22_20_59_(1).jpeg', 'WhatsApp_Image_2021-08-04_at_22_20_59.jpeg', 'WhatsApp_Image_2021-08-04_at_22_20_23_(2).jpeg', 'WhatsApp_Image_2021-08-04_at_22_20_23_(1).jpeg', 'WhatsApp_Image_2021-08-04_at_22_20_23.jpeg', 310, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Pagar Pembatas', 'Pekerjaan Pagar Pembatas', 'Pekerjaan Pagar Pembatas', 'Pengecoran Kolom', 'Bekisting Kolom', 'Bekisting Kolom'),
(9, 'WhatsApp_Image_2021-08-04_at_22_29_22_(5).jpeg', 'WhatsApp_Image_2021-08-04_at_22_29_22_(4).jpeg', 'WhatsApp_Image_2021-08-04_at_22_29_22_(3).jpeg', 'WhatsApp_Image_2021-08-04_at_22_29_22_(1).jpeg', 'WhatsApp_Image_2021-08-04_at_22_29_22_(2).jpeg', 'WhatsApp_Image_2021-08-04_at_22_29_22.jpeg', 311, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pengecoran Kolom', 'Pengecoran Kolom', 'Pengecoran Kolom', 'Pengecoran Kolom', 'Pagar Pembatas', 'Pagar Pembatas'),
(10, 'WhatsApp_Image_2021-08-06_at_19_57_25.jpeg', 'WhatsApp_Image_2021-08-06_at_19_57_26.jpeg', 'WhatsApp_Image_2021-08-06_at_19_57_27.jpeg', 'WhatsApp_Image_2021-08-06_at_19_57_28.jpeg', 'WhatsApp_Image_2021-08-06_at_19_57_24.jpeg', 'WhatsApp_Image_2021-08-06_at_19_57_29.jpeg', 312, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Bekisting Balok dan Plat', 'Pekerjaan Bekisting Balok dan Plat', 'Pekerjaan Pembesian', 'Pekerjaan Pembesian Balok', 'Pekerjaan Travelator', 'Pekerjaan Pagar Lansekap'),
(11, '22.jpg', '3.jpg', '12.jpg', '4.jpg', '5.jpg', '6.jpg', 502, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'Pekerjaan Selasar', 'Pekerjaan Selasar', 'Pekerjaan Pengecoran', 'Pekerjaan Konstruksi Baja', 'Pekerjaan Konstruksi Baja', 'Pekerjaan Area Fasade'),
(12, 'WhatsApp_Image_2021-08-07_at_16_29_12.jpeg', 'WhatsApp_Image_2021-08-07_at_16_29_13.jpeg', 'WhatsApp_Image_2021-08-07_at_16_29_12_(1).jpeg', 'WhatsApp_Image_2021-08-07_at_16_29_13_(2).jpeg', 'WhatsApp_Image_2021-08-07_at_16_29_14_(1).jpeg', 'WhatsApp_Image_2021-08-07_at_16_29_13_(1).jpeg', 232, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Kusen Alluminium', 'Pekerjaan Mekanikal', 'Pekerjaan Bekisting Balok dan Plat', 'Pekerjaan Bekisting Balok dan Plat', 'Pekerjaan Pembesian'),
(13, 'WhatsApp_Image_2021-08-14_at_19_31_17.jpeg', 'WhatsApp_Image_2021-08-14_at_19_31_17_(1).jpeg', 'WhatsApp_Image_2021-08-12_at_19_28_42.jpeg', 'WhatsApp_Image_2021-08-13_at_18_22_09.jpeg', 'WhatsApp_Image_2021-08-13_at_18_22_05.jpeg', 'WhatsApp_Image_2021-08-14_at_19_31_15.jpeg', 313, '0000-00-00', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Lantai Kerja Beton Rigid', 'Pekerjaan Galian U Ditc', 'Pekerjaan Pas. Pondasi Pagar Pembatas', 'Pekerjaan Plesteran Dinding', 'Pekerjaan Pembesian Balok Dag Atap Segmen 2', 'Pekerjaan Bekisting Balok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_history_addendum`
--

CREATE TABLE `new_history_addendum` (
  `id` int(11) NOT NULL,
  `proyek` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `surat_addendum` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `minggu_penyesuaian` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `minggu_matang` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_minggu`
--

CREATE TABLE `new_minggu` (
  `id` int(11) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `minggu` varchar(255) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `volume_total` double NOT NULL,
  `bobot_total` double NOT NULL,
  `bobot_total_acuan` double NOT NULL,
  `bobot_total_acuan_komulatif` double NOT NULL,
  `status_pengawas` int(11) NOT NULL,
  `status_ppk` int(11) NOT NULL,
  `status_kpa` int(11) NOT NULL,
  `status_ppspm` int(11) NOT NULL,
  `status_kasubdit` int(11) NOT NULL,
  `ttd_pengawas` varchar(255) NOT NULL,
  `ttd_ppk` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `pdfdokumentasi` varchar(255) NOT NULL,
  `alasan` varchar(500) NOT NULL,
  `tanggal_laporan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_minggu_dephub`
--

CREATE TABLE `new_minggu_dephub` (
  `id` int(15) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `minggu` varchar(50) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `persentase_total` double NOT NULL,
  `persentase_total_acuan` double NOT NULL,
  `persentase_total_acuan_komulatif` double NOT NULL,
  `bobot_persentase_total` double NOT NULL,
  `bobot_persentase_total_acuan` double NOT NULL,
  `bobot_persentase_total_acuan_komulatif` double NOT NULL,
  `status_pengawas` int(11) NOT NULL,
  `status_ppk` int(11) NOT NULL,
  `status_kpa` int(11) NOT NULL,
  `status_ppspm` int(11) NOT NULL,
  `status_kasubdit` int(11) NOT NULL,
  `ttd_pengawas` varchar(500) NOT NULL,
  `ttd_ppk` varchar(500) NOT NULL,
  `pdf` varchar(500) NOT NULL,
  `pdfdokumentasi` varchar(500) NOT NULL,
  `alasan` varchar(500) NOT NULL,
  `tanggal_laporan` timestamp NOT NULL DEFAULT current_timestamp(),
  `masalah` varchar(1500) NOT NULL,
  `solusi` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `new_minggu_dephub`
--

INSERT INTO `new_minggu_dephub` (`id`, `proyek`, `minggu`, `tgl_awal`, `tgl_akhir`, `persentase_total`, `persentase_total_acuan`, `persentase_total_acuan_komulatif`, `bobot_persentase_total`, `bobot_persentase_total_acuan`, `bobot_persentase_total_acuan_komulatif`, `status_pengawas`, `status_ppk`, `status_kpa`, `status_ppspm`, `status_kasubdit`, `ttd_pengawas`, `ttd_ppk`, `pdf`, `pdfdokumentasi`, `alasan`, `tanggal_laporan`, `masalah`, `solusi`) VALUES
(228, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 1', '2021-07-05', '2021-07-11', 0, 0, 0, 0, 0, 0, 2, 1, 1, 0, 0, '610a8fbe9353c.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_08_01_50_1628082110.pdf', '', '2021-08-04 13:01:50', '', ''),
(229, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 2', '2021-07-12', '2021-07-18', 0.173, 0, 0, 8.3939835031538, 0.073, 0.073, 2, 1, 1, 0, 0, '610a8a63b224d.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_07_38_59_1628080739.pdf', '', '2021-08-04 12:38:59', '', ''),
(230, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 3', '2021-07-19', '2021-07-25', 0.72, 0, 0, 22.3185086855067, 0.24, 0.313, 2, 1, 1, 0, 0, '610a8d0735f09.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_07_50_15_1628081415.pdf', '', '2021-08-04 12:50:15', '', ''),
(231, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 4', '2021-07-26', '2021-08-01', 2.008, 0, 0, 42.8409071064407, 0.498, 0.811, 2, 1, 1, 0, 0, '610a8d4353cf8.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_07_51_15_1628081475.pdf', '', '2021-08-04 12:51:15', '', ''),
(232, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 5', '2021-08-02', '2021-08-08', 4.853000000000001, 0, 0, 71.3568015340631, 1.872, 2.683, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_05_59_53_1628333993.pdf', '', '2021-08-07 10:59:53', '', ''),
(233, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 6', '2021-08-09', '2021-08-15', 0, 0, 0, 0, 2.899, 5.582, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(234, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 7', '2021-08-16', '2021-08-22', 0, 0, 0, 0, 3.248, 8.83, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(235, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 8', '2021-08-23', '2021-08-29', 0, 0, 0, 0, 3.44, 12.27, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(236, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 9', '2021-08-30', '2021-09-05', 0, 0, 0, 0, 4.145, 16.415, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(237, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 10', '2021-09-06', '2021-09-12', 0, 0, 0, 0, 5.016, 21.431, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(238, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 11', '2021-09-13', '2021-09-19', 0, 0, 0, 0, 6.248, 27.679, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(239, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 12', '2021-09-20', '2021-09-26', 0, 0, 0, 0, 7.125, 34.804, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(240, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 13', '2021-09-27', '2021-10-03', 0, 0, 0, 0, 6.299, 41.103, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(241, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 14', '2021-10-04', '2021-10-10', 0, 0, 0, 0, 5.241, 46.344, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(242, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 15', '2021-10-11', '2021-10-17', 0, 0, 0, 0, 4.607, 50.951, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(243, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 16', '2021-10-18', '2021-10-24', 0, 0, 0, 0, 5.647, 56.598, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(244, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 17', '2021-10-25', '2021-10-31', 0, 0, 0, 0, 6.115, 62.713, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:37', '', ''),
(245, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 18', '2021-11-01', '2021-11-07', 0, 0, 0, 0, 7.725, 70.438, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(246, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 19', '2021-11-08', '2021-11-14', 0, 0, 0, 0, 8.481, 78.919, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(247, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 20', '2021-11-15', '2021-11-21', 0, 0, 0, 0, 7.435, 86.354, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(248, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 21', '2021-11-22', '2021-11-28', 0, 0, 0, 0, 4.715, 91.069, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(249, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 22', '2021-11-29', '2021-12-05', 0, 0, 0, 0, 4.296, 95.365, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(250, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 23', '2021-12-06', '2021-12-12', 0, 0, 0, 0, 2.797, 98.162, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(251, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 24', '2021-12-13', '2021-12-19', 0, 0, 0, 0, 1.294, 99.456, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(252, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'minggu ke- 25', '2021-12-20', '2021-12-26', 0, 0, 0, 0, 0.544, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 07:10:38', '', ''),
(306, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 1', '2021-06-14', '2021-06-20', 0.25, 0, 0, 185.61096512682312, 0.018, 0.018, 2, 1, 1, 0, 0, '610aabf0a7302.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_02_08_1628089328.pdf', '', '2021-08-04 15:02:08', '', ''),
(307, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 2', '2021-06-21', '2021-06-27', 0.5179999999999999, 0, 0, 379.40434560700027, 0.218, 0.236, 2, 1, 1, 0, 0, '610aacd0eaf7c.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_05_52_1628089552.pdf', '', '2021-08-04 15:05:52', '', ''),
(308, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 3', '2021-06-28', '2021-07-04', 7.5440000000000005, 0, 0, 685.8447786225244, 2.875, 3.111, 2, 1, 1, 0, 0, '610aafdac9308.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_18_50_1628090330.pdf', '', '2021-08-04 15:18:50', '', ''),
(309, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 4', '2021-07-05', '2021-07-11', 10.663, 0, 0, 783.9595417172292, 3.573, 6.684, 2, 1, 1, 0, 0, '610aaffc353cb.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_19_24_1628090364.pdf', '', '2021-08-04 15:19:24', '', ''),
(310, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 5', '2021-07-12', '2021-07-18', 14.396, 0, 0, 837.5067934098741, 3.464, 10.148, 2, 1, 1, 0, 0, '610ab0e7460bc.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_23_19_1628090599.pdf', '', '2021-08-04 15:23:19', '', ''),
(311, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 6', '2021-07-19', '2021-07-25', 18.747, 0, 0, 911.541908768305, 3.446, 13.594, 2, 1, 1, 0, 0, '610ab3064d2b5.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_32_22_1628091142.pdf', '', '2021-08-04 15:32:22', '', ''),
(312, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 7', '2021-07-26', '2021-08-01', 25.087000000000003, 0, 0, 990.5938588286751, 3.414, 17.008, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_04_17_32_1628327852.pdf', '', '2021-08-07 09:17:32', '', ''),
(313, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 8', '2021-08-02', '2021-08-08', 30.44, 0, 0, 1096.902322661891, 3.414, 20.422, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_15_05_09_14_1629022154.pdf', '', '2021-08-15 10:09:14', '', ''),
(314, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 9', '2021-08-09', '2021-08-15', 30.458, 0, 0, 1107.945267447171, 4.078, 24.5, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(315, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 10', '2021-08-16', '2021-08-22', 0, 0, 0, 0, 4.079, 28.579, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(316, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 11', '2021-08-23', '2021-08-29', 0, 0, 0, 0, 4.079, 32.658, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(317, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 12', '2021-08-30', '2021-09-05', 0, 0, 0, 0, 4.847, 37.505, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(318, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 13', '2021-09-06', '2021-09-12', 0, 0, 0, 0, 5.723, 43.228, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(319, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 14', '2021-09-13', '2021-09-19', 0, 0, 0, 0, 6.99, 50.218, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(320, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 15', '2021-09-20', '2021-09-26', 0, 0, 0, 0, 6.021, 56.239, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(321, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 16', '2021-09-27', '2021-10-03', 0, 0, 0, 0, 5.341, 61.58, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(322, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 17', '2021-10-04', '2021-10-10', 0, 0, 0, 0, 4.908, 66.488, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(323, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 18', '2021-10-11', '2021-10-17', 0, 0, 0, 0, 4.778, 71.266, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(324, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 19', '2021-10-18', '2021-10-24', 0, 0, 0, 0, 5.329, 76.595, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(325, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 20', '2021-10-25', '2021-10-31', 0, 0, 0, 0, 3.757, 80.352, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(326, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 21', '2021-11-01', '2021-11-07', 0, 0, 0, 0, 4.017, 84.369, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(327, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 22', '2021-11-08', '2021-11-14', 0, 0, 0, 0, 3.549, 87.918, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(328, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 23', '2021-11-15', '2021-11-21', 0, 0, 0, 0, 3.628, 91.546, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(329, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 24', '2021-11-22', '2021-11-28', 0, 0, 0, 0, 2.73, 94.276, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(330, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 25', '2021-11-29', '2021-12-05', 0, 0, 0, 0, 2.416, 96.692, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(331, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 26', '2021-12-06', '2021-12-12', 0, 0, 0, 0, 2.02, 98.712, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(332, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 27', '2021-12-13', '2021-12-19', 0, 0, 0, 0, 0.862, 99.574, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(333, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'minggu ke- 28', '2021-12-20', '2021-12-26', 0, 0, 0, 0, 0.426, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 08:32:13', '', ''),
(495, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 1', '2021-06-07', '2021-06-13', 0.002, 0, 0, 0.074934432371675, 0.019, 0.019, 2, 1, 1, 0, 0, '610ab4163a012.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_36_54_1628091414.pdf', '', '2021-08-04 15:36:54', '', ''),
(496, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 2', '2021-06-14', '2021-06-20', 1.0830000000000002, 0, 0, 10.2389641753637, 0.679, 0.698, 2, 1, 1, 0, 0, '610abacb2aa6b.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_05_31_1628093131.pdf', '', '2021-08-04 16:05:31', '', ''),
(497, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 3', '2021-06-21', '2021-06-27', 2.89, 0, 0, 27.7203700531242, 2.615, 3.313, 2, 1, 1, 0, 0, '610abb0d400fe.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_06_37_1628093197.pdf', '', '2021-08-04 16:06:37', '', ''),
(498, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 4', '2021-06-28', '2021-07-04', 4.646, 0, 0, 71.93006083101629, 3.031, 6.344, 2, 1, 1, 0, 0, '610abb4f1cf2b.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_07_43_1628093263.pdf', '', '2021-08-04 16:07:43', '', ''),
(499, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 5', '2021-07-05', '2021-07-11', 7.645, 0, 0, 161.42092092644913, 6.873, 13.217, 2, 1, 1, 0, 0, '610abbf95f2f4.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_10_33_1628093433.pdf', '', '2021-08-04 16:10:33', '', ''),
(500, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 6', '2021-07-12', '2021-07-18', 22.495, 0, 0, 340.34049365764866, 7.127, 20.344, 2, 1, 1, 0, 0, '610abcf01d94d.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_14_40_1628093680.pdf', '', '2021-08-04 16:14:40', '', ''),
(501, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 7', '2021-07-19', '2021-07-25', 28.517, 0, 0, 424.30006737891995, 7.508, 27.852, 2, 1, 1, 0, 0, '610abd793cb52.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_05_33_53_1628332433.pdf', '', '2021-08-07 10:33:53', '', ''),
(502, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 8', '2021-07-26', '2021-08-01', 39.907, 0, 0, 555.007396968585, 13.425, 41.277, 2, 1, 1, 0, 0, '610cde273237c.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_05_54_49_1628333689.pdf', '', '2021-08-07 10:54:49', '1. Masa PPKM ini sebagian besar suplier banyak yang WFH, sehingga percepatan pengiriman barang/bahan kurang maksimal.\r\n2. Progres minggu ini terlihat minus karena pemasangan ACP Cutting Laser dan jendela jalusi sport center terlambat karena menunggu pengiriman, tetapi rangka sudah mulai dipasang dilokasi.\r\n', '1. Untuk pekerjaan kaca lobby hall minggu ini terlambat, diharapkan kontraktor pelaksana pada minggu 9 kaca tersebut harus sudah mulai dilaksanakan pemasangan.\r\n2. Untuk pekerjaan pipa baja selasar sudah mulai terpasang, diharapkan dapat diselesaikan minggu ini.\r\n3. Hari minggu tanggal 8 agustus 2021 kontraktor pelaksana harus segera melaksanakan pekerjaan erection baja gate entrance.'),
(503, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 9', '2021-08-02', '2021-08-08', 48.29500000000001, 0, 0, 657.406289543094, 9.448, 50.725, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_15_06_51_24_1629028284.pdf', '', '2021-08-15 11:51:24', 'keterlambatan fabrikasi', 'segera dilakukan percepatan finish fabrikasi'),
(504, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 10', '2021-08-09', '2021-08-15', 57.84400000000001, 0, 0, 791.732028266725, 9.988, 60.713, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_15_07_10_42_1629029442.pdf', '', '2021-08-15 12:10:42', 'fabrikasi belum selesai', 'percepatan fabrikasi'),
(505, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 11', '2021-08-16', '2021-08-22', 0, 0, 0, 0, 9.185, 69.898, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(506, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 12', '2021-08-23', '2021-08-29', 0, 0, 0, 0, 9.037, 78.935, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(507, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 13', '2021-08-30', '2021-09-05', 0, 0, 0, 0, 12.063, 90.998, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(508, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 14', '2021-09-06', '2021-09-12', 0, 0, 0, 0, 9.002, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(509, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 15', '2021-09-13', '2021-09-19', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(510, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 16', '2021-09-20', '2021-09-26', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(511, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 17', '2021-09-27', '2021-10-03', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(512, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 18', '2021-10-04', '2021-10-10', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(513, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 19', '2021-10-11', '2021-10-17', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(514, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 20', '2021-10-18', '2021-10-24', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(515, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 21', '2021-10-25', '2021-10-31', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(516, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 22', '2021-11-01', '2021-11-07', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(517, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 23', '2021-11-08', '2021-11-14', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(518, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 24', '2021-11-15', '2021-11-21', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(519, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 25', '2021-11-22', '2021-11-28', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(520, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 26', '2021-11-29', '2021-12-05', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(521, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'minggu ke- 27', '2021-12-06', '2021-12-12', 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 11:54:06', '', ''),
(522, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 1', '2020-11-23', '2020-11-29', 0, 0, 0, 0, 0.02, 0.02, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(523, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 2', '2020-11-30', '2020-12-06', 0, 0, 0, 0, 0.02, 0.04, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(524, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 3', '2020-12-07', '2020-12-13', 0, 0, 0, 0, 0.02, 0.06, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(525, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 4', '2020-12-14', '2020-12-20', 0, 0, 0, 0, 0.02, 0.08, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(526, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 5', '2020-12-21', '2020-12-27', 0, 0, 0, 0, 0.02, 0.1, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(527, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 6', '2020-12-28', '2021-01-03', 0, 0, 0, 0, 0.02, 0.12, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(528, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 7', '2021-01-04', '2021-01-10', 0, 0, 0, 0, 0.02, 0.14, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(529, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 8', '2021-01-11', '2021-01-17', 0, 0, 0, 0, 0.02, 0.16, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(530, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 9', '2021-01-18', '2021-01-24', 0, 0, 0, 0, 0.02, 0.18, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(531, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 10', '2021-01-25', '2021-01-31', 0, 0, 0, 0, 0.02, 0.2, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(532, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 11', '2021-02-01', '2021-02-07', 0, 0, 0, 0, 0.02, 0.22, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(533, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 12', '2021-02-08', '2021-02-14', 0, 0, 0, 0, 0.02, 0.24, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(534, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 13', '2021-02-15', '2021-02-21', 0, 0, 0, 0, 1.6, 1.84, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(535, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 14', '2021-02-22', '2021-02-28', 0, 0, 0, 0, 1.6, 3.44, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(536, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 15', '2021-03-01', '2021-03-07', 0, 0, 0, 0, 1.63, 5.07, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(537, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 16', '2021-03-08', '2021-03-14', 0, 0, 0, 0, 1.63, 6.7, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(538, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 17', '2021-03-15', '2021-03-21', 0, 0, 0, 0, 1.63, 8.33, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(539, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 18', '2021-03-22', '2021-03-28', 0, 0, 0, 0, 2.22, 10.55, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(540, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 19', '2021-03-29', '2021-04-04', 0, 0, 0, 0, 2.57, 13.12, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(541, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 20', '2021-04-05', '2021-04-11', 0, 0, 0, 0, 2.57, 15.69, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(542, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 21', '2021-04-12', '2021-04-18', 0, 0, 0, 0, 2.57, 18.26, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(543, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 22', '2021-04-19', '2021-04-25', 0, 0, 0, 0, 2.56, 20.82, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(544, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 23', '2021-04-26', '2021-05-02', 0, 0, 0, 0, 0.98, 21.8, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(545, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 24', '2021-05-03', '2021-05-09', 0, 0, 0, 0, 1.47, 23.27, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(546, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 25', '2021-05-10', '2021-05-16', 0, 0, 0, 0, 0, 23.27, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(547, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 26', '2021-05-17', '2021-05-23', 0, 0, 0, 0, 0, 23.27, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(548, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 27', '2021-05-24', '2021-05-30', 0, 0, 0, 0, 0.87, 24.14, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(549, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 28', '2021-05-31', '2021-06-06', 0, 0, 0, 0, 1.45, 25.59, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(550, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 29', '2021-06-07', '2021-06-13', 0, 0, 0, 0, 1.11, 26.7, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(551, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 30', '2021-06-14', '2021-06-20', 0, 0, 0, 0, 1.11, 27.81, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(552, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 31', '2021-06-21', '2021-06-27', 0, 0, 0, 0, 0.6, 28.41, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(553, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 32', '2021-06-28', '2021-07-04', 0, 0, 0, 0, 1.15, 29.56, 2, 1, 1, 0, 0, '610ab807557e1.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_53_43_1628092423.pdf', '', '2021-08-04 15:53:43', '', ''),
(554, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 33', '2021-07-05', '2021-07-11', 0, 0, 0, 0, 1.75, 31.31, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(555, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 34', '2021-07-12', '2021-07-18', 27.81, 0, 0, 400.25633907795, 1.84, 33.15, 2, 1, 1, 0, 0, '610abca482eb8.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_11_13_24_1628093604.pdf', '', '2021-08-04 16:13:24', '', ''),
(556, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 35', '2021-07-19', '2021-07-25', 27.86, 0, 0, 401.919043758843, 1.84, 34.99, 2, 1, 1, 0, 0, '610ab911652dc.png', '', '', 'Laporan_dokumentasi_mingguan_2021_08_04_10_58_09_1628092689.pdf', '', '2021-08-04 15:58:09', '', ''),
(557, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 36', '2021-07-26', '2021-08-01', 28.794999999999998, 0, 0, 425.73267205485195, 1.17, 36.16, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_05_50_27_1628333427.pdf', '', '2021-08-07 10:50:27', 'progres minus karena kurang optimalnya alokasi bahan material tenaga kerja', 'Akan dilakukan percepatan dengan penambahan Tenaga Kerja, Alat, dan Bahan'),
(558, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 37', '2021-08-02', '2021-08-08', 28.689, 0, 0, 407.918868339498, 1.84, 38, 2, 1, 1, 0, 0, '', '', '', 'Laporan_dokumentasi_mingguan_2021_08_07_05_46_02_1628333162.pdf', '', '2021-08-07 10:46:02', 'deviasi progress minus', 'PENINGKATAN PROGRESS DIMULAI DARI M.38 SAMPAI M.43. \r\nTARGET PROGRESS/ MINGGU SEBESAR MIN. 2,50%, 2,75%, MAKS. 3,00%\r\nDIHARAPKAN PADA M.43 DEVIASI PROGRESS SUDAH + 1,27%. \r\n'),
(559, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 38', '2021-08-09', '2021-08-15', 28.933, 0, 0, 424.540121745492, 1.29, 39.29, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(560, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 39', '2021-08-16', '2021-08-22', 0, 0, 0, 0, 1.29, 40.58, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(561, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 40', '2021-08-23', '2021-08-29', 0, 0, 0, 0, 0.91, 41.49, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(562, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 41', '2021-08-30', '2021-09-05', 0, 0, 0, 0, 0.91, 42.4, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(563, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 42', '2021-09-06', '2021-09-12', 0, 0, 0, 0, 1.21, 43.61, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(564, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 43', '2021-09-13', '2021-09-19', 0, 0, 0, 0, 1.03, 44.64, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(565, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 44', '2021-09-20', '2021-09-26', 0, 0, 0, 0, 1.03, 45.67, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(566, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 45', '2021-09-27', '2021-10-03', 0, 0, 0, 0, 1.13, 46.8, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(567, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 46', '2021-10-04', '2021-10-10', 0, 0, 0, 0, 1.13, 47.93, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(568, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 47', '2021-10-11', '2021-10-17', 0, 0, 0, 0, 1.13, 49.06, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(569, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 48', '2021-10-18', '2021-10-24', 0, 0, 0, 0, 0.92, 49.98, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(570, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 49', '2021-10-25', '2021-10-31', 0, 0, 0, 0, 0.92, 50.9, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(571, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 50', '2021-11-01', '2021-11-07', 0, 0, 0, 0, 0.6, 51.5, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(572, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 51', '2021-11-08', '2021-11-14', 0, 0, 0, 0, 0.6, 52.1, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(573, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 52', '2021-11-15', '2021-11-21', 0, 0, 0, 0, 0.6, 52.7, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(574, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 53', '2021-11-22', '2021-11-28', 0, 0, 0, 0, 0.14, 52.84, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(575, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 54', '2021-11-29', '2021-12-05', 0, 0, 0, 0, 0.14, 52.98, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(576, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 55', '2021-12-06', '2021-12-12', 0, 0, 0, 0, 0.46, 53.44, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(577, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 56', '2021-12-13', '2021-12-19', 0, 0, 0, 0, 0.49, 53.93, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(578, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 57', '2021-12-20', '2021-12-26', 0, 0, 0, 0, 0.49, 54.42, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(579, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 58', '2021-12-27', '2022-01-02', 0, 0, 0, 0, 0.49, 54.91, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(580, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 59', '2022-01-03', '2022-01-09', 0, 0, 0, 0, 1.11, 56.02, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(581, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 60', '2022-01-10', '2022-01-16', 0, 0, 0, 0, 1.08, 57.1, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(582, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 61', '2022-01-17', '2022-01-23', 0, 0, 0, 0, 1.75, 58.85, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(583, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 62', '2022-01-24', '2022-01-30', 0, 0, 0, 0, 1.75, 60.6, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(584, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 63', '2022-01-31', '2022-02-06', 0, 0, 0, 0, 1.09, 61.69, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(585, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 64', '2022-02-07', '2022-02-13', 0, 0, 0, 0, 2.23, 63.92, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(586, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 65', '2022-02-14', '2022-02-20', 0, 0, 0, 0, 2.17, 66.09, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(587, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 66', '2022-02-21', '2022-02-27', 0, 0, 0, 0, 2.2, 68.29, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(588, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 67', '2022-02-28', '2022-03-06', 0, 0, 0, 0, 2.24, 70.53, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(589, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 68', '2022-03-07', '2022-03-13', 0, 0, 0, 0, 1.9, 72.43, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(590, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 69', '2022-03-14', '2022-03-20', 0, 0, 0, 0, 2.48, 74.91, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(591, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 70', '2022-03-21', '2022-03-27', 0, 0, 0, 0, 2.89, 77.8, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(592, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 71', '2022-03-28', '2022-04-03', 0, 0, 0, 0, 3.15, 80.95, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(593, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 72', '2022-04-04', '2022-04-10', 0, 0, 0, 0, 3.12, 84.07, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(594, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 73', '2022-04-11', '2022-04-17', 0, 0, 0, 0, 3.56, 87.63, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(595, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 74', '2022-04-18', '2022-04-24', 0, 0, 0, 0, 2.48, 90.11, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(596, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 75', '2022-04-25', '2022-05-01', 0, 0, 0, 0, 2.54, 92.65, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(597, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 76', '2022-05-02', '2022-05-08', 0, 0, 0, 0, 2.45, 95.1, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', ''),
(598, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'minggu ke- 77', '2022-05-09', '2022-05-15', 0, 0, 0, 0, 4.9, 100, 0, 0, 0, 0, 0, '', '', '', '', '', '2021-08-04 14:06:28', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_pekerjaan`
--

CREATE TABLE `new_pekerjaan` (
  `id` int(255) NOT NULL,
  `uraian_pekerjaan` varchar(500) NOT NULL,
  `section` varchar(500) NOT NULL,
  `pekerjaan` varchar(500) NOT NULL,
  `satuan` varchar(500) NOT NULL,
  `volume` double NOT NULL,
  `harga_satuan` double NOT NULL,
  `nilai` double NOT NULL,
  `bobot` double DEFAULT NULL,
  `proyek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_pekerjaan_dephub`
--

CREATE TABLE `new_pekerjaan_dephub` (
  `id` int(15) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `uraian_subpekerjaan` varchar(500) NOT NULL,
  `nilai` double NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `new_pekerjaan_dephub`
--

INSERT INTO `new_pekerjaan_dephub` (`id`, `proyek`, `uraian_subpekerjaan`, `nilai`, `bobot`) VALUES
(374, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN PERSIAPAN', 630046000, 2.061),
(375, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN STRUKTUR UTAMA GEDUNG', 5313809337.8, 17.379),
(376, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'SKY BRIDGE', 2467713298, 8.071),
(377, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'RAMP (dari SKY BRIDGE menuju SHELTER area pengendapan)', 1568082086.7, 5.128),
(378, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN SHELTER di area pengendapan', 492838326, 1.612),
(379, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN STRUKTUR AREA DRIVE WAY DAN DROP OFF', 313167420, 1.024),
(380, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN STRUKTUR POWER HOUSE', 472019248.4, 1.544),
(381, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN STRUKTUR GROUND WATER TANK (GWT)', 404468749.8, 1.323),
(382, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN STRUKTUR PUMP ROOM (UKURAN 6 X 7 M)', 86774253.9, 0.284),
(383, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEK. STRUKTUR BANGUNAN GARDU PLN (R70)', 68323375.8, 0.223),
(384, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'BANGUNAN FASILITAS UMUM AWAK KENDARAAN LANTAI-2', 542959332, 1.776),
(385, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'BANGUNAN LOBBY KEDATANGAN BIS LANTAI-2', 1242529629, 4.064),
(386, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'BANGUNAN UTAMA TERMINAL LANTAI II', 3996185061.2, 13.07),
(387, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'LANTAI TIGA', 199297168, 0.652),
(388, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN ARSITEKTUR POWER HOUSE', 236855816, 0.775),
(389, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN ARSITEKTUR AREA GWT & PUMP ROOM', 160632648, 0.525),
(390, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEK. ATAP ALDERON SKYBRIDGE RAMP SHELTER', 438856997.5, 1.435),
(391, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN FACADE', 1488689016, 4.869),
(392, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEK. FINISHING BANGUNAN GARDU PLN (R70)', 50401669.5, 0.165),
(393, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN SIGNAGE', 178858090, 0.585),
(394, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN MEKANIKAL STANDAR', 512441368, 1.676),
(395, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN MEKANIKAL NON STANDAR', 2992203340, 9.786),
(396, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN ELEKTRIKAL STANDAR', 2875313065, 9.404),
(397, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN ELEKTRIKAL NON STANDAR', 2866211530, 9.374),
(398, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PENGADAAN MEUBELAR', 348953850, 1.141),
(399, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN INFRASTRUKTUR', 475835466.6, 1.556),
(400, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN LANDSCAPE', 122149905, 0.399),
(401, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'PEKERJAAN FINISHING', 30381110, 0.099),
(502, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN PERSIAPAN', 0, 0),
(503, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pembuatan Papan Nama Kegiatan', 1065199.57, 0.005),
(504, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pembuatan Direksi Keet (Lantai Plester)', 43401347.25, 0.202),
(505, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pembuatan Gudang Semen dan Alat-alat', 46341066.8, 0.215),
(506, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Perlengkapan Direksi Keet', 15941595.32, 0.074),
(507, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pagar Sementara', 35182101, 0.163),
(508, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Bongkaran dan Perataan Tanah', 11589594.66, 0.054),
(509, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'K3 Proyek', 51842000, 0.2407),
(510, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Dukumentasi dan Pelaporan', 29120700, 0.135),
(511, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN LANDSCAPE', 0, 0),
(512, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Kanstin', 360280656.03, 1.673),
(513, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pengecatan Kanstin', 19693408.95, 0.091),
(514, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Taman', 95356250, 0.443),
(515, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Beton Jalan t = 20 cm', 2750925507.67, 12.775),
(516, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Saluran U ditc + Penutup Uk 60.60.120 cm', 1324155882.8, 6.149),
(517, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Saluran U ditc Uk 60.60.120 cm', 101573650.86, 0.472),
(518, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Dinding Pembatas Area Luar', 1026962342, 4.769),
(519, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Dinding Pembatas Area Jalur Bus dan Kendaraan Pribadi', 635469358.31, 2.951),
(520, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Bak Kontrol', 33185097.12, 0.154),
(521, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN BANGUNAN UTAMA LT 1', 0, 0),
(522, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'RUANG GENSET  (4 x 9)m2', 174806487.92, 0.812),
(523, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Genset Silent 60 KVA setara Perkins', 306348000, 1.423),
(524, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'SDP 2', 23990400, 0.111),
(525, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'SDP 3', 27700092, 0.128),
(526, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Line Power', 67848273.16, 0.315),
(527, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Signage', 314480098.24, 1.46),
(528, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Fire Safety', 20941620, 0.097),
(529, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pintu Akses Ruang Keberangkatan', 6040001.92, 0.028),
(530, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'AC', 227273422.22, 1.055),
(531, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan penutup kanopi', 385400073.3, 1.791),
(532, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Sanitari', 13994400, 0.065),
(533, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Shelter', 51554446.99, 0.239),
(534, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN BANGUNAN UTAMA LT 2', 0, 0),
(535, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Kolom + Balok', 3604027521.28, 16.737),
(536, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Dinding', 512039829.86, 2.378),
(537, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Lantai', 707796123.97, 3.287),
(538, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Plafond', 357987245.14, 1.662),
(539, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Kusen daun Pintu', 429049163.16, 1.992),
(540, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Sanitair', 554006933.28, 2.572),
(541, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Elektrikal', 318945175.52, 1.481),
(542, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Line Power', 41070961.08, 0.191),
(543, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Signage', 65278386, 0.303),
(544, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Fire Safety', 20941620, 0.097),
(545, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Pekerjaan Railing Kaca', 100866923.12, 0.468),
(546, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN PENERANGAN JALAN', 0, 0),
(547, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN LAMPU HIGH MASK', 155826230.45, 0.724),
(548, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN LPJU', 180187104.9, 0.837),
(549, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'PEKERJAAN PEMINDAHAN HIGH MASK EXISTING', 43229110.38, 0.202),
(550, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'FASILITAS PENUNJANG', 0, 0),
(551, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'Fasilitas Penunjang', 6240396587.94, 28.979),
(640, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEKERJAAN PERSIAPAN', 384550506.21, 2.669),
(641, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PERKERASAN JALAN LINGKUNGAN', 1002858367.49, 6.961),
(642, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'GATE ENTRANCE', 1338253387.44, 9.288),
(643, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEMBANGUNAN SELASAR PEDESTRIAN', 1850007340.39, 12.84),
(644, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEMBANGUNAN KANOPI PARKIR VIP DAN FOOD COURT OUT DOOR', 912559185.38, 6.334),
(645, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'FINISH LISTPLANK & PAGAR LANTAI 02', 414354319.38, 2.876),
(646, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PENGADAAN DAN PEMASANGAN ESKALATOR', 1366512042.08, 9.484),
(647, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEKERJAAN BANGUNAN UNTUK ESKALATOR', 328468355.31, 2.281),
(648, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEMBANGUNAN RUMAH GENSET DAN PENGADAAN GENSET', 137360069.63, 0.953),
(649, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PENGADAAN DAN INSTALASI GENSET', 1288876342.96, 8.945),
(650, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEKERJAAN FASILITAS KESELAMATAN', 515298787.5, 3.576),
(651, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEKERJAAN LANDSCAPE - VOID', 969555463.82, 6.729),
(652, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'PEKERJAAN LAIN - LAIN ( PENYEMPURNAAN TAHAP I )', 3899476986.4, 27.064),
(653, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'A. PEKERJAAN PERSIAPAN', 679352004.42, 1.468),
(654, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'B. PEKERJAAN STRUKTUR', 0, 0),
(655, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PEKERJAAN TANAH', 139584864, 0.302),
(656, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PONDASI PANCANG', 7310813285, 15.799),
(657, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'BETON PILE CAP', 1914843599.51, 4.138),
(658, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'STRUKTUR LANTAI 1', 6526211306.71, 14.104),
(659, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'STRUKTUR LANTAI 2', 5342697026.1, 11.546),
(660, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'STRUKTUR ATAP', 1964563092.66, 4.246),
(661, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PEKERJAAN BAJA', 2214450383.05, 4.786),
(662, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'C. PEKERJAAN ARSITEKTUR', 0, 0),
(663, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PEK. TANAH', 334408816.5, 0.723),
(664, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PASANGAN DAN BETON PRAKTIS LT. 1', 1188516304.07, 2.569),
(665, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'KUSEN PINTU JENDELA LT. 1', 281691794.26, 0.609),
(666, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PENUTUP DINDING DAN LANTAI LT. 1', 1380762199.17, 2.984),
(667, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PENGECATAN LT. 1', 218167236.31, 0.471),
(668, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PLAFOND LANTAI 1', 399768720.45, 0.864),
(669, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'FIXTURES LAVATORY LT. 1', 152338867.5, 0.329),
(670, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'AREA KEDATANGAN', 94523369.5, 0.204),
(671, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PASANGAN DAN BETON PRAKTIS LT. 2', 1532131083.89, 3.311),
(672, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'KUSEN PINTU JENDELA LT. 2', 63337530.09, 0.137),
(673, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PENUTUP DINDING DAN LANTAI LT. 2', 900696387.48, 1.946),
(674, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PENGECATAN LT. 2', 250938252.45, 0.542),
(675, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PLAFOND LANTAI 2', 345524355.83, 0.747),
(676, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'FIXTURES LAVATORY LT. 2', 84146262.5, 0.182),
(677, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'FASADE', 5596850692.4, 12.095),
(678, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'PEKERJAAN ATAP', 352677016.45, 0.762),
(679, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'D. PEKERJAAN ELEKTRIKAL', 5240680518.95, 11.326),
(680, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'E. PEKERJAAN PLUMBING', 1530785112.6, 3.308),
(681, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'F. PEKERJAAN FURNITURE & MEUBELAIR', 232291970, 0.502);

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_pekerjaan_detail`
--

CREATE TABLE `new_pekerjaan_detail` (
  `id` int(255) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `thn_anggaran` varchar(25) NOT NULL,
  `fk_id_pelaksana` int(11) NOT NULL,
  `pelaksana` varchar(255) NOT NULL,
  `pengawas` varchar(255) NOT NULL,
  `logopengawas` varchar(255) NOT NULL,
  `unitkerja` varchar(255) NOT NULL,
  `fk_id_pengawas` int(11) NOT NULL,
  `fk_id_ppk` int(11) NOT NULL,
  `fk_id_kpa` int(11) NOT NULL,
  `fk_id_ppspm` int(11) NOT NULL,
  `fk_id_kasubdit` int(11) NOT NULL,
  `fk_id_terminal` int(11) NOT NULL,
  `tanggalawal` date NOT NULL,
  `tanggalakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `new_pekerjaan_detail`
--

INSERT INTO `new_pekerjaan_detail` (`id`, `proyek`, `lokasi`, `provinsi`, `thn_anggaran`, `fk_id_pelaksana`, `pelaksana`, `pengawas`, `logopengawas`, `unitkerja`, `fk_id_pengawas`, `fk_id_ppk`, `fk_id_kpa`, `fk_id_ppspm`, `fk_id_kasubdit`, `fk_id_terminal`, `tanggalawal`, `tanggalakhir`) VALUES
(10, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', '', 'Jawa Barat', '2021', 0, 'PT. INDRIA PUTRA PERSADA', '', '', 'Direktorat Prasarana Transportasi Jalan', 24, 25, 26, 0, 0, 1, '2021-07-09', '2021-12-31'),
(13, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', '', 'Jawa Barat', '2021', 0, 'PT. AMBRIA RAHMA PUTRI SELARAS', '', '', 'Direktorat Prasarana Transportasi Jalan', 28, 25, 26, 0, 0, 2, '2021-06-15', '2021-12-31'),
(20, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', '', 'Jawa Tengah', '2021', 0, 'PT. MAJAPAHIT ASTABAJA', '', '', 'Direktorat Prasarana Transportasi Jalan', 27, 25, 26, 0, 0, 3, '2021-06-07', '2021-12-16'),
(21, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', '', 'Jawa Tengah', '2021', 0, 'PT. CITRA PRASASTI KONSORINDO', '', '', 'Direktorat Prasarana Transportasi Jalan', 29, 25, 26, 0, 0, 5, '2020-11-24', '2022-05-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `new_request_addendum`
--

CREATE TABLE `new_request_addendum` (
  `id` int(11) NOT NULL,
  `proyek` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `fk_id_ppk` int(11) NOT NULL,
  `surat` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `xls` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `status` int(10) NOT NULL,
  `tanggal_request` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(255) NOT NULL,
  `nama_pekerjaan` varchar(150) DEFAULT NULL,
  `tahun_anggaran` int(4) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `sumber_dana` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `tahun_anggaran`, `lokasi`, `sumber_dana`) VALUES
(7, 'Rehabilitasi Gedung OK', 2019, 'Magelang', '-'),
(8, 'Rehabilitasi Gedung Utama', 2019, 'Magelang', '-'),
(9, 'Rehabilitasi Gedung Rawat Inap', 2019, 'Magelang', '-'),
(10, 'kerja kerja kerja', 2020, 'bumi', 'dana rakyat'),
(11, 'kerja 1', 2020, 'genteng', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `proyek` varchar(500) NOT NULL,
  `pelaksana` varchar(30) NOT NULL DEFAULT '0',
  `pengawas` varchar(30) NOT NULL DEFAULT '0',
  `perencana` varchar(30) NOT NULL DEFAULT '0',
  `honorium` varchar(30) NOT NULL DEFAULT '0',
  `perjalanan_dinas` varchar(30) NOT NULL DEFAULT '0',
  `habis_pakai` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `proyek`, `pelaksana`, `pengawas`, `perencana`, `honorium`, `perjalanan_dinas`, `habis_pakai`) VALUES
(37, 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', '6726719200', '0', '0', '0', '0', '0'),
(40, 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', '4737504600', '0', '0', '0', '0', '0'),
(47, 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', '6339577600', '0', '0', '0', '0', '0'),
(48, 'Revitalisasi Terminal Penumpang Tipe A Kebumen', '17561398216', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_history`
--

CREATE TABLE `pembayaran_history` (
  `id` int(11) NOT NULL,
  `fk_id_kontruksi_history` varchar(100) NOT NULL,
  `proyek` varchar(500) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `rincian` varchar(500) NOT NULL,
  `nilai` varchar(30) NOT NULL DEFAULT '0',
  `surat` varchar(500) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_perubahan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_history`
--

INSERT INTO `pembayaran_history` (`id`, `fk_id_kontruksi_history`, `proyek`, `kategori`, `rincian`, `nilai`, `surat`, `tanggal`, `tanggal_perubahan`) VALUES
(45, '2021.08.04.14.10.37', 'Revitalisasi Terminal Penumpang Tipe A Leuwipanjang', 'pelaksana', 'Pembayaran Uang Muka Pelaksanaan', '6726719200', '2021_08_04_07_57_41_1628081861.pdf', '2021-08-04', '2021-08-04 12:57:41'),
(46, '2021.08.04.15.32.13', 'Revitalisasi Terminal Penumpang Tipe A Harjamukti', 'pelaksana', 'Uang Muka', '4737504600', '2021_08_04_10_28_00_1628090880.pdf', '2021-07-15', '2021-08-04 15:28:00'),
(47, '2021.08.04.18.54.06', 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'pelaksana', 'Uang Muka', '3169788800', '2021_08_04_10_32_04_1628091124.pdf', '2021-07-01', '2021-08-04 15:32:04'),
(48, '2021.08.04.18.54.06', 'Revitalisasi Terminal Penumpang Tipe A Tirtonadi', 'pelaksana', 'Termin I', '3169788800', '2021_08_04_10_33_01_1628091181.pdf', '2021-07-31', '2021-08-04 15:33:01'),
(49, '2021.08.04.21.06.28', 'Revitalisasi Terminal Penumpang Tipe A Kebumen', 'pelaksana', 'UM dan Termin 1', '17561398216', '2021_08_07_05_55_42_1628333742.pdf', '2021-08-02', '2021-08-07 10:55:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_kas`
--

CREATE TABLE `pengajuan_kas` (
  `id_pengajuan_kas` int(255) NOT NULL,
  `no_pengajuan` varchar(100) DEFAULT NULL,
  `tanggal` datetime(6) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `jumlah` float(25,0) DEFAULT NULL,
  `nama_pemohon` varchar(100) DEFAULT NULL,
  `nama_v1` varchar(100) DEFAULT NULL,
  `nama_v2` varchar(100) DEFAULT NULL,
  `nama_v3` varchar(100) DEFAULT NULL,
  `ttd_v1` text DEFAULT NULL,
  `ttd_v2` text DEFAULT NULL,
  `ttd_v3` text DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `ttd_pemohon` text DEFAULT NULL,
  `alasan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan_kas`
--

INSERT INTO `pengajuan_kas` (`id_pengajuan_kas`, `no_pengajuan`, `tanggal`, `uraian`, `jumlah`, `nama_pemohon`, `nama_v1`, `nama_v2`, `nama_v3`, `ttd_v1`, `ttd_v2`, `ttd_v3`, `status`, `ttd_pemohon`, `alasan`) VALUES
(10, 'PKAS-20200430092402', '2020-04-30 09:24:02.000000', 'tambah kas', 90000, 'tom', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `ttd` varchar(255) NOT NULL,
  `pengawas` varchar(255) NOT NULL,
  `logopengawas` varchar(255) NOT NULL,
  `profil` varchar(500) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `nip`, `password`, `proyek`, `pdf`, `posisi`, `perusahaan`, `ttd`, `pengawas`, `logopengawas`, `profil`, `jabatan`) VALUES
(8, 'Admin', 'admin@admin.com', '361655', 'admin', '', '', 'Admin', '', '', '', '', '', ''),
(24, 'AJI PRATAMA PUTRA, ST.', 'bandung@dptj.com', '-', 'bandung', '', '', 'Pengawas', '', '', 'PT. TAMBORA SETIA JAYA', 'tambora.jpg', '', ''),
(25, 'FITROH, ST., MT.', 'fitroh@ppkdptj.com', '19881006 201012 1 001', 'ppkdptj', '', '', 'PPK', '', '', '-', '', '', ''),
(26, 'Direktur KPA', 'direktur@kpadptj.com', '-', 'direkturdptj', '', '', 'KPA', '', '', '-', '', '', ''),
(27, 'PT. Proporsi', 'surakarta@dptj.com', '', 'proporsi', '', '', 'Pengawas', '', '', 'PT. PROPORSI', 'download.png', '', ''),
(28, 'AYATULLOH ABU BAKAR, ST.', 'cirebon@dptj.com', '-', 'ayat', '', '', 'Pengawas', '', '', 'PT. BUANA REKAYASA ADHIGANA', 'download.jpg', '', ''),
(29, 'PT. Puri Dimensi', 'kebumen@dptj.com', '-', 'puridimensi', '', '', 'Pengawas', '', '', 'PT. PURI DIMENSI', '1-2.png', '', ''),
(30, 'Ahmadi', 'kasubdit@dptj.com', '1', 'kasubditdptj', '', '', 'KASUBDIT', '', '', '', '', '', ''),
(31, 'Staff', 'terminal@dptj.com', '1', 'terminal', '', '', 'KPA', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id_permohonan` int(255) NOT NULL,
  `jenis_transaksi` int(1) DEFAULT NULL,
  `tanggal_permohonan` date DEFAULT NULL,
  `id_item_pekerjaan` int(255) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `nama_barang_permohonan` text DEFAULT NULL,
  `harga_satuan` float(25,0) DEFAULT NULL,
  `quantity` float(255,2) DEFAULT NULL,
  `jumlah` float(255,2) DEFAULT NULL,
  `pemohon` int(255) DEFAULT NULL,
  `satuan_barang` varchar(50) DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `id_verifikator_1` int(255) DEFAULT NULL,
  `status_verifikator_1` int(1) DEFAULT 0,
  `tanda_tangan_verifikator_1` text DEFAULT NULL,
  `id_verifikator_2` int(255) DEFAULT NULL,
  `status_verifikator_2` int(1) DEFAULT 0,
  `tanda_tangan_verifikator_2` text DEFAULT NULL,
  `id_verifikator_3` int(255) DEFAULT NULL,
  `status_verifikator_3` int(1) DEFAULT 0,
  `tanda_tangan_verifikator_3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_budgeting`
--

CREATE TABLE `permohonan_budgeting` (
  `id_permohonan_budgeting` int(255) NOT NULL,
  `no_pengajuan` varchar(150) DEFAULT NULL,
  `tanggal` datetime(6) DEFAULT NULL,
  `id_pekerjaan` int(255) DEFAULT NULL,
  `nama_pekerjaan` varchar(150) DEFAULT NULL,
  `id_sub_pekerjaan` int(255) DEFAULT NULL,
  `nama_sub_pekerjaan` varchar(150) DEFAULT NULL,
  `id_item_pekerjaan` int(255) DEFAULT NULL,
  `nama_item_pekerjaan` varchar(150) DEFAULT NULL,
  `id_barang` int(255) DEFAULT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `id_toko` int(255) DEFAULT NULL,
  `nama_toko` varchar(150) DEFAULT NULL,
  `harga_satuan` float(25,0) DEFAULT NULL,
  `quantity` float(25,0) DEFAULT NULL,
  `jumlah` float(25,0) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `ttd_pemohon` text DEFAULT NULL,
  `v_1` int(1) DEFAULT 0,
  `ttd_v1` text DEFAULT NULL,
  `v_2` int(1) DEFAULT 0,
  `ttd_v2` text DEFAULT NULL,
  `v_3` int(1) DEFAULT 0,
  `ttd_v3` text DEFAULT NULL,
  `alasan_v1` text DEFAULT NULL,
  `alasan_v2` text DEFAULT NULL,
  `alasan_v3` text DEFAULT NULL,
  `id_pemohon` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_purchase_order` int(255) NOT NULL,
  `tanggal` datetime(6) DEFAULT NULL,
  `no_pengajuan` varchar(150) DEFAULT NULL,
  `id_pemohon` int(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `ttd_admin` text DEFAULT NULL,
  `ttd_v1` text DEFAULT NULL,
  `ttd_v2` text DEFAULT NULL,
  `ttd_v3` text DEFAULT NULL,
  `ttd_pemohon` text DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `alasan` text DEFAULT NULL,
  `nama_pemohon` varchar(150) DEFAULT NULL,
  `nama_v1` varchar(150) DEFAULT NULL,
  `nama_v2` varchar(150) DEFAULT NULL,
  `nama_v3` varchar(150) DEFAULT NULL,
  `nama_admin` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchase_order`
--

INSERT INTO `purchase_order` (`id_purchase_order`, `tanggal`, `no_pengajuan`, `id_pemohon`, `data`, `ttd_admin`, `ttd_v1`, `ttd_v2`, `ttd_v3`, `ttd_pemohon`, `status`, `alasan`, `nama_pemohon`, `nama_v1`, `nama_v2`, `nama_v3`, `nama_admin`) VALUES
(29, '2020-04-30 09:16:45.000000', 'ODMTR-20200430091645', 49, '[{\"id_rencana_po\":\"64\",\"id_sub_pekerjaan\":\"26\",\"id_item_pekerjaan\":\"44\",\"id_toko\":\"7\",\"id_barang\":\"10\",\"jumlah\":\"90\",\"id_user\":\"49\",\"id_pekerjaan\":\"10\",\"no_refrensi_item_pekerjaan\":\"1\",\"nama_item_pekerjaan\":\"item kerja\",\"satuan\":\"Lonjor\",\"nama_pekerjaan\":\"kerja kerja kerja\",\"tahun_anggaran\":\"2020\",\"lokasi\":\"bumi\",\"sumber_dana\":\"dana rakyat\",\"no_refrensi\":\"1\",\"nama_sub_pekerjaan\":\"kerja 1\",\"nama_toko\":\"Toko Ajaib\",\"alamat\":\"Jl. Raya Magelang No. 182 Magelang\",\"no_rekening\":\"23569222301\",\"nama_bank\":\"BCA\",\"no_telp\":\"029322255566\",\"id_daftar_harga\":\"10\",\"nama_barang\":\"Besi D10\",\"harga\":\"45000\",\"merk\":\"KS\"},{\"id_rencana_po\":\"65\",\"id_sub_pekerjaan\":\"26\",\"id_item_pekerjaan\":\"44\",\"id_toko\":\"7\",\"id_barang\":\"11\",\"jumlah\":\"90\",\"id_user\":\"49\",\"id_pekerjaan\":\"10\",\"no_refrensi_item_pekerjaan\":\"1\",\"nama_item_pekerjaan\":\"item kerja\",\"satuan\":\"Lonjor\",\"nama_pekerjaan\":\"kerja kerja kerja\",\"tahun_anggaran\":\"2020\",\"lokasi\":\"bumi\",\"sumber_dana\":\"dana rakyat\",\"no_refrensi\":\"1\",\"nama_sub_pekerjaan\":\"kerja 1\",\"nama_toko\":\"Toko Ajaib\",\"alamat\":\"Jl. Raya Magelang No. 182 Magelang\",\"no_rekening\":\"23569222301\",\"nama_bank\":\"BCA\",\"no_telp\":\"029322255566\",\"id_daftar_harga\":\"11\",\"nama_barang\":\"Besi D12\",\"harga\":\"86000\",\"merk\":\"KS\"}]', NULL, NULL, NULL, NULL, NULL, 0, NULL, 'tom', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reimbursement`
--

CREATE TABLE `reimbursement` (
  `id_reimbursement` int(255) NOT NULL,
  `tanggal` datetime(6) DEFAULT NULL,
  `no_pengajuan` varchar(150) DEFAULT NULL,
  `id_pemohon` int(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `ttd_admin` text DEFAULT NULL,
  `ttd_v1` text DEFAULT NULL,
  `ttd_v2` text DEFAULT NULL,
  `ttd_v3` text DEFAULT NULL,
  `ttd_pemohon` text DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `alasan` text DEFAULT NULL,
  `nama_pemohon` varchar(150) DEFAULT NULL,
  `nama_v1` varchar(150) DEFAULT NULL,
  `nama_v2` varchar(150) DEFAULT NULL,
  `nama_v3` varchar(150) DEFAULT NULL,
  `nama_admin` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reimbursement`
--

INSERT INTO `reimbursement` (`id_reimbursement`, `tanggal`, `no_pengajuan`, `id_pemohon`, `data`, `ttd_admin`, `ttd_v1`, `ttd_v2`, `ttd_v3`, `ttd_pemohon`, `status`, `alasan`, `nama_pemohon`, `nama_v1`, `nama_v2`, `nama_v3`, `nama_admin`) VALUES
(21, '2020-04-30 09:30:27.000000', 'REIM-20200430093027', 48, '[{\"id_claim_reimbursement\":\"22\",\"jenis_transaksi\":\"1\",\"atas_nama\":\"namasaya\",\"uraian\":\"membayar\",\"jumlah\":\"90000\",\"bukti\":\"upload\\/bukti\\/09300430202023.jpg\"}]', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2020-04-30 09:30:47.000000', 'REIM-20200430093047', 48, '[]', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rencana_po`
--

CREATE TABLE `rencana_po` (
  `id_rencana_po` int(255) NOT NULL,
  `proyek` varchar(255) DEFAULT NULL,
  `id_sub_pekerjaan` varchar(255) DEFAULT NULL,
  `id_item_pekerjaan` varchar(255) DEFAULT NULL,
  `id_toko` int(255) DEFAULT NULL,
  `id_barang` int(255) DEFAULT NULL,
  `jumlah` float(25,0) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rencana_po`
--

INSERT INTO `rencana_po` (`id_rencana_po`, `proyek`, `id_sub_pekerjaan`, `id_item_pekerjaan`, `id_toko`, `id_barang`, `jumlah`, `id_user`) VALUES
(66, 'nama proyek', 'pekerjaan persiapan', 'pembersihan lokasi', 7, 11, 86000, 49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_pekerjaan`
--

CREATE TABLE `sub_pekerjaan` (
  `id_sub_pekerjaan` int(255) NOT NULL,
  `id_pekerjaan` int(255) DEFAULT NULL,
  `no_refrensi` varchar(25) DEFAULT NULL,
  `nama_sub_pekerjaan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_pekerjaan`
--

INSERT INTO `sub_pekerjaan` (`id_sub_pekerjaan`, `id_pekerjaan`, `no_refrensi`, `nama_sub_pekerjaan`) VALUES
(23, 7, 'II', 'PEKERJAAN KONSTRUKSI KAYU'),
(24, 7, 'III', 'PEKERJAAN KUSEN, PINTU DAN JENDELA'),
(25, 7, 'I', 'PEKERJAAN PEMBONGKARAN'),
(26, 10, '1', 'kerja 1'),
(27, 10, '3', 'kerja 3'),
(28, 10, '2', 'kerja 2'),
(29, 11, '1', 'pasangan diding');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terminal`
--

CREATE TABLE `terminal` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `terminal`
--

INSERT INTO `terminal` (`id`, `nama`, `lokasi`, `gambar`) VALUES
(1, 'Terminal Leuwipanjang', 'Kota Bandung', 'BANDUNG.png'),
(2, 'Terminal Harjamukti', 'Kabupaten Cirebon', 'CIREBON.png'),
(3, 'Terminal Tirtonadi', 'Kota Surakarta', 'SURAKARTA.png'),
(5, 'Terminal Kebumen', 'Kabupaten Kebumen', 'KEBUMEN.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(255) NOT NULL,
  `nama_toko` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `no_telp` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat`, `no_rekening`, `nama_bank`, `no_telp`) VALUES
(6, 'Toko Murah', 'Jl. Raya Magelang', '1234567890', 'Mandiri', '0293566887'),
(7, 'Toko Ajaib', 'Jl. Raya Magelang No. 182 Magelang', '23569222301', 'BCA', '029322255566');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttd_permohonan`
--

CREATE TABLE `ttd_permohonan` (
  `id_ttd_permohonan` varchar(255) NOT NULL,
  `ttd_permohonan` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hak` varchar(1) DEFAULT NULL,
  `profil` text DEFAULT NULL,
  `id_firebase` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `verifikator` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `password`, `email`, `nama`, `hak`, `profil`, `id_firebase`, `token`, `verifikator`) VALUES
(39, 'MGpMU2daWW4vSFlmKzRTVVkvMlZHdz09', 'toyie_fuchi@yahoo.com', 'Moch. Yusuf Kurniawan', '1', NULL, '', 'ceIvoaEYJUI:APA91bFwHeKEMEnUjvzt3w-R4ZBq4pJet6k8z059MZ_Y22SikhW7areCzLSx8blteHQYL66KhomaUmijDPgDVXcAXkcOX4Lx0P9tm3LekA12ednppbPgx4l2GblUoHdoy_TQyvn3wbfL', 3),
(41, 'MGpMU2daWW4vSFlmKzRTVVkvMlZHdz09', 'sholeh.demak@gmail.com', 'Sholeh', '1', NULL, '', 'fhIvOiZWu1w:APA91bGhYLXC2braOwGJ9YW1vQreh7sH1qMTQj3owLvGwrhuxPn7wtufOMgVyuZa9Dv98T4P8a7krabDXBpNkX78W9okZpxPIFHEXw0wXo2mgYmE90sWShv98koeo6IO7X73NTzJpvIQ', 1),
(42, 'MGpMU2daWW4vSFlmKzRTVVkvMlZHdz09', 'susiloatim@yahoo.com', 'Atim', '1', NULL, '', 'fyQNjEfNrrw:APA91bF2U3qez_AFomS63dZPe0JW6RA9Jz6HmEo0n8y7hyxre0QjQEAI7JexX3uJd3D1DA06vzKKsH8P99jCWeTRUy4uB6V2SqZQC5ONUsEo72Z04gdaInw5VvUT5s_TqgcxaI-YE4fy', 2),
(45, 'MGpMU2daWW4vSFlmKzRTVVkvMlZHdz09', 'djuwita041@gmail.com', 'Administrasi', '2', NULL, '', NULL, 0),
(46, 'MGpMU2daWW4vSFlmKzRTVVkvMlZHdz09', 'yonotri44@yahoo.com', 'Project Manager', '5', NULL, '', 'ceIvoaEYJUI:APA91bFwHeKEMEnUjvzt3w-R4ZBq4pJet6k8z059MZ_Y22SikhW7areCzLSx8blteHQYL66KhomaUmijDPgDVXcAXkcOX4Lx0P9tm3LekA12ednppbPgx4l2GblUoHdoy_TQyvn3wbfL', 0),
(47, 'tom', 'tom@tom.com', 'tom', '1', NULL, NULL, 'ceIvoaEYJUI:APA91bFwHeKEMEnUjvzt3w-R4ZBq4pJet6k8z059MZ_Y22SikhW7areCzLSx8blteHQYL66KhomaUmijDPgDVXcAXkcOX4Lx0P9tm3LekA12ednppbPgx4l2GblUoHdoy_TQyvn3wbfL', 1),
(48, 'tom', 'admintom@tom.com', 'tom', '2', NULL, NULL, NULL, 0),
(49, 'tom', 'manajertom@tom.com', 'tom', '5', NULL, NULL, 'ceIvoaEYJUI:APA91bFwHeKEMEnUjvzt3w-R4ZBq4pJet6k8z059MZ_Y22SikhW7areCzLSx8blteHQYL66KhomaUmijDPgDVXcAXkcOX4Lx0P9tm3LekA12ednppbPgx4l2GblUoHdoy_TQyvn3wbfL', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `budgeting`
--
ALTER TABLE `budgeting`
  ADD PRIMARY KEY (`id_budgeting`);

--
-- Indeks untuk tabel `budgeting_kontruksi`
--
ALTER TABLE `budgeting_kontruksi`
  ADD PRIMARY KEY (`id_kontruksi`);

--
-- Indeks untuk tabel `claim_reimbursement`
--
ALTER TABLE `claim_reimbursement`
  ADD PRIMARY KEY (`id_claim_reimbursement`);

--
-- Indeks untuk tabel `daftar_harga`
--
ALTER TABLE `daftar_harga`
  ADD PRIMARY KEY (`id_daftar_harga`) USING BTREE;

--
-- Indeks untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`idfoto`);

--
-- Indeks untuk tabel `item_pekerjaan`
--
ALTER TABLE `item_pekerjaan`
  ADD PRIMARY KEY (`id_item_pekerjaan`) USING BTREE;

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`) USING BTREE;

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indeks untuk tabel `new_bobot_pekerjaan`
--
ALTER TABLE `new_bobot_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_bobot_uraian_kerja`
--
ALTER TABLE `new_bobot_uraian_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_bobot_uraian_kerja_dephub`
--
ALTER TABLE `new_bobot_uraian_kerja_dephub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_dokumentasi_dephub`
--
ALTER TABLE `new_dokumentasi_dephub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_history_addendum`
--
ALTER TABLE `new_history_addendum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_minggu`
--
ALTER TABLE `new_minggu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_minggu_dephub`
--
ALTER TABLE `new_minggu_dephub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_pekerjaan`
--
ALTER TABLE `new_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_pekerjaan_dephub`
--
ALTER TABLE `new_pekerjaan_dephub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_pekerjaan_detail`
--
ALTER TABLE `new_pekerjaan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `new_request_addendum`
--
ALTER TABLE `new_request_addendum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`) USING BTREE;

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembayaran_history`
--
ALTER TABLE `pembayaran_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_kas`
--
ALTER TABLE `pengajuan_kas`
  ADD PRIMARY KEY (`id_pengajuan_kas`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id_permohonan`) USING BTREE;

--
-- Indeks untuk tabel `permohonan_budgeting`
--
ALTER TABLE `permohonan_budgeting`
  ADD PRIMARY KEY (`id_permohonan_budgeting`) USING BTREE;

--
-- Indeks untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_purchase_order`) USING BTREE;

--
-- Indeks untuk tabel `reimbursement`
--
ALTER TABLE `reimbursement`
  ADD PRIMARY KEY (`id_reimbursement`) USING BTREE;

--
-- Indeks untuk tabel `rencana_po`
--
ALTER TABLE `rencana_po`
  ADD PRIMARY KEY (`id_rencana_po`) USING BTREE;

--
-- Indeks untuk tabel `sub_pekerjaan`
--
ALTER TABLE `sub_pekerjaan`
  ADD PRIMARY KEY (`id_sub_pekerjaan`) USING BTREE;

--
-- Indeks untuk tabel `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`) USING BTREE;

--
-- Indeks untuk tabel `ttd_permohonan`
--
ALTER TABLE `ttd_permohonan`
  ADD PRIMARY KEY (`id_ttd_permohonan`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `budgeting`
--
ALTER TABLE `budgeting`
  MODIFY `id_budgeting` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `claim_reimbursement`
--
ALTER TABLE `claim_reimbursement`
  MODIFY `id_claim_reimbursement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `daftar_harga`
--
ALTER TABLE `daftar_harga`
  MODIFY `id_daftar_harga` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `item_pekerjaan`
--
ALTER TABLE `item_pekerjaan`
  MODIFY `id_item_pekerjaan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `new_bobot_pekerjaan`
--
ALTER TABLE `new_bobot_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `new_bobot_uraian_kerja`
--
ALTER TABLE `new_bobot_uraian_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140036;

--
-- AUTO_INCREMENT untuk tabel `new_bobot_uraian_kerja_dephub`
--
ALTER TABLE `new_bobot_uraian_kerja_dephub`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1608;

--
-- AUTO_INCREMENT untuk tabel `new_dokumentasi_dephub`
--
ALTER TABLE `new_dokumentasi_dephub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `new_history_addendum`
--
ALTER TABLE `new_history_addendum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `new_minggu`
--
ALTER TABLE `new_minggu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT untuk tabel `new_minggu_dephub`
--
ALTER TABLE `new_minggu_dephub`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=599;

--
-- AUTO_INCREMENT untuk tabel `new_pekerjaan`
--
ALTER TABLE `new_pekerjaan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68790;

--
-- AUTO_INCREMENT untuk tabel `new_pekerjaan_dephub`
--
ALTER TABLE `new_pekerjaan_dephub`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=682;

--
-- AUTO_INCREMENT untuk tabel `new_pekerjaan_detail`
--
ALTER TABLE `new_pekerjaan_detail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `new_request_addendum`
--
ALTER TABLE `new_request_addendum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_history`
--
ALTER TABLE `pembayaran_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_kas`
--
ALTER TABLE `pengajuan_kas`
  MODIFY `id_pengajuan_kas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `permohonan_budgeting`
--
ALTER TABLE `permohonan_budgeting`
  MODIFY `id_permohonan_budgeting` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_purchase_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `reimbursement`
--
ALTER TABLE `reimbursement`
  MODIFY `id_reimbursement` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `rencana_po`
--
ALTER TABLE `rencana_po`
  MODIFY `id_rencana_po` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `sub_pekerjaan`
--
ALTER TABLE `sub_pekerjaan`
  MODIFY `id_sub_pekerjaan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
