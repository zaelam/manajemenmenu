-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2022 at 06:05 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemenmenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `relasi_menu`
--

CREATE TABLE `relasi_menu` (
  `id_relasi_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relasi_menu`
--

INSERT INTO `relasi_menu` (`id_relasi_menu`, `id_user`, `id_menu`) VALUES
(2, 1, 2),
(3, 1, 3),
(14, 1, 1),
(15, 2, 1),
(16, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_token`
--

CREATE TABLE `t_token` (
  `id_token` int(11) NOT NULL,
  `email` int(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_token`
--

INSERT INTO `t_token` (`id_token`, `email`, `token`, `date_created`) VALUES
(1, 0, '123456789!23fuIyGtFggHJIO09', '2022-04-04 17:00:00'),
(2, 0, '123456789!23fuIyGtFggHJIO09', '2022-04-04 17:00:00'),
(3, 0, '123456789!23fuIyGtFggHJIO09', '2022-04-04 17:00:00'),
(4, 0, '123456789!23fuIyGtFggHJIO09', '2022-04-04 17:00:00'),
(5, 0, '123456789!23fuIyGtFggHJIO09', '2022-04-04 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '0',
  `ps_kode` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `password`, `ps_kode`, `nama_user`, `email`, `created_at`) VALUES
(1, '$2y$10$.LTmbvkFoelKpOxcThwKxO15/ws3oz0T3VqdoVXuow3/nUBp5oDsS', '', 'zaela', 'zaela13579@gmail.com', '2022-04-05 07:05:14'),
(2, '$2y$10$AkGgS8.CeLy42nx0OENbr.bsZCyt8rwIUwbbVcP6Qrex9TY181Ryu', '8o76G5rv', 'agus', 'bitcasestudio@gmail.com', '2022-04-05 09:50:06'),
(5, '$2y$10$jqUA7lP2RTOQVnZq0RQbYOncBRmjSy15Acvb8.nSWWgMLxgh7cpFO', 'EPUN6alG', 'jujun', 'ajabeli775@gmail.com', '2022-04-05 23:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `link`) VALUES
(1, 'home', '/home'),
(2, 'user', '/user'),
(3, 'menu', '/menu'),
(6, 'pesanan', '/pesanan'),
(8, '', ''),
(9, 'pesanan baru', '/pesananbaru');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `sub_menu` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `sub_menu`, `link`) VALUES
(1, 3, 'submenu', '/menu/submenu'),
(2, 3, 'edit sub menu', '/menu/editSubMenu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relasi_menu`
--
ALTER TABLE `relasi_menu`
  ADD PRIMARY KEY (`id_relasi_menu`);

--
-- Indexes for table `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relasi_menu`
--
ALTER TABLE `relasi_menu`
  MODIFY `id_relasi_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_token`
--
ALTER TABLE `t_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
