-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2018 at 09:42 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sireg`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_member`
--

CREATE TABLE `additional_member` (
  `id` int(11) NOT NULL,
  `id_additional` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_member`
--

INSERT INTO `additional_member` (`id`, `id_additional`, `nim`, `value`) VALUES
(3, 6, 'F1E115001', 'apa'),
(4, 6, 'F1E115001', 'yaya'),
(5, 7, 'F1E115023', 'dimana'),
(6, 11, 'F1E115017', 'foo'),
(7, 12, 'F1E115017', 'bar'),
(8, 13, 'F1E115001', 'noting'),
(9, 14, 'F1E115001', 'kepo');

-- --------------------------------------------------------

--
-- Table structure for table `additional_registration`
--

CREATE TABLE `additional_registration` (
  `id` int(11) NOT NULL,
  `id_registration` tinyint(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_registration`
--

INSERT INTO `additional_registration` (`id`, `id_registration`, `description`) VALUES
(5, 23, 'kok lebar'),
(6, 21, 'apa gitu'),
(7, 21, 'aha'),
(9, 22, 'aoa'),
(10, 26, 'Tipe NEN'),
(11, 28, 'Additional data'),
(12, 28, 'another additional data'),
(13, 25, 'alasan anda'),
(14, 25, 'hobi');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(7) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `id_registration` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `nim`, `id_registration`) VALUES
(72, 'F1E115017', 23),
(73, 'F1E115001', 23),
(74, 'F1E115017', 24),
(91, 'F1E115001', 21),
(92, 'F1E115023', 21),
(96, 'F1E115017', 21),
(100, 'F1E115001', 25),
(102, 'F1E115006', 21),
(104, 'F1E115006', 36),
(108, 'F1E115001', 36),
(109, 'F1E115031', 36),
(110, 'F1E115017', 36),
(120, 'F1E115006', 28);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` tinyint(4) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `name` varchar(60) NOT NULL,
  `nim` varchar(18) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verify` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `username`, `password`, `role`, `name`, `nim`, `phone`, `email`, `date`, `verify`) VALUES
(1, 'admin', '$2y$10$mW/zUYfMX8g2lcPUblAiquPGPHwgOe9NEbHVH8a0KbxbPys4WqcmC', 1, '', '', '', '', '2018-03-07 02:15:47', 2),
(9, 'perpus', '$2y$10$sGZYiR/a02KONW7OTpyEGOSYyEZJhLfB4t3aoK5qXcJPxWmBYVp12', 0, 'Perpustakaan', 'F1E115017', '081234567890', 'perpus@univ.ac.id', '2018-03-07 02:38:40', 2),
(12, 'proyektor', '$2y$10$lXzoGjBJl9Mhsu9pG97tEuUIf/yenHYAxQqTt20s97pglJv/Q2TQS', 0, 'Proyektor FST', 'F1E115017', '081234567890', 'proyektor@univ.ac.id', '2018-03-08 01:52:56', 2),
(13, 'alfa', '$2y$10$W5Yvw48rvjpO2mzqdxBCWONgGs/P8SwLqFGopUY/QkEmbZ3YvBWhK', 0, 'Alfamart Genk', 'F1E115017', '081234567890', 'alfa@gmail.com', '2018-03-14 00:41:07', 1),
(19, 'miku', '$2y$10$.Cp7kaM7i7viw1k/WgKoeO8fMpvQY8VPeOscl/KvATHMmZLNKiVVq', 0, 'Miku Fanclub', 'F1E115017', '0822', 'miku@miku', '2018-05-01 01:44:20', 2),
(20, 'Exist', '$2y$10$CiIZp8d8kfPiSGBa1wnkjeZfg8VKBGZ14Qeg1UV.FqaS6oFfQ20aC', 0, 'Exist RnP', 'F1E115001', '085367882865', 'exist@gmail.com', '2018-05-01 09:44:36', 2),
(22, 'Existr', '$2y$10$D6oGoFGUC9q4yE6CyBzOhu.O19IdeFlth.dGbDMQ/QenT.sGSJ9hm', 0, 'Exist RnP', 'yghnvvvvbb b', '0987654321', 'lkjhmgnvgbcvx@jnmghvb', '2018-05-01 10:42:09', 0),
(23, 'lenovo', '$2y$10$3MHibV20jwm/2HvpCGw3Queatex8HQ.bsX3y9EfIw1Mn8NLCYrIn.', 0, 'LENOVO', 'F1E115001', '098897890897', 'lenovo@gmail.com', '2018-05-03 04:01:10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` tinyint(4) NOT NULL,
  `id_organization` tinyint(4) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `max_peserta` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `verify` tinyint(1) NOT NULL,
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `id_organization`, `title`, `description`, `max_peserta`, `start_date`, `end_date`, `privacy`, `verify`, `url`) VALUES
(21, 9, 'Anggota 2018', 'Pendaftaran Anggota Perpustakaan 2018', 0, '2018-03-08', '2018-09-20', 0, 1, ''),
(22, 12, 'Peminjaman 2018', 'Daftar Peminjam Proyektor FST 2018', 0, '2018-03-08', '2018-04-30', 0, 0, '3AT2lx3vKPUa1ZEzWioQxlk2ahmGKesFou_FVvSUOcwCTrwtxWKW971G3ZG3k-C9L2TkMPH_YNulW_D3K_z5Pg'),
(23, 13, 'Anggota Elit', 'Daftar anggota elit pasukan khusus setia (KETUA ELIT)', 0, '2018-04-29', '2018-04-30', 0, 0, NULL),
(24, 13, 'Daftar Piket', 'Daftar Piket setiap anggota yang harus membersihkan alfamart', 0, '2018-03-19', '2018-03-19', 1, 0, NULL),
(25, 9, 'Anggota Sub', 'Orang - orang lemah', 0, '2018-02-01', '2018-05-02', 0, 0, NULL),
(26, 9, 'ANGGOTA Pro (NEN Expert Only)', 'Ini dia yang gue cari', 0, '2018-04-27', '2018-04-30', 1, 0, NULL),
(28, 19, 'Gathering', 'lorem ipsum dolor sit amet', 1, '2018-05-01', '2018-05-05', 1, 1, NULL),
(33, 20, 'Exist Fair 2018', 'jdekdnejdejmvgjjvn', 0, '2018-05-02', '2018-07-13', 0, 0, NULL),
(36, 23, 'lenov fair', 'hei', 2, '2018-05-03', '2018-05-05', 0, 0, NULL),
(38, 9, 'Orang Dalam', 'Pelicin dulu mas', 2, '2018-05-04', '2018-05-06', 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_member`
--
ALTER TABLE `additional_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_manyToMany` (`nim`),
  ADD KEY `additional_data` (`id_additional`);

--
-- Indexes for table `additional_registration`
--
ALTER TABLE `additional_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_parent` (`id_registration`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_relation` (`id_registration`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_relation` (`id_organization`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_member`
--
ALTER TABLE `additional_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `additional_registration`
--
ALTER TABLE `additional_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_member`
--
ALTER TABLE `additional_member`
  ADD CONSTRAINT `additional_data` FOREIGN KEY (`id_additional`) REFERENCES `additional_registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `additional_registration`
--
ALTER TABLE `additional_registration`
  ADD CONSTRAINT `registration_parent` FOREIGN KEY (`id_registration`) REFERENCES `registrations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `registration_relation` FOREIGN KEY (`id_registration`) REFERENCES `registrations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `organization_relation` FOREIGN KEY (`id_organization`) REFERENCES `organizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
