-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: user_registration
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(13) COLLATE utf8mb3_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb3_unicode_ci,
  `token` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('225112','225112','2252113@ut.edu.vn','$2y$10$s2OGZUXR.TR0Hsz1H0RM3ugXWWfvZpbIxz8h.eW0Ka6VdRhYXncWO',NULL,NULL,'2024-10-30 17:43:42'),('2251120113','2251120113','thang17102015@gmail.com','$2y$10$PZcnBzaWNYEnd0jg.YYf4.oZidjzFTBAbAXBzOajWPvOFcbHEImGq','2.png',NULL,'2024-10-30 17:22:51'),('2251120113111','2251120113111','2251120113@ut.edu.vn','$2y$10$mOBZT.lxMPbt7aOEAD74IuOuDkz1xi2.KI9DW2r.3cd4V7e/vrKSO',NULL,NULL,'2024-10-30 17:38:53'),('2251120113222','2251120113222','dotnhubotam@gmail.com','$2y$10$ZBKTJ2sJRz.X81yFN9sh4uVq8wAzxGsduOxHNftzQz2S4jpsXRxv2',NULL,NULL,'2024-10-30 17:37:00'),('22511201133','22511201133','trungnguyen504@gmail.com','$2y$10$m/DqBXj7ZoU.binWZdFiaehhXbsIMQMnuRTgyGLM1ryQuue5/y2oe',NULL,NULL,'2024-10-30 17:23:50'),('22511qqqq','22511qqqq','dotwwwtam@gmail.com','$2y$10$tB3hTILJe2.Dh5MVxwY0o.2VQM.fK4qTnF5Q7a90t/l6ybXXiXNaK',NULL,NULL,'2024-10-30 17:47:17'),('22512','22512','thang122015@gmail.com','$2y$10$kggizthgGouA4NyqX9QV0eoP1F/rUr07Aq3d6aW.2l4wKLlzDaTPq',NULL,NULL,'2024-10-30 17:45:34'),('2251333','2251333','thang1712202015@gmail.com','$2y$10$F5Ap89VXFXz1esQUd5so9.KSlPxD0cltlt3puOwajjHxI/eJBXHC2',NULL,NULL,'2024-10-30 17:45:15'),('225222','225222','111115@gmail.com','$2y$10$/f0I1PQO0xywT7pTqFtkce8sQ4drhWVRo1lWilu/nSEtqOgDSEDBS',NULL,NULL,'2024-10-30 17:46:04'),('bed1ve','Thắng đần','trungnguyen210504@gmail.com','$2y$10$gDKdaMF1lptvnegSmiS0ru2QcsVhcBTA/DQMcwGhiyKVeSSXVpSHG','1.png','828654','2024-10-28 09:22:04'),('concac','concac','bed1vetrung@gmail.com','$2y$10$2/gzSfq5Iq6EPKV/OuCpjuAcUyWRcvcVmVa3MUX0Ysjr/urTwfGaS',NULL,NULL,'2024-10-28 15:56:15'),('vanthang2k4','vanthang2k4','wwwwm@gmail.com','$2y$10$p.13GOLnCgmKLg5ucLuiTuAKI7HBfzpkcxYCCC2EQdfhR2CRlJfg6',NULL,NULL,'2024-10-30 17:46:37');
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

-- Dump completed on 2024-11-06 16:50:51
