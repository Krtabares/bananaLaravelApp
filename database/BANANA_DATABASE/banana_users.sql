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
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'super_user','super@admin.com',1,1,'12345',0,NULL,'2018-05-22 18:47:25','2018-05-22 18:47:25'),(2,47,'nestor','nestor@live.com',0,0,'1234',0,NULL,NULL,NULL),(4,39,'nada','nadanda@email.com',0,0,'00000',0,'asdasd','2018-05-30 16:13:26','2018-05-30 16:14:35'),(5,1,'administrador','admin@email.com',1,1,'admin',0,'sd5sa4d5s','2018-05-30 17:20:22','2018-05-30 17:23:23'),(6,36,'FRANCI','franci@gmail.com',0,0,'$2y$10$4Pd3deKd6zau70jqUKGh7uluohy5dzgD1KwJxA8zE9p0PnIeWJpIm',1,'GENERAR TOKEN','2018-05-31 14:40:20','2018-05-31 14:46:22'),(7,36,'csk','csk@gmail.com',0,0,'$2y$10$rJGlg1EVcw5KymsIshnLfOfVH0eOU.lKXJUJ0.2YjEM9vB4xC2RaS',0,'GENERAR TOKEN','2018-06-01 17:14:59','2018-06-01 17:14:59'),(8,1,'chiva','chiva@gmail.com',1,1,'$2y$10$eS8IBolCDGbk5mQoR6TV/O4Hm5n9wRYiwNFQhYuuI.BPO4hklvyKq',0,'GENERAR TOKEN','2018-06-04 13:53:30','2018-06-04 18:04:31'),(10,1,'jose','joseesi@gmail.com',1,1,'$2y$10$bZ9Nay6AUhBJ6kiCWTqwnOtg778AhPOdIIJqyxFQBPdkoAXhPEf1u',0,'GENERAR TOKEN','2018-06-04 18:54:44','2018-06-04 18:54:44'),(11,1,'asdsd','chiadasdasva@gmail.com',1,1,'$2y$10$2VrU11j03.JgZltN9u4SbOMkSI/HzrJ0Sm1n135qMpbO89W4Irkey',1,'GENERAR TOKEN','2018-06-06 16:20:51','2018-06-06 16:27:47'),(12,1,'gean','aa@gmail.com',1,1,'$2y$10$LiTzDM2t6jGKqNcUpDeiSulT.6pEvEASX18YsyKyYjoVFnxPoWIQi',0,'GENERAR TOKEN','2018-06-06 17:55:25','2018-06-06 17:55:25'),(13,1,'pan_leche','pan_de_leche3011@gmail.com',0,0,'$2y$10$O5QHVHYJE7mEAfrtRe6pje1u0vIcLTAxKZrjQblr8akwW2LUCHW6C',0,'GENERAR TOKEN','2018-06-08 14:44:55','2018-06-08 16:11:26'),(14,1,'belkys','belkys@gmail.com',1,1,'$2y$10$qM4exXd3zNbCGsM.XwPEK.GvTyJIm1G62PuBUYQuvonAl.oWMu7cW',0,'GENERAR TOKEN','2018-06-08 15:55:47','2018-06-08 15:55:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `BT_UsersAccessColumnInsert` BEFORE INSERT ON `users` FOR EACH ROW
BEGIN
	SET @all_access = (SELECT all_access_column FROM rols WHERE rols.id = NEW.rol_id);
	SET NEW.all_access_column = @all_access;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `BT_UsersAccessOrganizationInsert` BEFORE INSERT ON `users` FOR EACH ROW
BEGIN
	SET @all_access = (SELECT all_access_organization FROM rols WHERE rols.id = NEW.rol_id);
	SET NEW.all_access_organization = @all_access;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `BT_UsersAccessColumnUpdate` BEFORE UPDATE ON `users` FOR EACH ROW
BEGIN
	IF NEW.rol_id = OLD.rol_id THEN
		SET @all_access = NEW.all_access_column;
    ElSE
		SET @all_access = (SELECT all_access_column FROM rols WHERE rols.id = NEW.rol_id);
    END IF;
    
	SET NEW.all_access_column = @all_access;
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

-- Dump completed on 2018-07-16 10:21:01
