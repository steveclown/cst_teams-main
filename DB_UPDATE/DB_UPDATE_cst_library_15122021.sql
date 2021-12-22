/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.21-MariaDB : Database - cst_library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cst_library` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cst_library`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values 
('9v2tf5f9kvbck3i1t0gog6psn278es89','::1',1639549895,'__ci_last_regenerate|i:1639549895;'),
('078pif39jg3uhb290vfiid86dfpubemd','::1',1639549936,'__ci_last_regenerate|i:1639549895;auth|a:5:{s:7:\"user_id\";s:3:\"290\";s:8:\"username\";s:13:\"administrator\";s:9:\"clinic_id\";s:1:\"1\";s:16:\"user_group_level\";s:1:\"1\";s:10:\"user_level\";s:1:\"0\";}');

/*Table structure for table `core_book` */

DROP TABLE IF EXISTS `core_book`;

CREATE TABLE `core_book` (
  `book_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `book_category_id` int(10) DEFAULT 0,
  `shelf_id` int(10) DEFAULT 0,
  `book_code` varchar(50) DEFAULT '',
  `book_title` varchar(250) DEFAULT '',
  `book_author` varchar(250) DEFAULT '',
  `book_publication` varchar(250) DEFAULT '',
  `book_publication_year` int(10) DEFAULT 0,
  `book_photo` varchar(250) DEFAULT '',
  `book_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`book_id`),
  KEY `book_token` (`book_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`),
  KEY `FK_core_book_book_category_id` (`book_category_id`),
  KEY `FK_core_book_shelf_id` (`shelf_id`),
  CONSTRAINT `FK_core_book_book_category_id` FOREIGN KEY (`book_category_id`) REFERENCES `core_book_category` (`book_category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_book_shelf_id` FOREIGN KEY (`shelf_id`) REFERENCES `core_shelf` (`shelf_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_book` */

/*Table structure for table `core_book_category` */

DROP TABLE IF EXISTS `core_book_category`;

CREATE TABLE `core_book_category` (
  `book_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `book_category_code` varchar(50) DEFAULT '',
  `book_category_name` varchar(250) DEFAULT '',
  `book_category_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`book_category_id`),
  KEY `book_category_token` (`book_category_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_book_category` */

/*Table structure for table `core_clinic` */

DROP TABLE IF EXISTS `core_clinic`;

CREATE TABLE `core_clinic` (
  `clinic_id` int(10) NOT NULL AUTO_INCREMENT,
  `clinic_code` varchar(20) DEFAULT '',
  `clinic_name` varchar(250) DEFAULT '',
  `clinic_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`clinic_id`),
  KEY `clinic_token` (`clinic_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `core_clinic` */

insert  into `core_clinic`(`clinic_id`,`clinic_code`,`clinic_name`,`clinic_token`,`data_state`,`created_id`,`created_on`,`updated_id`,`updated_on`,`deleted_id`,`deleted_on`,`last_update`) values 
(1,'PLDF','Pelayanan Pendaftaran','79af6a8d1d45106a4b95aa86ac859887',0,2,'2021-09-25 12:43:00',1,'2021-10-05 14:53:57',0,NULL,'2021-09-25 12:43:00'),
(2,'fgh','fghfg','f3c90effc0a38de44de936588312e764',2,2,'2021-09-25 12:49:55',0,NULL,2,'2021-09-25 12:49:59','2021-09-25 12:49:55'),
(3,'PLUM','Pelayanan Umum','928cab54b173c7005b25ac31b7a2e0f5',0,1,'2021-10-05 14:54:09',0,NULL,0,NULL,'2021-10-05 14:54:09'),
(4,'PLGM','Pelayanan Gigi dan Mulut','4625cd041d223e4ade15dda89a5c42fd',0,1,'2021-10-05 14:54:19',0,NULL,0,NULL,'2021-10-05 14:54:19'),
(5,'PLIA','Pelayanan Ibu dan Anak','26f2c59d829e44f4be72aeb63cb74a5a',0,1,'2021-10-05 14:54:27',0,NULL,0,NULL,'2021-10-05 14:54:27'),
(6,'PLLB','Pelayanan Laboratorium','1061bf9d0dd49dba5b657b878e819504',0,1,'2021-10-05 14:54:37',0,NULL,0,NULL,'2021-10-05 14:54:37'),
(7,'PLFM','Pelayanan Farmasi','1f9578c42b816c339642b00d24f7f601',0,1,'2021-10-05 14:54:44',0,NULL,0,NULL,'2021-10-05 14:54:44');

/*Table structure for table `core_member` */

DROP TABLE IF EXISTS `core_member`;

CREATE TABLE `core_member` (
  `member_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `member_code` varchar(50) DEFAULT '',
  `member_name` varchar(250) DEFAULT '',
  `member_gender` int(1) DEFAULT 0,
  `member_major` varchar(250) DEFAULT '' COMMENT 'Jurusan',
  `member_address` text DEFAULT NULL,
  `member_status` int(1) DEFAULT 1 COMMENT '1 : Aktif, 0 : Tidak Aktif, 9 : Blacklist',
  `member_photo` varchar(250) DEFAULT '',
  `member_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`member_id`),
  KEY `member_token` (`member_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_member` */

/*Table structure for table `core_shelf` */

DROP TABLE IF EXISTS `core_shelf`;

CREATE TABLE `core_shelf` (
  `shelf_id` int(10) NOT NULL AUTO_INCREMENT,
  `shelf_code` varchar(20) DEFAULT '',
  `shelf_name` varchar(250) DEFAULT '',
  `shelf_remark` text DEFAULT NULL,
  `shelf_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shelf_id`),
  KEY `shelf_token` (`shelf_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_shelf` */

/*Table structure for table `preference_company` */

DROP TABLE IF EXISTS `preference_company`;

CREATE TABLE `preference_company` (
  `company_id` int(10) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT '',
  `company_address` text DEFAULT NULL,
  `company_home_phone1` varchar(30) DEFAULT '',
  `company_home_phone2` varchar(30) DEFAULT '',
  `company_fax_number` varchar(30) DEFAULT '',
  `company_logo` varchar(200) DEFAULT '',
  `company_slogan` varchar(250) DEFAULT '',
  `company_footer` text DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `preference_company` */

insert  into `preference_company`(`company_id`,`company_name`,`company_address`,`company_home_phone1`,`company_home_phone2`,`company_fax_number`,`company_logo`,`company_slogan`,`company_footer`,`last_update`) values 
(1,'Puskesmas Purwosari','Purwosari Laweyan Surakarta','0271','','','','ANDA SEHAT, KAMI BAHAGIA ','Tetap lakukan Prokes 5M : Mencuci Tangan, Memakai Masker, Menjaga Jarak, Menjauhi Kerumunan, Mengurangi Mobilitas','2021-08-23 19:05:20');

/*Table structure for table `system_activity_log` */

DROP TABLE IF EXISTS `system_activity_log`;

CREATE TABLE `system_activity_log` (
  `user_log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT 0,
  `transaction_id` bigint(22) DEFAULT 0,
  `transaction_code` int(10) DEFAULT 0,
  `transaction_name` varchar(250) DEFAULT '',
  `transaction_remark` varchar(250) DEFAULT '',
  `transaction_date` date DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_log_id`),
  KEY `user_id` (`user_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `transaction_code` (`transaction_code`),
  KEY `transaction_date` (`transaction_date`)
) ENGINE=InnoDB AUTO_INCREMENT=636 DEFAULT CHARSET=latin1;

/*Data for the table `system_activity_log` */

insert  into `system_activity_log`(`user_log_id`,`user_id`,`transaction_id`,`transaction_code`,`transaction_name`,`transaction_remark`,`transaction_date`,`created_on`) values 
(633,290,0,1001,'Application.ValidationProcess.verifikasi','administrator','2021-12-15','2021-12-15 13:25:31'),
(634,290,0,1001,'Application.ValidationProcess.verifikasi','administrator','2021-12-15','2021-12-15 13:26:03'),
(635,290,0,1001,'Application.ValidationProcess.verifikasi','administrator','2021-12-15','2021-12-15 13:31:48');

/*Table structure for table `system_change_log` */

DROP TABLE IF EXISTS `system_change_log`;

CREATE TABLE `system_change_log` (
  `change_log_id` int(11) NOT NULL DEFAULT 0,
  `user_log_id` int(11) DEFAULT NULL,
  `kode` varchar(15) DEFAULT NULL,
  `old_data` mediumtext DEFAULT NULL,
  `new_data` mediumtext DEFAULT NULL,
  `log_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`change_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `system_change_log` */

/*Table structure for table `system_log_user` */

DROP TABLE IF EXISTS `system_log_user`;

CREATE TABLE `system_log_user` (
  `user_log_id` bigint(20) NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `username` varchar(50) DEFAULT '',
  `id_previllage` int(4) DEFAULT 0,
  `log_stat` enum('0','1') DEFAULT NULL,
  `class_name` varchar(250) DEFAULT '',
  `pk` varchar(20) DEFAULT '',
  `remark` varchar(50) DEFAULT '',
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_log_id`),
  KEY `FK_system_log_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `system_log_user` */

/*Table structure for table `system_menu` */

DROP TABLE IF EXISTS `system_menu`;

CREATE TABLE `system_menu` (
  `id_menu` varchar(10) NOT NULL,
  `id` varchar(100) DEFAULT NULL,
  `type` enum('folder','file','function') DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `system_menu` */

insert  into `system_menu`(`id_menu`,`id`,`type`,`text`,`image`,`last_update`) values 
('1','mainpage','file','Home','','2021-08-12 20:47:04'),
('2','#','folder','Setting',NULL,'2021-09-30 12:14:19'),
('21','#','folder','Master Data',NULL,'2021-09-30 12:14:28'),
('211','clinic','file','Data Klinik',NULL,'2021-09-30 12:14:38'),
('A','#','folder','Preference',NULL,'2021-08-06 05:24:50'),
('A1','#','folder','Set Up Data',NULL,'2021-08-06 05:24:51'),
('A11','user-group','file','User Group',NULL,'2021-08-31 23:20:45'),
('A12','user','file','User',NULL,'2021-08-06 05:24:52'),
('A2','#','folder','Preference',NULL,'2021-08-06 05:24:53'),
('A21','company','file','Data Company',NULL,'2021-09-30 12:15:34');

/*Table structure for table `system_menu_mapping` */

DROP TABLE IF EXISTS `system_menu_mapping`;

CREATE TABLE `system_menu_mapping` (
  `user_group_level` int(3) NOT NULL,
  `id_menu` varchar(10) NOT NULL,
  PRIMARY KEY (`user_group_level`,`id_menu`),
  KEY `FK_system_menu_mapping` (`id_menu`) USING BTREE,
  CONSTRAINT `system_menu_mapping_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `system_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `system_menu_mapping_user_group_level` FOREIGN KEY (`user_group_level`) REFERENCES `system_user_group` (`user_group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `system_menu_mapping` */

insert  into `system_menu_mapping`(`user_group_level`,`id_menu`) values 
(1,'1'),
(1,'211'),
(1,'A11'),
(1,'A12'),
(1,'A21'),
(2,'1'),
(3,'1'),
(3,'211');

/*Table structure for table `system_user` */

DROP TABLE IF EXISTS `system_user`;

CREATE TABLE `system_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) DEFAULT 0,
  `clinic_id` int(10) DEFAULT 0,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT '',
  `password` varchar(50) CHARACTER SET latin1 DEFAULT '',
  `log_state` int(1) DEFAULT 0,
  `user_level` int(1) DEFAULT 0,
  `user_status` int(1) DEFAULT 1,
  `user_token` varchar(250) CHARACTER SET latin1 DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  KEY `FK_system_user` (`user_group_id`),
  KEY `FK_system_user_region_id` (`clinic_id`),
  KEY `user_token` (`user_token`),
  CONSTRAINT `FK_system_user_user_group_id` FOREIGN KEY (`user_group_id`) REFERENCES `system_user_group` (`user_group_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8;

/*Data for the table `system_user` */

insert  into `system_user`(`user_id`,`user_group_id`,`clinic_id`,`username`,`password`,`log_state`,`user_level`,`user_status`,`user_token`,`data_state`,`created_id`,`created_on`,`updated_id`,`updated_on`,`deleted_id`,`deleted_on`,`last_update`) values 
(283,2,1,'daftar','9c4173885e4dac91d08f3198cd1bbaab',0,0,1,'f3d46fba8d14c5c1ffddf034b309799a',0,1,'2021-10-05 15:15:34',1,'2021-10-05 15:16:41',0,NULL,'2021-10-08 16:37:54'),
(284,2,3,'umum','f5df3bde70b7b7ab67ce0e00edcb1951',0,0,1,'88e196cbffe7eb4f619c48906b4925c4',0,1,'2021-10-05 15:16:53',0,NULL,0,NULL,'2021-10-05 15:16:53'),
(285,2,4,'gigimulut','2cd5b72e73fc7ae067088caf07f81b50',0,0,1,'1eec86b01bf6d02672ee3f5b09f47e37',0,1,'2021-10-05 15:17:07',0,NULL,0,NULL,'2021-10-05 15:17:07'),
(286,2,5,'ibuanak','685bb3ad20db8e76c4d9c68bf7f46eaa',0,0,1,'60779eb99b25e4d73773d3760fe2475a',0,1,'2021-10-05 15:17:15',0,NULL,0,NULL,'2021-10-05 15:17:15'),
(287,2,6,'laboratorium','1cb0e7cc093be6fa2680fce26874befc',0,0,1,'dad3a032fcd107775daf2c59417e21f4',0,1,'2021-10-05 15:17:26',0,NULL,0,NULL,'2021-10-05 15:17:26'),
(288,2,7,'farmasi','411c62084e9108ed2aab339b7411ac97',0,0,1,'78b983dbc5abf71df53251e506de6428',0,1,'2021-10-05 15:17:33',0,NULL,0,NULL,'2021-10-05 15:17:33'),
(290,1,1,'administrator','e10adc3949ba59abbe56e057f20f883e',1,0,1,'',0,1,'2021-10-08 16:39:11',0,NULL,0,NULL,'2021-12-15 13:31:48'),
(291,3,0,'admin','0192023a7bbd73250516f069df18b500',1,0,1,'ae16e885f912e41af2da144ddc4a8d3a',0,290,'2021-10-08 16:42:46',0,NULL,0,NULL,'2021-10-08 16:42:51');

/*Table structure for table `system_user_group` */

DROP TABLE IF EXISTS `system_user_group`;

CREATE TABLE `system_user_group` (
  `user_group_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_group_level` int(11) DEFAULT NULL,
  `user_group_name` varchar(50) DEFAULT NULL,
  `data_state` int(1) DEFAULT 0,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `system_user_group` */

insert  into `system_user_group`(`user_group_id`,`user_group_level`,`user_group_name`,`data_state`,`last_update`) values 
(1,1,'Administrator',0,'2021-08-28 18:05:32'),
(2,2,'User',0,'2021-10-05 15:00:51'),
(3,3,'admin',0,'2021-10-08 16:42:13');

/* Function  structure for function  `getNewUserGroupID` */

/*!50003 DROP FUNCTION IF EXISTS `getNewUserGroupID` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNewUserGroupID`() RETURNS int(11)
BEGIN
	DECLARE prev_id INT;
	DECLARE next_id INT;
	SELECT user_group_id INTO prev_id FROM system_user_group ORDER BY user_group_id DESC LIMIT 0,1;
	IF prev_id IS NULL THEN
		SET prev_id = 0;
	END IF;
	SET next_id = prev_id + 1;
	RETURN next_id;
END */$$
DELIMITER ;

/* Function  structure for function  `getNewUserLogId` */

/*!50003 DROP FUNCTION IF EXISTS `getNewUserLogId` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNewUserLogId`() RETURNS int(11)
BEGIN
	DECLARE prev_id INT;
	DECLARE next_id INT;
	SELECT user_log_id INTO prev_id FROM system_log_user ORDER BY user_log_id DESC LIMIT 0,1;
	IF prev_id IS NULL THEN
		SET prev_id = 0;
	END IF;
	SET next_id = prev_id + 1;
	RETURN next_id;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
