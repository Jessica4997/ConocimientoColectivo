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
  `id` int(11) NOT NULL,
  `cultural_theme` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`cultural_theme`) values (1,'Musica');

/*Table structure for table `cultural_theme` */

DROP TABLE IF EXISTS `cultural_theme`;

CREATE TABLE `cultural_theme` (
  `id` int(11) NOT NULL,
  `description` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cultural_theme_category_id` (`category_id`),
  CONSTRAINT `fk_cultural_theme_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `cultural_theme` */

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `final_rating` int(11) DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `wrks_id` int(11) DEFAULT NULL,
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
  `user_id` int(11) DEFAULT NULL,
  `wrks_id` int(11) DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `amount` decimal(4,2) NOT NULL,
  `pay_status` enum('Pagado','No pagado') COLLATE utf8_spanish2_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `dsct_id` int(11) DEFAULT NULL,
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
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pw_id` int(11) DEFAULT NULL,
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
  `pw_status` enum('Activo','Inactivo') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
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
  `user_id` int(11) NOT NULL,
  `role` enum('Alumno','Docente') COLLATE utf8_spanish2_ci NOT NULL,
  `final_rating` float DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role`),
  CONSTRAINT `fk_ratings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `ratings` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `cell_phone` varchar(9) NOT NULL,
  `phone` varchar(7) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`last_name`,`email`,`password`,`cell_phone`,`phone`,`date_birth`,`description`,`created_date`) values (1,'Jessica','Paredes','jesi@gmail.com','123456','987654321','456123','1990-04-15','mujer de a pie','2018-04-15 06:17:38');

/*Table structure for table `workshops` */

DROP TABLE IF EXISTS `workshops`;

CREATE TABLE `workshops` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `final_date` datetime NOT NULL,
  `level` enum('Basico','Intermedio','Avanzado') NOT NULL,
  `wrks_status` enum('En curso','Cancelado','Finalizado') NOT NULL,
  `created_date` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workshops_user_id` (`user_id`),
  KEY `fk_workshops_category_id` (`category_id`),
  CONSTRAINT `fk_workshops_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshops_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `workshops` */

insert  into `workshops`(`id`,`amount`,`start_date`,`final_date`,`level`,`wrks_status`,`created_date`,`user_id`,`category_id`,`title`) values (1,'100.00','2018-04-22 06:20:37','2018-04-22 06:20:27','Basico','En curso','2018-04-15 06:20:16',1,1,'Clase de Guitar Hero'),(2,'50.00','2018-04-21 06:39:35','2018-04-25 06:39:40','Intermedio','En curso','2018-04-15 06:39:52',1,1,'Clase de BAILE');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
