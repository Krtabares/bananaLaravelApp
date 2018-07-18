CREATE DATABASE  IF NOT EXISTS `banana` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `banana`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: instancia1.c0rsww6fazdz.us-east-1.rds.amazonaws.com    Database: banana
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Dumping data for table `rols`
--

LOCK TABLES `rols` WRITE;
/*!40000 ALTER TABLE `rols` DISABLE KEYS */;
INSERT INTO `rols` VALUES (1,'super super rol','super super super',1,1,0,'2018-05-22 18:47:25','2018-06-06 14:27:01'),(35,'Secretaria','secretaria de la organizacion',0,0,0,NULL,NULL),(36,'Auditoresss','Auditor de la organizacion',0,0,1,NULL,'2018-06-11 16:04:25'),(38,'observador','observador de la organizacion',0,0,0,'2018-05-28 14:13:59','2018-05-28 14:13:59'),(39,'sin permisos','el que no hace nada en la organizacion',0,0,0,'2018-05-29 15:49:52','2018-05-29 15:49:52'),(46,'otro sin permisos','otro que no hace nada en la organizacion',0,0,0,'2018-05-29 15:59:34','2018-05-29 15:59:34'),(47,'Modificador','Modifica',0,0,0,'2018-05-29 18:00:31','2018-06-06 16:02:39'),(48,'Creador','Solo crea',0,0,0,'2018-05-29 18:01:12','2018-05-29 18:01:12'),(49,'nada','no hace nada',0,0,0,'2018-06-06 14:25:45','2018-06-06 14:25:45'),(50,'eliminador que limina','elimina muchas cosas',0,0,0,'2018-06-06 14:39:03','2018-06-06 14:40:01'),(51,'Lectores','solo tiene para leer',0,0,0,'2018-06-06 15:59:45','2018-06-06 15:59:45'),(52,'cafeteros','solo toman cafe',0,0,0,'2018-06-07 01:53:40','2018-06-08 19:59:19'),(53,'create test rol','estes desde angular',0,0,0,'2018-06-08 15:11:58','2018-06-08 15:11:58'),(54,'no hace nada como algunos','solo toman viene a escuchar vainas',0,0,0,'2018-06-11 15:24:12','2018-06-11 15:41:37'),(59,'almorzaderos','asdasdas',0,0,1,'2018-06-11 16:06:39','2018-06-11 16:06:39'),(68,'registradores','dsadasds',0,0,0,'2018-06-11 16:35:55','2018-06-11 16:35:55'),(69,'galleteros','solo comen',0,0,0,'2018-06-11 17:40:36','2018-06-11 17:40:36'),(72,'cualquier cosa','que hacen muchio',0,0,0,'2018-06-11 18:04:51','2018-06-11 18:04:51'),(73,'cualquier cosa vvv','que hacen muchio',1,1,0,'2018-06-11 18:10:51','2018-06-11 18:26:40'),(74,'cualquier cosa xxxxxxx','que hacen muchio',0,1,0,'2018-06-11 18:11:30','2018-06-11 18:11:30'),(75,'test kerby','test para probar permisos',0,0,0,'2018-06-26 16:33:16','2018-06-26 16:33:16');
/*!40000 ALTER TABLE `rols` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `BT_UpdateAccessColumnUser` AFTER UPDATE ON `rols` FOR EACH ROW
BEGIN
	UPDATE users SET all_access_column = NEW.all_access_column WHERE rol_id = NEW.id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `BT_UpdateAccessOrganizationUser` AFTER UPDATE ON `rols` FOR EACH ROW
BEGIN
	UPDATE users SET all_access_organization = NEW.all_access_organization WHERE rol_id = NEW.id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 10:19:59
