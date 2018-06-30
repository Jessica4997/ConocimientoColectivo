/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.31-MariaDB : Database - db_cc_v2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cc_v2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_cc_v2`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `removed` enum('Activo','Eliminado') COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`parent_id`,`removed`) values (1,'Bailes',NULL,'Activo'),(2,'Deportes',NULL,'Activo'),(3,'Música',NULL,'Activo'),(4,'Teatro',NULL,'Activo'),(5,'Arte',NULL,'Activo'),(6,'Gastronomía',NULL,'Activo'),(7,'Escritura',NULL,'Activo');

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `final_rating` int(11) DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `wrks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_discounts_wrks_id` (`wrks_id`),
  CONSTRAINT `fk_discounts_wrks_id` FOREIGN KEY (`wrks_id`) REFERENCES `workshops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `discounts` */

/*Table structure for table `inscribed_users` */

DROP TABLE IF EXISTS `inscribed_users`;

CREATE TABLE `inscribed_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iu_status` enum('Confirmado','No confirmado') NOT NULL,
  `student_rating` int(11) DEFAULT NULL,
  `tutor_rating` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `wrks_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_inscribed_users_user_id` (`user_id`),
  KEY `fk_inscribed_users_wrks_id` (`wrks_id`),
  CONSTRAINT `fk_inscribed_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscribed_users_wrks_id` FOREIGN KEY (`wrks_id`) REFERENCES `workshops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `inscribed_users` */

insert  into `inscribed_users`(`id`,`iu_status`,`student_rating`,`tutor_rating`,`user_id`,`wrks_id`,`created_date`) values (1,'Confirmado',5,4,2,1,'2018-06-29 17:21:34'),(12,'Confirmado',4,4,1,2,'2018-06-29 17:47:44'),(24,'Confirmado',5,3,1,4,'2018-06-13 11:02:41'),(26,'Confirmado',5,NULL,2,3,'2018-06-13 11:02:41'),(27,'Confirmado',5,NULL,19,80,'2018-05-30 11:02:41'),(28,'Confirmado',4,5,19,1,'2018-06-15 15:15:28'),(36,'Confirmado',NULL,NULL,2,84,'2018-05-28 11:02:41'),(39,'Confirmado',4,NULL,21,94,'2018-06-14 13:52:42'),(40,'No confirmado',NULL,NULL,3,1,'2018-06-29 19:12:55'),(44,'Confirmado',4,NULL,1,117,'2018-06-27 15:05:52'),(45,'Confirmado',5,NULL,3,4,'2018-06-13 17:30:11'),(46,'Confirmado',5,5,3,123,'2018-06-16 04:27:06'),(47,'Confirmado',NULL,NULL,2,122,'2018-06-16 03:43:53'),(48,'Confirmado',NULL,NULL,3,122,'2018-06-16 04:24:33'),(49,'No confirmado',NULL,NULL,19,122,'2018-06-16 04:25:06'),(50,'No confirmado',NULL,NULL,19,119,'2018-06-16 03:40:42'),(51,'No confirmado',NULL,NULL,3,119,'2018-06-16 03:40:21'),(52,'Confirmado',NULL,NULL,18,123,'2018-06-16 03:46:47'),(53,'No confirmado',NULL,NULL,1,128,'2018-06-27 14:56:19'),(54,'Confirmado',4,NULL,2,129,'2018-06-28 13:17:24'),(55,'Confirmado',4,NULL,1,130,'2018-06-27 16:20:09'),(56,'No confirmado',NULL,NULL,2,225,'2018-06-29 18:42:23'),(57,'Confirmado',NULL,NULL,2,227,'2018-06-30 03:54:55'),(58,'No confirmado',NULL,NULL,30,227,'2018-06-30 04:04:00'),(59,'No confirmado',NULL,NULL,18,227,'2018-06-30 03:52:13'),(60,'Confirmado',NULL,NULL,30,230,'2018-06-30 04:10:14'),(61,'Confirmado',NULL,NULL,2,230,'2018-06-30 04:10:16');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  `dificult` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`id`,`level`,`dificult`) values (1,'Básico',1),(2,'Intermedio',2),(3,'Avanzado',3);

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(4,2) NOT NULL,
  `pay_status` enum('Pagado','No pagado') COLLATE utf8_spanish2_ci NOT NULL,
  `pay_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `dsct_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wrks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payments_dsct_id` (`dsct_id`),
  KEY `fk_payments_user_id` (`user_id`),
  KEY `fk_payments_wrks_id` (`wrks_id`),
  CONSTRAINT `fk_payments_dsct_id` FOREIGN KEY (`dsct_id`) REFERENCES `discounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_payments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_payments_wrks_id` FOREIGN KEY (`wrks_id`) REFERENCES `workshops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `payments` */

/*Table structure for table `proposal_interested` */

DROP TABLE IF EXISTS `proposal_interested`;

CREATE TABLE `proposal_interested` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `pw_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proposal_interested_user_id` (`user_id`),
  KEY `fk_proposal_interested_pw_id` (`pw_id`),
  CONSTRAINT `fk_proposal_interested_pw_id` FOREIGN KEY (`pw_id`) REFERENCES `proposed_workshops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proposal_interested_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `proposal_interested` */

/*Table structure for table `proposed_subcategories` */

DROP TABLE IF EXISTS `proposed_subcategories`;

CREATE TABLE `proposed_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `votes_quantity` int(11) DEFAULT NULL,
  `removed` enum('Activo','Eliminado') NOT NULL,
  `psc_status` enum('Aperturado','Inactivo') DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_psc_user_id_users_id` (`user_id`),
  KEY `fk_psc_category_id_categories_id` (`category_id`),
  CONSTRAINT `fk_psc_category_id_categories_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_psc_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `proposed_subcategories` */

insert  into `proposed_subcategories`(`id`,`name`,`description`,`votes_quantity`,`removed`,`psc_status`,`created_date`,`user_id`,`category_id`) values (2,'Comida Italiana','Quisiera aprender a preparar pizzas, ravioles, etc.',12,'Activo','Inactivo','2018-06-25 01:12:38',1,6),(4,'Bajo','Quisiera que dicten talleres de bajo.',10,'Eliminado','Aperturado','2018-06-25 01:12:36',2,3),(5,'Tangos','Dicten talleres de tango.',NULL,'Activo','Inactivo','2018-06-25 01:12:39',1,1),(8,'Tennis','',NULL,'Activo','Inactivo','2018-06-25 01:12:41',1,2),(9,'Esgrima','',1,'Activo','Inactivo','2018-06-25 01:12:45',1,2),(10,'Electrónica','',2,'Activo','Inactivo','2018-06-30 03:05:04',2,3);

/*Table structure for table `proposed_subcategories_votes` */

DROP TABLE IF EXISTS `proposed_subcategories_votes`;

CREATE TABLE `proposed_subcategories_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposed_subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pscv_user_id_users_id` (`user_id`),
  KEY `fk_pscv_psc_id_psc_id` (`proposed_subcategory_id`),
  CONSTRAINT `fk_pscv_psc_id_psc_id` FOREIGN KEY (`proposed_subcategory_id`) REFERENCES `proposed_subcategories` (`id`),
  CONSTRAINT `fk_pscv_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `proposed_subcategories_votes` */

insert  into `proposed_subcategories_votes`(`id`,`proposed_subcategory_id`,`user_id`) values (4,2,1),(5,4,1),(6,9,1),(8,10,2);

/*Table structure for table `proposed_workshops` */

DROP TABLE IF EXISTS `proposed_workshops`;

CREATE TABLE `proposed_workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `removed` enum('Activo','Eliminado') DEFAULT NULL,
  `votes_quantity` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `pw_status` enum('Aperturado','Inactivo') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proposed_workshops_user_id` (`user_id`),
  KEY `fk_proposed_workshops_category_id` (`category_id`),
  KEY `fk_proposed_workshops_subcategory_id_subcategories_id` (`subcategory_id`),
  KEY `fk_pw_level_id_level_id` (`level_id`),
  CONSTRAINT `fk_proposed_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proposed_workshops_subcategory_id_subcategories_id` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  CONSTRAINT `fk_proposed_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pw_level_id_level_id` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `proposed_workshops` */

insert  into `proposed_workshops`(`id`,`title`,`start_date`,`start_time`,`end_time`,`created_date`,`user_id`,`category_id`,`subcategory_id`,`removed`,`votes_quantity`,`level_id`,`description`,`pw_status`) values (1,'Taller de Hip-Hop','2018-06-08','14:00:00','18:00:00','2018-06-25 01:07:15',2,1,23,'Eliminado',1,1,'Somos 5 chicos que deseamos la apertura de un taller de música urbana para el 26 de mayo.           ','Aperturado'),(2,'Taller de Ukelele','2018-05-26','00:00:00','00:00:00','2018-06-25 01:07:17',1,3,24,'Activo',1,2,'Buscamos a una persona que nos dicte clases de ukelele','Aperturado'),(3,'Taller de Pintura','2018-04-25','00:00:00','00:00:00','2018-06-25 01:07:20',3,5,16,'Eliminado',1,3,'Necesitamos un profesor que nos enseñe como pintar en degradado','Aperturado'),(6,'Taller de Ballet','2018-07-08','12:00:00','18:00:00','2018-06-30 00:26:50',2,1,22,'Activo',1,1,'Buscamos a una profesora que nos enseñe clases de ballet para una presentación                      ','Aperturado'),(7,'Taller de Fulbito','2018-06-05','00:00:00','00:00:00','2018-05-25 20:27:15',2,2,5,'Activo',0,3,'d','Inactivo'),(9,'Clases de Bachata','2018-05-19','00:00:00','00:00:00','2018-05-25 20:27:21',3,1,1,'Activo',0,2,'Taller de bachata para personas con conocimiento intermedios','Inactivo'),(10,'nawidonaodnaiondia','2018-05-25','00:00:00','00:00:00','2018-05-25 21:31:47',2,3,10,'Activo',1,2,'asdsad','Inactivo'),(11,'Taller de escritura','2018-05-27','00:00:00','00:00:00','2018-06-25 01:07:21',2,7,34,'Activo',NULL,1,'','Aperturado'),(12,'sfsfs','2018-05-29','00:00:00','00:00:00','2018-06-25 01:07:23',21,4,14,'Eliminado',1,1,'','Aperturado'),(13,'tallr de bachata','2018-05-31','12:00:00','13:00:00','2018-06-25 01:07:24',1,1,1,'Activo',NULL,1,'                                                                                                    ','Aperturado'),(18,'taller creado','2018-05-31','10:00:00','12:00:00','2018-06-25 01:07:26',1,4,15,'Eliminado',0,1,'Busco un profesor que me enseñe comedia','Aperturado'),(19,'ultimo hoy','0000-00-00','15:00:00','16:00:00','2018-06-25 01:07:28',1,1,1,'Activo',NULL,1,'','Aperturado'),(20,'ultimo hoy si','2018-05-31','12:00:00','13:00:00','2018-06-25 01:07:30',1,1,1,'Activo',NULL,1,'','Aperturado'),(21,'Taller de Bachata basico','2018-06-05','12:00:00','13:00:00','2018-06-25 01:07:42',1,1,1,'Activo',NULL,1,'','Aperturado'),(22,'Taller de Ballet','2018-06-30','12:00:00','13:00:00','2018-06-29 22:49:10',1,1,1,'Activo',NULL,1,'','Inactivo'),(23,'Taller de Caligrafia','2018-06-30','18:00:00','19:00:00','2018-06-28 18:39:11',2,7,37,'Activo',NULL,2,'','Inactivo'),(24,'Taller de Reposteria','2018-07-02','12:00:00','13:00:00','2018-06-29 18:22:54',1,6,19,'Activo',NULL,1,'Solicito la apertura de un taller de reposteria para el lunes 2','Inactivo'),(27,'Taller de Basket','2018-07-08','08:00:00','12:00:00','2018-06-30 01:20:46',1,2,9,'Activo',1,1,'Solicito un taller de basket','Inactivo'),(28,'Taller de Break Dance en la noche','2018-07-08','12:00:00','13:00:00','2018-06-30 04:19:54',1,1,27,'Activo',1,1,'','Inactivo');

/*Table structure for table `proposed_workshops_votes` */

DROP TABLE IF EXISTS `proposed_workshops_votes`;

CREATE TABLE `proposed_workshops_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposed_workshops_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pw_votes_proposed_workshops_id_proposed_workshops_id` (`proposed_workshops_id`),
  KEY `fk_pw_votes_user_id_users_id` (`user_id`),
  CONSTRAINT `fk_pw_votes_proposed_workshops_id_proposed_workshops_id` FOREIGN KEY (`proposed_workshops_id`) REFERENCES `proposed_workshops` (`id`),
  CONSTRAINT `fk_pw_votes_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `proposed_workshops_votes` */

insert  into `proposed_workshops_votes`(`id`,`proposed_workshops_id`,`user_id`) values (8,1,1),(9,3,1),(11,6,1),(12,10,1),(15,12,1),(16,27,2),(17,28,2);

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('Alumno','Docente') COLLATE utf8_spanish2_ci NOT NULL,
  `final_rating` float DEFAULT NULL,
  `rating_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role`),
  CONSTRAINT `fk_ratings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `ratings` */

/*Table structure for table `subcategories` */

DROP TABLE IF EXISTS `subcategories`;

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `categories_id` int(11) NOT NULL,
  `removed` enum('Activo','Eliminado') COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategories_parent_id_categories_id` (`categories_id`),
  CONSTRAINT `fk_subcategories_parent_id_categories_id` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `subcategories` */

insert  into `subcategories`(`id`,`sub_name`,`categories_id`,`removed`) values (1,'Bachata',1,'Activo'),(2,'Salsa',1,'Activo'),(4,'Balada',1,'Activo'),(5,'Fútbol',2,'Activo'),(7,'Voley',2,'Activo'),(9,'Basketball',2,'Activo'),(10,'Guitarra',3,'Activo'),(11,'Batería',3,'Activo'),(12,'Piano',3,'Activo'),(13,'Clown',4,'Activo'),(14,'Dramático',4,'Activo'),(15,'Comedia',4,'Activo'),(16,'Pintura',5,'Activo'),(17,'Escultura',5,'Activo'),(18,'Manualidades',5,'Activo'),(19,'Repostería',6,'Activo'),(20,'Oriental',6,'Activo'),(21,'Criolla',6,'Activo'),(22,'Ballet',1,'Activo'),(23,'Hip-Hop',1,'Activo'),(24,'Ukelele',3,'Activo'),(27,'Break Dance',1,'Activo'),(28,'Violín',3,'Activo'),(34,'Ortografía',7,'Activo'),(37,'Caligrafía',7,'Activo'),(38,'Bajo',3,'Activo'),(40,'Comida Italiana',6,'Activo'),(41,'Poesia',7,'Activo');

/*Table structure for table `token` */

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_token_user_id_users_id` (`user_id`),
  CONSTRAINT `fk_token_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `token` */

insert  into `token`(`id`,`token`,`user_id`) values (6,'9IOGfzHMnV8jUALymgxB',28);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cell_phone` varchar(9) NOT NULL,
  `date_birth` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` enum('Femenino','Masculino') NOT NULL,
  `removed` enum('Activo','Eliminado') NOT NULL,
  `role` enum('Admin','Default') DEFAULT NULL,
  `student_rating` float DEFAULT NULL,
  `tutor_rating` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`last_name`,`email`,`password`,`cell_phone`,`date_birth`,`description`,`created_date`,`gender`,`removed`,`role`,`student_rating`,`tutor_rating`) values (1,'Jessica Edith','Paredes Alarcón','jessp.4997@gmail.com','123456','958690578','1997-09-04','Hola','2018-06-29 15:43:48','Femenino','Activo',NULL,4.3,4.7),(2,'Kevin','Robles','kevin0696@gmail.com','56789','959252653','1996-11-06','Hola','2018-06-29 17:47:44','Masculino','Activo',NULL,4.7,3.5),(3,'Ana','Suarez','ana@gmail.com','123','963852741','1996-05-05','','2018-06-30 02:18:03','Femenino','Activo',NULL,5,0),(12,'Vania','Montoya','montoyav@hotmail.com','prueba2','','0000-00-00','','2018-06-15 20:18:52','Femenino','Eliminado',NULL,NULL,NULL),(18,'Diego','Tapia','diegot@hotmail.com','aaa','','2000-05-30','','2018-06-16 03:57:47','Masculino','Activo',NULL,0,0),(19,'Joyce','Nuñez','joyce810@gmail.com','aquarium','912547896','0000-00-00','aa','2018-06-15 20:18:40','Femenino','Activo',NULL,4.5,0),(20,'Jessica','Paredes','paredesa.jessica@gmail.com','lifeline','958690578','1997-09-04','Administrador','2018-06-25 19:02:18','Femenino','Activo','Admin',0,0),(21,'Ariana','Paredes','ariana@gmail.com','bebe','','0000-00-00','','2018-06-14 13:51:05','Femenino','Activo',NULL,0,NULL),(28,'Kevin Arnold','Robles Rivera','kvn0696@gmail.com','candyshop','959252653','1996-11-06','Administrador','2018-06-27 14:02:36','Masculino','Activo','Admin',0,0),(29,'Sergio','Paredes','sergio11@hotmail.com','123456','959252542','2018-01-03','','2018-06-30 02:10:50','Masculino','Activo',NULL,NULL,NULL),(30,'Luis','Flores','luis@gmail.com','123','','1990-06-03','Hola soy luis','2018-06-30 03:48:55','Masculino','Activo',NULL,0,0);

/*Table structure for table `workshops` */

DROP TABLE IF EXISTS `workshops`;

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `vacancy` smallint(6) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `removed` enum('Activo','Eliminado') DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_workshops_user_id` (`user_id`),
  KEY `fk_workshops_category_id` (`category_id`),
  KEY `fk_workshops_subcategory_id_subcategories_id` (`subcategory_id`),
  KEY `fk_workshops_level_id_level_id` (`level_id`),
  CONSTRAINT `fk_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshops_level_id_level_id` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  CONSTRAINT `fk_workshops_subcategory_id_subcategories_id` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  CONSTRAINT `fk_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

/*Data for the table `workshops` */

insert  into `workshops`(`id`,`title`,`description`,`vacancy`,`amount`,`start_date`,`start_time`,`end_time`,`user_id`,`category_id`,`subcategory_id`,`removed`,`level_id`,`created_date`) values (1,'Clases de Guitarra','Buscamos 5 personas que quieran aprender a tocar guitarra.',2,100.00,'2018-07-24','20:00:00','22:00:00',1,3,10,'Activo',1,'2018-06-29 19:43:44'),(2,'Clase de Baile','Busco 10 personas que esten dispuestas a aprender clases de salsa en nivel intermedio.',7,50.00,'2018-06-25','08:00:00','09:00:00',2,1,1,'Activo',1,'2018-06-30 02:30:57'),(3,'Clase de Repostería','Personas interesadas a aprender como preparar postres postular al taller.',8,150.00,'2018-04-25','00:00:00','00:00:00',1,6,19,'Activo',3,'2018-05-25 14:58:04'),(4,'Clase de Batería','',3,40.00,'2018-06-26','18:00:00','20:00:00',2,3,11,'Activo',1,'2018-06-12 12:08:53'),(50,'Taller de Violín','Buscamos jóvenes que quieran aprender a tocar violín con un profesor con 10 años de trayectoria',10,30.00,'2018-04-25','00:00:00','00:00:00',2,3,28,'Activo',2,'2018-05-25 14:58:11'),(76,'Taller de Ukelele','2',2,2.00,'0000-00-00','00:00:00','00:00:00',2,3,24,'Activo',2,'2018-05-25 14:58:14'),(80,'Taller de Comida Oriental','Comida oriental',4,32.00,'2018-05-18','00:00:00','00:00:00',1,6,20,'Activo',2,'2018-05-25 14:58:18'),(81,'Taller de Voley','Buscamos personas que quieran aprender voley.',10,20.00,'2018-05-23','00:00:00','00:00:00',19,2,7,'Activo',2,'2018-05-25 14:58:30'),(82,'Taller de Guitarra Intermedio','',5,52.00,'2018-05-25','00:00:00','00:00:00',19,3,10,'Activo',2,'2018-05-26 02:46:58'),(83,'Taller de Guitarra Avanzado','aa',6,52.00,'2018-05-25','00:00:00','00:00:00',19,3,10,'Activo',3,'2018-05-26 02:47:01'),(84,'Clase de Teatro Basico','Buscamos 5 personas que quieran aprender teatro clown.',3,100.00,'2018-04-22','00:00:00','00:00:00',1,4,13,'Activo',1,'2018-05-26 02:49:33'),(85,'Clase de Teatro Avanzado','Interesados en aprender clown.',4,100.00,'2018-04-22','00:00:00','00:00:00',1,4,13,'Activo',3,'2018-05-26 02:49:24'),(92,'Clase de Repostería Basico','Personas interesadas a aprender como preparar postres postular al taller.',6,150.00,'2018-05-26','00:00:00','00:00:00',1,6,19,'Activo',1,'2018-05-26 06:25:41'),(93,'Clase de Repostería Intermedio','Personas interesadas a aprender como preparar postres postular al taller.',5,150.00,'2018-05-26','00:00:00','00:00:00',1,6,19,'Activo',2,'2018-05-26 06:26:06'),(94,'Ultimo taller creado','',4,36.00,'2018-07-01','09:00:00','11:00:00',2,1,1,'Activo',1,'2018-06-30 02:40:55'),(116,'Taller de Basket','Interesados en aprender basket comunicarse.',10,20.00,'2018-05-31','10:00:00','12:00:00',20,2,9,'Activo',2,'2018-05-29 00:28:57'),(117,'taller creado','',1,2.00,'2018-06-18','10:00:00','12:00:00',19,4,15,'Activo',1,'2018-06-11 19:37:26'),(118,'taller creado','',1,1.00,'0000-00-00','10:00:00','12:00:00',19,4,15,'Activo',1,'2018-05-29 12:10:53'),(119,'Clases de Bachata en la Tarde','',1,200.00,'2018-06-18','12:00:00','13:00:00',1,1,1,'Activo',1,'2018-06-16 03:40:42'),(122,'Taller de Hip-Hop','',2,50.00,'2018-06-18','14:00:00','18:00:00',1,1,23,'Activo',1,'2018-06-16 04:25:06'),(123,'Taller de Bajo','',3,20.00,'2018-06-12','18:00:00','20:00:00',1,3,38,'Activo',1,'2018-06-16 03:47:21'),(124,'Taller de Ballet','',6,50.00,'2018-06-30','12:00:00','13:00:00',1,1,1,'Activo',1,'2018-06-26 14:34:43'),(125,'Taller de Ballet','',5,60.00,'2018-06-30','12:00:00','13:00:00',2,1,1,'Activo',1,'2018-06-26 22:52:36'),(126,'Taller de Ballet','',5,60.00,'2018-06-30','12:00:00','13:00:00',2,1,1,'Activo',1,'2018-06-26 22:54:15'),(128,'Danza Balada','',8,25.00,'2018-06-30','12:00:00','13:00:00',2,1,4,'Activo',1,'2018-06-27 22:56:49'),(129,'Taller de Pintura en Degradado','',4,25.00,'2018-06-27','12:00:00','13:00:00',1,5,16,'Activo',1,'2018-06-28 13:06:31'),(130,'Taller de Ballet','',5,68.00,'2018-06-26','12:00:00','13:00:00',2,1,22,'Activo',1,'2018-06-27 15:58:12'),(131,'Taller de Voley','',5,20.00,'2018-07-01','08:00:00','11:00:00',1,2,7,'Activo',1,'2018-06-28 15:33:26'),(132,'Hola','',6,50.00,'2018-06-29','00:00:00','00:00:00',1,1,1,'Activo',1,'2018-06-29 01:22:01'),(133,'Hola','',6,50.00,'2018-01-05','00:00:00','00:00:00',1,1,1,'Activo',1,'2018-06-29 01:22:58'),(144,'Hola','',6,50.00,'2018-01-05','00:00:00','00:00:00',1,1,1,'Activo',1,'2018-06-29 01:32:36'),(224,'Clase de Break Dance','',5,50.00,'2018-07-05','12:00:00','16:00:00',1,1,27,'Activo',1,'2018-06-29 16:19:31'),(225,'xdf','',1,1.00,'2018-06-30','13:00:00','21:00:00',1,1,1,'Activo',1,'2018-06-29 18:42:20'),(227,'Taller de Bajo Matutino','',5,26.00,'2018-07-14','12:00:00','13:00:00',1,3,38,'Activo',1,'2018-06-30 04:04:00'),(228,'Taller de Hip Hop','',5,15.00,'2018-07-07','12:00:00','13:00:00',1,1,23,'Activo',1,'2018-06-30 03:24:03'),(229,'Taller de Guitarra','',6,32.00,'2018-07-07','12:00:00','15:00:00',30,3,10,'Activo',1,'2018-06-30 03:50:52'),(230,'Clase de Clown','',3,33.00,'2018-06-29','12:00:00','13:00:00',1,4,13,'Activo',1,'2018-06-30 04:11:15');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
