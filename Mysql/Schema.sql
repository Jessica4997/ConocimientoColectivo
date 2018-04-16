/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.31-MariaDB : Database - db_cc_v2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cc_v2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

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
  `created_date` datetime NOT NULL,
  `pw_status` enum('Activo','Inactivo','Borrado') NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proposed_workshops_user_id` (`user_id`),
  KEY `fk_proposed_workshops_category_id` (`category_id`),
  CONSTRAINT `fk_proposed_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proposed_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `proposed_workshops` */

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('Alumno','Docente') COLLATE utf8_spanish2_ci NOT NULL,
  `final_rating` float DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`last_name`,`email`,`password`,`cell_phone`,`phone`,`date_birth`,`description`,`status`,`created_date`,`gender`) values (1,'Jessica','Paredes','jessp.4997@gmail.com','123456','987654321','456123','1997-09-04','sadasdsad','Confirmado','2018-04-15 06:17:38','Femenino'),(2,'Kevin','Robles','kevin0696@gmail.com','56987','963852741','456123','1996-11-06','fdgdfgdg','Sin Confirmar','0000-00-00 00:00:00','Femenino');

/*Table structure for table `workshops` */

DROP TABLE IF EXISTS `workshops`;

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `final_date` datetime NOT NULL,
  `level` enum('Basico','Intermedio','Avanzado') NOT NULL,
  `wrks_status` enum('En curso','Cancelado','Finalizado') NOT NULL,
  `created_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `vacancy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workshops_user_id` (`user_id`),
  KEY `fk_workshops_category_id` (`category_id`),
  CONSTRAINT `fk_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `workshops` */

insert  into `workshops`(`id`,`amount`,`start_date`,`final_date`,`level`,`wrks_status`,`created_date`,`user_id`,`category_id`,`title`,`description`,`vacancy`) values (1,'100.00','2018-04-22 06:20:37','2018-04-22 06:20:27','Basico','En curso','2018-04-15 06:20:16',1,3,'Clase de Guitarra','Buscamos 5 personas que quieran aprender a tocar guitarra',5),(2,'50.00','2018-04-21 06:39:35','2018-04-25 06:39:40','Intermedio','En curso','2018-04-15 06:39:52',2,1,'Clase de Baile','Busco 10 personas que esten dispuestas a aprender clases de salsa en nivel intermedio',10),(3,'150.00','2018-04-25 12:49:25','2018-04-28 12:49:33','Avanzado','En curso','2018-04-15 12:49:54',1,6,'Clase de Repostería','',8),(6,'40.00','2018-04-22 12:51:23','2018-04-23 12:51:58','Intermedio','En curso','2018-04-15 12:52:18',2,3,'Clase de Batería','',0),(11,'120.00','0000-00-00 00:00:00','0000-00-00 00:00:00','Basico','En curso','0000-00-00 00:00:00',2,1,'wadawdad','',5),(12,'120.00','0000-00-00 00:00:00','0000-00-00 00:00:00','Avanzado','En curso','0000-00-00 00:00:00',2,1,'Taller de Bachata','Animense a entrar a clases de bachata.',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
