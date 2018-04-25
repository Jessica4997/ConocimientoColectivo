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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`parent_id`) values (1,'Bailes',NULL),(2,'Deportes',NULL),(3,'Música',NULL),(4,'Teatro',NULL),(5,'Arte',NULL),(6,'Gastronomía',NULL);

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
  `created_date` datetime NOT NULL,
  `iu_status` enum('Confirmado','No confirmado') NOT NULL,
  `student_rating` float DEFAULT NULL,
  `tutor_rating` float DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `wrks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscribed_users_user_id` (`user_id`),
  KEY `fk_inscribed_users_wrks_id` (`wrks_id`),
  CONSTRAINT `fk_inscribed_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscribed_users_wrks_id` FOREIGN KEY (`wrks_id`) REFERENCES `workshops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `inscribed_users` */

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

/*Table structure for table `proposed_workshops` */

DROP TABLE IF EXISTS `proposed_workshops`;

CREATE TABLE `proposed_workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `final_date` datetime DEFAULT NULL,
  `level` enum('Básico','Intermedio','Avanzado') DEFAULT NULL,
  `pw_status` enum('Activo','Inactivo','Borrado') NOT NULL,
  `created_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proposed_workshops_user_id` (`user_id`),
  KEY `fk_proposed_workshops_category_id` (`category_id`),
  CONSTRAINT `fk_proposed_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proposed_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `proposed_workshops` */

insert  into `proposed_workshops`(`id`,`title`,`description`,`start_date`,`final_date`,`level`,`pw_status`,`created_date`,`user_id`,`category_id`) values (1,'Taller de Hip-Hop','Somos 5 chicos que deseamos la apertura de un taller de música urbana para el miércoles 25 de abril.','2018-04-25 14:00:00','2018-04-25 17:00:00','Básico','Activo','2018-04-25 08:03:19',2,1),(2,'Taller de Ukelele','Buscamos a una persona que nos dicte clases de ukelele','2018-04-26 12:00:00','2018-04-26 14:00:00','Intermedio','Activo','2018-04-25 12:25:01',1,3),(3,'Taller de Pintura','Necesitamos un profesor que nos enseñe como pintar en degradado','2018-04-25 18:00:00','2018-04-25 20:00:00','Avanzado','Activo','2018-04-25 12:26:34',3,5),(6,'Taller de Ballet','Buscamos a una profesora que nos enseñe clases de ballet para una presentación','2018-04-25 08:00:00','2018-04-25 09:30:00','Intermedio','Activo','0000-00-00 00:00:00',2,1);

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

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cell_phone` varchar(9) NOT NULL,
  `phone` varchar(7) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` enum('Sin Confirmar','Confirmado','Baneado') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `gender` enum('Femenino','Masculino') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`last_name`,`email`,`password`,`cell_phone`,`phone`,`date_birth`,`description`,`status`,`created_date`,`gender`) values (1,'Jessica','Paredes','jessp.4997@gmail.com','123456','987654321','456123','1997-09-04','sadasdsad','Confirmado','2018-04-15 06:17:38','Femenino'),(2,'Kevin','Robles','kevin0696@gmail.com','56987','963852741','456123','1996-11-06','fdgdfgdg','Sin Confirmar','0000-00-00 00:00:00','Femenino'),(3,'Ana','Suarez','ana@gmail.com','123','963852741','7894256','0000-00-00','sadsada','Sin Confirmar','0000-00-00 00:00:00','Femenino'),(4,'','','','','','','0000-00-00','','Sin Confirmar','0000-00-00 00:00:00',''),(5,'/','/','z@g','/','','','0000-00-00','','Sin Confirmar','0000-00-00 00:00:00',''),(6,'/','/','z@g','asd','','','0000-00-00','','Confirmado','0000-00-00 00:00:00',''),(7,'ASD','ASD','ASD@G','SAD','','','1984-03-16','','Confirmado','0000-00-00 00:00:00','Masculino');

/*Table structure for table `workshops` */

DROP TABLE IF EXISTS `workshops`;

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `vacancy` smallint(6) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `final_date` datetime NOT NULL,
  `level` enum('Básico','Intermedio','Avanzado') NOT NULL,
  `wrks_status` enum('En curso','Cancelado','Finalizado') DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workshops_user_id` (`user_id`),
  KEY `fk_workshops_category_id` (`category_id`),
  CONSTRAINT `fk_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `workshops` */

insert  into `workshops`(`id`,`title`,`description`,`vacancy`,`amount`,`start_date`,`final_date`,`level`,`wrks_status`,`created_date`,`user_id`,`category_id`) values (1,'Clase de Guitarra','Buscamos 5 personas que quieran aprender a tocar guitarra.',5,100.00,'2018-04-22 06:20:37','2018-04-22 06:20:27','Básico','En curso','2018-04-15 06:20:16',1,3),(2,'Clase de Baile','Busco 10 personas que esten dispuestas a aprender clases de salsa en nivel intermedio.',10,50.00,'2018-04-21 06:39:35','2018-04-25 06:39:40','Intermedio','En curso','2018-04-15 06:39:52',2,1),(3,'Clase de Repostería','Personas interesadas a aprender como preparar postres postular al taller.',8,150.00,'2018-04-25 12:49:25','2018-04-28 12:49:33','Avanzado','En curso','2018-04-15 12:49:54',1,6),(4,'Clase de Batería','',3,40.00,'2018-04-22 12:51:23','2018-04-23 12:51:58','Intermedio','En curso','2018-04-15 12:52:18',2,3),(34,'wadawdad','',5,120.00,'2020-04-04 16:01:00','2020-02-03 13:00:00','Básico','En curso','0000-00-00 00:00:00',2,1),(35,'dd','',4,55.00,'2018-04-21 08:00:00','2017-04-21 08:30:00','Básico','En curso','0000-00-00 00:00:00',2,1),(36,'dd','',4,55.00,'2018-04-21 08:00:00','2017-04-21 08:30:00','Básico','En curso','0000-00-00 00:00:00',2,1),(45,'d','1',1,1.00,'0001-01-01 01:01:00','0001-01-01 01:01:00','Básico','En curso','0000-00-00 00:00:00',2,2),(47,'ui','j',1,1.00,'2018-04-01 01:01:00','2018-04-10 01:01:00','Intermedio','En curso','0000-00-00 00:00:00',2,1),(48,'sss','q',2,2.00,'4555-03-02 05:55:00','0454-05-05 04:05:00','Básico','En curso','0000-00-00 00:00:00',2,2),(49,'gfrsd','sd',2,2.00,'0001-01-01 01:01:00','0001-01-01 01:01:00','Básico','En curso','0000-00-00 00:00:00',2,3),(50,'Taller de Violín','Buscamos jóvenes que quieran aprender a tocar violín con un profesor con 10 años de trayectoria',10,30.00,'2018-04-25 17:00:00','2018-04-25 18:30:00','Intermedio','En curso','0000-00-00 00:00:00',2,3),(53,'aasdasdasdasdasdasdasdasd','qssss',3,22.00,'0001-01-01 01:01:00','0001-01-01 01:01:00','Básico','En curso','0000-00-00 00:00:00',2,5),(54,'aa','1',1,1.00,'0003-03-02 04:04:00','0001-01-01 01:01:00','Básico','En curso','0000-00-00 00:00:00',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
