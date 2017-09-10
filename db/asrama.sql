/*
SQLyog Ultimate v10.41 
MySQL - 5.5.5-10.1.9-MariaDB : Database - asrama
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `asrama`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_room_id` int(11) DEFAULT NULL,
  `booking_resident_id` int(11) DEFAULT NULL,
  `booking_amount` int(11) DEFAULT NULL,
  `booking_payment_proof` text,
  `booking_payment_datetime` timestamp NULL DEFAULT NULL,
  `booking_datetime` timestamp NULL DEFAULT NULL,
  `booking_desc` text,
  `booking_user_validator` int(11) DEFAULT NULL,
  `booking_status` enum('0','1','2','3') DEFAULT NULL COMMENT '0=booking, 1=payment, 2=done, 3=done',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `booking` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_resident_id` int(11) DEFAULT NULL,
  `payment_room_id` int(11) DEFAULT NULL,
  `payment_amount` int(11) DEFAULT NULL,
  `payment_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_due_date` date DEFAULT NULL,
  `payment_fine` int(11) DEFAULT NULL,
  `payment_fine_persentage` int(11) DEFAULT NULL,
  `payment_status` enum('0','1','2') DEFAULT NULL COMMENT '0=belim dibayar, 1=dibayar, 2=terlambat',
  `payment_user_id` int(11) DEFAULT NULL,
  `payment_desc` text,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

/*Table structure for table `resident` */

DROP TABLE IF EXISTS `resident`;

CREATE TABLE `resident` (
  `resident_id` int(11) NOT NULL AUTO_INCREMENT,
  `resident_name` varchar(200) DEFAULT NULL,
  `resident_identity_type` enum('ktp','sim','pasport') DEFAULT NULL,
  `resident_identity_number` varchar(100) DEFAULT NULL,
  `resident_origin_address` text,
  `resident_email` varchar(200) DEFAULT NULL,
  `resident_contact` varchar(50) DEFAULT NULL,
  `resident_type` enum('0','1','2','3') DEFAULT '0' COMMENT '0 = mhs s1, 1=mhs s2, 2 = orang tua mhs, 3=tamu',
  `resident_status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`resident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resident` */

/*Table structure for table `room` */

DROP TABLE IF EXISTS `room`;

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_code` char(1) DEFAULT NULL,
  `room_type` int(11) DEFAULT NULL,
  `room_price` int(11) DEFAULT NULL,
  `room_availibility` enum('0','1') DEFAULT '0',
  `room_desc` text,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `room` */

/*Table structure for table `room_photo` */

DROP TABLE IF EXISTS `room_photo`;

CREATE TABLE `room_photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_room_id` int(11) DEFAULT NULL,
  `photo_name` text,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `room_photo` */

/*Table structure for table `room_resident` */

DROP TABLE IF EXISTS `room_resident`;

CREATE TABLE `room_resident` (
  `roomres_id` int(11) NOT NULL AUTO_INCREMENT,
  `roomres_room_id` int(11) DEFAULT NULL,
  `roomres_resident_id` int(11) DEFAULT NULL,
  `roomres_desc` text,
  PRIMARY KEY (`roomres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `room_resident` */

/*Table structure for table `room_type` */

DROP TABLE IF EXISTS `room_type`;

CREATE TABLE `room_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) DEFAULT NULL,
  `type_desc` text,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `room_type` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `photo` text,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`username`,`password`,`photo`,`desc`) values (1,'root root','root','63a9f0ea7bb98050796b649e85481845','assets/admin/images/user/root.jpg',' root for developing '),(2,'admin','admin','21232f297a57a5a743894a0e4a801fc3','assets/admin/images/user/admin.jpg',' admin\r\n ');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
