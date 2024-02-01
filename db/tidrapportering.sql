/*
SQLyog Community
MySQL - 8.0.31 : Database - tidappdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `aktiviteter` */

DROP TABLE IF EXISTS `aktiviteter`;

CREATE TABLE `aktiviteter` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `namn` varchar(30) COLLATE utf8mb3_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `namn` (`namn`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

/*Data for the table `aktiviteter` */

insert  into `aktiviteter`(`ID`,`namn`) values 
(4,'fel'),
(3,'health up'),
(2,'javascript'),
(1,'php');

/*Table structure for table `uppgifter` */

DROP TABLE IF EXISTS `uppgifter`;

CREATE TABLE `uppgifter` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `beskrivning` varchar(100) COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  `aktivitetid` int DEFAULT NULL,
  `tid` time DEFAULT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `aktivitetid` (`aktivitetid`),
  CONSTRAINT `uppgifter_ibfk_1` FOREIGN KEY (`aktivitetid`) REFERENCES `aktiviteter` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

/*Data for the table `uppgifter` */

insert  into `uppgifter`(`ID`,`beskrivning`,`aktivitetid`,`tid`,`datum`) values 
(1,'yippiee',3,'22:00:00','2024-01-11'),
(2,'woopsiee',2,'23:00:00','2024-01-06'),
(3,'happie',3,'00:00:00','2024-01-22'),
(4,'qippie',1,'01:00:00','2023-12-27');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
