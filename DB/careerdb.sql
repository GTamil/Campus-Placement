-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 12:34 PM
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
-- Database: `careerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobapplication`
--

CREATE TABLE `jobapplication` (
  `applid` int(11) NOT NULL,
  `userid` int(10) NOT NULL,
  `postid` int(10) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rollno` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `per` varchar(10) NOT NULL,
  `file_path1` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruiterform`
--

CREATE TABLE `recruiterform` (
  `userid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `cemail` varchar(30) NOT NULL,
  `cweb` varchar(30) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `hrname` varchar(30) NOT NULL,
  `hremail` varchar(30) NOT NULL,
  `hrphone` varchar(10) NOT NULL,
  `photo_path1` varchar(255) NOT NULL,
  `photo_path2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruiterlogin`
--

CREATE TABLE `recruiterlogin` (
  `userid` int(10) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `cemail` varchar(30) NOT NULL,
  `cphone` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruiterpost`
--

CREATE TABLE `recruiterpost` (
  `username` varchar(30) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `userid` int(10) NOT NULL,
  `postid` int(10) NOT NULL,
  `stream` varchar(30) NOT NULL,
  `yop` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `form` varchar(10) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `insert_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffform`
--

CREATE TABLE `staffform` (
  `userid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `idnum` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(5) NOT NULL,
  `stype` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `staff` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `photo_path1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stafflogin`
--

CREATE TABLE `stafflogin` (
  `userid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `idnum` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `stype` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `staff` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffpost`
--

CREATE TABLE `staffpost` (
  `idnum` int(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `postid` int(11) NOT NULL,
  `stream` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `insert_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `name` varchar(20) NOT NULL,
  `rollno` int(10) NOT NULL,
  `yop` int(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentpgform`
--

CREATE TABLE `studentpgform` (
  `name` varchar(20) NOT NULL,
  `rollno` int(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `peradd` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `school1` varchar(30) NOT NULL,
  `school2` varchar(30) NOT NULL,
  `college` varchar(30) NOT NULL,
  `tenth` varchar(5) NOT NULL,
  `twelveth` varchar(5) NOT NULL,
  `ug` varchar(10) NOT NULL,
  `pg` varchar(10) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `file_path1` varchar(255) NOT NULL,
  `file_path2` varchar(255) NOT NULL,
  `file_path3` varchar(255) NOT NULL,
  `file_path4` varchar(255) NOT NULL,
  `file_path5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentugform`
--

CREATE TABLE `studentugform` (
  `name` varchar(20) NOT NULL,
  `rollno` int(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `peradd` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `course` varchar(10) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `school1` varchar(30) NOT NULL,
  `school2` varchar(30) NOT NULL,
  `tenth` varchar(5) NOT NULL,
  `twelveth` varchar(5) NOT NULL,
  `ug` varchar(10) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `file_path1` varchar(255) NOT NULL,
  `file_path2` varchar(255) NOT NULL,
  `file_path3` varchar(255) NOT NULL,
  `file_path4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobapplication`
--
ALTER TABLE `jobapplication`
  ADD PRIMARY KEY (`applid`);

--
-- Indexes for table `recruiterform`
--
ALTER TABLE `recruiterform`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `recruiterlogin`
--
ALTER TABLE `recruiterlogin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `recruiterpost`
--
ALTER TABLE `recruiterpost`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `staffform`
--
ALTER TABLE `staffform`
  ADD PRIMARY KEY (`idnum`);

--
-- Indexes for table `stafflogin`
--
ALTER TABLE `stafflogin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `staffpost`
--
ALTER TABLE `staffpost`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`rollno`);

--
-- Indexes for table `studentpgform`
--
ALTER TABLE `studentpgform`
  ADD PRIMARY KEY (`rollno`);

--
-- Indexes for table `studentugform`
--
ALTER TABLE `studentugform`
  ADD PRIMARY KEY (`rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobapplication`
--
ALTER TABLE `jobapplication`
  MODIFY `applid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruiterlogin`
--
ALTER TABLE `recruiterlogin`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruiterpost`
--
ALTER TABLE `recruiterpost`
  MODIFY `postid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stafflogin`
--
ALTER TABLE `stafflogin`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffpost`
--
ALTER TABLE `staffpost`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
