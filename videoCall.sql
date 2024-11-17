-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: user_registration
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `issue` varchar(255) DEFAULT NULL,
  `description` text,
  `username` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (1,'report','ggagag','bed1ve','2024-11-17 10:22:32'),(2,'report','fafaf','bed1ve','2024-11-17 10:23:31'),(3,'report','gaga','bed1ve','2024-11-17 10:26:09'),(4,'report','gaga','bed1ve','2024-11-17 10:26:10'),(5,'report','gaga','bed1ve','2024-11-17 10:26:11'),(6,'report','gaga','bed1ve','2024-11-17 10:26:16'),(7,'report','gaga','bed1ve','2024-11-17 10:26:59'),(8,'report','gaga','bed1ve','2024-11-17 10:27:00'),(9,'report','gaga','bed1ve','2024-11-17 10:27:00'),(10,'report','gaga','bed1ve','2024-11-17 10:27:19'),(11,'report','gaga','bed1ve','2024-11-17 10:28:21'),(12,'report','gaga','bed1ve','2024-11-17 10:28:24'),(13,'report','gfffff','bed1ve','2024-11-17 10:28:43'),(14,'report','gfffff','bed1ve','2024-11-17 10:33:42'),(15,'report','fafaf','bed1ve','2024-11-17 10:33:49'),(16,'report','gagag','bed1ve','2024-11-17 10:49:06'),(17,'report','gsg','bed1ve','2024-11-17 10:53:05'),(18,'report','fff','bed1ve','2024-11-17 10:55:38'),(19,'suggest','gff','bed1ve','2024-11-17 12:19:19'),(20,'suggest','gff','bed1ve','2024-11-17 12:20:53'),(21,'report','fff','bed1ve','2024-11-17 12:21:36'),(22,'report','fff','bed1ve','2024-11-17 12:22:52'),(23,'report','fff','bed1ve','2024-11-17 12:26:02'),(24,'report','vv','bed1ve','2024-11-17 12:26:11'),(25,'report','vv','bed1ve','2024-11-17 12:28:36'),(26,'report','fff','bed1ve','2024-11-17 12:33:35'),(27,'report','vv','bed1ve','2024-11-17 12:39:31'),(28,'report','vv','bed1ve','2024-11-17 12:44:05'),(29,'report','bb','bed1ve','2024-11-17 12:45:36'),(30,'report','bbb','bed1ve','2024-11-17 12:45:46'),(31,'report','ff','bed1ve','2024-11-17 12:52:26'),(32,'report','ffff','bed1ve','2024-11-17 13:05:56'),(33,'report','ffff','bed1ve','2024-11-17 13:11:35'),(34,'report','ffff','bed1ve','2024-11-17 13:11:50');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(13) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` text,
  `token` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('bed1ve','bed1ve','trungnguyen210504@gmail.com','$2y$10$duLPnqVXmH32kTO75cRKx.yuiT3END3XPX2Xe3ftiGRwQF8jc7kc.',NULL,'921308','2024-11-11 13:32:59');
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

-- Dump completed on 2024-11-17 21:52:14
