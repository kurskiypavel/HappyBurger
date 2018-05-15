-- MySQL dump 10.13  Distrib 5.7.22, for osx10.13 (x86_64)
--
-- Host: 127.0.0.1    Database: happyburger
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_img_name` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_img_name` (`product_img_name`),
  UNIQUE KEY `product_code` (`product_code`),
  FULLTEXT KEY `ProductNameFullText` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Colours May Vary','Working with the awesome rebrand by created, we designed and built Colours May Vary a playful, functional website and online shop. With popping colours, subtle motion and a spacious layout.','colours_may_vary.png','colours_may_vary',400,2),(246,'Nike Golf Club','The reinvention of the golf club for a new generation. Nike Golf Club is a premium, member-based program that gives modern golfers access to the best of Nike Golf Ð everything from exclusive enablement content in the form of Pro tips to first dibs on limi','Nike Golf Club.jpg','Nike Golf Club.jpg',499,NULL),(247,'BALLY ANIMALS','Stop motion video I\'ve realized for the fashion Switzerland brand BALLY.','BALLY ANIMALS.jpg','BALLY ANIMALS.jpg',598,NULL),(248,'Digital Maker Collective at Tate','Tate Exchange Associates include charities to universities, healthcare trusts to community radio stations working within and beyond the arts, working closely with one another and with Tate to respond to the theme of ÔexchangeÕ.ÊThe Digital Maker Collectiv','80646065447679.5af4673dbbf4f.jpg','Digital Maker Collective at Tate',697,NULL),(249,'CHASE Illustrations','Illustration','b5fc7164777125.5af33b47dff75.png','CHASE Illustrations',796,NULL),(250,'Selected recent and not so recent projects.','Selected recent and not so recent projects.','32ece665276813.5af057b0a0f0a.jpg','Selected recent and not so recent projects.',895,NULL),(251,'Handmade Illustrations','Handmade Illustrations','ceddd164785095.5aeb6f66836d4.jpg','Handmade Illustrations',994,NULL),(252,'HIDDEN CITIES','Modernist housing estates erected in the suburbs of European cities after WW2 have been ignored andÊneglected for decades. Although they are homes to the vast majority of urbanites, many would rather they wereÊinvisible. This instant film inspired photo s','e86b7365184659.5aeb50d0b047b.jpg','HIDDEN CITIES',1093,NULL),(253,'FENDER Marine Layer Reverb','Wade in the shimmering haze of the Marine Layer Reverb pedal.','cc69d364252161.5acc84b860130.png','FENDER Marine Layer Reverb',1192,NULL),(254,'3D Characters','more 3D characters :)','f678b365318367.5af080440c5e9.jpg','3D Characters',1291,NULL),(255,'Kirimizi','Kirimizi is a new charming hotel by the beach, in Pemba, Mozambique, with 38 rooms aimed mainly at westerns working locally. Architecture by Carlos Prata and interiors by Mariana Setas.','9e827452816291.591dbe2e841cb.jpg','Kirimizi',1390,NULL),(256,'Oceania','Here comes the Oceania,Êthe third map illustration project of mine.Ê','6ab20964459729.5ae8f27839663.png','Oceania',1489,NULL),(257,'Monolicious III','The 3rd part of the architectural series about the relationship of lines, forms and surfaces.','6e377b65169249.5aeaf79e32814.jpg','Monolicious III',1588,NULL),(258,'Leftovers & More','Recent work','98c19763511809.5adb8fa9851d1.jpg','Leftovers & More',1687,NULL),(259,'Architects EAT','Architects Eat is an award winning architecture firm based in Melbourne. Their service process and attributes is about simple straight forward execution whether it be design, the methodology or the relationship between the client and architect, the outcom','3c88a362712527.5a98eeb801fb5.jpg','Architects EAT',1786,NULL),(260,'GATORADE \'Triumph\' X SNAPCHAT','Designed 6 filters for Gatorade\'s snapchat campaign','e9eedd64033547.5af2cdf299fb0.jpg','GATORADE \'Triumph\' X SNAPCHAT',1885,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `review_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  UNIQUE KEY `reviews_id_uindex` (`review_id`),
  FULLTEXT KEY `FullText` (`review`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (17,'1','1','awesome designe','2018-05-13 00:58:11',50),(18,'1','7','Hello from mancha!','2018-05-13 00:58:11',100),(19,'1','3','Great experience!','2018-05-13 00:58:11',50),(20,'1','3','not too bad, give it 50','2018-05-13 00:58:11',50),(21,'1','5','couldn\'t find any useful information','2018-05-13 00:58:11',12),(22,'1','5','some good rating','2018-05-13 00:58:11',78),(23,'246','1','great job!','2018-05-13 00:58:11',50),(24,'246','7','exlellent!','2018-05-13 00:58:11',12),(25,'247','8','awesome design','2018-05-13 00:58:11',50),(26,'248','9','good colors to use!','2018-05-13 00:58:11',12),(27,'248','10','useful information here','2018-05-13 00:58:11',78),(28,'248','11','really good site to find any ideas','2018-05-13 00:58:11',50),(29,'249','12','thanks!','2018-05-13 00:58:11',50),(30,'250','8','dullÉ','2018-05-13 00:58:11',12),(31,'250','9','very good!','2018-05-13 00:58:11',78),(32,'251','10','respect','2018-05-13 00:58:11',50),(33,'251','11','thank you for pictures and advices','2018-05-13 00:58:11',50),(34,'251','12','couldn\'t find any useful information','2018-05-13 00:58:11',12),(35,'252','8','hey guys, many thanks for great pics!','2018-05-13 00:58:11',78),(36,'252','9','good! Thanks','2018-05-13 00:58:11',50),(37,'252','10','nice','2018-05-13 00:58:11',50),(38,'253','11','very nice pictures','2018-05-13 00:58:11',50),(39,'253','12','poor information here','2018-05-13 00:58:11',12),(40,'254','8','hey guys, many thanks for great pics!','2018-05-13 00:58:11',50),(41,'254','9','bad','2018-05-13 00:58:11',12),(42,'254','10','nice','2018-05-13 00:58:11',78),(43,'255','11','very nice pictures','2018-05-13 00:58:11',50),(44,'256','12','hey guys, many thanks for great pics!','2018-05-13 00:58:11',50),(45,'256','9','couldn\'t find any useful information','2018-05-13 00:58:11',12),(46,'257','10','nice','2018-05-13 00:58:11',78),(47,'257','11','very nice pictures','2018-05-13 00:58:11',50);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_img` varchar(50) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `notify` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'paul kurski','$2y$10$zOm3HIgxQM2zT27P1s9/ZeGvjFwmZzz.aYdX4L5KWHm06nr/FDsKa','2018-04-23 21:46:05','1.jpg','1990-07-13','+7(905)123-4568',1,0),(7,'alejandro sanabria','$2y$10$28O8v3wxwq5py3AWce8DwuH7/etyDi2bhsgqfhZs8eg3RMnnSDJxy','2018-05-11 12:41:50','7.jpg','2018-05-15','',0,1),(8,'Chris Fidao','$2y$10$o2eb1sYIlt2.2qPD2mudHeVUjVXU8fRGam0nFOjD..19gw6SA5..2','2018-05-11 12:50:08','8.jpg','2018-05-18','',1,0),(9,'dries vints','$2y$10$6ZKtdzPMwLqkOtELAsN1suiAVjUbxoBOjjH4sr/EXH.wg4Iok83.u','2018-05-11 12:52:26',NULL,NULL,NULL,NULL,1),(10,'eric barnes','$2y$10$Ht9TYvsU50jYDXZ2PoMTXecPZOMhAX0V8W8EkkapynrVjnM11sZSy','2018-05-11 12:52:54','10.jpg',NULL,NULL,NULL,1),(11,'ian landsman','$2y$10$i3rXePFooZxQBQMbvzurYu1l1RYIeuoCrF.2XlP.Uf5KnCyRELu32','2018-05-11 12:57:05','11.jpg',NULL,NULL,NULL,1),(12,'ionut-tanasa','$2y$10$ZHT8AgTq13ClDnYWrYQeCOElST4bswGioTGDAmgI/D9JXLTpRaFge','2018-05-11 12:57:33','12.jpg',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-15 19:21:08
