-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 09:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volunteernow`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `appid` int(11) NOT NULL,
  `vol_email` varchar(50) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `oppid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`appid`, `vol_email`, `org_name`, `status`, `oppid`) VALUES
(45, 'adiba@mail.com', 'teach bd', 'completed', 1),
(46, 'adiba@mail.com', 'Megh', 'completed', 3),
(47, 'adiba@mail.com', 'Megh', 'completed', 12),
(48, 'adiba@mail.com', 'teach bd', 'rejected', 2),
(49, 'anadil@mail.com', 'Ononna', 'completed', 13),
(50, 'adiba@mail.com', 'Ononna', 'completed', 13),
(51, 'amreen@mail.com', 'teach bd', 'date_passed', 1),
(52, 'amreen@mail.com', 'Megh', 'completed', 6),
(53, 'adiba@mail.com', 'Ononna', 'date_passed', 14),
(54, 'anadil@mail.com', 'Ononna', 'completed', 14),
(55, 'pika@mail.com', 'Megh', 'date_passed', 15),
(56, 'donaldduck@mail.com', 'Megh', 'completed', 15),
(57, 'donaldduck@mail.com', 'Foundation30', 'completed', 16),
(58, 'donaldduck@mail.com', 'teach bd', 'date_passed', 1),
(59, 'donaldduck@mail.com', 'Megh', 'date_passed', 12),
(60, 'harry@mail.com', 'teach bd', 'completed', 1),
(61, 'harry@mail.com', 'teach bd', 'rejected', 2),
(62, 'anadil@mail.com', 'Megh', 'date_passed', 3),
(63, 'donaldduck@mail.com', 'teach bd', 'date_passed', 2),
(64, 'donaldduck@mail.com', 'Megh', 'date_passed', 3),
(65, 'harry@mail.com', 'Megh', 'completed', 3),
(66, 'harry@mail.com', 'Megh', 'rejected', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cause`
--

CREATE TABLE `cause` (
  `causename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cause`
--

INSERT INTO `cause` (`causename`) VALUES
('animals'),
('climate'),
('disaster relief'),
('education'),
('elderly'),
('health'),
('human rights'),
('hunger'),
('people with disabilities'),
('poverty'),
('sports'),
('women'),
('youth');

-- --------------------------------------------------------

--
-- Table structure for table `opportunity`
--

CREATE TABLE `opportunity` (
  `name` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `org_name` varchar(50) NOT NULL,
  `vol_num` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `oppid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `vol_found` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opportunity`
--

INSERT INTO `opportunity` (`name`, `location`, `description`, `skill`, `org_name`, `vol_num`, `startdate`, `enddate`, `oppid`, `status`, `vol_found`) VALUES
('Weekend Teaching at Teach BD School for Adults', 'dhaka', 'Teach Bd is looking for teachers to teach Physics, Chemistry, Physics, English, Bangla and Maths in our school for adult. Volunteers must be present at 6pm to 10pm during all the weekends of December.', 'teaching', 'teach bd', 5, '2023-12-01', '2023-12-31', 1, 'closed', 2),
('Education Fair For All', 'online', 'An online education fair is going to be held by teach bd with over 40 universities who are partnering with us to provide reduced tuition fees to students who have financial difficulty. Volunteers are needed to conduct the event.', '', 'teach bd', 30, '2023-12-06', '2023-12-09', 2, 'closed', 0),
('Awareness Program for Flood Prone Areas', 'Barisal', 'An awareness program will be held at Barisal which is very prone to flooding during the monsoon season. Volunteers will be taken to Barisal the day before by our transport and come back the day after.', '', 'Megh', 10, '2024-01-01', '2024-01-01', 3, 'closed', 2),
('After School Clubs for Teach BDs School for the Underprivileged', 'Dhaka', 'We will hold after school clubs for class 1-5 every weekday around 2pm. Specifications will be given later.', 'Arts, crafts, music, dance, writing', 'teach bd', 5, '2022-11-22', '2022-12-31', 4, 'closed', 0),
('Relief Distribution to Cyclone Affected Areas', 'khulna', 'We are arranging a relief distribution in khulna. Transport will be provided. Volunteers will also be given a small sum of money to spend for data and transport in the area. ', '', 'Megh', 10, '2023-12-03', '2023-12-06', 6, 'closed', 1),
('March for Climate Justice', 'dhaka', 'A march will be held for climate justice in dhaka city. Volunteers must be at the venue by 9am. Food and water will be provided to all volunteers.', '', 'Megh', 15, '2023-12-09', '2023-12-09', 12, 'closed', 1),
('Seminar on Equality', 'chittagong', 'A seminar will be held by us for two days at Radisson Blue, Chittagong. The volunteers are preferred to be from Chittagong and spend two whole days with us. Food will be provided.', 'public speaking', 'Ononna', 2, '2023-12-15', '2023-12-16', 13, 'closed', 2),
('Workshop on self defense', 'dhaka', 'We will hold a workshop on self defense at our office during the day. Volunteers must be present from 10am to 3pm. Some knowledge of self defense will be preferred.', '', 'Ononna', 3, '2023-11-17', '2023-11-20', 14, 'closed', 1),
('Peaceful protest against carbon emission', 'dhaka', 'We are going to hold a peaceful protest in front of major carbon emitting companies. Volunteers are required to ensure that the event is carried out smoothly.', '', 'Megh', 2, '2023-12-01', '2023-12-01', 15, 'closed', 1),
('Charity Football Match', 'dhaka', 'We are organizing a charity football event. The proceeds will be donated to a school dedicated to help the disabled. Volunteers must be present from 8 am to 5 pm everyday.', 'sports', 'Foundation30', 10, '2023-12-04', '2023-12-06', 16, 'closed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `cause_one` varchar(100) DEFAULT NULL,
  `cause_two` varchar(100) DEFAULT NULL,
  `cause_three` varchar(100) DEFAULT NULL,
  `org_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`name`, `email`, `password`, `address`, `description`, `website`, `cause_one`, `cause_two`, `cause_three`, `org_id`) VALUES
('Foundation30', 'foundation30@mail.com', 'foundation30', 'House#22, Road#44, Chittagong', 'We are a small organization trying to create social change in the community.', 'foundation30.com', 'human rights', 'poverty', 'sports', '24225099'),
('FTC-For the Children', 'ftc@mail.com', 'forthechildren', 'House#3, Road#52, Mohakhali, Dhaka, Bangladesh', 'We are the leading youth opportunity creator in Bangladesh.', 'ftc.com', 'education', 'hunger', 'youth', '2084870'),
('Megh', 'megh@mail.com', 'megh', 'House#32, Road#4, Sector#11, Uttara, Dhaka ', 'We a pioneering climate consultancy firm in Bangladesh.', 'megh.com', 'climate', 'disaster relief', '', '605983702318494'),
('Ononna', 'ononna@mail.com', 'ononna', 'house#32, Road#71, Banani, Dhaka', 'We are a women empowerment oganization.', 'ononna.com', 'health', 'human rights', 'women', '40041809484619780958'),
('teach bd', 'teachbd@mail.com', 'teachbd', 'House#18, Road#55, Block-C, Banani, Dhaka', 'We are a non profit school aiming to provide free education all across Bangladesh.', 'teachbd.com', 'education', 'youth', '', '629383586154');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `vid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`vid`, `name`, `phone`, `email`, `location`, `password`, `dob`) VALUES
('1121864826', 'adiba', '01928374899', 'adiba@mail.com', 'dhaka', 'adiba', '2001-09-20'),
('80376504', 'Amreen', '0192837490', 'amreen@mail.com', 'Dhaka', 'amreen', '1997-01-06'),
('112669976516', 'anadil', '9182736656', 'anadil@mail.com', 'chittagong', 'anadil', '1998-06-11'),
('4010828', 'Donald Duck', '172836712', 'donaldduck@mail.com', 'Dhaka', 'donaldduck', '2001-06-13'),
('925912014790850883', 'harry', '0192837', 'harry@mail.com', 'dhaka', 'harry', '1995-06-14'),
('276048', 'Pikachu', '273645362', 'pika@mail.com', 'Chittagong', 'pika', '2008-11-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`appid`),
  ADD KEY `org_name` (`org_name`),
  ADD KEY `vol_email` (`vol_email`),
  ADD KEY `oppid` (`oppid`);

--
-- Indexes for table `cause`
--
ALTER TABLE `cause`
  ADD PRIMARY KEY (`causename`);

--
-- Indexes for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD PRIMARY KEY (`oppid`),
  ADD KEY `org_name` (`org_name`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`name`),
  ADD KEY `cause_one` (`cause_one`),
  ADD KEY `cause_two` (`cause_two`),
  ADD KEY `cause_three` (`cause_three`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `appid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `opportunity`
--
ALTER TABLE `opportunity`
  MODIFY `oppid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`org_name`) REFERENCES `organization` (`name`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`vol_email`) REFERENCES `volunteer` (`email`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`oppid`) REFERENCES `opportunity` (`oppid`);

--
-- Constraints for table `opportunity`
--
ALTER TABLE `opportunity`
  ADD CONSTRAINT `opportunity_ibfk_1` FOREIGN KEY (`org_name`) REFERENCES `organization` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
