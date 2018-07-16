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
-- Dumping events for database 'banana'
--

--
-- Dumping routines for database 'banana'
--
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertBpartnerContact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertBpartnerContact`(
	IN `bp_bpartner_id` INT,
	IN `bp_contact_id` INT
)
BEGIN
	INSERT INTO bpartner_contact (bpartner_id, contact_id)
    VALUES ( bp_bpartner_id, bp_contact_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertBpartnerLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertBpartnerLocation`(
IN `bp_bpartner_id` INT,
IN `bp_location_id` INT,
IN `bp_name` VARCHAR(60),
IN `bp_is_ship_to` BOOLEAN,
IN `bp_is_bill_to` BOOLEAN,
IN `bp_is_pay_from` BOOLEAN,
IN `bp_is_remit_to` BOOLEAN,
IN `bp_phone` VARCHAR(45),
IN `bp_phone_2` VARCHAR(45),
IN `bp_fax` VARCHAR(45),
IN `bp_isdn` VARCHAR(45)
)
BEGIN
	INSERT INTO bpartner_locations
		(
			bpartner_id, location_id, 
            name, is_ship_to, is_bill_to, is_pay_from, is_remit_to, phone,
            phone_2, fax, isdn,
			created_at, updated_at
		)
    VALUES (
    		bp_bpartner_id, bp_location_id, 
            bp_name, bp_is_ship_to, bp_is_bill_to, bp_is_pay_from, bp_is_remit_to, bp_phone,
            bp_phone_2, bp_fax, bp_isdn,
			NOW(), NOW()
		);       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertBpartners` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertBpartners`(
in bp_org_id int, 
in bp_Logo varchar(45), 
in bp_is_customer boolean, 
in bp_is_Vendor boolean, 
in bp_name varchar(120), 
in bp_name2 varchar(120), 
in bp_is_Employee boolean, 
in bp_is_Prospect boolean, 
in bp_is_SalesRep boolean, 
in bp_ReferenceNo varchar(25), 
in bp_SalesRep_id int, 
in bp_CreditStatus char(1), 
in bp_CreditLimit double,
in bp_TaxId int, 
in bp_is_TaxExempt boolean,
in bp_is_POTaxExempt boolean,
in bp_URL varchar(120),
in bp_description varchar(255),
in bp_is_Summary boolean,
in bp_PriceList_id int, 
in bp_DeliveryRule char(1), 
in bp_DeliveryViaRule char(1), 
in bp_FlatDiscount double, 
in bp_is_Manufacturer boolean, 
in bp_PO_PriceList_id int, 
in bp_Language_id int, 
in bp_Greeting_id int
)
BEGIN
INSERT INTO `banana`.`bpartners` (`organization_id`, `logo`, `is_customer`, `is_vendor`, `name`, `name_2`,
	`is_employee`, `is_prospect`, `is_sales_rep`, `reference_no`, `sales_rep_id`, `credit_status`, `credit_limit`,
    `tax_id`, `is_tax_exempt`, `is_po_tax_exempt`, `url`, `description`, `is_summary`,
    `price_list_id`, `delivery_rule`, `delivery_via_rule`, `flat_discount`, `is_manufacturer`, `po_price_list_id`,
    `language_id`, `greeting_id`, `created_at`, `updated_at`) VALUES 
(
bp_org_id, 
bp_Logo, 
bp_is_customer, 
bp_is_Vendor, 
bp_name, 
bp_name2, 
bp_is_Employee, 
bp_is_Prospect, 
bp_is_SalesRep, 
bp_ReferenceNo, 
bp_SalesRep_id, 
bp_CreditStatus, 
bp_CreditLimit, 
bp_TaxId, 
bp_is_TaxExempt,
bp_is_POTaxExempt,
bp_URL,
bp_description,
bp_is_Summary,
bp_PriceList_id, 
bp_DeliveryRule, 
bp_DeliveryViaRule, 
bp_FlatDiscount, 
bp_is_Manufacturer, 
bp_PO_PriceList_id, 
bp_Language_id, 
bp_Greeting_id,
NOW(),
NOW()
);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertCity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertCity`(IN `bp_state_id` INT, IN `bp_city_name` VARCHAR(45), IN `bp_capital` BOOLEAN )
BEGIN
	INSERT INTO cities (state_id, city, capital, created_at, updated_at)
    VALUES ( bp_state_id, bp_city_name, bp_capital, NOW(), NOW() );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertColumnType` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertColumnType`( IN bp_name VARCHAR(45) )
BEGIN
	INSERT INTO column_type
    (name)
    VALUES (bp_name);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertContacts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertContacts`(
	IN bp_name VARCHAR(60),
	IN bp_description VARCHAR(255),
	IN bp_comments TEXT,
	IN bp_email VARCHAR(60),
	IN bp_phone VARCHAR(45),
	IN bp_phone_2 VARCHAR(45),
	IN bp_fax VARCHAR(45),
	IN bp_title VARCHAR(45),
	IN bp_birthday DATE,
	IN bp_last_contact DATE,
	IN bp_last_result VARCHAR(255)
)
BEGIN
	INSERT INTO `contacts` (
		`name`,
		description,
		comments,
		email,
		phone,
		phone_2,
		fax,
		title,
		birthday,
		last_contact,
		last_result,
        created_at,
        updated_at
	) VALUES(
		bp_name,
		bp_description,
		bp_comments,
		bp_email,
		bp_phone,
		bp_phone_2,
		bp_fax,
		bp_title,
		bp_birthday,
		bp_last_contact,
		bp_last_result,
        NOW(),
        NOW()
	);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertContactUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertContactUser`(
	IN `bp_user_id` INT,
	IN `bp_contact_id` INT
)
BEGIN
	INSERT INTO contact_user (user_id, contact_id)
    VALUES ( bp_user_id, bp_contact_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertCountry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertCountry`(IN `bp_country_name` VARCHAR(45), IN `bp_iso` VARCHAR(2) )
BEGIN
	INSERT INTO countries (country, iso, created_at, updated_at)
    VALUES ( bp_country_name, bp_iso, NOW(), NOW() );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertCustomColumn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertCustomColumn`( bp_table_id INT, bp_type_id INT, bp_name VARCHAR(45))
BEGIN
	INSERT INTO custom_column
    (table_id, type_id, name)
    VALUES (bp_table_id, bp_type_id, bp_name);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertCustomColumnValue` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertCustomColumnValue`(
bp_number_value VARCHAR(45),
bp_string_value VARCHAR(45),
bp_date TIMESTAMP,
bp_custom_column_id INT,
bp_context_id INT
)
BEGIN
    DELETE FROM custom_column_value WHERE custom_column_id = bp_custom_column_id AND context_id = bp_context_id;
	INSERT INTO custom_column_value
    (number_value, string_value, date, custom_column_id, context_id)
    VALUES (bp_number_value, bp_string_value, bp_date, bp_custom_column_id, bp_context_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertField` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertField`(
IN `bp_input_type_id` INT,
IN `bp_position` INT,
IN `bp_required` BOOLEAN,
IN `bp_column_id` INT)
BEGIN
	INSERT INTO field_configurations (position, input_type_id, required, created_at, updated_at, column_id)
    VALUES ( bp_position, bp_input_type_id, bp_required, NOW(), NOW(), bp_column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertLocation`(
IN `bp_address_1` VARCHAR(60),
IN `bp_address_2` VARCHAR(60),
IN `bp_address_3` VARCHAR(60),
IN `bp_address_4` VARCHAR(60),
IN `bp_city_id` INT,
IN `bp_city_name` VARCHAR(60),
IN `bp_postal` VARCHAR(10),
IN `bp_postal_add` VARCHAR(10),
IN `bp_state_id` INT,
IN `bp_state_name` VARCHAR(45),
IN `bp_country_id` INT,
IN `bp_comments` TEXT
)
BEGIN
	INSERT INTO locations
		(
			address_1, address_2, address_3, address_4, city_id, city_name, 
			postal, postal_add, state_id, state_name, country_id, comments,
			created_at, updated_at
		)
    VALUES (
    		bp_address_1, bp_address_2, bp_address_3, bp_address_4, bp_city_id, bp_city_name, 
			bp_postal, bp_postal_add, bp_state_id, bp_state_name, bp_country_id, bp_comments,
			NOW(), NOW()
		);       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertPermitsRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertPermitsRol`(IN `bp_rol_id` INT, IN `bp_column_id` INT, IN `bp_create` BOOLEAN, IN `bp_read` BOOLEAN, IN `bp_update` BOOLEAN, IN `bp_delete` BOOLEAN)
BEGIN
	INSERT INTO permissions_rols (rol_id, column_id, permissions_rols.create, permissions_rols.read, permissions_rols.update, permissions_rols.delete, created_at, updated_at) 
	VALUES (bp_rol_id, bp_column_id, bp_create, bp_read, bp_update, bp_delete, NOW(), NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertPermitsUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertPermitsUser`(IN `bp_user_id` INT, IN `bp_column_id` INT, IN `bp_create` BOOLEAN, IN `bp_read` BOOLEAN, IN `bp_update` BOOLEAN, IN `bp_delete` BOOLEAN)
BEGIN
	INSERT INTO permissions_users (user_id, column_id, permissions_users.create, permissions_users.read, permissions_users.update, permissions_users.delete, created_at, updated_at) 
	VALUES (bp_user_id, bp_column_id, bp_create, bp_read, bp_update, bp_delete, NOW(), NOW());
    
    SELECT permissions_users.*, columns.column_name
    FROM permissions_users, columns
    WHERE ( user_id = bp_user_id ) AND ( columns.id = permissions_users.column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertRol`(IN `bp_rol_name` VARCHAR(45), IN `bp_description` VARCHAR(45), IN `bp_all_access_column` BOOLEAN, IN `bp_all_access_organization` BOOLEAN)
BEGIN
	INSERT INTO rols (rol_name, description, all_access_column, all_access_organization, created_at, updated_at)
    VALUES (bp_rol_name, bp_description, bp_all_access_column, bp_all_access_organization, NOW(), NOW());
	SELECT * FROM rols order by id desc LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertState` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertState`(IN `bp_country_id` INT, IN `bp_state_name` VARCHAR(45), IN `bp_iso` VARCHAR(5) )
BEGIN
	INSERT INTO states (country_id, state, iso, created_at, updated_at)
    VALUES ( bp_country_id, bp_state_name, bp_iso, NOW(), NOW() );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertToken` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertToken`(IN bp_user_id INT, bp_name VARCHAR(191), bp_token VARCHAR(255), bp_revoked BOOLEAN)
BEGIN
	DELETE FROM oauth_access_tokens WHERE user_id = bp_user_id;
	INSERT INTO oauth_access_tokens (user_id, name, token, revoked, created_at, updated_at, expires_at)
    VALUES (bp_user_id, bp_name, bp_token, bp_revoked, NOW(), NOW(),  DATE_ADD(now(), INTERVAL 60 MINUTE));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CR_InsertUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `CR_InsertUser`(IN `bp_rol_id` INT, IN `bp_user_name` VARCHAR(45), IN `bp_password` VARCHAR(65),
		IN `bp_email` VARCHAR(45), IN `bp_remember_token` VARCHAR(100))
BEGIN
	INSERT INTO users (rol_id, user_name, password, email, remember_token, created_at, updated_at)
    VALUES (bp_rol_id, bp_user_name, bp_password, bp_email, bp_remember_token, NOW(), NOW());
        
	SELECT * FROM users order by id desc LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedCity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedCity`(IN `bp_city_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE cities
    SET archived = bp_archived
    WHERE id = bp_city_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedCountry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedCountry`(IN `bp_country_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE countries
    SET archived = bp_archived
    WHERE id = bp_country_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedRol`(IN `bp_rol_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE rols 
	SET archived = bp_archived
	WHERE id = bp_rol_id;
    
    SELECT * FROM rols WHERE id = bp_rol_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedState` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedState`(IN `bp_state_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE states
    SET archived = bp_archived
    WHERE id = bp_state_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedThird` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedThird`(IN `bp_third_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE bpartners
    SET archived = bp_archived
    WHERE id = bp_third_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_ArchivedUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_ArchivedUser`(IN `bp_user_id` INT, IN `bp_archived` BOOLEAN)
BEGIN
	UPDATE users 
	SET archived = bp_archived
	WHERE id = bp_user_id;
    
    SELECT * FROM users WHERE id = bp_user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DL_DeleteBpartnerData` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DL_DeleteBpartnerData`(IN `bp_bpartner_id` INT, IN `bp_location_id` INT)
BEGIN    
    DELETE FROM bpartner_locations
    WHERE
		bpartner_id = bp_bpartner_id
        AND
        location_id = bp_location_id;
    
    DELETE FROM bpartners WHERE id = bp_bpartner_id;
    DELETE FROM locations WHERE id = bp_location_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_LoginUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_LoginUser`(IN bp_email varchar(45))
BEGIN
	SELECT * FROM users WHERE ( email = bp_email );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectColumnAccessUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectColumnAccessUser`(IN bp_user_id INT, IN bp_table_id int )
BEGIN

	SET @bv_rol_id := (SELECT rol_id FROM users WHERE users.id = bp_user_id);

	SELECT distinct t1.id, t1.column_name 'key', t1.description label,
	t2.position 'order', t2.required ,
		t3.input_name control_type, 
     (select REFERENCED_TABLE_NAME 
	 from information_schema.KEY_COLUMN_USAGE sqT1 
	 where sqT1.COLUMN_NAME = t1.column_name limit 1 ) as REFERENCED_TABLE_NAME
	FROM columns t1 
	left join field_configurations t2 ON t1.id = t2.column_id
	left join input_types t3 ON t2.input_type_id = t3.id
	
	WHERE t1.table_id = bp_table_id AND (
	t1.id IN ( 
			SELECT DISTINCT columns.id
			FROM tables, columns, permissions_rols
			WHERE ( tables.id = columns.table_id )
				AND ( columns.id = permissions_rols.column_id )
				AND ( permissions_rols.rol_id = @bv_rol_id )
				AND tables.id = bp_table_id) 
	OR t1.id IN(
			SELECT DISTINCT columns.id
			FROM tables, columns, permissions_users
			WHERE ( tables.id = columns.table_id )
				AND ( columns.id = permissions_users.column_id )
				AND ( permissions_users.user_id = bp_user_id) 
				AND tables.id = bp_table_id
			ORDER BY id)
	)
    ORDER BY t2.position; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectColumnsTable` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectColumnsTable`(IN `bp_table_id` INT)
BEGIN
	SELECT * FROM columns WHERE columns.table_id = bp_table_id ORDER BY column_name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredCities` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredCities`(IN `bp_search` varchar(45))
BEGIN
	SELECT p.id country_id, p.country, s.state, c.* FROM states s
	JOIN cities c ON s.id = c.state_id
	JOIN countries p ON s.country_id = p.id
	WHERE
		(
			p.id = CAST(bp_search AS SIGNED)
			OR c.state_id = CAST(bp_search AS SIGNED)
            OR c.id = CAST(bp_search AS SIGNED)
			OR p.country LIKE CONCAT('%', bp_search, '%')
			OR s.state LIKE CONCAT('%', bp_search, '%')
			OR c.city LIKE CONCAT('%', bp_search, '%')
		)
		ORDER BY p.country, s.state, c.city;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredCountries` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredCountries`(IN `bp_search` varchar(45))
BEGIN
	SELECT *
	FROM countries
	WHERE
		( countries.id = CAST(bp_search AS SIGNED) )
		OR ( countries.country LIKE CONCAT('%', bp_search, '%') )
		OR ( countries.iso LIKE CONCAT('%', bp_search, '%') )
		ORDER BY countries.country;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredRols` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredRols`(IN `bp_search` varchar(45))
BEGIN
	SELECT * FROM rols
    WHERE
		( id = CAST(bp_search AS SIGNED) )
        OR ( rol_name LIKE CONCAT('%', bp_search, '%') )
        OR ( description LIKE CONCAT('%', bp_search, '%') )
	ORDER BY rol_name, id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredStates` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredStates`(IN `bp_search` varchar(45))
BEGIN
	SELECT c.country, s.*
	FROM states s, countries c
	WHERE
		(
			c.id = CAST(bp_search AS SIGNED)
			OR s.id = CAST(bp_search AS SIGNED)
			OR c.country LIKE CONCAT('%', bp_search, '%')
			OR s.state LIKE CONCAT('%', bp_search, '%')
			OR s.iso LIKE CONCAT('%', bp_search, '%')
		)
		AND ( c.id = s.country_id )
		ORDER BY c.country, s.state;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredThirds` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredThirds`(IN `bp_search` varchar(45))
BEGIN
	SELECT *
    FROM bpartners
    WHERE
		( bpartners.id = CAST(bp_search AS SIGNED) )
        OR ( bpartners.logo LIKE CONCAT('%', bp_search, '%') )
        OR ( bpartners.name LIKE CONCAT('%', bp_search, '%') )
        OR ( bpartners.name_2 LIKE CONCAT('%', bp_search, '%') )
        OR ( bpartners.url LIKE CONCAT('%', bp_search, '%') )
	ORDER BY bpartners.name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectFilteredUsers` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectFilteredUsers`(IN `bp_search` varchar(45))
BEGIN
	SELECT users.id, users.rol_id, users.user_name, users.email, users.all_access_column,
		users.all_access_organization, users.archived, users.created_at, users.updated_at
    FROM users
    WHERE
		( users.id = CAST(bp_search AS SIGNED) )
        OR ( users.rol_id = CAST(bp_search AS SIGNED) )
        OR ( users.user_name LIKE CONCAT('%', bp_search, '%') )
        OR ( users.email LIKE CONCAT('%', bp_search, '%') )
	ORDER BY users.user_name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsAssociatesAll` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsAssociatesAll`(IN bp_rol_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
	(if(t3.create is not null,1,0)) as `create`,
	(if(t3.read is not null,1,0)) as `read`,
	(if(t3.delete is not null,1,0)) as `delete`,
    (if(t3.update is not null,1,0)) as `update`,
    (if(t3.rol_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_rols t3 on t1.id = t3.column_id and t3.rol_id = bp_rol_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsAssociatesUserAll` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsAssociatesUserAll`(IN bp_user_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.user_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_users t3 on t1.id = t3.column_id and t3.user_id = bp_user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsNotAssociates` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsNotAssociates`(IN bp_rol_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.rol_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_rols t3 on t1.id = t3.column_id and t3.rol_id = bp_rol_id
    where t3.rol_id is null and t3.column_id is null;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsNotAssociatesUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsNotAssociatesUser`(IN bp_user_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.user_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_users t3 on t1.id = t3.column_id and t3.user_id = bp_user_id
    where t3.user_id is null and t3.column_id is null;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsRol`(IN `bp_rol_id` INT)
BEGIN
	SELECT permissions_rols.*, columns.column_name
    FROM permissions_rols, columns
    WHERE ( rol_id = bp_rol_id ) AND ( columns.id = permissions_rols.column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsUser`(IN `bp_user_id` INT)
BEGIN
	SELECT permissions_users.*, columns.column_name
    FROM permissions_users, columns
    WHERE ( user_id = bp_user_id ) AND ( columns.id = permissions_users.column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsYesAssociates` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsYesAssociates`(IN bp_rol_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.rol_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_rols t3 on t1.id = t3.column_id and t3.rol_id = bp_rol_id
    where t3.rol_id is not null and t3.column_id is not null;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectPermitsYesAssociatesUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectPermitsYesAssociatesUser`(IN bp_user_id INT)
BEGIN
	SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.user_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_users t3 on t1.id = t3.column_id and t3.user_id = bp_user_id
    where t3.user_id is not null and t3.column_id is not null;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectRols` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectRols`()
BEGIN
	SELECT * FROM rols ORDER BY rol_name, id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectTableAccessUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectTableAccessUser`(IN bp_user_id INT)
BEGIN
	SET @access_column := (SELECT all_access_column FROM users where id = bp_user_id);
	
    IF @access_column THEN
		SELECT * FROM `tables`;
	ELSE    
		SET @bv_rol_id := (SELECT rol_id FROM users WHERE users.id = bp_user_id);
		
		SELECT DISTINCT tables.*
		FROM tables, columns, permissions_rols
		WHERE ( tables.id = columns.table_id )
			AND ( columns.id = permissions_rols.column_id )
			   AND ( permissions_rols.rol_id = @bv_rol_id )
		UNION
		SELECT DISTINCT tables.*
		FROM tables, columns, permissions_users
		WHERE ( tables.id = columns.table_id )
			AND ( columns.id = permissions_users.column_id )
			   AND ( permissions_users.user_id = bp_user_id )
		ORDER BY id;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectTotalAccess` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectTotalAccess`(IN bp_user_id INT)
BEGIN
	SET @bv_rol_id := (SELECT DISTINCT rol_id FROM rols, users WHERE users.id = bp_user_id);
    
    SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t2.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.rol_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_rols t3 on t1.id = t3.column_id and t3.rol_id = @bv_rol_id
    WHERE t3.rol_id is not null and t3.column_id is not null AND t1.id NOT IN (
		SELECT permissions_users.column_id
		FROM permissions_users
		LEFT JOIN users ON permissions_users.user_id = users.id
		WHERE users.id = bp_user_id
    )
    UNION
    SELECT  
	t1.table_id, t2.table_name, t2.description table_description,
	t1.id column_id,
    t1.column_name, t1.description column_description,
    t3.create,
    t3.read,
    t3.delete,
    t3.update,
    (if(t3.user_id is not null,1,0)) selected
	FROM banana.columns t1
	inner join banana.tables t2 on t1.table_id = t2.id 
	left JOIN banana.permissions_users t3 on t1.id = t3.column_id and t3.user_id = bp_user_id
    where t3.user_id is not null and t3.column_id is not null ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RD_SelectUsers` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `RD_SelectUsers`()
BEGIN
	SELECT users.id, users.rol_id, rols.rol_name, users.user_name,
		users.email, users.all_access_organization, users.all_access_column,
		users.archived, users.created_at, users.updated_at
    FROM users, rols
    WHERE rols.id = users.rol_id
    ORDER BY user_name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_InsertBpartnerLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_InsertBpartnerLocation`(
IN `bp_bpartner_location_id` INT,
IN `bp_name` VARCHAR(60),
IN `bp_is_ship_to` BOOLEAN,
IN `bp_is_bill_to` BOOLEAN,
IN `bp_is_pay_from` BOOLEAN,
IN `bp_is_remit_to` BOOLEAN,
IN `bp_phone` VARCHAR(45),
IN `bp_phone_2` VARCHAR(45),
IN `bp_fax` VARCHAR(45),
IN `bp_isdn` VARCHAR(45)
)
BEGIN
	UPDATE bpartner_locations SET
		`name` = bp_name,
        is_ship_to = bp_is_ship_to,
        is_bill_to = bp_is_bill_to,
        is_pay_from = bp_is_pay_from,
        is_remit_to = bp_is_remit_to,
        phone = bp_phone,
		phone_2 = bp_phone_2,
        fax = bp_fax,
        isdn = bp_isdn,
		updated_at = NOW()
    WHERE ID = bp_bpartner_location_id;       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateBpartnerLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateBpartnerLocation`(
IN `bp_bpartner_location_id` INT,
IN `bp_name` VARCHAR(60),
IN `bp_is_ship_to` BOOLEAN,
IN `bp_is_bill_to` BOOLEAN,
IN `bp_is_pay_from` BOOLEAN,
IN `bp_is_remit_to` BOOLEAN,
IN `bp_phone` VARCHAR(45),
IN `bp_phone_2` VARCHAR(45),
IN `bp_fax` VARCHAR(45),
IN `bp_isdn` VARCHAR(45)
)
BEGIN
	UPDATE bpartner_locations SET
		`name` = bp_name,
        is_ship_to = bp_is_ship_to,
        is_bill_to = bp_is_bill_to,
        is_pay_from = bp_is_pay_from,
        is_remit_to = bp_is_remit_to,
        phone = bp_phone,
		phone_2 = bp_phone_2,
        fax = bp_fax,
        isdn = bp_isdn,
		updated_at = NOW()
    WHERE ID = bp_bpartner_location_id;       
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateBpartners` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateBpartners`(
in bp_third_id int,
in bp_org_id int, 
in bp_Logo varchar(45), 
in bp_is_customer boolean, 
in bp_is_Vendor boolean, 
in bp_name varchar(120), 
in bp_name2 varchar(120), 
in bp_is_Employee boolean, 
in bp_is_Prospect boolean, 
in bp_is_SalesRep boolean, 
in bp_ReferenceNo varchar(25), 
in bp_SalesRep_id int, 
in bp_CreditStatus char(1), 
in bp_CreditLimit double,
in bp_TaxId int, 
in bp_is_TaxExempt boolean,
in bp_is_POTaxExempt boolean,
in bp_URL varchar(120),
in bp_description varchar(255),
in bp_is_Summary boolean,
in bp_PriceList_id int, 
in bp_DeliveryRule char(1), 
in bp_DeliveryViaRule char(1), 
in bp_FlatDiscount double, 
in bp_is_Manufacturer boolean, 
in bp_PO_PriceList_id int, 
in bp_Language_id int, 
in bp_Greeting_id int
)
BEGIN
	UPDATE bpartners SET
	organization_id = bp_org_id,
	logo = bp_Logo,
	is_customer = bp_is_customer,
	is_vendor = bp_is_Vendor,
	name = bp_name,
	name_2 = bp_name2,
	is_employee = bp_is_Employee,
	is_prospect = bp_is_Prospect,
	is_sales_rep = bp_is_SalesRep,
	reference_no = bp_ReferenceNo,
	sales_rep_id = bp_SalesRep_id,
	credit_status = bp_CreditStatus,
	credit_limit = bp_CreditLimit,
    tax_id = bp_TaxId,
    is_tax_exempt = bp_is_TaxExempt,
    is_po_tax_exempt = bp_is_POTaxExempt,
    url = bp_URL,
    description = bp_description,
    is_summary = bp_is_Summary,
    price_list_id = bp_PO_PriceList_id,
    delivery_rule = bp_DeliveryRule,
    delivery_via_rule = bp_DeliveryViaRule,
    flat_discount = bp_FlatDiscount,
    is_manufacturer = bp_is_Manufacturer,
    po_price_list_id = bp_PO_PriceList_id,
    language_id = bp_Language_id,
    greeting_id = bp_Greeting_id,
    created_at = NOW(),
    updated_at = NOW()
    WHERE id = bp_third_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateCity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateCity`(IN `bp_city_id` INT, IN `bp_state_id` INT,IN `bp_city_name` VARCHAR(45), IN `bp_capital` BOOLEAN )
BEGIN
	UPDATE cities
    SET city = bp_city_name, capital = bp_capital, updated_at = NOW(), state_id = bp_state_id
    WHERE id = bp_city_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateContact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateContact`(
	IN bp_contact_id INT,
    IN bp_name VARCHAR(60),
	IN bp_description VARCHAR(255),
	IN bp_comments TEXT,
	IN bp_email VARCHAR(60),
	IN bp_phone VARCHAR(45),
	IN bp_phone_2 VARCHAR(45),
	IN bp_fax VARCHAR(45),
	IN bp_title VARCHAR(45),
	IN bp_birthday DATE,
	IN bp_last_contact DATE,
	IN bp_last_result VARCHAR(255)
)
BEGIN
	UPDATE contacts SET
	name = bp_name,
	description = bp_description,
	comments = bp_comments,
	email = bp_email,
	phone = bp_phone,
	phone_2 = bp_phone_2,
	fax = bp_fax,
	title = bp_title,
	birthday = bp_birthday,
	last_contact = bp_last_contact,
	last_result = bp_last_result,
    updated_at = NOW()
    WHERE id = bp_contact_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateCountry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateCountry`(IN `bp_country_id` INT,IN `bp_country_name` VARCHAR(45), IN `bp_iso` VARCHAR(2) )
BEGIN
	UPDATE countries
    SET country = bp_country_name, iso = bp_iso, updated_at = NOW()
    WHERE id = bp_country_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateFieldConf` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateFieldConf`(
IN `bp_input_type_id` INT,
IN `bp_position` INT,
IN `bp_required` BOOLEAN,
IN `bp_column_id` INT,
IN `bp_custom_column_id` INT)
BEGIN

if  bp_custom_column_id is null then
	set @haveconf = (select  if(id is null, 0,1) from field_configurations where column_id = bp_column_id);
else
	set @haveconf = (select  if(id is null, 0,2) from field_configurations where custom_column_id = bp_custom_column_id);
end if;

   
if @haveconf = 0 then
	call CR_InsertField(bp_input_type_id,bp_position,bp_required,bp_column_id, bp_custom_column_id);
elseif @haveconf = 1 then

	UPDATE
		field_configurations
	SET
	position = bp_position,
	input_type_id = bp_input_type_id,
	required = bp_required
	WHERE
	column_id = bp_column_id;
 
elseif  @haveconf = 2 then

	UPDATE
		field_configurations
	SET
	position = bp_position,
	input_type_id = bp_input_type_id,
	required = bp_required
	WHERE
	custom_column_id = bp_custom_column_id ;

end if ; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateLocation`(
IN `bp_location_id` INT,
IN `bp_address_1` VARCHAR(60),
IN `bp_address_2` VARCHAR(60),
IN `bp_address_3` VARCHAR(60),
IN `bp_address_4` VARCHAR(60),
IN `bp_city_id` INT,
IN `bp_city_name` VARCHAR(60),
IN `bp_postal` VARCHAR(10),
IN `bp_postal_add` VARCHAR(10),
IN `bp_state_id` INT,
IN `bp_state_name` VARCHAR(45),
IN `bp_country_id` INT,
IN `bp_comments` TEXT
)
BEGIN
	UPDATE locations SET
	address_1 = bp_address_1,
    address_2 = bp_address_2,
    address_3 = bp_address_3,
    address_4 = bp_address_4,
    city_id = bp_city_id,
    city_name = bp_city_name,
	postal = bp_postal,
    postal_add = bp_postal_add,
    state_id = bp_state_id,
    state_name = bp_state_name,
    country_id = bp_country_id,
    comments = bp_comments,
	updated_at = NOW()
    WHERE id = bp_location_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdatePermitsRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdatePermitsRol`(IN `bp_rol_id` INT, IN `bp_column_id` INT, IN `bp_create` BOOLEAN, IN `bp_read` BOOLEAN, IN `bp_update` BOOLEAN, IN `bp_delete` BOOLEAN)
BEGIN
	UPDATE permissions_rols per_r
	SET per_r.create = bp_create, per_r.read = bp_read, per_r.update = bp_update, per_r.delete = bp_delete, updated_at = NOW()
	WHERE per_r.rol_id = bp_rol_id AND per_r.column_id = bp_column_id;
    
    SELECT permissions_rols.*, columns.column_name
    FROM permissions_rols, columns
    WHERE ( rol_id = bp_rol_id ) AND ( columns.id = permissions_rols.column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdatePermitsUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdatePermitsUser`(IN `bp_user_id` INT, IN `bp_column_id` INT, IN `bp_create` BOOLEAN, IN `bp_read` BOOLEAN, IN `bp_update` BOOLEAN, IN `bp_delete` BOOLEAN)
BEGIN
	UPDATE permissions_users per_u
	SET per_u.create = bp_create, per_u.read = bp_read, per_u.update = bp_update, per_u.delete = bp_delete, updated_at = NOW()
	WHERE per_u.user_id = bp_user_id AND per_u.column_id = bp_column_id;
    
    SELECT permissions_users.*, columns.column_name
    FROM permissions_users, columns
    WHERE ( user_id = bp_user_id ) AND ( columns.id = permissions_users.column_id );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateRol`(IN `bp_rol_id` INT, IN `bp_rol_name` VARCHAR(45),
	IN `bp_description` VARCHAR(45), IN `bp_all_access_column` BOOLEAN, IN `bp_all_access_organization` BOOLEAN)
BEGIN
	UPDATE rols 
	SET rol_name = bp_rol_name, description = bp_description, all_access_column = bp_all_access_column,
		all_access_organization = bp_all_access_organization, updated_at = NOW()
	WHERE id = bp_rol_id;
    SELECT * FROM rols WHERE id = bp_rol_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateState` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateState`(IN `bp_state_id` INT, IN `bp_country_id` INT,IN `bp_state_name` VARCHAR(45), IN `bp_iso` VARCHAR(5) )
BEGIN
	UPDATE states
    SET state = bp_state_name, iso = bp_iso, updated_at = NOW(), country_id = bp_country_id
    WHERE id = bp_state_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `UP_UpdateUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `UP_UpdateUser`(IN `bp_user_id` INT, IN `bp_rol_id` INT, IN `bp_user_name` VARCHAR(45),
		IN `bp_password` VARCHAR(65), IN `bp_email` VARCHAR(45), IN `bp_all_access_organization` BOOLEAN,
        IN `bp_all_access_column` BOOLEAN)
BEGIN
	UPDATE users 
	SET rol_id = bp_rol_id, user_name = bp_user_name, password = bp_password, email = bp_email,
		all_access_organization = bp_all_access_organization, all_access_column = bp_all_access_column,
        updated_at = NOW()
	WHERE id = bp_user_id;
    
    SELECT * FROM users WHERE id = bp_user_id;
END ;;
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

-- Dump completed on 2018-07-16 10:21:54
