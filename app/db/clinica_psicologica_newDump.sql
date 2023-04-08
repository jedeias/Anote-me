-- SQLBook: Code
-- MySQL dump 10.13  Distrib 5.7.33, for Win64 (x86_64)
--
-- Host: localhost    Database: clinica_psicologica
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `anotacoes_paciente`
--

DROP TABLE IF EXISTS `anotacoes_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anotacoes_paciente` (
  `pk_anotacoes_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_redflag` int(11) NOT NULL,
  `fk_emocoes` int(11) NOT NULL,
  `fk_paciente` int(11) NOT NULL,
  `fk_anotacoes_psicologo` int(11) NOT NULL,
  `anotacoes` text,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`pk_anotacoes_paciente`),
  KEY `fk_emocoes` (`fk_emocoes`),
  KEY `fk_paciente` (`fk_paciente`),
  KEY `fk_anotacoes_psicologo` (`fk_anotacoes_psicologo`),
  CONSTRAINT `anotacoes_paciente_ibfk_1` FOREIGN KEY (`fk_emocoes`) REFERENCES `emocoes` (`pk_emocoes`),
  CONSTRAINT `anotacoes_paciente_ibfk_2` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `anotacoes_paciente_ibfk_3` FOREIGN KEY (`fk_anotacoes_psicologo`) REFERENCES `anotacoes_psicologo` (`pk_anotacoes_psicologo`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anotacoes_paciente`
--

LOCK TABLES `anotacoes_paciente` WRITE;
/*!40000 ALTER TABLE `anotacoes_paciente` DISABLE KEYS */;
INSERT INTO `anotacoes_paciente` VALUES (29,1,1,2,11,'Estou me sentindo muito ansioso','2022-05-10 11:30:00'),(30,2,2,3,12,'Estou me sentindo triste e sem autoestima','2022-05-12 12:30:00');
/*!40000 ALTER TABLE `anotacoes_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anotacoes_psicologo`
--

DROP TABLE IF EXISTS `anotacoes_psicologo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anotacoes_psicologo` (
  `pk_anotacoes_psicologo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int(11) NOT NULL,
  `fk_consulta` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `anotacoes` text,
  PRIMARY KEY (`pk_anotacoes_psicologo`),
  KEY `fk_psicologo` (`fk_psicologo`),
  KEY `fk_consulta` (`fk_consulta`),
  CONSTRAINT `anotacoes_psicologo_ibfk_1` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `anotacoes_psicologo_ibfk_2` FOREIGN KEY (`fk_consulta`) REFERENCES `consulta` (`pk_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anotacoes_psicologo`
--

LOCK TABLES `anotacoes_psicologo` WRITE;
/*!40000 ALTER TABLE `anotacoes_psicologo` DISABLE KEYS */;
INSERT INTO `anotacoes_psicologo` VALUES (11,11,16,'2022-05-10 11:00:00','O paciente está com problemas de ansiedade'),(12,12,17,'2022-05-12 12:00:00','O paciente está com problemas de autoestima');
/*!40000 ALTER TABLE `anotacoes_psicologo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividade`
--
DROP TABLE IF EXISTS `tipo_atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_atividade` (
  `pk_tipo_atividade` int(11) NOT NULL AUTO_INCREMENT,
  `finalidade` text NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`pk_tipo_atividade`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_atividade`
--

LOCK TABLES `tipo_atividade` WRITE;
/*!40000 ALTER TABLE `tipo_atividade` DISABLE KEYS */;
INSERT INTO `tipo_atividade` VALUES (1,'Esportes','Atividades relacionadas a prática de esportes'),(2,'Artes','Atividades relacionadas a pintura e escultura'),(3,'Música','Atividades relacionadas a prática musical'),(4,'Teatro','Atividades relacionadas a prática teatral'),(5,'Dança','Atividades relacionadas a prática de dança');
/*!40000 ALTER TABLE `tipo_atividade` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividade` (
  `pk_atividade` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipo_atividade` int(11) NOT NULL,
  PRIMARY KEY (`pk_atividade`),
  KEY `fk_tipo_atividade` (`fk_tipo_atividade`),
  CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`fk_tipo_atividade`) REFERENCES `tipo_atividade` (`pk_tipo_atividade`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividade`
--

LOCK TABLES `atividade` WRITE;
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
INSERT INTO `atividade` VALUES (1,1),(5,2),(2,3),(3,4),(4,5);
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinica`
--

DROP TABLE IF EXISTS `clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinica` (
  `pk_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_psicologo_clinica` int(11) DEFAULT NULL,
  `fk_secretario_clinica` int(11) DEFAULT NULL,
  `cnpj` int(14) NOT NULL,
  PRIMARY KEY (`pk_clinica`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_psicologo_clinica` (`fk_psicologo_clinica`),
  KEY `fk_secretario_clinica` (`fk_secretario_clinica`),
  CONSTRAINT `clinica_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `clinica_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `clinica_ibfk_3` FOREIGN KEY (`fk_psicologo_clinica`) REFERENCES `psicologo_clinica` (`pk_psicologo_clinica`),
  CONSTRAINT `clinica_ibfk_4` FOREIGN KEY (`fk_secretario_clinica`) REFERENCES `secretario_clinica` (`pk_secretario_clinica`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinica`
--

LOCK TABLES `clinica` WRITE;
/*!40000 ALTER TABLE `clinica` DISABLE KEYS */;
INSERT INTO `clinica` VALUES (2,1,1,NULL,NULL,1234567);
/*!40000 ALTER TABLE `clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consulta` (
  `pk_consulta` int(11) NOT NULL AUTO_INCREMENT,
  `fk_paciente` int(11) NOT NULL,
  `fk_psicologo` int(11) NOT NULL,
  `fk_redflag` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`pk_consulta`),
  KEY `fk_paciente` (`fk_paciente`),
  KEY `fk_psicologo` (`fk_psicologo`),
  KEY `fk_redflag` (`fk_redflag`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `consulta_ibfk_3` FOREIGN KEY (`fk_redflag`) REFERENCES `red_flag` (`pk_red_flag`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta`
--

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
INSERT INTO `consulta` VALUES (16,2,12,2,'2022-05-12 11:00:00'),(17,3,13,3,'2022-05-14 12:00:00');
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emocoes`
--

DROP TABLE IF EXISTS `emocoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emocoes` (
  `pk_emocoes` int(11) NOT NULL AUTO_INCREMENT,
  `local_img` text NOT NULL,
  `descricao` text,
  `emoji` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_emocoes`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emocoes`
--

LOCK TABLES `emocoes` WRITE;
/*!40000 ALTER TABLE `emocoes` DISABLE KEYS */;
INSERT INTO `emocoes` VALUES (1,'','triste','foto_triste'),(2,'','feliz','foto_triste'),(3,'','indiferente','foto_triste'),(4,'','euforico','foto_triste'),(5,'','ancioso','foto_triste');
/*!40000 ALTER TABLE `emocoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `pk_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(120) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` int(8) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'Rua das Flores','123','Jardim das Palmeiras',12345678,'São Paulo','SP','Apto 101'),(2,'Avenida das Árvores','567','Centro',87654321,'Rio de Janeiro','RJ','Casa 02'),(3,'Rua das Pedras','890','Vila dos Pássaros',9876543,'Belo Horizonte','MG','Bloco C'),(4,'Rua dos Andradas','123','Centro',90019,'Porto Alegre','RS','Sala 101'),(5,'Avenida Paulista','1000','Bela Vista',1210,'São Paulo','SP','Apt 502'),(6,'Rua Santa Catarina','200','Lourdes',30089,'Belo Horizonte','MG','Loja 10');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `pk_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `fk_responsavel` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int(11) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `fk_atividade` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_paciente`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_responsavel` (`fk_responsavel`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  KEY `fk_paciente_atividade` (`fk_atividade`),
  CONSTRAINT `fk_paciente_atividade` FOREIGN KEY (`fk_atividade`) REFERENCES `atividade` (`pk_atividade`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `paciente_ibfk_3` FOREIGN KEY (`fk_responsavel`) REFERENCES `responsavel` (`pk_responsavel`),
  CONSTRAINT `paciente_ibfk_4` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (2,1,2,3,1,'Joãozinho da Silva','joaozinho@example.com','senha123','111111111',1234567890,'M','2010-01-01',NULL),(3,2,1,3,2,'Mariazinha Pereira','mariazinha@example.com','senha123','222222222',1098765432,'F','2012-01-01',2);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psicologo`
--

DROP TABLE IF EXISTS `psicologo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psicologo` (
  `pk_psicologo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int(11) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  PRIMARY KEY (`pk_psicologo`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `psicologo_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `psicologo_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `psicologo_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psicologo`
--

LOCK TABLES `psicologo` WRITE;
/*!40000 ALTER TABLE `psicologo` DISABLE KEYS */;
INSERT INTO `psicologo` VALUES (11,1,1,1,'Maria Silva','mariasilva@gmail.com','12345678','123456789',1245678901,'F','1985-03-01'),(12,2,2,1,'João Souza','joaosouza@hotmail.com','87654321','987654321',965432109,'M','1990-05-15'),(13,3,3,1,'Ana Santos','anasantos@yahoo.com','qwertyui','24681012',246112141,'F','1988-11-22'),(14,4,4,1,'Pedro Alves','pedroalves@gmail.com','asdfghjk','369121518',312151822,'M','1995-07-04'),(15,5,5,1,'Juliana Lima','julianalima@gmail.com','zxcvbnm','151617181',161718123,'F','1992-01-10');
/*!40000 ALTER TABLE `psicologo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psicologo_clinica`
--

DROP TABLE IF EXISTS `psicologo_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psicologo_clinica` (
  `pk_psicologo_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int(11) NOT NULL,
  `fk_clinica` int(11) NOT NULL,
  PRIMARY KEY (`pk_psicologo_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_psicologo` (`fk_psicologo`),
  CONSTRAINT `psicologo_clinica_ibfk_1` FOREIGN KEY (`fk_clinica`) REFERENCES `clinica` (`pk_clinica`),
  CONSTRAINT `psicologo_clinica_ibfk_2` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psicologo_clinica`
--

LOCK TABLES `psicologo_clinica` WRITE;
/*!40000 ALTER TABLE `psicologo_clinica` DISABLE KEYS */;
INSERT INTO `psicologo_clinica` VALUES (24,11,2),(25,11,2),(26,12,2),(27,13,2),(28,14,2),(29,15,2);
/*!40000 ALTER TABLE `psicologo_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `red_flag`
--

DROP TABLE IF EXISTS `red_flag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `red_flag` (
  `pk_red_flag` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `cor` varchar(50) NOT NULL,
  `grau` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_red_flag`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `red_flag`
--

LOCK TABLES `red_flag` WRITE;
/*!40000 ALTER TABLE `red_flag` DISABLE KEYS */;
INSERT INTO `red_flag` VALUES (1,'Pensamentos suicidas','Vermelho','Grave'),(2,'Isolamento social','Amarelo','Moderado'),(3,'Comportamento agressivo','Laranja','Moderado'),(4,'Abuso de substâncias','Vermelho','Grave'),(5,'Sono excessivo ou insônia','Amarelo','Leve'),(6,'Pensamentos suicidas','Vermelho','Grave'),(7,'Isolamento social','Amarelo','Moderado'),(8,'Comportamento agressivo','Laranja','Moderado'),(9,'Abuso de substâncias','Vermelho','Grave'),(10,'Sono excessivo ou insônia','Amarelo','Leve');
/*!40000 ALTER TABLE `red_flag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsavel` (
  `pk_responsavel` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` varchar(11) NOT NULL,
  PRIMARY KEY (`pk_responsavel`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `responsavel_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `responsavel_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `responsavel_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
INSERT INTO `responsavel` VALUES (1,1,1,1,'Fulano de Tal','fulano@example.com','123456789','12345678901'),(2,2,2,1,'Ciclano de Tal','ciclano@example.com','987654321','10987654321');
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretario`
--

DROP TABLE IF EXISTS `secretario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretario` (
  `pk_secretario` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int(11) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  PRIMARY KEY (`pk_secretario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `secretario_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `secretario_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `secretario_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretario`
--

LOCK TABLES `secretario` WRITE;
/*!40000 ALTER TABLE `secretario` DISABLE KEYS */;
INSERT INTO `secretario` VALUES (1,3,1,2,'Beltrano de Tal','beltrano@example.com','senha123','345678901',987654321,'M','1990-01-01');
/*!40000 ALTER TABLE `secretario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretario_clinica`
--

DROP TABLE IF EXISTS `secretario_clinica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretario_clinica` (
  `pk_secretario_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_secretario` int(11) NOT NULL,
  `fk_clinica` int(11) NOT NULL,
  PRIMARY KEY (`pk_secretario_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_secretario` (`fk_secretario`),
  CONSTRAINT `secretario_clinica_ibfk_1` FOREIGN KEY (`fk_clinica`) REFERENCES `clinica` (`pk_clinica`),
  CONSTRAINT `secretario_clinica_ibfk_2` FOREIGN KEY (`fk_secretario`) REFERENCES `secretario` (`pk_secretario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretario_clinica`
--

LOCK TABLES `secretario_clinica` WRITE;
/*!40000 ALTER TABLE `secretario_clinica` DISABLE KEYS */;
INSERT INTO `secretario_clinica` VALUES (6,1,2);
/*!40000 ALTER TABLE `secretario_clinica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `pk_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipo_telefone` int(11) NOT NULL,
  `ddd` int(2) NOT NULL,
  `numero` int(11) NOT NULL,
  `ddi` int(2) NOT NULL,
  PRIMARY KEY (`pk_telefone`),
  KEY `fk_tipo_telefone` (`fk_tipo_telefone`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`fk_tipo_telefone`) REFERENCES `tipo_telefone` (`pk_tipo_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
INSERT INTO `telefone` VALUES (1,1,51,33221100,55),(2,2,11,998877665,55),(3,3,21,22334455,55),(4,4,11,55443322,55),(5,1,11,999998888,55),(6,2,21,33334444,55),(7,1,11,999998888,55),(8,2,21,33334444,55);
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_atividade`
--



--
-- Table structure for table `tipo_telefone`
--

DROP TABLE IF EXISTS `tipo_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_telefone` (
  `pk_tipo_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `tipo_telefone` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_tipo_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_telefone`
--

LOCK TABLES `tipo_telefone` WRITE;
/*!40000 ALTER TABLE `tipo_telefone` DISABLE KEYS */;
INSERT INTO `tipo_telefone` VALUES (1,'Telefone Residencial','Fixo'),(2,'Telefone Celular','Móvel'),(3,'Telefone Comercial','Fixo'),(4,'Telefone Público','Fixo'),(5,'Celular','Celular'),(6,'Telefone','Fixo');
/*!40000 ALTER TABLE `tipo_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `pk_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_user` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Responsável'),(2,'Secretário'),(3,'Paciente'),(4,'Psicólogo'),(5,'Responsável'),(6,'Secretário'),(7,'Paciente'),(8,'Psicólogo');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-03 16:05:05
