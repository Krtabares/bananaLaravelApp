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
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_03_07_184052_create_countries_table',1),(2,'2018_03_07_191543_create_states_table',1),(3,'2018_03_07_194143_create_cities_table',1),(4,'2018_03_23_180609_create_paymentterms_table',1),(5,'2018_03_23_180755_create_termtypes_table',1),(6,'2018_03_28_211128_create_units_table',1),(7,'2018_04_16_141341_create_categories_table',1),(8,'2018_05_14_151712_create_clients_table',1),(9,'2018_05_14_153133_create_organizations_table',1),(10,'2018_05_14_154930_create_rols_table',1),(11,'2018_05_14_155030_create_users_table',1),(12,'2018_05_14_171507_create_organization_user_table',1),(13,'2018_05_14_172600_create_tables_table',1),(14,'2018_05_14_173633_create_columns_table',1),(15,'2018_05_14_183835_create_permissions_users_table',1),(16,'2018_05_14_184259_create_permissions_rols_table',1),(17,'2018_05_14_184455_create_addresses_table',1),(18,'2018_05_22_142353_create_rd_rols',1),(19,'2018_05_22_144208_create_cr_rols',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 10:20:12
