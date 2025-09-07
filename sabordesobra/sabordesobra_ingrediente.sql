-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: sabordesobra
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingrediente` (
  `id_ingrediente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `quantidade` varchar(255) DEFAULT NULL,
  `id_receita` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `icon` blob,
  PRIMARY KEY (`id_ingrediente`),
  KEY `ingrediente_ibfk_1` (`id_receita`),
  CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id_receita`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingrediente`
--

LOCK TABLES `ingrediente` WRITE;
/*!40000 ALTER TABLE `ingrediente` DISABLE KEYS */;
INSERT INTO `ingrediente` VALUES (4,'Leite condensado','1 lata',1,6.50,NULL),(17,'Creme de leite','2 caixinhas (200 gramas cada)',1,10.00,NULL),(18,'Suco em pó de maracujá Tang','1 pacotinho (25 gramas)',1,3.00,NULL),(19,'Polpa de maracujá','1 a 2 maracujás (100 gramas)',1,2.00,NULL),(20,'Água','1/2 xícara de chá (120 ml)',1,0.00,NULL),(21,'Açúcar','1/2 xícara de chá (100 gramas)',1,1.00,NULL),(22,'Amido de milho','1 colher de sopa',1,0.50,NULL),(27,'ovo','1',2,2.09,NULL),(28,'azeite','1',2,0.10,NULL),(29,'sal','1',2,0.01,NULL),(30,'pimenta-do-reino','1',2,0.05,NULL),(31,'Farinha de Trigo','2 xícaras',4,3.50,NULL),(32,'Açúcar','1 xícara',4,2.00,NULL),(33,'Cacau em Pó','1/2 xícara',4,5.00,NULL),(34,'Fermento','1 colher de sopa',4,1.00,NULL),(35,'Aveia em Flocos','1 xícara',5,2.50,NULL),(36,'Leite','1/2 xícara',5,1.50,NULL),(37,'Ovo','1 unidade',5,0.50,NULL),(38,'Mel','2 colheres de sopa',5,2.00,NULL),(39,'Maçã','1 unidade',6,1.20,NULL),(40,'Banana','1 unidade',6,1.00,NULL),(41,'Laranja','1 unidade',6,0.80,NULL),(42,'Morangos','100g',6,3.50,NULL),(43,'Batata','2 unidades',7,1.80,NULL),(44,'Cenoura','1 unidade',7,0.90,NULL),(45,'Cebola','1 unidade',7,0.70,NULL),(46,'Abóbora','200g',7,1.50,NULL),(47,'Farinha de Trigo','2 xícaras',8,3.50,NULL),(48,'Açúcar','1 xícara',8,2.00,NULL),(49,'Cacau em Pó','1/2 xícara',8,5.00,NULL),(50,'Fermento','1 colher de sopa',8,1.00,NULL),(58,'ingrediente a','1 ml',17,NULL,NULL),(59,'ingrediente b','4 unidade',17,NULL,NULL);
/*!40000 ALTER TABLE `ingrediente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-11 11:53:28
