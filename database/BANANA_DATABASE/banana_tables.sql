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
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'clients','CLIENTS','2018-05-22 18:47:27','2018-05-22 18:47:27','/app/third-parties','content_paste'),(2,'organizations','ORGANIZATIONS','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(3,'rols','ROLS','2018-05-22 18:47:27','2018-05-22 18:47:27','/app/rol-list','donut_large'),(4,'users','USERS','2018-05-22 18:47:27','2018-05-22 18:47:27','/app/users-list','person'),(5,'countries','COUNTRIES','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(6,'states','STATES','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(7,'cities','CITIES','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(9,'permissions_users','PERMISSIONS_USERS','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(10,'permissions_rols','PERMISSIONS_ROLS','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(11,'units','UNITS','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(12,'payment_terms','PAYMENT_TERMS','2018-05-22 18:47:27','2018-05-22 18:47:27',NULL,NULL),(13,'term_types','TERM_TYPES','2018-05-22 18:47:28','2018-05-22 18:47:28',NULL,NULL),(14,'categories','CATEGORIES','2018-05-22 18:47:28','2018-05-22 18:47:28',NULL,NULL),(17,'bpartners','BPARTNERS',NULL,NULL,NULL,NULL),(18,'contacts','CONTACTS','2018-07-06 14:56:02','2018-07-06 14:56:02',NULL,NULL),(19,'currencies','CURRENCIES','2018-07-06 15:00:22','2018-07-06 15:00:22',NULL,NULL),(20,'languages','LANGUAGES','2018-07-06 15:01:23','2018-07-06 15:01:23',NULL,NULL),(21,'locations','LOCATIONS','2018-07-06 15:01:39','2018-07-06 15:01:39',NULL,NULL),(22,'price_lists','PRICE LISTS','2018-07-06 15:02:44','2018-07-06 15:02:44',NULL,NULL);
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 10:19:56
