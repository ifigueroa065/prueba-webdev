-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 12:52 AM
-- Server version: 8.0.34
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_clubpremier`
--

-- --------------------------------------------------------

--
-- Table structure for table `registros`
--

CREATE TABLE `registros` (
  `id` int NOT NULL,
  `fecha_dia` date DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `fecha_primaria` date DEFAULT NULL,
  `fecha_secundaria` date DEFAULT NULL
) ;

--
-- Dumping data for table `registros`
--

INSERT INTO `registros` (`id`, `fecha_dia`, `nombre`, `edad`, `fecha_primaria`, `fecha_secundaria`) VALUES
(6, '2023-09-13', 'PEDRO', 35, '2007-06-16', '2011-02-11'),
(7, '2023-09-14', 'DARLENY', 36, '2015-06-13', '2023-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `contrasena_md5` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena_md5`) VALUES
(1, 'ifigueroa', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'admin1', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
