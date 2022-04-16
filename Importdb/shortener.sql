-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 09:28 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `url` varchar(1000) COLLATE utf8_persian_ci NOT NULL,
  `code` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `code`, `user_id`, `created_at`) VALUES
(1, 'https://instagram.com/', '34568583', 1, '2022-04-16 07:26:37'),
(2, 'https://www.google.com/', '1447e24b', 1, '2022-04-16 07:26:47'),
(3, 'https://www.youtube.com/', '231229fb', 1, '2022-04-16 07:26:55'),
(4, 'https://github.com/', '1f190ec2', 1, '2022-04-16 07:27:02'),
(5, 'https://www.mongodb.com/', 'ff50e846', 1, '2022-04-16 07:27:30'),
(6, 'https://nodejs.org/', '88158158', 1, '2022-04-16 07:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `passcode` text COLLATE utf8_persian_ci NOT NULL,
  `token` text COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passcode`, `token`) VALUES
(1, 'admin', '$2y$10$v5XTXNtHt4O9d6p9gRMgg.NZdQwZlWz4.fj9/ZLDpxuuXqYUYkG2W', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluIn0Sx5H_i07Kl5IbZubOZq0ak22JyLcH1L8SlIT9e1n350');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
