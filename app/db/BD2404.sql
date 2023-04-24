-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para clinica_psicologica
CREATE DATABASE IF NOT EXISTS `clinica_psicologica` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `clinica_psicologica`;

-- Copiando estrutura para tabela clinica_psicologica.anotacoes_paciente
CREATE TABLE IF NOT EXISTS `anotacoes_paciente` (
  `pk_anotacoes_paciente` int NOT NULL AUTO_INCREMENT,
  `fk_redflag` int DEFAULT NULL,
  `fk_paciente` int NOT NULL,
  `fk_psicologo` int DEFAULT NULL,
  `anotacao` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emocao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `intensidade` int DEFAULT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`pk_anotacoes_paciente`),
  KEY `fk_paciente` (`fk_paciente`),
  KEY `anotacoes_paciente_ibfk_2` (`fk_redflag`),
  KEY `fk_psicologo` (`fk_psicologo`),
  CONSTRAINT `anotacoes_paciente_ibfk_2` FOREIGN KEY (`fk_redflag`) REFERENCES `red_flag` (`pk_red_flag`),
  CONSTRAINT `anotacoes_paciente_ibfk_3` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `FK_anotacoes_paciente_psicologo` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.anotacoes_paciente: ~2 rows (aproximadamente)
DELETE FROM `anotacoes_paciente`;
INSERT INTO `anotacoes_paciente` (`pk_anotacoes_paciente`, `fk_redflag`, `fk_paciente`, `fk_psicologo`, `anotacao`, `emocao`, `intensidade`, `data`, `hora`) VALUES
	(43, 8, 2, 11, 'teste', 'ansioso', 60, '2023-04-21', '13:15:00'),
	(44, NULL, 2, NULL, 'teste', 'indiferente', 10, '2023-04-24', '11:53:00');

-- Copiando estrutura para tabela clinica_psicologica.anotacoes_psicologo
CREATE TABLE IF NOT EXISTS `anotacoes_psicologo` (
  `pk_anotacoes_psicologo` int NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int NOT NULL,
  `fk_consulta` int NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `anotacoes` text,
  PRIMARY KEY (`pk_anotacoes_psicologo`),
  KEY `fk_psicologo` (`fk_psicologo`),
  KEY `fk_consulta` (`fk_consulta`),
  CONSTRAINT `anotacoes_psicologo_ibfk_1` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `anotacoes_psicologo_ibfk_2` FOREIGN KEY (`fk_consulta`) REFERENCES `consulta` (`pk_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.anotacoes_psicologo: ~2 rows (aproximadamente)
DELETE FROM `anotacoes_psicologo`;
INSERT INTO `anotacoes_psicologo` (`pk_anotacoes_psicologo`, `fk_psicologo`, `fk_consulta`, `data`, `hora`, `anotacoes`) VALUES
	(11, 11, 16, '2022-05-10', '11:00:00', 'O paciente está com problemas de ansiedade'),
	(12, 12, 17, '2022-05-12', '12:00:00', 'O paciente está com problemas de autoestima');

-- Copiando estrutura para tabela clinica_psicologica.atividades_paciente
CREATE TABLE IF NOT EXISTS `atividades_paciente` (
  `pk_atividades_paciente` int NOT NULL AUTO_INCREMENT,
  `fk_paciente` int NOT NULL,
  `fk_psicologo` int NOT NULL,
  `assunto_atividade` varchar(50) NOT NULL DEFAULT '',
  `atividade` varchar(500) NOT NULL DEFAULT '',
  `data` date NOT NULL,
  PRIMARY KEY (`pk_atividades_paciente`) USING BTREE,
  KEY `fk_paciente` (`fk_paciente`),
  KEY `fk_psicologo` (`fk_psicologo`),
  CONSTRAINT `FK__paciente` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `FK__psicologo` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.atividades_paciente: ~1 rows (aproximadamente)
DELETE FROM `atividades_paciente`;
INSERT INTO `atividades_paciente` (`pk_atividades_paciente`, `fk_paciente`, `fk_psicologo`, `assunto_atividade`, `atividade`, `data`) VALUES
	(31, 2, 11, 'teste', 'teste', '2023-04-24');

-- Copiando estrutura para tabela clinica_psicologica.clinica
CREATE TABLE IF NOT EXISTS `clinica` (
  `pk_clinica` int NOT NULL AUTO_INCREMENT,
  `fk_endereco` int NOT NULL,
  `fk_telefone` int NOT NULL,
  `fk_psicologo_clinica` int NOT NULL,
  `fk_secretario_clinica` int NOT NULL,
  `cnpj` int NOT NULL,
  PRIMARY KEY (`pk_clinica`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_psicologo_clinica` (`fk_psicologo_clinica`),
  KEY `fk_secretario_clinica` (`fk_secretario_clinica`),
  CONSTRAINT `fk_endereco` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `fk_psicologo_clinica` FOREIGN KEY (`fk_psicologo_clinica`) REFERENCES `psicologo_clinica` (`pk_psicologo_clinica`),
  CONSTRAINT `fk_secretario_clinica` FOREIGN KEY (`fk_secretario_clinica`) REFERENCES `secretario_clinica` (`pk_secretario_clinica`),
  CONSTRAINT `fk_telefone` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.clinica: ~1 rows (aproximadamente)
DELETE FROM `clinica`;
INSERT INTO `clinica` (`pk_clinica`, `fk_endereco`, `fk_telefone`, `fk_psicologo_clinica`, `fk_secretario_clinica`, `cnpj`) VALUES
	(2, 1, 1, 24, 6, 1234567);

-- Copiando estrutura para tabela clinica_psicologica.consulta
CREATE TABLE IF NOT EXISTS `consulta` (
  `pk_consulta` int NOT NULL AUTO_INCREMENT,
  `fk_paciente` int NOT NULL,
  `fk_psicologo` int NOT NULL,
  `fk_redflag` int NOT NULL,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`pk_consulta`),
  KEY `fk_paciente` (`fk_paciente`),
  KEY `fk_psicologo` (`fk_psicologo`),
  KEY `fk_redflag` (`fk_redflag`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `consulta_ibfk_3` FOREIGN KEY (`fk_redflag`) REFERENCES `red_flag` (`pk_red_flag`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.consulta: ~2 rows (aproximadamente)
DELETE FROM `consulta`;
INSERT INTO `consulta` (`pk_consulta`, `fk_paciente`, `fk_psicologo`, `fk_redflag`, `data_hora`) VALUES
	(16, 2, 12, 2, '2022-05-12 11:00:00'),
	(17, 3, 13, 3, '2022-05-14 12:00:00');

-- Copiando estrutura para tabela clinica_psicologica.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `pk_endereco` int NOT NULL AUTO_INCREMENT,
  `rua` varchar(120) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` int NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.endereco: ~6 rows (aproximadamente)
DELETE FROM `endereco`;
INSERT INTO `endereco` (`pk_endereco`, `rua`, `numero`, `bairro`, `cep`, `cidade`, `estado`, `complemento`) VALUES
	(1, 'Rua das Flores', '123', 'Jardim das Palmeiras', 12345678, 'São Paulo', 'SP', 'Apto 101'),
	(2, 'Avenida das Árvores', '567', 'Centro', 87654321, 'Rio de Janeiro', 'RJ', 'Casa 02'),
	(3, 'Rua das Pedras', '890', 'Vila dos Pássaros', 9876543, 'Belo Horizonte', 'MG', 'Bloco C'),
	(4, 'Rua dos Andradas', '123', 'Centro', 90019, 'Porto Alegre', 'RS', 'Sala 101'),
	(5, 'Avenida Paulista', '1000', 'Bela Vista', 1210, 'São Paulo', 'SP', 'Apt 502'),
	(6, 'Rua Santa Catarina', '200', 'Lourdes', 30089, 'Belo Horizonte', 'MG', 'Loja 10');

-- Copiando estrutura para tabela clinica_psicologica.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `pk_paciente` int NOT NULL AUTO_INCREMENT,
  `fk_endereco` int NOT NULL,
  `fk_telefone` int NOT NULL,
  `fk_tipo_usuario` int NOT NULL,
  `fk_responsavel` int NOT NULL,
  `fk_psicologo` int NOT NULL,
  `fk_atividade` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pk_paciente`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_responsavel` (`fk_responsavel`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  KEY `fk_paciente_atividade` (`fk_atividade`),
  KEY `paciente_ibfk_4` (`fk_psicologo`),
  CONSTRAINT `fk_paciente_atividade` FOREIGN KEY (`fk_atividade`) REFERENCES `atividade` (`pk_atividade`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `paciente_ibfk_3` FOREIGN KEY (`fk_responsavel`) REFERENCES `responsavel` (`pk_responsavel`),
  CONSTRAINT `paciente_ibfk_4` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `paciente_ibfk_5` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.paciente: ~5 rows (aproximadamente)
DELETE FROM `paciente`;
INSERT INTO `paciente` (`pk_paciente`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `fk_responsavel`, `fk_psicologo`, `fk_atividade`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`, `imagem`) VALUES
	(2, 1, 2, 3, 1, 11, 5, 'Joãozinho da Silva', 'joaozinho@example.com', 'senha123', '111111111', 123456789, 'M', '2010-01-01', NULL),
	(3, 2, 1, 3, 2, 11, 2, 'Mariazinha Pereira', 'mariazinha@example.com', 'senha123', '222222222', 109876543, 'F', '2012-01-01', NULL),
	(4, 3, 4, 3, 1, 11, 1, 'Pedrinho Souza', 'pedrinho@example.com', 'senha123', '333333333', 246801357, 'M', '2014-01-01', NULL),
	(5, 4, 3, 3, 2, 13, 3, 'Lucinha Carvalho', 'lucinha@example.com', 'senha123', '444444444', 135790246, 'F', '2016-01-01', NULL),
	(6, 5, 5, 3, 2, 12, 4, 'Carlos Eduardo', 'carlos@example.com', 'senha123', '555555555', 864209753, 'M', '2018-01-01', NULL);

-- Copiando estrutura para tabela clinica_psicologica.psicologo
CREATE TABLE IF NOT EXISTS `psicologo` (
  `pk_psicologo` int NOT NULL AUTO_INCREMENT,
  `fk_endereco` int NOT NULL,
  `fk_telefone` int NOT NULL,
  `fk_tipo_usuario` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `imagem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`pk_psicologo`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `psicologo_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `psicologo_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `psicologo_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.psicologo: ~5 rows (aproximadamente)
DELETE FROM `psicologo`;
INSERT INTO `psicologo` (`pk_psicologo`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`, `imagem`) VALUES
	(11, 1, 1, 1, 'Maria Silva', 'mariasilva@gmail.com', '12345678', '123456789', 1245678901, 'F', '1985-03-01', '../../../view/IMG/imagem_perfil/1674969.png'),
	(12, 2, 2, 1, 'João Souza', 'joaosouza@hotmail.com', '87654321', '987654321', 965432109, 'M', '1990-05-15', NULL),
	(13, 3, 3, 1, 'Ana Santos', 'anasantos@yahoo.com', 'qwertyui', '24681012', 246112141, 'F', '1988-11-22', NULL),
	(14, 4, 4, 1, 'Pedro Alves', 'pedroalves@gmail.com', 'asdfghjk', '369121518', 312151822, 'M', '1995-07-04', NULL),
	(15, 5, 5, 1, 'Juliana Lima', 'julianalima@gmail.com', 'zxcvbnm', '151617181', 161718123, 'F', '1992-01-10', NULL);

-- Copiando estrutura para tabela clinica_psicologica.psicologo_clinica
CREATE TABLE IF NOT EXISTS `psicologo_clinica` (
  `pk_psicologo_clinica` int NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int NOT NULL,
  `fk_clinica` int NOT NULL,
  PRIMARY KEY (`pk_psicologo_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_psicologo` (`fk_psicologo`),
  CONSTRAINT `fk_clinica` FOREIGN KEY (`fk_clinica`) REFERENCES `clinica` (`pk_clinica`),
  CONSTRAINT `fk_psicologo` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.psicologo_clinica: ~6 rows (aproximadamente)
DELETE FROM `psicologo_clinica`;
INSERT INTO `psicologo_clinica` (`pk_psicologo_clinica`, `fk_psicologo`, `fk_clinica`) VALUES
	(24, 11, 2),
	(25, 11, 2),
	(26, 12, 2),
	(27, 13, 2),
	(28, 14, 2),
	(29, 15, 2);

-- Copiando estrutura para tabela clinica_psicologica.red_flag
CREATE TABLE IF NOT EXISTS `red_flag` (
  `pk_red_flag` int NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `cor` varchar(50) NOT NULL,
  `grau` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_red_flag`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.red_flag: ~10 rows (aproximadamente)
DELETE FROM `red_flag`;
INSERT INTO `red_flag` (`pk_red_flag`, `descricao`, `cor`, `grau`) VALUES
	(1, 'Pensamentos suicidas', 'Vermelho', 'Grave'),
	(2, 'Isolamento social', 'Amarelo', 'Moderado'),
	(3, 'Comportamento agressivo', 'Laranja', 'Moderado'),
	(4, 'Abuso de substâncias', 'Vermelho', 'Grave'),
	(5, 'Sono excessivo ou insônia', 'Amarelo', 'Leve'),
	(6, 'Pensamentos suicidas', 'Vermelho', 'Grave'),
	(7, 'Isolamento social', 'Amarelo', 'Moderado'),
	(8, 'Comportamento agressivo', 'Laranja', 'Moderado'),
	(9, 'Abuso de substâncias', 'Vermelho', 'Grave'),
	(10, 'Sono excessivo ou insônia', 'Amarelo', 'Leve');

-- Copiando estrutura para tabela clinica_psicologica.responsavel
CREATE TABLE IF NOT EXISTS `responsavel` (
  `pk_responsavel` int NOT NULL AUTO_INCREMENT,
  `fk_endereco` int NOT NULL,
  `fk_telefone` int NOT NULL,
  `fk_tipo_usuario` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int NOT NULL,
  PRIMARY KEY (`pk_responsavel`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `responsavel_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `responsavel_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `responsavel_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.responsavel: ~2 rows (aproximadamente)
DELETE FROM `responsavel`;
INSERT INTO `responsavel` (`pk_responsavel`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `RG`, `CPF`) VALUES
	(1, 1, 1, 1, 'Fulano de Tal', 'fulano@example.com', '123456789', 1234567890),
	(2, 2, 2, 1, 'Ciclano de Tal', 'ciclano@example.com', '987654321', 1098765432);

-- Copiando estrutura para tabela clinica_psicologica.secretario
CREATE TABLE IF NOT EXISTS `secretario` (
  `pk_secretario` int NOT NULL AUTO_INCREMENT,
  `fk_endereco` int NOT NULL,
  `fk_telefone` int NOT NULL,
  `fk_tipo_usuario` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pk_secretario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `secretario_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `secretario_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `secretario_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.secretario: ~1 rows (aproximadamente)
DELETE FROM `secretario`;
INSERT INTO `secretario` (`pk_secretario`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`, `imagem`) VALUES
	(1, 3, 1, 2, 'Beltrano de Tal', 'beltrano@example.com', 'senha123', '345678901', 987654321, 'M', '1990-01-01', NULL);

-- Copiando estrutura para tabela clinica_psicologica.secretario_clinica
CREATE TABLE IF NOT EXISTS `secretario_clinica` (
  `pk_secretario_clinica` int NOT NULL AUTO_INCREMENT,
  `fk_secretario` int NOT NULL,
  `fk_clinica` int NOT NULL,
  PRIMARY KEY (`pk_secretario_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_secretario` (`fk_secretario`),
  CONSTRAINT `fk_secretario` FOREIGN KEY (`fk_secretario`) REFERENCES `secretario` (`pk_secretario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.secretario_clinica: ~1 rows (aproximadamente)
DELETE FROM `secretario_clinica`;
INSERT INTO `secretario_clinica` (`pk_secretario_clinica`, `fk_secretario`, `fk_clinica`) VALUES
	(6, 1, 2);

-- Copiando estrutura para tabela clinica_psicologica.telefone
CREATE TABLE IF NOT EXISTS `telefone` (
  `pk_telefone` int NOT NULL AUTO_INCREMENT,
  `fk_tipo_telefone` int NOT NULL,
  `ddd` int NOT NULL,
  `numero` int NOT NULL,
  `ddi` int NOT NULL,
  PRIMARY KEY (`pk_telefone`),
  KEY `fk_tipo_telefone` (`fk_tipo_telefone`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`fk_tipo_telefone`) REFERENCES `tipo_telefone` (`pk_tipo_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.telefone: ~8 rows (aproximadamente)
DELETE FROM `telefone`;
INSERT INTO `telefone` (`pk_telefone`, `fk_tipo_telefone`, `ddd`, `numero`, `ddi`) VALUES
	(1, 1, 51, 33221100, 55),
	(2, 2, 11, 998877665, 55),
	(3, 3, 21, 22334455, 55),
	(4, 4, 11, 55443322, 55),
	(5, 1, 11, 999998888, 55),
	(6, 2, 21, 33334444, 55),
	(7, 1, 11, 999998888, 55),
	(8, 2, 21, 33334444, 55);

-- Copiando estrutura para tabela clinica_psicologica.tipo_telefone
CREATE TABLE IF NOT EXISTS `tipo_telefone` (
  `pk_tipo_telefone` int NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `tipo_telefone` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_tipo_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.tipo_telefone: ~6 rows (aproximadamente)
DELETE FROM `tipo_telefone`;
INSERT INTO `tipo_telefone` (`pk_tipo_telefone`, `descricao`, `tipo_telefone`) VALUES
	(1, 'Telefone Residencial', 'Fixo'),
	(2, 'Telefone Celular', 'Móvel'),
	(3, 'Telefone Comercial', 'Fixo'),
	(4, 'Telefone Público', 'Fixo'),
	(5, 'Celular', 'Celular'),
	(6, 'Telefone', 'Fixo');

-- Copiando estrutura para tabela clinica_psicologica.tipo_usuario
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `pk_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `tipo_user` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_psicologica.tipo_usuario: ~4 rows (aproximadamente)
DELETE FROM `tipo_usuario`;
INSERT INTO `tipo_usuario` (`pk_tipo_usuario`, `tipo_user`) VALUES
	(1, 'Responsável'),
	(2, 'Secretário'),
	(3, 'Paciente'),
	(4, 'Psicólogo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
