
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ap_project
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@school.com','$2y$12$PCTDkNRR.mTXPjbiHcE86uQ6RwyvSbEhaodms8uSsMlQpOCclvlHq','ADM001','2026-04-13 05:21:34','2026-04-13 05:21:34');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
  `expiration` int NOT NULL,
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
-- Table structure for table `class_student`
--

DROP TABLE IF EXISTS `class_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_student` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_student_class_id_student_id_unique` (`class_id`,`student_id`),
  KEY `class_student_student_id_foreign` (`student_id`),
  CONSTRAINT `class_student_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `class_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_student`
--

LOCK TABLES `class_student` WRITE;
/*!40000 ALTER TABLE `class_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Araling Panlipunan',
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Grade 10',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classes_class_code_unique` (`class_code`),
  KEY `classes_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `classes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
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
-- Table structure for table `game_sessions`
--

DROP TABLE IF EXISTS `game_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_points` int NOT NULL DEFAULT '0',
  `correct_answers` int NOT NULL DEFAULT '0',
  `total_questions` int NOT NULL DEFAULT '0',
  `status` enum('started','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'started',
  `started_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_sessions_quiz_id_foreign` (`quiz_id`),
  KEY `game_sessions_student_id_foreign` (`student_id`),
  CONSTRAINT `game_sessions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `game_sessions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_sessions`
--

LOCK TABLES `game_sessions` WRITE;
/*!40000 ALTER TABLE `game_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_sessions` ENABLE KEYS */;
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
  `attempts` tinyint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000001_create_students_table',1),(5,'2024_01_01_000002_create_teachers_table',1),(6,'2024_01_01_000003_create_admins_table',1),(7,'2024_01_02_000001_create_classes_table',1),(8,'2024_01_02_000002_create_class_student_table',1),(9,'2024_01_02_000003_create_quizzes_table',1),(10,'2024_01_02_000004_create_questions_table',1),(11,'2024_01_02_000005_create_question_options_table',1),(12,'2024_01_02_000006_create_game_sessions_table',1),(13,'2024_01_02_000007_create_student_scores_table',1),(14,'2024_01_03_000001_add_profile_fields_to_teachers',1),(15,'2024_04_08_000001_create_module3_performance_tasks_table',1),(16,'2026_01_01_000101_create_module4_poll_table',1),(17,'2026_01_01_000102_create_module4_pretest_table',1),(18,'2026_01_01_000103_create_module4_pretest_answers_table',1),(19,'2026_01_01_000104_create_module4_balikaral_table',1),(20,'2026_01_01_000105_create_module4_explore_table',1),(21,'2026_01_01_000106_create_module4_game_results_table',1),(22,'2026_04_04_071613_module2_pretest_table',1),(23,'2026_04_04_071638_module2_pretest_answers_table',1),(24,'2026_04_04_092236_module2_node1_table',1),(25,'2026_04_04_124455_module2_node2_table',1),(26,'2026_04_04_141434_module2_node3_table',1),(27,'2026_04_05_034453_module2_final_activity_table',1),(28,'2026_04_05_034523_module2_final_activity_answers_table',1),(29,'2026_04_05_055555_module2_posttest_table',1),(30,'2026_04_05_055642_module2_posttest_answers_table',1),(31,'2026_04_05_083251_module2_essay_table',1),(32,'2026_04_08_060000_fix_students_avatar_enum_values',1),(33,'2026_04_10_014449_module3_pretest_table',1),(34,'2026_04_10_014516_module3_pretest_answers_table',1),(35,'2026_04_11_053416_module3_node2_table',1),(36,'2026_04_11_065834_module3_node1_table',1),(37,'2026_04_11_112617_module3_node3_table',1),(38,'2026_04_11_115453_module3_gobagact_table',1),(39,'2026_04_11_131337_module3_safehome_table',1),(40,'2026_04_11_133239_module3_gabay_table',1),(41,'2026_04_11_140311_module3_elnino_table',1),(42,'2026_04_11_142059_module3_bulkan_table',1),(43,'2026_04_11_143433_module3_flood_table',1),(44,'2026_04_11_151212_module3_posttest_table',1),(45,'2026_04_11_153727_module3_lindol_table',1),(46,'2026_04_12_023154_module3_balikaral_table',1),(47,'2026_04_12_025502_module3_explore_table',1),(48,'2026_04_13_024253_module4_performance_table',1),(49,'2026_04_13_051521_module4_posttest_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_essay_table`
--

DROP TABLE IF EXISTS `module2_essay_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_essay_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `essay_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_essay_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_essay_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_essay_table`
--

LOCK TABLES `module2_essay_table` WRITE;
/*!40000 ALTER TABLE `module2_essay_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_essay_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_final_activity_answers_table`
--

DROP TABLE IF EXISTS `module2_final_activity_answers_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_final_activity_answers_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module2_final_activity_id` bigint unsigned NOT NULL,
  `scenario_number` int NOT NULL,
  `choice_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected` tinyint(1) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m2_final_answers_fk` (`module2_final_activity_id`),
  CONSTRAINT `m2_final_answers_fk` FOREIGN KEY (`module2_final_activity_id`) REFERENCES `module2_final_activity_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_final_activity_answers_table`
--

LOCK TABLES `module2_final_activity_answers_table` WRITE;
/*!40000 ALTER TABLE `module2_final_activity_answers_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_final_activity_answers_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_final_activity_table`
--

DROP TABLE IF EXISTS `module2_final_activity_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_final_activity_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `total_xp` int NOT NULL,
  `score` int NOT NULL,
  `total_questions` int NOT NULL,
  `correct_answers` int NOT NULL,
  `time_taken` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_final_activity_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_final_activity_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_final_activity_table`
--

LOCK TABLES `module2_final_activity_table` WRITE;
/*!40000 ALTER TABLE `module2_final_activity_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_final_activity_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_node1_table`
--

DROP TABLE IF EXISTS `module2_node1_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_node1_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `problem_number` int NOT NULL,
  `sanhi_image` text COLLATE utf8mb4_unicode_ci,
  `sanhi_text` text COLLATE utf8mb4_unicode_ci,
  `bunga_image` text COLLATE utf8mb4_unicode_ci,
  `bunga_text` text COLLATE utf8mb4_unicode_ci,
  `solusyon_image` text COLLATE utf8mb4_unicode_ci,
  `solusyon_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_node1_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_node1_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_node1_table`
--

LOCK TABLES `module2_node1_table` WRITE;
/*!40000 ALTER TABLE `module2_node1_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_node1_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_node2_table`
--

DROP TABLE IF EXISTS `module2_node2_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_node2_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `problem_number` int NOT NULL,
  `sanhi` text COLLATE utf8mb4_unicode_ci,
  `bunga` text COLLATE utf8mb4_unicode_ci,
  `solusyon` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_node2_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_node2_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_node2_table`
--

LOCK TABLES `module2_node2_table` WRITE;
/*!40000 ALTER TABLE `module2_node2_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_node2_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_node3_table`
--

DROP TABLE IF EXISTS `module2_node3_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_node3_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `problem_number` int NOT NULL,
  `sanhi` text COLLATE utf8mb4_unicode_ci,
  `bunga` text COLLATE utf8mb4_unicode_ci,
  `solusyon` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_node3_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_node3_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_node3_table`
--

LOCK TABLES `module2_node3_table` WRITE;
/*!40000 ALTER TABLE `module2_node3_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_node3_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_posttest_answers_table`
--

DROP TABLE IF EXISTS `module2_posttest_answers_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_posttest_answers_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module2_posttest_id` bigint unsigned NOT NULL,
  `question_number` int NOT NULL,
  `selected_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_posttest_answers_table_module2_posttest_id_foreign` (`module2_posttest_id`),
  CONSTRAINT `module2_posttest_answers_table_module2_posttest_id_foreign` FOREIGN KEY (`module2_posttest_id`) REFERENCES `module2_posttest_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_posttest_answers_table`
--

LOCK TABLES `module2_posttest_answers_table` WRITE;
/*!40000 ALTER TABLE `module2_posttest_answers_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_posttest_answers_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_posttest_table`
--

DROP TABLE IF EXISTS `module2_posttest_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_posttest_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL,
  `percentage` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_posttest_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_posttest_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_posttest_table`
--

LOCK TABLES `module2_posttest_table` WRITE;
/*!40000 ALTER TABLE `module2_posttest_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_posttest_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_pretest_answers_table`
--

DROP TABLE IF EXISTS `module2_pretest_answers_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_pretest_answers_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module2_pretest_id` bigint unsigned NOT NULL,
  `question_number` int NOT NULL,
  `selected_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_pretest_answers_table_module2_pretest_id_foreign` (`module2_pretest_id`),
  CONSTRAINT `module2_pretest_answers_table_module2_pretest_id_foreign` FOREIGN KEY (`module2_pretest_id`) REFERENCES `module2_pretest_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_pretest_answers_table`
--

LOCK TABLES `module2_pretest_answers_table` WRITE;
/*!40000 ALTER TABLE `module2_pretest_answers_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_pretest_answers_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module2_pretest_table`
--

DROP TABLE IF EXISTS `module2_pretest_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module2_pretest_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL,
  `percentage` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module2_pretest_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module2_pretest_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module2_pretest_table`
--

LOCK TABLES `module2_pretest_table` WRITE;
/*!40000 ALTER TABLE `module2_pretest_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module2_pretest_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_balikaral_table`
--

DROP TABLE IF EXISTS `module3_balikaral_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_balikaral_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `correct_answers` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '3',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `time_spent` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_balikaral_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_balikaral_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_balikaral_table`
--

LOCK TABLES `module3_balikaral_table` WRITE;
/*!40000 ALTER TABLE `module3_balikaral_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_balikaral_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_bulkan_table`
--

DROP TABLE IF EXISTS `module3_bulkan_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_bulkan_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `selected_answers` json DEFAULT NULL,
  `total_correct` int NOT NULL DEFAULT '4',
  `total_items` int NOT NULL DEFAULT '7',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_bulkan_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_bulkan_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_bulkan_table`
--

LOCK TABLES `module3_bulkan_table` WRITE;
/*!40000 ALTER TABLE `module3_bulkan_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_bulkan_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_elnino_table`
--

DROP TABLE IF EXISTS `module3_elnino_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_elnino_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `zone1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_elnino_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_elnino_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_elnino_table`
--

LOCK TABLES `module3_elnino_table` WRITE;
/*!40000 ALTER TABLE `module3_elnino_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_elnino_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_explore_table`
--

DROP TABLE IF EXISTS `module3_explore_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_explore_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `xp` int NOT NULL DEFAULT '0',
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_explore_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_explore_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_explore_table`
--

LOCK TABLES `module3_explore_table` WRITE;
/*!40000 ALTER TABLE `module3_explore_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_explore_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_flood_table`
--

DROP TABLE IF EXISTS `module3_flood_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_flood_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `hp_remaining` int NOT NULL DEFAULT '100',
  `total_questions` int NOT NULL DEFAULT '19',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `is_game_over` tinyint(1) NOT NULL DEFAULT '0',
  `answers` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_flood_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_flood_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_flood_table`
--

LOCK TABLES `module3_flood_table` WRITE;
/*!40000 ALTER TABLE `module3_flood_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_flood_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_gabay_table`
--

DROP TABLE IF EXISTS `module3_gabay_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_gabay_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '12',
  `accuracy` double DEFAULT NULL,
  `performance_level` enum('excellent','good','needs_improvement') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placements` json DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_gabay_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_gabay_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_gabay_table`
--

LOCK TABLES `module3_gabay_table` WRITE;
/*!40000 ALTER TABLE `module3_gabay_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_gabay_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_gobagact_table`
--

DROP TABLE IF EXISTS `module3_gobagact_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_gobagact_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '10',
  `time_taken` int DEFAULT NULL,
  `rating` enum('excellent','good','needs_improvement') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_gobagact_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_gobagact_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_gobagact_table`
--

LOCK TABLES `module3_gobagact_table` WRITE;
/*!40000 ALTER TABLE `module3_gobagact_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_gobagact_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_lindol_table`
--

DROP TABLE IF EXISTS `module3_lindol_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_lindol_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '0',
  `correct_items` int NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `time_spent` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_lindol_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_lindol_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_lindol_table`
--

LOCK TABLES `module3_lindol_table` WRITE;
/*!40000 ALTER TABLE `module3_lindol_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_lindol_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_node1_table`
--

DROP TABLE IF EXISTS `module3_node1_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_node1_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '4',
  `accuracy` double DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_node1_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_node1_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_node1_table`
--

LOCK TABLES `module3_node1_table` WRITE;
/*!40000 ALTER TABLE `module3_node1_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_node1_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_node2_table`
--

DROP TABLE IF EXISTS `module3_node2_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_node2_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `chosen_side` enum('top','bottom') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int NOT NULL DEFAULT '0',
  `lives_remaining` int NOT NULL DEFAULT '3',
  `is_passed` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_node2_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_node2_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_node2_table`
--

LOCK TABLES `module3_node2_table` WRITE;
/*!40000 ALTER TABLE `module3_node2_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_node2_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_node3_table`
--

DROP TABLE IF EXISTS `module3_node3_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_node3_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `final_budget` int NOT NULL DEFAULT '0',
  `safety_score` int NOT NULL DEFAULT '0',
  `status` enum('not_ready','partially_ready','ready') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_ready',
  `selected_strategies` json DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_node3_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_node3_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_node3_table`
--

LOCK TABLES `module3_node3_table` WRITE;
/*!40000 ALTER TABLE `module3_node3_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_node3_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_performance_tasks`
--

DROP TABLE IF EXISTS `module3_performance_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_performance_tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `badges_earned` json DEFAULT NULL,
  `completion_time` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_performance_tasks_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_performance_tasks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_performance_tasks`
--

LOCK TABLES `module3_performance_tasks` WRITE;
/*!40000 ALTER TABLE `module3_performance_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_performance_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_posttest_table`
--

DROP TABLE IF EXISTS `module3_posttest_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_posttest_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '15',
  `performance_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_passed` tinyint(1) NOT NULL DEFAULT '0',
  `answers` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_posttest_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_posttest_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_posttest_table`
--

LOCK TABLES `module3_posttest_table` WRITE;
/*!40000 ALTER TABLE `module3_posttest_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_posttest_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_pretest_answers`
--

DROP TABLE IF EXISTS `module3_pretest_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_pretest_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module3_pretest_id` bigint unsigned NOT NULL,
  `question_number` int NOT NULL,
  `selected_answer` int DEFAULT NULL,
  `correct_answer` int NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_pretest_answers_module3_pretest_id_foreign` (`module3_pretest_id`),
  CONSTRAINT `module3_pretest_answers_module3_pretest_id_foreign` FOREIGN KEY (`module3_pretest_id`) REFERENCES `module3_pretests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_pretest_answers`
--

LOCK TABLES `module3_pretest_answers` WRITE;
/*!40000 ALTER TABLE `module3_pretest_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_pretest_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_pretests`
--

DROP TABLE IF EXISTS `module3_pretests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_pretests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `percentage` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_pretests_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_pretests_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_pretests`
--

LOCK TABLES `module3_pretests` WRITE;
/*!40000 ALTER TABLE `module3_pretests` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_pretests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module3_safehome_table`
--

DROP TABLE IF EXISTS `module3_safehome_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module3_safehome_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `correct_count` int NOT NULL DEFAULT '0',
  `wrong_count` int NOT NULL DEFAULT '0',
  `total_clicks` int NOT NULL DEFAULT '0',
  `is_perfect` tinyint(1) NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `selected_options` json DEFAULT NULL,
  `attempts` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module3_safehome_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module3_safehome_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module3_safehome_table`
--

LOCK TABLES `module3_safehome_table` WRITE;
/*!40000 ALTER TABLE `module3_safehome_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module3_safehome_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_balikaral_table`
--

DROP TABLE IF EXISTS `module4_balikaral_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_balikaral_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int unsigned NOT NULL DEFAULT '0',
  `correct_answers` int unsigned NOT NULL DEFAULT '0',
  `total_items` int unsigned NOT NULL DEFAULT '0',
  `time_spent` int unsigned NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module4_balikaral_table_student_id_unique` (`student_id`),
  CONSTRAINT `module4_balikaral_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_balikaral_table`
--

LOCK TABLES `module4_balikaral_table` WRITE;
/*!40000 ALTER TABLE `module4_balikaral_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_balikaral_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_explore_table`
--

DROP TABLE IF EXISTS `module4_explore_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_explore_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `completed_stories` json DEFAULT NULL,
  `progress_percent` int unsigned NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module4_explore_table_student_id_unique` (`student_id`),
  CONSTRAINT `module4_explore_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_explore_table`
--

LOCK TABLES `module4_explore_table` WRITE;
/*!40000 ALTER TABLE `module4_explore_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_explore_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_game_results_table`
--

DROP TABLE IF EXISTS `module4_game_results_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_game_results_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `game_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int unsigned NOT NULL DEFAULT '0',
  `total_items` int unsigned NOT NULL DEFAULT '0',
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module4_game_results_table_student_id_game_type_unique` (`student_id`,`game_type`),
  CONSTRAINT `module4_game_results_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_game_results_table`
--

LOCK TABLES `module4_game_results_table` WRITE;
/*!40000 ALTER TABLE `module4_game_results_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_game_results_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_performance_table`
--

DROP TABLE IF EXISTS `module4_performance_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_performance_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `reflection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_submitted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module4_performance_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module4_performance_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_performance_table`
--

LOCK TABLES `module4_performance_table` WRITE;
/*!40000 ALTER TABLE `module4_performance_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_performance_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_poll_table`
--

DROP TABLE IF EXISTS `module4_poll_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_poll_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `selected_options` json DEFAULT NULL,
  `selected_count` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module4_poll_table_student_id_unique` (`student_id`),
  CONSTRAINT `module4_poll_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_poll_table`
--

LOCK TABLES `module4_poll_table` WRITE;
/*!40000 ALTER TABLE `module4_poll_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_poll_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_posttest_table`
--

DROP TABLE IF EXISTS `module4_posttest_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_posttest_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int NOT NULL,
  `total_items` int NOT NULL DEFAULT '15',
  `status` enum('passed','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `answers` json DEFAULT NULL,
  `attempt` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module4_posttest_table_student_id_foreign` (`student_id`),
  CONSTRAINT `module4_posttest_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_posttest_table`
--

LOCK TABLES `module4_posttest_table` WRITE;
/*!40000 ALTER TABLE `module4_posttest_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_posttest_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_pretest_answers_table`
--

DROP TABLE IF EXISTS `module4_pretest_answers_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_pretest_answers_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module4_pretest_id` bigint unsigned NOT NULL,
  `question_number` int unsigned NOT NULL,
  `selected_option` int unsigned NOT NULL,
  `correct_option` int unsigned NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pretest_answer_idx` (`module4_pretest_id`,`question_number`),
  CONSTRAINT `module4_pretest_answers_table_module4_pretest_id_foreign` FOREIGN KEY (`module4_pretest_id`) REFERENCES `module4_pretest_table` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_pretest_answers_table`
--

LOCK TABLES `module4_pretest_answers_table` WRITE;
/*!40000 ALTER TABLE `module4_pretest_answers_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_pretest_answers_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module4_pretest_table`
--

DROP TABLE IF EXISTS `module4_pretest_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module4_pretest_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `score` int unsigned NOT NULL DEFAULT '0',
  `total_items` int unsigned NOT NULL DEFAULT '0',
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module4_pretest_table_student_id_unique` (`student_id`),
  CONSTRAINT `module4_pretest_table_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module4_pretest_table`
--

LOCK TABLES `module4_pretest_table` WRITE;
/*!40000 ALTER TABLE `module4_pretest_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `module4_pretest_table` ENABLE KEYS */;
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
-- Table structure for table `question_options`
--

DROP TABLE IF EXISTS `question_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_options_question_id_foreign` (`question_id`),
  CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_options`
--

LOCK TABLES `question_options` WRITE;
/*!40000 ALTER TABLE `question_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `extra_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('pre_test','quiz') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'quiz',
  `game_format` enum('mcq','drag_drop','fill_blank','word_scramble') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mcq',
  `time_limit` int DEFAULT NULL COMMENT 'in minutes, null = no limit',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizzes_class_id_foreign` (`class_id`),
  KEY `quizzes_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `quizzes_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quizzes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_scores`
--

DROP TABLE IF EXISTS `student_scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_scores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game_session_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `student_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `points_earned` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_scores_game_session_id_foreign` (`game_session_id`),
  KEY `student_scores_question_id_foreign` (`question_id`),
  CONSTRAINT `student_scores_game_session_id_foreign` FOREIGN KEY (`game_session_id`) REFERENCES `game_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_scores_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_scores`
--

LOCK TABLES `student_scores` WRITE;
/*!40000 ALTER TABLE `student_scores` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` enum('boy_uniform','girl_uniform') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_played` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` enum('teacher_male','teacher_female','scientist','explorer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teacher_male',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `subject_specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,'Teacher Juan','teacher@school.com','$2y$12$E61dvN9Cf7w.RA3OFJI7jue8RnCwfRFiitI8EjRvZldaZo32aQOLW','TCH001','teacher_male','male',NULL,NULL,NULL,NULL,1,'2026-04-13 05:21:34','2026-04-13 05:21:34');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-04-13 21:23:10
