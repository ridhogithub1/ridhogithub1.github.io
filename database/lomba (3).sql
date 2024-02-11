-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2024 at 10:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lomba`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(15) NOT NULL,
  `tanggal` datetime NOT NULL,
  `estate` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `kontraktor` varchar(255) NOT NULL,
  `inspector` varchar(255) NOT NULL,
  `jenis_pelanggaran_nosa` varchar(255) NOT NULL,
  `hpi` varchar(255) NOT NULL DEFAULT 'No-HPI',
  `type_nc` varchar(255) NOT NULL,
  `pengawas` varchar(255) NOT NULL,
  `action_plan` varchar(255) NOT NULL,
  `nik` int(15) NOT NULL,
  `pelapor` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `hari_open` int(15) NOT NULL,
  `deadline` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Open',
  `planed` varchar(255) NOT NULL DEFAULT 'Unplaned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `tanggal`, `estate`, `region`, `location`, `department`, `kegiatan`, `kontraktor`, `inspector`, `jenis_pelanggaran_nosa`, `hpi`, `type_nc`, `pengawas`, `action_plan`, `nik`, `pelapor`, `gambar`, `hari_open`, `deadline`, `status`, `planed`) VALUES
(42, '2024-01-19 16:20:00', 'Teso', 'West', 'CRW', 'CRW', 'Operational Fuel Station', 'PT. RAPP', 'Edy Suprayitno', 'Grounding di tower BBM sudah tidak ada', 'No-HPI', 'Engineering', 'Natalis', 'Stop activity, menyampaikan kepada tim CRW untuk mengadakan grounding', 10024760, '', '11.jpg', 0, '2024-02-19 00:00:00', 'Open', 'Planed'),
(43, '2024-01-19 04:09:00', 'Teso', 'West', 'CRW', 'CRW', 'Operational Fuel Station', 'PT. RAPP', 'Edy Suprayitno', '4 dati 4 lampu di area tangki solar rusak', 'HPI', 'Engineering', 'Natalis', 'Stop activity, menyampaikan kepada tim CRW untuk memperbaiki lampu. Pekerja bekerja pada malam hari mengecek tangki kurangan pencahayaan', 10024760, '', '22.jpg', 0, '2024-02-26 00:00:00', 'Open', 'Unplaned'),
(44, '2024-02-12 12:00:00', 'Logas', 'West', 'Post TUK', 'Harvesting', 'Operational TUK', 'PT. RAPP', 'Edy Suprayitno', 'Ex. Mobile container post TUK miring. Di dalam container ada activitas seperti masak', 'HPI', 'Engineering', 'Charles', 'Stop activity, menyampaikan ke pihak estate untuk memperbaiki kondisi container atau memindahkan ke posisi yang aman. Catatan : Pernah terjadi pekerja tertimpa kontainer di Estate Nagodang', 10024760, '', 'foto_rumah.jpg', 0, '2024-02-19 00:00:00', 'Open', 'Planed');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'admin ganteng', 'admin@gmail.com', 'default.jpg', '$2y$10$aXlqjgD.ZPj.G3oxLENUbuVsWxP7NPVTRmTIe7HyGm8Gc68XVRrjy', 1, 1, 1700670955),
(6, 'daman hurie', 'daman@gmail.com', 'default.jpg', '$2y$10$WM.W7BE12F1opLA4ofwepuLHBE/oZ8vxyF0j68uKYKed.uSScJQ3u', 1, 1, 1701752242),
(7, 'nisol', 'nisol@gmail.com', 'default.jpg', '$2y$10$a43sZzdzG/Vs.Dc2aQLZOe9eKIkiqB7JJu6IGAGCiARyw4Ti/9/wW', 1, 1, 1702146628),
(8, 'ridho', 'ridho@gmail.com', 'default.jpg', '$2y$10$s0Pf4AkNrVK42Inb.I.sSeGcze60bCd15qBXO4fTynbaTIxA8LCTW', 2, 1, 1702148353),
(10, 'adminnn', 'adminnn@gmail.com', 'default.jpg', '$2y$10$QCgiEMLwiE9CkH0BlZXAMeatCzniNh1TUalFl8pOetKxlh0q/m/Gu', 2, 1, 1702516436),
(13, 'kevinn', 'kevinn@gmail.com', 'default.jpg', '$2y$10$keZR05nvm.sSfJEF8OMmDeZER2j6NxqPtaslN67vBQ.pxi/fHCYO6', 2, 1, 1704327152),
(14, 'adasd', 'asdasd@gmail.com', '', '', 1, 0, 0),
(15, 'jyf', 'hfdyf@gmail.com', '', '', 1, 0, 0),
(16, 'komi', 'komi@gmail.com', 'default.jpg', '$2y$10$joMfTB8nlqupyZQGp1MsfuxDtB4pIphlbyGuq8HmE1jz.EOLn3bZq', 3, 1, 1704730115),
(17, 'anisa', 'anisa@gmail.com', 'default.jpg', '$2y$10$ICVLTKgFK/1EgDEh8lATEuhtqXMyGb4W3pBoS2uyYXDoKdvfhstgy', 3, 1, 1704733180),
(18, 'Annisa', 'Annisa@gmail.com', 'default.jpg', '$2y$10$4U2gR9ZgdYL3HhysEIunb.7hyKNdQl/K54P1yO4jggYbZkaQlum86', 2, 1, 1704769295),
(19, 'iphone', 'iphone@gmail.com', 'default.jpg', '$2y$10$TVHRTLu8iXXK10hjs2OenemDQIhTYAr4hZCR5KqNRJX4HqCBmk5Xy', 2, 1, 1706174240),
(20, 'ibuk', 'ibuk@gmail.com', 'default.jpg', '$2y$10$FJuVLNkLqN8Aq0Xx12sJVe4gH2HmMx4rtlFwCoOVyEQR1SbdZIfsG', 2, 1, 1706211274),
(21, 'as', 'as@gmail.com', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
