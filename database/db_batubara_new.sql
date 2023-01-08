-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_batubara_new
CREATE DATABASE IF NOT EXISTS `db_batubara_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_batubara_new`;

-- Dumping structure for table db_batubara_new.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table db_batubara_new.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.file
CREATE TABLE IF NOT EXISTS `file` (
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

-- Dumping data for table db_batubara_new.file: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.harga
CREATE TABLE IF NOT EXISTS `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tujuan_id` int(11) DEFAULT NULL,
  `transportir_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `pg` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_harga_tujuan` (`tujuan_id`),
  KEY `FK_harga_transportir` (`transportir_id`),
  CONSTRAINT `FK_harga_transportir` FOREIGN KEY (`transportir_id`) REFERENCES `transportir` (`id`),
  CONSTRAINT `FK_harga_tujuan` FOREIGN KEY (`tujuan_id`) REFERENCES `tujuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.harga: ~2 rows (approximately)
INSERT INTO `harga` (`id`, `tujuan_id`, `transportir_id`, `harga`, `pg`, `tanggal`, `created_at`, `updated_at`) VALUES
	(87, 3, 3, 87, 7878, '2023-01-13', '2023-01-07 17:53:28', '2023-01-07 17:53:28'),
	(94, 3, 3, 87, 7878, '2023-01-13', '2023-01-07 17:53:28', '2023-01-07 17:53:28');

-- Dumping structure for table db_batubara_new.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_03_19_102456_create_permission_tables', 1),
	(6, '2022_03_29_105225_create_settings_table', 1);

-- Dumping structure for table db_batubara_new.mobil
CREATE TABLE IF NOT EXISTS `mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plat` char(50) DEFAULT NULL,
  `mobil_jenis_id` int(11) NOT NULL,
  `pemilik_mobil_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mobil_pemilik_mobil` (`pemilik_mobil_id`) USING BTREE,
  KEY `FK_mobil_mobil_jenis` (`mobil_jenis_id`) USING BTREE,
  CONSTRAINT `FK_mobil_pemilik_mobil` FOREIGN KEY (`pemilik_mobil_id`) REFERENCES `pemilik_mobil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table db_batubara_new.mobil: ~4 rows (approximately)
INSERT INTO `mobil` (`id`, `plat`, `mobil_jenis_id`, `pemilik_mobil_id`, `created_at`, `updated_at`) VALUES
	(1, 'B 981 OPL', 2, 1, '2023-01-03 18:06:46', '2023-01-06 06:53:55'),
	(2, 'B 982 OPL', 1, 1, '2023-01-03 18:06:46', '2023-01-04 18:53:48'),
	(27, 'B 983 OPL', 2, 3, '2023-01-03 18:06:46', '2023-01-04 18:53:48'),
	(35, '9-09-09-0808078070', 2, 3, '2023-01-06 08:51:24', '2023-01-06 08:51:24');

-- Dumping structure for table db_batubara_new.mobil_jenis
CREATE TABLE IF NOT EXISTS `mobil_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.mobil_jenis: ~2 rows (approximately)
INSERT INTO `mobil_jenis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'BAk', '2023-01-03 16:58:25', '2023-01-03 16:58:26'),
	(2, 'ANGKOT', '2023-01-03 16:58:25', '2023-01-03 16:58:26');

-- Dumping structure for table db_batubara_new.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.model_has_roles: ~5 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(3, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(5, 'App\\Models\\User', 4),
	(4, 'App\\Models\\User', 5);

-- Dumping structure for table db_batubara_new.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.password_resets: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.pemilik_mobil
CREATE TABLE IF NOT EXISTS `pemilik_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.pemilik_mobil: ~3 rows (approximately)
INSERT INTO `pemilik_mobil` (`id`, `nama`, `kontak`, `catatan`, `created_at`, `updated_at`) VALUES
	(1, 'Ade Sukron', '082244261525', NULL, '2023-01-03 15:08:51', '2023-01-06 07:29:32'),
	(3, 'Lian Mafutra', '082244261525', NULL, '2023-01-03 15:08:51', '2023-01-03 15:08:52'),
	(5, 'Joko', '0823782632323', NULL, '2023-01-06 07:28:05', '2023-01-06 08:16:52');

-- Dumping structure for table db_batubara_new.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.permissions: ~37 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'filemanager', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(2, 'read module', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(3, 'delete setting', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(4, 'update setting', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(5, 'read setting', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(6, 'create setting', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(7, 'delete user', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(8, 'update user', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(9, 'read user', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(10, 'create user', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(11, 'delete role', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(12, 'update role', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(13, 'read role', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(14, 'create role', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(15, 'delete permission', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(16, 'update permission', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(17, 'read permission', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(18, 'create permission', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(19, 'view_data_pegawai', 'web', '2022-11-18 04:16:07', '2022-11-18 04:16:07'),
	(20, 'pengajuan menu', 'web', '2022-11-18 04:41:26', '2022-11-29 01:42:51'),
	(21, 'pengajuan create', 'web', '2022-11-22 02:08:40', '2022-11-22 02:08:40'),
	(22, 'pengajuan store', 'web', '2022-11-22 07:59:32', '2022-11-22 07:59:32'),
	(23, 'pengajuan destroy', 'web', '2022-11-22 07:59:43', '2022-11-22 07:59:43'),
	(24, 'pengajuan update', 'web', '2022-11-22 07:59:50', '2022-11-22 07:59:50'),
	(25, 'profile menu', 'web', '2022-11-29 01:43:03', '2022-11-29 01:43:03'),
	(26, 'pengajuan index', 'web', '2022-11-29 01:43:44', '2022-11-29 01:43:44'),
	(27, 'pengajuan show', 'web', '2022-12-03 09:27:42', '2022-12-03 09:27:42'),
	(28, 'pengajuan verifikasi kirim', 'web', '2022-12-05 02:25:00', '2022-12-05 02:38:16'),
	(29, 'pengajuan verifikasi index', 'web', '2022-12-05 02:38:59', '2022-12-05 02:38:59'),
	(30, 'pengajuan verifikasi tolak', 'web', '2022-12-05 03:02:17', '2022-12-05 03:02:17'),
	(31, 'pengajuan selesai', 'web', '2022-12-06 03:06:08', '2022-12-06 03:06:08'),
	(32, 'pengajuan filter', 'web', '2022-12-06 18:14:56', '2022-12-06 18:14:56'),
	(33, 'master rekom pegawai', 'web', '2022-12-07 04:02:14', '2022-12-07 04:02:31'),
	(34, 'pengajuan edit', 'web', '2022-12-13 02:46:20', '2022-12-13 02:46:20'),
	(35, 'pengajuan revisi', 'web', '2022-12-13 03:06:15', '2022-12-13 03:06:15'),
	(36, 'rekom cetak', 'web', '2022-12-24 16:44:37', '2022-12-24 16:44:37'),
	(37, 'master user', 'web', '2022-12-25 03:42:50', '2022-12-25 03:42:50');

-- Dumping structure for table db_batubara_new.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Dumping data for table db_batubara_new.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.roles: ~5 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', '2022-11-18 03:50:20', '2022-11-18 03:50:20'),
	(2, 'admin_inspektorat', 'web', '2022-11-18 04:33:06', '2022-11-18 04:33:06'),
	(3, 'admin_opd', 'web', '2022-11-18 04:33:28', '2022-11-18 04:33:28'),
	(4, 'admin_kasubag', 'web', '2022-12-06 02:53:46', '2022-12-06 02:53:46'),
	(5, 'inspektur', 'web', '2022-12-06 02:57:57', '2022-12-06 02:57:57');

-- Dumping structure for table db_batubara_new.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_batubara_new.role_has_permissions: ~40 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(20, 2),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(27, 2),
	(28, 2),
	(29, 2),
	(30, 2),
	(31, 2),
	(32, 2),
	(33, 2),
	(37, 2),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(26, 3),
	(34, 3),
	(35, 3),
	(20, 4),
	(21, 4),
	(23, 4),
	(24, 4),
	(25, 4),
	(27, 4),
	(28, 4),
	(29, 4),
	(30, 4),
	(20, 5),
	(23, 5),
	(24, 5),
	(25, 5),
	(27, 5),
	(28, 5),
	(29, 5),
	(30, 5),
	(36, 5);

-- Dumping structure for table db_batubara_new.setoran
CREATE TABLE IF NOT EXISTS `setoran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_pembayaran` enum('LUNAS','BELUM') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.setoran: ~0 rows (approximately)

-- Dumping structure for table db_batubara_new.settings
CREATE TABLE IF NOT EXISTS `settings` (
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

-- Dumping data for table db_batubara_new.settings: ~6 rows (approximately)
INSERT INTO `settings` (`id`, `key`, `value`, `name`, `type`, `ext`, `category`, `created_at`, `updated_at`) VALUES
	(1, 'app_name', 'RekomPeg', 'Application Short Name', 'text', NULL, 'information', '2022-11-18 03:50:20', '2022-11-21 03:59:58'),
	(2, 'app_short_name', 'RekomPeg', 'Application Name', 'text', NULL, 'information', '2022-11-18 03:50:20', '2022-11-21 03:59:58'),
	(3, 'app_logo', 'storage/logo_kota.png', 'Application Logo', 'file', 'png', 'information', '2022-11-18 03:50:20', '2022-11-21 03:59:58'),
	(4, 'app_favicon', 'storage/logo_kota.png', 'Application Favicon', 'file', 'png', 'information', '2022-11-18 03:50:20', '2022-11-21 03:59:58'),
	(5, 'app_loading_gif', 'storage/logo_kota.png', 'Application Loading Image', 'file', 'gif', 'information', '2022-11-18 03:50:20', '2022-11-21 03:59:58'),
	(6, 'app_map_loaction', 'none', 'Application Map Location', 'textarea', NULL, 'contact', '2022-11-18 03:50:20', '2022-11-18 04:32:23');

-- Dumping structure for table db_batubara_new.supir
CREATE TABLE IF NOT EXISTS `supir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.supir: ~3 rows (approximately)
INSERT INTO `supir` (`id`, `nama`, `kontak`, `catatan`, `created_at`, `updated_at`) VALUES
	(1, 'Andi', '082244261525', NULL, '2023-01-03 15:08:51', '2023-01-06 07:29:32'),
	(3, 'Udin', '082244261525', NULL, '2023-01-03 15:08:51', '2023-01-03 15:08:52'),
	(5, 'Dedek', '0823782632323', NULL, '2023-01-06 07:28:05', '2023-01-07 10:23:49');

-- Dumping structure for table db_batubara_new.transportir
CREATE TABLE IF NOT EXISTS `transportir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.transportir: ~3 rows (approximately)
INSERT INTO `transportir` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'PT NAN RAING', '2023-01-03 15:08:51', '2023-01-06 07:29:32'),
	(3, 'ADS', '2023-01-03 15:08:51', '2023-01-03 15:08:52'),
	(5, 'DSH', '2023-01-06 07:28:05', '2023-01-06 08:38:07');

-- Dumping structure for table db_batubara_new.tujuan
CREATE TABLE IF NOT EXISTS `tujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_batubara_new.tujuan: ~3 rows (approximately)
INSERT INTO `tujuan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'BHS', '2023-01-03 15:08:51', '2023-01-06 07:29:32'),
	(3, 'TEBAT PATAH', '2023-01-03 15:08:51', '2023-01-03 15:08:52'),
	(5, 'KAI', '2023-01-06 07:28:05', '2023-01-06 08:38:07');

-- Dumping structure for table db_batubara_new.users
CREATE TABLE IF NOT EXISTS `users` (
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

-- Dumping data for table db_batubara_new.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `name`, `kontak`, `foto`, `foto_path`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'Lian Mafutra', '082244261525', NULL, NULL, '$2y$10$0TCZyv09VXo58L2.JmjSeen0p126nwBE9LkBK41zy1TQ0.ftCASLG', 'Tc7kVUAW72LPv0KLVIXOR9hZqbDLESOoG6L7rxeogph0BOeWXwjmCUGikpWc', '2022-11-23 09:04:52', '2023-01-03 14:02:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
