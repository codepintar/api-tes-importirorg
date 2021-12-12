/*
SQLyog Enterprise v12.09 (64 bit)
MySQL - 10.4.21-MariaDB : Database - db_api_importir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_api_importir` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_api_importir`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` tinyint(4) NOT NULL DEFAULT 0,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `barang` */

insert  into `barang`(`id`,`id_kategori`,`sku`,`nama`,`stok`,`is_deleted`,`created_at`,`updated_at`) values (1,1,'0001','BISKUIT ROMA','100',0,'2021-12-11 11:05:42','2021-12-11 11:05:42'),(3,1,'0002','SILVER QUEEN','110',0,'2021-12-11 11:09:23','2021-12-11 11:09:23'),(4,1,'0003','INDOMIE GORENG','50',0,'2021-12-11 11:09:36','2021-12-11 11:09:36'),(5,1,'0004','BISKUIT KHONG GUAN','80',0,'2021-12-11 11:10:06','2021-12-11 11:10:06'),(6,1,'0005','BISKUIT REGAL','70',0,'2021-12-11 13:25:17','2021-12-11 13:25:17'),(7,1,'0006','GERY SALUUT','80',0,'2021-12-11 13:25:42','2021-12-11 13:25:42'),(8,2,'0007','GARPU','90',0,'2021-12-11 13:26:32','2021-12-11 13:26:32'),(9,2,'0008','SENDOK MAKAN','150',0,'2021-12-11 13:26:45','2021-12-11 13:26:45'),(10,1,'0009','PIRING PANDA','200',1,'2021-12-11 13:26:55','2021-12-11 14:35:54'),(11,2,'0010','PANCI','40',0,'2021-12-11 13:28:09','2021-12-11 13:28:09');

/*Table structure for table `barang_in_out` */

DROP TABLE IF EXISTS `barang_in_out`;

CREATE TABLE `barang_in_out` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `qty` tinyint(4) NOT NULL DEFAULT 0,
  `is_flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `barang_in_out` */

insert  into `barang_in_out`(`id`,`sku`,`tanggal`,`qty`,`is_flag`,`created_by`,`updated_by`,`is_deleted`,`created_at`,`updated_at`) values (1,'0001','2021-12-12',30,'IN','2','0',0,'2021-12-12 11:03:39','2021-12-12 11:03:39'),(2,'0001','2021-12-13',10,'IN','2','0',0,'2021-12-12 11:08:05','2021-12-12 11:08:05'),(3,'0001','2021-12-12',5,'OUT','2','0',0,'2021-12-12 11:09:48','2021-12-12 11:09:48'),(4,'0001','2021-12-13',15,'IN','2','0',0,'2021-12-12 11:48:46','2021-12-12 11:48:46'),(5,'0001','2021-12-18',2,'OUT','2','0',0,'2021-12-12 13:21:23','2021-12-12 13:21:23');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2021_12_10_160022_ref_role',2),(7,'2021_12_10_161222_barang',2),(9,'2021_12_10_161445_ref_kategori',3),(10,'2021_12_12_091601_barang_in_out',4);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `ref_kategori` */

DROP TABLE IF EXISTS `ref_kategori`;

CREATE TABLE `ref_kategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ref_kategori` */

insert  into `ref_kategori`(`id`,`nama`,`is_deleted`,`created_at`,`updated_at`) values (1,'MAKANAN',0,'2021-12-11 11:08:20','2021-12-11 11:08:20'),(2,'PERALATAN DAPUR',0,'2021-12-11 11:08:27','2021-12-11 11:08:27');

/*Table structure for table `ref_role` */

DROP TABLE IF EXISTS `ref_role`;

CREATE TABLE `ref_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ref_role` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'User Admin','admin@yahoo.com',NULL,'$2y$10$qK.kXOoRxJpiSZjX0acQ4.IxLsfFqh48P53Lrb4r85rgCxIo.qLcW',NULL,'2021-12-10 16:48:32','2021-12-10 16:48:32'),(2,'User Gudang','gudang@yahoo.com',NULL,'$2y$10$qK.kXOoRxJpiSZjX0acQ4.IxLsfFqh48P53Lrb4r85rgCxIo.qLcW',NULL,'2021-12-10 17:06:49','2021-12-10 17:06:49');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
