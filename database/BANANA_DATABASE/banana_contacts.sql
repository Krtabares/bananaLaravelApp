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
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'daneska','la novia de brito','',0,'','','','','','0000-00-00','0000-00-00','',NULL,NULL),(2,'Pan de leche','','',0,'','','','','','0000-00-00','0000-00-00','','2018-06-28 13:58:27','2018-06-28 14:16:13'),(3,'Nestor Moreno','developer','',0,'tico_tico@gmail.com','','','','','0000-00-00','0000-00-00','','2018-06-29 14:47:29','2018-06-29 14:47:29'),(5,'contacto de modal',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-11 15:12:49','2018-07-11 15:12:49'),(21,'Eladio Alvarez',NULL,NULL,0,NULL,NULL,NULL,NULL,'Gerente general',NULL,NULL,NULL,'2018-07-12 18:19:06','2018-07-13 19:55:04'),(22,'Adriana perez',NULL,NULL,0,NULL,'041489455',NULL,NULL,'Jefa de recursos humanos','2018-07-13',NULL,NULL,'2018-07-13 14:29:22','2018-07-13 19:53:30'),(23,'Estefani Perez',NULL,NULL,0,NULL,NULL,NULL,NULL,'Jefa de caja',NULL,NULL,NULL,'2018-07-13 14:29:55','2018-07-13 14:29:55'),(24,'totti',NULL,NULL,0,NULL,NULL,NULL,NULL,'gato',NULL,NULL,NULL,'2018-07-13 16:17:33','2018-07-13 16:17:33'),(25,'edita bien',NULL,NULL,0,NULL,'2155645',NULL,'dasdasd','Editado de Manera Correcta','2018-07-20',NULL,NULL,'2018-07-13 17:39:25','2018-07-15 01:54:38'),(26,'Gerardo Agostino',NULL,NULL,0,'gerardo@mail.com',NULL,NULL,NULL,'farmaceutico',NULL,NULL,NULL,'2018-07-13 19:54:38','2018-07-13 20:21:26'),(27,'Jose Morales',NULL,NULL,0,NULL,NULL,NULL,NULL,'Encargado de deposito','2018-07-13',NULL,NULL,'2018-07-13 21:24:56','2018-07-15 01:53:14'),(28,'insertar en contactos',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-15 02:58:04','2018-07-15 02:58:04'),(29,'creado',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-15 03:01:38','2018-07-15 03:01:38');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 10:20:06
