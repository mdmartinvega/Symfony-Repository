-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2021 at 01:42 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazing_employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email`, `roles`, `password`, `token`, `token_expiration`) VALUES
(1, 'userLoli@correo.com', '[]', '$2y$13$6fqakhEXU/oa/JEoUUTyleZyjoL73BnjH3UQ9EW2t/WrQQCKrpsIu', '424e433511ab9e5fde2ee3a305294a5e67531447', '2021-06-22 11:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Departamento por asignar'),
(2, 'Desarrollo');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210615114028', '2021-06-15 13:47:18', 106),
('DoctrineMigrations\\Version20210615115821', '2021-06-15 14:00:02', 57),
('DoctrineMigrations\\Version20210617110349', '2021-06-17 13:08:34', 57),
('DoctrineMigrations\\Version20210617113851', '2021-06-17 13:53:37', 375),
('DoctrineMigrations\\Version20210618080854', '2021-06-18 10:15:43', 209),
('DoctrineMigrations\\Version20210621074240', '2021-06-21 09:43:27', 84),
('DoctrineMigrations\\Version20210621103007', '2021-06-21 12:32:07', 52),
('DoctrineMigrations\\Version20210622074813', '2021-06-22 09:48:19', 53);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` smallint NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `age`, `city`, `phone`, `department_id`, `avatar`) VALUES
(1, 'Carlos', 'carlos@correo.com', 30, 'Benalmádena', '654123789', 1, NULL),
(2, 'Carmen', 'carmen@correo.com', 25, 'Fuengirola', '654123568', 1, NULL),
(3, 'Karel', 'karel@correo.com', 40, 'Algete', '678658896', 2, NULL),
(4, 'Carolina ', 'carolina@correo.com ', 38, 'Málaga', ' 698451235 ', 1, NULL),
(5, 'Loli', 'loli@correo.com', 38, 'Madrid', '658789456', 1, NULL),
(6, 'Luis', 'luis@correo.com', 37, 'Málaga', '623123456', 1, NULL),
(7, 'Cristina', 'cris@correo.com', 39, 'Galapagar', '625683456', 1, NULL),
(12, 'Laura', 'laura@correo.com', 43, 'Barcelona', '678456896', 1, NULL),
(14, 'Nieves', 'niebs@correo.com', 37, 'Cabanillas', '652123478', 2, 'index-60d050802b2c2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`) VALUES
(1, 'Proyecto Molón'),
(2, 'Proyecto Marrón'),
(3, 'Proyecto Boomerang'),
(4, 'Proyecto No quiero tocarlo ni con un palo');

-- --------------------------------------------------------

--
-- Table structure for table `project_employee`
--

CREATE TABLE `project_employee` (
  `project_id` int NOT NULL,
  `employee_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_employee`
--

INSERT INTO `project_employee` (`project_id`, `employee_id`) VALUES
(1, 6),
(2, 3),
(2, 4),
(2, 7),
(3, 1),
(3, 12),
(4, 5),
(4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_AD8A54A9E7927C74` (`email`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5D9F75A1E7927C74` (`email`),
  ADD KEY `IDX_5D9F75A1AE80F5DF` (`department_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_employee`
--
ALTER TABLE `project_employee`
  ADD PRIMARY KEY (`project_id`,`employee_id`),
  ADD KEY `IDX_60D1FE7A166D1F9C` (`project_id`),
  ADD KEY `IDX_60D1FE7A8C03F15C` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_5D9F75A1AE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `project_employee`
--
ALTER TABLE `project_employee`
  ADD CONSTRAINT `FK_60D1FE7A166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_60D1FE7A8C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
