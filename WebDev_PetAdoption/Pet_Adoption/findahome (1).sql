-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 10:06 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findahome`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `aid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`aid`, `name`, `email`, `password`, `logo`, `phone`, `address`) VALUES
(8, 'CUPA Second Chance Adoption Centre', 'test1@email.com', '5a105e8b9d40e1329780d62ea2265d8a', 'default.jpg', '08197253047', '60/4, Ambalipura - Sarjapur Road, Dommasandra, Bengaluru, Karnataka 562125');

-- --------------------------------------------------------

--
-- Table structure for table `pet_user`
--

CREATE TABLE `pet_user` (
  `pid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `animal` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `sex` tinytext NOT NULL DEFAULT 'Male',
  `dob` date DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `owner` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet_user`
--

INSERT INTO `pet_user` (`pid`, `email`, `name`, `animal`, `breed`, `sex`, `dob`, `img`, `notes`, `owner`, `tel`, `address`) VALUES
(8, 'test1@email.com', 'Snow', 'Cat', 'Mixed', 'female', '2019-02-06', 'cat5.jpg', 'Very jovial kitten looking for a forever homme', '0', '08197253047', '60/4, Ambalipura - Sarjapur Road, Dommasandra, Bengaluru, Karnataka 562125'),
(10, 'testuser1@email.com', 'Bruno', 'Dog', 'samoyed', 'Female', '2018-06-06', 'dog1.jpg', '', 'Test User1', '88999556', '20 , Hmt Industrial Estate, Jalahalli Cross Sm Road, H M T,Bangalore'),
(11, 'testuser1@email.com', 'Red', 'Dog', 'Retriver', 'Female', '2019-11-06', 'dog6.jpg', 'Born in a litter of puppies. Looking for a new home.', 'Test User1', '28385440', '20 , Hmt Industrial Estate, Jalahalli Cross Sm Road, H M T,Bangalore'),
(12, 'testuser1@email.com', 'red', 'cat', 'mixed', 'Female', '2019-11-06', 'cat6.jpg', '', 'Test User1', '889954626', 'Jayanagar'),
(13, 'test1@email.com', 'Teal', 'Dog', 'pug', 'Female', '2019-11-06', 'dog4.jpg', '', 'CUPA Second Chance Adoption Centre', '08197253047', '60/4, Ambalipura - Sarjapur Road, Dommasandra, Bengaluru, Karnataka 562125'),
(14, 'test2@email.com', 'Lavender', 'Dog', 'Golden Retriver', 'Female', '2019-11-05', 'dog3.jpg', '', 'Unknown', 'Unavailable', 'Unavailable'),
(15, 'testuser2@email.com', 'howler', 'Dog', 'german shephard', 'Female', '2017-02-14', 'dog5.jpg', '', 'Test User 2', '66677788896', 'no.31, church street, near jyothi Nivas college, koramangala, bangalore 560045,'),
(16, 'testuser2@email.com', 'anu', 'cat', 'calico', 'Female', '2018-12-10', 'cat3.jpg', '', 'Test User 2', '67676767676', 'flat no. 420, Arvind Dil apartments, mahadevpura,bangalore 560094');

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `email` varchar(30) NOT NULL,
  `pid` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`email`, `pid`) VALUES
('testuser1@email.com', 10),
('testuser2@email.com', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`) VALUES
(1, 'Bilwa', 'bilwa.g21@gmail.com', '1368c5b7152e10b4dc7d5f0de1fe1ca1'),
(2, 'Test User1', 'testuser1@email.com', '41da76f0fc3ec62a6939e634bfb6a342'),
(3, 'Test User 2', 'testuser2@email.com', '58dd024d49e1d1b83a5d307f09f32734'),
(4, 'Test User', 'testuser3@email.com', '1e4332f65a7a921075fbfb92c7c60cce');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `pet_user`
--
ALTER TABLE `pet_user`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pet_user`
--
ALTER TABLE `pet_user`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `saved`
--
ALTER TABLE `saved`
  ADD CONSTRAINT `saved_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `pet_user` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
