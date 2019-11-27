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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (2,'Tim','Apple','8002752273'),(4,'Heather Mae','Daiquiri','7891148347'),(5,'Michael','Henderson','1112223333'),(6,'Rick','James','1234123441'),(10,'Cameron','Fitzgerald','1234123490'),(22,'Bill','Little','8794072314'),(23,'Ricky','Bobby','9908839273'),(24,'Rich','Guy','9993380946'),(27,'Jimmy','Neutron','8056893542'),(28,'Bo','Duke','9079058403');
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
  PRIMARY KEY (`id`),
  KEY `customer$id` (`customer$id`),
  KEY `vehicle$id` (`vehicle$id`),
  CONSTRAINT `permits_ibfk_1` FOREIGN KEY (`customer$id`) REFERENCES `customers` (`id`),
  CONSTRAINT `permits_ibfk_2` FOREIGN KEY (`vehicle$id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permits`
--

LOCK TABLES `permits` WRITE;
/*!40000 ALTER TABLE `permits` DISABLE KEYS */;
INSERT INTO `permits` VALUES (5,4,5),(7,5,7),(29,5,6),(40,6,13),(44,10,17),(53,2,18),(54,2,19),(59,22,24),(64,22,29),(65,4,30),(66,23,31),(67,24,32),(72,2,37),(73,2,38),(74,27,39),(76,28,41);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'guest','$2y$10$BO8B.HI1Zy8i3REVGoSf.uiTS1up6yg0d8xZWap00wxnf0pfraDDy');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (5,4,'Alfa Romeo','Stelvio','KL 9090'),(6,5,'Chevy','Silverado','S01 8893'),(7,5,'Ford','Focus','ADS0032'),(13,6,'Lamborghini','Murcielago','900 AHF'),(17,10,'Tesla','Model S','FITZ 94'),(18,2,'Apple','iCar Pro','AAPL 941'),(19,2,'BMW','5 Series','AAPL 512'),(24,22,'Ford','Focus','E33 3920'),(29,22,'Ford','F 150','US 1973'),(30,4,'Tesla','Model S','E 939'),(31,23,'Chevrolet','Malibu','FF 9839'),(32,24,'Lamborghini','Hurican','900 HP'),(37,2,'Porsche','Boxter','ADS 2344'),(38,2,'Apple','iCar Pro Max','AAPL 1024'),(39,27,'Maserati','Gran Turismo','JN 2344'),(41,28,'Dodge','Charger','CNH 320');
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

-- Dump completed on 2019-11-20 11:30:09
