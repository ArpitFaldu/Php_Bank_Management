-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 10:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users1`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `srno` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `mpin` int(6) NOT NULL,
  `birthdate` varchar(12) NOT NULL,
  `balance` bigint(10) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`srno`, `username`, `password`, `fname`, `mname`, `lname`, `mpin`, `birthdate`, `balance`, `mobile`) VALUES
(1, 'Smeet', 'Smeet@3525', 'Haraniya', 'Smeet', 'Niteshbhai', 123456, '2000-05-03', 0, ''),
(2, 's', 'Abcd@1234', 'a', 'b', 'c', 654321, '1950-05-05', NULL, ''),
(3, 'msd', 'Msd@77777', 'mahendra', 'singh', 'dhoni', 123456, '2000-07-07', 30000, '9746345489'),
(5, '', '', '', '', '', 0, '', 5000, ''),
(6, '', '', '', '', '', 0, '', 255000, ''),
(7, '', '', '', '', '', 0, '', 755000, ''),
(8, 'akf', 'Akf@20044', 'Arpit', 'Kirtibhai', 'Faldu', 111111, '2004-09-30', 10000, '9999999999'),
(9, 'kanji', 'Kanji#12345', 'Kanji', 'N', 'madariya', 0, '2004-07-15', 40000, '9999999999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `srno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
