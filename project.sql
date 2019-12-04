-- MySQL dump 10.13  Distrib 5.7.26, for osx10.9 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first` varchar(15) NOT NULL,
  `last` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (66,'Tim','Apple','8002733323'),(67,'Austin','Nadler','6187951623'),(68,'Ricky','Bobby','3219997788'),(69,'Bill','Little','4569129384'),(70,'Rick','Sanchez','9897749999'),(71,'Zachary','North','7779993343');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permits`
--

DROP TABLE IF EXISTS `permits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer$id` int(10) unsigned NOT NULL,
  `vehicle$id` int(10) unsigned NOT NULL,
  `dateIssued` char(10) NOT NULL,
  `dateExpires` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer$id` (`customer$id`),
  KEY `vehicle$id` (`vehicle$id`),
  CONSTRAINT `permits_ibfk_1` FOREIGN KEY (`customer$id`) REFERENCES `customers` (`id`),
  CONSTRAINT `permits_ibfk_2` FOREIGN KEY (`vehicle$id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permits`
--

LOCK TABLES `permits` WRITE;
/*!40000 ALTER TABLE `permits` DISABLE KEYS */;
INSERT INTO `permits` VALUES (135,66,100,'12/04/2019','12/04/2020'),(136,67,101,'12/04/2019','12/04/2020'),(137,67,102,'12/04/2019','12/04/2020'),(138,66,103,'12/04/2019','12/04/2020'),(139,68,104,'12/04/2019','12/04/2020'),(140,69,105,'12/04/2019','12/04/2020'),(141,69,106,'12/04/2019','12/04/2020'),(142,70,107,'12/04/2019','12/04/2020'),(143,69,108,'12/04/2019','12/04/2020'),(144,71,109,'12/04/2019','12/04/2020');
/*!40000 ALTER TABLE `permits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'guest','$2y$10$BO8B.HI1Zy8i3REVGoSf.uiTS1up6yg0d8xZWap00wxnf0pfraDDy'),(6,'Austin','$2y$10$JXtfiNVHgOTIe2ORwpl5KOrfyC9AsxuJ7MWlr7yq914U1JxD.OONS');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer$id` int(10) unsigned NOT NULL,
  `make` varchar(15) NOT NULL,
  `model` varchar(30) NOT NULL,
  `licensePlate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer$id` (`customer$id`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`customer$id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (100,66,'Apple','iCar Pro','AAPL 941'),(101,67,'Ford','Explorer','B27 4079'),(102,67,'Toyota','Camry','Z25 V980'),(103,66,'Apple','iCar Pro Max','AAPL 1022'),(104,68,'Chevrolet','Malibu','APLBS'),(105,69,'Ford','F 150','US 1973'),(106,69,'Ford','Focus','E33 9394'),(107,70,'Ferrari','F 40','FER 9835'),(108,69,'Buick','Enclave','BUE 3412'),(109,71,'Volkswagen','Jetta','BIK 4354');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-03 22:32:43
