CREATE DATABASE `maternidade` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `maternidade`;
-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: maternidade
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `idDepartamento` int NOT NULL AUTO_INCREMENT,
  `idUnidade` int NOT NULL,
  `nome` varchar(70) NOT NULL,
  `numero_leito` int DEFAULT '0',
  `alta_prevista` int DEFAULT '0',
  `leito_ocupado` int DEFAULT '0',
  `numero_obito` int DEFAULT '0',
  `admissao` int DEFAULT '0',
  `procedimentos_realizados` int DEFAULT '0',
  PRIMARY KEY (`idDepartamento`,`idUnidade`),
  KEY `fk_Departamento_Unidade_idx` (`idUnidade`),
  CONSTRAINT `fk_Departamento_Unidade` FOREIGN KEY (`idUnidade`) REFERENCES `unidade` (`idUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,1,'Emergência',16,5,0,1,0,0),(2,1,'Centro Obstétrico',10,0,5,0,0,1),(3,1,'Centro Cirúrgico',15,2,8,1,0,0),(4,1,'Emergência Obstetrica',10,1,2,0,0,0),(5,1,'UTI Neo',10,1,3,1,0,0),(6,1,'Escala p/o Plantão Seguinte',0,0,0,0,0,0),(7,1,'UCIN Co',0,1,0,0,0,0),(8,1,'UCIN Ca',0,1,0,0,0,0),(9,1,'Alojamento Conjunto',0,0,0,0,0,0),(10,1,'Motorista',0,0,0,0,0,0),(11,1,'Berçário',0,0,0,0,0,0),(12,1,'Banco de Leite',0,0,0,0,0,0),(13,1,'Recepção ADM',0,0,0,0,0,0),(14,1,'USG',0,0,0,0,0,0),(15,1,'Técnico em Nutrição',0,0,0,0,0,0),(16,1,'Óbitos',0,0,0,0,0,0),(17,1,'Rouparia',0,0,0,0,0,0),(18,1,'Psicologia',0,0,0,0,0,0),(19,1,'Terapeuta Ocupacional',0,0,0,0,0,0),(20,1,'Higienização',0,0,0,0,0,0);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escala`
--

DROP TABLE IF EXISTS `escala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escala` (
  `idEscala` int NOT NULL AUTO_INCREMENT,
  `idDepartamento` int NOT NULL,
  `idUnidade` int NOT NULL,
  `turno` varchar(10) NOT NULL,
  `data_escala` date NOT NULL,
  PRIMARY KEY (`idEscala`,`idDepartamento`,`idUnidade`),
  KEY `fk_Escala_Departamento1_idx` (`idDepartamento`,`idUnidade`),
  CONSTRAINT `fk_Escala_Departamento1` FOREIGN KEY (`idDepartamento`, `idUnidade`) REFERENCES `departamento` (`idDepartamento`, `idUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escala`
--

LOCK TABLES `escala` WRITE;
/*!40000 ALTER TABLE `escala` DISABLE KEYS */;
INSERT INTO `escala` VALUES (1,1,1,'SD','2024-06-25'),(2,1,1,'SN','2024-06-25'),(3,2,1,'SN','2024-06-25'),(4,2,1,'SD','2024-06-25'),(5,3,1,'MT','2024-06-25'),(6,3,1,'SN','2024-06-25'),(7,3,1,'SD','2024-06-25'),(8,6,1,'MT','2024-06-25'),(9,5,1,'MT','2024-06-25'),(10,7,1,'MT','2024-06-25'),(11,8,1,'MT','2024-06-25'),(12,9,1,'MT','2024-06-25'),(13,10,1,'MT','2024-06-25'),(14,11,1,'MT','2024-06-25'),(15,12,1,'MT','2024-06-25'),(16,13,1,'MT','2024-06-25'),(17,14,1,'MT','2024-06-25'),(18,15,1,'MT','2024-06-25'),(19,16,1,'MT','2024-06-25'),(20,17,1,'MT','2024-06-25'),(21,18,1,'MT','2024-06-25'),(22,19,1,'MT','2024-06-25'),(23,20,1,'MT','2024-06-25');
/*!40000 ALTER TABLE `escala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escalacao`
--

DROP TABLE IF EXISTS `escalacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escalacao` (
  `Escala_idEscala` int NOT NULL,
  `Escala_idDepartamento` int NOT NULL,
  `Escala_idUnidade` int NOT NULL,
  `Funcionario_idFuncionario` int NOT NULL,
  PRIMARY KEY (`Escala_idEscala`,`Escala_idDepartamento`,`Escala_idUnidade`,`Funcionario_idFuncionario`),
  KEY `fk_Escala_has_Funcionario_Funcionario1_idx` (`Funcionario_idFuncionario`),
  KEY `fk_Escala_has_Funcionario_Escala1_idx` (`Escala_idEscala`,`Escala_idDepartamento`,`Escala_idUnidade`),
  CONSTRAINT `fk_Escala_has_Funcionario_Escala1` FOREIGN KEY (`Escala_idEscala`, `Escala_idDepartamento`, `Escala_idUnidade`) REFERENCES `escala` (`idEscala`, `idDepartamento`, `idUnidade`),
  CONSTRAINT `fk_Escala_has_Funcionario_Funcionario1` FOREIGN KEY (`Funcionario_idFuncionario`) REFERENCES `funcionario` (`idFuncionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escalacao`
--

LOCK TABLES `escalacao` WRITE;
/*!40000 ALTER TABLE `escalacao` DISABLE KEYS */;
INSERT INTO `escalacao` VALUES (1,1,1,1),(2,1,1,2),(3,2,1,3),(4,2,1,4),(5,3,1,5),(6,3,1,6),(7,3,1,7);
/*!40000 ALTER TABLE `escalacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expediente`
--

DROP TABLE IF EXISTS `expediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expediente` (
  `Funcionario_idFuncionario` int NOT NULL,
  `Plantao_idPlantao` int NOT NULL,
  `Plantao_idEscala` int NOT NULL,
  `Plantao_idDepartamento` int NOT NULL,
  `Plantao_idUnidade` int NOT NULL,
  PRIMARY KEY (`Funcionario_idFuncionario`,`Plantao_idPlantao`,`Plantao_idEscala`,`Plantao_idDepartamento`,`Plantao_idUnidade`),
  KEY `fk_Funcionario_has_Plantao_Plantao1_idx` (`Plantao_idPlantao`,`Plantao_idEscala`,`Plantao_idDepartamento`,`Plantao_idUnidade`),
  KEY `fk_Funcionario_has_Plantao_Funcionario1_idx` (`Funcionario_idFuncionario`),
  CONSTRAINT `fk_Funcionario_has_Plantao_Funcionario1` FOREIGN KEY (`Funcionario_idFuncionario`) REFERENCES `funcionario` (`idFuncionario`),
  CONSTRAINT `fk_Funcionario_has_Plantao_Plantao1` FOREIGN KEY (`Plantao_idPlantao`, `Plantao_idEscala`, `Plantao_idDepartamento`, `Plantao_idUnidade`) REFERENCES `plantao` (`idPlantao`, `idEscala`, `idDepartamento`, `idUnidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expediente`
--

LOCK TABLES `expediente` WRITE;
/*!40000 ALTER TABLE `expediente` DISABLE KEYS */;
INSERT INTO `expediente` VALUES (1,1,1,1,1),(2,2,2,1,1),(3,3,3,2,1),(4,4,4,2,1),(5,5,5,3,1),(6,6,6,3,1),(7,7,7,3,1);
/*!40000 ALTER TABLE `expediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `idFuncionario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `matricula` varchar(11) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cargaHoraria` int DEFAULT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,'Maria Santos','Tecnica de enfermagem','111333','02632145695',40),(2,'Carlos Silva','Cardiologia','111222','12345678901',40),(3,'Charles Campos','Enfermagem Geral','111444','23456789012',36),(4,'Nete Lima','Laboratório Clínico','111555','34567890123',32),(5,'Bruna Da Costa','Pediatria','222111','45678901234',40),(6,'Maria das Graças','Neonatologista','222222','56789012246',25),(7,'Victoria kolosk','Enfermagem Geral','222333','56789012345',36);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantao`
--

DROP TABLE IF EXISTS `plantao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plantao` (
  `idPlantao` int NOT NULL AUTO_INCREMENT,
  `idEscala` int NOT NULL,
  `idDepartamento` int NOT NULL,
  `idUnidade` int NOT NULL,
  `falta_tecnico` int DEFAULT '0',
  `func_remanejado` int DEFAULT '0',
  `dobra_funcionario` int DEFAULT '0',
  `prescritor` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Sem prescritor',
  `enfermeiro` int DEFAULT '0',
  `responsavel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_bin DEFAULT 'Sem responsavel',
  `data_plantao` date DEFAULT NULL,
  `tecnico` int DEFAULT '0',
  `medico_plantonista` int DEFAULT '0',
  `falta_enfermeiro` int DEFAULT '0',
  `falta_funcionario` int DEFAULT '0',
  `presente_funcionario` int DEFAULT '0',
  `dobra_tecnico` int DEFAULT '0',
  `dobra_enfermeiro` int DEFAULT '0',
  `leitos_ocupados` int DEFAULT '0',
  `alta_prevista` int DEFAULT '0',
  PRIMARY KEY (`idPlantao`,`idEscala`,`idDepartamento`,`idUnidade`),
  KEY `fk_Plantao_Escala1_idx` (`idEscala`,`idDepartamento`,`idUnidade`),
  CONSTRAINT `fk_Plantao_Escala1` FOREIGN KEY (`idEscala`, `idDepartamento`, `idUnidade`) REFERENCES `escala` (`idEscala`, `idDepartamento`, `idUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantao`
--

LOCK TABLES `plantao` WRITE;
/*!40000 ALTER TABLE `plantao` DISABLE KEYS */;
INSERT INTO `plantao` VALUES (1,1,1,1,2,2,5,'Dr. Smith',12,'Tafarel',NULL,12,3,1,0,0,2,1,0,0),(2,2,1,1,1,1,1,'Dr. Johnson',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(3,3,2,1,0,0,0,'Dr. Brown',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(4,4,2,1,1,1,1,'Dr. Davis',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(5,5,3,1,0,0,2,'Dr. Miller',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(6,6,3,1,0,0,2,'Dr. Ezequias',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(7,7,3,1,0,1,0,'Dr. Acer',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(8,8,6,1,0,0,0,'Sem Prescritor',1,'Sem Responsável',NULL,1,0,0,0,0,0,0,0,0),(9,9,5,1,2,1,2,'Sem Prescritor',4,'Sem Responsável',NULL,3,1,1,2,0,2,1,0,0),(10,10,7,1,4,2,4,'Sem Prescritor',8,'Sem Responsável',NULL,6,2,2,4,0,4,2,0,0),(11,11,8,1,5,3,5,'Sem Prescritor',9,'Sem Responsável',NULL,7,3,3,5,0,5,3,0,0),(12,12,9,1,6,4,6,'Sem Prescritor',10,'Sem Responsável',NULL,8,4,4,6,0,6,4,0,0),(13,13,10,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(14,14,11,1,7,5,7,'Sem Prescritor',11,'Sem Responsável',NULL,9,5,5,7,0,7,0,0,0),(15,15,12,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(20,16,13,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(21,17,14,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(22,18,15,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(23,19,16,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(24,20,17,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(25,21,18,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(26,22,19,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,0,0,0,0,0),(27,23,20,1,0,0,0,'Sem Prescritor',0,'Sem Responsável',NULL,0,0,0,0,10,0,0,0,0);
/*!40000 ALTER TABLE `plantao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidade`
--

DROP TABLE IF EXISTS `unidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unidade` (
  `idUnidade` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `endereco` varchar(400) NOT NULL,
  `cnes` int NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idUnidade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidade`
--

LOCK TABLES `unidade` WRITE;
/*!40000 ALTER TABLE `unidade` DISABLE KEYS */;
INSERT INTO `unidade` VALUES (1,'Maternidade Regional de Camaçari','Rua Principal-Jardim Limoeiro-Camaçari-BA',30215,'7136543701');
/*!40000 ALTER TABLE `unidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_` datetime DEFAULT NULL,
  `updated_count` int DEFAULT '0',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'aaa','aa@gmail.com','7182753453','123',1,'2024-06-22 06:04:28',NULL,0),(2,'bbb','a12a@gmail.com','12345678','w87fS3P8gRn35gL',1,'2024-06-22 07:40:39',NULL,0),(3,'bbb','a123a@gmail.com','12345678','123',1,'2024-06-22 21:36:15',NULL,0),(4,'bbb','a1234a@gmail.com','12345678','123',1,'2024-06-22 21:42:42',NULL,0),(5,'bbb','a12345a@gmail.com','12345678','123',1,'2024-06-22 21:43:12',NULL,0),(6,'bbb','a123456a@gmail.com','12345678','123',1,'2024-06-22 21:43:28',NULL,0),(7,'bbb','bbbb@gmail.com','12345678','123',1,'2024-06-22 21:44:08',NULL,0),(8,'bbb','bbbb1@gmail.com','12345678','123',1,'2024-06-22 21:45:13',NULL,0),(9,'bbb','aa1@gmail.com','12345678','123',1,'2024-06-22 21:47:48',NULL,0),(10,'bbb','aa2@gmail.com','71123123','123',1,'2024-06-22 21:54:01',NULL,0),(11,'bbb123','bbbb12@gmail.com','71123123','123',1,'2024-06-22 21:55:55',NULL,0),(12,'asasa','aba@gmail.com','12345678','123',1,'2024-06-22 21:56:41',NULL,0),(13,'asasa','aba12@gmail.com','12345678','123',1,'2024-06-22 21:59:40',NULL,0),(14,'111','1234@gmail.com','12345678','123',1,'2024-06-24 21:38:31',NULL,0),(15,'asasasasasa','123@gmail.com','12345678','123',1,'2024-06-26 22:56:45',NULL,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-27 19:17:27