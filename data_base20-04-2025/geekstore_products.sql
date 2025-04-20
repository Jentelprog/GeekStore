-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: geekstore
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `category_check` CHECK ((`category` in (_utf8mb4'sticker',_utf8mb4'hoodie',_utf8mb4'figure')))
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'sakamoto figure',25.99,'http://localhost/Geekstore/img/sakamoto_toy.webp','sakamoto days figure,yong sakamoto holdin a gun.','figure'),(2,'solo leveling hoodie',39.99,'http://localhost/Geekstore/img/sl_hoodie.webp','solo leveling black hoodie,Sung Jin-woo holding his dagger','hoodie'),(4,'giyu figure',25.99,'http://localhost/Geekstore/img/giyu_toy.webp','giyu from demon slayer figure,doing an attack ','figure'),(5,'akatsuki hoodie',39.99,'http://localhost/Geekstore/img/akatsuki_hoodie.webp','a hoodie that have the akatsuki logo','hoodie'),(6,'komi sticker',1.00,'http://localhost/Geekstore/img/komi sticker.jpg','excited komi ,from komi-san the manga','sticker'),(7,'ghibli stickers',5.99,'http://localhost/Geekstore/img/anime stickers example.jpg','ghibli movie stickers,12 sticker','sticker'),(8,'chainsawman figure',29.99,'http://localhost/Geekstore/img/chainsawman_figure.jpg','the chainsawman anime figure,chainsawman killing and a lot of blood','figure'),(9,'one punch man sticker',1.00,'http://localhost/Geekstore/img/ok-sticker-510x510.webp','one punch man sticker,ok','sticker'),(10,'boku no hero collection ',5.00,'https://www.alotmall.com/cdn/shop/files/My-Hero-Academia-Sticker-Characters-Stickers-100-Pcs-Set-6_620x620.jpg?v=1712636040','boku no hero sticker collection ','sticker'),(11,'My Neighbour Totoro Sticker',1.00,'https://peeekaboo.in/cdn/shop/files/MyNeighbourTotoroSticker.jpg?v=1702738117&width=533','My Neighbour Totoro Sticker from ghibli ','sticker'),(17,'itachi figure',100.00,'https://image.made-in-china.com/202f0j00PWAksehwGFoU/Factory-Supply-Gk-Fight-Uchiha-Itachi-Naruto-Wholesale-Japanese-Anime-Statue-Figure-Toy.webp','itachi figure sitting in a throne ','figure');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 12:50:51
