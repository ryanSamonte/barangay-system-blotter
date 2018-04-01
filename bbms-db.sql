-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 12:05 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbms-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blotter_details`
--

CREATE TABLE `tbl_blotter_details` (
  `blotter_id` int(11) NOT NULL,
  `incident_place` varchar(50) DEFAULT NULL,
  `incident_details` varchar(500) DEFAULT NULL,
  `summon_date` varchar(20) DEFAULT NULL,
  `summon_time` varchar(20) DEFAULT NULL,
  `archive_status` int(11) DEFAULT NULL,
  `summon_count` int(11) NOT NULL,
  `isResolved` varchar(1) NOT NULL,
  `datetimestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blotter_details`
--

INSERT INTO `tbl_blotter_details` (`blotter_id`, `incident_place`, `incident_details`, `summon_date`, `summon_time`, `archive_status`, `summon_count`, `isResolved`, `datetimestamp`) VALUES
(1, 'San Rafael', 'sdjaksdasdhkajdhksa', '2018-04-16', '14:00', 0, 1, 'Y', '0000-00-00 00:00:00'),
(2, 'San Rafael', 'l;lgfggghjjlkgfdfg', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(3, 'P. Gabriel', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(4, 'M. De Vera', 'qwertyuiopasdfghjklmnbvcxzaasdfghjklpoiuytrewqasdfghjkmnbvcxzaqazwsxdedcfrfvbgtgbnhyhnyujmikko', '2018-05-10', '15:35', 0, 0, 'N', '0000-00-00 00:00:00'),
(5, 'P. De Vera', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(6, 'Pitong Gatang', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dicti', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(7, 'Pitong Gatang', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dicti', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(8, 'San Rafael', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dicti', '2018-03-31', '13:00', 0, 0, 'Y', '0000-00-00 00:00:00'),
(9, 'Bumbero', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dicti', '2018-09-05', '14:00', 0, 0, 'N', '0000-00-00 00:00:00'),
(10, 'M. De Vera', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(11, 'Gov. Pascual', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(12, 'San Rafael', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(13, '', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'N', '0000-00-00 00:00:00'),
(14, 'San Jose', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', 'N', 'N', 0, 0, 'Y', '0000-00-00 00:00:00'),
(15, 'San Jose', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-09-05', '16:01', 0, 0, 'Y', '0000-00-00 00:00:00'),
(16, 'Pitong Gatang', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-05', '15:00', 0, 0, 'Y', '0000-00-00 00:00:00'),
(17, 'Buraot', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-05', '12:59', 0, 0, 'Y', '0000-00-00 00:00:00'),
(18, 'M. De Vera', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-09', '14:00', 0, 0, 'Y', '0000-00-00 00:00:00'),
(19, 'Gov. Pascual', '', '2018-04-16', '17:00', 0, 2, 'Y', '0000-00-00 00:00:00'),
(20, 'Malabon', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-21', '15:00', 0, 1, 'Y', '0000-00-00 00:00:00'),
(21, 'M. Naval', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-11', '14:00', 0, 1, 'N', '2018-04-01 00:00:00'),
(22, 'Pitong Gatang', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-11', '11:59', 0, 1, 'N', '2018-04-01 23:57:09'),
(23, 'Caloocan', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bono', '2018-04-04', '14:00', 0, 1, 'N', '2018-04-02 02:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complainant`
--

CREATE TABLE `tbl_complainant` (
  `complainant_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contactnum` int(11) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `housenum` int(11) DEFAULT NULL,
  `streetname` varchar(50) DEFAULT NULL,
  `blotter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_complainant`
--

INSERT INTO `tbl_complainant` (`complainant_id`, `resident_id`, `lastname`, `firstname`, `middlename`, `gender`, `age`, `contactnum`, `occupation`, `housenum`, `streetname`, `blotter_id`) VALUES
(1, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 4),
(6, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 4),
(8, 0, 'Yap', 'James', 'Carlos', 'M', 18, 2147483647, 'Guard', 47, 'San Jose', 4),
(9, 0, 'Bryant', 'Kobe', 'Mamba', 'M', 38, 2147483647, 'Businessman', 101, 'San Roque', 5),
(10, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 5),
(11, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 6),
(12, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 7),
(13, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 8),
(14, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 9),
(15, 14, 'Caguioa', 'Mark', 'Spark', 'M', 41, 912345679, 'Basketball Player', 47, 'San Rafael', 15),
(16, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 16),
(17, 13, 'Samonte', 'Ryan', 'Ramirez', 'M', 18, 912345679, 'Student', 235, 'Gov. Pascual', 17),
(18, 14, 'Caguioa', 'Mark', 'Spark', 'M', 41, 912345679, 'Basketball Player', 47, 'San Rafael', 17),
(19, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 0),
(21, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 18),
(22, 0, 'Aquino', 'Bam', 'Boo', 'M', 47, 912345679, 'Senator', 20, 'Malabon City', 19),
(23, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 19),
(24, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 20),
(25, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 21),
(26, 13, 'Samonte', 'Ryan', 'Ramirez', 'M', 18, 912345679, 'Student', 235, 'Gov. Pascual', 22),
(27, 13, 'Samonte', 'Ryan', 'Ramirez', 'M', 18, 912345679, 'Student', 235, 'Gov. Pascual', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `contactnum` int(11) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `civilstatus` varchar(15) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `housenum` int(11) NOT NULL,
  `streetname` varchar(100) NOT NULL,
  `blotterrecords` int(11) NOT NULL,
  `archivestatus` varchar(1) NOT NULL,
  `residentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`lastname`, `firstname`, `middlename`, `gender`, `birthdate`, `age`, `contactnum`, `occupation`, `civilstatus`, `religion`, `housenum`, `streetname`, `blotterrecords`, `archivestatus`, `residentid`) VALUES
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1996-01-01', 22, 9123444, '', '', '', 235, 'Gov. Pascual', 6, '1', 7),
('Thompson', 'Scottie', 'Earl', 'M', '1996-01-01', 22, 947474747, 'Security Guard', 'Single', 'Roman Catholic', 6, 'San Rafael', 8, '1', 8),
('Samonte', 'Raymharc', 'Ramirez', 'M', '0000-00-00', 2017, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'Gov. Pascual', 0, '1', 9),
('Samonte', 'Raymharc', 'Ramirez', 'M', '0000-00-00', 16, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'Gov. Pascual', 0, '1', 10),
('Samonte', 'Raymharc', 'Ramirez', 'M', '2002-11-16', 16, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'Gov. Pascual', 4, '0', 11),
('Samonte', 'Ryan', 'Ramirez', 'M', '1999-06-01', 19, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'Gov. Pascual', 0, '1', 12),
('Samonte', 'Ryan', 'Ramirez', 'M', '1999-06-01', 18, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'Gov. Pascual', 0, '0', 13),
('Caguioa', 'Mark', 'Spark', 'M', '1977-03-30', 41, 912345679, 'Basketball Player', 'Single', 'Roman Catholic', 47, 'San Rafael', 2, '1', 14),
('Helterbrand', 'Jayjay', 'Fast', 'M', '1974-04-01', 43, 912345679, 'Basketball Player', 'Single', 'Roman Catholic', 13, 'P. Gabriel', 0, '1', 15),
('Helterbrand', 'Jayjay', 'Fast', 'M', '1974-04-02', 43, 912345679, 'Basketball Player', 'Single', 'Roman Catholic', 13, 'P. Gabriel', 3, '1', 16),
('Duterte', 'Rodrigo', 'Roa', 'M', '1955-01-04', 63, 912345679, 'President', 'Separated', 'Roman Catholic', 100, 'Lt. Santiago', 0, '0', 17),
('Silang', 'Gabriela', 'Hidalgo', 'F', '1990-04-04', 27, 912345679, 'Student', 'Married', 'Roman Catholic', 300, 'Buraot', 0, '0', 18),
('Yap', 'Jayjay', 'Carlos', 'M', '2018-04-03', 0, 912345679, 'Basketball Player', 'Single', 'Roman Catholic', 235, 'San Rafael', 0, '1', 19),
('Yap', 'Jayjay', 'Carlos', 'M', '2018-04-05', 0, 912345679, 'Student', 'Single', 'Roman Catholic', 235, 'San Rafael', 0, '1', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_respondent`
--

CREATE TABLE `tbl_respondent` (
  `respondent_id` int(11) NOT NULL,
  `resident_id` int(11) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contactnum` int(11) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `housenum` int(11) DEFAULT NULL,
  `streetname` varchar(50) DEFAULT NULL,
  `blotter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_respondent`
--

INSERT INTO `tbl_respondent` (`respondent_id`, `resident_id`, `lastname`, `firstname`, `middlename`, `gender`, `age`, `contactnum`, `occupation`, `housenum`, `streetname`, `blotter_id`) VALUES
(2, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 4),
(3, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 4),
(4, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 5),
(5, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 6),
(6, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 7),
(7, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 8),
(8, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 9),
(9, 16, 'Helterbrand', 'Jayjay', 'Fast', 'M', 43, 912345679, 'Basketball Player', 13, 'P. Gabriel', 15),
(10, 16, 'Helterbrand', 'Jayjay', 'Fast', 'M', 43, 912345679, 'Basketball Player', 13, 'P. Gabriel', 16),
(11, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 16),
(12, 11, 'Samonte', 'Raymharc', 'Ramirez', 'M', 16, 912345679, 'Student', 235, 'Gov. Pascual', 16),
(13, 14, 'Caguioa', 'Mark', 'Spark', 'M', 41, 912345679, 'Basketball Player', 47, 'San Rafael', 16),
(14, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 17),
(15, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 17),
(16, 11, 'Samonte', 'Raymharc', 'Ramirez', 'M', 16, 912345679, 'Student', 235, 'Gov. Pascual', 17),
(17, 14, 'Caguioa', 'Mark', 'Spark', 'M', 41, 912345679, 'Basketball Player', 47, 'San Rafael', 18),
(18, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 19),
(19, 16, 'Helterbrand', 'Jayjay', 'Fast', 'M', 43, 912345679, 'Basketball Player', 13, 'P. Gabriel', 19),
(20, 11, 'Samonte', 'Raymharc', 'Ramirez', 'M', 16, 912345679, 'Student', 235, 'Gov. Pascual', 20),
(21, 8, 'Thompson', 'Scottie', 'Earl', 'M', 22, 947474747, 'Security Guard', 6, 'San Rafael', 21),
(22, 7, 'Samonte', 'Ryan Joseph', 'Ramirez', 'M', 22, 9123444, '', 235, 'Gov. Pascual', 22),
(23, 11, 'Samonte', 'Raymharc', 'Ramirez', 'M', 16, 912345679, 'Student', 235, 'Gov. Pascual', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_street`
--

CREATE TABLE `tbl_street` (
  `street_id` int(11) NOT NULL,
  `street_desc` varchar(50) NOT NULL,
  `blotter_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_street`
--

INSERT INTO `tbl_street` (`street_id`, `street_desc`, `blotter_count`) VALUES
(1, 'San Rafael', 0),
(2, 'Gov. Pascual', 1),
(3, 'P. De Vera', 0),
(4, 'M. De Vera', 1),
(5, 'P. Gabriel', 0),
(6, 'Pitong Gatang', 2),
(7, 'A. Santiago', 0),
(8, 'Buraot', 1),
(9, 'M. Naval', 1),
(10, 'Lt. Santiago', 0),
(11, 'Others', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(2) NOT NULL,
  `contactnum` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `privilege` varchar(1) NOT NULL,
  `archivestatus` varchar(1) NOT NULL,
  `profileimg` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`lastname`, `firstname`, `middlename`, `gender`, `birthdate`, `age`, `contactnum`, `username`, `password`, `privilege`, `archivestatus`, `profileimg`, `userid`) VALUES
('$lastname', '$firstname', '$middlename', '$', '0000-00-00', 0, 0, '$username', '$password', '$', '1', '', 1),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '0000-00-00', 0, 9123444, 'ryan001', '1234', '1', '1', '', 2),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '0000-00-00', 0, 9123444, 'ryan002', '1234', '1', '1', '', 3),
('$lastname', '$firstname', '$middlename', '$', '0000-00-00', 19, 0, '$username', '$password', '$', '1', '', 4),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '0000-00-00', 19, 9123444, 'ryan003', '1234', '1', '1', '', 5),
('Samonte', 'Ryan Joseph', 'Ramirez', 'F', '1999-06-01', 18, 9123444, 'ryan004', '1234', '2', '1', 'ID Pic.jpg', 6),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryan005', '1234', '1', '1', '', 7),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryan006', '1234', '1', '1', '', 8),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryan007', '1234', '1', '1', '', 9),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryan008', '1234', '1', '1', '', 10),
('', '', '', 'M', '1999-06-01', 18, 0, '', '', '1', '1', '', 11),
('', '', '', 'M', '1999-06-01', 18, 0, '', '', '1', '1', '', 12),
('', '', '', 'F', '1999-06-01', 18, 0, '', '', '2', '1', '', 13),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryanhaha', '1234', '1', '1', '', 14),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 9123444, 'ryanhehe', '1234', '1', '1', '', 15),
('Samonte', 'Ryan Joseph', 'Ramirez', 'F', '1999-06-01', 18, 9123444, 'ryanhihi', '1234', '2', '1', '', 16),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '0000-00-00', 18, 9123444, 'ryannnnn', '1234', '1', '1', '', 17),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '2018-03-15', 18, 9123444, 'ryayayay', '1234', '1', '1', '', 18),
('$lastname', '$firstname', '$middlename', '$', '0000-00-00', 6851, 0, '$username', '$password', '$', '1', '', 19),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '2018-03-06', -2, 9123444, 'ryannnnnn', '1234', '1', '1', '', 20),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '2018-03-13', -9, 9123444, 'ryryryry', '1234', '1', '1', '', 21),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '2018-03-05', -1, 9123444, 'ry', '1234', '1', '1', '', 22),
('$lastname', '$firstname', '$middlename', '$', '0000-00-00', 6851, 0, '$username', '$password', '$', '1', '', 23),
('$lastname', '$firstname', '$middlename', '$', '0000-00-00', 19, 0, '$username', '$password', '$', '1', '', 24),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 19, 9123444, 'ryanJ', '1234', '1', '1', '', 25),
('Samonte', 'Raymharc', 'Ramirez', 'M', '2002-11-16', 15, 9123444, 'raymharc', '1234', '1', '1', '', 26),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 19, 9123444, 'ryanRS', '/', '1', '0', 'ID Pic.jpg', 27),
('Samonte', 'Ryan Joseph', 'Ramirez', 'M', '1999-06-01', 18, 91234, 'ry', '/', '1', '0', 'ID Pic.jpg', 28),
('Thompson', 'Earl', 'Scottie', 'M', '1999-06-01', 18, 966666666, 'skati', '6', '1', '0', 'gin-thompson18.png', 29),
('Caguioa', 'Mark', 'Anthony', 'M', '2018-04-01', -1, 912345679, 'mark', '47', '1', '0', 'caption-this-caguioa-glasses.jpg', 30),
('Yap', 'James', 'Carlos', 'M', '1999-06-01', 18, 912345679, 'jy18', '/', '1', '0', 'fbd.jpg', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blotter_details`
--
ALTER TABLE `tbl_blotter_details`
  ADD PRIMARY KEY (`blotter_id`);

--
-- Indexes for table `tbl_complainant`
--
ALTER TABLE `tbl_complainant`
  ADD PRIMARY KEY (`complainant_id`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`residentid`);

--
-- Indexes for table `tbl_respondent`
--
ALTER TABLE `tbl_respondent`
  ADD PRIMARY KEY (`respondent_id`);

--
-- Indexes for table `tbl_street`
--
ALTER TABLE `tbl_street`
  ADD PRIMARY KEY (`street_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_complainant`
--
ALTER TABLE `tbl_complainant`
  MODIFY `complainant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `residentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_respondent`
--
ALTER TABLE `tbl_respondent`
  MODIFY `respondent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_street`
--
ALTER TABLE `tbl_street`
  MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
