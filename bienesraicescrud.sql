-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (52,' Casa en Bariloche',1500000.00,'f67a69e3affd3e49aa1381a9b9f00e5a.jpg','Amplia casa en bariloche con 4 habitaciones, 3 baños, piscina y buena vista ',4,3,2,'2023-06-15',10),(53,' Casa en la costa ',1500064.00,'7235432461ddcaa0159c1efca5556fa3.jpg','casa en la costa con 4 habitaciones y 3 baños, amplio estacionamiento y buena vista',4,3,4,'2023-06-15',10),(54,' Casa en mendoza',150000.00,'f88c64cf9636a7d6618ff8ad40713ce9.jpg','Casa en mendoza con 4 habitaciones ,5 baños amplios, jacuzzi y piscina con hermosa vista ',4,5,6,'2023-06-15',10),(55,' Casa en buenos aires',999999.00,'e13b83b5e1c9debe7ad1d08bb7d142f2.jpg','Casa enBuenos aires  con 6 habitaciones ,5 baños amplios, jacuzzi y con una  hermosa vista porteña',6,5,5,'2023-06-15',10),(56,' Casa en cordoba',2500000.00,'ebf9a417def936566e9b4e69a5ba290e.jpg','Casa en cordoba con 8 habitaciones ,5 baños amplios, jacuzzi y piscina con hermosa vista',8,5,5,'2023-06-15',10),(57,'Casa en santa cruz',3450000.00,'21440b6990b44d3ca266b2fb363f069f.jpg','Casa en santa cruz con 4 habitaciones ,5 baños amplios, jacuzzi y piscina con hermosa vista',4,4,4,'2023-06-15',10);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'correo@correo.com','$2y$10$pkoBIjWd3B6Gigv2QR5xFO1ph64eK87PvAjY0N85UL98GlZCj/cGW'),(3,'correo@correo.com','$2y$10$bB4SCre0Pl8DhYbJvThV6.ZK6eswj8ZhElU0cih/9.wHhAv/ukTEK'),(4,'correo@correo.com','$2y$10$D.KOzlbGD9IggcWc9l3e0.TFlGiq6yyy.AmLVLsrMjYADcBg1t6je'),(5,'correo@correo.com','$2y$10$WVSI0lbTpMzR8QVPZRbtGOIQ5ANG74aiwneL68L9EQg2Bv1KDQpU2'),(6,'correo@correo.com','$2y$10$OERVW98B1F8rdWyHpMXyWuqmMBH7IidxtRuMidhIQQRgcgf/BJpAS'),(7,'correo@correo.com','$2y$10$cURCAt7TQqMM.fQ7ORKzmexkdl45UwgW7iTc/LrQrqiLCtk.6ayDq');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (10,' Alan','erriu','1133859711'),(12,' Gabriel','Ramirez','1185975533');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 16:00:18
