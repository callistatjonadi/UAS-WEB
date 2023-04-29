-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2023 at 09:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studee`
--

-- --------------------------------------------------------

--
-- Table structure for table `listsaya`
--

CREATE TABLE `listsaya` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `listsaya`
--

INSERT INTO `listsaya` (`id`, `user_id`, `video_id`, `created_date`) VALUES
(80, 29, 59, '2023-04-14'),
(86, 32, 59, '2023-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `nama`, `username`, `email`, `password`, `profile`, `role`) VALUES
(29, 'Callista Tjonadi', 'callistatj', 'tjonadicallista@gmail.com', '12345', 'profile.png', 'student'),
(32, 'Vellyn', 'vellynnatali', 'vellyn@gmail.com', '12345', 'profil.jpg', 'student'),
(34, 'khellyn', 'khellun', 'khellyn@gmail.com', '12345', 'profil.jpg', 'student'),
(38, 'admin', 'admin', 'admin@gmail.com', '12345', 'profile.png', 'admin'),
(39, 'Vanesia Roselin', 'vanesia', 'vanesia@gmail.com', '12345', 'profile.png', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `id` int(11) NOT NULL,
  `nama_topik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`id`, `nama_topik`) VALUES
(1, 'Akademis'),
(2, 'Akuntansi'),
(3, 'Bisnis'),
(4, 'Desain'),
(5, 'Komputer'),
(6, 'Marketing'),
(7, 'Musik'),
(8, 'Sains'),
(9, 'Videografi'),
(28, 'Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `video` varchar(100) NOT NULL,
  `created_date` int(11) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `user_id`, `judul`, `deskripsi`, `kategori`, `thumbnail`, `video`, `created_date`, `status`) VALUES
(59, 29, 'Cara Membuat Lagu Untuk Pemula', 'Jika ingin membuat lagu yang bagus, nonton video ini!', '7', 'MjUzMzcyNTg4.jpg', 'video2.mp4', 2147483647, 'terima'),
(60, 34, 'Belajar desain ', 'Ayo belajar desain', '4', 'design.jpg', 'videomusik.mp4', 2147483647, 'terima'),
(61, 32, 'Cara Membuat Video yang Keren', 'Bingung cara buat video kekinian? Tonton video ini!', '9', 'videografi.jpg', 'videomusik.mp4', 2147483647, 'terima'),
(62, 32, 'Belajar Membuat Website', 'Menggunakan HTML CSS JS', '5', 'thumb1.jpg', 'video1.mp4', 2147483647, 'pending'),
(63, 39, 'Yuk, Hidup Sehat', 'Ayo belajar mulai hidup sehat dari sekarang', '28', 'kesehatan.jpeg', 'videomusik.mp4', 2147483647, 'terima');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `video_id` int(50) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `video_id`, `created_date`) VALUES
(16, 29, 59, '2023-04-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listsaya`
--
ALTER TABLE `listsaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listsaya`
--
ALTER TABLE `listsaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `topik`
--
ALTER TABLE `topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
