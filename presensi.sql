/*
SQLyog Community v12.5.0 (64 bit)
MySQL - 10.1.26-MariaDB : Database - db_presensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_presensi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_presensi`;

/*Table structure for table `barcode` */

DROP TABLE IF EXISTS `barcode`;

CREATE TABLE `barcode` (
  `id_barcode` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(100) DEFAULT NULL,
  `lecturer` text,
  `create_at` date DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  PRIMARY KEY (`id_barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `barcode` */

insert  into `barcode`(`id_barcode`,`barcode`,`lecturer`,`create_at`,`update_at`) values 
(1,'1512288099.ITPU','[\"222\"]','0000-00-00',NULL),
(2,'1512288100.ITPU','[\"444\",\"555\"]','0000-00-00',NULL),
(3,'1512288106.ITPU','[\"555\"]','0000-00-00',NULL),
(4,'1512288810.ITPU','[\"222\"]','2017-12-03',NULL),
(5,'1512288812.ITPU','[\"666\"]','2017-12-03',NULL),
(6,'1512288867.ITPU','[\"333\"]','0000-00-00',NULL),
(7,'1512288898.ITPU','[\"222\"]','0000-00-00',NULL),
(8,'1512288922.ITPU','[\"333\"]','0000-00-00',NULL),
(9,'1512290336.ITPU','[\"222\"]','2017-12-03',NULL),
(10,'1512290433.PU','[\"222\"]','2017-12-03',NULL),
(11,'1512290434.PU','[\"333\"]','2017-12-03',NULL),
(12,'1512290435.PU','[\"111\",\"222\",\"333\",\"555\"]','2017-12-03',NULL),
(13,'1512290573.PU','[\"444\"]','2017-12-03',NULL),
(14,'1512290618.PU','[\"333\"]','2017-12-03',NULL);

/*Table structure for table `logging` */

DROP TABLE IF EXISTS `logging`;

CREATE TABLE `logging` (
  `id_logging` int(11) NOT NULL AUTO_INCREMENT,
  `id_barcode` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `scan_at` datetime NOT NULL,
  PRIMARY KEY (`id_logging`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `logging` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
