CREATE DATABASE  IF NOT EXISTS `wjcrypto` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wjcrypto`;
-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: wjcrypto
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(255) DEFAULT NULL,
  `balance` float DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number_UNIQUE` (`account_number`),
  CONSTRAINT `fk_number` FOREIGN KEY (`account_number`) REFERENCES `holder` (`account_number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (2,'S2kbdXYLSdB3WETAnZa3WQ==',50),(3,'7IVnreXlXrme2YzpMtbfsg==',-20),(4,'sLYVrtrHxbsYUfT4XFCXEA==',0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holder`
--

DROP TABLE IF EXISTS `holder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `additional_document` varchar(255) DEFAULT NULL,
  `dt_origin` datetime DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_number_UNIQUE` (`account_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holder`
--

LOCK TABLES `holder` WRITE;
/*!40000 ALTER TABLE `holder` DISABLE KEYS */;
INSERT INTO `holder` VALUES (2,'ly2WzdTvuDUs+2+ajkK85A==','ludK4NvV0BRDU9QzghPQ0Q==','HZQ3r05gAsKqm/WpKaI7xw==','2020-05-20 00:00:00','RUQEHg72eV3RyKVOL5x4Vw==','SgjuUchkYtONFcTURgPDP0b/1urBkM4usENYZHONlpM=','COAttOaBlQOQr8a6BaPjlg==','COAttOaBlQOQr8a6BaPjlg==','8k2MX1xhvmhwduy43mW7og=='),(3,'WBSn0CimnZM9IopOsbCphw==','91WFLRTUtIRacd8mmZkiPA==','OuX2JCQ2YNaCtVfZdXjuTw==','2020-05-20 00:00:00','QDixmoBhm3uoNQQqQcHcpQ==','3vt8BqHmt76rjkAcuZPkug==','WB5ycRhj8fnZThXJw4mT/Q==','WB5ycRhj8fnZThXJw4mT/Q==','S2kbdXYLSdB3WETAnZa3WQ=='),(4,'TpDDGzEmehQJeZE6aD9ybw==','QOHKVQTPz3hNpKR+gj+dtQ==','nbikBrQUiAO50GFYbtSPxQ==','2020-05-20 00:00:00','oXDYCLG2xQgIH/QBYXjHtg==','9tQmT9+Bfk+oTPU6H0y1pw==','1Z1wdguaYz22mJ0cI33xlw==','1Z1wdguaYz22mJ0cI33xlw==','7IVnreXlXrme2YzpMtbfsg=='),(5,'8jbq5PMp4HyGnWwf+oHhuQ==','+SRoynKPKshA5APEbBalbg==','OuX2JCQ2YNaCtVfZdXjuTw==','2020-02-01 00:00:00','sDFwFGUvmkv/yZ15n3GggQ==','6eUKnVPv1PGzFPmsLGwEOg==','BCk0FvqGpiFWkROKjAVQoQ==','BCk0FvqGpiFWkROKjAVQoQ==','sLYVrtrHxbsYUfT4XFCXEA==');
/*!40000 ALTER TABLE `holder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `expiration` datetime NOT NULL,
  `holder_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `holder_id_UNIQUE` (`holder_id`),
  CONSTRAINT `fk_holder_id` FOREIGN KEY (`holder_id`) REFERENCES `holder` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (1,'WJ-5ec9f802c750e','2020-05-29 00:00:00',NULL),(2,'WJ-5ec9f96d05a02','2020-05-29 00:00:00',3);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-24  2:04:47
