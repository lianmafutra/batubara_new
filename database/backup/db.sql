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
-- Table structure for table `harga`
--

DROP TABLE IF EXISTS `harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tujuan_id` int(11) DEFAULT NULL,
  `transportir_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_pembayaran` int(11) DEFAULT NULL,
  `harga_pencairan` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_harga_tujuan` (`tujuan_id`),
  KEY `FK_harga_transportir` (`transportir_id`),
  CONSTRAINT `FK_harga_transportir` FOREIGN KEY (`transportir_id`) REFERENCES `transportir` (`id`),
  CONSTRAINT `FK_harga_tujuan` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harga`
--

LOCK TABLES `harga` WRITE;
/*!40000 ALTER TABLE `harga` DISABLE KEYS */;
INSERT INTO `harga` VALUES (94,6,3,260,258,265,'2023-01-13','2023-01-07 17:53:28','2023-01-24 17:48:02'),(96,5,3,245,243,250,'2023-01-11','2023-01-07 17:53:28','2023-01-24 17:47:53'),(97,3,3,130,128,135,'2023-01-10','2023-01-07 17:53:28','2023-01-24 17:47:43'),(99,8,3,250,248,255,'2023-01-14','2023-01-22 02:27:51','2023-01-24 17:48:20'),(100,1,5,167,165,172,'2023-01-04','2023-01-22 02:36:00','2023-01-24 17:47:33'),(101,7,3,160,158,165,'2023-01-13','2023-01-22 14:20:04','2023-01-24 17:48:10'),(102,9,3,227,225,232,'2023-01-14','2023-01-22 02:27:51','2023-01-24 17:48:30');
/*!40000 ALTER TABLE `harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harga_pengaturan`
--

DROP TABLE IF EXISTS `harga_pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `harga_pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hrg_pembayaran` int(11) DEFAULT NULL,
  `hrg_pencairan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harga_pengaturan`
--

LOCK TABLES `harga_pengaturan` WRITE;
/*!40000 ALTER TABLE `harga_pengaturan` DISABLE KEYS */;
INSERT INTO `harga_pengaturan` VALUES (1,-2,5,'2023-01-07 17:53:28','2023-01-22 01:59:21');
/*!40000 ALTER TABLE `harga_pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histori_pembayaran`
--

DROP TABLE IF EXISTS `histori_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histori_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` char(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `setoran_id` varchar(500) NOT NULL,
  `kasbon_id` varchar(500) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `mobil_plat` varchar(50) NOT NULL DEFAULT '',
  `supir_id` int(11) NOT NULL,
  `supir_nama` varchar(50) NOT NULL DEFAULT '',
  `pemilik_mobil_id` int(11) NOT NULL,
  `pemilik_nama` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histori_pembayaran`
--

LOCK TABLES `histori_pembayaran` WRITE;
/*!40000 ALTER TABLE `histori_pembayaran` DISABLE KEYS */;
INSERT INTO `histori_pembayaran` VALUES (35,'1/BYR/25-01-23','2023-01-25','[\"36\",\"35\",\"38\",\"34\",\"32\",\"37\",\"33\",\"29\",\"31\",\"30\"]','[5,41,42,43,44,45,46,47,48,49,50,51,52,53,54]',27,'B 983 OPL',6,'widodo',1,'Ade Sukron','2023-01-24 18:06:55','2023-01-24 18:06:55');
/*!40000 ALTER TABLE `histori_pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kasbon`
--

DROP TABLE IF EXISTS `kasbon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kasbon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jumlah_uang` int(100) NOT NULL,
  `tanggal_kasbon` date NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `mobil_id` int(11) NOT NULL,
  `pemilik_mobil_id` int(11) NOT NULL,
  `status` enum('LUNAS','BELUM') NOT NULL DEFAULT 'BELUM',
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kasbon`
--

LOCK TABLES `kasbon` WRITE;
/*!40000 ALTER TABLE `kasbon` DISABLE KEYS */;
INSERT INTO `kasbon` VALUES (4,'GANTI MEDITRAN',390,'2023-01-24',NULL,2,1,'BELUM','2023-01-24 04:37:49','2023-01-24'),(5,'GANTI BAUT RODA',205000,'2023-01-24','2023-01-25',27,3,'LUNAS','2023-01-24 04:37:49','2023-01-25'),(7,'GANTI FILTER SOLAR BAWAH',30,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2023-01-24'),(8,'FILTER HAWA2',100,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2023-01-24'),(9,'GT 750',1440000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(10,'GANTI MEDITRAN',400000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(11,'GANTI FILTER OLI',100000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(12,'GANTI FILTER SOLAR',60000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(13,'GANTI FILTER  SOLAR BAWAH',30000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(14,'GEMUK MOBIL',30000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(15,'FILTER HAWA',180000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(16,'GIGI TUNGGU',2400000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(17,'PARET HDA',200000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(18,'LEM GASKET',40000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(19,'PASANG PIN OMBENG',140000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(20,'JAMBRIT',120000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(21,'GANTI GIGI',380000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(22,'STEL REM',40000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(23,'TRANSFER',15000000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(24,'BUKA TRANSMISI',400000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(25,'SENTRAL BAWAH STEL',90000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(26,'CO ASSY HT',130000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(27,'MINYAM 1000',80000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(28,'GIGI TUNGGU PS125T',2400000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(29,'GIGI 3',700000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(30,'NUP307NR',630000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(31,'FILTER POMPA SOLAR',150000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(32,'LAMPU DEPAN',60000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(33,'GANTI CENTRAL ATAS',70000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(34,'CM MINYAK BESI HT 125',180000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(35,'MINYAK REM 1000',85000,'2023-01-24',NULL,1,1,'BELUM','2023-01-24 04:37:49','2021-12-06'),(41,'BAN DALAM',195000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:42:08','2023-01-25'),(42,'SLENDANG JAWO',65000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:42:22','2023-01-25'),(43,'CEK KLAAHR',155000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:42:36','2023-01-25'),(44,'GEMUK',65000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:42:50','2023-01-25'),(45,'REPSOL',550000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:42:59','2023-01-25'),(46,'UPAH PASANAG',5000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:43:11','2023-01-25'),(47,'FILTER OLI',85000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:43:25','2023-01-25'),(48,'FILTER SKR UP',50000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:43:36','2023-01-25'),(49,'FILTER SOALR LOW',26000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:43:47','2023-01-25'),(50,'LOW',20000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:44:00','2023-01-25'),(51,'KANEBO',15000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:44:13','2023-01-25'),(52,'BOLA BOAL STIR',405000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:44:24','2023-01-25'),(53,'KINGPEN',305000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:44:35','2023-01-25'),(54,'STEL REM',65000,'2023-01-24','2023-01-25',27,1,'LUNAS','2023-01-24 21:44:45','2023-01-25');
/*!40000 ALTER TABLE `kasbon` ENABLE KEYS */;
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
  `mobil_jenis_id` int(11) NOT NULL,
  `pemilik_mobil_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plat` (`plat`),
  KEY `FK_mobil_pemilik_mobil` (`pemilik_mobil_id`) USING BTREE,
  KEY `FK_mobil_mobil_jenis` (`mobil_jenis_id`) USING BTREE,
  KEY `FK_mobil_supir` (`supir_id`),
  CONSTRAINT `FK_mobil_pemilik_mobil` FOREIGN KEY (`pemilik_mobil_id`) REFERENCES `pemilik_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mobil_supir` FOREIGN KEY (`supir_id`) REFERENCES `supir` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (1,'B 981 OPL',2,1,1,'2023-01-03 18:06:46','2023-01-06 06:53:55'),(2,'B 982 OPL',1,1,5,'2023-01-03 18:06:46','2023-01-04 18:53:48'),(27,'B 983 OPL',1,1,6,'2023-01-03 18:06:46','2023-01-24 13:50:45');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil_jenis`
--

LOCK TABLES `mobil_jenis` WRITE;
/*!40000 ALTER TABLE `mobil_jenis` DISABLE KEYS */;
INSERT INTO `mobil_jenis` VALUES (1,'BAk','2023-01-03 16:58:25','2023-01-03 16:58:26'),(2,'ANGKOT','2023-01-03 16:58:25','2023-01-03 16:58:26');
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1);
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilik_mobil`
--

LOCK TABLES `pemilik_mobil` WRITE;
/*!40000 ALTER TABLE `pemilik_mobil` DISABLE KEYS */;
INSERT INTO `pemilik_mobil` VALUES (1,'Ade Sukron','082244261525',NULL,'2023-01-03 15:08:51','2023-01-06 07:29:32'),(3,'Lian Mafutra','082244261525',NULL,'2023-01-03 15:08:51','2023-01-03 15:08:52'),(5,'Joko','0823782632323',NULL,'2023-01-06 07:28:05','2023-01-06 08:16:52');
/*!40000 ALTER TABLE `pemilik_mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_group`
--

DROP TABLE IF EXISTS `permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_group` (
  `id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_group`
--

LOCK TABLES `permission_group` WRITE;
/*!40000 ALTER TABLE `permission_group` DISABLE KEYS */;
INSERT INTO `permission_group` VALUES (1,2,'pengajuan','2023-01-18 09:28:58','2023-01-18 09:28:58');
/*!40000 ALTER TABLE `permission_group` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'filemanager','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(2,'read module','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(3,'delete setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(4,'update setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(5,'read setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(6,'create setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(7,'delete user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(8,'update user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(9,'read user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(10,'create user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(11,'delete role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(12,'update role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(13,'read role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(14,'create role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(15,'delete permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(16,'update permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(17,'read permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(18,'create permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(19,'view_data_pegawai','web','2022-11-18 04:16:07','2022-11-18 04:16:07'),(20,'pengajuan menu','web','2022-11-18 04:41:26','2022-11-29 01:42:51'),(21,'pengajuan create','web','2022-11-22 02:08:40','2022-11-22 02:08:40'),(22,'pengajuan store','web','2022-11-22 07:59:32','2022-11-22 07:59:32'),(23,'pengajuan destroy','web','2022-11-22 07:59:43','2022-11-22 07:59:43'),(24,'pengajuan update','web','2022-11-22 07:59:50','2022-11-22 07:59:50'),(25,'profile menu','web','2022-11-29 01:43:03','2022-11-29 01:43:03'),(26,'pengajuan index','web','2022-11-29 01:43:44','2022-11-29 01:43:44'),(27,'pengajuan show','web','2022-12-03 09:27:42','2022-12-03 09:27:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2022-11-18 03:50:20','2022-11-18 03:50:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setoran`
--

DROP TABLE IF EXISTS `setoran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setoran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemilik_mobil_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `supir_nama` varchar(50) NOT NULL,
  `pemilik_nama` varchar(50) NOT NULL,
  `mobil_plat` varchar(50) NOT NULL,
  `mobil_id` int(11) NOT NULL,
  `pg` int(11) DEFAULT NULL,
  `uang_jalan` int(11) DEFAULT NULL,
  `uang_lainnya` int(11) DEFAULT '0',
  `tgl_ambil_uang_jalan` date DEFAULT NULL,
  `tgl_muat` date DEFAULT NULL,
  `tgl_bongkar` date DEFAULT NULL,
  `berat` int(20) DEFAULT '0',
  `tujuan_id` int(11) DEFAULT NULL,
  `tujuan_nama` varchar(50) DEFAULT NULL,
  `status_pembayaran` enum('LUNAS','BELUM') DEFAULT 'BELUM',
  `tgl_bayar` datetime DEFAULT NULL,
  `tgl_pencairan` datetime DEFAULT NULL,
  `status_pencairan` varchar(20) DEFAULT '0',
  `transportir_id` int(11) DEFAULT NULL,
  `transportir_nama` varchar(50) DEFAULT NULL,
  `foto` text,
  `uuid` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setoran`
--

LOCK TABLES `setoran` WRITE;
/*!40000 ALTER TABLE `setoran` DISABLE KEYS */;
INSERT INTO `setoran` VALUES (22,1,5,'Dedek','Ade Sukron','B 982 OPL',2,40000,1777,-700000,'2023-01-18','2023-01-18',NULL,6789,3,'TEBAT PATAH','BELUM',NULL,NULL,'0',3,'ADS',NULL,NULL,'2023-01-24 23:56:56','2023-01-22 07:23:39'),(29,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,700000,200000,'2023-01-24','2023-01-24',NULL,12820,1,'KT','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:09:55'),(30,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,700000,200000,'2023-01-24','2023-01-24',NULL,12400,1,'KT','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:10:08'),(31,1,6,'widodo','Ade Sukron','B 983 OPL',27,1000000,1800000,-500000,'2023-01-24','2023-01-24',NULL,12720,3,'BHJ','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:10:18'),(32,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,0,0,'2023-01-24','2023-01-24',NULL,13830,5,'KAI 02 JN N','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:10:29'),(33,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,800000,900000,'2023-01-24','2023-01-24',NULL,13340,6,'BHS','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:10:42'),(34,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,800000,100000,'2023-01-24','2023-01-24',NULL,13900,1,'KT','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:10:56'),(35,1,6,'widodo','Ade Sukron','B 983 OPL',27,600000,800000,600000,'2023-01-24','2023-01-24',NULL,13940,7,'IBN','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:11:03'),(36,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,800000,900000,'2023-01-24','2023-01-24',NULL,13970,8,'BM 01 SSN A','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:11:14'),(37,1,6,'widodo','Ade Sukron','B 983 OPL',27,600000,800000,550000,'2023-01-24','2023-01-24',NULL,13610,7,'IBN','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:11:26'),(38,1,6,'widodo','Ade Sukron','B 983 OPL',27,0,0,0,'2023-01-24','2023-01-24',NULL,13940,9,'TEBO PRIMA','LUNAS','2023-01-25 00:00:00',NULL,'0',1,'PT NAN RAING',NULL,NULL,'2023-01-25 01:06:55','2023-01-24 21:11:35');
/*!40000 ALTER TABLE `setoran` ENABLE KEYS */;
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
INSERT INTO `settings` VALUES (1,'app_name','Do Batu Bara','Application Short Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(2,'app_short_name','Do Batu Bara','Application Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(3,'app_logo','storage/logo_kota.png','Application Logo','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(4,'app_favicon','storage/logo_kota.png','Application Favicon','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(5,'app_loading_gif','storage/logo_kota.png','Application Loading Image','file','gif','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(6,'app_map_loaction','none','Application Map Location','textarea',NULL,'contact','2022-11-18 03:50:20','2023-01-18 03:51:15');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supir`
--

DROP TABLE IF EXISTS `supir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supir`
--

LOCK TABLES `supir` WRITE;
/*!40000 ALTER TABLE `supir` DISABLE KEYS */;
INSERT INTO `supir` VALUES (1,'Andi','082244261525',NULL,'2023-01-03 15:08:51','2023-01-06 07:29:32'),(3,'Udin','082244261525',NULL,'2023-01-03 15:08:51','2023-01-03 15:08:52'),(5,'Dedek','0823782632323',NULL,'2023-01-06 07:28:05','2023-01-07 10:23:49'),(6,'widodo','0981203213213',NULL,'2023-01-24 13:45:49','2023-01-24 13:45:49');
/*!40000 ALTER TABLE `supir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportir`
--

DROP TABLE IF EXISTS `transportir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportir`
--

LOCK TABLES `transportir` WRITE;
/*!40000 ALTER TABLE `transportir` DISABLE KEYS */;
INSERT INTO `transportir` VALUES (1,'PT NAN RAING','2023-01-03 15:08:51','2023-01-06 07:29:32'),(3,'ADS','2023-01-03 15:08:51','2023-01-03 15:08:52'),(5,'DSH','2023-01-06 07:28:05','2023-01-06 08:38:07');
/*!40000 ALTER TABLE `transportir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tujuan`
--

DROP TABLE IF EXISTS `tujuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tujuan`
--

LOCK TABLES `tujuan` WRITE;
/*!40000 ALTER TABLE `tujuan` DISABLE KEYS */;
INSERT INTO `tujuan` VALUES (1,'KT','2023-01-03 15:08:51','2023-01-06 07:29:32'),(3,'BHJ','2023-01-03 15:08:51','2023-01-03 15:08:52'),(5,'KAI 02 JN N','2023-01-06 07:28:05','2023-01-06 08:38:07'),(6,'BHS','2023-01-24 14:04:29','2023-01-24 14:04:32'),(7,'IBN','2023-01-24 14:04:29','2023-01-24 14:04:32'),(8,'BM 01 SSN A','2023-01-24 14:04:30','2023-01-24 14:04:31'),(9,'TEBO PRIMA','2023-01-24 14:04:30','2023-01-24 14:04:31');
/*!40000 ALTER TABLE `tujuan` ENABLE KEYS */;
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','Lian Mafutra','082244261525',NULL,NULL,'$2y$10$0TCZyv09VXo58L2.JmjSeen0p126nwBE9LkBK41zy1TQ0.ftCASLG','Tc7kVUAW72LPv0KLVIXOR9hZqbDLESOoG6L7rxeogph0BOeWXwjmCUGikpWc','2022-11-23 09:04:52','2023-01-03 14:02:24');
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

-- Dump completed on 2023-01-25  7:14:14
