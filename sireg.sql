-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2018 at 05:38 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(5, 7, 'F1E115023', 'dimana');

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
(7, 21, 'aha');

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
(67, 'F1E115001', 22),
(71, 'F1E115017', 22),
(72, 'F1E115017', 23),
(73, 'F1E115001', 23),
(74, 'F1E115017', 24),
(91, 'F1E115001', 21),
(92, 'F1E115023', 21);

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
(1, 'admin', '$2y$10$mW/zUYfMX8g2lcPUblAiquPGPHwgOe9NEbHVH8a0KbxbPys4WqcmC', 1, '', '', '', '', '2018-03-07 09:15:47', 2),
(9, 'perpus', '$2y$10$sGZYiR/a02KONW7OTpyEGOSYyEZJhLfB4t3aoK5qXcJPxWmBYVp12', 0, 'Perpustakaan', 'F1E115017', '081234567890', 'perpus@univ.ac.id', '2018-03-07 09:38:40', 2),
(12, 'proyektor', '$2y$10$lXzoGjBJl9Mhsu9pG97tEuUIf/yenHYAxQqTt20s97pglJv/Q2TQS', 0, 'Proyektor FST', 'F1E115017', '081234567890', 'proyektor@univ.ac.id', '2018-03-08 08:52:56', 2),
(13, 'alfa', '$2y$10$W5Yvw48rvjpO2mzqdxBCWONgGs/P8SwLqFGopUY/QkEmbZ3YvBWhK', 0, 'Alfamart Genk', 'F1E115017', '081234567890', 'alfa@gmail.com', '2018-03-14 07:41:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` tinyint(4) NOT NULL,
  `id_organization` tinyint(4) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privacy` tinyint(1) NOT NULL,
  `verify` int(11) NOT NULL,
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `id_organization`, `title`, `description`, `date`, `privacy`, `verify`, `url`) VALUES
(21, 9, 'Anggota 2018', 'Pendaftaran Anggota Perpustakaan 2018', '2018-03-07 10:20:27', 1, 1, ''),
(22, 12, 'Peminjaman 2018', 'Daftar Peminjam Proyektor FST 2018', '2018-03-08 08:54:11', 0, 0, '3AT2lx3vKPUa1ZEzWioQxlk2ahmGKesFou_FVvSUOcwCTrwtxWKW971G3ZG3k-C9L2TkMPH_YNulW_D3K_z5Pg'),
(23, 13, 'Anggota Elit', 'Daftar anggota elit pasukan khusus setia (KETUA ELIT)', '2018-03-14 07:50:08', 0, 0, NULL),
(24, 13, 'Daftar Piket', 'Daftar Piket setiap anggota yang harus membersihkan alfamart', '2018-03-19 07:08:51', 1, 0, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `additional_registration`
--
ALTER TABLE `additional_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
