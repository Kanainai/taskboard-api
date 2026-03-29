-- MySQL dump 10.13  Distrib 8.4.8, for Win64 (x86_64)
--
-- Host: localhost    Database: task_manager
-- ------------------------------------------------------
-- Server version	8.4.8

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_03_28_154536_create_tasks_table',1),(2,'2026_03_29_120000_add_assigned_to_to_tasks_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Design homepage','2026-04-02','high','in_progress','Alice','2026-03-28 19:27:15','2026-03-28 20:34:59'),(2,'Fix login bug','2026-03-30','high','done','Bob','2026-03-28 19:27:15','2026-03-28 19:36:45'),(3,'Write unit tests','2026-04-04','medium','pending','Charlie','2026-03-28 19:27:15','2026-03-28 19:27:15'),(4,'Update documentation','2026-04-07','low','pending','Diana','2026-03-28 19:27:15','2026-03-28 19:27:15'),(5,'Code review PR #123','2026-03-29','high','done','Eve','2026-03-28 19:27:15','2026-03-28 20:08:15'),(6,'Refactor authentication','2026-04-11','medium','pending','Alice','2026-03-28 19:27:15','2026-03-28 19:27:15'),(7,'Setup CI/CD pipeline','2026-03-31','high','done','Bob','2026-03-28 19:27:15','2026-03-28 19:57:40'),(8,'Database optimization','2026-04-05','medium','pending','Charlie','2026-03-28 19:27:15','2026-03-28 19:27:15'),(10,'Security audit','2026-04-03','high','pending','Diana','2026-03-28 19:27:15','2026-03-28 19:27:15'),(11,'Mobile responsive fixes','2026-03-27','medium','done','Eve','2026-03-28 19:27:15','2026-03-28 19:36:52'),(12,'API documentation','2026-04-09','low','done','Alice','2026-03-28 19:27:15','2026-03-28 19:27:15'),(13,'Performance testing','2026-04-01','medium','in_progress','Bob','2026-03-28 19:27:15','2026-03-28 19:38:40'),(14,'User feedback analysis','2026-04-06','low','done','Charlie','2026-03-28 19:27:15','2026-03-28 19:27:15'),(18,'Write a proposal','2026-03-29','medium','pending','ROSE MWAU','2026-03-28 19:38:06','2026-03-28 19:38:06'),(19,'Make A hero page','2026-03-29','medium','pending','Rose Mwau','2026-03-28 20:42:14','2026-03-28 20:42:14'),(20,'FINISH DOCUMENTATION','2026-03-29','high','pending','ROSE MWAU','2026-03-28 23:25:23','2026-03-28 23:25:23');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-29  5:31:08
