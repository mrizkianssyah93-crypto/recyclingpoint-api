-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: recycling_Point
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
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
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2026_05_14_223228_add_email_to_users_table',2),(4,'2026_05_15_143809_add_total_harga_to_store_transactions_table',3),(5,'2026_05_15_150801_add_main_category_to_waste_categories_table',4),(6,'2026_06_05_173411_create_waste_banks_table',5),(7,'2026_06_06_050428_add_verification_code_to_users_table',5),(8,'2026_06_06_050809_add_email_verification_fields_to_users_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_request_details`
--

DROP TABLE IF EXISTS `pickup_request_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pickup_request_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pickup_id` int NOT NULL,
  `category_id` int NOT NULL,
  `estimasi_berat` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pickup_id` (`pickup_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `pickup_request_details_ibfk_1` FOREIGN KEY (`pickup_id`) REFERENCES `pickup_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pickup_request_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `waste_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_request_details`
--

LOCK TABLES `pickup_request_details` WRITE;
/*!40000 ALTER TABLE `pickup_request_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `pickup_request_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_requests`
--

DROP TABLE IF EXISTS `pickup_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pickup_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tanggal_pickup` date NOT NULL,
  `waktu_pickup` varchar(50) DEFAULT NULL,
  `catatan` text,
  `estimasi_poin` int DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `berat_real` double DEFAULT NULL,
  `waste_bank_name` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text,
  `nomor_hp` varchar(30) DEFAULT NULL,
  `waste_category_id` bigint DEFAULT NULL,
  `estimasi_berat` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pickup_time` varchar(50) DEFAULT NULL,
  `distance_km` double DEFAULT '0',
  `ongkir` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pickup_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_requests`
--

LOCK TABLES `pickup_requests` WRITE;
/*!40000 ALTER TABLE `pickup_requests` DISABLE KEYS */;
INSERT INTO `pickup_requests` VALUES (1,6,'2026-05-20',NULL,NULL,0,'completed','2026-05-14 09:29:01',NULL,'Bank Sampah Induk Satu Hati Jakarta Barat','sssssss',NULL,1,5,'2026-05-15 07:42:13',NULL,0,0),(2,6,'2026-05-21',NULL,NULL,0,'completed','2026-05-14 10:16:08',NULL,'Bank Sampah Induk Satu Hati Jakarta Barat','ubsi slipi',NULL,3,26,'2026-05-15 06:02:31','08:00 - 10:00',NULL,0),(3,6,'2026-05-22',NULL,NULL,0,'completed','2026-05-14 14:18:14',NULL,'Bank Sampah Emas 06','slipi jaya',NULL,3,5,'2026-05-15 06:02:07','08:00 - 10:00',7.5,0),(5,6,'2026-05-19',NULL,NULL,0,'completed','2026-05-15 07:41:42',NULL,'Tempat Pembuangan Sementara (TPS) Slipi','slipi jaya','0812313213321',2,18,'2026-05-15 07:42:06','15:00 - 17:00',4.1,0),(10,9,'2026-05-16',NULL,NULL,0,'pending','2026-05-15 09:22:37',NULL,'Bank Sampah Swadaya Jakarta','jln tambora','0812313213321',5,15,'2026-05-15 09:26:12','15:00 - 17:00',856.4,0),(11,9,'2026-05-16',NULL,NULL,0,'process','2026-05-15 09:22:58',NULL,'Bank Sampah Swadaya Jakarta','jln tambora','085819624404',2,5,'2026-06-11 09:07:44','15:00 - 17:00',856.4,0),(14,6,'2026-06-12',NULL,NULL,0,'completed','2026-06-11 09:03:20',NULL,'Tempat Pembuangan Sementara (TPS) Slipi','slipi jaya','0812313213321',5,21,'2026-06-13 00:48:05','08:00 - 10:00',3.8,0),(15,21,'2026-06-14',NULL,NULL,0,'completed','2026-06-13 00:45:15',NULL,'Tempat Pembuangan Sementara (TPS) Slipi','tomang','085819624404',5,12,'2026-06-13 00:48:01','08:00 - 10:00',4.5,0);
/*!40000 ALTER TABLE `pickup_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_result_details`
--

DROP TABLE IF EXISTS `pickup_result_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pickup_result_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `result_id` int NOT NULL,
  `category_id` int NOT NULL,
  `berat_real` decimal(10,2) DEFAULT NULL,
  `poin` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `result_id` (`result_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `pickup_result_details_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `pickup_results` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pickup_result_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `waste_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_result_details`
--

LOCK TABLES `pickup_result_details` WRITE;
/*!40000 ALTER TABLE `pickup_result_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `pickup_result_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickup_results`
--

DROP TABLE IF EXISTS `pickup_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pickup_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pickup_id` int NOT NULL,
  `petugas_id` int NOT NULL,
  `total_poin` int DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pickup_id` (`pickup_id`),
  KEY `petugas_id` (`petugas_id`),
  CONSTRAINT `pickup_results_ibfk_1` FOREIGN KEY (`pickup_id`) REFERENCES `pickup_requests` (`id`),
  CONSTRAINT `pickup_results_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickup_results`
--

LOCK TABLES `pickup_results` WRITE;
/*!40000 ALTER TABLE `pickup_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `pickup_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_histories`
--

DROP TABLE IF EXISTS `point_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `point_histories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `transaksi_type` enum('store','pickup') NOT NULL,
  `reference_id` int NOT NULL,
  `poin` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `point_histories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_histories`
--

LOCK TABLES `point_histories` WRITE;
/*!40000 ALTER TABLE `point_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_redemptions`
--

DROP TABLE IF EXISTS `point_redemptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `point_redemptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `voucher_id` int DEFAULT NULL,
  `poin_used` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_redemptions`
--

LOCK TABLES `point_redemptions` WRITE;
/*!40000 ALTER TABLE `point_redemptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_redemptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_transaction_details`
--

DROP TABLE IF EXISTS `store_transaction_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_transaction_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `category_id` int NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `poin` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `store_transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `store_transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `store_transaction_details_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `waste_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_transaction_details`
--

LOCK TABLES `store_transaction_details` WRITE;
/*!40000 ALTER TABLE `store_transaction_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_transaction_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_transactions`
--

DROP TABLE IF EXISTS `store_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `waste_category_id` bigint DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `total_poin` int DEFAULT '0',
  `status` enum('pending','completed') DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_harga` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `store_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_transactions`
--

LOCK TABLES `store_transactions` WRITE;
/*!40000 ALTER TABLE `store_transactions` DISABLE KEYS */;
INSERT INTO `store_transactions` VALUES (1,3,1,20,200,'completed','2026-05-14 07:16:58','2026-05-14 07:16:58',0),(6,21,5,12,210,'completed','2026-06-13 00:48:01','2026-06-13 00:48:01',21000),(7,6,5,21,368,'completed','2026-06-13 00:48:05','2026-06-13 00:48:05',36750);
/*!40000 ALTER TABLE `store_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_logs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `activity` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_logs` (`user_id`),
  CONSTRAINT `fk_user_logs` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logs`
--

LOCK TABLES `user_logs` WRITE;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','operation','user') NOT NULL DEFAULT 'user',
  `qr_code` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `poin` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `failed_login_attempt` int NOT NULL DEFAULT '0',
  `last_login_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idx_role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin',NULL,NULL,NULL,'$2y$12$QJ9n9E/i3XjEB1p5d0RWAu0/CsQU/39B9vnhbLki6h00jjBlOIWvy','admin',NULL,NULL,NULL,0,'2026-05-14 11:56:57','2026-05-14 14:13:01',1,0,NULL),(3,'Muhammad Rizkiansyah maulana','Rizkiansyah',NULL,NULL,NULL,'$2y$12$Fad3vMXgcRlXrSuqGF0S9eFZMZZjpGWUwXj2EtuwIF6rSGyPNd3ga','user',NULL,NULL,NULL,1400,'2026-05-14 06:59:16','2026-05-14 07:16:58',1,0,NULL),(5,'User1','operator',NULL,NULL,NULL,'$2y$12$yR4qE9T7wbw.J0MR7yFiJumH8Ql3d97Ilg9P/IMO/JskLebLM3LKC','operation',NULL,NULL,NULL,0,'2026-05-14 07:39:46','2026-05-14 07:39:46',1,0,NULL),(6,'User','Customer',NULL,NULL,NULL,'$2y$12$MVGpSHMqHIuRMF2XSNdk7..OwuthMXQzY80kGHffUV8rcwp60qGIy','user',NULL,NULL,NULL,368,'2026-05-14 07:41:55','2026-06-13 00:48:05',1,0,NULL),(9,'Zahra Aqilah','zahraqilaah@gmail.com','zahraqilaah@gmail.com',NULL,NULL,'$2y$12$k.DrpU8hEg5SMserCvpdfOQmZYNt1Od1MhjpJRBJ51n17m.L9Otcm','user',NULL,NULL,NULL,0,'2026-05-15 08:42:21','2026-06-05 11:14:07',1,0,NULL),(16,'muhammadardhika307','muhammadardhika307123','muhammadardhika307@gmail.com',NULL,NULL,'$2y$12$72UTXPH3S6zDdKCkMTc7Q.o69M5fOJIdR8XfLEZE1tFOegJN5qsya','user',NULL,NULL,NULL,0,'2026-06-06 02:24:29','2026-06-06 02:24:29',1,0,NULL),(20,'rizkiansyah maulana','mrizkianssyah93@gmail.com','mrizkianssyah93@gmail.com',NULL,NULL,'$2y$12$3.NZ6j9e5mgiIqCCa048Uuk9.V75ZY8WghH5iOnNqWZO3suq5iEb2','user',NULL,NULL,NULL,0,'2026-06-11 09:19:56','2026-06-12 11:33:43',1,0,NULL),(21,'Nur Aini','nur.nii@bsi.ac.id','nur.nii@bsi.ac.id',NULL,NULL,'$2y$12$mUJtyRDgveYqkKED.e7bLeHm7BctBnRd3Uxtb7zH69R6yVtx0U026','user',NULL,NULL,NULL,0,'2026-06-13 00:40:50','2026-06-13 02:49:33',1,0,NULL),(22,'rafiq21pagi','rafiq21pagi191','rafiq21pagi@gmail.com',NULL,NULL,'$2y$12$AXf5YOnqa9K1usqKkAagV.R9Trw.PYMGUARKDLOnUgQczl.rpGN/y','user',NULL,NULL,NULL,0,'2026-06-13 02:47:13','2026-06-13 02:47:13',1,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vouchers`
--

DROP TABLE IF EXISTS `vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vouchers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `poin` int DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vouchers`
--

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;
INSERT INTO `vouchers` VALUES (1,'Steam Wallet','Game',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(2,'PUBG UC','Game',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(3,'Mobile Legends','Game',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(4,'McDonalds','Food',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(5,'Starbucks','Food',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(6,'Burger King','Food',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(7,'Shopee','Shopping',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(8,'Tokopedia','Shopping',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36'),(9,'Indomaret','Shopping',500,NULL,'2026-05-14 15:36:36','2026-05-14 15:36:36');
/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waste_banks`
--

DROP TABLE IF EXISTS `waste_banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `waste_banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waste_banks`
--

LOCK TABLES `waste_banks` WRITE;
/*!40000 ALTER TABLE `waste_banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `waste_banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waste_categories`
--

DROP TABLE IF EXISTS `waste_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `waste_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `poin_per_kg` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `harga_per_kg` double DEFAULT '0',
  `main_category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waste_categories`
--

LOCK TABLES `waste_categories` WRITE;
/*!40000 ALTER TABLE `waste_categories` DISABLE KEYS */;
INSERT INTO `waste_categories` VALUES (5,'Tembaga',1750,'2026-05-14 17:39:00',175000,'Metal'),(6,'Kuningan',900,'2026-05-14 17:39:00',90000,'Metal'),(7,'Aluminium',300,'2026-05-14 17:39:00',30000,'Metal'),(8,'Besi Campur',45,'2026-05-14 17:39:00',4500,'Metal'),(9,'Botol Plastik PET',30,'2026-05-14 17:39:00',3000,'Plastic'),(10,'Gelas Plastik Bening',37,'2026-05-14 17:39:00',3700,'Plastic'),(11,'Gelas Plastik Campur',18,'2026-05-14 17:39:00',1800,'Plastic'),(12,'Tutup Botol Plastik',45,'2026-05-14 17:39:00',4500,'Plastic'),(13,'Plastik PP Putih',14,'2026-05-14 17:39:00',1400,'Plastic'),(14,'Kardus',25,'2026-05-14 17:39:00',2500,'Paper'),(15,'Kertas Koran',10,'2026-05-14 17:39:00',1000,'Paper'),(16,'Kertas Dupleks',5,'2026-05-14 17:39:00',500,'Paper'),(17,'Botol Kaca Bening',8,'2026-05-14 17:39:00',800,'Glass'),(18,'Botol Kaca Campur',4,'2026-05-14 17:39:00',400,'Glass');
/*!40000 ALTER TABLE `waste_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-13 17:00:54
