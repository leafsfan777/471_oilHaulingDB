﻿# Host: localhost  (Version 5.7.15-log)
# Date: 2016-12-02 12:46:27
# Generator: MySQL-Front 5.4  (Build 4.7)
# Internet: http://www.mysqlfront.de/

/*!40101 SET NAMES utf8 */;

#
# Structure for table "company"
#

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `Company_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Business_Type` varchar(255) DEFAULT NULL,
  `Hauler` binary(1) NOT NULL DEFAULT '\0',
  `Producer` binary(1) DEFAULT NULL,
  PRIMARY KEY (`Company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "company"
#

INSERT INTO `company` VALUES (123456,'The real OG','Upstream',X'30',X'31'),(124578,'Factorial','Downstream',X'30',X'31'),(142536,'OG movers','Midstream',X'31',X'30'),(147258,'Crogi energy','Integrated',X'31',X'31');

#
# Structure for table "facilities"
#

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
  `Location_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Direction` varchar(255) DEFAULT NULL,
  `Sour` binary(1) DEFAULT NULL,
  PRIMARY KEY (`Location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "facilities"
#

INSERT INTO `facilities` VALUES (1000123,'Trump Torre','81N-05E-875DC',X'31'),(1000478,'Sunset Refinery','3N-45W-635SA',X'31'),(1000698,'Loonie Bay','5S-96E-157AB',X'30'),(1000784,'Preservation Hall','23S-23W-09SA',X'30');

#
# Structure for table "lisence"
#

DROP TABLE IF EXISTS `lisence`;
CREATE TABLE `lisence` (
  `Type` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "lisence"
#

INSERT INTO `lisence` VALUES (1,'Non-Sour Lisence (in province)'),(2,'Sour Lisence (in province)'),(3,'Comprehensive Lisence');

#
# Structure for table "drivers"
#

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `Emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Lisence` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Emp_id`),
  KEY `Lisence` (`Lisence`),
  CONSTRAINT `Lisence` FOREIGN KEY (`Lisence`) REFERENCES `lisence` (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "drivers"
#

INSERT INTO `drivers` VALUES (400154,'Chris Martin',1),(400258,'Matt Bellamy',2),(400476,'Dave Grohl',3),(400487,'Ryan Tedder',2),(400863,'Dan Reynolds',3);

#
# Structure for table "products"
#

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `Product_no` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(255) NOT NULL DEFAULT '',
  `Sour` binary(1) NOT NULL DEFAULT '\0',
  PRIMARY KEY (`Product_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "products"
#

INSERT INTO `products` VALUES (1,'Gas',X'30'),(2,'Water',X'30'),(3,'Sand',X'30'),(4,'Crude',X'31'),(5,'Waste',X'30');

#
# Structure for table "trucks"
#

DROP TABLE IF EXISTS `trucks`;
CREATE TABLE `trucks` (
  `VIN` int(11) NOT NULL DEFAULT '123456',
  `Weight(kg)` int(11) NOT NULL DEFAULT '0',
  `Type` varchar(255) NOT NULL DEFAULT '',
  `Capacity(L)` int(11) DEFAULT NULL,
  `Sour_hauler` binary(1) NOT NULL DEFAULT '\0',
  `Winter_only` binary(1) NOT NULL DEFAULT '\0',
  PRIMARY KEY (`VIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "trucks"
#

INSERT INTO `trucks` VALUES (100456,14750,'4A-AWD-8W',1875,X'31',X'31'),(100654,12480,'3A-RWD-6W',1490,X'31',X'30'),(100789,15000,'4A-AWD-10W',2000,X'30',X'31'),(100987,13800,'3A-AWD-6W',1500,X'30',X'30');

#
# Structure for table "tickets"
#

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `Ticket_no` int(11) NOT NULL AUTO_INCREMENT,
  `Weigh_in` varchar(255) NOT NULL DEFAULT '',
  `Weigh_out` varchar(255) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `Time` time DEFAULT NULL,
  `Product_Hauled` int(11) NOT NULL DEFAULT '0',
  `Hauling_Truck` int(11) NOT NULL DEFAULT '0',
  `Owned_by` int(11) DEFAULT NULL,
  `Hauled_from` int(11) DEFAULT NULL,
  `Hauled_to` int(11) DEFAULT NULL,
  PRIMARY KEY (`Ticket_no`),
  KEY `Product` (`Product_Hauled`),
  KEY `Truck` (`Hauling_Truck`),
  KEY `Hauled_from` (`Hauled_from`),
  KEY `Hauled_to` (`Hauled_to`),
  KEY `Company` (`Owned_by`),
  CONSTRAINT `Company` FOREIGN KEY (`Owned_by`) REFERENCES `company` (`Company_id`) ON UPDATE CASCADE,
  CONSTRAINT `Hauled_from` FOREIGN KEY (`Hauled_from`) REFERENCES `facilities` (`Location_id`) ON UPDATE CASCADE,
  CONSTRAINT `Hauled_to` FOREIGN KEY (`Hauled_to`) REFERENCES `facilities` (`Location_id`) ON UPDATE CASCADE,
  CONSTRAINT `Product` FOREIGN KEY (`Product_Hauled`) REFERENCES `products` (`Product_no`) ON UPDATE CASCADE,
  CONSTRAINT `Truck` FOREIGN KEY (`Hauling_Truck`) REFERENCES `trucks` (`VIN`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "tickets"
#

INSERT INTO `tickets` VALUES (1,'15000','29500','2016-11-28','13:15:01',1,100789,123456,1000698,1000784),(2,'14750','19500','2016-12-01','09:35:20',4,100654,147258,1000478,1000123);

#
# Structure for table "invoice"
#

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `Invoice_no` int(11) NOT NULL AUTO_INCREMENT,
  `Ticket_no` int(11) DEFAULT NULL,
  `Date_payed` date DEFAULT NULL,
  `Date_issued` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Issued_by` int(11) DEFAULT NULL,
  `Payed_by` int(11) DEFAULT NULL,
  `Full_payed` binary(1) DEFAULT NULL,
  PRIMARY KEY (`Invoice_no`),
  KEY `Issued_by` (`Issued_by`),
  KEY `Ticket_no` (`Ticket_no`),
  CONSTRAINT `Issued_by` FOREIGN KEY (`Issued_by`) REFERENCES `company` (`Company_id`) ON UPDATE CASCADE,
  CONSTRAINT `Ticket_no` FOREIGN KEY (`Ticket_no`) REFERENCES `tickets` (`Ticket_no`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "invoice"
#

INSERT INTO `invoice` VALUES (1,1,'0201-12-01','2016-11-28',16870.00,142536,123456,X'31'),(2,2,NULL,'2016-12-01',17952.00,147258,124578,X'30');

#
# Structure for table "driven"
#

DROP TABLE IF EXISTS `driven`;
CREATE TABLE `driven` (
  `VIN` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_Id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`VIN`),
  KEY `Employee` (`Emp_Id`),
  CONSTRAINT `Employee` FOREIGN KEY (`Emp_Id`) REFERENCES `drivers` (`Emp_id`) ON UPDATE CASCADE,
  CONSTRAINT `VIN` FOREIGN KEY (`VIN`) REFERENCES `trucks` (`VIN`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "driven"
#

INSERT INTO `driven` VALUES (100456,400487),(100654,400863),(100789,400154),(100987,400476);
