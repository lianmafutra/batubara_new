-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_batubara_new
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(500) NOT NULL,
  `parent_file_id` int(11) NOT NULL,
  `name_origin` text NOT NULL,
  `name_random` text NOT NULL,
  `path` varchar(500) NOT NULL,
  `size` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_03_19_102456_create_permission_tables',1),(6,'2022_03_29_105225_create_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil`
--

DROP TABLE IF EXISTS `mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plat` char(50) DEFAULT NULL,
  `jenis` int(11) NOT NULL,
  `pemilik_mobil_id` int(11) NOT NULL,
  `uuid` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mobil_pemilik_mobil` (`pemilik_mobil_id`) USING BTREE,
  CONSTRAINT `FK_mobil_pemilik_mobil` FOREIGN KEY (`pemilik_mobil_id`) REFERENCES `pemilik_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (1,'dwqdd',1,1,'f638a8f8-aee5-4f2e-8190-a13308810ef2','2023-01-03 18:06:46','2023-01-03 18:06:46'),(17,'23231',1,1,'31e43b86-a811-413c-86b7-402a7259de54','2023-01-03 17:02:13','2023-01-03 18:09:24'),(22,'dqwdwqd',1,1,'b789db4a-dbc2-4441-8d62-54d2b4bc75fb','2023-01-03 17:16:50','2023-01-03 17:16:50'),(23,'wqdwqd',17,1,'2f8261f4-39f0-41df-9804-36fe073d2df4','2023-01-03 18:09:09','2023-01-03 18:09:09');
/*!40000 ALTER TABLE `mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil_jenis`
--

DROP TABLE IF EXISTS `mobil_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobil_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil_jenis`
--

LOCK TABLES `mobil_jenis` WRITE;
/*!40000 ALTER TABLE `mobil_jenis` DISABLE KEYS */;
INSERT INTO `mobil_jenis` VALUES (1,'BAK','2023-01-03 16:58:25','2023-01-03 16:58:26'),(17,'S','2023-01-03 16:58:25','2023-01-03 16:58:26');
/*!40000 ALTER TABLE `mobil_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(3,'App\\Models\\User',2),(2,'App\\Models\\User',3),(5,'App\\Models\\User',4),(4,'App\\Models\\User',5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemilik_mobil`
--

DROP TABLE IF EXISTS `pemilik_mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemilik_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `catatan` text,
  `uuid` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilik_mobil`
--

LOCK TABLES `pemilik_mobil` WRITE;
/*!40000 ALTER TABLE `pemilik_mobil` DISABLE KEYS */;
INSERT INTO `pemilik_mobil` VALUES (1,'ade sukron','082244261525',NULL,'qwdqwd','2023-01-03 15:08:51','2023-01-03 15:08:52');
/*!40000 ALTER TABLE `pemilik_mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'filemanager','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(2,'read module','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(3,'delete setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(4,'update setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(5,'read setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(6,'create setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(7,'delete user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(8,'update user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(9,'read user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(10,'create user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(11,'delete role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(12,'update role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(13,'read role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(14,'create role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(15,'delete permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(16,'update permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(17,'read permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(18,'create permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(19,'view_data_pegawai','web','2022-11-18 04:16:07','2022-11-18 04:16:07'),(20,'pengajuan menu','web','2022-11-18 04:41:26','2022-11-29 01:42:51'),(21,'pengajuan create','web','2022-11-22 02:08:40','2022-11-22 02:08:40'),(22,'pengajuan store','web','2022-11-22 07:59:32','2022-11-22 07:59:32'),(23,'pengajuan destroy','web','2022-11-22 07:59:43','2022-11-22 07:59:43'),(24,'pengajuan update','web','2022-11-22 07:59:50','2022-11-22 07:59:50'),(25,'profile menu','web','2022-11-29 01:43:03','2022-11-29 01:43:03'),(26,'pengajuan index','web','2022-11-29 01:43:44','2022-11-29 01:43:44'),(27,'pengajuan show','web','2022-12-03 09:27:42','2022-12-03 09:27:42'),(28,'pengajuan verifikasi kirim','web','2022-12-05 02:25:00','2022-12-05 02:38:16'),(29,'pengajuan verifikasi index','web','2022-12-05 02:38:59','2022-12-05 02:38:59'),(30,'pengajuan verifikasi tolak','web','2022-12-05 03:02:17','2022-12-05 03:02:17'),(31,'pengajuan selesai','web','2022-12-06 03:06:08','2022-12-06 03:06:08'),(32,'pengajuan filter','web','2022-12-06 18:14:56','2022-12-06 18:14:56'),(33,'master rekom pegawai','web','2022-12-07 04:02:14','2022-12-07 04:02:31'),(34,'pengajuan edit','web','2022-12-13 02:46:20','2022-12-13 02:46:20'),(35,'pengajuan revisi','web','2022-12-13 03:06:15','2022-12-13 03:06:15'),(36,'rekom cetak','web','2022-12-24 16:44:37','2022-12-24 16:44:37'),(37,'master user','web','2022-12-25 03:42:50','2022-12-25 03:42:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (20,2),(22,2),(23,2),(24,2),(25,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(37,2),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(34,3),(35,3),(20,4),(21,4),(23,4),(24,4),(25,4),(27,4),(28,4),(29,4),(30,4),(20,5),(23,5),(24,5),(25,5),(27,5),(28,5),(29,5),(30,5),(36,5);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(2,'admin_inspektorat','web','2022-11-18 04:33:06','2022-11-18 04:33:06'),(3,'admin_opd','web','2022-11-18 04:33:28','2022-11-18 04:33:28'),(4,'admin_kasubag','web','2022-12-06 02:53:46','2022-12-06 02:53:46'),(5,'inspektur','web','2022-12-06 02:57:57','2022-12-06 02:57:57');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` enum('information','contact','payment','email','api') COLLATE utf8mb4_unicode_ci DEFAULT 'information',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'app_name','RekomPeg','Application Short Name','text',NULL,'information','2022-11-18 03:50:20','2022-11-21 03:59:58'),(2,'app_short_name','RekomPeg','Application Name','text',NULL,'information','2022-11-18 03:50:20','2022-11-21 03:59:58'),(3,'app_logo','storage/logo_kota.png','Application Logo','file','png','information','2022-11-18 03:50:20','2022-11-21 03:59:58'),(4,'app_favicon','storage/logo_kota.png','Application Favicon','file','png','information','2022-11-18 03:50:20','2022-11-21 03:59:58'),(5,'app_loading_gif','storage/logo_kota.png','Application Loading Image','file','gif','information','2022-11-18 03:50:20','2022-11-21 03:59:58'),(6,'app_map_loaction','none','Application Map Location','textarea',NULL,'contact','2022-11-18 03:50:20','2022-11-18 04:32:23');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opd_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_penanda_tangan` enum('TRUE','FALSE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_ttd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','',1,'Lian Mafutra','082244261525',NULL,NULL,'$2y$10$0TCZyv09VXo58L2.JmjSeen0p126nwBE9LkBK41zy1TQ0.ftCASLG','60o9kk52jc6fxbxo7lcSKNtWkA3uelisN1SeJSZsNtm2n5JfN3vRh9QZrfqg',NULL,NULL,'4eebbb1b-bb61-480c-b449-9d80111a7645','2022-11-23 09:04:52','2023-01-03 14:02:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-04  8:15:42
