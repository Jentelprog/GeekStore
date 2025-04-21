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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'sakamoto figure',25.99,'http://localhost/Geekstore/img/sakamoto_toy.webp','sakamoto days figure,yong sakamoto holdin a gun.','figure'),(2,'solo leveling hoodie',39.99,'http://localhost/Geekstore/img/sl_hoodie.webp','solo leveling black hoodie,Sung Jin-woo holding his dagger','hoodie'),(4,'giyu figure',25.99,'http://localhost/Geekstore/img/giyu_toy.webp','giyu from demon slayer figure,doing an attack ','figure'),(5,'akatsuki hoodie',39.99,'http://localhost/Geekstore/img/akatsuki_hoodie.webp','a hoodie that have the akatsuki logo','hoodie'),(6,'komi sticker',1.00,'http://localhost/Geekstore/img/komi sticker.jpg','excited komi ,from komi-san the manga','sticker'),(7,'ghibli stickers',5.99,'http://localhost/Geekstore/img/anime stickers example.jpg','ghibli movie stickers,12 sticker','sticker'),(8,'chainsawman figure',29.99,'http://localhost/Geekstore/img/chainsawman_figure.jpg','the chainsawman anime figure,chainsawman killing and a lot of blood','figure'),(9,'one punch man sticker',1.00,'http://localhost/Geekstore/img/ok-sticker-510x510.webp','one punch man sticker,ok','sticker'),(10,'boku no hero collection ',5.00,'https://www.alotmall.com/cdn/shop/files/My-Hero-Academia-Sticker-Characters-Stickers-100-Pcs-Set-6_620x620.jpg?v=1712636040','boku no hero sticker collection ','sticker'),(11,'My Neighbour Totoro Sticker',1.00,'https://peeekaboo.in/cdn/shop/files/MyNeighbourTotoroSticker.jpg?v=1702738117&width=533','My Neighbour Totoro Sticker from ghibli ','sticker'),(17,'itachi figure',100.00,'https://image.made-in-china.com/202f0j00PWAksehwGFoU/Factory-Supply-Gk-Fight-Uchiha-Itachi-Naruto-Wholesale-Japanese-Anime-Statue-Figure-Toy.webp','itachi figure sitting in a throne ','figure'),(18,'Kaiju No. 8 hoodie',69.00,'https://shonenjumpstore.com/cdn/shop/files/black_hoodie_back_9c92dd6f-f144-4ac1-a9ab-c68578ab3b1e_1800x1800.jpg?v=1741649334','Kaiju No. 8 Young Talents Hoodie ,manga scene','hoodie'),(19,'Kaiju No 8 Hoodie',80.00,'https://fandomaniax-holidays.com/cdn/shop/files/Cotton_Hoodie_l_Kaiju_No_8_-_07.jpg?v=1719812691','Kaiju No 8 Cotton Hoodie green and black','hoodie'),(20,'Kaiju No. 8 Stickers ',15.00,'https://otaku.shop/cdn/shop/files/KAIJU-STICKERS-JPEG-FILE.jpg?v=1723826393','Kaiju No. 8 Vinyl Sticker Pack (Kaiju No. 8)','sticker'),(21,'Kaiju No 8 Sticker ',2.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3RD97LA2LkoaM_1htGrUAaCS-0EeaSkLfug&s','half kafka half kaiju no 8','sticker'),(22,'Kaiju No. 8 S.H.Figuarts ',100.00,'https://images.bigbadtoystore.com/images/p/full/2024/06/1f7b536d-bce4-414a-badd-c2a448be9471.jpg','Kaiju No. 8 S.H.Figuarts Kaiju No. 9 Action Figure','figure'),(23,'Kaiju No. 8 figure',100.00,'https://yugen-collectibles.com/40790-large_default/kaiju-no-8-artfxj-18-figurine-kaiju-no-8.jpg','Figurine Kaiju No. 8 | Figurine Kaiju No. 8','figure'),(24,'Jujutsu Kaisen figure',50.00,'https://m.media-amazon.com/images/I/61InyiFCekS._AC_SL1500_.jpg','Jujutsu Kaisen: Figurine d\'action nendoroïde Yuji Itadori, Figurine multicolore Version Q ','figure'),(25,'Jujutsu Kaisen figure',150.00,'https://i.ebayimg.com/images/g/EooAAOSwWJFl7xwc/s-l960.jpg','Satoru Gojo Jujutsu Kaisen Model Statue Action Figure Figurine','figure'),(26,'Jujutsu Kaisen Hoodie',40.00,'https://www.projectxparis.com/60191-thickbox_default/jk06.jpg','jujutsu kaisen team hoodie','hoodie'),(27,'Jujutsu Kaisen Hoodie',40.00,'https://anime-figures-store.com/cdn/shop/products/itadori-yuji-sweater-cosplay-jujutsu-kaisen-531.png?v=1741351692&width=533','Jujutsu Kaisen - Hoodie & Sweater','hoodie'),(28,'Jujutsu Kaisen Anime Stickers',40.00,'https://m.media-amazon.com/images/I/81CgloMaj2L._AC_SL1500_.jpg','10 Pcs Jujutsu Kaisen Anime Stickers for Water Bottles Hydroflask Laptop Computer Skateboard Luggage Decal Waterproof Reflective Vinyl Aesthetic Cute Sticker Packs Gift for Kids Teens Adults','sticker'),(29,'Jujutsu kaisen Anime Sticker',3.00,'https://i.pinimg.com/736x/40/18/3c/40183c02bddade92161b6b307d914110.jpg','Jujutsu kaisen Anime Sticker ,team first year','sticker'),(30,'blue lock sticker',2.00,'https://i.pinimg.com/736x/ac/b6/b2/acb6b2f6f4bb9337921fc7eb02e2444b.jpg','blue lock sticker, rin ,football','sticker'),(31,'Blue Lock Stickers',50.00,'https://m.media-amazon.com/images/I/819YZlzbkpL._AC_SL1200_.jpg','Blue Lock Stickers - Pack of 50 - Shiro Nagi, Bee Raku, Kiichi Seikiri - Anime Goods - Waterproof PVC - Cute DIY Decoration','sticker'),(32,'Blue Lock figure',120.00,'https://m.media-amazon.com/images/I/61ZlDzk2vzL._AC_UF894,1000_QL80_.jpg','Blue Lock - Oliver Aiku (Chain of Enthusiasm) Collectible Statue','figure'),(33,'Blue Lock figure',90.00,'https://m.media-amazon.com/images/I/61SEbVl7gzL._AC_SL1500_.jpg','Banpresto - Blue Lock - Seishiro Nagi (TBA), Bandai Spirits Figure ','figure'),(34,'Blue Lock Oversized Hoodie',100.00,'https://crazymonk.in/cdn/shop/files/NagiBlueLock_2.jpg?v=1744809597','Nagi Blue Lock Oversized Hoodie - Multi Color Sky Blue/White','hoodie'),(35,'Blue Lock Anime Hoodie ',100.00,'https://m.media-amazon.com/images/I/81CkZBYOxnL._SY679_.jpg','crazymonk Blue Lock Eyes Unisex Anime Hoodie ','hoodie');
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

-- Dump completed on 2025-04-20 15:31:59
