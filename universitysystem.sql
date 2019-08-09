-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 03:56 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universitysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `username` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` tinytext NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` tinytext,
  `phone` int(15) DEFAULT NULL,
  `location` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`username`, `password`, `role`, `email`, `name`, `phone`, `location`) VALUES
('israt', 'israt1234', 'admin', 'israt@univsys.com', 'israt jahan', 12345, 'dhaka'),
('lipa', '1234', 'admission', 'lipa@univsys.com', 'lipa', 123456, 'dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `ofrid` varchar(45) NOT NULL,
  `assignment` longtext NOT NULL,
  `lastsubmission` varchar(45) NOT NULL,
  `declarationdate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

CREATE TABLE `blogpost` (
  `sl` int(11) NOT NULL,
  `postid` varchar(45) NOT NULL,
  `posttitle` text NOT NULL,
  `poster` varchar(45) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posttext` longtext NOT NULL,
  `allowcomment` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `sl` int(11) NOT NULL,
  `touser` varchar(15) NOT NULL,
  `fromuser` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `messagetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`sl`, `touser`, `fromuser`, `message`, `messagetime`, `status`) VALUES
(1, 'admin', '18100001', 'asfay', '2018-04-18 23:20:34', 0),
(2, 'admin', '18100001', 'Hello Sir, I''ve a problem', '2018-04-18 23:46:52', 0),
(3, 'admin', '18100001', 's', '2018-04-18 23:48:34', 0),
(4, 'admin', '18100001', 'Good Evening', '2018-04-18 23:50:09', 0),
(5, 'admin', '18100001', 'good', '2018-04-18 23:50:58', 0),
(6, 'rubinaakht', '18100001', 'Hello Mam, How are you', '2018-04-19 00:07:40', 0),
(7, '18100001', 'admin', 'Good Evening. How are you ?', '2018-04-19 00:26:30', 0),
(8, 'admin', '18100001', 'Fine,sir. How are you?', '2018-04-19 00:26:54', 0),
(9, '18100001', 'admin', 'Very good', '2018-04-19 00:27:37', 0),
(10, '18100001', 'admin', 'Hi', '2018-04-19 00:53:51', 0),
(12, 'admin', '18100001', 'fsadawr', '2018-04-19 00:57:43', 0),
(13, 'rubinaakht', '18100001', 'Bingo it''s working great', '2018-04-19 00:57:56', 0),
(14, '18100001', 'rubinaakht', 'Very Good', '2018-04-19 01:52:40', 0),
(15, '18100001', 'rubinaakht', 'good', '2018-04-24 01:39:04', 0),
(16, 'admin', '18100001', 'gudu', '2018-04-24 01:42:39', 0),
(17, '18100001', 'admin', 'budu', '2018-04-24 01:42:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courselist`
--

CREATE TABLE `courselist` (
  `courseid` varchar(10) NOT NULL,
  `coursename` tinytext NOT NULL,
  `credithour` int(11) NOT NULL,
  `department` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courselist`
--

INSERT INTO `courselist` (`courseid`, `coursename`, `credithour`, `department`) VALUES
('csc101', 'Fundamentals of Computers and Applications', 4, 'CSE'),
('csc183', 'C Programming ', 4, 'CSE'),
('eng 101', 'English Literature', 4, 'ENG');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `deptid` varchar(5) NOT NULL,
  `deptname` tinytext NOT NULL,
  `totalcourses` int(11) NOT NULL,
  `totalcredithour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`deptid`, `deptname`, `totalcourses`, `totalcredithour`) VALUES
('CSE', 'Computer Science and Engineering', 10, 40),
('EEE', 'Electrical & Electronics Engineering', 10, 40);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `sl` int(11) NOT NULL,
  `noticeto` varchar(45) NOT NULL,
  `noticefrom` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `noticedate` varchar(6) NOT NULL,
  `destroydate` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offeredcourse`
--

CREATE TABLE `offeredcourse` (
  `offerid` varchar(15) NOT NULL,
  `courseid` varchar(15) NOT NULL,
  `semester` int(3) NOT NULL,
  `department` varchar(5) NOT NULL,
  `teacher` varchar(10) NOT NULL,
  `resultstatus` tinyint(1) NOT NULL DEFAULT '0',
  `assignmentstatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s18100001`
--

CREATE TABLE `s18100001` (
  `sl` int(11) NOT NULL,
  `courseid` varchar(15) NOT NULL,
  `coursename` varchar(45) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `grade` tinyint(1) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s18100001`
--

INSERT INTO `s18100001` (`sl`, `courseid`, `coursename`, `credit`, `grade`, `semester`, `year`) VALUES
(1, 'csc101', 'Fundamentals of Computers and Applications', 4, 3, 1, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `s18100002`
--

CREATE TABLE `s18100002` (
  `sl` int(11) NOT NULL,
  `courseid` varchar(15) NOT NULL,
  `coursename` varchar(45) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `grade` tinyint(1) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s18100003`
--

CREATE TABLE `s18100003` (
  `sl` int(11) NOT NULL,
  `courseid` varchar(15) NOT NULL,
  `coursename` varchar(45) NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `grade` tinyint(1) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s18100003`
--

INSERT INTO `s18100003` (`sl`, `courseid`, `coursename`, `credit`, `grade`, `semester`, `year`) VALUES
(1, 'csc101', 'Fundamentals of Computers and Applications', 4, 4, 1, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` int(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` tinytext NOT NULL,
  `location` tinytext,
  `contact` int(11) DEFAULT NULL,
  `department` varchar(15) NOT NULL,
  `admissionyear` year(4) NOT NULL,
  `admissionsemester` int(1) NOT NULL,
  `currentsemester` int(11) NOT NULL,
  `sgpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `password`, `name`, `location`, `contact`, `department`, `admissionyear`, `admissionsemester`, `currentsemester`, `sgpa`) VALUES
(18100001, '123456', 'Tareq Hasan', 'Dhaka', 2147483647, 'CSE', 2018, 1, 5, 0),
(18100002, '123456', 'Wasif al Mahmud', 'Dhaka', 2147483647, 'EEE', 2018, 1, 5, 0),
(18100003, '123456', 'Robiul Alam', 'Dhaka', 2147483647, 'CSE', 2018, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacherdetails`
--

CREATE TABLE `teacherdetails` (
  `teacherid` varchar(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` tinytext NOT NULL,
  `location` tinytext,
  `contact` int(11) DEFAULT NULL,
  `department` varchar(5) NOT NULL,
  `maxcredit` int(11) NOT NULL,
  `takencredit` int(11) NOT NULL,
  `position` tinytext NOT NULL,
  `feedback` varchar(30) NOT NULL,
  `lastfeedback` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacherdetails`
--

INSERT INTO `teacherdetails` (`teacherid`, `password`, `name`, `location`, `contact`, `department`, `maxcredit`, `takencredit`, `position`, `feedback`, `lastfeedback`) VALUES
('ahaque', '123456', 'Prof Dr Md Abdul Haque', 'Dhaka', 2147483647, 'CSE', 16, 0, 'Chair of Department', '5,5,5,5,5,5', ''),
('bintearif', '123456', 'Binte Arif', 'Dhaka', 2147483647, 'EEE', 16, 0, 'Lecturer', '5,5,5,5,5,5', ''),
('rubinaakht', '123456', 'Rubina Akhter', 'Dhaka', 12346564, 'CSE', 16, 0, 'Lecturer', '5,5,5,5,5,2.25', '5,5,5,5,5,2.25'),
('toriq', '123456', 'Toriqul Islam', 'Dhaka', 2147483647, 'EEE', 16, 0, 'Lecturer', '5,5,5,5,5,5', '');

-- --------------------------------------------------------

--
-- Table structure for table `versitycalendar`
--

CREATE TABLE `versitycalendar` (
  `id` int(11) NOT NULL,
  `occasiondate` date NOT NULL,
  `occasion` text NOT NULL,
  `vacation` tinyint(1) NOT NULL,
  `func` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `versitycalendar`
--

INSERT INTO `versitycalendar` (`id`, `occasiondate`, `occasion`, `vacation`, `func`) VALUES
(1, '2018-04-14', 'Bangla Naba Barsha', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`);

--
-- Indexes for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`postid`),
  ADD UNIQUE KEY `sl_UNIQUE` (`sl`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `courselist`
--
ALTER TABLE `courselist`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD UNIQUE KEY `sl_UNIQUE` (`sl`);

--
-- Indexes for table `offeredcourse`
--
ALTER TABLE `offeredcourse`
  ADD PRIMARY KEY (`offerid`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  ADD PRIMARY KEY (`teacherid`);

--
-- Indexes for table `versitycalendar`
--
ALTER TABLE `versitycalendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`occasiondate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `versitycalendar`
--
ALTER TABLE `versitycalendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
