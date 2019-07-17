-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema uomedu_exam_portal
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ uomedu_exam_portal;
USE uomedu_exam_portal;

--
-- Structure for table `uomedu_exam_portal`.`bpaper_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`bpaper_tb`;
CREATE TABLE  `uomedu_exam_portal`.`bpaper_tb` (
  `bpaper_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(11) unsigned NOT NULL,
  `examcode` int(11) unsigned NOT NULL,
  `subcode` int(11) unsigned NOT NULL,
  `marks` varchar(100) NOT NULL,
  PRIMARY KEY (`bpaper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`bpaper_tb`
--

/*!40000 ALTER TABLE `bpaper_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `bpaper_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`bsubjects_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`bsubjects_tb`;
CREATE TABLE  `uomedu_exam_portal`.`bsubjects_tb` (
  `bsub_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(10) unsigned NOT NULL,
  `pm` varchar(45) NOT NULL,
  `total` varchar(45) NOT NULL,
  PRIMARY KEY (`bsub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`bsubjects_tb`
--

/*!40000 ALTER TABLE `bsubjects_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `bsubjects_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`centercode_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`centercode_tb`;
CREATE TABLE  `uomedu_exam_portal`.`centercode_tb` (
  `ccode_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ccide` int(11) unsigned NOT NULL,
  `examcode` int(11) unsigned NOT NULL,
  `cname` varchar(100) NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `dae` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `gender` tinyint(3) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `ficNo` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  PRIMARY KEY (`ccode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`centercode_tb`
--

/*!40000 ALTER TABLE `centercode_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `centercode_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`collegecode_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`collegecode_tb`;
CREATE TABLE  `uomedu_exam_portal`.`collegecode_tb` (
  `colcode_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `collegecode` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `dae` decimal(10,0) NOT NULL,
  `type` varchar(45) NOT NULL,
  `gender` tinyint(3) unsigned NOT NULL,
  `district` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `pr_g` varchar(100) NOT NULL,
  `regStart` datetime NOT NULL,
  PRIMARY KEY (`colcode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`collegecode_tb`
--

/*!40000 ALTER TABLE `collegecode_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `collegecode_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`datesheet_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`datesheet_tb`;
CREATE TABLE  `uomedu_exam_portal`.`datesheet_tb` (
  `datesheet_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `examcode` int(10) unsigned NOT NULL,
  `subjectcode` int(10) unsigned NOT NULL,
  `ddate` datetime NOT NULL,
  `dtime` datetime NOT NULL,
  PRIMARY KEY (`datesheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`datesheet_tb`
--

/*!40000 ALTER TABLE `datesheet_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `datesheet_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`degeesincollege`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`degeesincollege`;
CREATE TABLE  `uomedu_exam_portal`.`degeesincollege` (
  `defcolId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `colCode` varchar(100) NOT NULL,
  `degreeCode` varchar(100) NOT NULL,
  PRIMARY KEY (`defcolId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`degeesincollege`
--

/*!40000 ALTER TABLE `degeesincollege` DISABLE KEYS */;
/*!40000 ALTER TABLE `degeesincollege` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`degrees_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`degrees_tb`;
CREATE TABLE  `uomedu_exam_portal`.`degrees_tb` (
  `degree_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mTitle` varchar(100) NOT NULL,
  `det1` varchar(255) NOT NULL,
  `det2` varchar(255) NOT NULL,
  `degreecode` varchar(100) NOT NULL,
  `years` datetime NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`degree_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`degrees_tb`
--

/*!40000 ALTER TABLE `degrees_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `degrees_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`enrollment_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`enrollment_tb`;
CREATE TABLE  `uomedu_exam_portal`.`enrollment_tb` (
  `enroll_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regno` int(11) unsigned NOT NULL,
  `sessionCode` varchar(100) NOT NULL,
  `degreeCode` varchar(100) NOT NULL,
  `colCode` varchar(100) NOT NULL,
  `subCode` varchar(100) NOT NULL,
  `degComDate` datetime NOT NULL,
  PRIMARY KEY (`enroll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`enrollment_tb`
--

/*!40000 ALTER TABLE `enrollment_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollment_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`examcode_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`examcode_tb`;
CREATE TABLE  `uomedu_exam_portal`.`examcode_tb` (
  `examcode_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `examcode` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `dae` varchar(100) NOT NULL,
  `type` varchar(45) NOT NULL,
  `session` varchar(0) NOT NULL,
  `Na` varchar(50) NOT NULL,
  `order` varchar(100) NOT NULL,
  `defDate` datetime NOT NULL,
  PRIMARY KEY (`examcode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`examcode_tb`
--

/*!40000 ALTER TABLE `examcode_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `examcode_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`final_result_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`final_result_tb`;
CREATE TABLE  `uomedu_exam_portal`.`final_result_tb` (
  `fresult_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(10) unsigned NOT NULL,
  `examcode` int(10) unsigned NOT NULL,
  `result` varchar(50) NOT NULL,
  `def` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`fresult_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`final_result_tb`
--

/*!40000 ALTER TABLE `final_result_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `final_result_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`migrations`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`migrations`;
CREATE TABLE  `uomedu_exam_portal`.`migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uomedu_exam_portal`.`migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `uomedu_exam_portal`.`migrations` (`id`,`migration`,`batch`) VALUES 
 (1,'2014_10_12_000000_create_users_table',1),
 (2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`p_address_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`p_address_tb`;
CREATE TABLE  `uomedu_exam_portal`.`p_address_tb` (
  `add_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regno` int(11) unsigned NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`p_address_tb`
--

/*!40000 ALTER TABLE `p_address_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_address_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`p_emails_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`p_emails_tb`;
CREATE TABLE  `uomedu_exam_portal`.`p_emails_tb` (
  `email_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regno` int(11) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`p_emails_tb`
--

/*!40000 ALTER TABLE `p_emails_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_emails_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`p_phones_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`p_phones_tb`;
CREATE TABLE  `uomedu_exam_portal`.`p_phones_tb` (
  `phone_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regno` int(11) unsigned NOT NULL,
  `contactNo` varchar(25) NOT NULL,
  PRIMARY KEY (`phone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`p_phones_tb`
--

/*!40000 ALTER TABLE `p_phones_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `p_phones_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`password_resets`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`password_resets`;
CREATE TABLE  `uomedu_exam_portal`.`password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uomedu_exam_portal`.`password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`practical_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`practical_tb`;
CREATE TABLE  `uomedu_exam_portal`.`practical_tb` (
  `prac_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(11) unsigned NOT NULL,
  `examcode` int(11) unsigned NOT NULL,
  `subcode` int(11) unsigned NOT NULL,
  `marks` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`prac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`practical_tb`
--

/*!40000 ALTER TABLE `practical_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `practical_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`prsubjects_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`prsubjects_tb`;
CREATE TABLE  `uomedu_exam_portal`.`prsubjects_tb` (
  `prsub_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(10) unsigned NOT NULL,
  `pmarks` varchar(50) NOT NULL,
  `tot` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`prsub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`prsubjects_tb`
--

/*!40000 ALTER TABLE `prsubjects_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `prsubjects_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`registration_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`registration_tb`;
CREATE TABLE  `uomedu_exam_portal`.`registration_tb` (
  `std_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registrationNo` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` datetime NOT NULL,
  `domicile` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `collegeId` int(11) unsigned NOT NULL,
  `sessionId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`std_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`registration_tb`
--

/*!40000 ALTER TABLE `registration_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`result_details_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`result_details_tb`;
CREATE TABLE  `uomedu_exam_portal`.`result_details_tb` (
  `rdetails_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(10) unsigned NOT NULL,
  `examcode` int(10) unsigned NOT NULL,
  `subcode` int(10) unsigned NOT NULL,
  `marks` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `asubjectMarks` varchar(50) NOT NULL,
  PRIMARY KEY (`rdetails_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`result_details_tb`
--

/*!40000 ALTER TABLE `result_details_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `result_details_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`rollno_com_det_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`rollno_com_det_tb`;
CREATE TABLE  `uomedu_exam_portal`.`rollno_com_det_tb` (
  `roll_com_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(11) unsigned NOT NULL,
  `examcode` varchar(100) NOT NULL,
  `subcode` varchar(100) NOT NULL,
  `ficRollno` varchar(100) NOT NULL,
  PRIMARY KEY (`roll_com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`rollno_com_det_tb`
--

/*!40000 ALTER TABLE `rollno_com_det_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `rollno_com_det_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`rollnos_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`rollnos_tb`;
CREATE TABLE  `uomedu_exam_portal`.`rollnos_tb` (
  `rollno_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rollno` int(11) unsigned NOT NULL,
  `examcode` varchar(100) NOT NULL,
  `part` varchar(100) NOT NULL,
  `ccode` varchar(100) NOT NULL,
  `colCodeq` varchar(100) NOT NULL,
  PRIMARY KEY (`rollno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`rollnos_tb`
--

/*!40000 ALTER TABLE `rollnos_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `rollnos_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`session_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`session_tb`;
CREATE TABLE  `uomedu_exam_portal`.`session_tb` (
  `session_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sessionCode` varchar(100) NOT NULL,
  `session` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`session_tb`
--

/*!40000 ALTER TABLE `session_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`staff_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`staff_tb`;
CREATE TABLE  `uomedu_exam_portal`.`staff_tb` (
  `staff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `avator` text NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`staff_tb`
--

/*!40000 ALTER TABLE `staff_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`student_academic_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`student_academic_tb`;
CREATE TABLE  `uomedu_exam_portal`.`student_academic_tb` (
  `academic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `examName` varchar(255) NOT NULL,
  `roll` int(11) unsigned NOT NULL,
  `year` int(10) unsigned NOT NULL,
  `marks_obt` int(11) unsigned NOT NULL,
  `total_marks` int(11) unsigned NOT NULL,
  `division_grade` varchar(25) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `uni_board` varchar(255) NOT NULL,
  `regno` int(11) unsigned NOT NULL,
  PRIMARY KEY (`academic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`student_academic_tb`
--

/*!40000 ALTER TABLE `student_academic_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_academic_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`subjects_tb`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`subjects_tb`;
CREATE TABLE  `uomedu_exam_portal`.`subjects_tb` (
  `subject_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `Na` varchar(100) NOT NULL,
  `discode` varchar(100) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `term` varchar(50) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `hours` int(10) unsigned NOT NULL,
  `pmarks` varchar(50) NOT NULL,
  `part` varchar(50) NOT NULL,
  `sname2` varchar(100) NOT NULL,
  `prate` varchar(50) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uomedu_exam_portal`.`subjects_tb`
--

/*!40000 ALTER TABLE `subjects_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects_tb` ENABLE KEYS */;


--
-- Structure for table `uomedu_exam_portal`.`users`
--

DROP TABLE IF EXISTS `uomedu_exam_portal`.`users`;
CREATE TABLE  `uomedu_exam_portal`.`users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uomedu_exam_portal`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `uomedu_exam_portal`.`users` (`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) VALUES 
 (1,'Sadam Hussain','sadam.uom7@gmail.com',NULL,'$2y$10$.8IIywAY3xyc.YtRoHImHuYOX3roKk3mJzuP30vjLhcA2OelM0TFy',NULL,'2019-03-07 08:04:18','2019-03-07 08:04:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
