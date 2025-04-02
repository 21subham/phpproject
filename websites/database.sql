-- MariaDB dump 10.19  Distrib 10.5.19-MariaDB, for Linux (x86_64)
--
-- Host: mysql    Database: assignment1
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `assignment1`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `assignment1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `assignment1`;

--
-- Table structure for table `auctions`
--

DROP TABLE IF EXISTS `auctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auctions` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `Car_Name` varchar(255) DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `categoryId` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `Foreign` (`user_id`) USING BTREE,
  CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auctions`
--

LOCK TABLES `auctions` WRITE;
/*!40000 ALTER TABLE `auctions` DISABLE KEYS */;
INSERT INTO `auctions` VALUES (15,'Test 2','2025-03-26','This is a test car again','Estate',800.00,11),(16,'Range Rover Sport','2025-03-27','The Range Rover Sport is a powerful and luxurious off-roading vehicle with modern tech and a strong presence on any terrain.','4x4',1234.00,11),(17,'Ferrari 488 GTB','2025-03-18','A breathtaking sports car known for its raw power, speed, and striking design that exudes elegance and performance.','Sports',34000.00,11),(18,'Audi e-Tron','2025-04-05','An all-electric luxury SUV with great performance and technology, making it a standout in the world of electric vehicles.','Electric',3400.00,11),(19,'Jaguar F-Type','2025-04-04','The F-Type is a stunning sports car offering sharp handling, a roaring engine, and a sleek design that demands attention.','Sports',11111.00,11),(20,'Tesla Model 3','2025-04-11','A cutting-edge electric sedan offering impressive performance, range, and tech features, perfect for eco-conscious driving.','Electric',250000.00,21),(21,'Toyota Land Cruiser','2025-03-28','A rugged off-roading SUV built for durability, perfect for tough terrains with incredible reliability.','4x4',3213.00,21),(22,'Porsche Cayman','2025-03-27','The Porsche Cayman offers precise handling and a thrilling driving experience wrapped in a beautifully crafted coupe design.','Coupe',124.00,21),(23,'Volkswagen ID.4','2025-03-31','A practical electric SUV that combines range, comfort, and modern features, ideal for anyone making the transition to electric driving.','Electric',8768.00,21),(24,'BMW 4 Series Coupe','2025-03-20','A sleek, stylish coupe with sharp handling and a luxurious interior, making every drive feel like an experience.','Coupe',6575.00,21),(25,'Mercedes-Benz E-Class','2025-03-31','A luxurious saloon offering advanced tech, comfort, and excellent ride quality, perfect for those who value refinement.','Saloon',4321.00,22),(26,'BMW X5','2025-04-23','A powerful luxury SUV with a high-tech interior and great off-road capabilities, combining comfort with adventure.','4x4',2223.00,22),(27,'Subaru Outback','2025-03-23','A versatile estate car with off-road capabilities, a spacious interior, and excellent reliability for all kinds of adventures.\r\n\r\n','Estate',100.00,22),(28,'Audi Q7','2025-04-12','The Audi Q7 combines spaciousness, comfort, and advanced tech, offering a perfect family vehicle with a premium feel.','Estate',5348.00,23),(29,'Ford Mustang','2025-04-08','The Ford Mustang is a legendary sports car that delivers exhilarating performance with an iconic design.','Sports',7876.00,23),(30,'Honda CR-V Hybrid','2025-04-24','A fuel-efficient hybrid SUV offering a smooth ride, spacious interior, and a perfect blend of eco-friendliness and practicality.','Hybrid',3214.00,23);
/*!40000 ALTER TABLE `auctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Estate'),(2,'Electric'),(3,'Coupe'),(4,'Saloon'),(5,'4x4'),(6,'Sports'),(8,'Hybrid'),(15,' Test');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `review_id` int(5) NOT NULL AUTO_INCREMENT,
  `review` varchar(200) NOT NULL,
  `postedBy` int(5) NOT NULL,
  `date` date NOT NULL,
  `forUser` int(5) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `postedBy` (`postedBy`),
  KEY `review_ibfk_2` (`forUser`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`postedBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`forUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (99,'Cool car for the price',11,'2022-01-10',11),(100,'Cool car for the price',11,'2022-01-10',11),(101,'',11,'2022-01-10',11),(102,'',11,'2022-01-10',11),(103,'good car',11,'2022-01-10',11),(104,'good car',11,'2022-01-10',11),(105,'nice one',11,'2025-03-31',11),(106,'nice one',11,'2025-03-31',11);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'subham','subham@gmail.com','9245f8437b7ad6522943cdb3bc4c30b4f50d835c','admin'),(21,'newguy','newguy@gmail.com','df9f71aae6d4743660c32761b50ac21360032f43','user'),(22,'harry','harry@gmail.com','23a0b5e4fb6c6e8280940920212ecd563859cb3c','user'),(23,'shiela','shiela@gmail.com','48443afb36db9a0c7dc751634e318b71b1649370','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'assignment1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-02  9:02:17
