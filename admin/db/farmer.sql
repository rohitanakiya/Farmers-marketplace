/*
SQLyog Ultimate v10.00 Beta1
MySQL - 8.0.22-0ubuntu0.20.04.2 : Database - id14995818_famer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`id14995818_famer` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `id14995818_famer`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_random_id` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `category_image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category_random_id`,`category`,`deleted`,`category_image`) values (3,'5f5094640a247','test 1234',0,NULL),(4,'5f5094b2df0b6','test 786',1,NULL),(5,'5f52082bebf79','mac1',1,NULL),(6,'5f520844465fa','micro1',0,NULL),(17,'5f5727f272e97','',1,NULL),(18,'5f572ba25a0d5','',1,NULL),(19,'5f572e20167c2','micro',0,NULL),(20,'5f572e6f95382','hello',1,NULL),(23,'5f574b5f6d5f2','test',1,NULL),(24,'5f574cff3cedf','Qbd',1,NULL),(25,'5f586560ba3ae','test79',1,NULL),(26,'5f5874655e355','testeed',1,NULL),(27,'5f5874740b823','testeed',1,NULL),(28,'5f5875718cda3','testeedd',1,NULL),(29,'5f58757a8458d','testeed',1,NULL),(30,'5f5875ce4b2c7','testeed',1,NULL),(31,'5f5876018ae23','testeeds',1,NULL),(32,'5f58762ad4d51','$row',1,NULL),(33,'5f5877860831e','testeeds',1,NULL),(34,'5f7452010987c','qbd qms',0,NULL),(35,'5f74537d64630','qbd',0,NULL),(36,'5f7ff5ad09aad','test',0,NULL),(37,'5f841f37e9a7b','mini',1,NULL);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `company_id` int NOT NULL AUTO_INCREMENT,
  `company_random_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `company_logo` text CHARACTER SET utf8 COLLATE utf8_estonian_ci,
  `contact_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `state` varchar(5) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL,
  `city` int DEFAULT NULL,
  `description` text COLLATE utf8_estonian_ci,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

/*Data for the table `company` */

insert  into `company`(`company_id`,`company_random_id`,`company`,`email`,`company_logo`,`contact_number`,`address`,`website`,`deleted`,`state`,`city`,`description`) values (32,'5f69c9533a41d','microlent','microlent@gmail.com','2009042249_Image3.jpg','987456321','jodhpur','microlent.com',0,'ACT',85,'FASDFAFASDFSADFSA'),(33,'5f69c96e13921','qbd','qbd@gmail.com','2009042257_Image4.jpg','7896354123','','qbd.com',0,'QLD',43,NULL),(34,'5f69cfaf22bfe','micro','micro@gmail.com','2009122447_Image4.jpg','789632145','','micro',0,'QLD',39,NULL),(37,'5f69d3dfa58b4','mac','mac@gmail.com','2009042217_Image1.jpg','852741960','jodhpur','mav',1,NULL,NULL,NULL),(38,'5f6b13ec7b462','test','test@gmail.com','2009022351_Image2.jpg','test','test','test',0,'TAS',61,NULL),(39,'5f6c6b3a13af0','google','shakirbhay786@gmail.com','2009032437_img03.jpg','7896541230','test','google.com',0,'TAS',60,NULL),(40,'5f7453f64c3a2','qwerty','qwerty@gmail.com','2009093030_Image7.jpg','9638527410','jodhpur','qwerty.com',0,'ACT',85,NULL),(41,'5f7ef0b39df86','qbds','qbds@gmail.com','2010100855_Image1.jpg','8527419630','jodhpur','qbds.com',0,'TAS',61,NULL),(42,'5f7ff6e0c6311','qa','qbds@gmail.com','2010050932_Image2.jpg','test','jodhpur','qbds.com',0,'NT',28,NULL),(43,'5f841f1a3e314','mini','mini@gmail.com','2010091214_img08.jpg','7963512789','nagaur','mini.com',0,'TAS',63,NULL);

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `email_id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `from_email` varchar(255) NOT NULL,
  `full_address` varchar(255) DEFAULT NULL,
  `to_email` varchar(255) DEFAULT NULL,
  `to_id` bigint DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `farmer_type` enum('farmer','admin') DEFAULT 'farmer',
  `queries` text,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `emails` */

insert  into `emails`(`email_id`,`full_name`,`contact_number`,`from_email`,`full_address`,`to_email`,`to_id`,`subject`,`body`,`deleted`,`farmer_type`,`queries`) values (1,'shakshi','7845962310','test@gmail.com','asdasdadsasda','sh961046@gmail.com',31,'send mail for order place','<b>Products</b><br>Apple <br>cerrot <br>powder <br>soap <br>sugar',0,'farmer',''),(2,'saddam','5632418970','sh961046@gmail.com','sdasda','sh961046@gmail.com',31,'send mail for order place','<b>Products</b><br>soap <br>sugar',0,'farmer',''),(3,'shakir','test','shakirbhay786@gmail.com','jodhpur','test@gmail.com',38,'send mail for order place','<b>Products</b><br>banana <br>ilaychi <br>pineapple <br>sugar <br>test <br>wine',0,'farmer',''),(4,'qwerty','qwerty','shakirbhay786@gmail.com','qwerty','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>banana <br>ilaychi <br>pineapple <br>sugar <br>test',0,'farmer',''),(5,'shakir','qwerty','shakirbhay786@gmail.com','jodhpur','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>pineapple <br>sugar <br>test',0,'farmer',''),(6,'shakir','qwerty','shakirbhay786@gmail.com','jodhpur','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>pineapple <br>sugar',0,'farmer',''),(7,'shakir','qwerty','shakirbhay786@gmail.com','jodhpur','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>banana <br>pineapple <br>test',0,'farmer',''),(8,'shakir - jakir','78963245','shakir00786hussain@gmail.com',NULL,NULL,NULL,NULL,NULL,0,'admin','test'),(9,'shakir - jakir','78963245','shakir00786hussain@gmail.com',NULL,NULL,NULL,NULL,NULL,0,'admin','test'),(10,'shakir','78963245','shakirbhay786@gmail.com','jodhpur','micro@gmail.com',34,'send mail for order place','<b>Products</b><br>sugar = 5 Kg',0,'farmer','test'),(11,'qwerty','78963245','shakirbhay786@gmail.com','qwerty','micro@gmail.com',34,'send mail for order place','<b>Products</b><br>sugar = 5 Pkt',0,'farmer','hello'),(12,'asx - asxs','8955535001','archanabohra86@gmail.com',NULL,NULL,NULL,NULL,NULL,0,'admin','products'),(13,'shakir - asxsx','8955535001','archanabohra86@gmail.com',NULL,NULL,NULL,NULL,NULL,0,'admin','AS'),(14,'qwerty','qwerty','shakirbhay786@gmail.com','jodhpur','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>banana,wine = 5,1 Kg,Kg',0,'farmer','hello here'),(15,'shakir','78963245','shakirbhay786@gmail.com','jodhpur','shakirbhay786@gmail.com',39,'send mail for order place','<b>Products</b><br>banana = 1Kg<br>wine = 5Kg<br>',0,'farmer',''),(16,'saddam','6350558140','sh961046@gmail.com','testing','micro@gmail.com',34,'send mail for order place','<b>Products</b><br>sugar = 1Kg<br>',0,'farmer','testing');

/*Table structure for table `farmer_info` */

DROP TABLE IF EXISTS `farmer_info`;

CREATE TABLE `farmer_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `farmer_info` */

insert  into `farmer_info`(`id`,`first_name`,`last_name`,`email`,`mobile_number`,`address`,`description`) values (1,'shakir','hussain','shakirbhay786@gmail.com','9636433731','palari jodha','palari jodha'),(2,'shakir','hussain','shakirbhay786@gmail.com','9636433731','palari jodha','palari jodha'),(3,'test','test','test','test','test','test'),(4,'test','test','test','test','test','test'),(19,'','','','','','');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_random_id` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `description` text,
  `company_id` int NOT NULL,
  `category_id` int NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `products` */

insert  into `products`(`product_id`,`product_random_id`,`product`,`price`,`description`,`company_id`,`category_id`,`deleted`) values (1,'5f55d72d479f8','test',NULL,NULL,0,0,1),(2,'5f55d734ee1ef','test',NULL,NULL,0,0,1),(3,'5f55dfc560e86','test',NULL,NULL,0,0,1),(4,'5f55e03ba5555','testes','786','test',27,4,1),(5,'5f5868b5d1ac8','pineapple','test','tested',32,19,1),(6,'5f5868de34522','test','78','',33,6,0),(7,'5f586a0c25c87','test','test','',34,4,1),(8,'5f58786907ce8','test','test','',37,3,1),(9,'5f58787e86e10','test','test','',37,6,1),(10,'5f5878a405c7c','test','company','',34,6,1),(11,'5f5878c59504e','banana','55','test',39,19,0),(12,'5f6875e8c1c41','sugar','125','test',38,6,1),(13,'5f6988b3633a7','sugar','99','',38,6,0),(14,'5f6988d3b05f1','sugar','1234','',34,4,0),(15,'5f69893fb4206','test','test','',37,3,1),(16,'5f6d9761410f4','ilaychi','499','test',32,19,0),(17,'5f6d9f01b5cbe','wine','90','test',39,19,0),(18,'5f7479d467d46','Ghee','450','A1',32,34,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_random_id` varchar(255) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_random_id`,`user_name`,`user_password`,`deleted`) values (1,'','admin','Admin@123',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
