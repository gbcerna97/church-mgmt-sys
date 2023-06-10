-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: localhost    Database: mgmt-sys
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `member_id` bigint unsigned NOT NULL,
  `present` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `attendance_event_id_foreign` (`event_id`),
  KEY `attendance_member_id_foreign` (`member_id`),
  CONSTRAINT `attendance_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,1,1,1);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_counts`
--

DROP TABLE IF EXISTS `cash_counts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cash_counts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cc_1000` int DEFAULT '0',
  `cc_500` int DEFAULT '0',
  `cc_200` int DEFAULT '0',
  `cc_100` int DEFAULT '0',
  `cc_50` int DEFAULT '0',
  `cc_20` int DEFAULT '0',
  `cc_10` int DEFAULT '0',
  `cc_5` int DEFAULT '0',
  `cc_1` int DEFAULT '0',
  `cc_0_25` double(8,2) DEFAULT '0.00',
  `cc_0_1` double(8,2) DEFAULT '0.00',
  `cc_0_05` double(8,2) DEFAULT '0.00',
  `cc_0_01` double(8,2) DEFAULT '0.00',
  `total` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_counts`
--

LOCK TABLES `cash_counts` WRITE;
/*!40000 ALTER TABLE `cash_counts` DISABLE KEYS */;
INSERT INTO `cash_counts` VALUES (6,'2023-05-28',5,0,0,4,0,0,0,0,0,0.00,0.00,0.00,0.00,5000.00,'2023-05-29 22:03:11','2023-05-30 18:21:35');
/*!40000 ALTER TABLE `cash_counts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `church_info`
--

DROP TABLE IF EXISTS `church_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `church_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `church_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `givers_funds` double(8,2) DEFAULT NULL,
  `donations_funds` double(8,2) DEFAULT NULL,
  `overall_funds` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `church_info`
--

LOCK TABLES `church_info` WRITE;
/*!40000 ALTER TABLE `church_info` DISABLE KEYS */;
INSERT INTO `church_info` VALUES (1,'Jesus Loves You City Church','Butuan City','Butuan CIty, Philippines 8600',5400.00,0.00,5400.00,NULL,'2023-05-30 18:21:35');
/*!40000 ALTER TABLE `church_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disbursement_requests`
--

DROP TABLE IF EXISTS `disbursement_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disbursement_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `request_date` date NOT NULL,
  `prepared_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `released_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disbursement_requests`
--

LOCK TABLES `disbursement_requests` WRITE;
/*!40000 ALTER TABLE `disbursement_requests` DISABLE KEYS */;
INSERT INTO `disbursement_requests` VALUES (6,'2023-05-28','Julina Gumanit',NULL,NULL,NULL,NULL,'2023-05-29 21:37:52','2023-05-29 21:37:52');
/*!40000 ALTER TABLE `disbursement_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disbursements`
--

DROP TABLE IF EXISTS `disbursements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disbursements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `request_id` bigint unsigned NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `released_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `particulars` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `voucher_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fund_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `disbursements_request_id_foreign` (`request_id`),
  CONSTRAINT `disbursements_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `disbursement_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disbursements`
--

LOCK TABLES `disbursements` WRITE;
/*!40000 ALTER TABLE `disbursements` DISABLE KEYS */;
INSERT INTO `disbursements` VALUES (8,6,'Love Gift','Stay in','Love Gift',2500.00,'2023-05-29 22:10:39','2023-05-29 22:10:39','CV#2023-00001','2023-05-29','Funded');
/*!40000 ALTER TABLE `disbursements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `donations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `donor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donation_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donation_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donations`
--

LOCK TABLES `donations` WRITE;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
INSERT INTO `donations` VALUES (6,'2023-03-04','Unknown','Non-monetary','Trash bin',NULL,'2023-05-29 23:13:04','2023-05-29 23:13:04');
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Event 1','2023-05-07','Butuan City','Lorem ipsum',1,'2023-05-26 14:44:11','2023-05-28 19:34:48');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `funds`
--

DROP TABLE IF EXISTS `funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `fund` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tithe` double(8,2) DEFAULT NULL,
  `offering` double(8,2) DEFAULT NULL,
  `others` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds`
--

LOCK TABLES `funds` WRITE;
/*!40000 ALTER TABLE `funds` DISABLE KEYS */;
INSERT INTO `funds` VALUES (10,'2023-05-28',5400.00,'2023-05-29 22:03:11','2023-05-30 18:21:35',5200.00,200.00,0.00);
/*!40000 ALTER TABLE `funds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `givers`
--

DROP TABLE IF EXISTS `givers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `givers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `giver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `tithe` double(8,2) DEFAULT NULL,
  `offering` double(8,2) DEFAULT NULL,
  `mission` double(8,2) DEFAULT NULL,
  `sanctuary` double(8,2) DEFAULT NULL,
  `love_gift` double(8,2) DEFAULT NULL,
  `dance_ministry` double(8,2) DEFAULT NULL,
  `is_cash` tinyint(1) DEFAULT '0',
  `is_cheque` tinyint(1) DEFAULT '0',
  `total` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cc_1000` int DEFAULT NULL,
  `cc_500` int DEFAULT NULL,
  `cc_200` int DEFAULT NULL,
  `cc_100` int DEFAULT NULL,
  `cc_50` int DEFAULT NULL,
  `cc_20` int DEFAULT NULL,
  `cc_10` int DEFAULT NULL,
  `cc_5` int DEFAULT NULL,
  `cc_1` int DEFAULT NULL,
  `cc_0_25` double(8,2) DEFAULT NULL,
  `cc_0_1` double(8,2) DEFAULT NULL,
  `cc_0_05` double(8,2) DEFAULT NULL,
  `cc_0_01` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `givers`
--

LOCK TABLES `givers` WRITE;
/*!40000 ALTER TABLE `givers` DISABLE KEYS */;
INSERT INTO `givers` VALUES (33,'Maambong, Allan','2023-05-28',5000.00,NULL,NULL,NULL,NULL,NULL,0,0,5000.00,'2023-05-29 22:03:11','2023-05-29 22:03:11',0,0,0,0,0,0,0,0,0,0.00,0.00,0.00,0.00),(34,'Marissa Inoue','2023-05-28',200.00,200.00,NULL,NULL,NULL,NULL,0,0,400.00,'2023-05-30 18:21:35','2023-05-30 18:21:35',0,0,0,4,0,0,0,0,0,0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `givers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `inventName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ministryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_purchased` date NOT NULL,
  `item_num` int NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'Bass Guitar','Music Ministry','Church Development','2023-05-20',2,23000.00,46000.00,'2023-05-26 14:18:16','2023-05-27 06:39:00');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `birthday` date NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_add` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Daniel Tedor','Danny','Male',22,'1999-12-25','09123456789','Student','Butuan City','danny@gmail.com','2023-05-26 14:14:15','2023-05-26 14:14:15');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_05_23_232152_create_givers_table',1),(6,'2023_05_25_084414_create_schedule_total_table',1),(7,'2023_05_25_084500_create_cash_count_table',1),(8,'2023_05_25_141726_create_members_table',1),(9,'2023_05_25_141847_create_inventory_table',1),(10,'2023_05_25_141923_create_events_table',1),(11,'2023_05_25_142036_create_attendance_table',1),(12,'2023_05_26_150209_create_fund_table',1),(16,'2023_05_27_025644_create_disbursement_requests_table',2),(19,'2023_05_27_025930_create_disbursement_table',3),(20,'2023_05_27_031230_create_donations_table',3),(21,'2023_05_27_122426_create_church_info_table',4),(22,'2023_05_28_140316_modify_cash_counts_fields',5),(23,'2023_05_29_120444_add_fields_to_givers_table',6),(24,'2023_05_30_053147_add_field_to_disbursements_table',7),(25,'2023_05_31_020832_add_fields_to_funds_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'personal-access-token','3cb22c5a642169b60849a7b6f0983ea506d6fafa95548b189097a0857e8a1667','[\"*\"]',NULL,NULL,'2023-05-27 00:04:32','2023-05-27 00:04:32'),(2,'App\\Models\\User',1,'personal-access-token','63c33da88201ee4a7eaa3e2b3e007a023692aa8904e51654894e3ef516b7d0ae','[\"*\"]',NULL,NULL,'2023-05-27 03:39:04','2023-05-27 03:39:04'),(3,'App\\Models\\User',1,'personal-access-token','bb003d01a7501382db36d9f4220dd2662b217370aa80e9d5f0594ab55373a09d','[\"*\"]',NULL,NULL,'2023-05-27 06:19:08','2023-05-27 06:19:08'),(4,'App\\Models\\User',1,'personal-access-token','9c7330ddbaa83798036cbe4562b347e3f58e2febf2582f92d2c241b036ecb714','[\"*\"]',NULL,NULL,'2023-05-28 04:51:49','2023-05-28 04:51:49'),(5,'App\\Models\\User',1,'personal-access-token','5846f30295a27ead201855246fd4f1da71ba2cc17f6419b4faab1dc65d9fa27f','[\"*\"]',NULL,NULL,'2023-05-28 19:03:04','2023-05-28 19:03:04'),(6,'App\\Models\\User',1,'personal-access-token','d91efae796074db3601645769f632e1dffe26a63a0f8983d6f6f2e1e76a6b1b5','[\"*\"]',NULL,NULL,'2023-05-28 22:20:20','2023-05-28 22:20:20'),(7,'App\\Models\\User',1,'personal-access-token','3a9ab568aed3736499a396d0cb5e46ecc8df08f112f1f6d7ead7a94f3c431da0','[\"*\"]',NULL,NULL,'2023-05-28 23:08:45','2023-05-28 23:08:45'),(8,'App\\Models\\User',1,'personal-access-token','ecee315a3f5d1819c84347ad0e39162b0d3a235a9c8685e2ca2a58cea2b07722','[\"*\"]',NULL,NULL,'2023-05-29 16:05:05','2023-05-29 16:05:05'),(9,'App\\Models\\User',1,'personal-access-token','f4c4927de26f29c81724e6314a3eb64d849f9acbc4cc90dfafd889420025a725','[\"*\"]',NULL,NULL,'2023-05-29 18:54:57','2023-05-29 18:54:57'),(10,'App\\Models\\User',1,'personal-access-token','4483cb390d500f393874760b9ca7d5fc2f1990fe432ada6cc3fa26f98856ba9d','[\"*\"]',NULL,NULL,'2023-05-30 17:56:38','2023-05-30 17:56:38');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_totals`
--

DROP TABLE IF EXISTS `schedule_totals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_totals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `tithe` double(8,2) NOT NULL,
  `offering` double(8,2) NOT NULL,
  `mission` double(8,2) NOT NULL,
  `sanctuary` double(8,2) NOT NULL,
  `love_gift` double(8,2) NOT NULL,
  `dance_ministry` double(8,2) NOT NULL,
  `total_cash` double(8,2) NOT NULL,
  `total_cheque` double(8,2) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_totals`
--

LOCK TABLES `schedule_totals` WRITE;
/*!40000 ALTER TABLE `schedule_totals` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_totals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `is_admin` tinyint(1) DEFAULT '0',
  `is_staff1` tinyint(1) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_staff2` tinyint(1) DEFAULT '0' COMMENT 'EMPTY',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'System Administrator','jlycc@gmail.com',NULL,'$2y$10$PEoKjfyUrqH8CLFkqgxOOeg6xtaIzuJT151d290XzDxusGgfaT./i',0,1,0,NULL,'2023-05-26 13:59:57','2023-05-26 13:59:57',0);
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

-- Dump completed on 2023-05-31 10:39:30
