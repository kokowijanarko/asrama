-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2017 at 01:50 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asrama`
--
CREATE DATABASE IF NOT EXISTS `asrama` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `asrama`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `booking_room_id` int(11) DEFAULT NULL,
  `booking_resident_id` int(11) DEFAULT NULL,
  `booking_amount` int(11) DEFAULT NULL,
  `booking_payment_proof` text,
  `booking_payment_datetime` timestamp NULL DEFAULT NULL,
  `booking_datetime` timestamp NULL DEFAULT NULL,
  `booking_desc` text,
  `booking_user_validator` int(11) DEFAULT NULL,
  `booking_status` enum('0','1','2','3') DEFAULT NULL COMMENT '0=booking, 1=payment, 2=done, 3=done'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_resident_id` int(11) DEFAULT NULL,
  `payment_room_id` int(11) DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_due_date` date DEFAULT NULL,
  `payment_fine` int(11) DEFAULT NULL,
  `payment_fine_persentage` int(11) DEFAULT NULL,
  `payment_status` enum('0','1','2') DEFAULT NULL COMMENT '0=belim dibayar, 1=dibayar, 2=terlambat',
  `payment_user_id` int(11) DEFAULT NULL,
  `payment_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `resident_id` int(11) NOT NULL,
  `resident_name` varchar(200) DEFAULT NULL,
  `resident_identity_type` enum('ktp','sim','pasport') DEFAULT NULL,
  `resident_identity_number` varchar(100) DEFAULT NULL,
  `resident_origin_address` text,
  `resident_email` varchar(200) DEFAULT NULL,
  `resident_contact` varchar(50) DEFAULT NULL,
  `resident_type` enum('0','1','2','3') DEFAULT '0' COMMENT '0 = mhs s1, 1=mhs s2, 2 = orang tua mhs, 3=tamu',
  `resident_status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_code` char(5) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_building` enum('1','2') NOT NULL,
  `room_floor_id` int(11) NOT NULL,
  `room_availibility` enum('0','1') DEFAULT '0',
  `room_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_code`, `room_type_id`, `room_building`, `room_floor_id`, `room_availibility`, `room_desc`) VALUES
(28, '204', 1, '1', 1, '', '  ceking fixing');

-- --------------------------------------------------------

--
-- Table structure for table `room_floor`
--

CREATE TABLE `room_floor` (
  `floor_id` int(11) NOT NULL,
  `floor_code` char(5) NOT NULL,
  `floor_name` varchar(100) NOT NULL,
  `floor_price` int(11) NOT NULL,
  `floor_price_int` int(11) NOT NULL,
  `floor_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_floor`
--

INSERT INTO `room_floor` (`floor_id`, `floor_code`, `floor_name`, `floor_price`, `floor_price_int`, `floor_desc`) VALUES
(1, '2', 'Lantai 2', 550000, 850000, NULL),
(2, '3', 'lantai 3', 500000, 800000, NULL),
(3, '4', 'Lantai 4', 450000, 750000, NULL),
(4, '5', 'Lantai 5', 400000, 700000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_photo`
--

CREATE TABLE `room_photo` (
  `photo_id` int(11) NOT NULL,
  `photo_room_id` int(11) DEFAULT NULL,
  `photo_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_photo`
--

INSERT INTO `room_photo` (`photo_id`, `photo_room_id`, `photo_name`) VALUES
(25, 28, 'assets/admin/images/room/204_Screenshot from 2017-08-10 10-25-37.png'),
(26, 28, 'assets/admin/images/room/204_Screenshot from 2017-08-30 14-55-46.png'),
(27, 28, 'assets/admin/images/room/204_Screenshot from 2017-08-30 14-56-02.png'),
(28, 28, 'assets/admin/images/room/204_Screenshot from 2017-08-31 14-06-31.png');

-- --------------------------------------------------------

--
-- Table structure for table `room_resident`
--

CREATE TABLE `room_resident` (
  `roomres_id` int(11) NOT NULL,
  `roomres_room_id` int(11) DEFAULT NULL,
  `roomres_resident_id` int(11) DEFAULT NULL,
  `roomres_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(200) DEFAULT NULL,
  `type_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`type_id`, `type_name`, `type_desc`) VALUES
(1, 'Longstay', NULL),
(2, 'Shortstay', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `photo` text,
  `desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `photo`, `desc`) VALUES
(1, 'root root', 'root', '63a9f0ea7bb98050796b649e85481845', 'assets/admin/images/user/root.jpg', ' root for developing '),
(2, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'assets/admin/images/user/admin.jpg', ' admin\r\n '),
(3, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 'assets/admin/images/user/.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_type` (`room_type_id`),
  ADD KEY `room_floor_id` (`room_floor_id`);

--
-- Indexes for table `room_floor`
--
ALTER TABLE `room_floor`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `room_photo`
--
ALTER TABLE `room_photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `room_resident`
--
ALTER TABLE `room_resident`
  ADD PRIMARY KEY (`roomres_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `room_floor`
--
ALTER TABLE `room_floor`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room_photo`
--
ALTER TABLE `room_photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `room_resident`
--
ALTER TABLE `room_resident`
  MODIFY `roomres_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`type_id`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`room_floor_id`) REFERENCES `room_floor` (`floor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
