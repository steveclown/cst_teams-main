/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.21-MariaDB : Database - cst_teams
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cst_teams` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cst_teams`;

/*Table structure for table `assignment_business_trip` */

DROP TABLE IF EXISTS `assignment_business_trip`;

CREATE TABLE `assignment_business_trip` (
  `business_trip_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `overtime_rate_id` int(10) DEFAULT 0,
  `business_trip_date` date DEFAULT NULL,
  `business_trip_start_date` date DEFAULT NULL,
  `business_trip_end_date` date DEFAULT NULL,
  `business_trip_purpose` varchar(250) DEFAULT '',
  `business_trip_remark` text DEFAULT NULL,
  `business_trip_status` decimal(1,0) DEFAULT 0,
  `approved` decimal(1,0) DEFAULT 0,
  `approved_id` int(10) DEFAULT 0,
  `approved_on` datetime DEFAULT NULL,
  `approved_remark` text DEFAULT NULL,
  `returned` decimal(1,0) DEFAULT 0,
  `returned_id` int(10) DEFAULT 0,
  `returned_on` datetime DEFAULT NULL,
  `returned_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_id`),
  KEY `FK_assignment_business_trip_employee_id` (`employee_id`),
  KEY `FK_assignment_business_trip_region_id` (`region_id`),
  KEY `FK_assignment_business_trip_branch_id` (`branch_id`),
  KEY `FK_assignment_business_trip_location_id` (`location_id`),
  KEY `FK_assignment_business_trip_division_id` (`division_id`),
  KEY `FK_assignment_business_trip_department_id` (`department_id`),
  KEY `FK_assignment_business_trip_section_id` (`section_id`),
  KEY `FK_assignment_business_trip_job_title_id` (`job_title_id`),
  KEY `FK_assignment_business_trip_overtime_rate_id` (`overtime_rate_id`),
  CONSTRAINT `FK_assignment_business_trip_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_overtime_rate_id` FOREIGN KEY (`overtime_rate_id`) REFERENCES `assignment_overtime_rate` (`overtime_rate_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_business_trip` */

/*Table structure for table `assignment_business_trip_allowance` */

DROP TABLE IF EXISTS `assignment_business_trip_allowance`;

CREATE TABLE `assignment_business_trip_allowance` (
  `business_trip_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `business_trip_id` bigint(22) DEFAULT 0,
  `overtime_rate_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `business_trip_allowance_amount` decimal(10,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_allowance_id`),
  KEY `FK_assignment_business_trip_allowance_business_trip_id` (`business_trip_id`),
  KEY `FK_assignment_business_trip_allowance_overtime_rate_id` (`overtime_rate_id`),
  KEY `FK_assignment_business_trip_allowance_job_title_id` (`job_title_id`),
  KEY `Fk_assignment_business_trip_allowance_allowance_id` (`allowance_id`),
  CONSTRAINT `FK_assignment_business_trip_allowance_business_trip_id` FOREIGN KEY (`business_trip_id`) REFERENCES `assignment_business_trip` (`business_trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_allowance_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_allowance_overtime_rate_id` FOREIGN KEY (`overtime_rate_id`) REFERENCES `assignment_overtime_rate` (`overtime_rate_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Fk_assignment_business_trip_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_business_trip_allowance` */

/*Table structure for table `assignment_business_trip_cost` */

DROP TABLE IF EXISTS `assignment_business_trip_cost`;

CREATE TABLE `assignment_business_trip_cost` (
  `business_trip_cost_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `business_trip_id` bigint(22) DEFAULT 0,
  `cost_budget_id` int(10) DEFAULT 0,
  `business_trip_cost_amount` decimal(20,2) DEFAULT 0.00,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_cost_id`),
  KEY `FK_assignment_business_trip_cost_cost_budget_id` (`cost_budget_id`),
  KEY `FK_assignment_business_trip_cost_business_trip_id` (`business_trip_id`),
  CONSTRAINT `FK_assignment_business_trip_cost_business_trip_id` FOREIGN KEY (`business_trip_id`) REFERENCES `assignment_business_trip` (`business_trip_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_cost_cost_budget_id` FOREIGN KEY (`cost_budget_id`) REFERENCES `core_cost_budget` (`cost_budget_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_business_trip_cost` */

/*Table structure for table `assignment_business_trip_employee` */

DROP TABLE IF EXISTS `assignment_business_trip_employee`;

CREATE TABLE `assignment_business_trip_employee` (
  `business_trip_employee_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `business_trip_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `overtime_rate_title_id` int(10) DEFAULT 0,
  `overtime_rate_allowance_amount` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_employee_id`),
  KEY `FK_assignment_business_trip_employee_employee_id` (`employee_id`),
  KEY `FK_assignment_business_trip_employee_region_id` (`region_id`),
  KEY `FK_assignment_business_trip_employee_branch_id` (`branch_id`),
  KEY `FK_assignment_business_trip_employee_location_id` (`location_id`),
  KEY `FK_assignment_business_trip_employee_division_id` (`division_id`),
  KEY `FK_assignment_business_trip_employee_department_id` (`department_id`),
  KEY `FK_assignment_business_trip_employee_section_id` (`section_id`),
  KEY `FK_assignment_business_trip_employee_job_title_id` (`job_title_id`),
  CONSTRAINT `FK_assignment_business_trip_employee_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_business_trip_employee_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_business_trip_employee` */

/*Table structure for table `assignment_loading_cost` */

DROP TABLE IF EXISTS `assignment_loading_cost`;

CREATE TABLE `assignment_loading_cost` (
  `loading_cost_id` int(10) NOT NULL AUTO_INCREMENT,
  `loading_cost_min_quantity` decimal(10,0) DEFAULT 0,
  `loading_cost_max_quantity` decimal(10,0) DEFAULT 0,
  `loading_cost_amount` decimal(10,0) DEFAULT 0,
  `loading_cost_effective_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`loading_cost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_loading_cost` */

/*Table structure for table `assignment_loading_cost_customer` */

DROP TABLE IF EXISTS `assignment_loading_cost_customer`;

CREATE TABLE `assignment_loading_cost_customer` (
  `loading_cost_customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(22) DEFAULT 0,
  `loading_cost_customer_min_quantity` decimal(10,0) DEFAULT 0,
  `loading_cost_customer_max_quantity` decimal(10,0) DEFAULT 0,
  `loading_cost_customer_amount` decimal(10,0) DEFAULT 0,
  `loading_cost_customer_effective_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`loading_cost_customer_id`),
  KEY `FK_assignment_loading_cost_customer_customer_id` (`customer_id`),
  CONSTRAINT `FK_assignment_loading_cost_customer_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `core_customer` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_loading_cost_customer` */

/*Table structure for table `assignment_overtime_rate` */

DROP TABLE IF EXISTS `assignment_overtime_rate`;

CREATE TABLE `assignment_overtime_rate` (
  `overtime_rate_id` int(10) NOT NULL AUTO_INCREMENT,
  `zone_id` int(10) DEFAULT 0,
  `overtime_rate_description` varchar(250) DEFAULT '',
  `overtime_rate_effective_date` date DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_id` int(10) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_rate_id`),
  KEY `FK_assignment_overtime_rate_zone_id` (`zone_id`),
  CONSTRAINT `FK_assignment_overtime_rate_zone_id` FOREIGN KEY (`zone_id`) REFERENCES `core_zone` (`zone_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_overtime_rate` */

/*Table structure for table `assignment_overtime_rate_title` */

DROP TABLE IF EXISTS `assignment_overtime_rate_title`;

CREATE TABLE `assignment_overtime_rate_title` (
  `overtime_rate_title_id` int(10) NOT NULL AUTO_INCREMENT,
  `overtime_rate_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `overtime_rate_allowance_amount` decimal(10,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_rate_title_id`),
  KEY `FK_assignment_overtime_rate_title_division_id` (`division_id`),
  KEY `FK_assignment_overtime_rate_title_department_id` (`department_id`),
  KEY `FK_assignment_overtime_rate_title_section_id` (`section_id`),
  KEY `FK_assignment_overtime_rate_title_job_title_id` (`job_title_id`),
  KEY `FK_assignment_overtime_rate_title_overtime_rate_id` (`overtime_rate_id`),
  KEY `FK_assignment_overtime_rate_title_allowance_id` (`allowance_id`),
  CONSTRAINT `FK_assignment_overtime_rate_title_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_overtime_rate_title_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_overtime_rate_title_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_overtime_rate_title_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_overtime_rate_title_overtime_rate_id` FOREIGN KEY (`overtime_rate_id`) REFERENCES `assignment_overtime_rate` (`overtime_rate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignment_overtime_rate_title_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `assignment_overtime_rate_title` */

/*Table structure for table `attendance_employee` */

DROP TABLE IF EXISTS `attendance_employee`;

CREATE TABLE `attendance_employee` (
  `attendance_employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`attendance_employee_id`),
  KEY `machine_id` (`machine_id`,`id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `attendance_employee_ibfk_1` FOREIGN KEY (`machine_id`) REFERENCES `core_machine` (`machine_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `attendance_employee` */

/*Table structure for table `attendance_log` */

DROP TABLE IF EXISTS `attendance_log`;

CREATE TABLE `attendance_log` (
  `attendance_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_employee_id` int(11) NOT NULL,
  `index` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `verified` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`attendance_log_id`),
  KEY `attendance_employee_id` (`attendance_employee_id`),
  CONSTRAINT `attendance_log_ibfk_1` FOREIGN KEY (`attendance_employee_id`) REFERENCES `attendance_employee` (`attendance_employee_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `attendance_log` */

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
('lk3nhboql9emebo7d198n93eiqg46onh','::1',1639803160,'__ci_last_regenerate|i:1639803160;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}'),
('7d3fa72qi2e2sm2nasp196i8fdobc19j','::1',1639803566,'__ci_last_regenerate|i:1639803566;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}'),
('qcqsnafko1vlb0uvba36umb2s4e6aeu0','::1',1639804182,'__ci_last_regenerate|i:1639804182;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}CoreRegionToken-|s:32:\"2b35260733c30ff3aef3396b7a49d8af\";'),
('un9qfs0198o290elqh8tk55v1isb2vj8','::1',1639804976,'__ci_last_regenerate|i:1639804976;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}'),
('b1rfvalmekfubtj6jdedssuavhunt4a5','::1',1639805367,'__ci_last_regenerate|i:1639805367;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}'),
('qptvicbdnougs4gpdn88t5bvg6j7h9p8','::1',1639805586,'__ci_last_regenerate|i:1639805367;auth|a:10:{s:7:\"user_id\";s:2:\"14\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:16:\"user_group_level\";s:1:\"1\";s:9:\"region_id\";s:1:\"5\";s:9:\"branch_id\";s:2:\"11\";s:11:\"location_id\";s:2:\"20\";s:11:\"employee_id\";s:5:\"11677\";s:22:\"payroll_employee_level\";s:1:\"0\";s:17:\"employee_shift_id\";s:1:\"0\";}');

/*Table structure for table `core_absence` */

DROP TABLE IF EXISTS `core_absence`;

CREATE TABLE `core_absence` (
  `absence_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `absence_code` varchar(20) DEFAULT '',
  `absence_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`absence_id`),
  KEY `FK_core_absence_deduction_id` (`deduction_id`),
  CONSTRAINT `FK_core_absence_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_absence` */

insert  into `core_absence`(`absence_id`,`deduction_id`,`absence_code`,`absence_name`,`data_state`,`last_update`) values 
(1,NULL,'ABS','Mangkir',0,'2018-03-30 20:36:43');

/*Table structure for table `core_allowance` */

DROP TABLE IF EXISTS `core_allowance`;

CREATE TABLE `core_allowance` (
  `allowance_id` int(10) NOT NULL AUTO_INCREMENT,
  `allowance_code` varchar(20) DEFAULT '',
  `allowance_name` varchar(50) DEFAULT '',
  `allowance_amount` decimal(20,2) DEFAULT 0.00,
  `allowance_type` decimal(1,0) DEFAULT 0 COMMENT '0 : Fixed Allowance, 1 : Presence Allowance, 2 : Leave Allowance, 3 : Day Off Allowance',
  `allowance_group` decimal(1,0) DEFAULT 0 COMMENT '0 : Meal, 1 : Transport, 2 : Housing, 3 : Fire Team, 4 : Other',
  `allowance_condition` varchar(20) DEFAULT '' COMMENT '1;0;1;1;1;0',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`allowance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `core_allowance` */

insert  into `core_allowance`(`allowance_id`,`allowance_code`,`allowance_name`,`allowance_amount`,`allowance_type`,`allowance_group`,`allowance_condition`,`data_state`,`last_update`) values 
(1,'TRNALW','Transport Allowance',9000.00,1,1,'1;1;1;1;1;1;0',0,'2015-01-21 11:11:37'),
(3,'MELALW','Meal Allowance',9000.00,1,0,'',0,'2017-04-13 09:31:20'),
(5,'JOBALW','Job Title Allowance',2000.00,0,4,'',0,'2017-06-09 14:22:02'),
(6,'LEVALW','Leave Allowance',9000.00,2,4,'',0,'2017-06-13 09:00:06'),
(7,'DYOALW','Day Off Allowance',12000.00,3,4,'',0,'2017-06-13 09:01:19'),
(8,'RENALW','Rent Allowance',7500.00,0,4,'',0,'2017-11-07 20:15:03'),
(9,'COMALW','Communication Allowance',0.00,0,0,'',0,'2017-11-08 00:07:50'),
(10,'12HALW','12 Hour Allowance',82500.00,0,4,'',0,'2018-02-20 08:01:08'),
(11,'FNCALW','Functional Allowance',200000.00,0,4,'',0,'2018-02-20 08:02:44'),
(12,'SKLALW','Skill Allowance',200000.00,0,4,'',0,'2018-02-20 08:03:14');

/*Table structure for table `core_annual_leave` */

DROP TABLE IF EXISTS `core_annual_leave`;

CREATE TABLE `core_annual_leave` (
  `annual_leave_id` int(10) NOT NULL AUTO_INCREMENT,
  `annual_leave_code` varchar(20) DEFAULT '',
  `annual_leave_name` varchar(50) DEFAULT '',
  `annual_leave_days` decimal(10,2) DEFAULT 0.00,
  `annual_leave_type` decimal(1,0) DEFAULT 0 COMMENT '0 : Special, 1 : Yearly ',
  `annual_leave_period` decimal(6,0) DEFAULT 0,
  `include_day_off` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `annual_leave_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`annual_leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_annual_leave` */

insert  into `core_annual_leave`(`annual_leave_id`,`annual_leave_code`,`annual_leave_name`,`annual_leave_days`,`annual_leave_type`,`annual_leave_period`,`include_day_off`,`annual_leave_remark`,`data_state`,`last_update`) values 
(1,'ANLLVE','Cuti Tahunan',12.00,1,2018,0,'Test',0,'2018-03-31 16:33:43');

/*Table structure for table `core_applicant_status` */

DROP TABLE IF EXISTS `core_applicant_status`;

CREATE TABLE `core_applicant_status` (
  `applicant_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `applicant_status_code` varchar(20) DEFAULT '',
  `applicant_status_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0 COMMENT '0 : Active, 1 : Delete',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_applicant_status` */

/*Table structure for table `core_appraisal` */

DROP TABLE IF EXISTS `core_appraisal`;

CREATE TABLE `core_appraisal` (
  `appraisal_id` int(10) NOT NULL AUTO_INCREMENT,
  `appraisal_code` varchar(20) NOT NULL,
  `appraisal_name` varchar(50) NOT NULL,
  `data_state` decimal(1,0) NOT NULL,
  PRIMARY KEY (`appraisal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `core_appraisal` */

/*Table structure for table `core_asset` */

DROP TABLE IF EXISTS `core_asset`;

CREATE TABLE `core_asset` (
  `asset_id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_code` varchar(20) DEFAULT '',
  `asset_name` varchar(50) DEFAULT '',
  `asset_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_asset` */

/*Table structure for table `core_attendance_setting` */

DROP TABLE IF EXISTS `core_attendance_setting`;

CREATE TABLE `core_attendance_setting` (
  `attendance_setting_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`attendance_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_attendance_setting` */

/*Table structure for table `core_award` */

DROP TABLE IF EXISTS `core_award`;

CREATE TABLE `core_award` (
  `award_id` int(10) NOT NULL AUTO_INCREMENT,
  `award_code` varchar(20) DEFAULT '',
  `award_name` varchar(50) DEFAULT '',
  `award_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_award` */

/*Table structure for table `core_bank` */

DROP TABLE IF EXISTS `core_bank`;

CREATE TABLE `core_bank` (
  `bank_id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(20) DEFAULT '',
  `bank_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `core_bank` */

insert  into `core_bank`(`bank_id`,`bank_code`,`bank_name`,`data_state`,`last_update`) values 
(1,'MNDR','Bank Mandiri',0,'2015-01-27 09:56:17'),
(2,'PRMT','Bank Permata',0,'2016-03-14 10:28:55');

/*Table structure for table `core_blood_type` */

DROP TABLE IF EXISTS `core_blood_type`;

CREATE TABLE `core_blood_type` (
  `blood_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `blood_type_code` varchar(20) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`blood_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_blood_type` */

/*Table structure for table `core_branch` */

DROP TABLE IF EXISTS `core_branch`;

CREATE TABLE `core_branch` (
  `branch_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(20) DEFAULT '',
  `region_id` int(10) DEFAULT 0,
  `branch_name` varchar(50) DEFAULT '',
  `branch_address` text DEFAULT NULL,
  `branch_contact_person` varchar(50) DEFAULT '',
  `branch_phone1` varchar(30) DEFAULT '',
  `branch_phone2` varchar(30) DEFAULT '',
  `branch_email` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`branch_id`),
  KEY `FK_core_branch_region_id` (`region_id`),
  CONSTRAINT `FK_core_branch_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `core_branch` */

insert  into `core_branch`(`branch_id`,`branch_code`,`region_id`,`branch_name`,`branch_address`,`branch_contact_person`,`branch_phone1`,`branch_phone2`,`branch_email`,`data_state`,`last_update`) values 
(11,'SKH',5,'Sukoharjo',NULL,'','','','',0,'2018-02-13 11:53:31');

/*Table structure for table `core_class` */

DROP TABLE IF EXISTS `core_class`;

CREATE TABLE `core_class` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) DEFAULT 0,
  `class_code` varchar(20) DEFAULT '',
  `class_name` varchar(50) DEFAULT '',
  `standard_salary_range1` decimal(20,2) DEFAULT 0.00,
  `standard_salary_range2` decimal(20,2) DEFAULT 0.00,
  `class_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`class_id`),
  KEY `FK_core_class_grade_id` (`grade_id`),
  CONSTRAINT `FK_core_class_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_class` */

insert  into `core_class`(`class_id`,`grade_id`,`class_code`,`class_name`,`standard_salary_range1`,`standard_salary_range2`,`class_remark`,`data_state`,`last_update`) values 
(1,1,'CLSA                ','CLASS A                                           ',0.00,0.00,NULL,0,'2018-02-19 07:36:27');

/*Table structure for table `core_contract` */

DROP TABLE IF EXISTS `core_contract`;

CREATE TABLE `core_contract` (
  `contract_id` int(10) NOT NULL AUTO_INCREMENT,
  `contract_code` varchar(20) COLLATE utf8_estonian_ci DEFAULT '',
  `contract_name` varchar(50) COLLATE utf8_estonian_ci DEFAULT '',
  `contract_remark` text COLLATE utf8_estonian_ci DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

/*Data for the table `core_contract` */

/*Table structure for table `core_cost_budget` */

DROP TABLE IF EXISTS `core_cost_budget`;

CREATE TABLE `core_cost_budget` (
  `cost_budget_id` int(10) NOT NULL AUTO_INCREMENT,
  `cost_budget_code` varchar(20) DEFAULT '',
  `cost_budget_name` varchar(50) DEFAULT '',
  `cost_budget_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cost_budget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_cost_budget` */

/*Table structure for table `core_customer` */

DROP TABLE IF EXISTS `core_customer`;

CREATE TABLE `core_customer` (
  `customer_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(20) DEFAULT '',
  `customer_name` varchar(250) DEFAULT '',
  `customer_address` text DEFAULT NULL,
  `customer_city` varchar(100) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_customer` */

/*Table structure for table `core_dayoff` */

DROP TABLE IF EXISTS `core_dayoff`;

CREATE TABLE `core_dayoff` (
  `dayoff_id` int(10) NOT NULL AUTO_INCREMENT,
  `dayoff_code` varchar(20) DEFAULT '',
  `dayoff_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`dayoff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_dayoff` */

/*Table structure for table `core_deduction` */

DROP TABLE IF EXISTS `core_deduction`;

CREATE TABLE `core_deduction` (
  `deduction_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_code` varchar(20) DEFAULT '',
  `deduction_name` varchar(50) DEFAULT '',
  `deduction_amount` decimal(20,2) DEFAULT 0.00,
  `deduction_premi_attendance_ratio` decimal(10,2) DEFAULT 0.00,
  `deduction_basic_salary_ratio` decimal(10,2) DEFAULT 0.00,
  `deduction_late_start_duration` decimal(10,0) DEFAULT 0,
  `deduction_late_end_duration` decimal(10,0) DEFAULT 0,
  `deduction_type` decimal(1,0) DEFAULT 0 COMMENT '0 : Fixed Deduction, 1 : Absence Deduction, 2 : Permit Deduction, 3 : Sick Deduction',
  `deduction_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`deduction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_deduction` */

insert  into `core_deduction`(`deduction_id`,`deduction_code`,`deduction_name`,`deduction_amount`,`deduction_premi_attendance_ratio`,`deduction_basic_salary_ratio`,`deduction_late_start_duration`,`deduction_late_end_duration`,`deduction_type`,`deduction_remark`,`data_state`,`last_update`) values 
(1,'FIXDDC','Fixed Deduction',5000.00,0.00,0.00,0,0,0,'Fixed Deduction',0,'2015-01-21 14:43:58');

/*Table structure for table `core_deduction_allowance` */

DROP TABLE IF EXISTS `core_deduction_allowance`;

CREATE TABLE `core_deduction_allowance` (
  `deduction_allowance_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `deduction_allowance_ratio` decimal(10,2) DEFAULT 0.00,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`deduction_allowance_id`),
  KEY `FK_core_deduction_allowance_deduction_id` (`deduction_id`),
  KEY `FK_core_deduction_allowance_allowance_id` (`allowance_id`),
  CONSTRAINT `FK_core_deduction_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_deduction_allowance_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_deduction_allowance` */

/*Table structure for table `core_department` */

DROP TABLE IF EXISTS `core_department`;

CREATE TABLE `core_department` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `division_id` int(10) DEFAULT 0,
  `department_code` varchar(20) DEFAULT '',
  `department_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`department_id`),
  KEY `FK_core_department_division_id` (`division_id`),
  CONSTRAINT `FK_core_department_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `core_department` */

insert  into `core_department`(`department_id`,`division_id`,`department_code`,`department_name`,`data_state`,`last_update`) values 
(11,5,'OFFICE','OFFICE',0,'2018-02-27 06:28:52'),
(12,4,'OFFICE','OFFICE',0,'2018-02-27 06:28:52'),
(13,5,'SALS','SALES',1,'2018-02-27 06:28:52'),
(14,4,'HRGA','HRGA',1,'2018-02-27 06:28:52'),
(15,4,'FIAC','FINANCE AND ACCOUNTING',1,'2018-02-27 06:28:52'),
(16,4,'PRDK','PRODUKSI',1,'2018-02-27 06:28:52'),
(17,4,'WHRS','WAREHOUSE',1,'2018-02-27 06:28:52'),
(18,4,'ITDP','IT',1,'2018-02-27 06:28:52');

/*Table structure for table `core_diagnose` */

DROP TABLE IF EXISTS `core_diagnose`;

CREATE TABLE `core_diagnose` (
  `diagnose_id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnose_code` varchar(20) DEFAULT '',
  `diagnose_name` varchar(50) DEFAULT '',
  `diagnose_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`diagnose_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_diagnose` */

/*Table structure for table `core_division` */

DROP TABLE IF EXISTS `core_division`;

CREATE TABLE `core_division` (
  `division_id` int(10) NOT NULL AUTO_INCREMENT,
  `division_code` varchar(20) DEFAULT '',
  `division_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `core_division` */

insert  into `core_division`(`division_id`,`division_code`,`division_name`,`data_state`,`last_update`) values 
(4,'AGN','AGEN 46',0,'2018-02-13 11:59:53'),
(5,'KSP','KSP ARTHA BIMA',0,'2018-02-27 06:24:45');

/*Table structure for table `core_document_book` */

DROP TABLE IF EXISTS `core_document_book`;

CREATE TABLE `core_document_book` (
  `document_book_id` int(10) NOT NULL AUTO_INCREMENT,
  `document_book_code` varchar(20) DEFAULT '',
  `document_book_name` varchar(250) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`document_book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_document_book` */

/*Table structure for table `core_document_category` */

DROP TABLE IF EXISTS `core_document_category`;

CREATE TABLE `core_document_category` (
  `document_category_id` int(6) NOT NULL AUTO_INCREMENT,
  `document_category_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`document_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_document_category` */

/*Table structure for table `core_education` */

DROP TABLE IF EXISTS `core_education`;

CREATE TABLE `core_education` (
  `education_id` int(10) NOT NULL AUTO_INCREMENT,
  `education_code` varchar(20) DEFAULT '',
  `education_name` varchar(50) DEFAULT '',
  `education_type` decimal(1,0) DEFAULT 0 COMMENT '0 : Non Formal Education, 1 : Formal Education',
  `education_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0 COMMENT '0 : Active, 1 : Delete',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`education_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_education` */

insert  into `core_education`(`education_id`,`education_code`,`education_name`,`education_type`,`education_remark`,`data_state`,`last_update`) values 
(1,'SMA','SMA',0,'0',0,'2018-11-12 12:42:53');

/*Table structure for table `core_employee_status` */

DROP TABLE IF EXISTS `core_employee_status`;

CREATE TABLE `core_employee_status` (
  `employee_status_id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_status_code` varchar(20) DEFAULT '',
  `employee_status_name` varchar(50) DEFAULT '' COMMENT 'Probation, Contract, Permanent',
  `employee_status_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_employee_status` */

/*Table structure for table `core_expense_business_trip` */

DROP TABLE IF EXISTS `core_expense_business_trip`;

CREATE TABLE `core_expense_business_trip` (
  `expense_business_trip_id` int(10) NOT NULL AUTO_INCREMENT,
  `expense_business_trip_name` varchar(50) DEFAULT '',
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`expense_business_trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_expense_business_trip` */

/*Table structure for table `core_expertise` */

DROP TABLE IF EXISTS `core_expertise`;

CREATE TABLE `core_expertise` (
  `expertise_id` int(10) NOT NULL AUTO_INCREMENT,
  `expertise_code` varchar(20) DEFAULT '',
  `expertise_name` varchar(50) DEFAULT '',
  `expertise_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`expertise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_expertise` */

insert  into `core_expertise`(`expertise_id`,`expertise_code`,`expertise_name`,`expertise_remark`,`data_state`,`last_update`) values 
(1,'a1','sadasd','  ',1,'2018-11-12 12:45:08');

/*Table structure for table `core_extra_leave` */

DROP TABLE IF EXISTS `core_extra_leave`;

CREATE TABLE `core_extra_leave` (
  `extra_leave_id` int(10) NOT NULL AUTO_INCREMENT,
  `extra_leave_code` varchar(20) DEFAULT '',
  `extra_leave_name` varchar(50) DEFAULT '',
  `extra_leave_range1` decimal(10,2) DEFAULT 0.00,
  `extra_leave_range2` decimal(10,2) DEFAULT 0.00,
  `extra_leave_days` decimal(10,2) DEFAULT 0.00,
  `extra_leave_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`extra_leave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_extra_leave` */

/*Table structure for table `core_facility_category` */

DROP TABLE IF EXISTS `core_facility_category`;

CREATE TABLE `core_facility_category` (
  `facility_category_id` int(6) NOT NULL AUTO_INCREMENT,
  `facility_category_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`facility_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_facility_category` */

/*Table structure for table `core_facility_status` */

DROP TABLE IF EXISTS `core_facility_status`;

CREATE TABLE `core_facility_status` (
  `facility_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `facility_status_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`facility_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_facility_status` */

/*Table structure for table `core_family_relation` */

DROP TABLE IF EXISTS `core_family_relation`;

CREATE TABLE `core_family_relation` (
  `family_relation_id` int(10) NOT NULL AUTO_INCREMENT,
  `family_relation_code` varchar(20) DEFAULT '',
  `family_relation_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0 COMMENT '0 : Active, 1 : Delete',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`family_relation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_family_relation` */

insert  into `core_family_relation`(`family_relation_id`,`family_relation_code`,`family_relation_name`,`data_state`,`last_update`) values 
(1,'SDR','Saudara',0,'2018-11-12 12:44:32');

/*Table structure for table `core_glasses_coverage` */

DROP TABLE IF EXISTS `core_glasses_coverage`;

CREATE TABLE `core_glasses_coverage` (
  `glasses_coverage_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) DEFAULT 0,
  `job_title_id` int(10) NOT NULL DEFAULT 0,
  `class_id` int(10) NOT NULL DEFAULT 0,
  `glasses_coverage_code` varchar(20) DEFAULT '',
  `glasses_coverage_name` varchar(20) DEFAULT '',
  `glasses_coverage_type` enum('0','1') DEFAULT '0' COMMENT '0 : Frame Single Vision, 1 : Frame Double Vision',
  `glasses_coverage_ratio` decimal(10,2) DEFAULT 0.00,
  `glasses_coverage_amount` decimal(20,2) DEFAULT 0.00,
  `glasses_coverage_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`glasses_coverage_id`),
  KEY `FK_core_glasses_coverage_grade_id` (`grade_id`),
  KEY `job_title_id` (`job_title_id`,`class_id`),
  CONSTRAINT `FK_core_glasses_coverage_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_glasses_coverage` */

/*Table structure for table `core_grade` */

DROP TABLE IF EXISTS `core_grade`;

CREATE TABLE `core_grade` (
  `grade_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_code` varchar(20) DEFAULT '',
  `grade_name` varchar(50) DEFAULT '',
  `grade_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_grade` */

insert  into `core_grade`(`grade_id`,`grade_code`,`grade_name`,`grade_remark`,`data_state`,`last_update`) values 
(1,'GRDA','Grade A',NULL,0,'2018-02-19 07:35:22');

/*Table structure for table `core_home_early` */

DROP TABLE IF EXISTS `core_home_early`;

CREATE TABLE `core_home_early` (
  `home_early_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `home_early_code` varchar(20) DEFAULT '',
  `home_early_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`home_early_id`),
  KEY `FK_core_home_early_deduction_id` (`deduction_id`),
  CONSTRAINT `FK_core_home_early_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_home_early` */

insert  into `core_home_early`(`home_early_id`,`deduction_id`,`home_early_code`,`home_early_name`,`data_state`,`last_update`) values 
(1,NULL,'HMERLY','Home Early',0,'2018-11-05 17:05:46');

/*Table structure for table `core_hospital_coverage` */

DROP TABLE IF EXISTS `core_hospital_coverage`;

CREATE TABLE `core_hospital_coverage` (
  `hospital_coverage_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) DEFAULT 0,
  `job_title_id` int(10) NOT NULL DEFAULT 0,
  `class_id` int(10) NOT NULL DEFAULT 0,
  `hospital_coverage_code` varchar(20) DEFAULT '',
  `hospital_coverage_name` varchar(50) DEFAULT '',
  `hospital_coverage_medicine_ratio` decimal(10,2) DEFAULT 0.00,
  `hospital_coverage_medicine_amount` decimal(20,2) DEFAULT 0.00,
  `hospital_coverage_room_ratio` decimal(10,2) DEFAULT 0.00,
  `hospital_coverage_room_amount` decimal(20,2) DEFAULT 0.00,
  `hospital_coverage_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`hospital_coverage_id`),
  KEY `FK_core_hospital_coverage_grade_id` (`grade_id`),
  KEY `job_title_id` (`job_title_id`,`class_id`),
  CONSTRAINT `FK_core_hospital_coverage_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_hospital_coverage` */

/*Table structure for table `core_incentive` */

DROP TABLE IF EXISTS `core_incentive`;

CREATE TABLE `core_incentive` (
  `incentive_id` int(10) NOT NULL AUTO_INCREMENT,
  `incentive_code` varchar(20) DEFAULT '',
  `incentive_name` varchar(250) DEFAULT '',
  `incentive_amount` decimal(20,2) DEFAULT 0.00,
  `incentive_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`incentive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_incentive` */

/*Table structure for table `core_insurance` */

DROP TABLE IF EXISTS `core_insurance`;

CREATE TABLE `core_insurance` (
  `insurance_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_code` varchar(20) DEFAULT '',
  `insurance_name` varchar(50) DEFAULT '',
  `insurance_address` text DEFAULT NULL,
  `insurance_city` varchar(50) DEFAULT '',
  `insurance_home_phone` varchar(30) DEFAULT '',
  `insurance_mobile_phone` varchar(30) DEFAULT '',
  `insurance_contact_person` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_insurance` */

/*Table structure for table `core_insurance_premi` */

DROP TABLE IF EXISTS `core_insurance_premi`;

CREATE TABLE `core_insurance_premi` (
  `insurance_premi_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_id` int(10) DEFAULT 0,
  `insurance_premi_code` varchar(20) DEFAULT '',
  `insurance_premi_amount` decimal(20,2) DEFAULT 0.00,
  `insurance_premi_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`insurance_premi_id`),
  KEY `FK_core_insurance_premi_insurance_id` (`insurance_id`),
  CONSTRAINT `FK_core_insurance_premi_insurance_id` FOREIGN KEY (`insurance_id`) REFERENCES `core_insurance` (`insurance_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_insurance_premi` */

/*Table structure for table `core_job_title` */

DROP TABLE IF EXISTS `core_job_title`;

CREATE TABLE `core_job_title` (
  `job_title_id` int(10) NOT NULL AUTO_INCREMENT,
  `job_title_code` varchar(20) DEFAULT '',
  `job_title_name` varchar(50) DEFAULT '',
  `job_title_parent_id` int(10) DEFAULT 0,
  `job_title_top_parent_id` int(10) DEFAULT 0,
  `job_title_has_child` enum('0','1') DEFAULT '0',
  `job_title_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`job_title_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `core_job_title` */

insert  into `core_job_title`(`job_title_id`,`job_title_code`,`job_title_name`,`job_title_parent_id`,`job_title_top_parent_id`,`job_title_has_child`,`job_title_remark`,`data_state`,`last_update`) values 
(1,'STAFF','STAFF',0,0,'0',NULL,0,'2018-02-19 07:03:29'),
(2,'KABAG','KABAG',0,0,'0',NULL,0,'2018-02-19 07:03:29'),
(3,'MANAGER','MANAGER',0,0,'0',NULL,0,'2018-02-19 07:03:29'),
(18,'SPV','SPV',0,0,'0','-',0,'2020-06-11 09:52:46'),
(19,'KETUA','KETUA',0,0,'0','-',0,'2020-06-11 09:53:14');

/*Table structure for table `core_language` */

DROP TABLE IF EXISTS `core_language`;

CREATE TABLE `core_language` (
  `language_id` int(10) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(20) DEFAULT '',
  `language_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0 COMMENT '0 : Active, 1 : Delet',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_language` */

insert  into `core_language`(`language_id`,`language_code`,`language_name`,`data_state`,`last_update`) values 
(1,'Bing','Bahasa Inggris',0,'2018-11-12 12:42:29');

/*Table structure for table `core_late` */

DROP TABLE IF EXISTS `core_late`;

CREATE TABLE `core_late` (
  `late_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `late_code` varchar(20) DEFAULT '',
  `late_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`late_id`),
  KEY `FK_core_late_deduction_id` (`deduction_id`),
  CONSTRAINT `FK_core_late_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_late` */

/*Table structure for table `core_length_service` */

DROP TABLE IF EXISTS `core_length_service`;

CREATE TABLE `core_length_service` (
  `length_service_id` int(10) NOT NULL AUTO_INCREMENT,
  `length_service_code` varchar(20) DEFAULT '',
  `length_service_name` varchar(50) DEFAULT '',
  `length_service_range1` decimal(10,2) DEFAULT 0.00,
  `length_service_range2` decimal(10,2) DEFAULT 0.00,
  `length_service_amount` decimal(20,2) DEFAULT 0.00,
  `length_service_amount_multiply` decimal(10,2) DEFAULT 0.00,
  `length_service_min_saving` decimal(10,2) DEFAULT 0.00,
  `length_service_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`length_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_length_service` */

/*Table structure for table `core_loan_type` */

DROP TABLE IF EXISTS `core_loan_type`;

CREATE TABLE `core_loan_type` (
  `loan_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `loan_type_code` varchar(20) DEFAULT '',
  `loan_type_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_loan_type` */

insert  into `core_loan_type`(`loan_type_id`,`loan_type_code`,`loan_type_name`,`data_state`,`last_update`) values 
(1,'asdasd','asdasd',0,'2018-10-13 13:55:35');

/*Table structure for table `core_location` */

DROP TABLE IF EXISTS `core_location`;

CREATE TABLE `core_location` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT 0,
  `location_code` varchar(20) DEFAULT '',
  `location_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`location_id`),
  KEY `FK_core_location_branch_id` (`branch_id`),
  CONSTRAINT `FK_core_location_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `core_location` */

insert  into `core_location`(`location_id`,`branch_id`,`location_code`,`location_name`,`data_state`,`last_update`) values 
(19,11,'AGEN 46','AGEN 46',0,'2018-02-13 11:59:01'),
(20,11,'WIRATAMA','WIRATAMA',0,'2020-06-04 11:18:34');

/*Table structure for table `core_machine` */

DROP TABLE IF EXISTS `core_machine`;

CREATE TABLE `core_machine` (
  `machine_id` int(6) NOT NULL AUTO_INCREMENT,
  `machine_code` varchar(20) DEFAULT '',
  `machine_name` varchar(200) DEFAULT '',
  `machine_database_name` varchar(200) DEFAULT '',
  `machine_type` decimal(1,0) DEFAULT 0,
  `machine_ip_address` varchar(20) DEFAULT '',
  `machine_port` varchar(20) DEFAULT NULL,
  `machine_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`machine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `core_machine` */

insert  into `core_machine`(`machine_id`,`machine_code`,`machine_name`,`machine_database_name`,`machine_type`,`machine_ip_address`,`machine_port`,`machine_remark`,`data_state`,`last_update`) values 
(1,'CKP_140','Terminal Attendance CKP 140','db_download_140',1,'192.168.1.140',NULL,NULL,0,'2018-08-04 10:49:43'),
(2,'CKP_98','Terminal Attendance CKP 98','db_download_98',1,'192.168.1.98',NULL,NULL,0,'2018-08-04 10:50:16'),
(3,'CKP_132','Terminal Attendance CKP 132','db_download_132',0,'192.168.1.132',NULL,NULL,0,'2018-08-04 10:51:39'),
(4,'CKP_115','Terminal Attendance CKP 115','db_download_115',0,'192.168.1.115',NULL,NULL,0,'2018-08-04 10:52:10'),
(6,'CKP_141','Terminal Attendance CKP 141','db_download_141',1,'192.168.1.141',NULL,NULL,0,'2018-08-04 10:52:59'),
(7,'CKP_142','Terminal Attendance CKP 142','db_download_142',0,'192.168.1.142',NULL,NULL,0,'2018-08-04 10:53:18');

/*Table structure for table `core_marital_status` */

DROP TABLE IF EXISTS `core_marital_status`;

CREATE TABLE `core_marital_status` (
  `marital_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `marital_status_code` varchar(20) DEFAULT '',
  `marital_status_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`marital_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `core_marital_status` */

insert  into `core_marital_status`(`marital_status_id`,`marital_status_code`,`marital_status_name`,`data_state`,`last_update`) values 
(1,'SNGL','Belum Menikah',0,'2015-01-13 09:59:20'),
(3,'MNKH','Menikah',0,'2016-03-16 11:35:32'),
(4,'DUDA','Duda',0,'2016-03-16 11:35:51'),
(7,'JNDA','Janda',0,'2017-04-11 16:54:21');

/*Table structure for table `core_medical_coverage` */

DROP TABLE IF EXISTS `core_medical_coverage`;

CREATE TABLE `core_medical_coverage` (
  `medical_coverage_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_id` int(10) DEFAULT 0,
  `job_title_id` int(10) NOT NULL DEFAULT 0,
  `class_id` int(10) NOT NULL DEFAULT 0,
  `medical_coverage_code` varchar(20) DEFAULT '',
  `medical_coverage_name` varchar(50) DEFAULT '',
  `medical_coverage_ratio` decimal(10,2) DEFAULT 0.00,
  `medical_coverage_amount` decimal(20,2) DEFAULT 0.00,
  `medical_coverage_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`medical_coverage_id`),
  KEY `FK_core_medical_coverage_grade_id` (`grade_id`),
  KEY `job_title_id` (`job_title_id`,`class_id`),
  CONSTRAINT `FK_core_medical_coverage_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_medical_coverage` */

/*Table structure for table `core_member` */

DROP TABLE IF EXISTS `core_member`;

CREATE TABLE `core_member` (
  `member_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(50) DEFAULT '',
  `member_address` varchar(250) DEFAULT '',
  `member_kelurahan` varchar(250) DEFAULT '',
  `member_kecamatan` varchar(250) DEFAULT '',
  `member_kota` varchar(250) DEFAULT '',
  `member_phone` varchar(50) DEFAULT '',
  `member_email` varchar(50) DEFAULT '',
  `member_post_code` varchar(5) DEFAULT '',
  `member_id_card` varchar(250) DEFAULT '',
  `member_signature` varchar(250) DEFAULT '',
  `member_logo` varchar(250) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_member` */

/*Table structure for table `core_nationality` */

DROP TABLE IF EXISTS `core_nationality`;

CREATE TABLE `core_nationality` (
  `nationality_id` int(10) NOT NULL AUTO_INCREMENT,
  `nationality_code` varchar(20) DEFAULT '',
  `nationality_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`nationality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_nationality` */

/*Table structure for table `core_overtime_category` */

DROP TABLE IF EXISTS `core_overtime_category`;

CREATE TABLE `core_overtime_category` (
  `overtime_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `overtime_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_overtime_category` */

/*Table structure for table `core_overtime_rounded` */

DROP TABLE IF EXISTS `core_overtime_rounded`;

CREATE TABLE `core_overtime_rounded` (
  `overtime_rounded_id` int(10) NOT NULL AUTO_INCREMENT,
  `overtime_minute_range1` decimal(10,2) DEFAULT 0.00,
  `overtime_minute_range2` decimal(10,2) DEFAULT 0.00,
  `overtime_minute_rounded` decimal(10,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_rounded_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_overtime_rounded` */

/*Table structure for table `core_overtime_type` */

DROP TABLE IF EXISTS `core_overtime_type`;

CREATE TABLE `core_overtime_type` (
  `overtime_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `overtime_type_code` varchar(20) DEFAULT '',
  `overtime_type_name` varchar(50) DEFAULT '',
  `overtime_type_working_day_hour1` decimal(10,0) DEFAULT 0,
  `overtime_type_working_day_ratio1` decimal(10,2) DEFAULT 0.00,
  `overtime_type_working_day_hour2` decimal(10,0) DEFAULT 0,
  `overtime_type_working_day_ratio2` decimal(10,2) DEFAULT 0.00,
  `overtime_type_day_off_hour1` decimal(10,0) DEFAULT 0,
  `overtime_type_day_off_ratio1` decimal(10,2) DEFAULT 0.00,
  `overtime_type_day_off_hour2` decimal(10,0) DEFAULT 0,
  `overtime_type_day_off_ratio2` decimal(10,2) DEFAULT 0.00,
  `overtime_type_amount` decimal(20,2) DEFAULT 0.00,
  `overtime_type_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_overtime_type` */

/*Table structure for table `core_permit` */

DROP TABLE IF EXISTS `core_permit`;

CREATE TABLE `core_permit` (
  `permit_id` int(10) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `permit_code` varchar(20) DEFAULT '',
  `permit_name` varchar(50) DEFAULT '',
  `permit_type` decimal(1,0) DEFAULT 0,
  `permit_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`permit_id`),
  KEY `FK_core_permit_deduction_id` (`deduction_id`),
  CONSTRAINT `FK_core_permit_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `core_permit` */

insert  into `core_permit`(`permit_id`,`deduction_id`,`permit_code`,`permit_name`,`permit_type`,`permit_status`,`data_state`,`last_update`) values 
(1,NULL,'PRTNWK','Ijin Dengan Surat Dokter',1,3,0,'2018-03-31 15:37:10'),
(2,NULL,'PRTWDP','Ijin Tanpa Surat Dokter',1,4,0,'2018-06-28 11:50:54'),
(3,NULL,'dad','adasda',1,0,0,'2018-12-12 15:36:47');

/*Table structure for table `core_position` */

DROP TABLE IF EXISTS `core_position`;

CREATE TABLE `core_position` (
  `position_id` int(6) NOT NULL AUTO_INCREMENT,
  `position_code` varchar(20) DEFAULT '',
  `position_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_position` */

/*Table structure for table `core_premi_attendance` */

DROP TABLE IF EXISTS `core_premi_attendance`;

CREATE TABLE `core_premi_attendance` (
  `premi_attendance_id` int(10) NOT NULL AUTO_INCREMENT,
  `premi_attendance_code` varchar(20) DEFAULT '',
  `premi_attendance_name` varchar(50) DEFAULT '',
  `premi_attendance_range1` decimal(10,2) DEFAULT 0.00,
  `premi_attendance_range2` decimal(10,2) DEFAULT 0.00,
  `premi_attendance_amount` decimal(20,2) DEFAULT 0.00,
  `premi_attendance_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`premi_attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_premi_attendance` */

insert  into `core_premi_attendance`(`premi_attendance_id`,`premi_attendance_code`,`premi_attendance_name`,`premi_attendance_range1`,`premi_attendance_range2`,`premi_attendance_amount`,`premi_attendance_remark`,`data_state`,`last_update`) values 
(1,'PRMATD','Premi Attendance',100000.00,200000.00,200000.00,'',0,'2018-02-20 08:05:04');

/*Table structure for table `core_probation` */

DROP TABLE IF EXISTS `core_probation`;

CREATE TABLE `core_probation` (
  `probation_id` int(10) NOT NULL AUTO_INCREMENT,
  `probation_code` varchar(20) DEFAULT '',
  `probation_name` varchar(50) DEFAULT '',
  `probation_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`probation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_probation` */

/*Table structure for table `core_rating` */

DROP TABLE IF EXISTS `core_rating`;

CREATE TABLE `core_rating` (
  `rating_id` int(10) NOT NULL AUTO_INCREMENT,
  `rating_code` varchar(20) DEFAULT '',
  `rating_name` varchar(50) DEFAULT '',
  `rating_range1` decimal(10,2) DEFAULT 0.00,
  `rating_range2` decimal(10,2) DEFAULT 0.00,
  `rating_value` varchar(20) DEFAULT '',
  `rating_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_rating` */

/*Table structure for table `core_region` */

DROP TABLE IF EXISTS `core_region`;

CREATE TABLE `core_region` (
  `region_id` int(10) NOT NULL AUTO_INCREMENT,
  `region_code` varchar(20) DEFAULT '',
  `region_name` varchar(50) DEFAULT '',
  `region_token` varchar(250) DEFAULT '',
  `data_state` int(1) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `updated_id` int(10) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL,
  `deleted_id` int(10) DEFAULT 0,
  `deleted_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`region_id`),
  KEY `region_token` (`region_token`),
  KEY `data_state` (`data_state`),
  KEY `created_id` (`created_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `core_region` */

insert  into `core_region`(`region_id`,`region_code`,`region_name`,`region_token`,`data_state`,`created_id`,`created_on`,`updated_id`,`updated_on`,`deleted_id`,`deleted_on`,`last_update`) values 
(5,'IDN','Indonesia','',0,0,NULL,0,NULL,0,NULL,'2018-02-13 11:39:10'),
(7,'tyutyu','tyutyu','5a3a07a4d9645c7519628952b67478d4',0,14,'2021-12-18 12:26:58',0,NULL,0,NULL,'2021-12-18 12:26:58'),
(8,'tyuty','tyutyutytyutyutytutyu','106e4250926243db4e3ba8bc7e319e17',1,14,'2021-12-18 12:27:01',14,'2021-12-18 12:30:51',14,'2021-12-18 12:31:39','2021-12-18 12:27:01');

/*Table structure for table `core_religion` */

DROP TABLE IF EXISTS `core_religion`;

CREATE TABLE `core_religion` (
  `religion_id` int(10) NOT NULL AUTO_INCREMENT,
  `religion_code` varchar(20) DEFAULT '',
  `religion_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_religion` */

/*Table structure for table `core_section` */

DROP TABLE IF EXISTS `core_section`;

CREATE TABLE `core_section` (
  `section_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_id` int(10) DEFAULT 0,
  `section_code` varchar(20) DEFAULT '',
  `section_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`section_id`),
  KEY `FK_core_section_department_id` (`department_id`),
  CONSTRAINT `FK_core_section_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `core_section` */

insert  into `core_section`(`section_id`,`department_id`,`section_code`,`section_name`,`data_state`,`last_update`) values 
(34,11,'OPR','OPERATION',0,'2018-02-27 06:34:33'),
(43,11,'BISNIS','BISNIS',0,'2020-06-11 09:41:37'),
(44,11,'SUPPORT','SUPPORT',0,'2020-06-11 09:42:54'),
(45,11,'PENGURUS','PENGURUS',0,'2020-06-11 09:43:13'),
(46,12,'STAFF','STAFF',0,'2020-06-11 09:50:21');

/*Table structure for table `core_separation_reason` */

DROP TABLE IF EXISTS `core_separation_reason`;

CREATE TABLE `core_separation_reason` (
  `separation_reason_id` int(6) NOT NULL AUTO_INCREMENT,
  `separation_reason_name` varchar(20) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`separation_reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `core_separation_reason` */

insert  into `core_separation_reason`(`separation_reason_id`,`separation_reason_name`,`data_state`,`last_update`) values 
(1,'Resign',0,'2018-11-12 00:34:48');

/*Table structure for table `core_separation_status` */

DROP TABLE IF EXISTS `core_separation_status`;

CREATE TABLE `core_separation_status` (
  `separation_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `separation_status_name` varchar(50) DEFAULT '',
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`separation_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_separation_status` */

/*Table structure for table `core_separation_type` */

DROP TABLE IF EXISTS `core_separation_type`;

CREATE TABLE `core_separation_type` (
  `separation_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `separation_type_code` varchar(20) DEFAULT '',
  `separation_type_name` varchar(50) DEFAULT '',
  `separation_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`separation_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_separation_type` */

/*Table structure for table `core_service_pay` */

DROP TABLE IF EXISTS `core_service_pay`;

CREATE TABLE `core_service_pay` (
  `service_pay_id` int(10) NOT NULL AUTO_INCREMENT,
  `service_pay_code` varchar(20) DEFAULT '',
  `service_pay_name` varchar(50) DEFAULT '',
  `service_pay_range1` decimal(10,2) DEFAULT 0.00,
  `service_pay_range2` decimal(10,2) DEFAULT 0.00,
  `service_pay_ratio` decimal(5,2) DEFAULT 0.00,
  `service_pay_type` decimal(1,0) DEFAULT 0,
  `service_pay_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`service_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_service_pay` */

/*Table structure for table `core_shift` */

DROP TABLE IF EXISTS `core_shift`;

CREATE TABLE `core_shift` (
  `shift_id` int(10) NOT NULL AUTO_INCREMENT,
  `shift_code` varchar(20) DEFAULT '',
  `shift_name` varchar(50) DEFAULT '',
  `start_working_hour` time DEFAULT NULL,
  `end_working_hour` time DEFAULT NULL,
  `total_working_hour` decimal(10,0) DEFAULT 0,
  `start_rest_hour` time DEFAULT NULL,
  `end_rest_hour` time DEFAULT NULL,
  `due_time_late` decimal(10,2) DEFAULT 0.00,
  `shift_next_day` decimal(1,0) DEFAULT 0,
  `working_hours_start` decimal(10,2) DEFAULT 0.00,
  `working_hours_end` decimal(10,2) DEFAULT 0.00,
  `shift_overtime_minutes` decimal(10,0) DEFAULT 0,
  `shift_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `core_shift` */

insert  into `core_shift`(`shift_id`,`shift_code`,`shift_name`,`start_working_hour`,`end_working_hour`,`total_working_hour`,`start_rest_hour`,`end_rest_hour`,`due_time_late`,`shift_next_day`,`working_hours_start`,`working_hours_end`,`shift_overtime_minutes`,`shift_remark`,`data_state`,`last_update`) values 
(1,'SP','SHIFT PAGI','08:00:00','16:00:00',8,'11:18:02','11:18:02',0.00,0,8.10,15.50,0,'',0,'2018-03-16 11:18:08'),
(17,'SS','SHIFT SIANG','13:00:00','20:00:00',0,NULL,NULL,0.00,0,13.10,19.50,0,'',0,'2020-06-04 12:55:40');

/*Table structure for table `core_shift_group` */

DROP TABLE IF EXISTS `core_shift_group`;

CREATE TABLE `core_shift_group` (
  `shift_group_id` int(10) NOT NULL AUTO_INCREMENT,
  `shift_group_code` varbinary(20) DEFAULT '',
  `shift_id` int(10) DEFAULT 0,
  `shift_group_name` varchar(50) DEFAULT '',
  `shift_group_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_group_id`),
  KEY `FK_core_shift_group_shift_id` (`shift_id`),
  CONSTRAINT `FK_core_shift_group_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `core_shift` (`shift_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_shift_group` */

/*Table structure for table `core_social_security` */

DROP TABLE IF EXISTS `core_social_security`;

CREATE TABLE `core_social_security` (
  `social_security_id` int(10) NOT NULL AUTO_INCREMENT,
  `social_security_period` decimal(6,0) DEFAULT 0,
  `social_security_jkm` decimal(10,2) DEFAULT 0.00,
  `social_security_jkk` decimal(10,2) DEFAULT 0.00,
  `social_security_jht_employee` decimal(10,2) DEFAULT 0.00,
  `social_security_jht_company` decimal(10,2) DEFAULT 0.00,
  `social_security_medical_employee` decimal(10,2) DEFAULT 0.00,
  `social_security_medical_company` decimal(10,2) DEFAULT 0.00,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`social_security_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_social_security` */

/*Table structure for table `core_sub_asset` */

DROP TABLE IF EXISTS `core_sub_asset`;

CREATE TABLE `core_sub_asset` (
  `sub_asset_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_asset_code` varchar(20) DEFAULT '',
  `asset_id` int(10) DEFAULT 0,
  `sub_asset_name` varchar(50) DEFAULT '',
  `sub_asset_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sub_asset_id`),
  KEY `FK_core_sub_asset_asset_id` (`asset_id`),
  CONSTRAINT `FK_core_sub_asset_asset_id` FOREIGN KEY (`asset_id`) REFERENCES `core_asset` (`asset_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_sub_asset` */

/*Table structure for table `core_sub_asset_status` */

DROP TABLE IF EXISTS `core_sub_asset_status`;

CREATE TABLE `core_sub_asset_status` (
  `sub_asset_status_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_asset_status_name` varchar(50) DEFAULT '',
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sub_asset_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_sub_asset_status` */

/*Table structure for table `core_suspend` */

DROP TABLE IF EXISTS `core_suspend`;

CREATE TABLE `core_suspend` (
  `suspend_id` int(10) NOT NULL AUTO_INCREMENT,
  `suspend_code` varchar(20) DEFAULT '',
  `suspend_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`suspend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_suspend` */

/*Table structure for table `core_tax` */

DROP TABLE IF EXISTS `core_tax`;

CREATE TABLE `core_tax` (
  `tax_id` int(10) NOT NULL AUTO_INCREMENT,
  `tax_period` decimal(6,0) DEFAULT 0,
  `tax_type` varchar(20) DEFAULT '' COMMENT 'TK, K0, K1, K2, K3',
  `tax_non_taxable_income` decimal(20,2) DEFAULT 0.00,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_tax` */

/*Table structure for table `core_tax_rate` */

DROP TABLE IF EXISTS `core_tax_rate`;

CREATE TABLE `core_tax_rate` (
  `tax_rate_id` int(10) NOT NULL AUTO_INCREMENT,
  `tax_rate_period` decimal(6,0) DEFAULT 0,
  `tax_rate_salary_range1` decimal(20,2) DEFAULT 0.00,
  `tax_rate_salary_range2` decimal(20,2) DEFAULT 0.00,
  `tax_rate_amount` decimal(10,2) DEFAULT 0.00,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_tax_rate` */

/*Table structure for table `core_training_category` */

DROP TABLE IF EXISTS `core_training_category`;

CREATE TABLE `core_training_category` (
  `training_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `training_category_code` varchar(20) DEFAULT '',
  `training_category_name` varchar(50) DEFAULT '',
  `training_category_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_training_category` */

/*Table structure for table `core_training_job_title` */

DROP TABLE IF EXISTS `core_training_job_title`;

CREATE TABLE `core_training_job_title` (
  `training_job_title_id` int(10) NOT NULL AUTO_INCREMENT,
  `training_title_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `training_job_title_code` varchar(20) DEFAULT '',
  `training_job_title_name` varchar(50) DEFAULT '',
  `training_job_title_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_job_title_id`),
  KEY `FK_core_training_job_title_job_title_id` (`job_title_id`),
  KEY `FK_core_training_job_title_training_title_id` (`training_title_id`),
  CONSTRAINT `FK_core_training_job_title_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_training_job_title_training_title_id` FOREIGN KEY (`training_title_id`) REFERENCES `core_training_title` (`training_title_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_training_job_title` */

/*Table structure for table `core_training_provider` */

DROP TABLE IF EXISTS `core_training_provider`;

CREATE TABLE `core_training_provider` (
  `training_provider_id` int(10) NOT NULL AUTO_INCREMENT,
  `training_provider_code` varchar(20) DEFAULT '',
  `training_provider_name` varchar(50) DEFAULT '',
  `training_provider_address` text DEFAULT NULL,
  `training_provider_city` varchar(50) DEFAULT '',
  `training_provider_home_phone` varchar(50) DEFAULT '',
  `training_provider_mobile_phone` varchar(50) DEFAULT '',
  `training_provider_fax_number` varchar(50) DEFAULT '',
  `training_provider_email` varchar(50) DEFAULT '',
  `training_provider_contact_person` varchar(50) DEFAULT '',
  `training_provider_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_training_provider` */

/*Table structure for table `core_training_provider_item` */

DROP TABLE IF EXISTS `core_training_provider_item`;

CREATE TABLE `core_training_provider_item` (
  `training_provider_item_id` int(10) NOT NULL AUTO_INCREMENT,
  `training_provider_id` int(10) DEFAULT NULL,
  `training_title_id` int(10) DEFAULT NULL,
  `training_provider_item_name` varchar(50) DEFAULT '',
  `training_provider_item_cost` decimal(20,2) DEFAULT 0.00,
  `training_provider_item_duration` decimal(10,2) DEFAULT 0.00,
  `training_provider_item_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_provider_item_id`),
  KEY `FK_core_training_provider_item_training_provider_id` (`training_provider_id`),
  KEY `FK_core_training_provider_item_training_title_id` (`training_title_id`),
  CONSTRAINT `FK_core_training_provider_item_training_provider_id` FOREIGN KEY (`training_provider_id`) REFERENCES `core_training_provider` (`training_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_core_training_provider_item_training_title_id` FOREIGN KEY (`training_title_id`) REFERENCES `core_training_title` (`training_title_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_training_provider_item` */

/*Table structure for table `core_training_title` */

DROP TABLE IF EXISTS `core_training_title`;

CREATE TABLE `core_training_title` (
  `training_title_id` int(10) NOT NULL AUTO_INCREMENT,
  `training_category_id` int(10) DEFAULT 0,
  `training_title_code` varchar(20) DEFAULT '',
  `training_title_name` varchar(50) DEFAULT '',
  `training_title_parent` int(10) DEFAULT 0,
  `training_title_top_parent` int(10) DEFAULT 0,
  `training_title_has_child` decimal(1,0) DEFAULT 0,
  `training_title_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_title_id`),
  KEY `FK_core_training_title_training_category_id` (`training_category_id`),
  CONSTRAINT `FK_core_training_title_training_category_id` FOREIGN KEY (`training_category_id`) REFERENCES `core_training_category` (`training_category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_training_title` */

/*Table structure for table `core_unit` */

DROP TABLE IF EXISTS `core_unit`;

CREATE TABLE `core_unit` (
  `unit_id` int(10) NOT NULL AUTO_INCREMENT,
  `section_id` int(10) DEFAULT 0,
  `unit_code` varchar(20) DEFAULT '',
  `unit_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`unit_id`),
  KEY `FK_core_unit_section_id` (`section_id`),
  CONSTRAINT `FK_core_unit_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

/*Data for the table `core_unit` */

insert  into `core_unit`(`unit_id`,`section_id`,`unit_code`,`unit_name`,`data_state`,`last_update`) values 
(1,NULL,'','QUEEN',0,'2018-02-19 06:58:34'),
(2,NULL,'','APG',0,'2018-02-19 06:58:34'),
(3,NULL,'','APG 1',0,'2018-02-19 06:58:34'),
(4,NULL,'','REPACKING',0,'2018-02-19 06:58:34'),
(5,NULL,'','TRAINING',0,'2018-02-19 06:58:34'),
(6,NULL,'','APG 2',0,'2018-02-19 06:58:34'),
(7,NULL,'','LONGSONG',0,'2018-02-19 06:58:34'),
(8,NULL,'','SELATAN',0,'2018-02-19 06:58:34'),
(9,NULL,'','HD',0,'2018-02-19 06:58:34'),
(10,NULL,'','HD SELATAN',0,'2018-02-19 06:58:34'),
(11,NULL,'','PU ROLL',0,'2018-02-19 06:58:34'),
(12,NULL,'','PU ROLL SELATAN',0,'2018-02-19 06:58:34'),
(13,NULL,'','PELLET',0,'2018-02-19 06:58:34'),
(14,NULL,'','PELLET SELATAN',0,'2018-02-19 06:58:34'),
(15,34,'','OFFICE',0,'2018-02-19 06:58:34'),
(16,NULL,'','ARMADA',0,'2018-02-19 06:58:34'),
(17,NULL,'','RETAIL',0,'2018-02-19 06:58:34'),
(18,NULL,'','REPACKING',0,'2018-02-19 06:58:34'),
(19,NULL,'','PU AVAL',0,'2018-02-19 06:58:34'),
(20,NULL,'','PU ROLL',0,'2018-02-19 06:58:34'),
(21,NULL,'','MIXER',0,'2018-02-19 06:58:34'),
(22,NULL,'','MIXER',0,'2018-02-19 06:58:34'),
(23,NULL,'','PU AVAL',0,'2018-02-19 06:58:34'),
(24,NULL,'','PU AVAL SELATAN',0,'2018-02-19 06:58:34'),
(25,NULL,'','PU GA',0,'2018-02-19 06:58:34'),
(26,NULL,'','PU 1/2 JADI',0,'2018-02-19 06:58:34'),
(27,NULL,'','PU LOGISTIK',0,'2018-02-19 06:58:34'),
(28,NULL,'','CCTV',0,'2018-02-19 06:58:34'),
(29,NULL,'','MIXER SELATAN',0,'2018-02-19 06:58:34'),
(30,NULL,'','TEKNIK',0,'2018-02-19 06:58:34'),
(31,NULL,'','TEKNIK',0,'2018-02-19 06:58:34'),
(32,NULL,'','TEKNIK',0,'2018-02-19 06:58:34'),
(33,NULL,'','TEKNIK',0,'2018-02-19 06:58:34'),
(34,NULL,'','EKSPEDISI',0,'2018-02-19 06:58:34'),
(35,NULL,'','PRINTING',0,'2018-02-19 06:58:34'),
(36,NULL,'','KEUANGAN',0,'2018-02-19 06:58:34'),
(37,NULL,'','ACCOUNTING',0,'2018-02-19 06:58:34'),
(38,34,'','MARKETING',0,'2018-02-19 06:58:34'),
(39,NULL,'','RETAIL',0,'2018-02-19 06:58:34'),
(40,NULL,'','LOGISTIK',0,'2018-02-19 06:58:34'),
(41,NULL,'','TEKNIK',0,'2018-02-19 06:58:34'),
(42,NULL,'','HRD',0,'2018-02-19 06:58:34'),
(43,NULL,'','PRODUKSI',0,'2018-02-19 06:58:34'),
(44,NULL,'','ARMADA',0,'2018-02-19 06:58:34'),
(45,NULL,'','PAJAK',0,'2018-02-19 06:58:34'),
(46,NULL,'','IT',0,'2018-02-19 06:58:34'),
(47,NULL,'','DESAIN',0,'2018-02-19 06:58:34'),
(48,NULL,'TKNK8020','Teknik 0820',0,'2018-04-24 12:07:52'),
(49,NULL,'TEKNIK0719','TEKNIK0719',0,'2018-04-25 13:55:25'),
(50,NULL,'AC','AC',0,'2018-04-25 16:05:01'),
(51,NULL,'TEKNIK0816','TEKNIK0816',0,'2018-04-25 16:14:39'),
(52,NULL,'teknikshift','teknikshift',0,'2018-04-26 10:05:27'),
(53,NULL,'teknikshift','teknikshift',0,'2018-04-26 13:32:30'),
(54,NULL,'xpdc0716','xpdc0716',0,'2018-05-07 13:38:56'),
(55,NULL,'PELLET','PELLET',0,'2018-05-09 10:19:39'),
(56,NULL,'MIXER','MIXER',0,'2018-05-14 09:13:05'),
(57,NULL,'','LP PE A',0,'2018-05-26 16:40:38'),
(58,NULL,'','LP PE B',0,'2018-05-26 16:40:38'),
(59,NULL,'','LP PE C',0,'2018-05-26 16:40:38'),
(60,NULL,'','PLONG POLYBAG',0,'2018-05-26 16:40:38'),
(61,NULL,'','ADMIN GD ROLL PE',0,'2018-05-26 16:40:38'),
(62,NULL,'','ADMIN OFFICE',0,'2018-05-26 16:40:38'),
(63,NULL,'','EXPEDISI',0,'2018-05-26 16:40:38'),
(64,NULL,'','PU DGD ROLL',0,'2018-05-26 16:40:38'),
(65,NULL,'','GA',0,'2018-05-26 16:40:38'),
(66,NULL,'','CAMPUR BAHAN',0,'2018-05-26 16:40:38'),
(67,NULL,'','PELET NEW CKP',0,'2018-05-26 16:40:38'),
(68,NULL,'','MONTIR LP PE',0,'2018-05-26 16:40:38'),
(69,NULL,'','MONTIR PROD',0,'2018-05-26 16:40:38'),
(70,NULL,'','PROD ROLL PE A',0,'2018-05-26 16:40:38'),
(71,NULL,'','PROD ROLL PE B',0,'2018-05-26 16:40:38'),
(72,NULL,'','PROD ROLL PE C',0,'2018-05-26 16:40:38');

/*Table structure for table `core_vacation_category` */

DROP TABLE IF EXISTS `core_vacation_category`;

CREATE TABLE `core_vacation_category` (
  `vacation_category_id` int(6) NOT NULL AUTO_INCREMENT,
  `vacation_category_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`vacation_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_vacation_category` */

/*Table structure for table `core_warning` */

DROP TABLE IF EXISTS `core_warning`;

CREATE TABLE `core_warning` (
  `warning_id` int(10) NOT NULL AUTO_INCREMENT,
  `warning_code` varchar(20) DEFAULT '',
  `warning_name` varchar(50) DEFAULT '',
  `warning_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`warning_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_warning` */

/*Table structure for table `core_working_status` */

DROP TABLE IF EXISTS `core_working_status`;

CREATE TABLE `core_working_status` (
  `attendance_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `attendance_status_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`attendance_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_working_status` */

/*Table structure for table `core_zone` */

DROP TABLE IF EXISTS `core_zone`;

CREATE TABLE `core_zone` (
  `zone_id` int(10) NOT NULL AUTO_INCREMENT,
  `zone_code` varchar(20) DEFAULT '',
  `zone_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `core_zone` */

/*Table structure for table `data_ckp` */

DROP TABLE IF EXISTS `data_ckp`;

CREATE TABLE `data_ckp` (
  `employee_id` double DEFAULT NULL,
  `department_id` double DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `section_id` double DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `unit_id` double DEFAULT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `job_title_id` double DEFAULT NULL,
  `job_title_name` varchar(255) DEFAULT NULL,
  `location_id` double DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `division_id` int(10) DEFAULT 0,
  `employee_shift_id2` double DEFAULT NULL,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_shift_code` varchar(255) DEFAULT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `employee_rfid_code` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `employee_hire_date` date DEFAULT NULL,
  `employee_last_day_off` date DEFAULT NULL,
  `employee_day_off_cycle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `data_ckp` */

/*Table structure for table `data_karyawan` */

DROP TABLE IF EXISTS `data_karyawan`;

CREATE TABLE `data_karyawan` (
  `record_id` int(10) DEFAULT NULL,
  `marital_status_id` int(10) DEFAULT NULL,
  `region_id` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `division_id` int(10) DEFAULT NULL,
  `employee_id` bigint(22) DEFAULT NULL,
  `department_id` int(10) DEFAULT NULL,
  `section_id` int(10) DEFAULT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `job_title_id` int(10) DEFAULT NULL,
  `grade_id` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `employee_shift_id` bigint(22) DEFAULT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `job_title_name` varchar(255) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `employee_rfid_code` varchar(255) DEFAULT NULL,
  `employee_last_day_off` date DEFAULT NULL,
  `employee_day_off_cycle` decimal(10,0) DEFAULT NULL,
  `working_hour` varchar(255) DEFAULT NULL,
  `libur` varchar(255) DEFAULT NULL,
  `employee_hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `data_karyawan` */

/*Table structure for table `hro_attendance_log` */

DROP TABLE IF EXISTS `hro_attendance_log`;

CREATE TABLE `hro_attendance_log` (
  `attendance_log` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `machine_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `attendance_log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `attendance_log_downloaded` decimal(1,0) DEFAULT 0,
  PRIMARY KEY (`attendance_log`),
  KEY `FK_hro_employee_presence_log_region_id` (`region_id`),
  KEY `FK_hro_employee_presence_log_branch_id` (`branch_id`),
  KEY `FK_hro_employee_presence_log_division_id` (`division_id`),
  KEY `FK_hro_employee_presence_log_department_id` (`department_id`),
  KEY `FK_hro_employee_presence_log_section_id` (`section_id`),
  KEY `FK_hro_employee_presence_log_unit_id` (`unit_id`),
  KEY `FK_hro_employee_presence_log_job_title_id` (`job_title_id`),
  KEY `FK_hro_employee_presence_log_location_id` (`location_id`),
  KEY `FK_hro_employee_presence_log_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_presence_log_machine_id` (`machine_id`),
  KEY `FK_hro_employee_presence_log_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_attendance_log_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_machine_id` FOREIGN KEY (`machine_id`) REFERENCES `core_machine` (`machine_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_attendance_log_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_attendance_log` */

/*Table structure for table `hro_document_history` */

DROP TABLE IF EXISTS `hro_document_history`;

CREATE TABLE `hro_document_history` (
  `document_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `document_category_id` int(10) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `document_title` varchar(200) DEFAULT '',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`document_history_id`),
  KEY `FK_hro_document_history_employee_id` (`employee_id`),
  KEY `FK_hro_document_history_document_category_id` (`document_category_id`),
  CONSTRAINT `FK_hro_document_history_document_category_id` FOREIGN KEY (`document_category_id`) REFERENCES `core_document_category` (`document_category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_document_history` */

/*Table structure for table `hro_employee` */

DROP TABLE IF EXISTS `hro_employee`;

CREATE TABLE `hro_employee` (
  `marital_status_id` int(10) DEFAULT 0,
  `marital_status_code` varchar(20) DEFAULT '',
  `region_id` int(10) DEFAULT 0,
  `region_code` varchar(20) DEFAULT '',
  `branch_id` int(10) DEFAULT 0,
  `branch_code` varchar(20) DEFAULT '',
  `division_id` int(10) DEFAULT 0,
  `division_code` varchar(20) DEFAULT '',
  `department_id` int(10) DEFAULT 0,
  `department_code` varchar(20) DEFAULT '',
  `section_id` int(10) DEFAULT 0,
  `section_code` varchar(20) DEFAULT '',
  `location_id` int(10) DEFAULT 0,
  `location_code` varchar(20) DEFAULT '',
  `job_title_id` int(10) DEFAULT 0,
  `job_title_code` varchar(20) DEFAULT '',
  `grade_id` int(10) DEFAULT 0,
  `grade_code` varchar(20) DEFAULT '',
  `class_id` int(10) DEFAULT 0,
  `class_code` varchar(20) DEFAULT '',
  `employee_name` varchar(50) DEFAULT '',
  `employee_address` varchar(250) DEFAULT '',
  `employee_city` varchar(50) DEFAULT '',
  `employee_rw` varchar(10) DEFAULT '',
  `employee_rt` varchar(10) DEFAULT '',
  `employee_kecamatan` varchar(50) DEFAULT '',
  `employee_kelurahan` varchar(50) DEFAULT '',
  `employee_postal_code` varchar(10) DEFAULT '',
  `employee_residential_address` varchar(250) DEFAULT '',
  `employee_residential_city` varchar(50) DEFAULT '',
  `employee_residential_rt` varchar(10) DEFAULT '',
  `employee_residential_rw` varchar(10) DEFAULT '',
  `employee_residential_kecamatan` varchar(50) DEFAULT '',
  `employee_residential_kelurahan` varchar(50) DEFAULT '',
  `employee_residential_postal_code` varchar(10) DEFAULT '',
  `employee_gender` decimal(1,0) DEFAULT 0 COMMENT '0 : Female, 1 : Male',
  `employee_home_phone` varchar(30) DEFAULT '',
  `employee_mobile_phone1` varchar(30) DEFAULT '',
  `employee_mobile_phone2` varchar(30) DEFAULT '',
  `employee_id_number` varchar(30) DEFAULT '',
  `employee_date_of_birth` date DEFAULT NULL,
  `employee_place_of_birth` varchar(50) DEFAULT '',
  `employee_hire_date` date DEFAULT NULL,
  `employee_hire_period` decimal(6,0) DEFAULT 0,
  `employee_effective_date` date DEFAULT NULL,
  `employee_email_address` varchar(50) DEFAULT '',
  `employee_bank_acct_no` varchar(30) DEFAULT '',
  `employee_bank_acct_name` varchar(50) DEFAULT '',
  `employee_spouse_name` varchar(50) DEFAULT '',
  `employee_number_of_children` decimal(10,0) DEFAULT 0,
  `employee_spouse_job` varchar(50) DEFAULT '',
  `employee_religion` decimal(1,0) DEFAULT 0 COMMENT '1 : Moslem, 2 : Christian, 3 : Catholic, 4 : Budha, 5 : Hindu, 6 : Others',
  `employee_blood_type` decimal(1,0) DEFAULT 0 COMMENT '1 : A, 2 : B, 3 : O, 4 : AB',
  `employee_photo` varchar(200) DEFAULT '',
  `employee_status` decimal(1,0) DEFAULT 1 COMMENT '1 : Active',
  `employee_suspend_status` decimal(1,0) DEFAULT 1 COMMENT '1 : Un Suspended, 0 : Suspended',
  `employee_employment_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Permanent, 2 : Probation, 3 : Contract',
  `employee_employment_status_period` date DEFAULT NULL,
  `employee_employment_extending` decimal(1,0) DEFAULT 0,
  `employee_bpjs_kesehatan_status` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_bpjs_tenagakerja_status` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_employment_working_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Monthly, 0 : Daily',
  `employee_employment_overtime_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Automatic, 0 : SPL',
  `employee_no` varchar(10) DEFAULT '',
  `employee_code` varchar(20) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee` */

/*Table structure for table `hro_employee_absence` */

DROP TABLE IF EXISTS `hro_employee_absence`;

CREATE TABLE `hro_employee_absence` (
  `employee_absence_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `absence_id` int(10) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_absence_date` date DEFAULT NULL,
  `employee_absence_start_date` date DEFAULT NULL,
  `employee_absence_end_date` date DEFAULT NULL,
  `employee_absence_description` varchar(250) DEFAULT '',
  `employee_absence_duration` decimal(10,0) DEFAULT 0,
  `employee_absence_remark` text DEFAULT NULL,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_absence_id`),
  KEY `FK_hro_employee_absence_employee_id` (`employee_id`),
  KEY `FK_hro_employee_absence_absence_id` (`absence_id`),
  KEY `FK_hro_employee_absence_employee_attendance_data_id` (`employee_attendance_data_id`),
  CONSTRAINT `FK_hro_employee_absence_absence_id` FOREIGN KEY (`absence_id`) REFERENCES `core_absence` (`absence_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_absence_employee_attendance_data_id` FOREIGN KEY (`employee_attendance_data_id`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_absence_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_absence` */

/*Table structure for table `hro_employee_absence_detail` */

DROP TABLE IF EXISTS `hro_employee_absence_detail`;

CREATE TABLE `hro_employee_absence_detail` (
  `employee_absence_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_absence_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_absence_detail_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_absence_detail_id`),
  KEY `FK_hro_employee_absence_detail_employee_absence_id` (`employee_absence_id`),
  KEY `FK_hro_employee_absence_detail_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_absence_detail_employee_absence_id` FOREIGN KEY (`employee_absence_id`) REFERENCES `hro_employee_absence` (`employee_absence_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_absence_detail_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_absence_detail` */

/*Table structure for table `hro_employee_appraisal` */

DROP TABLE IF EXISTS `hro_employee_appraisal`;

CREATE TABLE `hro_employee_appraisal` (
  `employee_appraisal_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_appraisal_date` date DEFAULT NULL,
  `employee_appraisal_remark` text DEFAULT NULL,
  `employee_appraisal_total_value` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_appraisal_id`),
  KEY `FK_hro_employee_appraisal_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_appraisal_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_appraisal` */

/*Table structure for table `hro_employee_appraisal_detail` */

DROP TABLE IF EXISTS `hro_employee_appraisal_detail`;

CREATE TABLE `hro_employee_appraisal_detail` (
  `employee_appraisal_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_appraisal_id` bigint(22) DEFAULT 0,
  `appraisal_id` int(10) DEFAULT 0,
  `employee_appraisal_detail_value` decimal(10,0) DEFAULT 0,
  `employee_appraisal_detail_code` varchar(10) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_appraisal_detail_id`),
  KEY `FK_hro_employee_appraisal_detail_employee_appraisal_id` (`employee_appraisal_id`),
  KEY `FK_hro_employee_appraisal_detail_appraisal_id` (`appraisal_id`),
  CONSTRAINT `FK_hro_employee_appraisal_detail_appraisal_id` FOREIGN KEY (`appraisal_id`) REFERENCES `core_appraisal` (`appraisal_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_appraisal_detail_employee_appraisal_id` FOREIGN KEY (`employee_appraisal_id`) REFERENCES `hro_employee_appraisal` (`employee_appraisal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_appraisal_detail` */

/*Table structure for table `hro_employee_asset` */

DROP TABLE IF EXISTS `hro_employee_asset`;

CREATE TABLE `hro_employee_asset` (
  `employee_asset_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `asset_id` int(10) DEFAULT 0,
  `sub_asset_id` int(10) DEFAULT 0,
  `employee_asset_receipt_date` date DEFAULT NULL,
  `employee_asset_description` varchar(250) DEFAULT '',
  `employee_asset_remark` text DEFAULT NULL,
  `employee_asset_returned_date` date DEFAULT NULL,
  `employee_asset_returned_remark` text DEFAULT NULL,
  `employee_asset_status` decimal(1,0) DEFAULT 1,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_asset_id`),
  KEY `FK_hro_employee_asset_asset_id` (`asset_id`),
  KEY `FK_hro_employee_asset_employee_id` (`employee_id`),
  KEY `FK_hro_employee_asset_sub_asset_id` (`sub_asset_id`),
  CONSTRAINT `FK_hro_employee_asset_asset_id` FOREIGN KEY (`asset_id`) REFERENCES `core_asset` (`asset_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_asset_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_asset_sub_asset_id` FOREIGN KEY (`sub_asset_id`) REFERENCES `core_sub_asset` (`sub_asset_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_asset` */

/*Table structure for table `hro_employee_attendance` */

DROP TABLE IF EXISTS `hro_employee_attendance`;

CREATE TABLE `hro_employee_attendance` (
  `employee_attendance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_attendance_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Attendance, 0 : Meal Coupon',
  `employee_attendance_in_status` decimal(1,0) NOT NULL DEFAULT 0,
  `employee_attendance_out_status` decimal(1,0) NOT NULL DEFAULT 0,
  `employee_attendance_date` date DEFAULT NULL,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_log_date` timestamp NULL DEFAULT current_timestamp(),
  `employee_attendance_log_in_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_attendance_log_out_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `machine_ip_address` varchar(50) NOT NULL DEFAULT '',
  `employee_attendance_downloaded` decimal(1,0) DEFAULT 0,
  `employee_attendance_location_in` varchar(200) NOT NULL,
  `employee_attendance_location_out` varchar(200) NOT NULL,
  PRIMARY KEY (`employee_attendance_id`),
  KEY `FK_hro_employee_attendance_region_id` (`region_id`),
  KEY `FK_hro_employee_attendance_branch_id` (`branch_id`),
  KEY `FK_hro_employee_attendance_division_id` (`division_id`),
  KEY `FK_hro_employee_attendance_department_id` (`department_id`),
  KEY `FK_hro_employee_attendance_section_id` (`section_id`),
  KEY `FK_hro_employee_attendance_unit_id` (`unit_id`),
  KEY `FK_hro_employee_attendance_location_id` (`location_id`),
  KEY `FK_hro_employee_attendance_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_attendance_employee_id` (`employee_id`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  KEY `FK_hro_employee_attendance_shift_id` (`shift_id`),
  CONSTRAINT `FK_hro_employee_attendance_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `core_shift` (`shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=489 DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance` */

insert  into `hro_employee_attendance`(`employee_attendance_id`,`region_id`,`branch_id`,`division_id`,`department_id`,`section_id`,`unit_id`,`location_id`,`shift_id`,`employee_shift_id`,`employee_id`,`employee_rfid_code`,`employee_attendance_status`,`employee_attendance_in_status`,`employee_attendance_out_status`,`employee_attendance_date`,`employee_attendance_date_status`,`employee_attendance_log_date`,`employee_attendance_log_in_date`,`employee_attendance_log_out_date`,`machine_ip_address`,`employee_attendance_downloaded`,`employee_attendance_location_in`,`employee_attendance_location_out`) values 
(72,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-04',0,'2020-06-04 15:31:45','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(73,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:39:54','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(74,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:40:59','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(75,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-04',0,'2020-06-04 15:46:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(76,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-04',0,'2020-06-04 15:46:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(77,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:46:50','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(78,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:47:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(79,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:47:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(80,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-04',0,'2020-06-04 15:52:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(81,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-05',0,'2020-06-05 08:15:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(82,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-05',0,'2020-06-05 08:15:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(83,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-05',0,'2020-06-05 08:15:24','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(84,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:26:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(85,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:38:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(86,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:38:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(87,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:39:19','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(88,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:40:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(89,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:48:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(90,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:48:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(91,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:49:18','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(92,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:49:54','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(93,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-05',0,'2020-06-05 09:50:36','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(94,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-05',0,'2020-06-05 16:02:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(95,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-05',0,'2020-06-05 16:02:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(96,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-05',0,'2020-06-05 16:02:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(97,5,11,5,11,34,15,20,NULL,NULL,11677,'ab73ba1c7e',1,0,0,'2020-06-05',0,'2020-06-05 16:02:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(98,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-06',0,'2020-06-06 08:09:24','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(99,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-06',0,'2020-06-06 08:09:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(100,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-06',0,'2020-06-06 08:09:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(101,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-06',0,'2020-06-06 08:09:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(102,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-06',0,'2020-06-06 08:09:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(103,5,11,5,11,34,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-06',0,'2020-06-06 08:09:40','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(104,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-06',0,'2020-06-06 08:09:43','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(105,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-06',0,'2020-06-06 08:09:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(106,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-06',0,'2020-06-06 08:12:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(107,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-08',0,'2020-06-08 08:35:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(108,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-08',0,'2020-06-08 08:35:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(109,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-08',0,'2020-06-08 08:35:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(110,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-08',0,'2020-06-08 08:35:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(111,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-08',0,'2020-06-08 08:35:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(112,5,11,5,11,34,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-08',0,'2020-06-08 08:35:50','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(113,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-08',0,'2020-06-08 08:35:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(114,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-08',0,'2020-06-08 08:37:29','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(115,5,11,5,11,34,15,20,NULL,NULL,11679,'3bc53a22e6',1,0,0,'2020-06-08',0,'2020-06-08 08:38:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(116,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-09',0,'2020-06-09 11:49:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(117,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-09',0,'2020-06-09 11:49:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(118,5,11,5,11,34,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-09',0,'2020-06-09 11:49:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(119,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-09',0,'2020-06-09 11:50:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(120,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-09',0,'2020-06-09 11:50:07','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(121,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-09',0,'2020-06-09 11:50:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(122,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-09',0,'2020-06-09 11:50:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(123,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-09',0,'2020-06-09 11:50:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(124,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-09',0,'2020-06-09 13:24:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(125,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-09',0,'2020-06-09 13:24:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(126,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-09',0,'2020-06-09 13:24:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(127,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-09',0,'2020-06-09 13:25:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(128,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-09',0,'2020-06-09 13:25:11','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(129,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-09',0,'2020-06-09 13:25:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(130,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-09',0,'2020-06-09 13:25:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(131,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-09',0,'2020-06-09 13:26:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(132,5,11,5,11,34,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-09',0,'2020-06-09 13:26:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(133,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-09',0,'2020-06-09 13:26:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(134,5,11,5,11,34,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-09',0,'2020-06-09 13:26:32','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(135,5,11,5,11,34,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-09',0,'2020-06-09 13:26:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(136,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-09',0,'2020-06-09 13:26:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(137,5,11,5,11,34,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-09',0,'2020-06-09 13:29:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(138,5,11,5,11,34,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-09',0,'2020-06-09 13:29:50','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(139,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-10',0,'2020-06-10 09:50:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(140,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-10',0,'2020-06-10 10:27:43','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(141,5,11,5,11,34,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-10',0,'2020-06-10 13:12:32','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(142,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-10',0,'2020-06-10 13:19:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(143,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-11',0,'2020-06-11 10:02:07','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(144,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:04:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(145,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:14:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(146,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:15:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(147,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:17:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(148,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:23:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(149,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 13:23:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(150,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 13:27:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(151,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 13:27:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(152,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 13:27:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(153,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 13:27:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(154,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 13:29:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(155,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:29:59','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(156,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 13:30:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(157,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 13:30:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(158,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 13:30:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(159,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 13:32:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(160,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 13:33:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(161,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:33:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(162,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:59:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(163,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 13:59:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(164,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 13:59:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(165,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 13:59:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(166,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 13:59:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(167,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 14:00:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(168,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 14:00:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(169,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 14:00:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(170,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 14:00:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(171,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-12',0,'2020-06-12 14:03:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(172,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-12',0,'2020-06-12 14:03:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(173,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-06-12',0,'2020-06-12 14:03:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(174,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 14:03:24','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(175,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 14:08:19','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(176,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 14:14:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(177,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 14:15:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(178,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-12',0,'2020-06-12 14:15:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(179,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-12',0,'2020-06-12 14:27:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(180,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-12',0,'2020-06-12 14:27:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(181,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-12',0,'2020-06-12 14:34:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(182,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-12',0,'2020-06-12 14:34:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(183,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-12',0,'2020-06-12 14:35:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(184,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-15',0,'2020-06-15 09:47:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(185,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-15',0,'2020-06-15 09:47:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(186,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-15',0,'2020-06-15 10:03:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(187,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-15',0,'2020-06-15 10:05:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(188,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-15',0,'2020-06-15 14:58:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(189,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-15',0,'2020-06-15 14:58:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(190,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-15',0,'2020-06-15 14:58:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(191,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-16',0,'2020-06-16 09:09:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(192,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-16',0,'2020-06-16 09:36:35','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(193,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-16',0,'2020-06-16 10:13:42','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(194,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-16',0,'2020-06-16 10:52:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(195,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-16',0,'2020-06-16 11:24:40','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(196,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-16',0,'2020-06-16 11:24:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(197,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-16',0,'2020-06-16 15:35:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(198,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-17',0,'2020-06-17 09:47:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(199,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-22',0,'2020-06-22 09:36:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(200,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-22',0,'2020-06-22 10:02:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(201,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-06-22',0,'2020-06-22 10:03:06','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(202,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-22',0,'2020-06-22 10:42:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(203,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-22',0,'2020-06-22 10:42:36','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(204,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-22',0,'2020-06-22 15:46:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(205,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-22',0,'2020-06-22 15:46:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(206,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-06-23',0,'2020-06-23 08:43:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(207,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-23',0,'2020-06-23 09:33:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(208,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-06-23',0,'2020-06-23 09:33:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(209,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-23',0,'2020-06-23 09:48:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(210,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-23',0,'2020-06-23 10:06:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(211,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-23',0,'2020-06-23 12:25:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(212,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-23',0,'2020-06-23 14:12:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(213,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-24',0,'2020-06-24 09:19:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(214,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-06-24',0,'2020-06-24 09:19:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(215,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-24',0,'2020-06-24 09:49:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(216,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-24',0,'2020-06-24 10:49:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(217,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-24',0,'2020-06-24 14:09:18','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(218,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-24',0,'2020-06-24 15:09:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(219,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-25',0,'2020-06-25 09:43:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(220,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-25',0,'2020-06-25 11:55:06','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(221,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-25',0,'2020-06-25 13:44:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(222,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-26',0,'2020-06-26 09:35:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(223,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-26',0,'2020-06-26 11:40:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(224,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-29',0,'2020-06-29 09:54:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(225,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-29',0,'2020-06-29 11:09:26','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(226,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-06-30',0,'2020-06-30 09:44:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(227,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-06-30',0,'2020-06-30 10:41:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(228,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-06-30',0,'2020-06-30 10:47:07','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(229,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-01',0,'2020-07-01 09:51:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(230,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-07-01',0,'2020-07-01 09:53:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(231,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-07-01',0,'2020-07-01 10:27:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(232,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-01',0,'2020-07-01 11:18:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(233,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-01',0,'2020-07-01 15:21:58','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(234,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-02',0,'2020-07-02 09:40:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(235,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-02',0,'2020-07-02 11:27:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(236,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-02',0,'2020-07-02 15:25:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(237,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-03',0,'2020-07-03 09:53:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(238,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-03',0,'2020-07-03 10:02:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(239,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-06',0,'2020-07-06 10:01:06','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(240,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-06',0,'2020-07-06 10:03:18','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(241,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-06',0,'2020-07-06 12:59:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(242,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-07',0,'2020-07-07 09:44:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(243,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-07',0,'2020-07-07 10:38:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(244,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-07',0,'2020-07-07 10:38:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(245,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-07',0,'2020-07-07 11:09:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(246,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-07',0,'2020-07-07 12:45:03','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(247,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-07',0,'2020-07-07 15:49:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(248,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-08',0,'2020-07-08 09:32:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(249,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-08',0,'2020-07-08 09:51:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(250,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-08',0,'2020-07-08 11:25:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(251,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-08',0,'2020-07-08 12:07:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(252,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-09',0,'2020-07-09 09:51:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(253,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-09',0,'2020-07-09 09:54:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(254,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-09',0,'2020-07-09 11:05:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(255,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-09',0,'2020-07-09 11:41:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(256,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-10',0,'2020-07-10 12:00:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(257,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-13',0,'2020-07-13 09:48:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(258,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-13',0,'2020-07-13 11:11:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(259,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-13',0,'2020-07-13 15:41:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(260,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-14',0,'2020-07-14 10:02:45','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(261,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-14',0,'2020-07-14 11:06:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(262,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-15',0,'2020-07-15 09:56:16','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(263,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-15',0,'2020-07-15 11:17:32','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(264,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-15',0,'2020-07-15 12:08:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(265,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-17',0,'2020-07-17 09:39:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(266,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-17',0,'2020-07-17 11:37:36','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(267,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-17',0,'2020-07-17 12:43:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(268,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-17',0,'2020-07-17 12:43:19','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(269,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-20',0,'2020-07-20 09:20:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(270,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-20',0,'2020-07-20 09:43:01','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(271,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-20',0,'2020-07-20 10:15:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(272,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-20',0,'2020-07-20 11:18:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(273,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-20',0,'2020-07-20 13:43:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(274,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-20',0,'2020-07-20 14:44:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(275,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-21',0,'2020-07-21 09:42:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(276,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-07-21',0,'2020-07-21 15:15:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(277,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-22',0,'2020-07-22 09:48:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(278,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-22',0,'2020-07-22 09:51:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(279,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-22',0,'2020-07-22 11:07:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(280,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-23',0,'2020-07-23 09:55:11','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(281,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-23',0,'2020-07-23 10:19:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(282,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-23',0,'2020-07-23 11:19:21','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(283,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-23',0,'2020-07-23 12:20:47','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(284,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-23',0,'2020-07-23 15:19:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(285,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-23',0,'2020-07-23 15:20:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(286,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-07-24',0,'2020-07-24 09:19:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(287,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-24',0,'2020-07-24 09:23:45','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(288,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-07-24',0,'2020-07-24 09:34:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(289,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-24',0,'2020-07-24 09:34:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(290,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-24',0,'2020-07-24 10:32:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(291,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-24',0,'2020-07-24 15:15:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(292,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-27',0,'2020-07-27 09:40:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(293,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-27',0,'2020-07-27 09:51:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(294,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-07-27',0,'2020-07-27 11:48:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(295,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-27',0,'2020-07-27 13:52:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(296,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-27',0,'2020-07-27 14:50:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(297,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-28',0,'2020-07-28 09:57:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(298,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-28',0,'2020-07-28 11:35:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(299,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-07-28',0,'2020-07-28 11:35:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(300,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-07-28',0,'2020-07-28 12:10:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(301,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-07-28',0,'2020-07-28 14:51:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(302,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-07-29',0,'2020-07-29 10:03:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(303,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-03',0,'2020-08-03 09:57:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(304,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-05',0,'2020-08-05 09:53:48','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(305,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-05',0,'2020-08-05 10:14:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(306,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-05',0,'2020-08-05 11:56:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(307,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 13:53:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(308,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 14:00:03','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(309,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 14:04:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(310,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 14:06:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(311,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 14:08:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(312,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-05',0,'2020-08-05 14:08:07','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(313,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-06',0,'2020-08-06 10:04:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(314,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-06',0,'2020-08-06 11:52:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(315,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-06',0,'2020-08-06 11:52:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(316,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-06',0,'2020-08-06 11:52:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(317,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-06',0,'2020-08-06 11:52:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(318,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-06',0,'2020-08-06 11:53:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(319,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-06',0,'2020-08-06 15:10:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(320,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-07',0,'2020-08-07 09:53:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(321,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-07',0,'2020-08-07 10:06:42','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(322,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-07',0,'2020-08-07 10:12:11','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(323,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-07',0,'2020-08-07 15:05:29','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(324,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-07',0,'2020-08-07 15:05:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(325,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-07',0,'2020-08-07 15:05:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(326,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-10',0,'2020-08-10 09:59:54','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(327,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-10',0,'2020-08-10 10:18:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(328,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-10',0,'2020-08-10 11:42:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(329,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-11',0,'2020-08-11 10:21:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(330,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-08-11',0,'2020-08-11 10:21:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(331,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-11',0,'2020-08-11 10:55:26','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(332,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-11',0,'2020-08-11 11:16:35','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(333,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-12',0,'2020-08-12 11:52:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(334,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-12',0,'2020-08-12 11:52:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(335,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-12',0,'2020-08-12 11:53:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(336,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-12',0,'2020-08-12 14:42:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(337,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-12',0,'2020-08-12 15:19:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(338,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-12',0,'2020-08-12 15:20:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(339,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-13',0,'2020-08-13 09:46:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(340,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-13',0,'2020-08-13 09:57:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(341,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-13',0,'2020-08-13 11:34:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(342,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-08-13',0,'2020-08-13 11:34:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(343,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-13',0,'2020-08-13 14:03:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(344,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-13',0,'2020-08-13 14:03:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(345,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-14',0,'2020-08-14 10:04:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(346,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-14',0,'2020-08-14 10:05:23','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(347,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-14',0,'2020-08-14 10:27:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(348,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-14',0,'2020-08-14 14:39:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(349,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-18',0,'2020-08-18 10:13:58','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(350,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-18',0,'2020-08-18 11:10:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(351,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-18',0,'2020-08-18 11:11:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(352,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-18',0,'2020-08-18 15:14:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(353,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-18',0,'2020-08-18 15:14:58','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(354,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-19',0,'2020-08-19 09:18:45','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(355,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-19',0,'2020-08-19 10:28:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(356,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-19',0,'2020-08-19 14:35:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(357,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-19',0,'2020-08-19 15:16:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(358,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-24',0,'2020-08-24 09:00:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(359,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-24',0,'2020-08-24 10:03:36','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(360,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-24',0,'2020-08-24 15:30:03','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(361,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-24',0,'2020-08-24 15:30:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(362,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-25',0,'2020-08-25 09:53:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(363,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-25',0,'2020-08-25 11:29:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(364,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-25',0,'2020-08-25 13:18:11','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(365,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-25',0,'2020-08-25 15:10:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(366,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-26',0,'2020-08-26 09:25:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(367,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-26',0,'2020-08-26 10:00:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(368,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-26',0,'2020-08-26 11:37:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(369,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-26',0,'2020-08-26 15:13:40','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(370,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-26',0,'2020-08-26 15:13:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(371,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-08-27',0,'2020-08-27 09:38:37','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(372,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-27',0,'2020-08-27 10:47:35','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(373,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-27',0,'2020-08-27 11:21:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(374,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-27',0,'2020-08-27 11:21:35','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(375,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-27',0,'2020-08-27 11:21:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(376,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-27',0,'2020-08-27 11:21:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(377,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-27',0,'2020-08-27 11:21:44','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(378,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-27',0,'2020-08-27 15:18:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(379,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-27',0,'2020-08-27 15:18:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(380,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-28',0,'2020-08-28 10:17:43','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(381,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-28',0,'2020-08-28 11:51:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(382,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-08-28',0,'2020-08-28 11:52:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(383,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-08-28',0,'2020-08-28 12:39:07','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(384,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-08-28',0,'2020-08-28 15:21:03','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(385,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-08-28',0,'2020-08-28 15:21:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(386,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-08-31',0,'2020-08-31 14:22:26','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(387,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-01',0,'2020-09-01 10:29:58','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(388,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-01',0,'2020-09-01 10:30:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(389,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-01',0,'2020-09-01 10:30:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(390,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-02',0,'2020-09-02 10:25:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(391,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-02',0,'2020-09-02 12:11:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(392,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-02',0,'2020-09-02 12:11:32','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(393,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-09-03',0,'2020-09-03 09:52:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(394,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-03',0,'2020-09-03 09:52:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(395,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-03',0,'2020-09-03 10:07:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(396,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-03',0,'2020-09-03 12:08:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(397,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-03',0,'2020-09-03 15:32:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(398,5,11,4,12,46,15,20,1,123,11658,'b173b225',1,0,0,'2020-09-04',0,'2020-09-04 09:51:29','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(399,5,11,4,12,46,15,20,1,123,11659,'cb443d2290',1,0,0,'2020-09-04',0,'2020-09-04 09:51:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(400,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-04',0,'2020-09-04 09:51:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(401,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-04',0,'2020-09-04 09:53:35','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(402,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-04',0,'2020-09-04 10:43:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(403,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-04',0,'2020-09-04 10:55:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(404,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-04',0,'2020-09-04 14:48:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(405,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-07',0,'2020-09-07 09:45:12','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(406,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-07',0,'2020-09-07 10:20:04','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(407,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-07',0,'2020-09-07 11:42:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(408,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-09-08',0,'2020-09-08 09:37:05','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(409,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-08',0,'2020-09-08 09:44:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(410,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-09-08',0,'2020-09-08 10:52:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(411,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-08',0,'2020-09-08 10:52:43','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(412,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-08',0,'2020-09-08 11:34:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(413,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-09',0,'2020-09-09 09:47:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(414,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-09',0,'2020-09-09 10:47:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(415,5,11,5,11,34,15,20,1,123,11657,'9bce422235',1,0,0,'2020-09-10',0,'2020-09-10 09:48:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(416,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-10',0,'2020-09-10 10:41:51','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(417,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-10',0,'2020-09-10 11:36:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(418,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-11',0,'2020-09-11 09:52:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(419,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-11',0,'2020-09-11 10:55:14','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(420,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-09-11',0,'2020-09-11 11:27:50','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(421,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-11',0,'2020-09-11 11:44:54','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(422,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-14',0,'2020-09-14 09:08:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(423,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-14',0,'2020-09-14 09:49:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(424,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-14',0,'2020-09-14 09:49:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(425,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-14',0,'2020-09-14 10:09:29','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(426,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-09-14',0,'2020-09-14 10:47:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(427,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-14',0,'2020-09-14 12:13:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(428,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-14',0,'2020-09-14 15:26:29','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(429,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-09-15',0,'2020-09-15 09:32:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(430,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-15',0,'2020-09-15 09:49:24','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(431,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-15',0,'2020-09-15 11:14:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(432,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-15',0,'2020-09-15 12:22:39','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(433,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-09-21',0,'2020-09-21 12:38:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(434,5,11,5,11,34,15,20,1,123,11673,'2572a2d52',1,0,0,'2020-09-28',0,'2020-09-28 09:44:18','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(435,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-09-28',0,'2020-09-28 10:18:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(436,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-06',0,'2020-10-06 10:57:42','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(437,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-07',0,'2020-10-07 13:21:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(438,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-08',0,'2020-10-08 11:36:02','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(439,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-09',0,'2020-10-09 10:09:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(440,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-09',0,'2020-10-09 12:04:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(441,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-12',0,'2020-10-12 10:28:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(442,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-12',0,'2020-10-12 10:57:08','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(443,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-14',0,'2020-10-14 10:27:54','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(444,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-14',0,'2020-10-14 10:47:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(445,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-15',0,'2020-10-15 10:48:53','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(446,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-15',0,'2020-10-15 10:49:11','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(447,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-16',0,'2020-10-16 10:24:58','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(448,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-19',0,'2020-10-19 11:15:56','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(449,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-20',0,'2020-10-20 10:13:55','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(450,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-20',0,'2020-10-20 11:07:43','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(451,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-21',0,'2020-10-21 11:46:09','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(452,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-22',0,'2020-10-22 11:25:15','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(453,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-22',0,'2020-10-22 14:59:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(454,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-23',0,'2020-10-23 11:46:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(455,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-26',0,'2020-10-26 10:54:27','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(456,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-10-27',0,'2020-10-27 10:20:34','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(457,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-27',0,'2020-10-27 10:37:10','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(458,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-28',0,'2020-10-28 11:17:00','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(459,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-30',0,'2020-10-30 10:00:46','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(460,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-10-30',0,'2020-10-30 10:00:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(461,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-11-03',0,'2020-11-03 09:59:20','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(462,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-03',0,'2020-11-03 10:42:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(463,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',1,0,0,'2020-11-09',0,'2020-11-09 09:08:57','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(464,5,11,5,11,43,15,20,1,123,11671,'b2a412242',1,0,0,'2020-11-09',0,'2020-11-09 09:14:33','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(465,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-09',0,'2020-11-09 11:01:28','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(466,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-11-09',0,'2020-11-09 12:16:52','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(467,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-10',0,'2020-11-10 09:47:31','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(468,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-11-11',0,'2020-11-11 09:31:17','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(469,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-11',0,'2020-11-11 10:20:38','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(470,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-12',0,'2020-11-12 12:41:22','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(471,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-11-13',0,'2020-11-13 10:18:49','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(472,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-13',0,'2020-11-13 10:40:41','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(473,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-16',0,'2020-11-16 11:03:30','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(474,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',1,0,0,'2020-11-16',0,'2020-11-16 13:28:25','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(475,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-17',0,'2020-11-17 10:53:13','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(476,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',1,0,0,'2020-11-18',0,'2020-11-18 10:52:45','2020-12-15 11:32:24','2020-12-15 11:32:24','192.168.1.250',0,'',''),
(477,5,11,5,11,34,15,20,1,124,11677,'ab73ba1c7e',0,1,0,'2020-12-15',0,'2020-12-15 14:56:57','2020-12-15 14:56:57','2020-12-15 14:56:57','samsung SM-G955N',0,'-7.6132133, 110.9676733',''),
(478,5,11,5,11,34,15,20,1,123,11657,'9bce422235',0,1,0,'2020-12-15',0,'2020-12-15 14:57:58','2020-12-15 14:57:58','2020-12-15 14:57:58','samsung SM-G955N',0,'-7.6132133, 110.9676733',''),
(479,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',0,1,0,'2020-12-15',0,'2020-12-15 15:38:13','2020-12-15 15:38:13','2020-12-15 15:38:13','samsung SM-G965N',0,'-7.5590083, 110.7918167',''),
(480,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',0,0,1,'2020-12-15',0,'2020-12-15 15:53:56','2020-12-15 15:53:56','2020-12-15 15:53:56','xiaomi Redmi 5 Plus',0,'','-7.5770028, 110.8926236'),
(481,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',0,1,0,'2020-12-15',0,'2020-12-15 15:55:45','2020-12-15 15:55:45','2020-12-15 15:55:45','xiaomi Redmi 5 Plus',0,'-7.5770815, 110.8925566',''),
(482,5,11,4,12,46,15,20,1,123,11658,'b173b225',0,1,0,'2020-12-15',0,'2020-12-15 15:57:26','2020-12-15 15:57:26','2020-12-15 15:57:26','xiaomi Redmi 5 Plus',0,'-7.5770576, 110.8925956',''),
(483,5,11,5,11,45,15,20,1,123,11656,'4b6b3c223e',0,1,0,'2020-12-15',0,'2020-12-15 15:59:06','2020-12-15 15:59:06','2020-12-15 15:59:06','xiaomi Redmi 5 Plus',0,'-7.5770927, 110.8925869',''),
(484,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',0,1,0,'2020-12-16',0,'2020-12-16 09:40:03','2020-12-16 09:40:03','2020-12-16 09:40:03','ADVAN 6201',0,'-7.5770808, 110.8925528',''),
(485,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',0,1,0,'2020-12-16',0,'2020-12-16 09:43:46','2020-12-16 09:43:46','2020-12-16 09:43:46','samsung SM-G965N',0,'-7.5668367, 110.8003983',''),
(486,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',0,1,0,'2020-12-16',0,'2020-12-16 11:11:19','2020-12-16 11:11:19','2020-12-16 11:11:19','ADVAN 6201',0,'-7.5729472, 110.830078',''),
(487,5,11,5,11,44,15,20,1,123,11672,'cb474a22e4',0,1,0,'2020-12-22',0,'2020-12-22 11:30:54','2020-12-22 11:30:54','2020-12-22 11:30:54','ADVAN 6201',0,'-7.5739436, 110.8305186',''),
(488,5,11,5,11,34,15,20,1,123,11670,'db484a22fb',0,1,0,'2020-12-31',0,'2020-12-31 09:58:50','2020-12-31 09:58:50','2020-12-31 09:58:50','xiaomi Redmi 5 Plus',0,'-7.5770708, 110.8925533','');

/*Table structure for table `hro_employee_attendance_data` */

DROP TABLE IF EXISTS `hro_employee_attendance_data`;

CREATE TABLE `hro_employee_attendance_data` (
  `employee_attendance_data_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_attendance_date` date DEFAULT NULL,
  `employee_attendance_date_status_default` decimal(1,0) DEFAULT 0,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_in_date` datetime DEFAULT NULL,
  `employee_attendance_out_date` datetime DEFAULT NULL,
  `employee_attendance_working_in_date` datetime DEFAULT NULL,
  `employee_attendance_working_out_date` datetime DEFAULT NULL,
  `employee_attendance_working_time_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_working_time_minutes` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_working_total_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_working_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_working_status` decimal(1,0) DEFAULT 9,
  `employee_attendance_status` decimal(1,0) DEFAULT 9,
  `employee_attendance_late_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_late_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_late_minutes` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_overtime_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_overtime_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_overtime_minutes` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_overtime_dayoff` decimal(1,0) DEFAULT 0,
  `employee_attendance_homeearly_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_homeearly_hours` decimal(10,2) DEFAULT 0.00,
  `employee_attendance_homeearly_minutes` decimal(10,2) DEFAULT 0.00,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_data_id`),
  KEY `FK_hro_employee_attendance_data_region_id` (`region_id`),
  KEY `FK_hro_employee_attendance_data_branch_id` (`branch_id`),
  KEY `FK_hro_employee_attendance_data_location_id` (`location_id`),
  KEY `FK_hro_employee_attendance_data_division_id` (`division_id`),
  KEY `FK_hro_employee_attendance_data_department_id` (`department_id`),
  KEY `FK_hro_employee_attendance_data_section_id` (`section_id`),
  KEY `FK_hro_employee_attendance_data_unit_id` (`unit_id`),
  KEY `FK_hro_employee_attendance_data_shift_id` (`shift_id`),
  KEY `FK_hro_employee_attendance_data_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_attendance_data_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_data` */

/*Table structure for table `hro_employee_attendance_data_log` */

DROP TABLE IF EXISTS `hro_employee_attendance_data_log`;

CREATE TABLE `hro_employee_attendance_data_log` (
  `employee_attendance_data_log_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `monthly_period_start_date` date DEFAULT NULL,
  `monthly_period_end_date` date DEFAULT NULL,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `monthly_period_id` bigint(22) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_data_log_id`),
  KEY `FK_hro_employee_attendance_data_log_region_id` (`region_id`),
  KEY `FK_hro_employee_attendance_data_log_branch_id` (`branch_id`),
  KEY `FK_hro_employee_attendance_data_log_location_id` (`location_id`),
  KEY `FK_hro_employee_attendance_data_log_monthly_period_id` (`monthly_period_id`),
  CONSTRAINT `FK_hro_employee_attendance_data_log_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_data_log_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_data_log_monthly_period_id` FOREIGN KEY (`monthly_period_id`) REFERENCES `payroll_monthly_period` (`monthly_period_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_data_log_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_data_log` */

/*Table structure for table `hro_employee_attendance_download_log` */

DROP TABLE IF EXISTS `hro_employee_attendance_download_log`;

CREATE TABLE `hro_employee_attendance_download_log` (
  `attendance_download_log_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `attendance_download_log_date` date DEFAULT NULL,
  `machine_ip_address` varchar(50) DEFAULT '',
  `employee_attendance_status` decimal(1,0) DEFAULT 0,
  `attendance_download_log_start_total` decimal(10,0) DEFAULT 0,
  `attendance_download_log_end_total` decimal(10,0) DEFAULT 0,
  `attendance_download_log_status` decimal(1,0) NOT NULL DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`attendance_download_log_id`),
  KEY `attendance_download_log_date` (`attendance_download_log_date`),
  KEY `machine_ip_address` (`machine_ip_address`),
  KEY `employee_attendance_status` (`employee_attendance_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_download_log` */

/*Table structure for table `hro_employee_attendance_log` */

DROP TABLE IF EXISTS `hro_employee_attendance_log`;

CREATE TABLE `hro_employee_attendance_log` (
  `employee_attendance_log_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_attendance_log_period` decimal(10,0) DEFAULT 0,
  `day_01` decimal(1,0) DEFAULT 0,
  `day_02` decimal(1,0) DEFAULT 0,
  `day_03` decimal(1,0) DEFAULT 0,
  `day_04` decimal(1,0) DEFAULT 0,
  `day_05` decimal(1,0) DEFAULT 0,
  `day_06` decimal(1,0) DEFAULT 0,
  `day_07` decimal(1,0) DEFAULT 0,
  `day_08` decimal(1,0) DEFAULT 0,
  `day_09` decimal(1,0) DEFAULT 0,
  `day_10` decimal(1,0) DEFAULT 0,
  `day_11` decimal(1,0) DEFAULT 0,
  `day_12` decimal(1,0) DEFAULT 0,
  `day_13` decimal(1,0) DEFAULT 0,
  `day_14` decimal(1,0) DEFAULT 0,
  `day_15` decimal(1,0) DEFAULT 0,
  `day_16` decimal(1,0) DEFAULT 0,
  `day_17` decimal(1,0) DEFAULT 0,
  `day_18` decimal(1,0) DEFAULT 0,
  `day_19` decimal(1,0) DEFAULT 0,
  `day_20` decimal(1,0) DEFAULT 0,
  `day_21` decimal(1,0) DEFAULT 0,
  `day_22` decimal(1,0) DEFAULT 0,
  `day_23` decimal(1,0) DEFAULT 0,
  `day_24` decimal(1,0) DEFAULT 0,
  `day_25` decimal(1,0) DEFAULT 0,
  `day_26` decimal(1,0) DEFAULT 0,
  `day_27` decimal(1,0) DEFAULT 0,
  `day_28` decimal(1,0) DEFAULT 0,
  `day_29` decimal(1,0) DEFAULT 0,
  `day_30` decimal(1,0) DEFAULT 0,
  `day_31` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_log_id`),
  KEY `FK_hro_employee_attendance_log_region_id` (`region_id`),
  KEY `FK_hro_employee_attendance_log_branch_id` (`branch_id`),
  KEY `FK_hro_employee_attendance_log_location_id` (`location_id`),
  KEY `FK_hro_employee_attendance_log_division_id` (`division_id`),
  KEY `FK_hro_employee_attendance_log_department_id` (`department_id`),
  KEY `FK_hro_employee_attendance_log_section_id` (`section_id`),
  KEY `FK_hro_employee_attendance_log_unit_id` (`unit_id`),
  KEY `FK_hro_employee_attendance_log_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_attendance_log_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_attendance_log_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_log_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_log` */

insert  into `hro_employee_attendance_log`(`employee_attendance_log_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`department_id`,`section_id`,`unit_id`,`shift_id`,`employee_shift_id`,`employee_id`,`employee_rfid_code`,`employee_attendance_log_period`,`day_01`,`day_02`,`day_03`,`day_04`,`day_05`,`day_06`,`day_07`,`day_08`,`day_09`,`day_10`,`day_11`,`day_12`,`day_13`,`day_14`,`day_15`,`day_16`,`day_17`,`day_18`,`day_19`,`day_20`,`day_21`,`day_22`,`day_23`,`day_24`,`day_25`,`day_26`,`day_27`,`day_28`,`day_29`,`day_30`,`day_31`,`created_id`,`created_on`,`last_update`) values 
(1,5,11,20,5,11,34,15,1,123,11658,'b173b225',202006,0,0,0,0,1,1,0,1,1,0,0,1,0,0,1,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,NULL,'2020-06-05 09:49:54','2020-06-05 09:49:54'),
(2,5,11,20,5,11,34,15,1,123,11673,'2572a2d52',202006,0,0,0,0,1,1,0,1,1,1,1,0,0,0,1,1,1,0,0,0,0,1,1,1,1,1,0,0,1,1,0,NULL,'2020-06-05 09:49:54','2020-06-05 09:49:54'),
(3,5,11,20,5,11,34,15,1,123,11659,'cb443d2290',202006,0,0,0,0,1,1,0,1,1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-06-05 09:49:54','2020-06-05 09:49:54'),
(4,5,11,20,5,11,34,15,19,NULL,11679,'3bc53a22e6',202006,0,0,0,0,1,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-06-05 09:49:54','2020-06-05 09:49:54'),
(5,5,11,20,5,11,34,15,18,NULL,11677,'ab73ba1c7e',202006,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-06-05 16:02:31','2020-06-05 16:02:31'),
(6,5,11,20,5,11,34,15,1,123,11656,'4b6b3c223e',202006,0,0,0,0,0,1,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,0,1,1,1,0,0,0,0,1,0,NULL,'2020-06-06 08:09:34','2020-06-06 08:09:34'),
(7,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202006,0,0,0,0,0,1,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,1,1,1,0,0,1,1,0,NULL,'2020-06-06 08:09:37','2020-06-06 08:09:37'),
(8,5,11,20,5,11,34,15,1,123,11671,'b2a412242',202006,0,0,0,0,0,1,0,1,1,0,0,1,0,0,1,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,NULL,'2020-06-06 08:09:40','2020-06-06 08:09:40'),
(9,5,11,20,5,11,34,15,1,123,11657,'9bce422235',202006,0,0,0,0,0,1,0,1,1,1,0,1,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,NULL,'2020-06-06 08:09:43','2020-06-06 08:09:43'),
(10,5,11,20,5,11,34,15,1,123,11672,'cb474a22e4',202006,0,0,0,0,0,1,0,1,1,0,0,1,0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,NULL,'2020-06-06 08:09:47','2020-06-06 08:09:47'),
(11,5,11,20,5,11,34,15,1,123,11673,'2572a2d52',202007,1,1,1,0,0,1,1,1,1,0,0,0,1,1,1,0,1,0,0,1,0,1,1,1,0,0,1,1,1,0,0,NULL,'2020-07-01 09:51:12','2020-07-01 09:51:12'),
(12,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202007,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,1,0,0,0,0,NULL,'2020-07-01 09:53:56','2020-07-01 09:53:56'),
(13,5,11,20,5,11,34,15,1,123,11657,'9bce422235',202007,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,1,0,0,0,0,0,0,0,NULL,'2020-07-01 10:27:01','2020-07-01 10:27:01'),
(14,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202007,1,1,1,0,0,1,1,1,1,0,0,0,1,1,1,0,1,0,0,1,0,1,1,0,0,0,1,1,0,0,0,NULL,'2020-07-01 11:18:44','2020-07-01 11:18:44'),
(15,5,11,20,5,11,43,15,1,123,11671,'b2a412242',202007,1,1,0,0,0,1,1,1,1,0,0,0,1,0,0,0,1,0,0,1,1,1,1,1,0,0,1,1,0,0,0,NULL,'2020-07-01 15:21:58','2020-07-01 15:21:58'),
(16,5,11,20,5,11,44,15,1,123,11672,'cb474a22e4',202007,0,0,0,0,0,0,1,1,1,1,0,0,0,0,1,0,1,0,0,1,0,0,1,1,0,0,0,1,0,0,0,NULL,'2020-07-07 11:09:02','2020-07-07 11:09:02'),
(17,5,11,20,5,11,34,15,1,123,11673,'2572a2d52',202008,0,0,1,0,1,1,1,0,0,1,1,0,1,1,0,0,0,1,1,0,0,0,0,1,1,1,1,0,0,0,0,NULL,'2020-08-03 09:57:05','2020-08-03 09:57:05'),
(18,5,11,20,5,11,43,15,1,123,11671,'b2a412242',202008,0,0,0,0,1,1,1,0,0,1,1,1,1,1,0,0,0,1,1,0,0,0,0,1,1,1,1,1,0,0,0,NULL,'2020-08-05 09:53:48','2020-08-05 09:53:48'),
(19,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202008,0,0,0,0,1,1,1,0,0,1,1,1,1,1,0,0,0,0,1,0,0,0,0,0,1,1,1,1,0,0,0,NULL,'2020-08-05 11:56:10','2020-08-05 11:56:10'),
(20,5,11,20,5,11,44,15,1,123,11672,'cb474a22e4',202008,0,0,0,0,1,0,1,0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,NULL,'2020-08-05 13:53:56','2020-08-05 13:53:56'),
(21,5,11,20,5,11,34,15,1,123,11657,'9bce422235',202008,0,0,0,0,0,1,1,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,1,1,1,0,0,0,NULL,'2020-08-06 11:53:31','2020-08-06 11:53:31'),
(22,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202008,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,NULL,'2020-08-11 10:21:15','2020-08-11 10:21:15'),
(23,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202009,1,1,1,1,0,0,1,0,0,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-01 10:29:58','2020-09-01 10:29:58'),
(24,5,11,20,5,11,34,15,1,123,11673,'2572a2d52',202009,0,1,1,1,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,NULL,'2020-09-02 10:25:17','2020-09-02 10:25:17'),
(25,5,11,20,4,12,46,15,1,123,11659,'cb443d2290',202009,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-03 09:52:51','2020-09-03 09:52:51'),
(26,5,11,20,5,11,43,15,1,123,11671,'b2a412242',202009,0,0,1,1,0,0,0,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-03 10:07:00','2020-09-03 10:07:00'),
(27,5,11,20,4,12,46,15,1,123,11658,'b173b225',202009,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-04 09:51:29','2020-09-04 09:51:29'),
(28,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202009,0,0,0,1,0,0,1,1,1,1,1,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,NULL,'2020-09-04 10:43:38','2020-09-04 10:43:38'),
(29,5,11,20,5,11,34,15,1,123,11657,'9bce422235',202009,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-08 09:37:05','2020-09-08 09:37:05'),
(30,5,11,20,5,11,44,15,1,123,11672,'cb474a22e4',202009,0,0,0,0,0,0,0,1,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-09-08 10:52:39','2020-09-08 10:52:39'),
(31,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202010,0,0,0,0,0,1,0,0,1,0,0,1,0,1,1,1,0,0,0,1,0,1,1,0,0,1,1,0,0,0,0,NULL,'2020-10-06 10:57:42','2020-10-06 10:57:42'),
(32,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202010,0,0,0,0,0,0,1,1,1,0,0,1,0,1,1,0,0,0,1,1,1,1,0,0,0,0,1,1,0,1,0,NULL,'2020-10-07 13:21:15','2020-10-07 13:21:15'),
(33,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202011,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-11-03 09:59:20','2020-11-03 09:59:20'),
(34,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202011,0,0,1,0,0,0,0,0,1,1,1,1,1,0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-11-03 10:42:38','2020-11-03 10:42:38'),
(35,5,11,20,5,11,43,15,1,123,11671,'b2a412242',202011,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-11-09 09:14:33','2020-11-09 09:14:33'),
(36,5,11,20,5,11,44,15,1,123,11672,'cb474a22e4',202011,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-11-09 12:16:52','2020-11-09 12:16:52'),
(37,5,11,20,5,11,34,15,1,124,11677,'ab73ba1c7e',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,22,'2020-12-15 14:56:57','2020-12-15 14:56:57'),
(38,5,11,20,5,11,34,15,1,123,11657,'9bce422235',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,19,'2020-12-15 14:57:58','2020-12-15 14:57:58'),
(39,5,11,20,5,11,44,15,1,123,11672,'cb474a22e4',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,25,'2020-12-15 15:38:13','2020-12-15 15:38:13'),
(40,5,11,20,5,11,34,15,1,123,11670,'db484a22fb',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,21,'2020-12-15 15:55:45','2020-12-15 15:55:45'),
(41,5,11,20,4,12,46,15,1,123,11658,'b173b225',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,27,'2020-12-15 15:57:26','2020-12-15 15:57:26'),
(42,5,11,20,5,11,45,15,1,123,11656,'4b6b3c223e',202012,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,26,'2020-12-15 15:59:06','2020-12-15 15:59:06');

/*Table structure for table `hro_employee_attendance_status` */

DROP TABLE IF EXISTS `hro_employee_attendance_status`;

CREATE TABLE `hro_employee_attendance_status` (
  `employee_attendance_status_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_attendance_date` date DEFAULT NULL,
  `employee_attendance_date_status_old` decimal(1,0) DEFAULT 0,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_status_description` varchar(250) DEFAULT '',
  `employee_attendance_status_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_status_id`),
  KEY `FK_hro_employee_attendance_status_employee_id` (`employee_id`),
  KEY `FK_hro_employee_attendance_status_employee_attendance_data_id` (`employee_attendance_data_id`),
  CONSTRAINT `FK_hro_employee_attendance_status_employee_attendance_data_id` FOREIGN KEY (`employee_attendance_data_id`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_status_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_status` */

/*Table structure for table `hro_employee_attendance_total` */

DROP TABLE IF EXISTS `hro_employee_attendance_total`;

CREATE TABLE `hro_employee_attendance_total` (
  `employee_attendance_total_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_monthly_start_date` date DEFAULT NULL,
  `employee_monthly_end_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_total_id`),
  KEY `FK_hro_employee_attendance_total_region_id` (`region_id`),
  KEY `FK_hro_employee_attendance_total_branch_id` (`branch_id`),
  KEY `FK_hro_employee_attendance_total_location_id` (`location_id`),
  KEY `FK_hro_employee_attendance_total_employee_shift_id` (`employee_shift_id`),
  KEY `employee_monthly_period` (`employee_monthly_period`),
  CONSTRAINT `FK_hro_employee_attendance_total_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_total` */

/*Table structure for table `hro_employee_attendance_total_item` */

DROP TABLE IF EXISTS `hro_employee_attendance_total_item`;

CREATE TABLE `hro_employee_attendance_total_item` (
  `employee_attendance_total_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_attendance_total_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `bank_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_monthly_start_date` date DEFAULT NULL,
  `employee_monthly_end_date` date DEFAULT NULL,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `employee_hire_date` date DEFAULT NULL,
  `employee_working_months` decimal(10,2) DEFAULT 0.00,
  `employee_bank_acct_no` varchar(50) DEFAULT '',
  `employee_bank_acct_name` varchar(200) DEFAULT '',
  `total_working_days` decimal(10,2) DEFAULT 0.00,
  `total_working_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_working_off_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_default_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_permit_with_doctor_days` decimal(10,2) DEFAULT 0.00,
  `total_permit_with_doctor_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_permit_no_doctor_days` decimal(10,2) DEFAULT 0.00,
  `total_permit_no_doctor_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_absence_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_cancel_off_payrol_days` decimal(10,2) DEFAULT 0.00,
  `total_swap_off_payroll_days` decimal(10,2) DEFAULT 0.00,
  `total_early_days` decimal(10,2) DEFAULT 0.00,
  `total_early_payroll_less_1_days` decimal(10,2) DEFAULT 0.00,
  `total_early_payroll_less_5_days` decimal(10,2) DEFAULT 0.00,
  `total_early_payroll_more_5_days` decimal(10,2) DEFAULT 0.00,
  `total_early_hours_list` text DEFAULT NULL,
  `total_late_days` decimal(10,2) DEFAULT 0.00,
  `total_late_hours` decimal(10,2) DEFAULT 0.00,
  `total_late_minutes` decimal(10,2) DEFAULT 0.00,
  `total_overtime_days` decimal(10,2) DEFAULT 0.00,
  `total_overtime_hours` decimal(10,2) DEFAULT 0.00,
  `total_overtime_minutes` decimal(10,2) DEFAULT 0.00,
  `total_overtime_hours_list` text DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_attendance_total_item_id`),
  KEY `FK_hro_employee_attendance_total_item_attendance_total_id` (`employee_attendance_total_id`),
  KEY `FK_hro_employee_attendance_total_item_employee_id` (`employee_id`),
  KEY `FK_hro_employee_attendance_total_item_division_id` (`division_id`),
  KEY `FK_hro_employee_attendance_total_item_department_id` (`department_id`),
  KEY `FK_hro_employee_attendance_total_item_section_id` (`section_id`),
  KEY `FK_hro_employee_attendance_total_item_unit_id` (`unit_id`),
  KEY `FK_hro_employee_attendance_total_item_job_title_id` (`job_title_id`),
  KEY `FK_hro_employee_attendance_total_item_bank_id` (`bank_id`),
  CONSTRAINT `FK_hro_employee_attendance_total_item_attendance_total_id` FOREIGN KEY (`employee_attendance_total_id`) REFERENCES `hro_employee_attendance_total` (`employee_attendance_total_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `core_bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_attendance_total_item_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_attendance_total_item` */

/*Table structure for table `hro_employee_award` */

DROP TABLE IF EXISTS `hro_employee_award`;

CREATE TABLE `hro_employee_award` (
  `employee_award_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `award_id` int(10) DEFAULT 0,
  `employee_award_date` date DEFAULT NULL,
  `employee_award_description` varchar(250) DEFAULT '',
  `employee_award_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_award_id`),
  KEY `FK_transaction_employee_award_employee_id` (`employee_id`),
  KEY `FK_hro_employee_award_award_id` (`award_id`),
  CONSTRAINT `FK_hro_employee_award_award_id` FOREIGN KEY (`award_id`) REFERENCES `core_award` (`award_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_award_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_award` */

/*Table structure for table `hro_employee_bonus` */

DROP TABLE IF EXISTS `hro_employee_bonus`;

CREATE TABLE `hro_employee_bonus` (
  `employee_bonus_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('1','0') DEFAULT '1',
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_bonus_period` decimal(6,0) DEFAULT 0,
  `employee_bonus_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_bonus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_bonus` */

/*Table structure for table `hro_employee_cancel_off` */

DROP TABLE IF EXISTS `hro_employee_cancel_off`;

CREATE TABLE `hro_employee_cancel_off` (
  `employee_cancel_off_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_cancel_off_date` date DEFAULT NULL,
  `employee_cancel_off_description` varchar(250) DEFAULT '',
  `employee_cancel_off_remark` text DEFAULT NULL,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_cancel_off_id`),
  KEY `FK_hro_employee_cancel_off_employee_id` (`employee_id`),
  KEY `FK_hro_employee_cancel_off_employee_attendance_data_id` (`employee_attendance_data_id`),
  CONSTRAINT `FK_hro_employee_cancel_off_employee_attendance_data_id` FOREIGN KEY (`employee_attendance_data_id`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_cancel_off_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_cancel_off` */

/*Table structure for table `hro_employee_change_group` */

DROP TABLE IF EXISTS `hro_employee_change_group`;

CREATE TABLE `hro_employee_change_group` (
  `employee_change_group_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `location_id_old` int(10) DEFAULT 0,
  `employee_shift_id_old` bigint(22) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_change_group_date` date DEFAULT NULL,
  `employee_change_group_reason` varchar(250) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_change_group_id`),
  KEY `FK_hro_employee_change_group_location_id_old` (`location_id_old`),
  KEY `FK_hro_employee_change_group_employee_shift_id_old` (`employee_shift_id_old`),
  KEY `FK_hro_employee_change_group_location_id` (`location_id`),
  KEY `FK_hro_employee_change_group_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_change_group_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_change_group_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_change_group_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_change_group_employee_shift_id_old` FOREIGN KEY (`employee_shift_id_old`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_change_group_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_change_group_location_id_old` FOREIGN KEY (`location_id_old`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_change_group` */

/*Table structure for table `hro_employee_change_rfid` */

DROP TABLE IF EXISTS `hro_employee_change_rfid`;

CREATE TABLE `hro_employee_change_rfid` (
  `employee_change_rfid_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_change_rfid_date` date DEFAULT NULL,
  `employee_rfid_code_old` varchar(20) DEFAULT '',
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_change_rfid_reason` varchar(250) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_change_rfid_id`),
  KEY `FK_hro_employee_change_rfid_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_change_rfid_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_change_rfid` */

/*Table structure for table `hro_employee_data` */

DROP TABLE IF EXISTS `hro_employee_data`;

CREATE TABLE `hro_employee_data` (
  `employee_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `marital_status_id` int(10) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `bank_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_name` varchar(50) DEFAULT '',
  `employee_address` text DEFAULT NULL,
  `employee_city` varchar(50) DEFAULT '',
  `employee_rt` varchar(5) DEFAULT '',
  `employee_rw` varchar(5) DEFAULT '',
  `employee_kelurahan` varchar(50) DEFAULT '',
  `employee_kecamatan` varchar(50) DEFAULT '',
  `employee_postal_code` varchar(5) DEFAULT '',
  `employee_residential_address` text DEFAULT NULL,
  `employee_mobile_phone` varchar(30) DEFAULT '',
  `employee_email_address` varchar(50) DEFAULT '',
  `employee_id_type` decimal(1,0) DEFAULT 0,
  `employee_place_of_birth` varchar(50) DEFAULT '',
  `employee_religion` decimal(1,0) DEFAULT 0 COMMENT '0 : Moslem, 1 : Christian, 2 : Catholic, 3 : Hindu, 4 : Budha',
  `employee_blood_type` decimal(1,0) DEFAULT 0,
  `employee_id_number` varchar(20) DEFAULT '',
  `employee_date_of_birth` date DEFAULT NULL,
  `employee_residential_city` varchar(50) DEFAULT '',
  `employee_residential_rt` varchar(5) DEFAULT '',
  `employee_residential_rw` varchar(5) DEFAULT '',
  `employee_residential_kecamatan` varchar(50) DEFAULT '',
  `employee_residential_kelurahan` varchar(50) DEFAULT '',
  `employee_residential_postal_code` varchar(5) DEFAULT '',
  `employee_gender` decimal(1,0) DEFAULT 0 COMMENT '0 : Female, 1 : Male',
  `employee_home_phone` varchar(30) DEFAULT '',
  `employee_heir_name` varchar(50) DEFAULT '',
  `employee_photo` text DEFAULT NULL,
  `employee_status` decimal(1,0) DEFAULT 1 COMMENT '1 : Active, 0 : Resign',
  `employee_remark` text DEFAULT NULL,
  `employee_employment_working_status` decimal(1,0) DEFAULT NULL COMMENT '1 : Monthly, 0 : Daily',
  `employee_hire_date` date DEFAULT NULL,
  `employee_employment_status` decimal(1,0) DEFAULT NULL COMMENT '1 : Permanent, 2 : Probation, 3 : Contract',
  `employee_employment_status_date` date DEFAULT NULL,
  `employee_employment_status_duedate` date DEFAULT NULL,
  `employee_employment_overtime_status` decimal(1,0) DEFAULT 0,
  `payroll_employee_level` decimal(1,0) DEFAULT 0,
  `employee_last_day_off` date DEFAULT NULL,
  `employee_day_off_cycle` varchar(10) DEFAULT '0',
  `employee_day_off_status` decimal(1,0) DEFAULT 0 COMMENT '0 : Sunday Day Off Include, 1 : Sunday Day Off Exclude',
  `employee_picture` longblob DEFAULT NULL,
  `employee_bank_acct_no` varchar(50) DEFAULT '',
  `employee_bank_acct_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `record_id` bigint(22) DEFAULT 0,
  PRIMARY KEY (`employee_id`),
  KEY `FK_hro_employee_data_region_id` (`region_id`),
  KEY `FK_hro_employee_data_branch_id` (`branch_id`),
  KEY `FK_hro_employee_data_division_id` (`division_id`),
  KEY `FK_hro_employee_data_department_id` (`department_id`),
  KEY `FK_hro_employee_data_section_id` (`section_id`),
  KEY `FK_hro_employee_data_job_title_id` (`job_title_id`),
  KEY `FK_hro_employee_data_grade_id` (`grade_id`),
  KEY `FK_hro_employee_data_class_id` (`class_id`),
  KEY `FK_hro_employee_data_location_id` (`location_id`),
  KEY `FK_hro_employee_data_marital_status_id` (`marital_status_id`),
  KEY `FK_hro_employee_data_unit_id` (`unit_id`),
  KEY `employee_code` (`employee_code`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  KEY `employee_status` (`employee_status`),
  KEY `FK_hro_employee_data_bank_id` (`bank_id`),
  CONSTRAINT `FK_hro_employee_data_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `core_bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_class_id` FOREIGN KEY (`class_id`) REFERENCES `core_class` (`class_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_marital_status_id` FOREIGN KEY (`marital_status_id`) REFERENCES `core_marital_status` (`marital_status_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_data_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11680 DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_data` */

insert  into `hro_employee_data`(`employee_id`,`marital_status_id`,`region_id`,`branch_id`,`division_id`,`department_id`,`section_id`,`unit_id`,`job_title_id`,`grade_id`,`class_id`,`location_id`,`bank_id`,`employee_shift_id`,`employee_code`,`employee_rfid_code`,`employee_name`,`employee_address`,`employee_city`,`employee_rt`,`employee_rw`,`employee_kelurahan`,`employee_kecamatan`,`employee_postal_code`,`employee_residential_address`,`employee_mobile_phone`,`employee_email_address`,`employee_id_type`,`employee_place_of_birth`,`employee_religion`,`employee_blood_type`,`employee_id_number`,`employee_date_of_birth`,`employee_residential_city`,`employee_residential_rt`,`employee_residential_rw`,`employee_residential_kecamatan`,`employee_residential_kelurahan`,`employee_residential_postal_code`,`employee_gender`,`employee_home_phone`,`employee_heir_name`,`employee_photo`,`employee_status`,`employee_remark`,`employee_employment_working_status`,`employee_hire_date`,`employee_employment_status`,`employee_employment_status_date`,`employee_employment_status_duedate`,`employee_employment_overtime_status`,`payroll_employee_level`,`employee_last_day_off`,`employee_day_off_cycle`,`employee_day_off_status`,`employee_picture`,`employee_bank_acct_no`,`employee_bank_acct_name`,`data_state`,`created_id`,`created_on`,`last_update`,`record_id`) values 
(11656,1,5,11,5,11,45,15,19,1,1,20,1,123,'WR201909001','4b6b3c223e','WIDI NUGROHO KUSJUNIADI','','','','','','','','','85725620579','',0,'SURAKARTA',0,0,'3372041206720000','1972-06-12','','','','','','',0,'','LESTARI',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:57:48','2020-06-04 11:20:28',0),
(11657,1,5,11,5,11,34,15,3,1,1,20,1,123,'WR201909002','9bce422235','EMILYA','','','','','','','','','82110501111','',0,'BANDUNG',0,0,'3372045307770000','1977-07-13','','','','','','',0,'','LANA ROSSANA PRAJANATA',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:55:19','2020-06-04 11:20:28',0),
(11658,1,5,11,4,12,46,15,1,1,1,20,1,123,'WR201909003','b173b225','LIMARAN AJIBIMO','','','','','','','','','89674012091','',0,'SURAKARTA',0,0,'3313116509910000','1981-09-25','','','','','','',0,'','ANIK WARSINI',NULL,1,'BU1',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:53:39','2020-06-04 11:20:28',0),
(11659,1,5,11,4,12,46,15,1,1,1,20,1,123,'WR201909004','cb443d2290','FRISKA PRADITASARI','','','','','','','','','85642066337','',0,'KLATEN',0,0,'3313116510900000','1990-10-25','','','','','','',0,'','SRI MULYANI',NULL,1,'BU1',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:52:14','2020-06-04 11:20:28',0),
(11670,1,5,11,5,11,34,15,18,1,1,20,1,123,'AB2019090001','db484a22fb','DENY NUGROHO WIBOWO','','','','','','','','','82136361818','',0,'SURAKARTA',0,0,'3372030509720000','1972-09-06','','','','','','',0,'','TJHIN LIONG FOENG',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-11 09:54:59','2020-06-04 11:26:53',0),
(11671,1,5,11,5,11,43,15,2,1,1,20,1,123,'AB2019090003','b2a412242','CUK KURNIAWAN,SE','','','','','','','','','82137407070','',0,'SURAKARTA',0,0,'3313110804780000','1978-04-08','','','','','','',0,'','SRI LUSTARI',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:56:26','2020-06-04 11:26:53',0),
(11672,1,5,11,5,11,44,15,2,1,1,20,1,123,'AB2019090004','cb474a22e4','ANTONIUS IRAWAN EKO S,SE','','','','','','','','','82152624433','',0,'SURAKARTA',0,0,'3311081703750000','1975-03-17','','','','','','',1,'','SRI SARINI',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-12-16 10:34:59','2020-06-04 11:26:53',0),
(11673,1,5,11,5,11,34,15,1,1,1,20,1,123,'AB2019090002','2572a2d52','WATIK ANGGARSARI','','','','','','','','','895328093232','',0,'SURAKARTA',0,0,'3372056810820000','1982-10-28','','','','','','',0,'','SUWARNI',NULL,1,'',1,'1970-01-01',1,'1970-01-01','1970-01-01',0,0,NULL,'0',0,NULL,'','',0,0,'2020-06-04 11:53:06','2020-06-04 11:26:53',0),
(11677,1,NULL,NULL,5,11,34,15,1,1,1,NULL,1,124,'AATRIALDD','ab73ba1c7e','user-trial','','','','','','','','','','',0,'Solo',0,0,'12345','1998-06-04','','','','','','',0,'','',NULL,1,'',1,'2020-06-04',1,'2020-06-04','2020-06-04',0,1,NULL,'0',0,NULL,'','',0,0,'2020-12-31 10:00:05','2020-06-04 15:30:21',0),
(11679,1,5,11,5,11,34,15,1,1,1,20,1,125,'AATRIALEE','3bc53a22e6','SALWA','-','Solo','2','3','Banjarsari','Jebres','0','','','',0,'Solo',1,3,'010719','1998-06-05','','','','','','',0,'','',NULL,1,'',1,'2020-06-05',3,'2020-06-05','2020-06-05',0,1,NULL,'0',0,NULL,'','',0,0,'2020-06-05 09:21:30','2020-06-05 09:16:52',0);

/*Table structure for table `hro_employee_document` */

DROP TABLE IF EXISTS `hro_employee_document`;

CREATE TABLE `hro_employee_document` (
  `employee_document_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `document_book_id` int(10) DEFAULT 0,
  `employee_document_receipt_date` date DEFAULT NULL,
  `employee_document_status` decimal(1,0) DEFAULT 0,
  `employee_document_returned_date` date DEFAULT NULL,
  `returned_id` int(10) DEFAULT 0,
  `returned_on` datetime DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_document_id`),
  KEY `FK_hro_employee_document_employee_id` (`employee_id`),
  KEY `FK_hro_employee_document_document_book_id` (`document_book_id`),
  CONSTRAINT `FK_hro_employee_document_document_book_id` FOREIGN KEY (`document_book_id`) REFERENCES `core_document_book` (`document_book_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_document_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_document` */

/*Table structure for table `hro_employee_document_item` */

DROP TABLE IF EXISTS `hro_employee_document_item`;

CREATE TABLE `hro_employee_document_item` (
  `employee_document_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_document_id` bigint(22) DEFAULT 0,
  `employee_document_item_name` varchar(250) DEFAULT '',
  `employee_document_item_filename` varchar(250) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_document_item_id`),
  KEY `FK_hro_employee_document_item_employee_document_id` (`employee_document_id`),
  CONSTRAINT `FK_hro_employee_document_item_employee_document_id` FOREIGN KEY (`employee_document_id`) REFERENCES `hro_employee_document` (`employee_document_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_document_item` */

/*Table structure for table `hro_employee_education` */

DROP TABLE IF EXISTS `hro_employee_education`;

CREATE TABLE `hro_employee_education` (
  `employee_education_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `education_id` int(10) DEFAULT 0,
  `employee_education_type` decimal(1,0) DEFAULT 0 COMMENT '1 : Formal Education, 0 : Non Formal Education',
  `employee_education_name` varchar(50) DEFAULT '',
  `employee_education_city` varchar(50) DEFAULT '',
  `employee_education_from_period` decimal(6,0) DEFAULT 0,
  `employee_education_to_period` decimal(6,0) DEFAULT 0,
  `employee_education_duration` decimal(10,2) DEFAULT 0.00,
  `employee_education_passed` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_education_certificate` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_education_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_education_id`),
  KEY `FK_hro_employee_education_education_id` (`education_id`),
  KEY `FK_hro_employee_education_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_education_education_id` FOREIGN KEY (`education_id`) REFERENCES `core_education` (`education_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_education_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_education` */

/*Table structure for table `hro_employee_employment` */

DROP TABLE IF EXISTS `hro_employee_employment`;

CREATE TABLE `hro_employee_employment` (
  `employee_employment_id` int(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_employment_working_status` decimal(1,0) DEFAULT 0,
  `employee_hire_date` date DEFAULT NULL,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `employee_employment_status_date` date DEFAULT NULL,
  `employee_employment_status_duedate` date DEFAULT NULL,
  `employee_employment_overtime_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_employment_id`),
  KEY `FK_hro_employee_employment_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_employment_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_employment` */

/*Table structure for table `hro_employee_experience` */

DROP TABLE IF EXISTS `hro_employee_experience`;

CREATE TABLE `hro_employee_experience` (
  `employee_experience_id` bigint(22) NOT NULL DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `experience_company_name` varchar(50) DEFAULT '',
  `experience_company_address` text DEFAULT NULL,
  `experience_job_title` varchar(50) DEFAULT '',
  `experience_from_period` decimal(6,0) DEFAULT 0,
  `experience_to_period` decimal(6,0) DEFAULT 0,
  `experience_last_salary` decimal(20,2) DEFAULT 0.00,
  `experience_separation_reason` text DEFAULT NULL,
  `experience_separation_letter` decimal(1,0) DEFAULT 0,
  `experience_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_experience` */

/*Table structure for table `hro_employee_expertise` */

DROP TABLE IF EXISTS `hro_employee_expertise`;

CREATE TABLE `hro_employee_expertise` (
  `employee_expertise_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `expertise_id` int(10) DEFAULT 0,
  `employee_expertise_name` varchar(50) DEFAULT '',
  `employee_expertise_city` varchar(50) DEFAULT '',
  `employee_expertise_from_period` decimal(6,0) DEFAULT 0,
  `employee_expertise_to_period` decimal(6,0) DEFAULT 0,
  `employee_expertise_duration` decimal(10,2) DEFAULT 0.00,
  `employee_expertise_passed` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_expertise_certificate` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_expertise_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_expertise_id`),
  KEY `FK_hro_employee_expertise_expertise_id` (`expertise_id`),
  KEY `FK_hro_employee_expertise_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_expertise_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_expertise_expertise_id` FOREIGN KEY (`expertise_id`) REFERENCES `core_expertise` (`expertise_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_expertise` */

/*Table structure for table `hro_employee_family` */

DROP TABLE IF EXISTS `hro_employee_family`;

CREATE TABLE `hro_employee_family` (
  `employee_family_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `family_relation_id` int(10) DEFAULT 0,
  `marital_status_id` int(10) DEFAULT 0,
  `employee_family_name` varchar(50) DEFAULT '',
  `employee_family_address` text DEFAULT NULL,
  `employee_family_city` varchar(50) DEFAULT '',
  `employee_family_postal_code` varchar(5) DEFAULT '',
  `employee_family_rt` varchar(5) DEFAULT '',
  `employee_family_rw` varchar(5) DEFAULT '',
  `employee_family_kecamatan` varchar(50) DEFAULT '',
  `employee_family_kelurahan` varchar(50) DEFAULT '',
  `employee_family_home_phone` varchar(50) DEFAULT '',
  `employee_family_mobile_phone` varchar(50) DEFAULT '',
  `employee_family_mobile_phone2` varchar(50) DEFAULT '',
  `employee_family_gender` decimal(1,0) DEFAULT 0 COMMENT '1 : Male, 0 : Female',
  `employee_family_date_of_birth` date DEFAULT NULL,
  `employee_family_place_of_birth` varchar(50) DEFAULT '',
  `employee_family_education` varchar(50) DEFAULT '',
  `employee_family_occupation` varchar(50) DEFAULT '',
  `employee_family_sibling` decimal(1,0) DEFAULT 0,
  `employee_family_has_coverage_claim` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `employee_family_coverage_ratio` decimal(10,2) DEFAULT 0.00,
  `employee_family_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_family_id`),
  KEY `FK_hro_employee_family_employee_id` (`employee_id`),
  KEY `FK_hro_employee_family_family_status_id` (`family_relation_id`),
  KEY `FK_hro_employee_family_marital_status_id` (`marital_status_id`),
  CONSTRAINT `FK_hro_employee_family_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_family_family_relation_id` FOREIGN KEY (`family_relation_id`) REFERENCES `core_family_relation` (`family_relation_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_family_marital_status_id` FOREIGN KEY (`marital_status_id`) REFERENCES `core_marital_status` (`marital_status_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_family` */

/*Table structure for table `hro_employee_glasses_coverage` */

DROP TABLE IF EXISTS `hro_employee_glasses_coverage`;

CREATE TABLE `hro_employee_glasses_coverage` (
  `employee_glasses_coverage_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `glasses_coverage_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `glasses_coverage_period` decimal(6,0) DEFAULT 0,
  `glasses_coverage_amount` decimal(20,2) DEFAULT 0.00,
  `glasses_coverage_claimed` decimal(20,2) DEFAULT 0.00,
  `glasses_coverage_last_balance` decimal(20,2) DEFAULT 0.00,
  `glasses_coverage_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_glasses_coverage_id`),
  KEY `FK_hro_employee_glasses_coverage_employee_id` (`employee_id`),
  KEY `FK_hro_employee_glasses_coverage_glasses_coverage_id` (`glasses_coverage_id`),
  CONSTRAINT `FK_hro_employee_glasses_coverage_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_glasses_coverage_glasses_coverage_id` FOREIGN KEY (`glasses_coverage_id`) REFERENCES `core_glasses_coverage` (`glasses_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_glasses_coverage` */

/*Table structure for table `hro_employee_home_early` */

DROP TABLE IF EXISTS `hro_employee_home_early`;

CREATE TABLE `hro_employee_home_early` (
  `employee_home_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `home_early_id` int(10) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_home_early_date` date DEFAULT NULL,
  `employee_home_early_hours` decimal(10,0) DEFAULT 0,
  `employee_home_early_minutes` decimal(10,0) DEFAULT 0,
  `employee_home_early_description` varchar(250) DEFAULT '',
  `employee_home_early_reason` varchar(250) DEFAULT '',
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_home_early_id`),
  KEY `FK_hro_employee_home_early_daily_employee_id` (`employee_id`),
  KEY `FK_hro_employee_home_early_home_early_id` (`home_early_id`),
  KEY `FK_hro_employee_home_early_employee_attendance_data_id` (`employee_attendance_data_id`),
  CONSTRAINT `FK_hro_employee_home_early_employee_attendance_data_id` FOREIGN KEY (`employee_attendance_data_id`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_home_early_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_home_early_home_early_id` FOREIGN KEY (`home_early_id`) REFERENCES `core_home_early` (`home_early_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_home_early` */

/*Table structure for table `hro_employee_home_early_daily` */

DROP TABLE IF EXISTS `hro_employee_home_early_daily`;

CREATE TABLE `hro_employee_home_early_daily` (
  `employee_home_early_daily_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_home_early_daily_date` date DEFAULT NULL,
  `employee_home_early_daily_hour` decimal(10,0) DEFAULT 0,
  `employee_home_early_daily_description` varchar(250) DEFAULT '',
  `employee_home_early_daily_reason` varchar(250) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_home_early_daily_id`),
  KEY `FK_hro_employee_home_early_daily_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_home_early_daily_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_home_early_daily` */

/*Table structure for table `hro_employee_hospital_coverage` */

DROP TABLE IF EXISTS `hro_employee_hospital_coverage`;

CREATE TABLE `hro_employee_hospital_coverage` (
  `employee_hospital_coverage_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `hospital_coverage_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `hospital_coverage_period` decimal(6,0) DEFAULT 0,
  `hospital_coverage_amount` decimal(20,2) DEFAULT 0.00,
  `hospital_coverage_claimed` decimal(20,2) DEFAULT 0.00,
  `hospital_coverage_last_balance` decimal(20,2) DEFAULT 0.00,
  `hospital_coverage_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_hospital_coverage_id`),
  KEY `FK_hro_employee_hospital_coverage_employee_id` (`employee_id`),
  KEY `FK_hro_employee_hospital_coverage_hospital_coverage_id` (`hospital_coverage_id`),
  CONSTRAINT `FK_hro_employee_hospital_coverage_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_hospital_coverage_hospital_coverage_id` FOREIGN KEY (`hospital_coverage_id`) REFERENCES `core_hospital_coverage` (`hospital_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_hospital_coverage` */

/*Table structure for table `hro_employee_language` */

DROP TABLE IF EXISTS `hro_employee_language`;

CREATE TABLE `hro_employee_language` (
  `employee_language_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `language_id` int(10) DEFAULT 0,
  `employee_language_listen` decimal(1,0) DEFAULT 0,
  `employee_language_read` decimal(1,0) DEFAULT 0,
  `employee_language_write` decimal(1,0) DEFAULT 0,
  `employee_language_speak` decimal(1,0) DEFAULT 0,
  `employee_language_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_language_id`),
  KEY `FK_hro_employee_language_employee_id` (`employee_id`),
  KEY `FK_hro_employee_language_language_id` (`language_id`),
  CONSTRAINT `FK_hro_employee_language_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `core_language` (`language_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_language` */

/*Table structure for table `hro_employee_late` */

DROP TABLE IF EXISTS `hro_employee_late`;

CREATE TABLE `hro_employee_late` (
  `employee_late_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `late_id` int(10) DEFAULT 0,
  `employee_late_date` date DEFAULT NULL,
  `employee_late_description` varchar(250) DEFAULT '',
  `employee_late_duration` decimal(10,0) DEFAULT 0,
  `employee_late_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_late_id`),
  KEY `FK_hro_employee_late_employee_id` (`employee_id`),
  KEY `FK_hro_employee_late_late_id` (`late_id`),
  CONSTRAINT `FK_hro_employee_late_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_late_late_id` FOREIGN KEY (`late_id`) REFERENCES `core_late` (`late_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_late` */

/*Table structure for table `hro_employee_leave` */

DROP TABLE IF EXISTS `hro_employee_leave`;

CREATE TABLE `hro_employee_leave` (
  `employee_leave_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `annual_leave_id` int(10) DEFAULT 0,
  `employee_leave_description` varchar(250) DEFAULT '',
  `employee_leave_period` decimal(10,0) DEFAULT 0,
  `employee_leave_balance` decimal(10,0) DEFAULT 0,
  `employee_leave_taken` decimal(10,0) DEFAULT 0,
  `employee_leave_last_balance` decimal(10,0) DEFAULT 0,
  `employee_leave_due_date` date DEFAULT NULL,
  `employee_leave_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_leave_id`),
  KEY `FK_hro_employee_leave_annual_leave_id` (`annual_leave_id`),
  KEY `FK_hro_employee_leave_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_leave_annual_leave_id` FOREIGN KEY (`annual_leave_id`) REFERENCES `core_annual_leave` (`annual_leave_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_leave_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_leave` */

/*Table structure for table `hro_employee_loan` */

DROP TABLE IF EXISTS `hro_employee_loan`;

CREATE TABLE `hro_employee_loan` (
  `employee_loan_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `employee_loan_description` text DEFAULT NULL,
  `installment_payment_period` decimal(6,0) DEFAULT 0,
  `installment_payment_total` decimal(10,0) DEFAULT 0,
  `employee_loan_amount_total` decimal(20,2) DEFAULT 0.00,
  `employee_loan_amount` decimal(20,2) DEFAULT 0.00,
  `employee_loan_status` enum('0','1') DEFAULT '1',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`employee_loan_id`),
  KEY `FK_hro_employee_loan_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_loan` */

/*Table structure for table `hro_employee_loan_item` */

DROP TABLE IF EXISTS `hro_employee_loan_item`;

CREATE TABLE `hro_employee_loan_item` (
  `employee_loan_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_loan_id` bigint(22) DEFAULT 0,
  `period` decimal(6,0) DEFAULT 0,
  `installment_payment` decimal(10,0) DEFAULT 0,
  `employee_loan_amount` decimal(20,2) DEFAULT 0.00,
  `employee_loan_payment` decimal(20,2) DEFAULT 0.00,
  `employee_loan_balance` decimal(20,2) DEFAULT 0.00,
  `payment_date` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_loan_item_id`),
  KEY `FK_hro_employee_loan_item_employee_loan_id` (`employee_loan_id`),
  CONSTRAINT `FK_hro_employee_loan_item_employee_loan_id` FOREIGN KEY (`employee_loan_id`) REFERENCES `hro_employee_loan` (`employee_loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_loan_item` */

/*Table structure for table `hro_employee_meal_coupon` */

DROP TABLE IF EXISTS `hro_employee_meal_coupon`;

CREATE TABLE `hro_employee_meal_coupon` (
  `employee_meal_coupon_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_meal_coupon_date` date DEFAULT NULL,
  `employee_meal_coupon_log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_meal_coupon_downloaded` decimal(1,0) DEFAULT 0,
  `machine_ip_address` varchar(50) DEFAULT '',
  PRIMARY KEY (`employee_meal_coupon_id`),
  KEY `FK_hro_employee_meal_coupon_region_id` (`region_id`),
  KEY `FK_hro_employee_meal_coupon_branch_id` (`branch_id`),
  KEY `FK_hro_employee_meal_coupon_division_id` (`division_id`),
  KEY `FK_hro_employee_meal_coupon_department_id` (`department_id`),
  KEY `FK_hro_employee_meal_coupon_section_id` (`section_id`),
  KEY `FK_hro_employee_meal_coupon_location_id` (`location_id`),
  KEY `FK_hro_employee_meal_coupon_unit_id` (`unit_id`),
  KEY `FK_hro_employee_meal_coupon_employee_shift_id` (`employee_shift_id`),
  KEY `FK_hro_employee_meal_coupon_employee_id` (`employee_id`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  CONSTRAINT `FK_hro_employee_meal_coupon_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_meal_coupon_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_meal_coupon` */

/*Table structure for table `hro_employee_medical_coverage` */

DROP TABLE IF EXISTS `hro_employee_medical_coverage`;

CREATE TABLE `hro_employee_medical_coverage` (
  `employee_medical_coverage_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `medical_coverage_id` int(10) DEFAULT 0,
  `medical_coverage_period` decimal(6,0) DEFAULT 0,
  `medical_coverage_amount` decimal(20,0) DEFAULT 0,
  `medical_coverage_claimed` decimal(20,0) DEFAULT 0,
  `medical_coverage_last_balance` decimal(20,0) DEFAULT 0,
  `medical_coverage_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_medical_coverage_id`),
  KEY `FK_hro_employee_medical_coverage_medical_coverage_id` (`medical_coverage_id`),
  KEY `FK_hro_employee_medical_coverage_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_medical_coverage_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_medical_coverage_medical_coverage_id` FOREIGN KEY (`medical_coverage_id`) REFERENCES `core_medical_coverage` (`medical_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_medical_coverage` */

/*Table structure for table `hro_employee_organization` */

DROP TABLE IF EXISTS `hro_employee_organization`;

CREATE TABLE `hro_employee_organization` (
  `employee_organization_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_organization_effective_date` date DEFAULT NULL,
  `employee_organization_no` varchar(20) DEFAULT '',
  `employee_organization_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_organization_id`),
  KEY `FK_hro_employee_organization_region_id` (`region_id`),
  KEY `FK_hro_employee_organization_branch_id` (`branch_id`),
  KEY `FK_hro_employee_organization_division_id` (`division_id`),
  KEY `FK_hro_employee_organization_department_id` (`department_id`),
  KEY `FK_hro_employee_organization_section_id` (`section_id`),
  KEY `FK_hro_employee_organization_job_title_id` (`job_title_id`),
  KEY `FK_hro_employee_organization_grade_id` (`grade_id`),
  KEY `FK_hro_employee_organization_class_id` (`class_id`),
  KEY `FK_hro_employee_organization_location_id` (`location_id`),
  KEY `FK_hro_employee_organization_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_organization_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_class_id` FOREIGN KEY (`class_id`) REFERENCES `core_class` (`class_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_organization_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_organization` */

/*Table structure for table `hro_employee_permit` */

DROP TABLE IF EXISTS `hro_employee_permit`;

CREATE TABLE `hro_employee_permit` (
  `employee_permit_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `permit_id` int(10) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_permit_date` date DEFAULT NULL,
  `employee_permit_start_date` date DEFAULT NULL,
  `employee_permit_end_date` date DEFAULT NULL,
  `employee_permit_description` varchar(250) DEFAULT '',
  `employee_permit_duration` decimal(10,0) DEFAULT 0,
  `employee_permit_whole_days` decimal(1,0) DEFAULT 0,
  `employee_permit_remark` text DEFAULT NULL,
  `permit_type` decimal(1,0) DEFAULT 0,
  `deduction_type` decimal(1,0) DEFAULT 0,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_permit_id`),
  KEY `FK_hro_employee_permit_employee_id` (`employee_id`),
  KEY `FK_hro_employee_permit_permit_id` (`permit_id`),
  KEY `FK_hro_employee_permit_employee_attendance_data_id` (`employee_attendance_data_id`),
  CONSTRAINT `FK_hro_employee_permit_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_permit` */

insert  into `hro_employee_permit`(`employee_permit_id`,`employee_id`,`permit_id`,`employee_attendance_data_id`,`employee_permit_date`,`employee_permit_start_date`,`employee_permit_end_date`,`employee_permit_description`,`employee_permit_duration`,`employee_permit_whole_days`,`employee_permit_remark`,`permit_type`,`deduction_type`,`employee_attendance_date_status`,`data_state`,`created_id`,`created_on`,`last_update`) values 
(6,11670,1,0,'2020-12-31','2020-12-31','2020-12-31','sakit',1,0,'test',1,0,0,0,21,'2020-12-31 09:38:57','2020-12-31 09:38:57');

/*Table structure for table `hro_employee_permit_detail` */

DROP TABLE IF EXISTS `hro_employee_permit_detail`;

CREATE TABLE `hro_employee_permit_detail` (
  `employee_permit_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_permit_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_permit_detail_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_permit_detail_id`),
  KEY `FK_hro_employee_permit_detail_employee_permit_id` (`employee_permit_id`),
  KEY `FK_hro_employee_permit_detail_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_permit_detail_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_permit_detail_employee_permit_id` FOREIGN KEY (`employee_permit_id`) REFERENCES `hro_employee_permit` (`employee_permit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_permit_detail` */

insert  into `hro_employee_permit_detail`(`employee_permit_detail_id`,`employee_permit_id`,`employee_id`,`employee_permit_detail_date`,`last_update`) values 
(1,6,11670,'2020-12-31','2020-12-31 09:38:57');

/*Table structure for table `hro_employee_present` */

DROP TABLE IF EXISTS `hro_employee_present`;

CREATE TABLE `hro_employee_present` (
  `employee_present_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT NULL,
  `employee_present_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`employee_present_id`),
  KEY `hro_employee_present_employee_id` (`employee_id`),
  CONSTRAINT `hro_employee_present_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_present` */

/*Table structure for table `hro_employee_probation_extending` */

DROP TABLE IF EXISTS `hro_employee_probation_extending`;

CREATE TABLE `hro_employee_probation_extending` (
  `probation_extending_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `probation_id` int(10) DEFAULT 0,
  `probation_extending_description` varchar(250) DEFAULT '',
  `probation_extending_date` date DEFAULT NULL,
  `probation_extending_last_date` date DEFAULT NULL,
  `probation_extending_next_date` date DEFAULT NULL,
  `probation_extending_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(11) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`probation_extending_id`),
  KEY `FK_transaction_probation_extending_employee_id` (`employee_id`),
  KEY `FK_hro_employee_probation_extending_probation_id` (`probation_id`),
  CONSTRAINT `FK_hro_employee_probation_extending_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_probation_extending_probation_id` FOREIGN KEY (`probation_id`) REFERENCES `core_probation` (`probation_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_probation_extending` */

/*Table structure for table `hro_employee_separation` */

DROP TABLE IF EXISTS `hro_employee_separation`;

CREATE TABLE `hro_employee_separation` (
  `employee_separation_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `separation_reason_id` int(10) DEFAULT 0,
  `employee_separation_date` date DEFAULT NULL,
  `employee_separation_description` varchar(250) DEFAULT '',
  `employee_separation_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_separation_id`),
  KEY `FK_hro_employee_separation_separation_reason_id` (`separation_reason_id`),
  KEY `FK_hro_employee_separation_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_separation_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_separation_separation_reason_id` FOREIGN KEY (`separation_reason_id`) REFERENCES `core_separation_reason` (`separation_reason_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_separation` */

/*Table structure for table `hro_employee_status_alteration` */

DROP TABLE IF EXISTS `hro_employee_status_alteration`;

CREATE TABLE `hro_employee_status_alteration` (
  `status_alteration_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `status_alteration_description` varchar(250) DEFAULT '',
  `status_alteration_date` date DEFAULT NULL,
  `status_alteration_last_date` date DEFAULT NULL,
  `employee_employment_status` decimal(1,0) DEFAULT NULL,
  `status_alteration_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`status_alteration_id`),
  KEY `FK_hro_employee_status_alteration_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_status_alteration_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_status_alteration` */

/*Table structure for table `hro_employee_suspend` */

DROP TABLE IF EXISTS `hro_employee_suspend`;

CREATE TABLE `hro_employee_suspend` (
  `employee_suspend_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `suspend_id` int(10) DEFAULT 0,
  `employee_suspend_date` date DEFAULT NULL,
  `employee_suspend_description` varchar(250) DEFAULT '',
  `employee_suspend_salary_percentage` decimal(10,2) DEFAULT 0.00,
  `employee_suspend_remark` text DEFAULT NULL,
  `employee_suspend_days` decimal(10,0) DEFAULT 0,
  `employee_suspend_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Skorsing, 0 : Unskorsing',
  `employee_suspend_status_date` date DEFAULT NULL,
  `employee_suspend_status_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(19) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_suspend_id`),
  KEY `FK_transaction_employee_skorsing_employee_id` (`employee_id`),
  KEY `FK_hro_employee_suspend_suspend_id` (`suspend_id`),
  CONSTRAINT `FK_hro_employee_suspend_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_suspend_suspend_id` FOREIGN KEY (`suspend_id`) REFERENCES `core_suspend` (`suspend_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_suspend` */

/*Table structure for table `hro_employee_swap_off` */

DROP TABLE IF EXISTS `hro_employee_swap_off`;

CREATE TABLE `hro_employee_swap_off` (
  `employee_swap_off_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_attendance_data_id` bigint(22) DEFAULT 0,
  `employee_attendance_data_id_todate` bigint(22) DEFAULT 0,
  `employee_swap_off_date` date DEFAULT NULL,
  `employee_swap_off_to_date` date DEFAULT NULL,
  `employee_swap_off_description` varchar(250) DEFAULT '',
  `employee_swap_off_remark` text DEFAULT NULL,
  `employee_attendance_date_status` decimal(1,0) DEFAULT 0,
  `employee_attendance_date_status_todate` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_swap_off_id`),
  KEY `FK_hro_employee_swap_off_employee_id` (`employee_id`),
  KEY `FK_hro_employee_swap_off_employee_attendance_data_id` (`employee_attendance_data_id`),
  KEY `FK_hro_employee_swap_off_employee_attendance_data_id_todate` (`employee_attendance_data_id_todate`),
  CONSTRAINT `FK_hro_employee_swap_off_employee_attendance_data_id` FOREIGN KEY (`employee_attendance_data_id`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_swap_off_employee_attendance_data_id_todate` FOREIGN KEY (`employee_attendance_data_id_todate`) REFERENCES `hro_employee_attendance_data` (`employee_attendance_data_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_swap_off_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_swap_off` */

/*Table structure for table `hro_employee_thr` */

DROP TABLE IF EXISTS `hro_employee_thr`;

CREATE TABLE `hro_employee_thr` (
  `employee_thr_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('1','0') DEFAULT '1',
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_thr_period` decimal(6,0) DEFAULT 0,
  `employee_thr_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_thr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_thr` */

/*Table structure for table `hro_employee_transfer` */

DROP TABLE IF EXISTS `hro_employee_transfer`;

CREATE TABLE `hro_employee_transfer` (
  `employee_transfer_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `employee_transfer_date` date DEFAULT NULL,
  `employee_transfer_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_transfer_id`),
  KEY `FK_transaction_employee_transfer_employee_id` (`employee_id`),
  KEY `FK_transaction_employee_transfer_region_id` (`region_id`),
  KEY `FK_transaction_employee_transfer_branch_id` (`branch_id`),
  KEY `FK_transaction_employee_transfer_division_id` (`division_id`),
  KEY `FK_transaction_employee_transfer_department_id` (`department_id`),
  KEY `FK_transaction_employee_transfer_section_id` (`section_id`),
  KEY `FK_transaction_employee_transfer_location_id` (`location_id`),
  KEY `FK_hro_employee_transfer_job_title_id` (`job_title_id`),
  KEY `FK_hro_employee_transfer_grade_id` (`grade_id`),
  KEY `FK_hro_employee_transfer_class_id` (`class_id`),
  KEY `FK_hro_employee_transfer_unit_id` (`unit_id`),
  CONSTRAINT `FK_hro_employee_transfer_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_class_id` FOREIGN KEY (`class_id`) REFERENCES `core_class` (`class_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `core_grade` (`grade_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_transfer_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_transfer` */

/*Table structure for table `hro_employee_warning` */

DROP TABLE IF EXISTS `hro_employee_warning`;

CREATE TABLE `hro_employee_warning` (
  `employee_warning_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `warning_id` int(10) DEFAULT 0,
  `employee_warning_date` date DEFAULT NULL,
  `employee_warning_description` varchar(250) DEFAULT '',
  `employee_warning_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_warning_id`),
  KEY `FK_transaction_employee_warning_employee_id` (`employee_id`),
  KEY `FK_transaction_employee_warning_warning_id` (`warning_id`),
  CONSTRAINT `FK_hro_employee_warning_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_warning_warning_id` FOREIGN KEY (`warning_id`) REFERENCES `core_warning` (`warning_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_warning` */

/*Table structure for table `hro_employee_working` */

DROP TABLE IF EXISTS `hro_employee_working`;

CREATE TABLE `hro_employee_working` (
  `employee_working_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `working_company_name` varchar(50) DEFAULT '',
  `working_company_address` text DEFAULT NULL,
  `working_job_title` varchar(50) DEFAULT '',
  `working_from_period` decimal(6,0) DEFAULT 0,
  `working_to_period` decimal(6,0) DEFAULT 0,
  `working_last_salary` decimal(20,2) DEFAULT 0.00,
  `working_separation_reason` text DEFAULT NULL,
  `working_separation_letter` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `working_experience_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_working_id`),
  KEY `FK_hro_employee_working_experience_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_working_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_working` */

/*Table structure for table `hro_employee_working_dayoff` */

DROP TABLE IF EXISTS `hro_employee_working_dayoff`;

CREATE TABLE `hro_employee_working_dayoff` (
  `employee_working_dayoff_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `dayoff_id` int(10) DEFAULT 0,
  `employee_working_dayoff_description` varchar(250) DEFAULT '',
  `employee_working_dayoff_start_date` date DEFAULT NULL,
  `employee_working_dayoff_end_date` date DEFAULT NULL,
  `employee_working_dayoff_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_working_dayoff_id`),
  KEY `FK_employee_working_dayoff_employee_id` (`employee_id`),
  KEY `FK_employee_working_dayoff_region_id` (`region_id`),
  KEY `FK_employee_working_dayoff_branch_id` (`branch_id`),
  KEY `FK_employee_working_dayoff_location_id` (`location_id`),
  KEY `FK_employee_working_dayoff_division_id` (`division_id`),
  KEY `FK_employee_working_dayoff_department_id` (`department_id`),
  KEY `FK_employee_working_dayoff_section_id` (`section_id`),
  KEY `FK_employee_working_dayoff_job_title_id` (`job_title_id`),
  KEY `FK_employee_working_dayoff_dayoff_id` (`dayoff_id`),
  CONSTRAINT `FK_employee_working_dayoff_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_dayoff_id` FOREIGN KEY (`dayoff_id`) REFERENCES `core_dayoff` (`dayoff_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_working_dayoff_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_working_dayoff` */

/*Table structure for table `hro_employee_working_dayoff_detail` */

DROP TABLE IF EXISTS `hro_employee_working_dayoff_detail`;

CREATE TABLE `hro_employee_working_dayoff_detail` (
  `working_dayoff_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_working_dayoff_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `working_dayoff_detail_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`working_dayoff_detail_id`),
  KEY `FK_hro_employee_working_dayoff_detail_employee_id` (`employee_id`),
  KEY `FK_hro_employee_working_dayoff_detail_id` (`employee_working_dayoff_id`),
  CONSTRAINT `FK_hro_employee_working_dayoff_detail_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_working_dayoff_detail_id` FOREIGN KEY (`employee_working_dayoff_id`) REFERENCES `hro_employee_working_dayoff` (`employee_working_dayoff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_employee_working_dayoff_detail` */

/*Table structure for table `hro_facility_history` */

DROP TABLE IF EXISTS `hro_facility_history`;

CREATE TABLE `hro_facility_history` (
  `facility_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `facility_category_id` int(6) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `facility_receipt_date` datetime DEFAULT NULL,
  `facility_return_date` datetime DEFAULT NULL,
  `facility_status_id` int(6) DEFAULT 0,
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`facility_history_id`),
  KEY `FK_hro_facility_history_facility_category_id` (`facility_category_id`),
  KEY `FK_hro_facility_history_facility_status_id` (`facility_status_id`),
  KEY `FK_hro_facility_history_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_facility_history_facility_category_id` FOREIGN KEY (`facility_category_id`) REFERENCES `core_facility_category` (`facility_category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_facility_history_facility_status_id` FOREIGN KEY (`facility_status_id`) REFERENCES `core_facility_status` (`facility_status_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_facility_history` */

/*Table structure for table `hro_marital_status` */

DROP TABLE IF EXISTS `hro_marital_status`;

CREATE TABLE `hro_marital_status` (
  `marital_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `marital_status_name` varchar(50) DEFAULT '',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`marital_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_marital_status` */

/*Table structure for table `hro_overtime_history` */

DROP TABLE IF EXISTS `hro_overtime_history`;

CREATE TABLE `hro_overtime_history` (
  `overtime_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `overtime_category_id` int(6) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `overtime_hours` decimal(10,0) DEFAULT 0,
  `overtime_dayoff` enum('0','1') DEFAULT '0' COMMENT '0 : Non Day Off, 1 : Day Off',
  `overtime_remark` text DEFAULT NULL,
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_state` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`overtime_history_id`),
  KEY `FK_hro_overtime_history_overtime_category_id` (`overtime_category_id`),
  KEY `FK_hro_overtime_history_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_overtime_history_overtime_category_id` FOREIGN KEY (`overtime_category_id`) REFERENCES `core_overtime_category` (`overtime_category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_overtime_history` */

/*Table structure for table `hro_position_history` */

DROP TABLE IF EXISTS `hro_position_history`;

CREATE TABLE `hro_position_history` (
  `position_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `position_date` datetime DEFAULT NULL,
  `department_id` int(6) DEFAULT 0,
  `department_code` varchar(20) DEFAULT '',
  `division_id` int(6) DEFAULT 0,
  `division_code` varchar(20) DEFAULT '',
  `position_id` int(6) DEFAULT 0,
  `position_code` varchar(20) DEFAULT '',
  `immediate_supervisor_name` varchar(20) DEFAULT '',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`position_history_id`),
  KEY `FK_hro_position_history_department_id` (`department_id`),
  KEY `FK_hro_position_history_division_id` (`division_id`),
  KEY `FK_hro_position_history_position_id` (`position_id`),
  KEY `FK_hro_position_history` (`employee_id`),
  CONSTRAINT `FK_hro_position_history_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_position_history_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_position_history_position_id` FOREIGN KEY (`position_id`) REFERENCES `core_position` (`position_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_position_history` */

/*Table structure for table `hro_separation_history` */

DROP TABLE IF EXISTS `hro_separation_history`;

CREATE TABLE `hro_separation_history` (
  `separation_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `separation_enrollment_date` datetime DEFAULT NULL,
  `separation_reason_id` int(6) DEFAULT 0,
  `separation_rehire_status` enum('1','0') DEFAULT '0' COMMENT '0 : No, 1 : Yes',
  `separation_status_id` int(6) DEFAULT 0,
  `separation_status_date` datetime DEFAULT NULL,
  `separation_effective_date` datetime DEFAULT NULL,
  `separation_status_remark` text DEFAULT NULL,
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`separation_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_separation_history` */

/*Table structure for table `hro_training_history` */

DROP TABLE IF EXISTS `hro_training_history`;

CREATE TABLE `hro_training_history` (
  `training_history_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `training_category_id` int(6) DEFAULT 0,
  `training_title_id` int(6) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_code` varchar(20) DEFAULT '',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `training_hours` decimal(10,2) DEFAULT 0.00,
  `training_cost` decimal(20,2) DEFAULT 0.00,
  `training_location` varchar(50) DEFAULT '',
  `training_remark` text DEFAULT NULL,
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`training_history_id`),
  KEY `FK_hro_training_history_training_title_id` (`training_title_id`),
  KEY `FK_hro_training_history_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_training_history_training_title_id` FOREIGN KEY (`training_title_id`) REFERENCES `core_training_title` (`training_title_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hro_training_history` */

/*Table structure for table `payroll_basic_salary` */

DROP TABLE IF EXISTS `payroll_basic_salary`;

CREATE TABLE `payroll_basic_salary` (
  `basic_salary_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `basic_salary_period` decimal(10,0) DEFAULT 0,
  `basic_salary_total` decimal(20,0) DEFAULT 0,
  `basic_salary_amount` decimal(20,0) DEFAULT 0,
  `meal_allowance_amount` decimal(20,0) DEFAULT 0,
  `transport_allowance_amount` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`basic_salary_id`),
  KEY `FK_payroll_basic_salary_region_id` (`region_id`),
  KEY `FK_payroll_basic_salary_branch_id` (`branch_id`),
  KEY `FK_payroll_basic_salary_location_id` (`location_id`),
  CONSTRAINT `FK_payroll_basic_salary_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_basic_salary_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_basic_salary_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_basic_salary` */

/*Table structure for table `payroll_daily_period` */

DROP TABLE IF EXISTS `payroll_daily_period`;

CREATE TABLE `payroll_daily_period` (
  `daily_period_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `daily_period` decimal(20,0) DEFAULT 0,
  `daily_period_start_date` date DEFAULT NULL,
  `daily_period_end_date` date DEFAULT NULL,
  `daily_period_working_days` decimal(10,0) DEFAULT 0,
  `daily_period_include_bpjs` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`daily_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_daily_period` */

/*Table structure for table `payroll_employee_allowance` */

DROP TABLE IF EXISTS `payroll_employee_allowance`;

CREATE TABLE `payroll_employee_allowance` (
  `employee_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `employee_allowance_period` decimal(10,0) DEFAULT 0,
  `employee_allowance_description` varchar(250) DEFAULT '',
  `employee_allowance_amount` decimal(20,2) DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_allowance_id`),
  KEY `FK_hro_employee_allowance_allowance_id` (`allowance_id`),
  KEY `FK_hro_employee_allowance_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_allowance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_allowance` */

/*Table structure for table `payroll_employee_bpjs` */

DROP TABLE IF EXISTS `payroll_employee_bpjs`;

CREATE TABLE `payroll_employee_bpjs` (
  `employee_bpjs_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `bpjs_in_date` date DEFAULT NULL,
  `bpjs_reported_salary` decimal(20,2) DEFAULT 0.00,
  `bpjs_total_amount` decimal(20,2) DEFAULT 0.00,
  `bpjs_kesehatan_status` decimal(1,0) DEFAULT 0,
  `bpjs_kesehatan_no` varchar(20) DEFAULT '',
  `bpjs_kesehatan_percentage` decimal(10,2) DEFAULT 0.00,
  `bpjs_kesehatan_amount` decimal(20,2) DEFAULT 0.00,
  `bpjs_tenagakerja_status` decimal(1,0) DEFAULT 0,
  `bpjs_tenagakerja_no` varchar(20) DEFAULT '',
  `bpjs_tenagakerja_percentage` decimal(10,2) DEFAULT 0.00,
  `bpjs_tenagakerja_amount` decimal(20,2) DEFAULT 0.00,
  `bpjs_remark` text DEFAULT NULL,
  `bpjs_out_status` decimal(1,0) DEFAULT 0,
  `bpjs_out_date` date DEFAULT NULL,
  `bpjs_out_id` int(10) DEFAULT 0,
  `bpjs_out_on` datetime DEFAULT NULL,
  `bpjs_status` decimal(1,0) DEFAULT 0 COMMENT '0 : Exclude Company, 1 : Include Company',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_bpjs_id`),
  KEY `FK_payroll_employee_bpjs_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_bpjs_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_bpjs` */

/*Table structure for table `payroll_employee_daily` */

DROP TABLE IF EXISTS `payroll_employee_daily`;

CREATE TABLE `payroll_employee_daily` (
  `employee_daily_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `bank_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_daily_bank_acct_name` varchar(50) DEFAULT '',
  `employee_daily_bank_acct_no` varchar(50) DEFAULT '',
  `employee_daily_date` date DEFAULT NULL,
  `employee_daily_start_date` date DEFAULT NULL,
  `employee_daily_end_date` date DEFAULT NULL,
  `employee_daily_basic_salary` decimal(20,0) DEFAULT 0,
  `employee_daily_basic_overtime` decimal(20,0) DEFAULT 0,
  `employee_daily_working_days` decimal(10,2) DEFAULT 0.00,
  `employee_daily_allowance_total` decimal(20,0) DEFAULT 0,
  `employee_daily_deduction_total` decimal(20,0) DEFAULT 0,
  `employee_daily_overtime_total` decimal(20,0) DEFAULT 0,
  `employee_daily_early_total` decimal(20,0) DEFAULT 0,
  `employee_daily_bpjs_amount` decimal(20,0) DEFAULT 0,
  `employee_daily_length_service_month` decimal(10,2) DEFAULT 0.00,
  `employee_daily_length_service_amount` decimal(20,0) DEFAULT 0,
  `employee_daily_premi_attendance_amount` decimal(20,0) DEFAULT 0,
  `employee_daily_allowance_other` decimal(20,0) DEFAULT 0,
  `employee_daily_allowance_description` varchar(250) DEFAULT '',
  `employee_daily_deduction_other` decimal(20,0) DEFAULT 0,
  `employee_daily_deduction_description` varchar(250) DEFAULT '',
  `employee_daily_salary_total` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_daily_bank_id` (`bank_id`),
  CONSTRAINT `FK_payroll_employee_daily_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `core_bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily` */

/*Table structure for table `payroll_employee_daily_absence` */

DROP TABLE IF EXISTS `payroll_employee_daily_absence`;

CREATE TABLE `payroll_employee_daily_absence` (
  `employee_daily_absence_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `absence_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_absence_description` varchar(250) DEFAULT '',
  `employee_absence_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_absence_id`),
  KEY `FK_payroll_employe_daily_absencee_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_absence_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_daily_absence_absence_id` (`absence_id`),
  CONSTRAINT `FK_payroll_employe_daily_absencee_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_absence_absence_id` FOREIGN KEY (`absence_id`) REFERENCES `core_absence` (`absence_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_absence_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_absence` */

/*Table structure for table `payroll_employee_daily_allowance` */

DROP TABLE IF EXISTS `payroll_employee_daily_allowance`;

CREATE TABLE `payroll_employee_daily_allowance` (
  `employee_daily_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `employee_allowance_id` bigint(22) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_allowance_amount` decimal(10,0) DEFAULT 0,
  `employee_daily_working_days` decimal(10,0) DEFAULT 0,
  `employee_daily_allowance_days` decimal(10,0) DEFAULT 0,
  `employee_allowance_subtotal` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_allowance_id`),
  KEY `FK_payroll_employee_daily_allowance_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_allowance_allowance_id` (`allowance_id`),
  KEY `FK_payroll_employee_daily_allowance_employee_allowance_id` (`employee_allowance_id`),
  KEY `FK_payroll_employee_daily_allowance_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_daily_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_allowance_employee_allowance_id` FOREIGN KEY (`employee_allowance_id`) REFERENCES `payroll_employee_allowance` (`employee_allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_allowance_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_allowance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_allowance` */

/*Table structure for table `payroll_employee_daily_dayoff` */

DROP TABLE IF EXISTS `payroll_employee_daily_dayoff`;

CREATE TABLE `payroll_employee_daily_dayoff` (
  `employee_daily_dayoff_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `dayoff_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_working_dayoff_description` varchar(250) DEFAULT '',
  `working_dayoff_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_dayoff_id`),
  KEY `FK_payroll_employee_daily_dayoff_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_dayoff_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_daily_dayoff_dayoff_id` (`dayoff_id`),
  CONSTRAINT `FK_payroll_employee_daily_dayoff_dayoff_id` FOREIGN KEY (`dayoff_id`) REFERENCES `core_dayoff` (`dayoff_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_dayoff_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_dayoff_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_dayoff` */

/*Table structure for table `payroll_employee_daily_deduction` */

DROP TABLE IF EXISTS `payroll_employee_daily_deduction`;

CREATE TABLE `payroll_employee_daily_deduction` (
  `employee_daily_deduction_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `deduction_id` int(10) DEFAULT 0,
  `employee_deduction_id` bigint(22) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_deduction_amount` decimal(10,0) DEFAULT 0,
  `employee_daily_working_days` decimal(10,0) DEFAULT 0,
  `employee_daily_deduction_days` decimal(10,0) DEFAULT 0,
  `employee_deduction_subtotal` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_deduction_id`),
  KEY `FK_payroll_employee_daily_deduction_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_deduction_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_daily_deduction_deduction_id` (`deduction_id`),
  KEY `FK_payroll_employee_daily_deduction_employee_deduction_id` (`employee_deduction_id`),
  CONSTRAINT `FK_payroll_employee_daily_deduction_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_deduction_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_deduction_employee_deduction_id` FOREIGN KEY (`employee_deduction_id`) REFERENCES `payroll_employee_deduction` (`employee_deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_deduction_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_deduction` */

/*Table structure for table `payroll_employee_daily_early` */

DROP TABLE IF EXISTS `payroll_employee_daily_early`;

CREATE TABLE `payroll_employee_daily_early` (
  `employee_daily_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `home_early_hour` decimal(10,0) DEFAULT 0,
  `home_early_amount` decimal(10,0) DEFAULT 0,
  `home_early_total_amount` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_early_id`),
  KEY `FK_payroll_employee_daily_early_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_early_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_daily_early_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_early_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_early` */

/*Table structure for table `payroll_employee_daily_home_early` */

DROP TABLE IF EXISTS `payroll_employee_daily_home_early`;

CREATE TABLE `payroll_employee_daily_home_early` (
  `employee_daily_home_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_home_early_daily_description` varchar(250) DEFAULT '',
  `employee_home_early_daily_date` date DEFAULT NULL,
  `employee_home_early_daily_hour` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_home_early_id`),
  KEY `FK_payroll_employee_daily_home_early_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_home_early_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_daily_home_early_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_home_early_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_home_early` */

/*Table structure for table `payroll_employee_daily_late` */

DROP TABLE IF EXISTS `payroll_employee_daily_late`;

CREATE TABLE `payroll_employee_daily_late` (
  `employee_daily_late_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `late_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_late_description` varchar(250) DEFAULT '',
  `employee_late_date` date DEFAULT NULL,
  `employee_late_duration` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_late_id`),
  KEY `FK_payroll_employee_daily_late_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_late_late_id` (`late_id`),
  KEY `FK_payroll_employee_daily_late_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_daily_late_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_late_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_late_late_id` FOREIGN KEY (`late_id`) REFERENCES `core_late` (`late_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_late` */

/*Table structure for table `payroll_employee_daily_leave` */

DROP TABLE IF EXISTS `payroll_employee_daily_leave`;

CREATE TABLE `payroll_employee_daily_leave` (
  `employee_daily_leave_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `annual_leave_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `leave_request_description` varchar(250) DEFAULT '',
  `leave_request_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_leave_id`),
  KEY `FK_payroll_employee_daily_leave_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_leave` (`employee_id`),
  KEY `FK_payroll_employee_daily_leave_annual_leave_id` (`annual_leave_id`),
  CONSTRAINT `FK_payroll_employee_daily_leave` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_leave_annual_leave_id` FOREIGN KEY (`annual_leave_id`) REFERENCES `core_annual_leave` (`annual_leave_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_leave_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_leave` */

/*Table structure for table `payroll_employee_daily_overtime` */

DROP TABLE IF EXISTS `payroll_employee_daily_overtime`;

CREATE TABLE `payroll_employee_daily_overtime` (
  `employee_daily_overtime_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `employee_basic_overtime` decimal(10,0) DEFAULT 0,
  `employee_overtime_daily_total1` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_daily_total2` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_dayoff_total1` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_dayoff_total2` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_amount_total` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_overtime_id`),
  KEY `FK_payroll_employee_daily_overtime_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_overtime_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_daily_overtime_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_overtime_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_overtime` */

/*Table structure for table `payroll_employee_daily_overtime_request` */

DROP TABLE IF EXISTS `payroll_employee_daily_overtime_request`;

CREATE TABLE `payroll_employee_daily_overtime_request` (
  `employee_daily_overtime_request_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `overtime_type_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `overtime_request_description` varchar(250) DEFAULT '',
  `overtime_request_date` date DEFAULT NULL,
  `overtime_request_duration` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_overtime_request_id`),
  KEY `FK_employee_daily_overtime_request_employee_daily_id` (`employee_daily_id`),
  KEY `FK_employee_daily_overtime_request_employee_id` (`employee_id`),
  KEY `FK_employee_daily_overtime_request_overtime_type_id` (`overtime_type_id`),
  CONSTRAINT `FK_employee_daily_overtime_request_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_daily_overtime_request_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_daily_overtime_request_overtime_type_id` FOREIGN KEY (`overtime_type_id`) REFERENCES `core_overtime_type` (`overtime_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_overtime_request` */

/*Table structure for table `payroll_employee_daily_permit` */

DROP TABLE IF EXISTS `payroll_employee_daily_permit`;

CREATE TABLE `payroll_employee_daily_permit` (
  `employee_daily_permit_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_daily_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `permit_id` int(10) DEFAULT 0,
  `employee_daily_period` decimal(20,0) DEFAULT 0,
  `permit_type` decimal(1,0) DEFAULT 0,
  `deduction_type` decimal(1,0) DEFAULT 0,
  `employee_permit_description` varchar(250) DEFAULT '',
  `employee_permit_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_daily_permit_id`),
  KEY `FK_payroll_employee_daily_permit_employee_daily_id` (`employee_daily_id`),
  KEY `FK_payroll_employee_daily_permit_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_daily_permit_permit_id` (`permit_id`),
  CONSTRAINT `FK_payroll_employee_daily_permit_employee_daily_id` FOREIGN KEY (`employee_daily_id`) REFERENCES `payroll_employee_daily` (`employee_daily_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_permit_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_daily_permit_permit_id` FOREIGN KEY (`permit_id`) REFERENCES `core_permit` (`permit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_daily_permit` */

/*Table structure for table `payroll_employee_deduction` */

DROP TABLE IF EXISTS `payroll_employee_deduction`;

CREATE TABLE `payroll_employee_deduction` (
  `employee_deduction_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `deduction_id` int(10) DEFAULT 0,
  `employee_deduction_period` decimal(10,0) DEFAULT 0,
  `employee_deduction_description` varchar(250) DEFAULT '',
  `employee_deduction_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_deduction_id`),
  KEY `FK_hro_employee_deduction_deduction_id` (`deduction_id`),
  KEY `FK_hro_employee_deduction_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_deduction_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_deduction_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_deduction` */

/*Table structure for table `payroll_employee_incentive` */

DROP TABLE IF EXISTS `payroll_employee_incentive`;

CREATE TABLE `payroll_employee_incentive` (
  `employee_incentive_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `incentive_id` int(10) DEFAULT 0,
  `employee_incentive_description` varchar(250) DEFAULT '',
  `employee_incentive_period` decimal(10,0) DEFAULT 0,
  `employee_incentive_amount` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` decimal(1,0) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_incentive_id`),
  KEY `FK_payroll_employee_incentive_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_incentive_incentive_id` (`incentive_id`),
  CONSTRAINT `FK_payroll_employee_incentive_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_incentive_incentive_id` FOREIGN KEY (`incentive_id`) REFERENCES `core_incentive` (`incentive_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_incentive` */

/*Table structure for table `payroll_employee_insurance` */

DROP TABLE IF EXISTS `payroll_employee_insurance`;

CREATE TABLE `payroll_employee_insurance` (
  `employee_insurance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `insurance_id` int(10) DEFAULT 0,
  `insurance_premi_id` int(10) DEFAULT 0,
  `employee_insurance_description` varchar(250) DEFAULT '',
  `employee_insurance_period` decimal(10,0) DEFAULT 0,
  `employee_insurance_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_insurance_id`),
  KEY `FK_payroll_employee_insurance_insurance_id` (`insurance_id`),
  KEY `FK_payroll_employee_insurance_premi_id` (`insurance_premi_id`),
  KEY `FK_payroll_employee_insurance_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_insurance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_insurance_insurance_id` FOREIGN KEY (`insurance_id`) REFERENCES `core_insurance` (`insurance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_insurance_premi_id` FOREIGN KEY (`insurance_premi_id`) REFERENCES `core_insurance_premi` (`insurance_premi_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_insurance` */

/*Table structure for table `payroll_employee_length_service` */

DROP TABLE IF EXISTS `payroll_employee_length_service`;

CREATE TABLE `payroll_employee_length_service` (
  `employee_length_service_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `length_service_id` int(10) DEFAULT 0,
  `employee_length_service_description` varchar(250) DEFAULT '',
  `employee_length_service_period` decimal(10,0) DEFAULT 0,
  `employee_length_service_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_length_service_id`),
  KEY `FK_payroll_employee_length_service_length_service_id` (`length_service_id`),
  KEY `FK_payroll_employee_length_service_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_length_service_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_length_service_length_service_id` FOREIGN KEY (`length_service_id`) REFERENCES `core_length_service` (`length_service_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_length_service` */

/*Table structure for table `payroll_employee_loan` */

DROP TABLE IF EXISTS `payroll_employee_loan`;

CREATE TABLE `payroll_employee_loan` (
  `employee_loan_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `loan_type_id` int(10) DEFAULT 0,
  `employee_loan_date` date DEFAULT NULL,
  `employee_code` varchar(20) DEFAULT '',
  `employee_loan_description` text DEFAULT NULL,
  `employee_loan_start_period` decimal(10,0) DEFAULT 0,
  `employee_loan_amount` decimal(10,0) DEFAULT 0,
  `employee_loan_amount_total` decimal(20,0) DEFAULT 0,
  `employee_total_period` decimal(1,0) DEFAULT NULL,
  `employee_loan_status` decimal(1,0) DEFAULT 1,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_loan_id`),
  KEY `FK_payroll_employee_loan_loan_type_id` (`loan_type_id`),
  KEY `FK_payroll_employee_loan_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_loan_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_loan_loan_type_id` FOREIGN KEY (`loan_type_id`) REFERENCES `core_loan_type` (`loan_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_loan` */

/*Table structure for table `payroll_employee_loan_item` */

DROP TABLE IF EXISTS `payroll_employee_loan_item`;

CREATE TABLE `payroll_employee_loan_item` (
  `employee_loan_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_loan_id` bigint(22) DEFAULT 0,
  `employee_loan_item_period` decimal(10,0) DEFAULT 0,
  `employee_loan_item_amount` decimal(20,2) DEFAULT 0.00,
  `employee_loan_item_payment` decimal(20,2) DEFAULT 0.00,
  `employee_loan_item_balance` decimal(20,2) DEFAULT 0.00,
  `employee_loan_payment_date` datetime DEFAULT NULL,
  `employee_loan_payment_period` decimal(10,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_loan_item_id`),
  KEY `FK_payroll_employee_loan_item_employee_loan_id` (`employee_loan_id`),
  CONSTRAINT `FK_payroll_employee_loan_item_employee_loan_id` FOREIGN KEY (`employee_loan_id`) REFERENCES `payroll_employee_loan` (`employee_loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_loan_item` */

/*Table structure for table `payroll_employee_loan_requisition` */

DROP TABLE IF EXISTS `payroll_employee_loan_requisition`;

CREATE TABLE `payroll_employee_loan_requisition` (
  `employee_loan_requisition_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT NULL,
  `loan_type_id` int(10) DEFAULT NULL,
  `employee_loan_requisition_date` date DEFAULT NULL,
  `employee_employment_status` decimal(1,0) DEFAULT NULL,
  `employee_total_salary_amount` decimal(20,0) DEFAULT NULL,
  `employee_total_period` decimal(1,0) DEFAULT NULL,
  `employee_loan_amount_total` decimal(20,0) DEFAULT NULL,
  `employee_loan_amount` decimal(10,0) DEFAULT NULL,
  `employee_loan_requisition_status` decimal(1,0) DEFAULT NULL,
  `approved_id` int(10) DEFAULT NULL,
  `approved_on` datetime DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT NULL,
  `created_id` int(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`employee_loan_requisition_id`),
  KEY `FK_payroll_employee_loan_requisition_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_requisition_loan_type_id` (`loan_type_id`),
  CONSTRAINT `FK_payroll_employee_loan_requisition_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_requisition_loan_type_id` FOREIGN KEY (`loan_type_id`) REFERENCES `core_loan_type` (`loan_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_loan_requisition` */

/*Table structure for table `payroll_employee_monthly` */

DROP TABLE IF EXISTS `payroll_employee_monthly`;

CREATE TABLE `payroll_employee_monthly` (
  `employee_monthly_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `bank_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_monthly_start_date` date DEFAULT NULL,
  `employee_monthly_end_date` date DEFAULT NULL,
  `employee_monthly_bank_acct_name` varchar(50) DEFAULT '',
  `employee_monthly_bank_acct_no` varchar(50) DEFAULT '',
  `employee_monthly_date` date DEFAULT NULL,
  `employee_monthly_basic_daily_salary` decimal(20,0) DEFAULT 0,
  `employee_monthly_basic_salary` decimal(20,0) DEFAULT 0,
  `employee_monthly_basic_overtime` decimal(20,0) DEFAULT 0,
  `employee_monthly_working_days` decimal(20,2) DEFAULT 0.00,
  `employee_monthly_allowance_total` decimal(20,0) DEFAULT 0,
  `employee_monthly_deduction_total` decimal(20,0) DEFAULT 0,
  `employee_monthly_overtime_total` decimal(20,0) DEFAULT 0,
  `employee_monthly_early_total` decimal(20,0) DEFAULT 0,
  `employee_monthly_bpjs_status` decimal(1,0) DEFAULT 0,
  `employee_monthly_bpjs_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_length_service_month` decimal(20,0) DEFAULT 0,
  `employee_monthly_length_service_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_length_saving_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_premi_attendance_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_incentive_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_allowance_other` decimal(20,0) DEFAULT 0,
  `employee_monthly_allowance_description` varchar(250) DEFAULT '',
  `employee_monthly_deduction_other` decimal(20,0) DEFAULT 0,
  `employee_monthly_deduction_description` varchar(250) DEFAULT '',
  `employee_monthly_loan_amount` decimal(20,0) DEFAULT 0,
  `employee_monthly_salary_total` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_bank_id` (`bank_id`),
  CONSTRAINT `FK_payroll_employee_monthly_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `core_bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly` */

/*Table structure for table `payroll_employee_monthly_absence` */

DROP TABLE IF EXISTS `payroll_employee_monthly_absence`;

CREATE TABLE `payroll_employee_monthly_absence` (
  `employee_monthly_absence_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `absence_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_absence_description` varchar(250) DEFAULT '',
  `employee_absence_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT NULL,
  `created_id` int(10) DEFAULT 0,
  `created_on` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_absence_id`),
  KEY `FK_payroll_employee_monthly_absence_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_absence_absence_id` (`absence_id`),
  KEY `FK_payroll_employee_monthly_absence_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_monthly_absence_absence_id` FOREIGN KEY (`absence_id`) REFERENCES `core_absence` (`absence_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_absence_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_absence_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_absence` */

/*Table structure for table `payroll_employee_monthly_allowance` */

DROP TABLE IF EXISTS `payroll_employee_monthly_allowance`;

CREATE TABLE `payroll_employee_monthly_allowance` (
  `employee_monthly_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `employee_allowance_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(20,0) DEFAULT 0,
  `employee_allowance_amount` decimal(10,0) DEFAULT 0,
  `employee_monthly_working_days` decimal(10,2) DEFAULT 0.00,
  `employee_monthly_allowance_days` decimal(10,2) DEFAULT 0.00,
  `employee_allowance_subtotal` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_allowance_id`),
  KEY `FK_payroll_employee_monthly_allowance_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_allowance_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_allowance_allowance_id` (`allowance_id`),
  KEY `FK_payroll_employee_monthly_allowance_employee_allowance_id` (`employee_allowance_id`),
  CONSTRAINT `FK_payroll_employee_monthly_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_allowance_employee_allowance_id` FOREIGN KEY (`employee_allowance_id`) REFERENCES `payroll_employee_allowance` (`employee_allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_allowance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_allowance_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_allowance` */

/*Table structure for table `payroll_employee_monthly_dayoff` */

DROP TABLE IF EXISTS `payroll_employee_monthly_dayoff`;

CREATE TABLE `payroll_employee_monthly_dayoff` (
  `employee_monthly_dayoff_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `dayoff_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(20,0) DEFAULT 0,
  `employee_working_dayoff_description` varchar(250) DEFAULT '',
  `working_dayoff_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT NULL,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_dayoff_id`),
  KEY `FK_payroll_employee_monthly_dayoff_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_dayoff_dayoff_id` (`dayoff_id`),
  KEY `FK_payroll_employee_monthly_dayoff_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_dayoff_dayoff_id` FOREIGN KEY (`dayoff_id`) REFERENCES `core_dayoff` (`dayoff_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_dayoff_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_dayoff_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_dayoff` */

/*Table structure for table `payroll_employee_monthly_deduction` */

DROP TABLE IF EXISTS `payroll_employee_monthly_deduction`;

CREATE TABLE `payroll_employee_monthly_deduction` (
  `employee_monthly_deduction_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `deduction_id` int(10) DEFAULT 0,
  `employee_deduction_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_deduction_amount` decimal(10,0) DEFAULT 0,
  `employee_monthly_working_days` decimal(10,0) DEFAULT 0,
  `employee_monthly_deduction_days` decimal(10,0) DEFAULT 0,
  `employee_deduction_subtotal` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_deduction_id`),
  KEY `FK_payroll_employee_monthly_deduction_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_deduction_deduction_id` (`deduction_id`),
  KEY `FK_payroll_employee_monthly_deduction_employee_deduction_id` (`employee_deduction_id`),
  KEY `FK_payroll_employee_monthly_deduction_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_deduction_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_deduction_employee_deduction_id` FOREIGN KEY (`employee_deduction_id`) REFERENCES `payroll_employee_deduction` (`employee_deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_deduction_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_deduction_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_deduction` */

/*Table structure for table `payroll_employee_monthly_early` */

DROP TABLE IF EXISTS `payroll_employee_monthly_early`;

CREATE TABLE `payroll_employee_monthly_early` (
  `employee_monthly_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `deduction_id` int(10) DEFAULT 0,
  `employee_deduction_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_deduction_amount` decimal(10,0) DEFAULT 0,
  `employee_monthly_working_days` decimal(10,0) DEFAULT 0,
  `employee_monthly_deduction_days` decimal(10,0) DEFAULT 0,
  `employee_deduction_subtotal` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_early_id`),
  KEY `FK_payroll_employee_monthly_early_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_early_deduction_id` (`deduction_id`),
  KEY `FK_payroll_employee_monthly_early_employee_deduction_id` (`employee_deduction_id`),
  KEY `FK_payroll_employee_monthly_early_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_early_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_early_employee_deduction_id` FOREIGN KEY (`employee_deduction_id`) REFERENCES `payroll_employee_deduction` (`employee_deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_early_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_early_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_early` */

/*Table structure for table `payroll_employee_monthly_home_early` */

DROP TABLE IF EXISTS `payroll_employee_monthly_home_early`;

CREATE TABLE `payroll_employee_monthly_home_early` (
  `employee_monthly_home_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_home_early_monthly_description` varchar(250) DEFAULT '',
  `employee_home_early_monthly_date` date DEFAULT NULL,
  `employee_home_early_monthly_hour` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_home_early_id`),
  KEY `FK_payroll_employee_monthly_home_early_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_home_early_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_home_early_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_home_early_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_home_early` */

/*Table structure for table `payroll_employee_monthly_late` */

DROP TABLE IF EXISTS `payroll_employee_monthly_late`;

CREATE TABLE `payroll_employee_monthly_late` (
  `employee_monthly_late_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `late_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_late_description` varchar(250) DEFAULT '',
  `employee_late_date` date DEFAULT NULL,
  `employee_late_duration` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_late_id`),
  KEY `FK_payroll_employee_monthly_late_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_late_late_id` (`late_id`),
  KEY `FK_payroll_employee_monthly_late_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_late_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_late_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_late_late_id` FOREIGN KEY (`late_id`) REFERENCES `core_late` (`late_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_late` */

/*Table structure for table `payroll_employee_monthly_leave` */

DROP TABLE IF EXISTS `payroll_employee_monthly_leave`;

CREATE TABLE `payroll_employee_monthly_leave` (
  `employee_monthly_leave_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `annual_leave_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `leave_request_description` varchar(250) DEFAULT '',
  `leave_request_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_leave_id`),
  KEY `FK_payroll_employee_monthly_leave_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_leave_annual_leave_id` (`annual_leave_id`),
  KEY `FK_payroll_employee_monthly_leave_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_payroll_employee_monthly_leave_annual_leave_id` FOREIGN KEY (`annual_leave_id`) REFERENCES `core_annual_leave` (`annual_leave_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_leave_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_leave_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_leave` */

/*Table structure for table `payroll_employee_monthly_loan` */

DROP TABLE IF EXISTS `payroll_employee_monthly_loan`;

CREATE TABLE `payroll_employee_monthly_loan` (
  `employee_monthly_loan_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(20,0) DEFAULT 0,
  `loan_type_id` int(10) DEFAULT 0,
  `employee_loan_item_amount` decimal(20,2) DEFAULT 0.00,
  `employee_loan_item_period` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_loan_id`),
  KEY `FK_payroll_employee_loan_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_loan_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_loan_loan_type_id` (`loan_type_id`),
  CONSTRAINT `FK_payroll_employee_loan_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_loan_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_loan_loan_type_id` FOREIGN KEY (`loan_type_id`) REFERENCES `core_loan_type` (`loan_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_loan` */

/*Table structure for table `payroll_employee_monthly_overtime` */

DROP TABLE IF EXISTS `payroll_employee_monthly_overtime`;

CREATE TABLE `payroll_employee_monthly_overtime` (
  `employee_monthly_overtime_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `employee_basic_overtime` decimal(10,0) DEFAULT 0,
  `employee_overtime_monthly_total1` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_monthly_total2` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_dayoff_total1` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_dayoff_total2` decimal(10,2) DEFAULT 0.00,
  `employee_overtime_amount_total` decimal(20,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_overtime_id`),
  KEY `FK_payroll_employee_monthly_overtime_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_overtime_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_monthly_overtime_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_overtime_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_overtime` */

/*Table structure for table `payroll_employee_monthly_overtime_request` */

DROP TABLE IF EXISTS `payroll_employee_monthly_overtime_request`;

CREATE TABLE `payroll_employee_monthly_overtime_request` (
  `employee_monthly_overtime_request_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `overtime_type_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `overtime_request_description` varchar(250) DEFAULT '',
  `overtime_request_date` date DEFAULT NULL,
  `overtime_request_duration` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_overtime_request_id`),
  KEY `FK_employee_monthly_overtime_request_employee_id` (`employee_id`),
  KEY `FK_employee_monthly_overtime_request_overtime_type_id` (`overtime_type_id`),
  KEY `FK_employee_monthly_overtime_request_employee_monthly_id` (`employee_monthly_id`),
  CONSTRAINT `FK_employee_monthly_overtime_request_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_monthly_overtime_request_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_employee_monthly_overtime_request_overtime_type_id` FOREIGN KEY (`overtime_type_id`) REFERENCES `core_overtime_type` (`overtime_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_overtime_request` */

/*Table structure for table `payroll_employee_monthly_permit` */

DROP TABLE IF EXISTS `payroll_employee_monthly_permit`;

CREATE TABLE `payroll_employee_monthly_permit` (
  `employee_monthly_permit_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `permit_id` int(10) DEFAULT 0,
  `employee_monthly_period` decimal(10,0) DEFAULT 0,
  `permit_type` decimal(1,0) DEFAULT 0,
  `deduction_type` decimal(1,0) DEFAULT 0,
  `employee_permit_description` varchar(250) DEFAULT '',
  `employee_permit_detail_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_permit_id`),
  KEY `FK_payroll_employee_monthly_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_permit_employee_id` (`employee_id`),
  KEY `FK_payroll_employee_monthly_permit_permit_id` (`permit_id`),
  CONSTRAINT `FK_payroll_employee_monthly_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_permit_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_permit_permit_id` FOREIGN KEY (`permit_id`) REFERENCES `core_permit` (`permit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_permit` */

/*Table structure for table `payroll_employee_monthly_saving` */

DROP TABLE IF EXISTS `payroll_employee_monthly_saving`;

CREATE TABLE `payroll_employee_monthly_saving` (
  `employee_monthly_saving_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_monthly_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_monthly_period` decimal(20,0) DEFAULT 0,
  `employee_monthly_length_saving_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_monthly_saving_id`),
  KEY `FK_payroll_employee_monthly_saving_employee_monthly_id` (`employee_monthly_id`),
  KEY `FK_payroll_employee_monthly_saving_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_monthly_saving_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_monthly_saving_employee_monthly_id` FOREIGN KEY (`employee_monthly_id`) REFERENCES `payroll_employee_monthly` (`employee_monthly_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_monthly_saving` */

/*Table structure for table `payroll_employee_payment` */

DROP TABLE IF EXISTS `payroll_employee_payment`;

CREATE TABLE `payroll_employee_payment` (
  `employee_payment_id` int(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `bank_id` int(10) DEFAULT 0,
  `employee_payment_period` decimal(10,0) DEFAULT 0,
  `payment_basic_salary` decimal(20,0) DEFAULT 0,
  `payment_basic_overtime` decimal(10,0) DEFAULT 0,
  `payment_bank_acct_no` varchar(30) DEFAULT '',
  `payment_bank_acct_name` varchar(50) DEFAULT '',
  `payment_home_early_status` decimal(1,0) DEFAULT 0,
  `payment_home_early_amount` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_payment_id`),
  KEY `FK_hro_employee_payment_bank_id` (`bank_id`),
  KEY `FK_hro_employee_payment_employee_id` (`employee_id`),
  CONSTRAINT `FK_hro_employee_payment_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `core_bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_hro_employee_payment_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_payment` */

/*Table structure for table `payroll_employee_premi_attendance` */

DROP TABLE IF EXISTS `payroll_employee_premi_attendance`;

CREATE TABLE `payroll_employee_premi_attendance` (
  `employee_premi_attendance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `premi_attendance_id` int(10) DEFAULT 0,
  `employee_premi_attendance_description` varchar(250) DEFAULT '',
  `employee_premi_attendance_period` decimal(10,0) DEFAULT 0,
  `employee_premi_attendance_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_premi_attendance_id`),
  KEY `FK_payroll_employee_premi_attendance_premi_attendance_id` (`premi_attendance_id`),
  KEY `FK_payroll_employee_premi_attendance_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_employee_premi_attendance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_employee_premi_attendance_premi_attendance_id` FOREIGN KEY (`premi_attendance_id`) REFERENCES `core_premi_attendance` (`premi_attendance_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_employee_premi_attendance` */

/*Table structure for table `payroll_glasses_claim` */

DROP TABLE IF EXISTS `payroll_glasses_claim`;

CREATE TABLE `payroll_glasses_claim` (
  `glasses_claim_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `glasses_coverage_id` int(10) DEFAULT 0,
  `employee_glasses_coverage_id` bigint(22) DEFAULT 0,
  `glasses_claim_period` decimal(10,0) DEFAULT 0,
  `glasses_claim_date` date DEFAULT NULL,
  `glasses_claim_description` varchar(250) DEFAULT '',
  `glasses_claim_opening_balance` decimal(20,2) DEFAULT 0.00,
  `glasses_claim_amount` decimal(20,2) DEFAULT 0.00,
  `glasses_claim_last_balance` decimal(20,2) DEFAULT 0.00,
  `glasses_claim_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(11) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`glasses_claim_id`),
  KEY `FK_transaction_glasses_claim_employee_id` (`employee_id`),
  KEY `FK_transaction_glasses_claim_glasses_coverage_id` (`employee_glasses_coverage_id`),
  KEY `FK_payroll_glasses_claim_glasses_coverage_id` (`glasses_coverage_id`),
  CONSTRAINT `FK_payroll_glasses_claim_employee_glasses_coverage_id` FOREIGN KEY (`employee_glasses_coverage_id`) REFERENCES `hro_employee_glasses_coverage` (`employee_glasses_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_glasses_claim_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_glasses_claim_glasses_coverage_id` FOREIGN KEY (`glasses_coverage_id`) REFERENCES `core_glasses_coverage` (`glasses_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_glasses_claim` */

/*Table structure for table `payroll_hospital_claim` */

DROP TABLE IF EXISTS `payroll_hospital_claim`;

CREATE TABLE `payroll_hospital_claim` (
  `hospital_claim_id` bigint(2) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `hospital_coverage_id` int(10) DEFAULT 0,
  `employee_hospital_coverage_id` bigint(22) DEFAULT 0,
  `hospital_claim_period` decimal(10,0) DEFAULT 0,
  `hospital_claim_date` date DEFAULT NULL,
  `hospital_claim_description` varchar(250) DEFAULT '',
  `hospital_claim_opening_balance` decimal(20,2) DEFAULT 0.00,
  `hospital_claim_amount` decimal(20,2) DEFAULT 0.00,
  `hospital_claim_last_balance` decimal(20,2) DEFAULT 0.00,
  `hospital_claim_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`hospital_claim_id`),
  KEY `FK_transaction_hospital_claim_employee_id` (`employee_id`),
  KEY `FK_transaction_hospital_claim_hospital_coverage_id` (`employee_hospital_coverage_id`),
  KEY `FK_payroll_hospital_claim_hospital_coverage_id` (`hospital_coverage_id`),
  CONSTRAINT `FK_payroll_hospital_claim_employee_hospital_coverage_id` FOREIGN KEY (`employee_hospital_coverage_id`) REFERENCES `hro_employee_hospital_coverage` (`employee_hospital_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_hospital_claim_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_hospital_claim_hospital_coverage_id` FOREIGN KEY (`hospital_coverage_id`) REFERENCES `core_hospital_coverage` (`hospital_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_hospital_claim` */

/*Table structure for table `payroll_ilufa` */

DROP TABLE IF EXISTS `payroll_ilufa`;

CREATE TABLE `payroll_ilufa` (
  `employee_id` bigint(22) DEFAULT NULL,
  `no` double DEFAULT NULL,
  `marital_status_id` double DEFAULT NULL,
  `region_id` double DEFAULT NULL,
  `branch_id` double DEFAULT NULL,
  `location_id` double DEFAULT NULL,
  `division_id` double DEFAULT NULL,
  `department_id` double DEFAULT NULL,
  `section_id` double DEFAULT NULL,
  `job_title_id` double DEFAULT NULL,
  `grade_id` double DEFAULT NULL,
  `class_id` double DEFAULT NULL,
  `employee_code` varchar(20) DEFAULT '',
  `employee_name` varchar(255) DEFAULT NULL,
  `bank_id` varchar(255) DEFAULT NULL,
  `employee_bank_acct_no` varchar(255) DEFAULT NULL,
  `employee_hire_date` timestamp NULL DEFAULT NULL,
  `masa_kerja` double DEFAULT NULL,
  `tahun` double DEFAULT NULL,
  `bulan` varchar(255) DEFAULT NULL,
  `employee_employment_status_duedate` timestamp NULL DEFAULT NULL,
  `hari_kerja` double DEFAULT NULL,
  `upah_harian` double DEFAULT NULL,
  `gaji_training` double DEFAULT NULL,
  `employee_basic_salary` double DEFAULT NULL,
  `allowance_id_ut` int(10) DEFAULT 0,
  `uang_transport` double DEFAULT NULL,
  `allowance_id_um` int(10) DEFAULT 0,
  `uang_makan` double DEFAULT NULL,
  `allowance_id_rent` int(10) DEFAULT 0,
  `uang_sewa` double DEFAULT NULL,
  `total_upah_harian` double DEFAULT NULL,
  `total_basic_salary` double DEFAULT NULL,
  `total_uang_transport` double DEFAULT NULL,
  `total_uang_sewa` double DEFAULT NULL,
  `total_uang_makan` double DEFAULT NULL,
  `tmk_sisa` double DEFAULT NULL,
  `tapenas` double DEFAULT NULL,
  `bonus` double DEFAULT NULL,
  `premi_attendance_id` int(10) DEFAULT 0,
  `premi_attendance` double DEFAULT NULL,
  `allowance_id_pulsa` int(10) DEFAULT 0,
  `pulsa` double DEFAULT NULL,
  `komisi` double DEFAULT NULL,
  `allowance_id_jab` int(10) DEFAULT 0,
  `tunjangan_jabatan` double DEFAULT NULL,
  `incentive` double DEFAULT NULL,
  `total_salary` double DEFAULT NULL,
  `deduction_id_permit` int(10) DEFAULT 0,
  `potongan_tidak_hadir` double DEFAULT NULL,
  `bpjs` double DEFAULT NULL,
  `jams` double DEFAULT NULL,
  `barang_kurang` double DEFAULT NULL,
  `premi_deduction_id` int(10) DEFAULT 0,
  `premi_attendance_deduction` double DEFAULT NULL,
  `bonus_deduction` double DEFAULT NULL,
  `uang_baru_deduction` double DEFAULT NULL,
  `loan_type_id` int(10) DEFAULT 0,
  `employee_loan_amount` double DEFAULT NULL,
  `loan_type_id_luna` int(10) DEFAULT 0,
  `employee_loan_amount_luna` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `tambahan_luar_kota` varchar(255) DEFAULT NULL,
  `take_home_pay` double DEFAULT NULL,
  `employee_employment_working_status` decimal(1,0) DEFAULT 0,
  `employee_employment_overtime_status` decimal(1,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_ilufa` */

/*Table structure for table `payroll_incidental_allowance` */

DROP TABLE IF EXISTS `payroll_incidental_allowance`;

CREATE TABLE `payroll_incidental_allowance` (
  `incidental_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `allowance_id` int(10) DEFAULT 0,
  `incidental_allowance_description` varchar(250) DEFAULT '',
  `incidental_allowance_period` decimal(10,0) DEFAULT 0,
  `incidental_allowance_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`incidental_allowance_id`),
  KEY `FK_transaction_incidental_allowance_employee_id` (`employee_id`),
  KEY `FK_transaction_incidental_allowance_allowance_id` (`allowance_id`) USING BTREE,
  CONSTRAINT `FK_payroll_incidental_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_incidental_allowance_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_incidental_allowance` */

/*Table structure for table `payroll_incidental_deduction` */

DROP TABLE IF EXISTS `payroll_incidental_deduction`;

CREATE TABLE `payroll_incidental_deduction` (
  `incidental_deduction_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `deduction_id` int(10) DEFAULT NULL,
  `incidental_deduction_description` varchar(250) DEFAULT '',
  `incidental_deduction_period` decimal(10,0) DEFAULT 0,
  `incidental_deduction_amount` decimal(20,2) DEFAULT 0.00,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`incidental_deduction_id`),
  KEY `FK_transaction_incidental_deduction_employee_id` (`employee_id`),
  KEY `FK_transaction_incidental_deduction_deduction_id` (`deduction_id`) USING BTREE,
  CONSTRAINT `FK_payroll_incidental_deduction_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_incidental_deduction_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_incidental_deduction` */

/*Table structure for table `payroll_leave_request` */

DROP TABLE IF EXISTS `payroll_leave_request`;

CREATE TABLE `payroll_leave_request` (
  `leave_request_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `annual_leave_id` int(10) DEFAULT 0,
  `leave_request_description` varchar(250) DEFAULT '',
  `leave_request_date` date DEFAULT NULL,
  `leave_request_start_date` date DEFAULT NULL,
  `leave_request_end_date` date DEFAULT NULL,
  `leave_request_duration` decimal(10,0) DEFAULT 0,
  `leave_request_reason` text DEFAULT NULL,
  `leave_request_approved` decimal(1,0) DEFAULT 0,
  `leave_request_approved_id` int(10) DEFAULT 0,
  `leave_request_approved_on` datetime DEFAULT NULL,
  `leave_request_approved_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) NOT NULL DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_request_id`),
  KEY `FK_transaction_leave_request_employee_id` (`employee_id`),
  KEY `FK_transaction_leave_request_annual_leave_id` (`annual_leave_id`),
  CONSTRAINT `FK_payroll_leave_request_annual_leave_id` FOREIGN KEY (`annual_leave_id`) REFERENCES `core_annual_leave` (`annual_leave_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_leave_request_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_leave_request` */

/*Table structure for table `payroll_leave_request_detail` */

DROP TABLE IF EXISTS `payroll_leave_request_detail`;

CREATE TABLE `payroll_leave_request_detail` (
  `leave_request_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `leave_request_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `leave_request_detail_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_request_detail_id`),
  KEY `FK_payroll_leave_request_detail_leave_request_id` (`leave_request_id`),
  KEY `FK_payroll_leave_request_detail_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_leave_request_detail_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_leave_request_detail_leave_request_id` FOREIGN KEY (`leave_request_id`) REFERENCES `payroll_leave_request` (`leave_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_leave_request_detail` */

/*Table structure for table `payroll_medical_claim` */

DROP TABLE IF EXISTS `payroll_medical_claim`;

CREATE TABLE `payroll_medical_claim` (
  `medical_claim_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `medical_coverage_id` int(10) DEFAULT 0,
  `employee_medical_coverage_id` bigint(22) DEFAULT 0,
  `medical_claim_period` decimal(10,0) DEFAULT 0,
  `medical_claim_date` date DEFAULT NULL,
  `medical_claim_description` varchar(250) DEFAULT '',
  `medical_claim_opening_balance` decimal(20,2) DEFAULT 0.00,
  `medical_claim_amount` decimal(20,2) DEFAULT 0.00,
  `medical_claim_last_balance` decimal(20,2) DEFAULT 0.00,
  `medical_claim_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`medical_claim_id`),
  KEY `FK_transaction_medical_claim_employee_id` (`employee_id`),
  KEY `FK_transaction_medical_claim_medical_coverage_id` (`employee_medical_coverage_id`),
  KEY `FK_payroll_medical_claim_medical_coverage_id` (`medical_coverage_id`),
  CONSTRAINT `FK_payroll_medical_claim_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_medical_claim_employee_medical_coverage_id` FOREIGN KEY (`employee_medical_coverage_id`) REFERENCES `hro_employee_medical_coverage` (`employee_medical_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_medical_claim_medical_coverage_id` FOREIGN KEY (`medical_coverage_id`) REFERENCES `core_medical_coverage` (`medical_coverage_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_medical_claim` */

/*Table structure for table `payroll_monthly_period` */

DROP TABLE IF EXISTS `payroll_monthly_period`;

CREATE TABLE `payroll_monthly_period` (
  `monthly_period_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `monthly_period` decimal(10,0) DEFAULT 0,
  `monthly_period_start_date` date DEFAULT NULL,
  `monthly_period_end_date` date DEFAULT NULL,
  `monthly_period_working_days` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`monthly_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_monthly_period` */

/*Table structure for table `payroll_overtime_automatic` */

DROP TABLE IF EXISTS `payroll_overtime_automatic`;

CREATE TABLE `payroll_overtime_automatic` (
  `overtime_automatic_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `overtime_automatic_start_date` date DEFAULT NULL,
  `overtime_automatic_end_date` date DEFAULT NULL,
  `overtime_automatic_duration` decimal(10,2) DEFAULT 0.00,
  `overtime_automatic_daily_name` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_automatic_id`),
  KEY `FK_payroll_overtime_automatic_region_id` (`region_id`),
  KEY `FK_payroll_overtime_automatic_branch_id` (`branch_id`),
  KEY `FK_payroll_overtime_location_id` (`location_id`),
  KEY `FK_payroll_overtime_division_id` (`division_id`),
  KEY `FK_payroll_overtime_department_id` (`department_id`),
  KEY `FK_payroll_overtime_section_id` (`section_id`),
  CONSTRAINT `FK_payroll_overtime_automatic_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_automatic_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_overtime_automatic` */

/*Table structure for table `payroll_overtime_automatic_exception` */

DROP TABLE IF EXISTS `payroll_overtime_automatic_exception`;

CREATE TABLE `payroll_overtime_automatic_exception` (
  `overtime_automatic_exception_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `overtime_automatic_exception_date` date DEFAULT NULL,
  `overtime_automatic_exception_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_automatic_exception_id`),
  KEY `FK_payroll_overtime_automatic_exception_employee_id` (`employee_id`),
  CONSTRAINT `FK_payroll_overtime_automatic_exception_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_overtime_automatic_exception` */

/*Table structure for table `payroll_overtime_request` */

DROP TABLE IF EXISTS `payroll_overtime_request`;

CREATE TABLE `payroll_overtime_request` (
  `overtime_request_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(22) DEFAULT 0,
  `overtime_type_id` int(10) DEFAULT 0,
  `overtime_request_description` varchar(250) DEFAULT '',
  `overtime_request_date` date DEFAULT NULL,
  `overtime_request_hours` decimal(10,0) DEFAULT 0,
  `overtime_request_minutes` decimal(10,0) DEFAULT 0,
  `overtime_request_remark` text DEFAULT NULL,
  `overtime_request_approved` decimal(1,0) DEFAULT 0,
  `overtime_request_approved_id` varchar(20) DEFAULT '',
  `overtime_request_approved_on` datetime DEFAULT NULL,
  `overtime_request_approved_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT NULL,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`overtime_request_id`),
  KEY `FK_transaction_overtime_request_employee_id` (`employee_id`),
  KEY `FK_transaction_overtime_request_overtime_type_id` (`overtime_type_id`),
  CONSTRAINT `FK_payroll_overtime_request_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payroll_overtime_request_overtime_type_id` FOREIGN KEY (`overtime_type_id`) REFERENCES `core_overtime_type` (`overtime_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_overtime_request` */

/*Table structure for table `payroll_period_allowance` */

DROP TABLE IF EXISTS `payroll_period_allowance`;

CREATE TABLE `payroll_period_allowance` (
  `period_allowance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `allowance_id` int(10) DEFAULT 0,
  `period_allowance_period` decimal(10,0) DEFAULT 0,
  `period_allowance_working_start` decimal(10,0) DEFAULT 0,
  `period_allowance_working_end` decimal(10,0) DEFAULT 0,
  `period_allowance_description` varchar(250) DEFAULT '',
  `period_allowance_amount_monthly` decimal(20,0) DEFAULT 0,
  `period_allowance_amount_daily` decimal(20,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_allowance_id`),
  KEY `FK_payroll_period_allowance_allowance_id` (`allowance_id`),
  CONSTRAINT `FK_payroll_period_allowance_allowance_id` FOREIGN KEY (`allowance_id`) REFERENCES `core_allowance` (`allowance_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_allowance` */

/*Table structure for table `payroll_period_attendance` */

DROP TABLE IF EXISTS `payroll_period_attendance`;

CREATE TABLE `payroll_period_attendance` (
  `period_attendance_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `premi_attendance_id` int(10) DEFAULT 0,
  `period_attendance_period` decimal(10,0) DEFAULT 0,
  `period_attendance_working_start` decimal(10,0) DEFAULT 0,
  `period_attendance_working_end` decimal(10,0) DEFAULT 0,
  `period_attendance_description` varchar(250) DEFAULT '',
  `period_attendance_amount_monthly` decimal(20,0) DEFAULT 0,
  `period_attendance_amount_daily` decimal(20,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_attendance_id`),
  KEY `FK_payroll_period_attendance_premi_attendance_id` (`premi_attendance_id`),
  CONSTRAINT `FK_payroll_period_attendance_premi_attendance_id` FOREIGN KEY (`premi_attendance_id`) REFERENCES `core_premi_attendance` (`premi_attendance_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_attendance` */

/*Table structure for table `payroll_period_bpjs` */

DROP TABLE IF EXISTS `payroll_period_bpjs`;

CREATE TABLE `payroll_period_bpjs` (
  `period_bpjs_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `period_bpjs_period` decimal(10,0) DEFAULT 0,
  `period_bpjs_working_start` decimal(10,0) DEFAULT 0,
  `period_bpjs_working_end` decimal(10,0) DEFAULT 0,
  `period_bpjs_kesehatan_amount` decimal(20,0) DEFAULT 0,
  `period_bpjs_tenagakerja_amount` decimal(20,0) DEFAULT 0,
  `bpjs_tenagakerja_subvention_monthly` decimal(20,0) DEFAULT 0,
  `bpjs_tenagakerja_subvention_daily` decimal(20,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_bpjs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_bpjs` */

/*Table structure for table `payroll_period_deduction` */

DROP TABLE IF EXISTS `payroll_period_deduction`;

CREATE TABLE `payroll_period_deduction` (
  `period_deduction_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `deduction_id` int(10) DEFAULT 0,
  `period_deduction_period` decimal(10,0) DEFAULT 0,
  `period_deduction_working_start` decimal(10,0) DEFAULT 0,
  `period_deduction_working_end` decimal(10,0) DEFAULT 0,
  `period_deduction_description` varchar(250) DEFAULT '',
  `period_deduction_amount_monthly` decimal(20,0) DEFAULT 0,
  `period_deduction_amount_daily` decimal(20,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_deduction_id`),
  KEY `FK_payroll_period_deduction_deduction_id` (`deduction_id`),
  CONSTRAINT `FK_payroll_period_deduction_deduction_id` FOREIGN KEY (`deduction_id`) REFERENCES `core_deduction` (`deduction_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_deduction` */

/*Table structure for table `payroll_period_home_early` */

DROP TABLE IF EXISTS `payroll_period_home_early`;

CREATE TABLE `payroll_period_home_early` (
  `period_home_early_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `period_home_early_period` decimal(10,0) DEFAULT 0,
  `period_home_early_hour_start` decimal(10,0) DEFAULT 0,
  `period_home_early_hour_end` decimal(10,0) DEFAULT 0,
  `employee_attendance_incentive_status` decimal(1,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_home_early_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_home_early` */

/*Table structure for table `payroll_period_payment` */

DROP TABLE IF EXISTS `payroll_period_payment`;

CREATE TABLE `payroll_period_payment` (
  `period_payment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `unit_id` int(10) DEFAULT 0,
  `period_payment_period` decimal(10,0) DEFAULT 0,
  `period_payment_working_start` decimal(10,0) DEFAULT 0,
  `period_payment_working_end` decimal(10,0) DEFAULT 0,
  `basic_salary_monthly` decimal(20,0) DEFAULT 0,
  `basic_salary_daily` decimal(20,0) DEFAULT 0,
  `basic_overtime` decimal(20,0) DEFAULT 0,
  `meal_subvention_monthly` decimal(20,0) DEFAULT 0,
  `meal_subvention_daily` decimal(20,0) DEFAULT 0,
  `employee_employment_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`period_payment_id`),
  KEY `FK_payroll_period_payment_unit_id` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payroll_period_payment` */

/*Table structure for table `preference_company` */

DROP TABLE IF EXISTS `preference_company`;

CREATE TABLE `preference_company` (
  `company_id` int(10) NOT NULL DEFAULT 0,
  `company_name` varchar(50) DEFAULT '',
  `company_address` text DEFAULT NULL,
  `company_latitude` varchar(75) NOT NULL,
  `company_longitude` varchar(75) NOT NULL,
  `company_max_distance` double(10,2) NOT NULL DEFAULT 0.00,
  `company_home_phone1` varchar(30) DEFAULT '',
  `company_home_phone2` varchar(30) DEFAULT '',
  `company_fax_number` varchar(30) DEFAULT '',
  `company_tax_number` varchar(30) DEFAULT '',
  `company_tax_date` date DEFAULT NULL,
  `company_logo` varchar(200) DEFAULT '',
  `company_current_period` decimal(10,0) DEFAULT 0 COMMENT '1 : Januari, 2 : Februari, 3 : Maret, 4 : April, 5 : Mei, 6 : Juni, 7 : Juli, 8 : Agustus, 9 : September, 10 : Oktober, 11 : November, 12 : Desember',
  `company_fiscal_year` decimal(10,0) DEFAULT 0,
  `company_last_period` decimal(10,0) DEFAULT 0 COMMENT '1 : Januari, 2 : Februari, 3 : Maret, 4 : April, 5 : Mei, 6 : Juni, 7 : Juli, 8 : Agustus, 9 : September, 10 : Oktober, 11 : November, 12 : Desember',
  `company_using_period` decimal(10,0) DEFAULT 0,
  `company_home_early_minimum_hour` decimal(10,0) DEFAULT 0,
  `company_employee_document_location` varchar(30) DEFAULT NULL,
  `employee_working_in_start_minute` decimal(10,0) DEFAULT 0,
  `employee_working_in_end_minute` decimal(10,0) DEFAULT 0,
  `employee_working_out_start_minute` decimal(10,0) DEFAULT 0,
  `employee_working_out_end_minute` decimal(10,0) DEFAULT 0,
  `employee_meal_coupon_subvention` decimal(10,0) DEFAULT 0,
  `employee_meal_coupon_company_subvention` decimal(10,0) DEFAULT 0,
  `employee_overtime_minimum_minutes` decimal(10,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `preference_company` */

insert  into `preference_company`(`company_id`,`company_name`,`company_address`,`company_latitude`,`company_longitude`,`company_max_distance`,`company_home_phone1`,`company_home_phone2`,`company_fax_number`,`company_tax_number`,`company_tax_date`,`company_logo`,`company_current_period`,`company_fiscal_year`,`company_last_period`,`company_using_period`,`company_home_early_minimum_hour`,`company_employee_document_location`,`employee_working_in_start_minute`,`employee_working_in_end_minute`,`employee_working_out_start_minute`,`employee_working_out_end_minute`,`employee_meal_coupon_subvention`,`employee_meal_coupon_company_subvention`,`employee_overtime_minimum_minutes`,`last_update`) values 
(1,'WIRATAMA','','-7.58288','110.907068',3.00,'','','','',NULL,'',0,0,0,0,0,NULL,30,240,0,0,1000,3500,5,'2018-03-23 21:02:19');

/*Table structure for table `preference_rfid` */

DROP TABLE IF EXISTS `preference_rfid`;

CREATE TABLE `preference_rfid` (
  `preference_rfid_id` int(11) NOT NULL AUTO_INCREMENT,
  `preference_rfid_device_id` char(25) DEFAULT NULL,
  `preference_rfid_mode` int(1) DEFAULT 0 COMMENT '0 = scan, 1= add',
  `data_state` int(1) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`preference_rfid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `preference_rfid` */

insert  into `preference_rfid`(`preference_rfid_id`,`preference_rfid_device_id`,`preference_rfid_mode`,`data_state`,`last_update`) values 
(1,'cst01001001',0,0,'2020-06-06 08:09:05');

/*Table structure for table `recruitment_applicant_accident` */

DROP TABLE IF EXISTS `recruitment_applicant_accident`;

CREATE TABLE `recruitment_applicant_accident` (
  `applicant_accident_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_accident_period` decimal(6,0) DEFAULT 0,
  `applicant_accident_remark` text DEFAULT NULL,
  `applicant_accident_consequence` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_accident_id`),
  KEY `FK_transaction_applicant_accident_experience_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_accident_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_accident` */

/*Table structure for table `recruitment_applicant_colleagues` */

DROP TABLE IF EXISTS `recruitment_applicant_colleagues`;

CREATE TABLE `recruitment_applicant_colleagues` (
  `applicant_colleagues_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_colleagues_name` varchar(50) DEFAULT '',
  `applicant_colleagues_section` varchar(50) DEFAULT '',
  `applicant_colleagues_relatioship` varchar(50) DEFAULT '',
  `data_state` enum('1','0') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_colleagues_id`),
  KEY `FK_transaction_applicant_work_colleagues_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_colleagues_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_colleagues` */

/*Table structure for table `recruitment_applicant_data` */

DROP TABLE IF EXISTS `recruitment_applicant_data`;

CREATE TABLE `recruitment_applicant_data` (
  `applicant_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `marital_status_id` int(10) DEFAULT 0,
  `education_id` int(10) DEFAULT 0,
  `applicant_name` varchar(50) DEFAULT '',
  `applicant_application_date` date DEFAULT NULL,
  `applicant_place_of_birth` varchar(50) DEFAULT '',
  `applicant_date_of_birth` date DEFAULT NULL,
  `applicant_last_education` varchar(200) DEFAULT '',
  `applicant_address` text DEFAULT NULL,
  `applicant_city` varchar(50) DEFAULT '',
  `applicant_postal_code` varchar(5) DEFAULT '',
  `applicant_rt` varchar(5) DEFAULT '',
  `applicant_rw` varchar(5) DEFAULT '',
  `applicant_kecamatan` varchar(50) DEFAULT '',
  `applicant_kelurahan` varchar(50) DEFAULT '',
  `applicant_home_phone` varchar(50) DEFAULT '',
  `applicant_mobile_phone` varchar(50) DEFAULT '',
  `applicant_email_address` varchar(50) DEFAULT '',
  `applicant_residence_address` text DEFAULT NULL,
  `applicant_residence_city` varchar(50) DEFAULT '',
  `applicant_residence_postal_code` varchar(5) DEFAULT '',
  `applicant_residence_rt` varchar(5) DEFAULT '',
  `applicant_residence_rw` varchar(5) DEFAULT '',
  `applicant_residence_kecamatan` varchar(50) DEFAULT '',
  `applicant_residence_kelurahan` varchar(50) DEFAULT '',
  `applicant_residence_status` decimal(1,0) DEFAULT 0 COMMENT '0 : Private, 1 : Family, 2 : Rent, 3 : Boarding',
  `applicant_gender` decimal(1,0) DEFAULT NULL,
  `applicant_religion` decimal(1,0) DEFAULT 0 COMMENT '0 : Moslem, 1 : Christian, 2 : Catholic, 3 : Hindu, 4 : Buddha',
  `applicant_nationality` decimal(1,0) DEFAULT 0 COMMENT '0 : WNI, 1 : WNA',
  `applicant_blood_type` decimal(1,0) DEFAULT 0,
  `applicant_heir_name` varchar(50) DEFAULT '',
  `applicant_id_type` decimal(1,0) DEFAULT NULL COMMENT '0 : KTP, 1 : SIM, 9 ; Other',
  `applicant_id_number` varchar(20) DEFAULT '',
  `applicant_photo` varchar(250) DEFAULT '',
  `applicant_status` decimal(1,0) DEFAULT 0,
  `data_state` decimal(10,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_id`),
  KEY `FK_transaction_applicant_data_marital_status_id` (`marital_status_id`),
  CONSTRAINT `FK_transaction_applicant_data_marital_status_id` FOREIGN KEY (`marital_status_id`) REFERENCES `core_marital_status` (`marital_status_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_data` */

/*Table structure for table `recruitment_applicant_education` */

DROP TABLE IF EXISTS `recruitment_applicant_education`;

CREATE TABLE `recruitment_applicant_education` (
  `applicant_education_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `education_id` int(10) DEFAULT 0,
  `applicant_education_type` decimal(1,0) DEFAULT 1 COMMENT '1 : Formal Education, 0 : Non Formal Education',
  `applicant_education_name` varchar(50) DEFAULT '',
  `applicant_education_city` varchar(50) DEFAULT '',
  `applicant_education_from_period` decimal(6,0) DEFAULT 0,
  `applicant_education_to_period` decimal(6,0) DEFAULT 0,
  `applicant_education_duration` decimal(10,2) DEFAULT 0.00,
  `applicant_education_passed` decimal(10,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_education_certificate` decimal(10,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_education_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_education_id`),
  KEY `FK_transaction_applicant_education_applicant_id` (`applicant_id`),
  KEY `FK_transaction_applicant_education_education_id` (`education_id`),
  CONSTRAINT `FK_recruitment_applicant_education_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_education_education_id` FOREIGN KEY (`education_id`) REFERENCES `core_education` (`education_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_education` */

/*Table structure for table `recruitment_applicant_education_detail` */

DROP TABLE IF EXISTS `recruitment_applicant_education_detail`;

CREATE TABLE `recruitment_applicant_education_detail` (
  `applicant_education_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_education_cost` varchar(50) DEFAULT '',
  `applicant_been_champion` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_champion_major` varchar(250) DEFAULT '',
  `applicant_grade_fail` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_grade_fail_period` decimal(10,0) DEFAULT 0,
  `applicant_grade_fail_reason` text DEFAULT NULL,
  `applicant_further_study` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_further_study_major` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_education_detail_id`),
  KEY `FK_recruitment_applicant_education_detail` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_education_detail` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_education_detail` */

/*Table structure for table `recruitment_applicant_education_major` */

DROP TABLE IF EXISTS `recruitment_applicant_education_major`;

CREATE TABLE `recruitment_applicant_education_major` (
  `applicant_education_major_id` bigint(22) NOT NULL,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_education_major_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Like, 0 : Dislike',
  `applicant_education_major_name` varchar(250) DEFAULT '',
  `applicant_education_major_reason` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_education_major_id`),
  KEY `FK_recruitment_applicant_education_major_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_education_major_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_education_major` */

/*Table structure for table `recruitment_applicant_expectation` */

DROP TABLE IF EXISTS `recruitment_applicant_expectation`;

CREATE TABLE `recruitment_applicant_expectation` (
  `applicant_expectation_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_application_position` varchar(50) DEFAULT '',
  `applicant_expected_salary` decimal(10,0) DEFAULT 0,
  `applicant_working_out_town` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_working_out_town_reason` text DEFAULT NULL,
  `applicant_working_immediately` decimal(1,0) DEFAULT NULL COMMENT '1 : Yes, 0 : No',
  `applicant_working_immediately_reason` text DEFAULT NULL,
  `applicant_working_overtime` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_working_overtime_reason` text DEFAULT NULL,
  `applicant_business_trip` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_business_trip_reason` text DEFAULT NULL,
  `applicant_working_environment` decimal(1,0) DEFAULT 0,
  `applicant_working_environment_other` varchar(50) DEFAULT '',
  `applicant_working_like` text DEFAULT NULL,
  `applicant_working_dislike` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_expectation_id`),
  KEY `FK_recruitment_applicant_expectation_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_expectation_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_expectation` */

/*Table structure for table `recruitment_applicant_experience` */

DROP TABLE IF EXISTS `recruitment_applicant_experience`;

CREATE TABLE `recruitment_applicant_experience` (
  `applicant_experience_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `experience_company_name` varchar(50) DEFAULT '',
  `experience_company_address` text DEFAULT NULL,
  `experience_job_title` varchar(50) DEFAULT '',
  `experience_from_period` decimal(6,0) DEFAULT 0,
  `experience_to_period` decimal(6,0) DEFAULT 0,
  `experience_last_salary` decimal(20,2) DEFAULT 0.00,
  `experience_separation_reason` text DEFAULT NULL,
  `experience_separation_letter` decimal(1,0) DEFAULT 0,
  `experience_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`applicant_experience_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_experience` */

/*Table structure for table `recruitment_applicant_expertise` */

DROP TABLE IF EXISTS `recruitment_applicant_expertise`;

CREATE TABLE `recruitment_applicant_expertise` (
  `applicant_expertise_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `expertise_id` int(10) DEFAULT 0,
  `applicant_expertise_name` varchar(50) DEFAULT '',
  `applicant_expertise_city` varchar(50) DEFAULT '',
  `applicant_expertise_from_period` decimal(6,0) DEFAULT 0,
  `applicant_expertise_to_period` decimal(6,0) DEFAULT 0,
  `applicant_expertise_duration` decimal(10,2) DEFAULT 0.00,
  `applicant_expertise_passed` decimal(1,0) DEFAULT 0,
  `applicant_expertise_certificate` decimal(1,0) DEFAULT 0,
  `applicant_expertise_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`applicant_expertise_id`),
  KEY `FK_recruitment_applicant_expertise_applicant_id` (`applicant_id`),
  KEY `FK_recruitment_applicant_expertise_expertise_id` (`expertise_id`),
  CONSTRAINT `FK_recruitment_applicant_expertise_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_expertise_expertise_id` FOREIGN KEY (`expertise_id`) REFERENCES `core_expertise` (`expertise_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_expertise` */

/*Table structure for table `recruitment_applicant_family` */

DROP TABLE IF EXISTS `recruitment_applicant_family`;

CREATE TABLE `recruitment_applicant_family` (
  `applicant_family_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `family_relation_id` int(10) DEFAULT 0,
  `marital_status_id` int(10) DEFAULT 0,
  `applicant_family_name` varchar(50) DEFAULT '',
  `applicant_family_address` text DEFAULT NULL,
  `applicant_family_city` varchar(50) DEFAULT '',
  `applicant_family_postal_code` varchar(5) DEFAULT '',
  `applicant_family_rt` varchar(5) DEFAULT '',
  `applicant_family_rw` varchar(5) DEFAULT '',
  `applicant_family_kelurahan` varchar(50) DEFAULT '',
  `applicant_family_kecamatan` varchar(50) DEFAULT '',
  `applicant_family_home_phone` varchar(50) DEFAULT '',
  `applicant_family_mobile_phone` varchar(50) DEFAULT '',
  `applicant_family_mobile_phone2` varchar(50) DEFAULT '',
  `applicant_family_gender` decimal(1,0) DEFAULT 0 COMMENT '1 : Male, 0 : Female',
  `applicant_family_date_of_birth` date DEFAULT NULL,
  `applicant_family_place_of_birth` varchar(50) DEFAULT '',
  `applicant_family_age` decimal(10,0) DEFAULT 0,
  `applicant_family_education` varchar(50) DEFAULT '',
  `applicant_family_occupation` varchar(50) DEFAULT '',
  `applicant_family_sibling` decimal(1,0) DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `applicant_family_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_family_id`),
  KEY `FK_transaction_applicant_family_applicant_id` (`applicant_id`),
  KEY `FK_transaction_applicant_family_family_status_id` (`family_relation_id`),
  KEY `FK_transaction_applicant_family_marital_status_id` (`marital_status_id`),
  CONSTRAINT `FK_recruitment_applicant_family_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_family_family_relation_id` FOREIGN KEY (`family_relation_id`) REFERENCES `core_family_relation` (`family_relation_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_family_marital_status_id` FOREIGN KEY (`marital_status_id`) REFERENCES `core_marital_status` (`marital_status_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_family` */

/*Table structure for table `recruitment_applicant_interview` */

DROP TABLE IF EXISTS `recruitment_applicant_interview`;

CREATE TABLE `recruitment_applicant_interview` (
  `applicant_interview_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_interview_period` decimal(6,0) DEFAULT 0,
  `applicant_interview_location` varchar(50) DEFAULT '',
  `applicant_interview_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(1) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_interview_id`),
  KEY `FK_transaction_applicant_interview_experience_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_interview_experience_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_interview` */

/*Table structure for table `recruitment_applicant_language` */

DROP TABLE IF EXISTS `recruitment_applicant_language`;

CREATE TABLE `recruitment_applicant_language` (
  `applicant_language_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `language_id` int(10) DEFAULT 0,
  `applicant_language_listen` decimal(1,0) DEFAULT 0 COMMENT '0 : Cant, 1 : Less, 2 : Good, 3 : Very Good',
  `applicant_language_read` decimal(1,0) DEFAULT 0 COMMENT '0 : Cant, 1 : Less, 2 : Good, 3 : Very Good',
  `applicant_language_write` decimal(1,0) DEFAULT 0 COMMENT '0 : Cant, 1 : Less, 2 : Good, 3 : Very Good',
  `applicant_language_speak` decimal(1,0) DEFAULT 0 COMMENT '0 : Cant, 1 : Less, 2 : Good, 3 : Very Good',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_language_id`),
  KEY `FK_recruitment_applicant_language_language_id` (`language_id`),
  KEY `FK_recruitment_applicant_language_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_language_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_language_language_id` FOREIGN KEY (`language_id`) REFERENCES `core_language` (`language_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_language` */

/*Table structure for table `recruitment_applicant_law` */

DROP TABLE IF EXISTS `recruitment_applicant_law`;

CREATE TABLE `recruitment_applicant_law` (
  `applicant_law_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_law_period` decimal(6,0) DEFAULT 0,
  `applicant_law_location` varchar(50) DEFAULT '',
  `applicant_law_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_law_id`),
  KEY `FK_transaction_applicant_law_experience_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_law_experience_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_law` */

/*Table structure for table `recruitment_applicant_medical` */

DROP TABLE IF EXISTS `recruitment_applicant_medical`;

CREATE TABLE `recruitment_applicant_medical` (
  `applicant_medical_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `family_relation_id` int(10) DEFAULT 0,
  `applicant_medical_disease` varchar(50) DEFAULT '',
  `applicant_medical_name` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_medical_detail_id`),
  KEY `FK_transaction_applicant_medical_record_applicant_id` (`applicant_id`),
  KEY `FK_transaction_applicant_medical_record_family_status_id` (`family_relation_id`),
  CONSTRAINT `FK_recruitment_applicant_medical_detail_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_applicant_medical_detail_family_relation_id` FOREIGN KEY (`family_relation_id`) REFERENCES `core_family_relation` (`family_relation_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_medical` */

/*Table structure for table `recruitment_applicant_medical_detail` */

DROP TABLE IF EXISTS `recruitment_applicant_medical_detail`;

CREATE TABLE `recruitment_applicant_medical_detail` (
  `applicant_medical_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_weight` decimal(10,0) DEFAULT 0,
  `applicant_height` decimal(10,0) DEFAULT 0,
  `applicant_sick_opname` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_sick_disease` varchar(200) DEFAULT '',
  `applicant_sick_how_long` decimal(10,0) DEFAULT 0,
  `applicant_sick_year` decimal(10,0) DEFAULT 0,
  `applicant_sick_hospital` varchar(200) DEFAULT '',
  `applicant_colour_blind` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_coworker_name1` varchar(50) DEFAULT '',
  `applicant_coworker_section1` varchar(50) DEFAULT '',
  `applicant_coworker_relation1` varchar(50) DEFAULT '',
  `applicant_coworker_name2` varchar(50) DEFAULT '',
  `applicant_coworker_section2` varchar(50) DEFAULT '',
  `applicant_coworker_relation2` varchar(50) DEFAULT '',
  `applicant_emergency_name` varchar(50) DEFAULT '',
  `applicant_emergency_address` text DEFAULT NULL,
  `applicant_emergency_mobile_phone` varchar(30) DEFAULT '',
  `applicant_emergency_home_phone` varchar(30) DEFAULT '',
  `applicant_emergency_relationship` varchar(50) DEFAULT '',
  `applicant_daily_transportation_brand1` varchar(50) DEFAULT '',
  `applicant_daily_transportation_year1` varchar(50) DEFAULT '',
  `applicant_daily_transportation_owner1` varchar(50) DEFAULT '',
  `applicant_daily_transportation_brand2` varchar(50) DEFAULT '',
  `applicant_daily_transportation_year2` varchar(50) DEFAULT '',
  `applicant_daily_transportation_owner2` varchar(50) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_medical_id`),
  KEY `FK_recruitment_applicant_medical_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_medical_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_medical_detail` */

/*Table structure for table `recruitment_applicant_organization` */

DROP TABLE IF EXISTS `recruitment_applicant_organization`;

CREATE TABLE `recruitment_applicant_organization` (
  `applicant_organization_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `organization_name` varchar(50) DEFAULT '',
  `organization_type` decimal(1,0) DEFAULT 0 COMMENT '0 : Politik, 1 : Sosial, 2 : Olah Raga, 3 : Kesenian, 4 : Kerohanian',
  `organization_period` decimal(6,0) DEFAULT 0,
  `organization_title` varchar(50) DEFAULT '',
  `organization_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Active, 0 : Not Active',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_organization_id`),
  KEY `FK_transaction_applicant_organization_experience_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_organization_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_organization` */

/*Table structure for table `recruitment_applicant_other` */

DROP TABLE IF EXISTS `recruitment_applicant_other`;

CREATE TABLE `recruitment_applicant_other` (
  `applicant_other_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_hobby` text DEFAULT NULL,
  `applicant_hobby_active` text DEFAULT NULL,
  `applicant_reading_type` text DEFAULT NULL,
  `applicant_good_book` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_other_id`),
  KEY `FK_recruitment_applicant_other_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_other_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_other` */

/*Table structure for table `recruitment_applicant_personality` */

DROP TABLE IF EXISTS `recruitment_applicant_personality`;

CREATE TABLE `recruitment_applicant_personality` (
  `applicant_personality_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_strength_remark` varchar(250) DEFAULT '',
  `applicant_weakness_remark` varchar(250) DEFAULT '',
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_personality_id`),
  KEY `FK_transaction_applicant_personality_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_personality_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_personality` */

/*Table structure for table `recruitment_applicant_question` */

DROP TABLE IF EXISTS `recruitment_applicant_question`;

CREATE TABLE `recruitment_applicant_question` (
  `applicant_question_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_question_motivation` text DEFAULT NULL,
  `applicant_question_expectation` text DEFAULT NULL,
  `applicant_question_work_group` text DEFAULT NULL,
  `applicant_question_head_character` text DEFAULT NULL,
  `applicant_question_head_appreciate` text DEFAULT NULL,
  `applicant_question_make_mistake` text DEFAULT NULL,
  `applicant_question_responsibility` text DEFAULT NULL,
  `applicant_question_easy_influence` text DEFAULT NULL,
  `applicant_question_inappropriate_condition` text DEFAULT NULL,
  `applicant_question_working_expectation` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_question_id`),
  KEY `FK_recruitment_applicant_question` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_question` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_question` */

/*Table structure for table `recruitment_applicant_subjects` */

DROP TABLE IF EXISTS `recruitment_applicant_subjects`;

CREATE TABLE `recruitment_applicant_subjects` (
  `applicant_subjects_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_subjects_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Like, 0 : Dislike',
  `applicant_subjects_name` varchar(50) DEFAULT '',
  `applicant_subjects_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_subjects_id`),
  KEY `FK_transaction_applicant_subjects_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_subjects_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_subjects` */

/*Table structure for table `recruitment_applicant_working` */

DROP TABLE IF EXISTS `recruitment_applicant_working`;

CREATE TABLE `recruitment_applicant_working` (
  `applicant_working_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `working_company_name` varchar(50) DEFAULT '',
  `working_company_address` text DEFAULT NULL,
  `working_job_title` varchar(50) DEFAULT '',
  `working_from_period` decimal(6,0) DEFAULT 0,
  `working_to_period` decimal(6,0) DEFAULT 0,
  `working_last_salary` decimal(20,2) DEFAULT 0.00,
  `working_separation_reason` text DEFAULT NULL,
  `working_separation_letter` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `working_experience_remark` text DEFAULT NULL,
  `data_state` decimal(10,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_working_id`),
  KEY `FK_transaction_applicant_working_experience_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_working_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_working` */

/*Table structure for table `recruitment_applicant_working_detail` */

DROP TABLE IF EXISTS `recruitment_applicant_working_detail`;

CREATE TABLE `recruitment_applicant_working_detail` (
  `applicant_working_detail_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_id` bigint(22) DEFAULT 0,
  `applicant_most_impressive` varchar(200) DEFAULT '',
  `applicant_most_impressive_reason` text DEFAULT NULL,
  `applicant_has_team_member` decimal(1,0) DEFAULT 0 COMMENT '1 : Yes, 0 : No',
  `applicant_has_team_member_number` decimal(10,0) DEFAULT 0,
  `applicant_how_to_manage_team_member` text DEFAULT NULL,
  `applicant_head_expectation` text DEFAULT NULL,
  `applicant_new_ideas` text DEFAULT NULL,
  `applicant_achievement` text DEFAULT NULL,
  `applicant_achievement_satisfaction` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_working_detail_id`),
  KEY `FK_recruitment_applicant_working_detail_applicant_id` (`applicant_id`),
  CONSTRAINT `FK_recruitment_applicant_working_detail_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `recruitment_applicant_data` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_applicant_working_detail` */

/*Table structure for table `recruitment_employee_request` */

DROP TABLE IF EXISTS `recruitment_employee_request`;

CREATE TABLE `recruitment_employee_request` (
  `employee_request_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_request_date` date DEFAULT NULL,
  `employee_request_due_date` date DEFAULT NULL,
  `employee_request_title` varchar(50) DEFAULT '',
  `employee_request_status` decimal(1,0) DEFAULT 0 COMMENT '0 : Unprocessed, 1 : Processed',
  `employee_request_remark` text DEFAULT NULL,
  `employee_request_status_remark` text DEFAULT NULL,
  `approved` decimal(1,0) DEFAULT 0,
  `approved_id` int(10) DEFAULT 0,
  `approved_on` datetime DEFAULT NULL,
  `approved_remark` text DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_request_id`),
  KEY `FK_recruitment_applicant_request_user_id` (`user_id`),
  KEY `FK_recruitment_applicant_request_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_employee_request` */

/*Table structure for table `recruitment_employee_request_item` */

DROP TABLE IF EXISTS `recruitment_employee_request_item`;

CREATE TABLE `recruitment_employee_request_item` (
  `employee_request_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_request_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `education_id` int(10) DEFAULT 0,
  `expertise_id` int(10) DEFAULT 0,
  `employee_request_item_total` decimal(10,0) DEFAULT 0,
  `employee_request_item_description` varchar(250) DEFAULT '',
  `employee_request_item_remark` text DEFAULT NULL,
  `employee_request_item_status` decimal(1,0) DEFAULT 1 COMMENT '0 : Requested, 1 : Rejected, 2 : Selected, 3 : Recruited',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`employee_request_item_id`),
  KEY `FK_transaction_applicant_request_item_applicant_request_id` (`employee_request_id`),
  KEY `FK_transaction_applicant_request_item_region_id` (`region_id`),
  KEY `FK_transaction_applicant_request_item_branch_id` (`branch_id`),
  KEY `FK_transaction_applicant_request_item_division_id` (`division_id`),
  KEY `FK_transaction_applicant_request_item_department_id` (`department_id`),
  KEY `FK_transaction_applicant_request_item_section_id` (`section_id`),
  KEY `FK_transaction_applicant_request_item_location_id` (`location_id`),
  KEY `FK_transaction_applicant_request_item_job_title_id` (`job_title_id`),
  KEY `FK_recruitment_applicant_request_item_education_id` (`education_id`),
  KEY `FK_recruitment_applicant_request_item_expertise_id` (`expertise_id`),
  CONSTRAINT `FK_recruitment_employee_request_item_applicant_request_id` FOREIGN KEY (`employee_request_id`) REFERENCES `recruitment_employee_request` (`employee_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_education_id` FOREIGN KEY (`education_id`) REFERENCES `core_education` (`education_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_expertise_id` FOREIGN KEY (`expertise_id`) REFERENCES `core_expertise` (`expertise_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_item_section_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `core_job_title` (`job_title_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_recruitment_employee_request_item_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `recruitment_employee_request_item` */

/*Table structure for table `schedule_day_off` */

DROP TABLE IF EXISTS `schedule_day_off`;

CREATE TABLE `schedule_day_off` (
  `day_off_id` int(10) NOT NULL AUTO_INCREMENT,
  `day_off_name` varchar(50) DEFAULT '',
  `day_off_start_date` date DEFAULT NULL,
  `day_off_end_date` date DEFAULT NULL,
  `day_off_remark` text DEFAULT NULL,
  `created_id` int(10) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`day_off_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `schedule_day_off` */

/*Table structure for table `schedule_day_off_item` */

DROP TABLE IF EXISTS `schedule_day_off_item`;

CREATE TABLE `schedule_day_off_item` (
  `day_off_item_id` bigint(18) NOT NULL AUTO_INCREMENT,
  `day_off_id` int(10) DEFAULT 0,
  `day_off_item_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`day_off_item_id`),
  KEY `FK_schedule_day_off_item_day_off_id` (`day_off_id`),
  CONSTRAINT `FK_schedule_day_off_item_day_off_id` FOREIGN KEY (`day_off_id`) REFERENCES `schedule_day_off` (`day_off_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

/*Data for the table `schedule_day_off_item` */

/*Table structure for table `schedule_dayoff_pattern` */

DROP TABLE IF EXISTS `schedule_dayoff_pattern`;

CREATE TABLE `schedule_dayoff_pattern` (
  `dayoff_pattern_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `dayoff_pattern_code` varchar(20) DEFAULT '',
  `dayoff_pattern_name` varchar(50) DEFAULT '',
  `dayoff_pattern_weekly` decimal(10,0) DEFAULT 0,
  `dayoff_pattern_days` decimal(10,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`dayoff_pattern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `schedule_dayoff_pattern` */

/*Table structure for table `schedule_employee_schedule` */

DROP TABLE IF EXISTS `schedule_employee_schedule`;

CREATE TABLE `schedule_employee_schedule` (
  `employee_schedule_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `shift_assignment_id` bigint(22) DEFAULT NULL,
  `shift_pattern_id` bigint(22) DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT NULL,
  `created_id` int(10) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`employee_schedule_id`),
  KEY `FK_schedule_employee_schedule_shift_assignment_id` (`shift_assignment_id`),
  KEY `FK_schedule_employee_schedule_shift_pattern_id` (`shift_pattern_id`),
  CONSTRAINT `FK_schedule_employee_schedule_shift_assignment_id` FOREIGN KEY (`shift_assignment_id`) REFERENCES `schedule_shift_assignment` (`shift_assignment_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_shift_pattern_id` FOREIGN KEY (`shift_pattern_id`) REFERENCES `schedule_shift_pattern` (`shift_pattern_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=784 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_employee_schedule` */

insert  into `schedule_employee_schedule`(`employee_schedule_id`,`shift_assignment_id`,`shift_pattern_id`,`data_state`,`created_id`,`created_on`,`last_update`) values 
(778,775,97,0,14,'2020-06-09 10:07:50','2020-06-09 10:07:50'),
(779,776,97,0,14,'2020-08-31 14:18:55','2020-08-31 14:18:55'),
(781,778,98,0,14,'2020-12-15 14:19:34','2020-12-15 14:19:34'),
(782,779,100,0,14,'2020-12-31 12:10:26','2020-12-31 12:10:26'),
(783,780,100,0,14,'2020-12-31 12:10:34','2020-12-31 12:10:34');

/*Table structure for table `schedule_employee_schedule_item` */

DROP TABLE IF EXISTS `schedule_employee_schedule_item`;

CREATE TABLE `schedule_employee_schedule_item` (
  `employee_schedule_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_schedule_id` bigint(22) DEFAULT 0,
  `shift_assignment_id` bigint(22) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_schedule_item_status_default` decimal(1,0) DEFAULT 9,
  `employee_schedule_item_status` decimal(1,0) DEFAULT 9,
  `employee_schedule_item_date` date DEFAULT NULL,
  `employee_schedule_item_date_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Working Day, 0 : Day Off',
  `employee_schedule_item_in_start_date` datetime DEFAULT NULL,
  `employee_schedule_item_in_end_date` datetime DEFAULT NULL,
  `employee_schedule_item_out_start_date` datetime DEFAULT NULL,
  `employee_schedule_item_out_end_date` datetime DEFAULT NULL,
  `employee_schedule_item_log_status` decimal(1,0) DEFAULT 0,
  `employee_schedule_item_log_in_date` datetime DEFAULT NULL,
  `employee_schedule_item_log_out_date` datetime DEFAULT NULL,
  `employee_schedule_item_downloaded` decimal(1,0) DEFAULT 0,
  `employee_schedule_item_downloaded_on` datetime DEFAULT NULL,
  `employee_schedule_item_meal_coupon_status` decimal(1,0) DEFAULT 0,
  `employee_schedule_item_meal_coupon_date` datetime DEFAULT NULL,
  `employee_schedule_item_photo_in` varchar(200) NOT NULL,
  `employee_schedule_item_photo_out` varchar(200) NOT NULL,
  `employee_schedule_item_location_lat_in` varchar(200) NOT NULL,
  `employee_schedule_item_location_long_in` varchar(200) NOT NULL,
  `employee_schedule_item_location_lat_out` varchar(200) NOT NULL,
  `employee_schedule_item_location_long_out` varchar(200) NOT NULL,
  `employee_schedule_item_address_in` varchar(200) NOT NULL,
  `employee_schedule_item_address_out` varchar(200) NOT NULL,
  `employee_status` decimal(1,0) DEFAULT 1,
  `last_update` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_schedule_item_id`),
  KEY `FK_schedule_employee_schedule_item_employee_schedule_id` (`employee_schedule_id`),
  KEY `FK_schedule_employee_schedule_item_employee_id` (`employee_id`),
  KEY `FK_schedule_employee_schedule_item_employee_shift_id` (`employee_shift_id`),
  KEY `FK_schedule_employee_schedule_item_shift_id` (`shift_id`),
  KEY `employee_schedule_item_date` (`employee_schedule_item_date`),
  KEY `employee_schedule_item_start_date` (`employee_schedule_item_in_start_date`),
  KEY `employee_schedule_item_end_date` (`employee_schedule_item_in_end_date`),
  KEY `FK_schedule_employee_schedule_item_location_id` (`location_id`),
  KEY `FK_schedule_employee_schedule_item_region_id` (`region_id`),
  KEY `FK_schedule_employee_schedule_item_branch_id` (`branch_id`),
  KEY `FK_schedule_employee_schedule_item_division_id` (`division_id`),
  KEY `FK_schedule_employee_schedule_item_department_id` (`department_id`),
  KEY `FK_schedule_employee_schedule_item_sectio_id` (`section_id`),
  KEY `FK_schedule_employee_schedule_item_unit_id` (`unit_id`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  KEY `employee_schedule_item_status` (`employee_schedule_item_status`),
  KEY `employee_status` (`employee_status`),
  CONSTRAINT `FK_schedule_employee_schedule_item_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `core_branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_department_id` FOREIGN KEY (`department_id`) REFERENCES `core_department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_division_id` FOREIGN KEY (`division_id`) REFERENCES `core_division` (`division_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `hro_employee_data` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_employee_schedule_id` FOREIGN KEY (`employee_schedule_id`) REFERENCES `schedule_employee_schedule` (`employee_schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_employee_shift_id` FOREIGN KEY (`employee_shift_id`) REFERENCES `schedule_employee_shift` (`employee_shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_location_id` FOREIGN KEY (`location_id`) REFERENCES `core_location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_region_id` FOREIGN KEY (`region_id`) REFERENCES `core_region` (`region_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_sectio_id` FOREIGN KEY (`section_id`) REFERENCES `core_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `core_shift` (`shift_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_employee_schedule_item_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `core_unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=583707 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_employee_schedule_item` */

insert  into `schedule_employee_schedule_item`(`employee_schedule_item_id`,`employee_schedule_id`,`shift_assignment_id`,`employee_shift_id`,`shift_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`department_id`,`section_id`,`unit_id`,`employee_id`,`employee_rfid_code`,`employee_schedule_item_status_default`,`employee_schedule_item_status`,`employee_schedule_item_date`,`employee_schedule_item_date_status`,`employee_schedule_item_in_start_date`,`employee_schedule_item_in_end_date`,`employee_schedule_item_out_start_date`,`employee_schedule_item_out_end_date`,`employee_schedule_item_log_status`,`employee_schedule_item_log_in_date`,`employee_schedule_item_log_out_date`,`employee_schedule_item_downloaded`,`employee_schedule_item_downloaded_on`,`employee_schedule_item_meal_coupon_status`,`employee_schedule_item_meal_coupon_date`,`employee_schedule_item_photo_in`,`employee_schedule_item_photo_out`,`employee_schedule_item_location_lat_in`,`employee_schedule_item_location_long_in`,`employee_schedule_item_location_lat_out`,`employee_schedule_item_location_long_out`,`employee_schedule_item_address_in`,`employee_schedule_item_address_out`,`employee_status`,`last_update`) values 
(581107,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581108,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581109,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581110,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581111,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581112,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581113,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581114,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-06-08',0,'2020-06-08 07:30:00','2020-06-08 12:00:00','2020-06-08 15:30:00','2020-06-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581115,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:50:01',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581116,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:50:07',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581117,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:50:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581118,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:49:47',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581119,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:50:16',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581120,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:49:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581121,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:50:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581122,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-09',0,'2020-06-09 07:30:00','2020-06-09 12:00:00','2020-06-09 15:30:00','2020-06-09 20:00:00',1,'2020-06-09 11:49:52',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581123,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581124,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',1,'2020-06-10 13:12:32',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581125,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',1,'2020-06-10 10:27:43',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581126,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581127,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',1,'2020-06-10 13:19:37',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581128,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581129,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581130,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-10',0,'2020-06-10 07:30:00','2020-06-10 12:00:00','2020-06-10 15:30:00','2020-06-10 20:00:00',1,'2020-06-10 09:50:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581131,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581132,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581133,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581134,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581135,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581136,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581137,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581138,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-11',0,'2020-06-11 07:30:00','2020-06-11 12:00:00','2020-06-11 15:30:00','2020-06-11 20:00:00',1,'2020-06-11 10:02:07',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581139,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 13:23:23',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581140,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 14:34:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581141,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 13:27:33',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581142,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 13:27:13',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581143,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 14:27:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581144,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 14:35:16',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581145,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',1,'2020-06-12 13:04:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581146,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-06-12',0,'2020-06-12 07:30:00','2020-06-12 12:00:00','2020-06-12 15:30:00','2020-06-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581147,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 09:47:52',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:50'),
(581148,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 10:05:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581149,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581150,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581151,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 14:58:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581152,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 10:03:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581153,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 14:58:27',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581154,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-15',0,'2020-06-15 07:30:00','2020-06-15 12:00:00','2020-06-15 15:30:00','2020-06-15 20:00:00',1,'2020-06-15 09:47:37',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581155,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',1,'2020-06-16 09:09:51',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581156,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',1,'2020-06-16 10:13:42',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581157,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',1,'2020-06-16 10:52:21',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581158,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581159,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',1,'2020-06-16 11:24:40',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581160,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581161,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581162,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-16',0,'2020-06-16 07:30:00','2020-06-16 12:00:00','2020-06-16 15:30:00','2020-06-16 20:00:00',1,'2020-06-16 09:36:35',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581163,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581164,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581165,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581166,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581167,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581168,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581169,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581170,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-17',0,'2020-06-17 07:30:00','2020-06-17 12:00:00','2020-06-17 15:30:00','2020-06-17 20:00:00',1,'2020-06-17 09:47:23',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581171,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581172,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581173,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581174,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581175,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581176,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581177,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581178,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-06-18',0,'2020-06-18 07:30:00','2020-06-18 12:00:00','2020-06-18 15:30:00','2020-06-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581179,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581180,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581181,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581182,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581183,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581184,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581185,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581186,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-06-19',0,'2020-06-19 07:30:00','2020-06-19 12:00:00','2020-06-19 15:30:00','2020-06-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581187,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581188,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581189,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',1,'2020-06-22 10:03:06',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581190,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581191,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',1,'2020-06-22 10:42:33',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581192,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',1,'2020-06-22 10:02:47',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581193,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581194,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-22',0,'2020-06-22 07:30:00','2020-06-22 12:00:00','2020-06-22 15:30:00','2020-06-22 20:00:00',1,'2020-06-22 09:36:41',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581195,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 08:43:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581196,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 10:06:04',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581197,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581198,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581199,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 12:25:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581200,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 09:33:01',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581201,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 09:33:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581202,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-23',0,'2020-06-23 07:30:00','2020-06-23 12:00:00','2020-06-23 15:30:00','2020-06-23 20:00:00',1,'2020-06-23 09:48:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581203,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581204,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',1,'2020-06-24 14:09:18',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581205,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581206,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581207,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',1,'2020-06-24 10:49:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581208,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',1,'2020-06-24 09:19:02',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581209,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581210,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-24',0,'2020-06-24 07:30:00','2020-06-24 12:00:00','2020-06-24 15:30:00','2020-06-24 20:00:00',1,'2020-06-24 09:49:51',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581211,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581212,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',1,'2020-06-25 11:55:06',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581213,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581214,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581215,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',1,'2020-06-25 13:44:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581216,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581217,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581218,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-25',0,'2020-06-25 07:30:00','2020-06-25 12:00:00','2020-06-25 15:30:00','2020-06-25 20:00:00',1,'2020-06-25 09:43:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581219,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581220,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581221,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581222,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581223,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',1,'2020-06-26 11:40:05',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581224,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581225,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581226,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-26',0,'2020-06-26 07:30:00','2020-06-26 12:00:00','2020-06-26 15:30:00','2020-06-26 20:00:00',1,'2020-06-26 09:35:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581227,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581228,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581229,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581230,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581231,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',1,'2020-06-29 11:09:26',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581232,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581233,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581234,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-29',0,'2020-06-29 07:30:00','2020-06-29 12:00:00','2020-06-29 15:30:00','2020-06-29 20:00:00',1,'2020-06-29 09:54:44',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581235,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581236,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',1,'2020-06-30 10:41:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581237,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581238,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581239,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',1,'2020-06-30 10:47:07',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581240,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581241,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581242,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-06-30',0,'2020-06-30 07:30:00','2020-06-30 12:00:00','2020-06-30 15:30:00','2020-06-30 20:00:00',1,'2020-06-30 09:44:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581243,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581244,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',1,'2020-07-01 09:53:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581245,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',1,'2020-07-01 10:27:01',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581246,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581247,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',1,'2020-07-01 11:18:44',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581248,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',1,'2020-07-01 15:21:58',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581249,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581250,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-01',0,'2020-07-01 07:30:00','2020-07-01 12:00:00','2020-07-01 15:30:00','2020-07-01 20:00:00',1,'2020-07-01 09:51:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581251,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581252,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581253,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581254,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581255,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',1,'2020-07-02 11:27:28',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581256,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',1,'2020-07-02 15:25:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581257,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581258,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-02',0,'2020-07-02 07:30:00','2020-07-02 12:00:00','2020-07-02 15:30:00','2020-07-02 20:00:00',1,'2020-07-02 09:40:51',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581259,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581260,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581261,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581262,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581263,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',1,'2020-07-03 10:02:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581264,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581265,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581266,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-03',0,'2020-07-03 07:30:00','2020-07-03 12:00:00','2020-07-03 15:30:00','2020-07-03 20:00:00',1,'2020-07-03 09:53:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581267,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581268,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581269,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581270,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581271,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',1,'2020-07-06 12:59:13',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581272,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',1,'2020-07-06 10:03:18',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581273,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581274,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-06',0,'2020-07-06 07:30:00','2020-07-06 12:00:00','2020-07-06 15:30:00','2020-07-06 20:00:00',1,'2020-07-06 10:01:06',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581275,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581276,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581277,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581278,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581279,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',1,'2020-07-07 10:38:25',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581280,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',1,'2020-07-07 15:49:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581281,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',1,'2020-07-07 11:09:02',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581282,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-07',0,'2020-07-07 07:30:00','2020-07-07 12:00:00','2020-07-07 15:30:00','2020-07-07 20:00:00',1,'2020-07-07 09:44:21',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581283,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581284,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581285,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581286,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581287,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',1,'2020-07-08 12:07:44',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581288,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',1,'2020-07-08 09:51:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581289,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',1,'2020-07-08 11:25:04',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581290,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-08',0,'2020-07-08 07:30:00','2020-07-08 12:00:00','2020-07-08 15:30:00','2020-07-08 20:00:00',1,'2020-07-08 09:32:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581291,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581292,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581293,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581294,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581295,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',1,'2020-07-09 11:41:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581296,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',1,'2020-07-09 09:51:37',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581297,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',1,'2020-07-09 11:05:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581298,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-09',0,'2020-07-09 07:30:00','2020-07-09 12:00:00','2020-07-09 15:30:00','2020-07-09 20:00:00',1,'2020-07-09 09:54:55',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581299,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581300,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581301,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581302,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581303,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581304,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581305,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',1,'2020-07-10 12:00:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581306,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-07-10',0,'2020-07-10 07:30:00','2020-07-10 12:00:00','2020-07-10 15:30:00','2020-07-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581307,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581308,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581309,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581310,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581311,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',1,'2020-07-13 11:11:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581312,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',1,'2020-07-13 15:41:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581313,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581314,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-13',0,'2020-07-13 07:30:00','2020-07-13 12:00:00','2020-07-13 15:30:00','2020-07-13 20:00:00',1,'2020-07-13 09:48:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581315,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581316,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581317,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581318,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581319,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',1,'2020-07-14 11:06:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581320,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581321,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581322,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-14',0,'2020-07-14 07:30:00','2020-07-14 12:00:00','2020-07-14 15:30:00','2020-07-14 20:00:00',1,'2020-07-14 10:02:45',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581323,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581324,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581325,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581326,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581327,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',1,'2020-07-15 11:17:32',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581328,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581329,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',1,'2020-07-15 12:08:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581330,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-15',0,'2020-07-15 07:30:00','2020-07-15 12:00:00','2020-07-15 15:30:00','2020-07-15 20:00:00',1,'2020-07-15 09:56:16',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581331,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581332,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581333,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581334,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581335,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581336,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581337,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581338,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-07-16',0,'2020-07-16 07:30:00','2020-07-16 12:00:00','2020-07-16 15:30:00','2020-07-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581339,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581340,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581341,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581342,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581343,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',1,'2020-07-17 11:37:36',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581344,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',1,'2020-07-17 12:43:19',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581345,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',1,'2020-07-17 12:43:09',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581346,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-17',0,'2020-07-17 07:30:00','2020-07-17 12:00:00','2020-07-17 15:30:00','2020-07-17 20:00:00',1,'2020-07-17 09:39:52',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581347,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581348,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581349,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581350,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581351,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',1,'2020-07-20 10:15:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581352,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',1,'2020-07-20 09:20:47',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581353,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',1,'2020-07-20 11:18:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581354,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-20',0,'2020-07-20 07:30:00','2020-07-20 12:00:00','2020-07-20 15:30:00','2020-07-20 20:00:00',1,'2020-07-20 09:43:01',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581355,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581356,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581357,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',1,'2020-07-21 15:15:21',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581358,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581359,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581360,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',1,'2020-07-21 09:42:27',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581361,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581362,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-07-21',0,'2020-07-21 07:30:00','2020-07-21 12:00:00','2020-07-21 15:30:00','2020-07-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581363,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581364,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581365,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581366,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581367,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',1,'2020-07-22 11:07:28',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581368,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',1,'2020-07-22 09:48:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581369,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581370,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-22',0,'2020-07-22 07:30:00','2020-07-22 12:00:00','2020-07-22 15:30:00','2020-07-22 20:00:00',1,'2020-07-22 09:51:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581371,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581372,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581373,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581374,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581375,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',1,'2020-07-23 12:20:47',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581376,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',1,'2020-07-23 10:19:39',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581377,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',1,'2020-07-23 11:19:21',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581378,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-23',0,'2020-07-23 07:30:00','2020-07-23 12:00:00','2020-07-23 15:30:00','2020-07-23 20:00:00',1,'2020-07-23 09:55:11',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581379,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581380,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',1,'2020-07-24 09:34:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581381,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',1,'2020-07-24 09:19:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581382,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581383,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581384,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',1,'2020-07-24 09:34:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581385,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',1,'2020-07-24 10:32:09',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581386,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-24',0,'2020-07-24 07:30:00','2020-07-24 12:00:00','2020-07-24 15:30:00','2020-07-24 20:00:00',1,'2020-07-24 09:23:45',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581387,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581388,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',1,'2020-07-27 11:48:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581389,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581390,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581391,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',1,'2020-07-27 13:52:09',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581392,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',1,'2020-07-27 09:40:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581393,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581394,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-27',0,'2020-07-27 07:30:00','2020-07-27 12:00:00','2020-07-27 15:30:00','2020-07-27 20:00:00',1,'2020-07-27 09:51:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581395,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581396,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581397,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581398,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581399,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',1,'2020-07-28 11:35:23',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581400,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',1,'2020-07-28 14:51:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581401,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',1,'2020-07-28 12:10:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581402,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-28',0,'2020-07-28 07:30:00','2020-07-28 12:00:00','2020-07-28 15:30:00','2020-07-28 20:00:00',1,'2020-07-28 09:57:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581403,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581404,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581405,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581406,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581407,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581408,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581409,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581410,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-07-29',0,'2020-07-29 07:30:00','2020-07-29 12:00:00','2020-07-29 15:30:00','2020-07-29 20:00:00',1,'2020-07-29 10:03:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581411,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581412,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581413,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581414,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581415,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581416,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581417,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581418,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-07-30',0,'2020-07-30 07:30:00','2020-07-30 12:00:00','2020-07-30 15:30:00','2020-07-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581419,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581420,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581421,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581422,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581423,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581424,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581425,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581426,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-07-31',0,'2020-07-31 07:30:00','2020-07-31 12:00:00','2020-07-31 15:30:00','2020-07-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581427,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581428,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581429,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581430,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581431,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581432,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581433,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581434,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-03',0,'2020-08-03 07:30:00','2020-08-03 12:00:00','2020-08-03 15:30:00','2020-08-03 20:00:00',1,'2020-08-03 09:57:05',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581435,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581436,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581437,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581438,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581439,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581440,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581441,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581442,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-04',0,'2020-08-04 07:30:00','2020-08-04 12:00:00','2020-08-04 15:30:00','2020-08-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581443,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581444,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581445,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581446,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581447,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',1,'2020-08-05 11:56:10',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581448,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',1,'2020-08-05 09:53:48',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581449,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',1,'2020-08-05 13:53:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581450,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-05',0,'2020-08-05 07:30:00','2020-08-05 12:00:00','2020-08-05 15:30:00','2020-08-05 20:00:00',1,'2020-08-05 10:14:37',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581451,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581452,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581453,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',1,'2020-08-06 11:53:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581454,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581455,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',1,'2020-08-06 11:52:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581456,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',1,'2020-08-06 11:52:17',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581457,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581458,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-06',0,'2020-08-06 07:30:00','2020-08-06 12:00:00','2020-08-06 15:30:00','2020-08-06 20:00:00',1,'2020-08-06 10:04:25',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581459,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581460,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581461,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',1,'2020-08-07 15:05:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581462,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581463,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',1,'2020-08-07 10:12:11',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581464,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',1,'2020-08-07 10:06:42',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581465,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',1,'2020-08-07 15:05:34',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581466,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-07',0,'2020-08-07 07:30:00','2020-08-07 12:00:00','2020-08-07 15:30:00','2020-08-07 20:00:00',1,'2020-08-07 09:53:41',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581467,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581468,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581469,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581470,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581471,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',1,'2020-08-10 11:42:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581472,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',1,'2020-08-10 10:18:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581473,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581474,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-10',0,'2020-08-10 07:30:00','2020-08-10 12:00:00','2020-08-10 15:30:00','2020-08-10 20:00:00',1,'2020-08-10 09:59:54',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581475,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581476,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',1,'2020-08-11 10:21:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581477,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581478,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581479,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',1,'2020-08-11 11:16:35',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581480,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',1,'2020-08-11 10:21:04',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581481,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581482,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-11',0,'2020-08-11 07:30:00','2020-08-11 12:00:00','2020-08-11 15:30:00','2020-08-11 20:00:00',1,'2020-08-11 10:55:26',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581483,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581484,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581485,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',1,'2020-08-12 15:20:02',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581486,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581487,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',1,'2020-08-12 11:53:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581488,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',1,'2020-08-12 11:52:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581489,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',1,'2020-08-12 11:52:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581490,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-12',0,'2020-08-12 07:30:00','2020-08-12 12:00:00','2020-08-12 15:30:00','2020-08-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581491,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581492,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',1,'2020-08-13 11:34:34',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581493,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581494,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581495,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',1,'2020-08-13 11:34:10',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581496,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',1,'2020-08-13 09:57:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581497,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',1,'2020-08-13 14:03:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581498,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-13',0,'2020-08-13 07:30:00','2020-08-13 12:00:00','2020-08-13 15:30:00','2020-08-13 20:00:00',1,'2020-08-13 09:46:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581499,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581500,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581501,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581502,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581503,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',1,'2020-08-14 10:05:23',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581504,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',1,'2020-08-14 10:27:09',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581505,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581506,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-14',0,'2020-08-14 07:30:00','2020-08-14 12:00:00','2020-08-14 15:30:00','2020-08-14 20:00:00',1,'2020-08-14 10:04:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581507,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581508,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581509,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581510,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581511,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581512,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581513,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581514,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-17',0,'2020-08-17 07:30:00','2020-08-17 12:00:00','2020-08-17 15:30:00','2020-08-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581515,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581516,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581517,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',1,'2020-08-18 15:14:58',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581518,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581519,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581520,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',1,'2020-08-18 11:10:10',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581521,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',1,'2020-08-18 11:11:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581522,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-18',0,'2020-08-18 07:30:00','2020-08-18 12:00:00','2020-08-18 15:30:00','2020-08-18 20:00:00',1,'2020-08-18 10:13:58',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581523,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581524,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581525,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581526,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581527,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',1,'2020-08-19 14:35:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581528,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',1,'2020-08-19 10:28:44',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581529,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581530,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-19',0,'2020-08-19 07:30:00','2020-08-19 12:00:00','2020-08-19 15:30:00','2020-08-19 20:00:00',1,'2020-08-19 09:18:45',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581531,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581532,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581533,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581534,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581535,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581536,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581537,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581538,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-20',0,'2020-08-20 07:30:00','2020-08-20 12:00:00','2020-08-20 15:30:00','2020-08-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581539,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581540,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581541,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581542,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581543,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581544,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581545,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581546,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-21',0,'2020-08-21 07:30:00','2020-08-21 12:00:00','2020-08-21 15:30:00','2020-08-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581547,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581548,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581549,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',1,'2020-08-24 15:30:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581550,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581551,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581552,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',1,'2020-08-24 09:00:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581553,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581554,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-24',0,'2020-08-24 07:30:00','2020-08-24 12:00:00','2020-08-24 15:30:00','2020-08-24 20:00:00',1,'2020-08-24 10:03:36',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581555,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581556,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581557,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581558,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581559,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',1,'2020-08-25 13:18:11',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581560,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',1,'2020-08-25 11:29:28',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581561,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581562,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-25',0,'2020-08-25 07:30:00','2020-08-25 12:00:00','2020-08-25 15:30:00','2020-08-25 20:00:00',1,'2020-08-25 09:53:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581563,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581564,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581565,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',1,'2020-08-26 15:13:40',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581566,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581567,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',1,'2020-08-26 11:37:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581568,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',1,'2020-08-26 10:00:27',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581569,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581570,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-26',0,'2020-08-26 07:30:00','2020-08-26 12:00:00','2020-08-26 15:30:00','2020-08-26 20:00:00',1,'2020-08-26 09:25:41',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581571,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581572,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581573,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',1,'2020-08-27 15:18:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581574,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581575,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',1,'2020-08-27 11:21:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581576,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',1,'2020-08-27 10:47:35',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581577,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581578,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-08-27',0,'2020-08-27 07:30:00','2020-08-27 12:00:00','2020-08-27 15:30:00','2020-08-27 20:00:00',1,'2020-08-27 09:38:37',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581579,778,775,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581580,778,775,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581581,778,775,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',1,'2020-08-28 15:21:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581582,778,775,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581583,778,775,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',1,'2020-08-28 11:51:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581584,778,775,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',1,'2020-08-28 10:17:43',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581585,778,775,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',1,'2020-08-28 12:39:07',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581586,778,775,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-28',0,'2020-08-28 07:30:00','2020-08-28 12:00:00','2020-08-28 15:30:00','2020-08-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-06-09 10:07:51'),
(581587,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581588,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',1,'2020-08-31 14:22:26',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581589,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581590,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581591,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581592,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581593,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581594,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-08-31',0,'2020-08-31 07:30:00','2020-08-31 12:00:00','2020-08-31 15:30:00','2020-08-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581595,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581596,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581597,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581598,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581599,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',1,'2020-09-01 10:29:58',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581600,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581601,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581602,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-01',0,'2020-09-01 07:30:00','2020-09-01 12:00:00','2020-09-01 15:30:00','2020-09-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581603,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581604,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581605,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581606,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581607,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',1,'2020-09-02 12:11:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581608,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581609,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581610,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-02',0,'2020-09-02 07:30:00','2020-09-02 12:00:00','2020-09-02 15:30:00','2020-09-02 20:00:00',1,'2020-09-02 10:25:17',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581611,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581612,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581613,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581614,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,1,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',1,'2020-09-03 09:52:51',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581615,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',1,'2020-09-03 12:08:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581616,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',1,'2020-09-03 10:07:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581617,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581618,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-03',0,'2020-09-03 07:30:00','2020-09-03 12:00:00','2020-09-03 15:30:00','2020-09-03 20:00:00',1,'2020-09-03 09:52:55',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581619,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 09:51:29',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581620,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 10:43:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581621,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581622,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 09:51:34',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581623,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 10:55:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581624,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 09:53:35',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581625,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581626,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-04',0,'2020-09-04 07:30:00','2020-09-04 12:00:00','2020-09-04 15:30:00','2020-09-04 20:00:00',1,'2020-09-04 09:51:39',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581627,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581628,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',1,'2020-09-07 10:20:04',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581629,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581630,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581631,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',1,'2020-09-07 11:42:10',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581632,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581633,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581634,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-07',0,'2020-09-07 07:30:00','2020-09-07 12:00:00','2020-09-07 15:30:00','2020-09-07 20:00:00',1,'2020-09-07 09:45:12',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581635,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581636,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',1,'2020-09-08 11:34:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581637,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',1,'2020-09-08 09:37:05',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581638,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581639,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581640,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',1,'2020-09-08 10:52:43',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581641,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',1,'2020-09-08 10:52:39',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581642,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-08',0,'2020-09-08 07:30:00','2020-09-08 12:00:00','2020-09-08 15:30:00','2020-09-08 20:00:00',1,'2020-09-08 09:44:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581643,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581644,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',1,'2020-09-09 10:47:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581645,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581646,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581647,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581648,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581649,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581650,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-09',0,'2020-09-09 07:30:00','2020-09-09 12:00:00','2020-09-09 15:30:00','2020-09-09 20:00:00',1,'2020-09-09 09:47:55',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581651,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581652,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',1,'2020-09-10 10:41:51',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581653,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',1,'2020-09-10 09:48:13',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581654,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581655,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',1,'2020-09-10 11:36:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581656,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581657,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581658,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-10',0,'2020-09-10 07:30:00','2020-09-10 12:00:00','2020-09-10 15:30:00','2020-09-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581659,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581660,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',1,'2020-09-11 10:55:14',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581661,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581662,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581663,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',1,'2020-09-11 11:44:54',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581664,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581665,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',1,'2020-09-11 11:27:50',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581666,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-11',0,'2020-09-11 07:30:00','2020-09-11 12:00:00','2020-09-11 15:30:00','2020-09-11 20:00:00',1,'2020-09-11 09:52:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581667,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581668,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',1,'2020-09-14 10:09:29',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581669,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581670,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581671,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',1,'2020-09-14 12:13:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581672,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',1,'2020-09-14 09:08:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581673,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',1,'2020-09-14 10:47:17',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581674,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-14',0,'2020-09-14 07:30:00','2020-09-14 12:00:00','2020-09-14 15:30:00','2020-09-14 20:00:00',1,'2020-09-14 09:49:39',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581675,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581676,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',1,'2020-09-15 11:14:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581677,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581678,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581679,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',1,'2020-09-15 12:22:39',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581680,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',1,'2020-09-15 09:32:17',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581681,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581682,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-15',0,'2020-09-15 07:30:00','2020-09-15 12:00:00','2020-09-15 15:30:00','2020-09-15 20:00:00',1,'2020-09-15 09:49:24',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581683,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581684,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581685,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581686,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581687,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581688,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581689,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581690,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-16',0,'2020-09-16 07:30:00','2020-09-16 12:00:00','2020-09-16 15:30:00','2020-09-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581691,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581692,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581693,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581694,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581695,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581696,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581697,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581698,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-17',0,'2020-09-17 07:30:00','2020-09-17 12:00:00','2020-09-17 15:30:00','2020-09-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581699,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581700,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581701,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581702,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581703,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581704,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581705,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581706,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-18',0,'2020-09-18 07:30:00','2020-09-18 12:00:00','2020-09-18 15:30:00','2020-09-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581707,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581708,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581709,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581710,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581711,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',1,'2020-09-21 12:38:25',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581712,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581713,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581714,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-21',0,'2020-09-21 07:30:00','2020-09-21 12:00:00','2020-09-21 15:30:00','2020-09-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581715,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581716,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581717,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581718,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581719,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581720,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581721,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581722,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-22',0,'2020-09-22 07:30:00','2020-09-22 12:00:00','2020-09-22 15:30:00','2020-09-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581723,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581724,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581725,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581726,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581727,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581728,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581729,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581730,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-23',0,'2020-09-23 07:30:00','2020-09-23 12:00:00','2020-09-23 15:30:00','2020-09-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581731,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581732,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581733,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581734,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581735,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581736,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581737,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581738,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-24',0,'2020-09-24 07:30:00','2020-09-24 12:00:00','2020-09-24 15:30:00','2020-09-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581739,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581740,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581741,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581742,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581743,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581744,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581745,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581746,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-25',0,'2020-09-25 07:30:00','2020-09-25 12:00:00','2020-09-25 15:30:00','2020-09-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581747,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581748,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',1,'2020-09-28 10:18:25',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581749,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581750,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581751,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581752,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581753,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581754,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,1,'2020-09-28',0,'2020-09-28 07:30:00','2020-09-28 12:00:00','2020-09-28 15:30:00','2020-09-28 20:00:00',1,'2020-09-28 09:44:18',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581755,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581756,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581757,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581758,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581759,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581760,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581761,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581762,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-29',0,'2020-09-29 07:30:00','2020-09-29 12:00:00','2020-09-29 15:30:00','2020-09-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581763,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581764,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581765,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581766,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581767,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581768,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581769,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581770,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-09-30',0,'2020-09-30 07:30:00','2020-09-30 12:00:00','2020-09-30 15:30:00','2020-09-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581771,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581772,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581773,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581774,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581775,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581776,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581777,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581778,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-01',0,'2020-10-01 07:30:00','2020-10-01 12:00:00','2020-10-01 15:30:00','2020-10-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581779,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581780,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581781,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581782,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581783,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581784,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581785,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581786,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-02',0,'2020-10-02 07:30:00','2020-10-02 12:00:00','2020-10-02 15:30:00','2020-10-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581787,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581788,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581789,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581790,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581791,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581792,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581793,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581794,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-05',0,'2020-10-05 07:30:00','2020-10-05 12:00:00','2020-10-05 15:30:00','2020-10-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581795,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581796,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',1,'2020-10-06 10:57:42',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581797,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581798,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581799,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581800,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581801,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581802,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-06',0,'2020-10-06 07:30:00','2020-10-06 12:00:00','2020-10-06 15:30:00','2020-10-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581803,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581804,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581805,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581806,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581807,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',1,'2020-10-07 13:21:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581808,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581809,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581810,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-07',0,'2020-10-07 07:30:00','2020-10-07 12:00:00','2020-10-07 15:30:00','2020-10-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581811,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581812,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581813,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581814,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581815,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',1,'2020-10-08 11:36:02',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581816,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581817,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581818,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-08',0,'2020-10-08 07:30:00','2020-10-08 12:00:00','2020-10-08 15:30:00','2020-10-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581819,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581820,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',1,'2020-10-09 10:09:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581821,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581822,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581823,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',1,'2020-10-09 12:04:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581824,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581825,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581826,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-09',0,'2020-10-09 07:30:00','2020-10-09 12:00:00','2020-10-09 15:30:00','2020-10-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581827,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581828,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',1,'2020-10-12 10:57:08',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581829,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581830,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581831,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',1,'2020-10-12 10:28:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581832,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581833,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581834,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-12',0,'2020-10-12 07:30:00','2020-10-12 12:00:00','2020-10-12 15:30:00','2020-10-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581835,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581836,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581837,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581838,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581839,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581840,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581841,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581842,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-13',0,'2020-10-13 07:30:00','2020-10-13 12:00:00','2020-10-13 15:30:00','2020-10-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581843,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581844,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',1,'2020-10-14 10:27:54',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581845,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581846,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581847,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',1,'2020-10-14 10:47:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581848,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581849,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581850,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-14',0,'2020-10-14 07:30:00','2020-10-14 12:00:00','2020-10-14 15:30:00','2020-10-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581851,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581852,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',1,'2020-10-15 10:48:53',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581853,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581854,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581855,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',1,'2020-10-15 10:49:11',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581856,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581857,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581858,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-15',0,'2020-10-15 07:30:00','2020-10-15 12:00:00','2020-10-15 15:30:00','2020-10-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581859,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581860,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',1,'2020-10-16 10:24:58',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581861,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581862,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581863,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581864,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581865,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581866,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-16',0,'2020-10-16 07:30:00','2020-10-16 12:00:00','2020-10-16 15:30:00','2020-10-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581867,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581868,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581869,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581870,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581871,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',1,'2020-10-19 11:15:56',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581872,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581873,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581874,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-19',0,'2020-10-19 07:30:00','2020-10-19 12:00:00','2020-10-19 15:30:00','2020-10-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581875,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581876,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',1,'2020-10-20 11:07:43',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581877,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581878,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581879,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',1,'2020-10-20 10:13:55',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581880,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581881,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581882,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-20',0,'2020-10-20 07:30:00','2020-10-20 12:00:00','2020-10-20 15:30:00','2020-10-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581883,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581884,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581885,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581886,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581887,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',1,'2020-10-21 11:46:09',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581888,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581889,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581890,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-21',0,'2020-10-21 07:30:00','2020-10-21 12:00:00','2020-10-21 15:30:00','2020-10-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581891,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581892,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',1,'2020-10-22 14:59:33',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581893,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581894,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581895,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',1,'2020-10-22 11:25:15',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581896,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581897,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581898,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-22',0,'2020-10-22 07:30:00','2020-10-22 12:00:00','2020-10-22 15:30:00','2020-10-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581899,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581900,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',1,'2020-10-23 11:46:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581901,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581902,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581903,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581904,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581905,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581906,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-23',0,'2020-10-23 07:30:00','2020-10-23 12:00:00','2020-10-23 15:30:00','2020-10-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581907,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581908,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',1,'2020-10-26 10:54:27',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581909,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581910,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581911,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:55'),
(581912,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581913,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581914,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-26',0,'2020-10-26 07:30:00','2020-10-26 12:00:00','2020-10-26 15:30:00','2020-10-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581915,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581916,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',1,'2020-10-27 10:20:34',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581917,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581918,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581919,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',1,'2020-10-27 10:37:10',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581920,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581921,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581922,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-27',0,'2020-10-27 07:30:00','2020-10-27 12:00:00','2020-10-27 15:30:00','2020-10-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581923,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581924,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581925,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581926,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581927,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',1,'2020-10-28 11:17:00',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581928,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581929,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581930,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-28',0,'2020-10-28 07:30:00','2020-10-28 12:00:00','2020-10-28 15:30:00','2020-10-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581931,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581932,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581933,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581934,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581935,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581936,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581937,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581938,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-29',0,'2020-10-29 07:30:00','2020-10-29 12:00:00','2020-10-29 15:30:00','2020-10-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581939,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581940,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581941,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581942,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581943,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',1,'2020-10-30 10:00:46',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581944,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581945,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581946,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-10-30',0,'2020-10-30 07:30:00','2020-10-30 12:00:00','2020-10-30 15:30:00','2020-10-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581947,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581948,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581949,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581950,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581951,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581952,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581953,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581954,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-02',0,'2020-11-02 07:30:00','2020-11-02 12:00:00','2020-11-02 15:30:00','2020-11-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581955,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581956,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',1,'2020-11-03 09:59:20',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581957,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581958,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581959,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',1,'2020-11-03 10:42:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581960,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581961,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581962,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-03',0,'2020-11-03 07:30:00','2020-11-03 12:00:00','2020-11-03 15:30:00','2020-11-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581963,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581964,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581965,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581966,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581967,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581968,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581969,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581970,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-04',0,'2020-11-04 07:30:00','2020-11-04 12:00:00','2020-11-04 15:30:00','2020-11-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581971,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581972,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581973,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581974,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581975,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581976,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581977,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581978,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-05',0,'2020-11-05 07:30:00','2020-11-05 12:00:00','2020-11-05 15:30:00','2020-11-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581979,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581980,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581981,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581982,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581983,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581984,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581985,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581986,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-06',0,'2020-11-06 07:30:00','2020-11-06 12:00:00','2020-11-06 15:30:00','2020-11-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581987,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581988,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',1,'2020-11-09 09:08:57',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581989,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581990,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581991,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',1,'2020-11-09 11:01:28',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581992,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,1,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',1,'2020-11-09 09:14:33',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581993,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',1,'2020-11-09 12:16:52',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581994,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-09',0,'2020-11-09 07:30:00','2020-11-09 12:00:00','2020-11-09 15:30:00','2020-11-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581995,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581996,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581997,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581998,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(581999,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',1,'2020-11-10 09:47:31',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582000,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582001,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582002,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-10',0,'2020-11-10 07:30:00','2020-11-10 12:00:00','2020-11-10 15:30:00','2020-11-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582003,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582004,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582005,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582006,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582007,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',1,'2020-11-11 10:20:38',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582008,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582009,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',1,'2020-11-11 09:31:17',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582010,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-11',0,'2020-11-11 07:30:00','2020-11-11 12:00:00','2020-11-11 15:30:00','2020-11-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582011,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582012,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582013,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582014,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582015,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',1,'2020-11-12 12:41:22',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582016,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582017,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582018,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-12',0,'2020-11-12 07:30:00','2020-11-12 12:00:00','2020-11-12 15:30:00','2020-11-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582019,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582020,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582021,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582022,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582023,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',1,'2020-11-13 10:40:41',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582024,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582025,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',1,'2020-11-13 10:18:49',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582026,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-13',0,'2020-11-13 07:30:00','2020-11-13 12:00:00','2020-11-13 15:30:00','2020-11-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582027,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582028,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582029,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582030,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582031,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',1,'2020-11-16 11:03:30',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582032,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582033,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',1,'2020-11-16 13:28:25',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582034,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-16',0,'2020-11-16 07:30:00','2020-11-16 12:00:00','2020-11-16 15:30:00','2020-11-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582035,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582036,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582037,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582038,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582039,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',1,'2020-11-17 10:53:13',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582040,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582041,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582042,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-17',0,'2020-11-17 07:30:00','2020-11-17 12:00:00','2020-11-17 15:30:00','2020-11-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582043,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582044,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582045,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582046,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582047,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',1,'2020-11-18 10:52:45',NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582048,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582049,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582050,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-18',0,'2020-11-18 07:30:00','2020-11-18 12:00:00','2020-11-18 15:30:00','2020-11-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582051,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582052,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582053,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582054,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582055,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582056,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582057,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582058,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-19',0,'2020-11-19 07:30:00','2020-11-19 12:00:00','2020-11-19 15:30:00','2020-11-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582059,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582060,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582061,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582062,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582063,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582064,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582065,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582066,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-20',0,'2020-11-20 07:30:00','2020-11-20 12:00:00','2020-11-20 15:30:00','2020-11-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582067,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582068,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582069,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582070,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582071,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582072,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582073,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582074,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-23',0,'2020-11-23 07:30:00','2020-11-23 12:00:00','2020-11-23 15:30:00','2020-11-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582075,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582076,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582077,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582078,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582079,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582080,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582081,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582082,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-24',0,'2020-11-24 07:30:00','2020-11-24 12:00:00','2020-11-24 15:30:00','2020-11-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582083,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582084,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582085,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582086,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582087,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582088,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582089,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582090,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-25',0,'2020-11-25 07:30:00','2020-11-25 12:00:00','2020-11-25 15:30:00','2020-11-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582091,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582092,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582093,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582094,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582095,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582096,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582097,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582098,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-26',0,'2020-11-26 07:30:00','2020-11-26 12:00:00','2020-11-26 15:30:00','2020-11-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582099,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582100,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582101,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582102,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582103,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582104,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582105,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582106,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-27',0,'2020-11-27 07:30:00','2020-11-27 12:00:00','2020-11-27 15:30:00','2020-11-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582107,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582108,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582109,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582110,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582111,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582112,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582113,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582114,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-11-30',0,'2020-11-30 07:30:00','2020-11-30 12:00:00','2020-11-30 15:30:00','2020-11-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582115,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582116,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582117,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582118,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582119,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582120,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582121,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582122,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-01',0,'2020-12-01 07:30:00','2020-12-01 12:00:00','2020-12-01 15:30:00','2020-12-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582123,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582124,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582125,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582126,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582127,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582128,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582129,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582130,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-02',0,'2020-12-02 07:30:00','2020-12-02 12:00:00','2020-12-02 15:30:00','2020-12-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582131,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582132,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582133,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582134,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582135,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582136,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582137,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582138,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-03',0,'2020-12-03 07:30:00','2020-12-03 12:00:00','2020-12-03 15:30:00','2020-12-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582139,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582140,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582141,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582142,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582143,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582144,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582145,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582146,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-04',0,'2020-12-04 07:30:00','2020-12-04 12:00:00','2020-12-04 15:30:00','2020-12-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582147,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582148,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582149,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582150,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582151,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582152,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582153,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582154,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-07',0,'2020-12-07 07:30:00','2020-12-07 12:00:00','2020-12-07 15:30:00','2020-12-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582155,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582156,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582157,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582158,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582159,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582160,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582161,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582162,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-08',0,'2020-12-08 07:30:00','2020-12-08 12:00:00','2020-12-08 15:30:00','2020-12-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582163,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582164,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582165,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582166,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582167,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582168,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582169,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582170,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-09',0,'2020-12-09 07:30:00','2020-12-09 12:00:00','2020-12-09 15:30:00','2020-12-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582171,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582172,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582173,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582174,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582175,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582176,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582177,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582178,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-10',0,'2020-12-10 07:30:00','2020-12-10 12:00:00','2020-12-10 15:30:00','2020-12-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582179,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582180,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582181,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582182,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582183,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582184,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582185,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582186,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-11',0,'2020-12-11 07:30:00','2020-12-11 12:00:00','2020-12-11 15:30:00','2020-12-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582187,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582188,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582189,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582190,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582191,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582192,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582193,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582194,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582195,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,1,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',1,'2020-12-15 15:57:26',NULL,0,NULL,0,NULL,'2020121515571165827in.jpg','','-7.5770576','110.8925956','','','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia','',1,'2020-08-31 14:18:56'),
(582196,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,1,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',1,'2020-12-15 15:59:06',NULL,0,NULL,0,NULL,'2020121515591165626in.jpg','','-7.5770927','110.8925869','','','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia','',1,'2020-08-31 14:18:56'),
(582197,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,1,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',1,'2020-12-15 14:57:58',NULL,0,NULL,0,NULL,'2020121514571165719in.jpg','','-7.6132133','110.9676733','','','Temu Ireng, Tegalgede, Kecamatan Karanganyar, Jawa Tengah 57714, Indonesia','',1,'2020-08-31 14:18:56'),
(582198,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582199,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',1,'2020-12-15 15:55:45',NULL,0,NULL,0,NULL,'2020121515551167021in.jpg','','-7.5770815','110.8925566','','','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia','',1,'2020-08-31 14:18:56'),
(582200,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582201,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,2,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',2,'2020-12-15 15:38:13','2020-12-15 15:53:56',0,NULL,0,NULL,'2020121515381167225in.jpg','2020121515531167225out.jpg','-7.5590083','110.7918167','-7.5770028','110.8926236','2b, Kerten, Kecamatan Laweyan, Jawa Tengah 57143, Indonesia','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia',1,'2020-08-31 14:18:56'),
(582202,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582203,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582204,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582205,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582206,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582207,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',1,'2020-12-16 09:43:46',NULL,0,NULL,0,NULL,'2020121609431167021in.jpg','','-7.5668367','110.8003983','','','10, Purwosari, Kecamatan Laweyan, Jawa Tengah 57142, Indonesia','',1,'2020-08-31 14:18:56'),
(582208,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582209,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',1,'2020-12-16 09:40:03',NULL,0,NULL,0,NULL,'2020121609401167225in.jpg','','-7.5770808','110.8925528','','','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia','',1,'2020-08-31 14:18:56'),
(582210,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582211,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582212,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582213,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582214,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582215,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582216,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582217,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582218,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582219,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582220,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582221,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582222,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582223,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582224,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582225,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582226,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582227,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582228,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582229,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582230,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582231,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582232,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582233,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582234,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582235,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582236,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582237,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582238,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582239,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582240,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582241,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,1,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',1,'2020-12-22 11:30:54',NULL,0,NULL,0,NULL,'2020122211301167225in.jpg','','-7.5739436','110.8305186','','','14, Kedung Lumbu, Kecamatan Pasar Kliwon, Jawa Tengah 57133, Indonesia','',1,'2020-08-31 14:18:56'),
(582242,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582243,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582244,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582245,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582246,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582247,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582248,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582249,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582250,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582251,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582252,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582253,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582254,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582255,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582256,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582257,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582258,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582259,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582260,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582261,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582262,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582263,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582264,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582265,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582266,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582267,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582268,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582269,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582270,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582271,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582272,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582273,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582274,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582275,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582276,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582277,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582278,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582279,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582280,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582281,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582282,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582283,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582284,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582285,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582286,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582287,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582288,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582289,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582290,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582291,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582292,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582293,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582294,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582295,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,1,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',1,'2020-12-31 09:58:50',NULL,0,NULL,0,NULL,'2020123109581167021in.jpg','','-7.5770708','110.8925533','','','Km 8,2, Triyagan, Kecamatan Mojolaban, Jawa Tengah 57554, Indonesia','',1,'2020-08-31 14:18:56'),
(582296,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582297,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582298,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582299,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582300,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582301,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582302,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582303,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582304,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582305,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582306,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582307,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582308,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582309,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582310,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582311,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582312,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582313,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582314,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582315,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582316,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582317,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582318,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582319,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582320,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582321,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582322,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582323,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582324,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582325,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582326,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582327,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582328,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582329,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582330,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582331,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582332,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582333,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582334,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582335,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582336,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582337,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582338,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582339,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582340,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582341,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582342,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582343,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582344,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582345,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582346,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582347,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582348,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582349,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582350,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582351,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582352,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582353,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582354,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582355,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582356,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582357,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582358,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582359,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582360,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582361,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582362,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582363,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582364,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582365,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582366,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582367,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582368,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582369,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582370,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582371,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582372,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582373,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582374,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582375,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582376,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582377,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582378,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582379,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582380,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582381,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582382,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582383,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582384,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582385,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582386,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582387,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582388,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582389,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582390,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582391,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582392,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582393,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582394,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582395,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582396,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582397,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582398,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582399,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582400,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582401,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582402,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582403,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582404,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582405,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582406,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582407,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582408,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582409,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582410,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582411,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582412,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582413,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582414,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582415,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582416,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582417,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582418,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582419,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582420,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582421,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582422,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582423,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582424,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582425,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582426,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582427,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582428,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582429,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582430,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582431,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582432,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582433,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582434,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582435,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582436,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582437,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582438,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582439,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582440,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582441,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582442,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582443,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582444,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582445,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582446,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582447,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582448,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582449,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582450,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582451,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582452,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582453,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582454,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582455,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582456,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582457,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582458,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582459,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582460,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582461,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582462,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582463,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582464,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582465,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582466,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582467,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582468,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582469,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582470,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582471,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582472,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582473,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582474,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582475,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582476,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582477,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582478,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582479,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582480,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582481,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582482,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582483,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582484,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582485,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582486,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582487,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582488,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582489,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582490,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582491,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582492,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582493,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582494,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582495,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582496,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582497,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582498,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582499,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582500,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582501,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582502,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582503,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582504,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582505,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582506,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582507,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582508,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582509,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582510,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582511,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582512,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582513,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582514,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582515,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582516,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582517,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582518,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582519,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582520,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582521,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582522,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582523,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582524,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582525,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582526,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582527,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582528,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582529,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582530,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582531,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582532,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582533,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582534,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582535,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582536,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582537,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582538,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582539,779,776,123,1,5,11,20,4,12,46,15,11658,'b173b225',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582540,779,776,123,1,5,11,20,5,11,45,15,11656,'4b6b3c223e',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582541,779,776,123,1,5,11,20,5,11,34,15,11657,'9bce422235',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582542,779,776,123,1,5,11,20,4,12,46,15,11659,'cb443d2290',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582543,779,776,123,1,5,11,20,5,11,34,15,11670,'db484a22fb',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582544,779,776,123,1,5,11,20,5,11,43,15,11671,'b2a412242',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582545,779,776,123,1,5,11,20,5,11,44,15,11672,'cb474a22e4',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(582546,779,776,123,1,5,11,20,5,11,34,15,11673,'2572a2d52',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-08-31 14:18:56'),
(583507,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583508,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-14',0,'2020-12-14 07:30:00','2020-12-14 12:00:00','2020-12-14 15:30:00','2020-12-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583509,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,1,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',1,'2020-12-15 14:56:57',NULL,0,NULL,0,NULL,'2020121514561167722in.jpg','','-7.6132133','110.9676733','','','Temu Ireng, Tegalgede, Kecamatan Karanganyar, Jawa Tengah 57714, Indonesia','',1,'2020-12-15 14:19:34'),
(583510,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-15',0,'2020-12-15 07:30:00','2020-12-15 12:00:00','2020-12-15 15:30:00','2020-12-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583511,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583512,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-16',0,'2020-12-16 07:30:00','2020-12-16 12:00:00','2020-12-16 15:30:00','2020-12-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583513,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583514,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-17',0,'2020-12-17 07:30:00','2020-12-17 12:00:00','2020-12-17 15:30:00','2020-12-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583515,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583516,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-18',0,'2020-12-18 07:30:00','2020-12-18 12:00:00','2020-12-18 15:30:00','2020-12-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583517,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583518,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-21',0,'2020-12-21 07:30:00','2020-12-21 12:00:00','2020-12-21 15:30:00','2020-12-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583519,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583520,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-22',0,'2020-12-22 07:30:00','2020-12-22 12:00:00','2020-12-22 15:30:00','2020-12-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583521,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583522,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-23',0,'2020-12-23 07:30:00','2020-12-23 12:00:00','2020-12-23 15:30:00','2020-12-23 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583523,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583524,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-24',0,'2020-12-24 07:30:00','2020-12-24 12:00:00','2020-12-24 15:30:00','2020-12-24 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583525,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583526,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-25',0,'2020-12-25 07:30:00','2020-12-25 12:00:00','2020-12-25 15:30:00','2020-12-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583527,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583528,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583529,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583530,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583531,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583532,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583533,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583534,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583535,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583536,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:34'),
(583537,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583538,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583539,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583540,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583541,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583542,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583543,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583544,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583545,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583546,781,778,124,1,5,11,20,5,11,34,15,11677,'ab73ba1c7e',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-15 14:19:35'),
(583547,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583548,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583549,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583550,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583551,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583552,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583553,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583554,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583555,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583556,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583557,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583558,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583559,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583560,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583561,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583562,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583563,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583564,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583565,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583566,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583567,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583568,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583569,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583570,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583571,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583572,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583573,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583574,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583575,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583576,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583577,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583578,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583579,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583580,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583581,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583582,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583583,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583584,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583585,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583586,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583587,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583588,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583589,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583590,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583591,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583592,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583593,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583594,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583595,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583596,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583597,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583598,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583599,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583600,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583601,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583602,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583603,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583604,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583605,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583606,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583607,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583608,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583609,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583610,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583611,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583612,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583613,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583614,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583615,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583616,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583617,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-15',0,'2021-02-15 07:30:00','2021-02-15 12:00:00','2021-02-15 15:30:00','2021-02-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583618,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-15',0,'2021-02-15 07:30:00','2021-02-15 12:00:00','2021-02-15 15:30:00','2021-02-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583619,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-16',0,'2021-02-16 07:30:00','2021-02-16 12:00:00','2021-02-16 15:30:00','2021-02-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:26'),
(583620,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-16',0,'2021-02-16 07:30:00','2021-02-16 12:00:00','2021-02-16 15:30:00','2021-02-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583621,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-17',0,'2021-02-17 07:30:00','2021-02-17 12:00:00','2021-02-17 15:30:00','2021-02-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583622,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-17',0,'2021-02-17 07:30:00','2021-02-17 12:00:00','2021-02-17 15:30:00','2021-02-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583623,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-18',0,'2021-02-18 07:30:00','2021-02-18 12:00:00','2021-02-18 15:30:00','2021-02-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583624,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-18',0,'2021-02-18 07:30:00','2021-02-18 12:00:00','2021-02-18 15:30:00','2021-02-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583625,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-19',0,'2021-02-19 07:30:00','2021-02-19 12:00:00','2021-02-19 15:30:00','2021-02-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583626,782,779,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-19',0,'2021-02-19 07:30:00','2021-02-19 12:00:00','2021-02-19 15:30:00','2021-02-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:27'),
(583627,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583628,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-28',0,'2020-12-28 07:30:00','2020-12-28 12:00:00','2020-12-28 15:30:00','2020-12-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583629,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583630,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-29',0,'2020-12-29 07:30:00','2020-12-29 12:00:00','2020-12-29 15:30:00','2020-12-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583631,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583632,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-30',0,'2020-12-30 07:30:00','2020-12-30 12:00:00','2020-12-30 15:30:00','2020-12-30 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583633,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583634,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2020-12-31',0,'2020-12-31 07:30:00','2020-12-31 12:00:00','2020-12-31 15:30:00','2020-12-31 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583635,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583636,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-01',0,'2021-01-01 07:30:00','2021-01-01 12:00:00','2021-01-01 15:30:00','2021-01-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583637,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583638,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-04',0,'2021-01-04 07:30:00','2021-01-04 12:00:00','2021-01-04 15:30:00','2021-01-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583639,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583640,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-05',0,'2021-01-05 07:30:00','2021-01-05 12:00:00','2021-01-05 15:30:00','2021-01-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583641,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583642,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-06',0,'2021-01-06 07:30:00','2021-01-06 12:00:00','2021-01-06 15:30:00','2021-01-06 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583643,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583644,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-07',0,'2021-01-07 07:30:00','2021-01-07 12:00:00','2021-01-07 15:30:00','2021-01-07 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583645,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583646,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-08',0,'2021-01-08 07:30:00','2021-01-08 12:00:00','2021-01-08 15:30:00','2021-01-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583647,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583648,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-11',0,'2021-01-11 07:30:00','2021-01-11 12:00:00','2021-01-11 15:30:00','2021-01-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583649,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583650,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-12',0,'2021-01-12 07:30:00','2021-01-12 12:00:00','2021-01-12 15:30:00','2021-01-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583651,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583652,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-13',0,'2021-01-13 07:30:00','2021-01-13 12:00:00','2021-01-13 15:30:00','2021-01-13 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583653,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583654,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-14',0,'2021-01-14 07:30:00','2021-01-14 12:00:00','2021-01-14 15:30:00','2021-01-14 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583655,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583656,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-15',0,'2021-01-15 07:30:00','2021-01-15 12:00:00','2021-01-15 15:30:00','2021-01-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583657,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583658,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-18',0,'2021-01-18 07:30:00','2021-01-18 12:00:00','2021-01-18 15:30:00','2021-01-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583659,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583660,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-19',0,'2021-01-19 07:30:00','2021-01-19 12:00:00','2021-01-19 15:30:00','2021-01-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583661,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583662,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-20',0,'2021-01-20 07:30:00','2021-01-20 12:00:00','2021-01-20 15:30:00','2021-01-20 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583663,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583664,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-21',0,'2021-01-21 07:30:00','2021-01-21 12:00:00','2021-01-21 15:30:00','2021-01-21 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583665,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583666,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-22',0,'2021-01-22 07:30:00','2021-01-22 12:00:00','2021-01-22 15:30:00','2021-01-22 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583667,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583668,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-25',0,'2021-01-25 07:30:00','2021-01-25 12:00:00','2021-01-25 15:30:00','2021-01-25 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583669,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583670,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-26',0,'2021-01-26 07:30:00','2021-01-26 12:00:00','2021-01-26 15:30:00','2021-01-26 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583671,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583672,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-27',0,'2021-01-27 07:30:00','2021-01-27 12:00:00','2021-01-27 15:30:00','2021-01-27 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583673,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583674,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-28',0,'2021-01-28 07:30:00','2021-01-28 12:00:00','2021-01-28 15:30:00','2021-01-28 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583675,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583676,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-01-29',0,'2021-01-29 07:30:00','2021-01-29 12:00:00','2021-01-29 15:30:00','2021-01-29 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583677,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583678,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-01',0,'2021-02-01 07:30:00','2021-02-01 12:00:00','2021-02-01 15:30:00','2021-02-01 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583679,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583680,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-02',0,'2021-02-02 07:30:00','2021-02-02 12:00:00','2021-02-02 15:30:00','2021-02-02 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583681,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583682,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-03',0,'2021-02-03 07:30:00','2021-02-03 12:00:00','2021-02-03 15:30:00','2021-02-03 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583683,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583684,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-04',0,'2021-02-04 07:30:00','2021-02-04 12:00:00','2021-02-04 15:30:00','2021-02-04 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583685,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583686,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-05',0,'2021-02-05 07:30:00','2021-02-05 12:00:00','2021-02-05 15:30:00','2021-02-05 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583687,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583688,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-08',0,'2021-02-08 07:30:00','2021-02-08 12:00:00','2021-02-08 15:30:00','2021-02-08 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583689,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583690,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-09',0,'2021-02-09 07:30:00','2021-02-09 12:00:00','2021-02-09 15:30:00','2021-02-09 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583691,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583692,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-10',0,'2021-02-10 07:30:00','2021-02-10 12:00:00','2021-02-10 15:30:00','2021-02-10 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583693,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583694,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-11',0,'2021-02-11 07:30:00','2021-02-11 12:00:00','2021-02-11 15:30:00','2021-02-11 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583695,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583696,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-12',0,'2021-02-12 07:30:00','2021-02-12 12:00:00','2021-02-12 15:30:00','2021-02-12 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583697,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-15',0,'2021-02-15 07:30:00','2021-02-15 12:00:00','2021-02-15 15:30:00','2021-02-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583698,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-15',0,'2021-02-15 07:30:00','2021-02-15 12:00:00','2021-02-15 15:30:00','2021-02-15 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583699,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-16',0,'2021-02-16 07:30:00','2021-02-16 12:00:00','2021-02-16 15:30:00','2021-02-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583700,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-16',0,'2021-02-16 07:30:00','2021-02-16 12:00:00','2021-02-16 15:30:00','2021-02-16 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583701,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-17',0,'2021-02-17 07:30:00','2021-02-17 12:00:00','2021-02-17 15:30:00','2021-02-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583702,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-17',0,'2021-02-17 07:30:00','2021-02-17 12:00:00','2021-02-17 15:30:00','2021-02-17 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583703,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-18',0,'2021-02-18 07:30:00','2021-02-18 12:00:00','2021-02-18 15:30:00','2021-02-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583704,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-18',0,'2021-02-18 07:30:00','2021-02-18 12:00:00','2021-02-18 15:30:00','2021-02-18 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583705,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-19',0,'2021-02-19 07:30:00','2021-02-19 12:00:00','2021-02-19 15:30:00','2021-02-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34'),
(583706,783,780,125,1,5,11,20,5,11,34,15,11679,'3bc53a22e6',9,9,'2021-02-19',0,'2021-02-19 07:30:00','2021-02-19 12:00:00','2021-02-19 15:30:00','2021-02-19 20:00:00',0,NULL,NULL,0,NULL,0,NULL,'','','','','','','','',1,'2020-12-31 12:10:34');

/*Table structure for table `schedule_employee_schedule_shift` */

DROP TABLE IF EXISTS `schedule_employee_schedule_shift`;

CREATE TABLE `schedule_employee_schedule_shift` (
  `employee_schedule_shift_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_schedule_id` bigint(22) DEFAULT 0,
  `shift_assignment_id` bigint(22) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_schedule_shift_date` date DEFAULT NULL,
  `employee_schedule_shift_status` decimal(1,0) DEFAULT 0,
  `employee_status` decimal(1,0) DEFAULT 1,
  `last_update` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_schedule_shift_id`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  KEY `employee_schedule_shift_date` (`employee_schedule_shift_date`),
  KEY `FK_schedule_employee_schedule_shift_employee_schedule_id` (`employee_schedule_id`),
  KEY `FK_schedule_employee_schedule_shift_shift_assignment_id` (`shift_assignment_id`),
  KEY `FK_schedule_employee_schedule_shift_employee_shift_id` (`employee_shift_id`),
  KEY `FK_schedule_employee_schedule_shift_shift_id` (`shift_id`),
  KEY `FK_schedule_employee_schedule_shift_region_id` (`region_id`),
  KEY `FK_schedule_employee_schedule_shift_branch_id` (`branch_id`),
  KEY `FK_schedule_employee_schedule_shift_location_id` (`location_id`),
  KEY `FK_schedule_employee_schedule_shift_division_id` (`division_id`),
  KEY `FK_schedule_employee_schedule_shift_department_id` (`department_id`),
  KEY `FK_schedule_employee_schedule_shift_section_id` (`section_id`),
  KEY `FK_schedule_employee_schedule_shift_unit_id` (`unit_id`),
  KEY `FK_schedule_employee_schedule_shift_employee_id` (`employee_id`),
  KEY `employee_status` (`employee_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `schedule_employee_schedule_shift` */

/*Table structure for table `schedule_employee_shift` */

DROP TABLE IF EXISTS `schedule_employee_shift`;

CREATE TABLE `schedule_employee_shift` (
  `employee_shift_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `employee_shift_code` varchar(20) DEFAULT '0',
  `employee_shift_status` decimal(1,0) DEFAULT 0,
  `employee_shift_last_schedule_date` date DEFAULT NULL,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_shift_id`),
  KEY `FK_schedule_employee_shift_region_id` (`region_id`),
  KEY `FK_schedule_employee_shift_branch_id` (`branch_id`),
  KEY `FK_schedule_employee_shift_location_id` (`location_id`),
  KEY `FK_schedule_employee_shift_division_id` (`division_id`),
  KEY `FK_schedule_employee_shift_shift_id` (`employee_shift_code`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_employee_shift` */

insert  into `schedule_employee_shift`(`employee_shift_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`employee_shift_code`,`employee_shift_status`,`employee_shift_last_schedule_date`,`data_state`,`created_id`,`created_on`,`last_update`) values 
(123,5,11,20,5,'SHIFT PAGI',1,'2021-02-12',0,14,'2020-06-04 00:00:00','2020-06-04 13:16:06'),
(124,5,11,20,5,'trial admin',1,'2021-01-08',1,14,'2020-12-15 14:17:26','2020-12-15 14:17:26'),
(125,5,11,20,5,'TRL SHIFT ',1,'2021-02-19',0,14,'2020-12-31 12:09:00','2020-12-31 12:09:00');

/*Table structure for table `schedule_employee_shift_item` */

DROP TABLE IF EXISTS `schedule_employee_shift_item`;

CREATE TABLE `schedule_employee_shift_item` (
  `employee_shift_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_shift_id` bigint(22) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `unit_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_rfid_code` varchar(20) DEFAULT '',
  `employee_status` decimal(1,0) DEFAULT 1,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_shift_item_id`),
  KEY `FK_schedule_employee_shift_item_department_id` (`department_id`),
  KEY `FK_schedule_employee_shift_item_section_id` (`section_id`),
  KEY `FK_schedule_employee_shift_item_employee_id` (`employee_id`),
  KEY `FK_schedule_employee_shift_item_employee_shift_id` (`employee_shift_id`),
  KEY `employee_rfid_code` (`employee_rfid_code`),
  KEY `FK_schedule_employee_shift_item_division_id` (`division_id`),
  KEY `FK_schedule_employee_shift_item_unit_id` (`unit_id`),
  KEY `FK_schedule_employee_shift_item_region_id` (`region_id`),
  KEY `FK_schedule_employee_shift_item_branch_id` (`branch_id`),
  KEY `FK_schedule_employee_shift_item_location_id` (`location_id`),
  KEY `employee_status` (`employee_status`)
) ENGINE=InnoDB AUTO_INCREMENT=25602 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_employee_shift_item` */

insert  into `schedule_employee_shift_item`(`employee_shift_item_id`,`employee_shift_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`department_id`,`section_id`,`unit_id`,`employee_id`,`employee_rfid_code`,`employee_status`,`last_update`) values 
(25590,123,5,11,20,4,12,46,15,11658,'b173b225',1,'2020-06-04 13:16:06'),
(25591,123,5,11,20,5,11,45,15,11656,'4b6b3c223e',1,'2020-06-04 13:16:06'),
(25592,123,5,11,20,5,11,34,15,11657,'9bce422235',1,'2020-06-04 13:16:06'),
(25593,123,5,11,20,4,12,46,15,11659,'cb443d2290',1,'2020-06-04 13:16:07'),
(25594,123,5,11,20,5,11,34,15,11670,'db484a22fb',1,'2020-06-04 13:16:07'),
(25595,123,5,11,20,5,11,43,15,11671,'b2a412242',1,'2020-06-04 13:16:07'),
(25596,123,5,11,20,5,11,44,15,11672,'cb474a22e4',1,'2020-06-04 13:16:07'),
(25597,123,5,11,20,5,11,34,15,11673,'2572a2d52',1,'2020-06-04 13:16:07'),
(25598,124,5,11,20,5,11,34,15,11677,'ab73ba1c7e',1,'2020-06-04 15:37:00'),
(25599,125,5,11,20,5,11,34,15,11679,'3bc53a22e6',1,'2020-06-05 09:22:00'),
(25600,124,5,11,20,5,11,34,15,11677,'ab73ba1c7e',1,'2020-12-15 14:17:26'),
(25601,125,5,11,20,5,11,34,15,11679,'3bc53a22e6',1,'2020-12-31 12:09:00');

/*Table structure for table `schedule_shift_assignment` */

DROP TABLE IF EXISTS `schedule_shift_assignment`;

CREATE TABLE `schedule_shift_assignment` (
  `shift_assignment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_assignment_id`),
  KEY `FK_schedule_shift_assignment_region_id` (`region_id`),
  KEY `FK_schedule_shift_assignment_branch_id` (`branch_id`),
  KEY `FK_schedule_shift_assignment_location_id` (`location_id`),
  KEY `FK_schedule_shift_assignment_division_id` (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=781 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_shift_assignment` */

insert  into `schedule_shift_assignment`(`shift_assignment_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`employee_id`,`data_state`,`created_id`,`created_on`,`last_update`) values 
(775,5,11,20,5,0,0,14,'2020-06-09 10:07:50','2020-06-09 10:07:50'),
(776,5,11,20,5,0,0,14,'2020-08-31 14:18:55','2020-08-31 14:18:55'),
(778,5,11,20,5,0,0,14,'2020-12-15 14:19:34','2020-12-15 14:19:34'),
(779,5,11,20,5,0,0,14,'2020-12-31 12:10:26','2020-12-31 12:10:26'),
(780,5,11,20,5,0,0,14,'2020-12-31 12:10:34','2020-12-31 12:10:34');

/*Table structure for table `schedule_shift_assignment_item` */

DROP TABLE IF EXISTS `schedule_shift_assignment_item`;

CREATE TABLE `schedule_shift_assignment_item` (
  `shift_assignment_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `shift_assignment_id` bigint(22) DEFAULT 0,
  `shift_pattern_id` bigint(22) DEFAULT 0,
  `shift_assignment_start_date` date DEFAULT NULL,
  `shift_assignment_cycle` decimal(10,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_assignment_item_id`),
  KEY `FK_schedule_shift_assignment_item_shift_assignment_id` (`shift_assignment_id`),
  KEY `FK_schedule_shift_assignment_item_shift_pattern_id` (`shift_pattern_id`)
) ENGINE=InnoDB AUTO_INCREMENT=784 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_shift_assignment_item` */

insert  into `schedule_shift_assignment_item`(`shift_assignment_item_id`,`shift_assignment_id`,`shift_pattern_id`,`shift_assignment_start_date`,`shift_assignment_cycle`,`last_update`) values 
(778,775,97,'2020-06-08',12,'2020-06-09 10:07:50'),
(779,776,97,'2020-08-31',24,'2020-08-31 14:18:55'),
(781,778,98,'2020-12-14',4,'2020-12-15 14:19:34'),
(782,779,100,'2020-12-28',8,'2020-12-31 12:10:26'),
(783,780,100,'2020-12-28',8,'2020-12-31 12:10:34');

/*Table structure for table `schedule_shift_pattern` */

DROP TABLE IF EXISTS `schedule_shift_pattern`;

CREATE TABLE `schedule_shift_pattern` (
  `shift_pattern_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `shift_pattern_code` varchar(20) DEFAULT '',
  `shift_pattern_name` varchar(50) DEFAULT '',
  `shift_pattern_weekly` decimal(10,0) DEFAULT NULL,
  `shift_pattern_cycle` decimal(10,0) DEFAULT 0,
  `shift_pattern_day` decimal(1,0) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `created_id` int(10) DEFAULT 0,
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_pattern_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_shift_pattern` */

insert  into `schedule_shift_pattern`(`shift_pattern_id`,`shift_pattern_code`,`shift_pattern_name`,`shift_pattern_weekly`,`shift_pattern_cycle`,`shift_pattern_day`,`data_state`,`created_id`,`created_on`,`last_update`) values 
(97,'SHIFT 1','SHIFT 1',1,5,0,0,14,'2020-06-09 10:06:54','2020-06-09 10:06:54'),
(98,'POLA TRIAL','POLA TRIAL ADMIN',1,5,0,0,14,'2020-12-15 14:18:18','2020-12-15 14:18:18'),
(99,'POLA TRIAL','POLA TRIAL ADMIN',1,5,0,0,14,'2020-12-15 14:18:37','2020-12-15 14:18:37'),
(100,'POLA TRL ','TRL SHIFT',1,5,0,0,14,'2020-12-31 12:09:57','2020-12-31 12:09:57');

/*Table structure for table `schedule_shift_pattern_item` */

DROP TABLE IF EXISTS `schedule_shift_pattern_item`;

CREATE TABLE `schedule_shift_pattern_item` (
  `shift_pattern_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `shift_pattern_id` bigint(22) DEFAULT 0,
  `shift_id` int(10) DEFAULT 0,
  `employee_shift_id` bigint(22) DEFAULT NULL,
  `shift_pattern_item_day` decimal(1,0) DEFAULT 0,
  `shift_next_day` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shift_pattern_item_id`),
  KEY `FK_schedule_shift_pattern_item_shift_pattern_id` (`shift_pattern_id`),
  KEY `FK_schedule_shift_pattern_shift_id` (`shift_id`),
  KEY `FK_schedule_shift_pattern_item_employee_shift_id` (`employee_shift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2015 DEFAULT CHARSET=utf8;

/*Data for the table `schedule_shift_pattern_item` */

insert  into `schedule_shift_pattern_item`(`shift_pattern_item_id`,`shift_pattern_id`,`shift_id`,`employee_shift_id`,`shift_pattern_item_day`,`shift_next_day`,`last_update`) values 
(2012,97,1,123,0,0,'2020-06-09 10:06:54'),
(2013,98,1,124,0,0,'2020-12-15 14:18:18'),
(2014,100,1,125,0,0,'2020-12-31 12:09:57');

/*Table structure for table `sheet1$print_area` */

DROP TABLE IF EXISTS `sheet1$print_area`;

CREATE TABLE `sheet1$print_area` (
  `no_pegawai` varchar(255) DEFAULT NULL,
  `tanggal_masuk` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `no_kpj` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` timestamp(6) NULL DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `no_hp` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sheet1$print_area` */

insert  into `sheet1$print_area`(`no_pegawai`,`tanggal_masuk`,`nik`,`npwp`,`no_kpj`,`nama_lengkap`,`tempat_lahir`,`tanggal_lahir`,`nama_ibu`,`no_hp`) values 
('AB2019090001',NULL,'3372030509720000',NULL,NULL,'DENY NUGROHO WIBOWO','SURAKARTA','1972-09-06 00:00:00.000000','TJHIN LIONG FOENG',82136361818),
('AB2019090003',NULL,'3313110804780000',NULL,NULL,'CUK KURNIAWAN,SE','SURAKARTA','1978-04-08 00:00:00.000000','SRI LUSTARI',82137407070),
('AB2019090004',NULL,'3311081703750000',NULL,NULL,'ANTONIUS IRAWAN EKO S,SE','SURAKARTA','1975-03-17 00:00:00.000000','SRI SARINI',82152624433),
('AB2019090002',NULL,'3372056810820000',NULL,NULL,'WATIK ANGGARSARI','SURAKARTA','1982-10-28 00:00:00.000000','SUWARNI',895328093232);

/*Table structure for table `sheet2$print_area` */

DROP TABLE IF EXISTS `sheet2$print_area`;

CREATE TABLE `sheet2$print_area` (
  `no_pegawai` varchar(255) DEFAULT NULL,
  `tanggal_masuk` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `no_kpj` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` timestamp(6) NULL DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `no_hp` double DEFAULT NULL,
  `bu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sheet2$print_area` */

insert  into `sheet2$print_area`(`no_pegawai`,`tanggal_masuk`,`nik`,`npwp`,`no_kpj`,`nama_lengkap`,`tempat_lahir`,`tanggal_lahir`,`nama_ibu`,`no_hp`,`bu`) values 
('WR201909001',NULL,'3372041206720000',NULL,NULL,'WIDI NUGROHO KUSJUNIADI','SURAKARTA','1972-06-12 00:00:00.000000','LESTARI',85725620579,NULL),
('WR201909002',NULL,'3372045307770000',NULL,NULL,'EMILYA','BANDUNG','1977-07-13 00:00:00.000000','LANA ROSSANA PRAJANATA',82110501111,NULL),
('WR201909003',NULL,'3313116509910000',NULL,NULL,'LIMARAN AJIBIMO','SURAKARTA','1981-09-25 00:00:00.000000','ANIK WARSINI',89674012091,'BU1'),
('WR201909004',NULL,'3313116510900000',NULL,NULL,'FRISKA PRADITASARI','KLATEN','1990-10-25 00:00:00.000000','SRI MULYANI',85642066337,'BU1');

/*Table structure for table `system_change_log` */

DROP TABLE IF EXISTS `system_change_log`;

CREATE TABLE `system_change_log` (
  `change_log_id` int(11) NOT NULL DEFAULT 0,
  `user_log_id` int(11) DEFAULT NULL,
  `kode` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `old_data` mediumtext CHARACTER SET latin1 DEFAULT NULL,
  `new_data` mediumtext CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`change_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system_change_log` */

insert  into `system_change_log`(`change_log_id`,`user_log_id`,`kode`,`old_data`,`new_data`) values 
(1,31,NULL,'N-','N-');

/*Table structure for table `system_log_user` */

DROP TABLE IF EXISTS `system_log_user`;

CREATE TABLE `system_log_user` (
  `user_log_id` bigint(20) NOT NULL,
  `user_id` bigint(22) DEFAULT NULL,
  `username` varchar(35) CHARACTER SET latin1 DEFAULT NULL,
  `id_previllage` int(4) DEFAULT NULL,
  `log_stat` enum('0','1') CHARACTER SET latin1 DEFAULT NULL,
  `class_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `pk` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `remark` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_log_id`),
  KEY `FK_system_log_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system_log_user` */

insert  into `system_log_user`(`user_log_id`,`user_id`,`username`,`id_previllage`,`log_stat`,`class_name`,`pk`,`remark`,`log_time`) values 
(1,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-11-16 06:54:59'),
(2,NULL,'arum',1002,'1','Application.validationprocess.logout','arum','Logout System','2018-11-16 06:59:03'),
(3,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-11-16 07:00:04'),
(4,NULL,'arum',1002,'1','Application.validationprocess.logout','arum','Logout System','2018-11-16 07:01:19'),
(5,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-03 13:59:36'),
(6,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-04 13:45:07'),
(7,NULL,'Administrator',1002,'1','Application.validationprocess.logout','Administrator','Logout System','2018-12-12 15:30:02'),
(8,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-12 15:30:16'),
(9,NULL,'1',0,'1','3122','Application.coreDedu',NULL,'2018-12-12 15:32:12'),
(10,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-12 15:35:29'),
(11,NULL,'1',0,'1','3122','Application.coreDedu',NULL,'2018-12-12 15:35:50'),
(12,NULL,'1',1003,'1','Application.CorePermit.processAddCorePermit','1','Add New Permit','2018-12-12 15:36:47'),
(13,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-19 07:42:24'),
(14,NULL,'arum',1002,'1','Application.validationprocess.logout','arum','Logout System','2018-12-24 10:54:01'),
(15,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2018-12-24 10:54:07'),
(16,NULL,'arum',1002,'1','Application.validationprocess.logout','arum','Logout System','2019-01-03 12:01:34'),
(17,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2019-01-03 12:01:39'),
(18,NULL,'arum',1001,'1','Application.validationprocess.verifikasi','arum','Login System','2019-01-05 09:55:03'),
(19,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-02 14:35:30'),
(20,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-02 14:41:02'),
(21,0,'1002',0,'1','ian99','Logout System',NULL,'2020-06-02 14:50:39'),
(22,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-02 14:50:45'),
(23,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-02 14:53:21'),
(24,0,'1005',0,'1','ian99','Delete ScheduleEmplo',NULL,'2020-06-02 14:56:43'),
(25,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-02 14:57:34'),
(26,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-02 15:03:42'),
(27,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-02 15:58:19'),
(28,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-02 15:59:10'),
(29,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-03 08:23:46'),
(30,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-03 10:36:11'),
(31,0,'1077',0,'1','ian99','Edit scheduleemploye',NULL,'2020-06-03 10:49:43'),
(32,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-03 10:56:50'),
(33,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-03 11:42:40'),
(34,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 11:55:02'),
(35,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 11:56:45'),
(36,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 12:01:05'),
(37,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 12:01:39'),
(38,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 12:01:51'),
(39,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-03 13:00:08'),
(40,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-03 15:57:31'),
(41,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-03 16:01:26'),
(42,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-03 16:15:25'),
(43,0,'1005',0,'1','ian99','Delete ScheduleEmplo',NULL,'2020-06-03 16:16:16'),
(44,0,'1005',0,'1','ian99','Delete ScheduleEmplo',NULL,'2020-06-03 16:16:23'),
(45,0,'1003',0,'1','ian99','Add New coreshift',NULL,'2020-06-03 16:18:58'),
(46,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-04 08:20:45'),
(47,14,'ian99',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-04 08:22:25'),
(48,0,'1077',0,'1','ian99','Add Employee Data',NULL,'2020-06-04 08:37:51'),
(49,0,'1002',0,'1','ian99','Logout System',NULL,'2020-06-04 10:38:28'),
(50,14,'ian99',1001,'1','Application.ValidationProcessCkp.verifikasi','ian99','Login System','2020-06-04 10:38:39'),
(51,0,'1002',0,'1','ian99','Logout System',NULL,'2020-06-04 10:41:20'),
(52,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 10:41:31'),
(53,0,'1002',0,'1','admin','Logout System',NULL,'2020-06-04 11:25:32'),
(54,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 11:25:40'),
(55,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 11:54:42'),
(56,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 11:55:34'),
(57,0,'1003',0,'1','admin','Add New CoreShift',NULL,'2020-06-04 12:55:40'),
(58,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 13:09:38'),
(59,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-04 13:14:06'),
(60,0,'1003',0,'1','admin','Add New coreshift',NULL,'2020-06-04 13:39:01'),
(61,0,'1003',0,'1','admin','Add New coreshift',NULL,'2020-06-04 13:52:49'),
(62,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-04 14:00:28'),
(63,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-04 15:28:56'),
(64,0,'1077',0,'1','admin','Add Employee Data',NULL,'2020-06-04 15:30:21'),
(65,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-04 15:31:15'),
(66,0,'1003',0,'1','admin','Add New CoreShift',NULL,'2020-06-04 15:36:11'),
(67,0,'1003',0,'1','admin','Add New coreshift',NULL,'2020-06-04 15:38:48'),
(68,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-05 08:44:36'),
(69,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-05 09:12:43'),
(70,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-05 09:13:23'),
(71,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-05 09:13:45'),
(72,0,'1077',0,'1','admin','Add Employee Data',NULL,'2020-06-05 09:16:52'),
(73,0,'1003',0,'1','admin','Add New CoreShift',NULL,'2020-06-05 09:19:11'),
(74,0,'1003',0,'1','admin','Add New coreshift',NULL,'2020-06-05 09:23:24'),
(75,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-05 09:25:58'),
(76,0,'1007',0,'1','admin','Edit User Group',NULL,'2020-06-05 10:34:50'),
(77,0,'1007',0,'1','admin','Edit User Group',NULL,'2020-06-05 10:35:28'),
(78,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-05 10:42:44'),
(79,0,'1007',0,'1','admin','Edit User Group',NULL,'2020-06-05 10:45:01'),
(80,0,'1007',0,'1','admin','Edit User Group',NULL,'2020-06-05 10:46:23'),
(81,0,'1002',0,'1','admin','Logout System',NULL,'2020-06-05 11:01:21'),
(82,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-05 11:01:30'),
(83,0,'1007',0,'1','admin','Edit User Group',NULL,'2020-06-05 11:03:14'),
(84,0,'1003',0,'1','admin','Add New coreshift',NULL,'2020-06-05 13:28:09'),
(85,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-05 15:55:23'),
(86,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-05 16:09:28'),
(87,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-06 08:08:36'),
(88,14,'admin',3124,'1','Application.CoreClass.deleteCoreClass',NULL,'Delete Core Class','2020-06-06 08:09:05'),
(89,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-06 08:15:10'),
(90,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-08 08:36:50'),
(91,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-09 09:19:47'),
(92,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-09 12:36:00'),
(93,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-09 13:32:41'),
(94,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-09 13:42:03'),
(95,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-10 08:23:00'),
(96,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-10 11:07:25'),
(97,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-11 08:44:23'),
(98,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-11 09:55:07'),
(99,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-12 13:28:24'),
(100,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-26 14:02:47'),
(101,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-06-30 20:13:15'),
(102,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-17 10:54:01'),
(103,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-20 12:53:35'),
(104,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-20 15:31:01'),
(105,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-20 15:48:56'),
(106,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-23 13:36:33'),
(107,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-24 08:47:41'),
(108,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-24 09:28:57'),
(109,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-07-26 10:47:30'),
(110,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:12:57'),
(111,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:22:05'),
(112,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:26:10'),
(113,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:26:53'),
(114,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:27:10'),
(115,15,'ian999',1001,'1','Application.ValidationProcessCkp.verifikasi','ian999','Login System','2020-08-31 11:28:49'),
(116,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:29:28'),
(117,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:30:52'),
(118,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:32:07'),
(119,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:34:42'),
(120,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:35:25'),
(121,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 11:58:30'),
(122,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 12:06:24'),
(123,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 13:15:30'),
(124,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 13:16:36'),
(125,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 13:17:27'),
(126,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 13:29:56'),
(127,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-08-31 14:03:49'),
(128,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-10-26 13:34:01'),
(129,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-10-26 14:32:53'),
(130,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-10-26 14:34:19'),
(131,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-10-26 14:36:18'),
(132,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 11:26:47'),
(133,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 11:57:23'),
(134,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 11:57:59'),
(135,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 11:58:25'),
(136,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 12:01:16'),
(137,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 12:01:29'),
(138,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 12:07:17'),
(139,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 12:10:18'),
(140,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 12:17:11'),
(141,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 13:28:14'),
(142,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 13:34:13'),
(143,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 13:35:36'),
(144,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:09:26'),
(145,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:13:58'),
(146,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:15:09'),
(147,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:16:32'),
(148,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:20:16'),
(149,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 14:21:04'),
(150,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-15 15:01:41'),
(151,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-16 10:33:12'),
(152,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-17 14:31:56'),
(153,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-29 15:12:19'),
(154,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-29 15:31:50'),
(155,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 08:50:00'),
(156,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 09:45:27'),
(157,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 10:00:11'),
(158,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 12:00:40'),
(159,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 12:06:11'),
(160,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2020-12-31 12:08:10'),
(161,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2021-01-06 09:00:46'),
(162,14,'admin',1001,'1','Application.ValidationProcessCkp.verifikasi','admin','Login System','2021-01-06 09:00:52'),
(163,29,'trial',1001,'1','Application.ValidationProcessCkp.verifikasi','trial','Login System','2021-12-06 14:41:35'),
(164,14,'admin',1001,'1','Application.ValidationProcess.verifikasi','admin','Login System','2021-12-18 09:58:02'),
(165,14,'admin',1001,'1','Application.ValidationProcess.verifikasi','admin','Login System','2021-12-18 11:40:55'),
(166,14,NULL,3122,'1','Application.CoreRegion.processAddCoreRegion',NULL,'Add New Core Region','2021-12-18 12:26:58'),
(167,14,NULL,3122,'1','Application.CoreRegion.processAddCoreRegion',NULL,'Add New Core Region','2021-12-18 12:27:01'),
(168,14,'8',3122,'1','Application.CoreRegion.processEditCoreRegion','8','Edit Core Region','2021-12-18 12:30:28'),
(169,14,'8',3122,'1','Application.CoreRegion.processEditCoreRegion','8','Edit Core Region','2021-12-18 12:30:51'),
(170,14,'8',3122,'1','Application.CoreRegion.deleteCoreRegion','8','Delete Core Region','2021-12-18 12:31:39');

/*Table structure for table `system_menu` */

DROP TABLE IF EXISTS `system_menu`;

CREATE TABLE `system_menu` (
  `id_menu` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `type` enum('folder','file') CHARACTER SET latin1 DEFAULT NULL,
  `text` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system_menu` */

insert  into `system_menu`(`id_menu`,`id`,`type`,`text`,`image`,`last_update`) values 
('',NULL,NULL,NULL,NULL,'2015-01-15 03:57:59'),
('1','MainPage','file','Dashboard','','2020-06-02 15:48:50'),
('2','#','folder','Recruitment',NULL,'2018-11-12 11:54:40'),
('21','RecruitmentApplicantData','file','Recruitment',NULL,'2020-06-02 15:48:42'),
('3','#','folder','Employment',NULL,'2016-03-14 03:10:48'),
('31','#','folder','Preference',NULL,'2016-03-14 03:10:59'),
('311','#','folder','Organization',NULL,'2016-03-14 03:11:09'),
('3111','region','file','Wilayah',NULL,'2021-12-18 11:52:59'),
('3112','CoreBranch','file','Branch',NULL,'2020-06-02 15:38:33'),
('3113','CoreDivision','file','Division',NULL,'2020-06-02 15:38:43'),
('3114','CoreDepartment','file','Department',NULL,'2020-06-02 15:38:49'),
('3115','CoreSection','file','Section',NULL,'2020-06-02 15:38:56'),
('3116','CoreJobTitle','file','Job Title',NULL,'2020-06-02 15:39:05'),
('3117','CoreGrade','file','Grade',NULL,'2020-06-02 15:39:13'),
('3118','CoreClass','file','Class',NULL,'2020-06-02 15:39:18'),
('3119','CoreUnit','file','Unit',NULL,'2020-06-02 15:39:24'),
('313','#','folder','Education & Expertise',NULL,'2016-03-14 03:18:43'),
('3131','CoreLanguage','file','Language',NULL,'2020-06-02 15:39:30'),
('3132','CoreEducation','file','Education',NULL,'2020-06-02 15:39:36'),
('3133','CoreExpertise','file','Expertise',NULL,'2020-06-02 15:39:40'),
('314','#','folder','Award & Warning',NULL,'2017-06-02 09:06:07'),
('3141','CoreAward','file','Award',NULL,'2020-06-02 15:39:46'),
('3142','CoreWarning','file','Warning',NULL,'2020-06-02 15:39:57'),
('315','#','folder','Leave',NULL,'2017-06-02 09:08:35'),
('3151','CoreAnnualLeave','file','Annual Leave',NULL,'2020-06-02 15:40:07'),
('3152','CoreExtraLeave','file','Extra Leave',NULL,'2020-06-02 15:40:16'),
('316','#','folder','Overtime',NULL,'2017-06-02 09:08:14'),
('3161','CoreOvertimeType','file','Overtime Type',NULL,'2020-06-02 15:40:25'),
('3162','CoreOvertimeRounded','file','Overtime Rounded',NULL,'2020-06-02 15:40:34'),
('3163','CoreOvertimeCategory','file','Overtime Category',NULL,'2020-06-02 15:40:46'),
('317','#','folder','Late - Permit',NULL,'2017-06-02 09:09:31'),
('3171','CoreLate','file','Late',NULL,'2020-06-02 15:40:51'),
('3172','CorePermit','file','Permit',NULL,'2020-06-02 15:40:57'),
('3173','CoreDayOff','file','Day Off',NULL,'2020-06-02 15:41:04'),
('3174','CoreAbsence','file','Absence',NULL,'2020-06-02 15:41:11'),
('3175','CoreHomeEarly','file','Home Early',NULL,'2020-06-02 15:41:19'),
('31A','CoreMaritalStatus','file','Marital Status',NULL,'2020-06-02 15:41:28'),
('31C','CoreSeparationReason','file','Separation Reason',NULL,'2020-06-02 15:41:37'),
('32','#','folder','Employee',NULL,'2016-03-14 04:56:41'),
('321','HroEmployeeData','file','Employee Data',NULL,'2020-06-04 08:33:27'),
('322','HroEmployeeEmploymentIlufa','file','Employment',NULL,'2020-06-02 15:42:14'),
('323','HroEmployeeStatusAlteration','file','Employee Status Alteration',NULL,'2020-06-02 15:42:26'),
('324','HroEmployeeTransfer','file','Employee Transfer',NULL,'2020-06-02 15:42:34'),
('4','#','folder','Payroll',NULL,'2016-03-14 04:26:00'),
('41','#','folder','Preference',NULL,'2016-03-16 04:18:56'),
('411','#','folder','Allowances & Deductions',NULL,'2016-03-16 04:18:58'),
('4111','CoreAllowance','file','Allowance',NULL,'2020-06-02 15:42:53'),
('4112','CoreDeduction','file','Deduction',NULL,'2020-06-02 15:49:18'),
('4113','CoreLengthService','file','Length of Service',NULL,'2020-06-02 15:43:10'),
('4114','CorePremiAttendance','file','Premi Attendance',NULL,'2020-06-02 15:43:21'),
('413','CoreLoanType','file','Loan Type',NULL,'2020-06-02 15:43:28'),
('418','CoreBank','file','Bank',NULL,'2020-06-02 15:43:33'),
('43','#','folder','Payroll Data',NULL,'2018-11-08 08:23:54'),
('431','PayrollEmployeeData','file','Payroll Data',NULL,'2020-06-02 15:43:43'),
('432','PayrollPeriodData','file','Payroll Period Data',NULL,'2020-06-02 15:43:58'),
('4F','#','folder','Calculation',NULL,'2017-06-02 08:20:22'),
('4F2','#','folder','Payroll Monthly',NULL,'2017-11-02 09:08:20'),
('4F21','PayrollMonthlyPeriod','file','Payroll Monthly Period',NULL,'2020-06-02 15:44:08'),
('4F22','PayrollEmployeeMonthly','file','Payroll Employee Monthly',NULL,'2020-06-02 15:44:17'),
('5','#','folder','Schedule',NULL,'2016-03-14 06:33:07'),
('51','#','folder','Preference',NULL,'2018-03-15 16:36:14'),
('511','CoreShift','file','Shift',NULL,'2020-06-02 15:44:21'),
('512','ScheduleDayOff','file','Day Off',NULL,'2020-06-02 15:44:31'),
('52','ScheduleEmployeeShift','file','Employee Shift',NULL,'2020-06-02 15:44:38'),
('53','ScheduleShiftPattern','file','Employee Shift Pattern',NULL,'2020-06-02 15:44:46'),
('54','ScheduleShiftAssignment','file','Shift Pattern Assignment',NULL,'2020-06-02 15:44:52'),
('55','ScheduleEmployeeSchedule','file','Employee Schedule',NULL,'2020-06-02 15:45:01'),
('56','ScheduleEmployeeSchedule/lastScheduleEmployeeSchedule','file','Last Employee Schedule ',NULL,'2020-06-02 15:45:16'),
('D','#','folder','Attendance',NULL,'2017-06-08 06:40:20'),
('D2','#','folder','Data Attendance',NULL,'2017-06-08 06:40:27'),
('D21','HroEmployeeMealCoupon','file','Employee Meal Coupon',NULL,'2020-06-02 15:45:28'),
('D22','HroEmployeeAttendance','file','Employee Attendance',NULL,'2020-06-02 15:45:38'),
('D23','HroEmployeeAdministrationCkp','file','Employee Administration',NULL,'2020-06-02 15:45:50'),
('D24','HroemployeeAttendanceDiscrepancy','file','Employee Attendance Discrepancy',NULL,'2020-06-02 15:45:59'),
('D25','HroemployeeAttendanceDownloadLog','file','Employee Attendance Download Log',NULL,'2020-06-02 15:46:11'),
('D3','#','folder','Attendance Report',NULL,'2018-06-28 11:58:20'),
('D31','HroEmployeeAttendanceReport','file','Employee Attendance Report',NULL,'2020-06-02 15:46:21'),
('D32','HroEmployeeAttendanceTotalReport','file','Employee Attendance Total Report',NULL,'2020-06-02 15:46:32'),
('D33','HroEmployeeMealCouponReport','file','Employee Meal Coupon Report',NULL,'2020-06-02 15:46:47'),
('D34','HroEmployeeAttendanceReportAndroid','file','Employee Attendance Report Per Day',NULL,'2020-12-15 11:42:14'),
('E','#','folder','Preference',NULL,'2017-06-08 06:40:01'),
('E1','SystemUserGroup','file','System User Group',NULL,'2020-06-02 15:46:55'),
('E2','SystemUser','file','System User',NULL,'2020-06-02 15:47:01'),
('E3','PreferenceRfid','file','Preference Rfid Mode',NULL,'2020-06-05 10:34:27'),
('E4','PreferenceCompany','file','Preference Perusahaan',NULL,'2020-12-29 15:43:17');

/*Table structure for table `system_menu_mapping` */

DROP TABLE IF EXISTS `system_menu_mapping`;

CREATE TABLE `system_menu_mapping` (
  `user_group_level` int(3) NOT NULL,
  `id_menu` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`user_group_level`,`id_menu`),
  KEY `FK_system_menu_mapping` (`id_menu`),
  CONSTRAINT `FK_system_menu_mapping_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `system_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system_menu_mapping` */

insert  into `system_menu_mapping`(`user_group_level`,`id_menu`) values 
(1,'1'),
(1,'3111'),
(1,'3112'),
(1,'3113'),
(1,'3114'),
(1,'3115'),
(1,'3116'),
(1,'3117'),
(1,'3118'),
(1,'3119'),
(1,'3131'),
(1,'3132'),
(1,'3133'),
(1,'3141'),
(1,'3142'),
(1,'3151'),
(1,'3161'),
(1,'3171'),
(1,'3172'),
(1,'3173'),
(1,'3174'),
(1,'3175'),
(1,'31A'),
(1,'31C'),
(1,'321'),
(1,'322'),
(1,'323'),
(1,'4112'),
(1,'511'),
(1,'512'),
(1,'52'),
(1,'53'),
(1,'54'),
(1,'55'),
(1,'D22'),
(1,'D31'),
(1,'D32'),
(1,'D34'),
(1,'E1'),
(1,'E2'),
(1,'E3'),
(1,'E4'),
(6,'3111'),
(6,'3112'),
(6,'3113'),
(6,'3114'),
(6,'3115'),
(6,'3116'),
(6,'3117'),
(6,'3118'),
(6,'3119'),
(6,'3131'),
(6,'3132'),
(6,'3133'),
(6,'3141'),
(6,'3142'),
(6,'3151'),
(6,'3152'),
(6,'3161'),
(6,'3162'),
(6,'3163'),
(6,'3171'),
(6,'3172'),
(6,'3173'),
(6,'3174'),
(6,'3175'),
(6,'31A'),
(6,'31C'),
(6,'321'),
(6,'322'),
(6,'323'),
(6,'4111'),
(6,'4112'),
(6,'4113'),
(6,'4114'),
(6,'413'),
(6,'418'),
(6,'431'),
(6,'432'),
(6,'4F21'),
(6,'4F22'),
(6,'511'),
(6,'512'),
(6,'52'),
(6,'53'),
(6,'54'),
(6,'55'),
(6,'56'),
(6,'D21'),
(6,'D22'),
(6,'D24'),
(6,'D25'),
(6,'D3'),
(6,'D32'),
(6,'D33'),
(6,'E1'),
(6,'E2'),
(8,'D21'),
(9,'D22');

/*Table structure for table `system_user` */

DROP TABLE IF EXISTS `system_user`;

CREATE TABLE `system_user` (
  `user_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `user_group_id` int(11) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `employee_shift_id` int(10) DEFAULT 0,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `password` varchar(35) CHARACTER SET latin1 DEFAULT '',
  `password_default_char` varchar(75) DEFAULT '',
  `avatar` text CHARACTER SET latin1 DEFAULT NULL,
  `employee_employment_working_status` decimal(1,0) DEFAULT 0 COMMENT '1 : Monthly, 0 : Daily',
  `payroll_employee_level` decimal(1,0) DEFAULT 0,
  `user_status` decimal(1,0) DEFAULT 1 COMMENT '0 : Suspended, 1 : Active',
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`,`username`),
  KEY `FK_system_user` (`user_group_id`),
  KEY `FK_system_user_region_id` (`region_id`),
  KEY `FK_system_user_branch_id` (`branch_id`),
  KEY `FK_system_user_location_id` (`location_id`),
  KEY `FK_system_user_employee_id` (`employee_id`),
  KEY `FK_system_user_department_id` (`department_id`),
  KEY `FK_system_user_division_id` (`division_id`),
  KEY `FK_system_user_section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `system_user` */

insert  into `system_user`(`user_id`,`region_id`,`branch_id`,`location_id`,`division_id`,`department_id`,`section_id`,`user_group_id`,`employee_id`,`employee_shift_id`,`username`,`password`,`password_default_char`,`avatar`,`employee_employment_working_status`,`payroll_employee_level`,`user_status`,`data_state`,`last_update`) values 
(14,5,11,20,4,18,37,1,11677,0,'admin','e10adc3949ba59abbe56e057f20f883e','',NULL,0,0,1,0,'2020-12-31 09:47:20'),
(15,5,11,20,4,18,37,1,10395,0,'ian999','24595ae5d0efcfff2020365dc4032287','',NULL,0,0,1,0,'2018-07-28 11:28:32'),
(16,5,11,21,4,18,37,1,10395,0,'iannew','24595ae5d0efcfff2020365dc4032287','',NULL,0,0,1,0,'2018-07-28 11:28:34'),
(19,5,11,20,5,11,34,4,11657,0,'emilya123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','',0,0,1,0,'2020-12-15 15:10:26'),
(20,5,11,20,5,11,43,4,11671,0,'kurniawan','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','',0,0,1,0,'2020-12-15 15:10:29'),
(21,5,11,20,5,11,34,4,11670,0,'deny','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','',0,0,1,0,'2020-12-15 15:10:31'),
(22,5,11,20,5,11,34,4,11677,0,'budi123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','202012151426572211677ava.jpg',0,0,1,1,'2020-12-15 15:13:52'),
(24,5,11,20,5,11,34,4,11673,0,'watik123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',NULL,0,0,1,0,'2020-12-15 15:10:36'),
(25,5,11,20,5,11,44,4,11672,0,'anton123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','202012161040262511672ava.jpg',0,0,1,0,'2020-12-16 10:40:26'),
(26,5,11,20,5,11,45,4,11656,0,'widi123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',NULL,0,0,1,0,'2020-12-15 15:10:43'),
(27,5,11,20,4,12,46,4,11658,0,'limaran123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',NULL,0,0,1,0,'2020-12-15 15:10:49'),
(28,5,11,20,4,12,46,4,11659,0,'friska123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',NULL,0,0,1,0,'2020-12-15 15:10:21'),
(29,5,11,20,5,11,34,4,11677,0,'trial','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e','094804avaflat-t-rex-dinosaur-background_23-2148156088.jpg',0,0,1,1,'2020-12-31 12:18:33'),
(30,5,11,20,5,11,34,4,11679,0,'salwa123','e10adc3949ba59abbe56e057f20f883e','e10adc3949ba59abbe56e057f20f883e',NULL,0,0,1,0,'2020-12-31 12:06:03');

/*Table structure for table `system_user_group` */

DROP TABLE IF EXISTS `system_user_group`;

CREATE TABLE `system_user_group` (
  `user_group_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_group_code` varchar(20) CHARACTER SET latin1 DEFAULT '',
  `user_group_name` varchar(50) CHARACTER SET latin1 DEFAULT '',
  `user_group_level` int(10) DEFAULT 0,
  `data_state` decimal(1,0) DEFAULT 0,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `system_user_group` */

insert  into `system_user_group`(`user_group_id`,`user_group_code`,`user_group_name`,`user_group_level`,`data_state`,`last_update`) values 
(1,'Administrator','Administrator',1,0,'2020-06-05 10:30:36'),
(2,'','Admin_IGN',2,1,'2020-06-05 10:30:42'),
(3,'','Administrator Yang Maha Kuasa',3,1,'2020-06-05 10:30:43'),
(4,'','karyawan',4,1,'2020-06-05 10:30:44'),
(5,'','SPV',5,1,'2020-06-05 10:30:44'),
(6,'','admin',6,1,'2020-06-05 10:30:45'),
(7,'testing','testing',7,1,'2020-06-05 10:30:46'),
(8,'MEALCOUPON','Meal Coupon',8,1,'2020-06-05 10:30:46'),
(9,'ATTD','Attendance',9,1,'2020-06-05 10:30:50');

/*Table structure for table `system_user_reset_password` */

DROP TABLE IF EXISTS `system_user_reset_password`;

CREATE TABLE `system_user_reset_password` (
  `user_reset_password_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(22) DEFAULT 0,
  `employee_id` bigint(22) DEFAULT 0,
  `reset_password_default_char` varchar(20) DEFAULT '',
  `reset_password_remark` text DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_reset_password_id`),
  KEY `FK_system_user_reset_password_user_id` (`user_id`),
  KEY `FK_system_user_reset_password_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system_user_reset_password` */

/*Table structure for table `transaction_applicant_recruitment` */

DROP TABLE IF EXISTS `transaction_applicant_recruitment`;

CREATE TABLE `transaction_applicant_recruitment` (
  `applicant_recruitment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_selection_id` bigint(22) DEFAULT 0,
  `applicant_recruitment_date` date DEFAULT NULL,
  `applicant_recruitment_due_date` date DEFAULT NULL,
  `applicant_recruitment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_recruitment_id`),
  KEY `FK_transaction_applicant_recruitment_applicant_selection_id` (`applicant_selection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_applicant_recruitment` */

/*Table structure for table `transaction_applicant_recruitment_item` */

DROP TABLE IF EXISTS `transaction_applicant_recruitment_item`;

CREATE TABLE `transaction_applicant_recruitment_item` (
  `applicant_recruitment_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_recruitment_id` bigint(22) DEFAULT 0,
  `applicant_id` int(10) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `applicant_recruitment_date` date DEFAULT NULL,
  `applicant_recruitment_due_date` date DEFAULT NULL,
  `employee_status` enum('0','1') DEFAULT '0' COMMENT '0 : Probation, 1 : Contract',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_recruitment_item_id`),
  KEY `FK_transaction_applicant_recruitment_item_applicant_recruitment` (`applicant_recruitment_id`),
  KEY `FK_transaction_applicant_recruitment_item_applicant_id` (`applicant_id`),
  KEY `FK_transaction_applicant_recruitment_item_region_id` (`region_id`),
  KEY `FK_transaction_applicant_recruitment_item_branch_id` (`branch_id`),
  KEY `FK_transaction_applicant_recruitment_item_division_id` (`division_id`),
  KEY `FK_transaction_applicant_recruitment_item_department_id` (`department_id`),
  KEY `FK_transaction_applicant_recruitment_item_section_id` (`section_id`),
  KEY `FK_transaction_applicant_recruitment_item_location_id` (`location_id`),
  KEY `FK_transaction_applicant_recruitment_item_job_title_id` (`job_title_id`),
  KEY `FK_transaction_applicant_recruitment_item_grade_id` (`grade_id`),
  KEY `FK_transaction_applicant_recruitment_item_class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_applicant_recruitment_item` */

/*Table structure for table `transaction_applicant_selection` */

DROP TABLE IF EXISTS `transaction_applicant_selection`;

CREATE TABLE `transaction_applicant_selection` (
  `applicant_selection_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_request_id` bigint(22) DEFAULT 0,
  `applicant_selection_date` date DEFAULT NULL,
  `applicant_selection_interview_date` date DEFAULT NULL,
  `applicant_selection_status` enum('0','1') DEFAULT '0' COMMENT '0 : Unprocessed, 1 : Processed',
  `applicant_selection_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_selection_id`),
  KEY `FK_transaction_applicant_selection_applicant_request_id` (`applicant_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_applicant_selection` */

/*Table structure for table `transaction_applicant_selection_item` */

DROP TABLE IF EXISTS `transaction_applicant_selection_item`;

CREATE TABLE `transaction_applicant_selection_item` (
  `applicant_selection_item_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `applicant_selection_id` bigint(22) DEFAULT 0,
  `applicant_id` int(10) DEFAULT 0,
  `region_id` int(10) DEFAULT 0,
  `branch_id` int(10) DEFAULT 0,
  `division_id` int(10) DEFAULT 0,
  `department_id` int(10) DEFAULT 0,
  `section_id` int(10) DEFAULT 0,
  `location_id` int(10) DEFAULT 0,
  `job_title_id` int(10) DEFAULT 0,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `applicant_selection_interview_date` date DEFAULT NULL,
  `applicant_selection_status` enum('0','1','2','3') DEFAULT '0' COMMENT '0 : Selected, 1 : Rejected, 2 : Interviewed, 3 : Recruited',
  `applicant_selection_recruited_date` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`applicant_selection_item_id`),
  KEY `FK_transaction_applicant_selection_item_applicant_selection_id` (`applicant_selection_id`),
  KEY `FK_transaction_applicant_selection_item_applicant_id` (`applicant_id`),
  KEY `FK_transaction_applicant_selection_item_region_id` (`region_id`),
  KEY `FK_transaction_applicant_selection_item_branch_id` (`branch_id`),
  KEY `FK_transaction_applicant_selection_item_division_id` (`division_id`),
  KEY `FK_transaction_applicant_selection_item_department_id` (`department_id`),
  KEY `FK_transaction_applicant_selection_item_section_id` (`section_id`),
  KEY `FK_transaction_applicant_selection_item_location_id` (`location_id`),
  KEY `FK_transaction_applicant_selection_item_job_title_id` (`job_title_id`),
  KEY `FK_transaction_applicant_selection_item_grade_id` (`grade_id`),
  KEY `FK_transaction_applicant_selection_item_class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_applicant_selection_item` */

/*Table structure for table `transaction_business_trip` */

DROP TABLE IF EXISTS `transaction_business_trip`;

CREATE TABLE `transaction_business_trip` (
  `business_trip_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_transfer_id` bigint(22) DEFAULT 0,
  `business_trip_date` date DEFAULT NULL,
  `business_trip_start_date` date DEFAULT NULL,
  `business_trip_end_date` date DEFAULT NULL,
  `business_trip_purpose` text DEFAULT NULL,
  `business_trip_target` text DEFAULT NULL,
  `business_trip_total_expense` decimal(20,0) DEFAULT 0,
  `business_trip_approved` enum('0','1','2') DEFAULT '0' COMMENT '0 : Draft, 1 : Approved, 2 : Rejected',
  `business_trip_approved_by` varchar(20) DEFAULT '',
  `business_trip_approved_on` date DEFAULT NULL,
  `business_trip_approved_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_business_trip` */

/*Table structure for table `transaction_business_trip_employee` */

DROP TABLE IF EXISTS `transaction_business_trip_employee`;

CREATE TABLE `transaction_business_trip_employee` (
  `business_trip_employee_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `business_trip_id` bigint(22) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `employee_transfer_id` int(10) DEFAULT 0,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_business_trip_employee` */

/*Table structure for table `transaction_business_trip_expense` */

DROP TABLE IF EXISTS `transaction_business_trip_expense`;

CREATE TABLE `transaction_business_trip_expense` (
  `business_trip_expense_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `expense_business_trip_id` int(10) DEFAULT 0,
  `business_trip_expense_budget_amount` decimal(20,0) DEFAULT 0,
  `data_state` enum('0','1') DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`business_trip_expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_business_trip_expense` */

/*Table structure for table `transaction_contract_extending` */

DROP TABLE IF EXISTS `transaction_contract_extending`;

CREATE TABLE `transaction_contract_extending` (
  `contract_extending_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('1','0') DEFAULT '1',
  `employee_id` int(10) DEFAULT 0,
  `contract_extending_date` date DEFAULT NULL,
  `contract_extending_due_date` date DEFAULT NULL,
  `contract_extending_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`contract_extending_id`),
  KEY `FK_transaction_contract_extending_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_contract_extending` */

/*Table structure for table `transaction_employee_appraisal` */

DROP TABLE IF EXISTS `transaction_employee_appraisal`;

CREATE TABLE `transaction_employee_appraisal` (
  `employee_appraisal_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_appraisal_value` varchar(20) DEFAULT '',
  `employee_appraisal_date` date DEFAULT NULL,
  `employee_appraisal_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_appraisal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_employee_appraisal` */

/*Table structure for table `transaction_employee_separation` */

DROP TABLE IF EXISTS `transaction_employee_separation`;

CREATE TABLE `transaction_employee_separation` (
  `employee_separation_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1') DEFAULT '1',
  `employee_id` int(10) DEFAULT 0,
  `separation_id` int(10) DEFAULT 0,
  `separation_type_id` int(10) DEFAULT 0,
  `separation_status_id` int(10) DEFAULT 0,
  `employee_separation_enrollment_date` date DEFAULT NULL,
  `employee_separation_rehire_status` enum('0','1') DEFAULT '0',
  `employee_separation_status` enum('0','1') DEFAULT '0',
  `employee_separation_status_date` date DEFAULT NULL,
  `employee_working_period` decimal(10,2) DEFAULT 0.00,
  `separation_ratio` decimal(5,2) DEFAULT 0.00,
  `employee_separation_severance_amount` decimal(20,2) DEFAULT 0.00,
  `employee_separation_loan_amount` decimal(20,2) DEFAULT 0.00,
  `employee_separation_payment_amount` decimal(20,2) DEFAULT 0.00,
  `employee_asset_status` enum('1','0') DEFAULT '1' COMMENT '1 : Yes, 0 : No',
  `employee_asset_return_status` enum('0','1') DEFAULT '0' COMMENT '1 : Returned, 0 : Not Returned Yet',
  `employee_asset_return_date` date DEFAULT NULL,
  `employee_separation_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_separation_id`),
  KEY `FK_transaction_employee_separation_employee_id` (`employee_id`),
  KEY `FK_transaction_employee_separation_separation_status_id` (`separation_status_id`),
  KEY `FK_transaction_employee_separation_separation_type_id` (`separation_type_id`),
  KEY `FK_transaction_employee_separation_separation_id` (`separation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_employee_separation` */

/*Table structure for table `transaction_family_medical_claim` */

DROP TABLE IF EXISTS `transaction_family_medical_claim`;

CREATE TABLE `transaction_family_medical_claim` (
  `family_medical_claim_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1') DEFAULT '1',
  `employee_id` int(10) DEFAULT 0,
  `family_status_id` int(10) DEFAULT 0,
  `medical_coverage_id` int(10) DEFAULT 0,
  `family_medical_claim_date` date DEFAULT NULL,
  `medical_claim_opening_balance` decimal(20,2) DEFAULT 0.00,
  `medical_claim_amount` decimal(20,2) DEFAULT 0.00,
  `medical_claim_percentage` decimal(5,2) DEFAULT 0.00,
  `medical_claim_amount_total` decimal(20,2) DEFAULT 0.00,
  `medical_claim_last_balance` decimal(20,2) DEFAULT 0.00,
  `medical_claim_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`family_medical_claim_id`),
  KEY `FK_transaction_family_medical_claim_employee_id` (`employee_id`),
  KEY `FK_transaction_family_medical_claim_medical_coverage_id` (`medical_coverage_id`),
  KEY `FK_transaction_family_medical_claim_family_status_id` (`family_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_family_medical_claim` */

/*Table structure for table `transaction_glasses_adjustment` */

DROP TABLE IF EXISTS `transaction_glasses_adjustment`;

CREATE TABLE `transaction_glasses_adjustment` (
  `glasses_adjustment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_glasses_coverage_id` bigint(22) NOT NULL,
  `glasses_adjustment_date` date DEFAULT NULL,
  `glasses_adjustment_amount` decimal(20,2) DEFAULT 0.00,
  `glasses_adjustment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`glasses_adjustment_id`),
  KEY `FK_transaction_glasses_adjustment_employee_id` (`employee_id`),
  KEY `employee_glasses_coverage_id` (`employee_glasses_coverage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_glasses_adjustment` */

/*Table structure for table `transaction_hospital_adjustment` */

DROP TABLE IF EXISTS `transaction_hospital_adjustment`;

CREATE TABLE `transaction_hospital_adjustment` (
  `hospital_adjustment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_hospital_coverage_id` bigint(22) NOT NULL,
  `hospital_adjustment_date` date DEFAULT NULL,
  `hospital_adjustment_amount` decimal(20,2) DEFAULT 0.00,
  `hospital_adjustment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`hospital_adjustment_id`),
  KEY `FK_transaction_hospital_adjustment_employee_id` (`employee_id`),
  KEY `employee_hospital_coverage_id` (`employee_hospital_coverage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_hospital_adjustment` */

/*Table structure for table `transaction_leave_adjustment` */

DROP TABLE IF EXISTS `transaction_leave_adjustment`;

CREATE TABLE `transaction_leave_adjustment` (
  `leave_adjustment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `leave_adjustment_date` date DEFAULT NULL,
  `leave_adjustment_annual_days` decimal(10,0) DEFAULT 0,
  `leave_adjustment_extra_days` decimal(10,0) DEFAULT 0,
  `leave_adjustment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_adjustment_id`),
  KEY `FK_transaction_adjustment_leave_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_leave_adjustment` */

/*Table structure for table `transaction_leave_blank_long` */

DROP TABLE IF EXISTS `transaction_leave_blank_long`;

CREATE TABLE `transaction_leave_blank_long` (
  `leave_blank_long_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `leave_emerge_long_id` bigint(22) DEFAULT 0,
  `leave_blank_long_date` date DEFAULT NULL,
  `leave_blank_long_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '1',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_blank_long_id`),
  KEY `FK_transaction_blank_long_leave_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_leave_blank_long` */

/*Table structure for table `transaction_leave_emerge_long` */

DROP TABLE IF EXISTS `transaction_leave_emerge_long`;

CREATE TABLE `transaction_leave_emerge_long` (
  `leave_emerge_long_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `leave_emerge_long_date` decimal(10,0) DEFAULT NULL,
  `leave_emerge_long_start_date` date DEFAULT NULL,
  `leave_emerge_long_end_date` date DEFAULT NULL,
  `leave_emerge_long_remark` text DEFAULT NULL,
  `leave_emerge_long_status` enum('0','1') DEFAULT '0',
  `data_state` enum('0','1') DEFAULT '1' COMMENT '1 : Active, 0 : Not Active',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_emerge_long_id`),
  KEY `FK_transaction_emerge_long_leave_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_leave_emerge_long` */

/*Table structure for table `transaction_leave_paid_long` */

DROP TABLE IF EXISTS `transaction_leave_paid_long`;

CREATE TABLE `transaction_leave_paid_long` (
  `leave_paid_long_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `annual_leave_balance` decimal(10,2) DEFAULT 0.00,
  `leave_paid_long_total` decimal(10,2) DEFAULT 0.00,
  `leave_paid_long_date` date DEFAULT NULL,
  `leave_paid_long_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_paid_long_id`),
  KEY `FK_transaction_paid_long_leave_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_leave_paid_long` */

/*Table structure for table `transaction_leave_unpaid` */

DROP TABLE IF EXISTS `transaction_leave_unpaid`;

CREATE TABLE `transaction_leave_unpaid` (
  `leave_unpaid_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `annual_leave_id` int(10) DEFAULT 0,
  `leave_unpaid_start_date` date DEFAULT NULL,
  `leave_unpaid_end_date` date DEFAULT NULL,
  `leave_unpaid_reason` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`leave_unpaid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_leave_unpaid` */

/*Table structure for table `transaction_medical_adjustment` */

DROP TABLE IF EXISTS `transaction_medical_adjustment`;

CREATE TABLE `transaction_medical_adjustment` (
  `medical_adjustment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `employee_medical_coverage_id` bigint(22) NOT NULL,
  `medical_adjustment_date` date DEFAULT NULL,
  `medical_adjustment_amount` decimal(20,2) DEFAULT 0.00,
  `medical_adjustment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`medical_adjustment_id`),
  KEY `FK_transaction_medical_adjustment_employee_id` (`employee_id`),
  KEY `employee_medical_coverage_id` (`employee_medical_coverage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_medical_adjustment` */

/*Table structure for table `transaction_salary_increment` */

DROP TABLE IF EXISTS `transaction_salary_increment`;

CREATE TABLE `transaction_salary_increment` (
  `salary_increment_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('1','0') DEFAULT '1',
  `employee_id` int(10) DEFAULT 0,
  `salary_increment_date` date DEFAULT NULL,
  `grade_id` int(10) DEFAULT 0,
  `class_id` int(10) DEFAULT 0,
  `salary_increment_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`salary_increment_id`),
  KEY `FK_transaction_salary_increment_employee_id` (`employee_id`),
  KEY `FK_transaction_salary_increment_grade_id` (`grade_id`),
  KEY `FK_transaction_salary_increment_class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_salary_increment` */

/*Table structure for table `transaction_schedule_shift` */

DROP TABLE IF EXISTS `transaction_schedule_shift`;

CREATE TABLE `transaction_schedule_shift` (
  `schedule_shift_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1') NOT NULL,
  `employee_id` int(10) DEFAULT 0,
  `schedule_shift_start_date` date DEFAULT NULL,
  `schedule_shift_end_date` date DEFAULT NULL,
  `shift_id` int(10) DEFAULT 0,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`schedule_shift_id`),
  KEY `FK_transaction_schedule_shift` (`employee_id`),
  KEY `FK_transaction_schedule_shift_shift_id` (`shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_schedule_shift` */

/*Table structure for table `transaction_status_alteration` */

DROP TABLE IF EXISTS `transaction_status_alteration`;

CREATE TABLE `transaction_status_alteration` (
  `status_alteration_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) DEFAULT 0,
  `status_alteration_date` date DEFAULT NULL,
  `employee_status_id` int(10) DEFAULT 0,
  `status_alteration_due_date` date DEFAULT NULL,
  `status_alteration_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`status_alteration_id`),
  KEY `FK_transaction_status_alteration_employee_id` (`employee_id`),
  KEY `FK_transaction_status_alteration_employee_status` (`employee_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_status_alteration` */

/*Table structure for table `transaction_training_realization` */

DROP TABLE IF EXISTS `transaction_training_realization`;

CREATE TABLE `transaction_training_realization` (
  `realization_training_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `status` enum('1','0') DEFAULT '1',
  `training_selection_id` bigint(22) DEFAULT 0,
  `realization_training_date` date DEFAULT NULL,
  `realization_training_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`realization_training_id`),
  KEY `FK_transaction_training_realization_training_selection_id` (`training_selection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_training_realization` */

/*Table structure for table `transaction_training_registration` */

DROP TABLE IF EXISTS `transaction_training_registration`;

CREATE TABLE `transaction_training_registration` (
  `training_registration_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `training_schedule_id` bigint(22) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `training_registration_selected` enum('0','1') DEFAULT '0',
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_registration_id`),
  KEY `FK_transaction_training_registration_employee_id` (`employee_id`),
  KEY `FK_transaction_training_registration_training_schedule_id` (`training_schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_training_registration` */

/*Table structure for table `transaction_training_schedule` */

DROP TABLE IF EXISTS `transaction_training_schedule`;

CREATE TABLE `transaction_training_schedule` (
  `training_schedule_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `training_job_title_id` int(10) DEFAULT 0,
  `training_title_id` int(10) DEFAULT 0,
  `training_provider_id` int(10) DEFAULT 0,
  `training_provider_item_id` int(10) DEFAULT 0,
  `training_schedule_start_date` date DEFAULT NULL,
  `training_schedule_end_date` date DEFAULT NULL,
  `training_schedule_name` varchar(50) DEFAULT '',
  `training_schedule_capacity` decimal(10,0) DEFAULT 0,
  `training_schedule_duration` decimal(10,0) DEFAULT 0,
  `training_schedule_location` varchar(50) DEFAULT '',
  `training_schedule_remark` text DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_schedule_id`),
  KEY `FK_transaction_training_schedule_training_job_title_id` (`training_job_title_id`),
  KEY `FK_transaction_training_schedule_training_provider_id` (`training_provider_id`),
  KEY `FK_transaction_training_schedule_training_title_id` (`training_title_id`),
  KEY `FK_transaction_training_schedule_training_provider_item_id` (`training_provider_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_training_schedule` */

/*Table structure for table `transaction_training_selection` */

DROP TABLE IF EXISTS `transaction_training_selection`;

CREATE TABLE `transaction_training_selection` (
  `training_selection_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `training_schedule_id` bigint(22) DEFAULT 0,
  `training_selection_period` decimal(6,0) DEFAULT 0,
  `employee_id` int(10) DEFAULT 0,
  `training_selection_date` date DEFAULT NULL,
  `data_state` enum('0','1') DEFAULT '0',
  `created_by` varchar(20) DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`training_selection_id`),
  KEY `FK_transaction_training_selection_training_schedule_id` (`training_schedule_id`),
  KEY `FK_transaction_training_selection_employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transaction_training_selection` */

/* Function  structure for function  `getNewChangeLogID` */

/*!50003 DROP FUNCTION IF EXISTS `getNewChangeLogID` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `getNewChangeLogID`() RETURNS int(11)
BEGIN
	DECLARE prev_id INT;
	DECLARE next_id INT;
	SELECT change_log_id INTO prev_id FROM system_change_log ORDER BY change_log_id DESC LIMIT 0,1;
	IF prev_id IS NULL THEN
		SET prev_id = 0;
	END IF;
	SET next_id = prev_id + 1;
	RETURN next_id;
END */$$
DELIMITER ;

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

/*Table structure for table `view_employee_last_day_off` */

DROP TABLE IF EXISTS `view_employee_last_day_off`;

/*!50001 DROP VIEW IF EXISTS `view_employee_last_day_off` */;
/*!50001 DROP TABLE IF EXISTS `view_employee_last_day_off` */;

/*!50001 CREATE TABLE  `view_employee_last_day_off`(
 `employee_id` bigint(22) ,
 `employee_schedule_item_date` date 
)*/;

/*View structure for view view_employee_last_day_off */

/*!50001 DROP TABLE IF EXISTS `view_employee_last_day_off` */;
/*!50001 DROP VIEW IF EXISTS `view_employee_last_day_off` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_employee_last_day_off` AS (select `schedule_employee_schedule_item`.`employee_id` AS `employee_id`,max(`schedule_employee_schedule_item`.`employee_schedule_item_date`) AS `employee_schedule_item_date` from `schedule_employee_schedule_item` where `schedule_employee_schedule_item`.`employee_schedule_item_date` < '2018-05-14' and `schedule_employee_schedule_item`.`employee_schedule_item_status` = 0 group by `schedule_employee_schedule_item`.`employee_id`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
