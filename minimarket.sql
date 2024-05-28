-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 04:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adm-id` int(3) NOT NULL,
  `adm-name` varchar(255) NOT NULL,
  `adm-pass` varchar(255) NOT NULL,
  `adm-status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adm-id`, `adm-name`, `adm-pass`, `adm-status`) VALUES
(1, 'Candra', '$2y$10$vTyy1f.MrnFkLjT1afLWdecUgAM20RPdsULz2CWKGtyaEGDsRAWVO', 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat-id` int(3) NOT NULL,
  `cat-name` varchar(255) NOT NULL,
  `cat-icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat-id`, `cat-name`, `cat-icon`) VALUES
(1, 'Makanan', 'bi bi-egg-fried');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord-id` int(4) NOT NULL,
  `ord-title` varchar(255) NOT NULL,
  `ord-qty` int(3) NOT NULL,
  `ord-username` varchar(255) NOT NULL,
  `ord-adress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `prd-nama` varchar(255) NOT NULL,
  `prd-harga` int(20) NOT NULL,
  `prd-kategori` varchar(255) NOT NULL,
  `prd-thumb` varchar(255) NOT NULL,
  `prd-details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prd-nama`, `prd-harga`, `prd-kategori`, `prd-thumb`, `prd-details`) VALUES
(1, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(8, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(9, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(10, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(11, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(12, 'Roti Tawar', 45000, 'Makanan', '20117083_thumb.jpg', ''),
(15, 'Roti O', 3333, 'Makanan', '66544f9309e2d.png', 'tes'),
(16, 'Roti Tawar', 45000, 'Makanan', '66544fbbc51d3.png', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(3, 'candra', '$2y$10$.Tsyxj6v./KUQETKh/8djOg1m3RmQUP100CGB787yx.scGqLOO.HG', ''),
(4, 'jamal', '$2y$10$8gTsgD7dN1aZorVkb1Ha.eRehrx.c/dR8V/94i1pjd6VGMmnS1noK', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adm-id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat-id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord-id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adm-id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat-id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord-id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
