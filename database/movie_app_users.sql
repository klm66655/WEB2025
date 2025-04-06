-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: movie_app
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kelabratasdasdinae','kelabratinasdasda@email.com','$2y$10$3vt43/BiO6ltoMmAX69.qOhUc/I0UfIDYustBT15Zj79VqtKryc/W','','2025-04-06 14:03:25'),(4,'testuser','test1@example.com','$2y$10$C/DtlybZaHx6UWNF1Hda0ekd2k3aYAeOvgxp5ptDFoTpQvzf6UuKC','user','2025-04-06 15:10:12'),(6,'testuser','test3@example.com','$2y$10$pYg5k9JufqaZc/wJ5G3PVOycDFcD3M3AOgIhoN9fV6bp18bxAzo36','user','2025-04-06 15:10:28'),(10,'K3LABRAT','kelabratt@examasdasdaple.com','$2y$10$8FxTMKYdBjjSbC6Md2cuXuIyRMlf3AT06guGR9QE2BQKXjn1gpFSa','','2025-04-06 16:07:49'),(11,'K3LABRasdasdasdAT','kelabasdasdasdratt@examasdasdaple.com','$2y$10$jpcUYL8N6FyxHiJDN32ig.cP2/yKiRdP/VLRX9a2PchSH2sSMfDq6','','2025-04-06 16:14:31'),(12,'Kaida Selmanovski','kaidaselmanovic@gmail.com','$2y$10$///rJic6zYLGy1Opa33Yr.rvETBuH0p257HS8QoXSRQVbPCXowAVC','','2025-04-06 18:23:03'),(13,'Kaida Selmanovski1','kaidaselmanovic1@gmail.com','$2y$10$.VotsEERDLXgePAngOzuSuVTuEBX.7bbKhKCsfYRbEncbl/tcammm','','2025-04-06 18:23:44'),(14,'marko','marko@example.com','password123','user','2025-04-06 22:28:56'),(15,'ana','ana@example.com','securepass','user','2025-04-06 22:28:56');
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

-- Dump completed on 2025-04-07  0:46:39
