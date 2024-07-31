-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 04:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cid` int(11) NOT NULL,
  `cname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `cname`) VALUES
(1, 'General Arts'),
(2, 'Home Economics'),
(3, 'Agriculture');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lid` int(11) NOT NULL,
  `sjid` int(11) DEFAULT NULL,
  `ltitle` varchar(100) DEFAULT NULL,
  `ltype` enum('video','PDF','docx') DEFAULT NULL,
  `lcontent` text DEFAULT NULL,
  `lform` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lid`, `sjid`, `ltitle`, `ltype`, `lcontent`, `lform`) VALUES
(1, 1, 'Algebraic', 'video', 'assets/lessons/66a648fedfaaa.mp4', 2),
(2, 1, 'Sets', 'PDF', 'assets/lessons/66a6495d28b9a.pdf', 1),
(3, 6, 'chapter 1: introduction to biology', 'video', 'assets/lessons/66aa439b0967b.mp4', 1),
(4, 6, 'Human Production', 'video', 'assets/lessons/66aa440069f85.mp4', 1),
(5, 6, 'Cells', 'PDF', 'assets/lessons/66aa44204c1d5.pdf', 1),
(6, 6, 'Mitochondria', 'PDF', 'assets/lessons/66aa448297dcf.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `stid` int(11) NOT NULL,
  `stfname` varchar(20) DEFAULT NULL,
  `stlname` varchar(20) DEFAULT NULL,
  `stemail` varchar(255) DEFAULT NULL,
  `stpassword` text DEFAULT NULL,
  `sjid` int(11) DEFAULT NULL,
  `strole` enum('admin','teacher') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`stid`, `stfname`, `stlname`, `stemail`, `stpassword`, `sjid`, `strole`) VALUES
(1, 'Khadija', 'Yakubu', 'yakubu@gmail.com', '$2y$10$Ka0FMXb2DIintJv.85uBu.aI2bdOP/fbPie/j.b4fE5n2ZcNgKCh6', 1, 'teacher'),
(8, 'Teacher', 'First', 'teacher1@gmail.com', '$2y$10$Ka0FMXb2DIintJv.85uBu.aI2bdOP/fbPie/j.b4fE5n2ZcNgKCh6', 2, 'teacher'),
(10, 'Admin', 'First', 'admin@gmail.com', '$2y$10$W6wzLczy2lwTI4r27pCyW.2vFjzEnvphlJPVUkX6JD7ZxG5TuhCKG', 0, 'admin'),
(11, 'Kudus', 'Mohammed', 'kudus@gmail.com', '$2y$10$Ka0FMXb2DIintJv.85uBu.aI2bdOP/fbPie/j.b4fE5n2ZcNgKCh6', 3, 'teacher'),
(12, 'Teacher', 'Second', 'teacher2@gmail.com', '$2y$10$mmEZv9LoVhD3UC4yIHPXUODQQj7uZkRAMG6XtLLDrKYqwfjkK2qPm', 6, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sid` int(11) NOT NULL,
  `sfname` varchar(20) DEFAULT NULL,
  `slname` varchar(20) DEFAULT NULL,
  `semail` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `form` int(11) DEFAULT NULL,
  `spassword` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `sfname`, `slname`, `semail`, `cid`, `form`, `spassword`) VALUES
(1, 'Luckman', 'Issahaku', 'lukman@gmail.com', 2, 2, '$2y$10$OXPjILl9Hqb3KDpBIbGFdeK/268h/D1JS3I1IG10iDbAzqQR9e2oK'),
(2, 'Ama', 'Ami', 'ama@gmail.com', 1, 1, '$2y$10$nvdy5ggQMO.ojG6g2bdSSetKqiPOWpj.3R0660ISA5lNZitQIF3ve'),
(3, 'Student', 'First', 'student@gmail.com', 3, 2, '$2y$10$YgpM0obHGqsRRMgmCG7qkuIwW6jivV5WZ7PplFcIzOApAg6KrQHFu');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sjid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `sjname` varchar(100) DEFAULT NULL,
  `type` enum('core','elective') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sjid`, `cid`, `sjname`, `type`) VALUES
(1, NULL, 'Mathematics', 'core'),
(2, 1, 'Geography', 'elective'),
(3, NULL, 'English Language', 'core'),
(4, NULL, 'Integrated Science', 'core'),
(5, 1, 'History', 'elective'),
(6, 3, 'Biology', 'elective'),
(7, 3, 'Introduction To Agric', 'elective'),
(8, NULL, 'Social Studies', 'core'),
(9, 3, 'Animal Husbandry', 'elective');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `sjid` (`sjid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`stid`),
  ADD KEY `sjid` (`sjid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sjid`),
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sjid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`sjid`) REFERENCES `subjects` (`sjid`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
