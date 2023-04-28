/*BANCO DE DADOS COM DADOS JA INSERIDOS.*/

drop database `clinica_psicologica`;

CREATE DATABASE IF NOT EXISTS `clinica_psicologica`;

USE `clinica_psicologica`;

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `pk_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_user` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_tipo_usuario`)
);
REPLACE INTO `tipo_usuario` (`pk_tipo_usuario`, `tipo_user`) VALUES
	(1, 'Responsável'),
	(2, 'Secretário'),
	(3, 'Paciente'),
	(4, 'Psicólogo');
	
	
CREATE TABLE IF NOT EXISTS `endereco` (
  `pk_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(120) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` int(8) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` char(2) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_endereco`)
);
REPLACE INTO `endereco` (`pk_endereco`, `rua`, `numero`, `bairro`, `cep`, `cidade`, `estado`, `complemento`) VALUES
	(1, 'Rua das Flores', '123', 'Jardim das Palmeiras', 12345678, 'São Paulo', 'SP', 'Apto 101'),
	(2, 'Avenida das Árvores', '567', 'Centro', 87654321, 'Rio de Janeiro', 'RJ', 'Casa 02'),
	(3, 'Rua das Pedras', '890', 'Vila dos Pássaros', 9876543, 'Belo Horizonte', 'MG', 'Bloco C'),
	(4, 'Rua dos Andradas', '123', 'Centro', 90019, 'Porto Alegre', 'RS', 'Sala 101'),
	(5, 'Avenida Paulista', '1000', 'Bela Vista', 1210, 'São Paulo', 'SP', 'Apt 502'),
	(6, 'Rua Santa Catarina', '200', 'Lourdes', 30089, 'Belo Horizonte', 'MG', 'Loja 10');
	
	
CREATE TABLE IF NOT EXISTS `tipo_telefone` (
  `pk_tipo_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `tipo_telefone` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_tipo_telefone`)
);
REPLACE INTO `tipo_telefone` (`pk_tipo_telefone`, `descricao`, `tipo_telefone`) VALUES
	(1, 'Telefone Residencial', 'Fixo'),
	(2, 'Telefone Celular', 'Móvel'),
	(3, 'Telefone Comercial', 'Fixo'),
	(4, 'Telefone Público', 'Fixo'),
	(5, 'Celular', 'Celular'),
	(6, 'Telefone', 'Fixo');
	
	
CREATE TABLE IF NOT EXISTS `telefone` (
  `pk_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tipo_telefone` int(11) NOT NULL,
  `ddd` int(2) NOT NULL,
  `numero` int(11) NOT NULL,
  `ddi` int(2) NOT NULL,
  PRIMARY KEY (`pk_telefone`),
  KEY `fk_tipo_telefone` (`fk_tipo_telefone`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`fk_tipo_telefone`) REFERENCES `tipo_telefone` (`pk_tipo_telefone`)
);
REPLACE INTO `telefone` (`pk_telefone`, `fk_tipo_telefone`, `ddd`, `numero`, `ddi`) VALUES
	(1, 1, 51, 33221100, 55),
	(2, 2, 11, 998877665, 55),
	(3, 3, 21, 22334455, 55),
	(4, 4, 11, 55443322, 55),
	(5, 1, 11, 999998888, 55),
	(6, 2, 21, 33334444, 55),
	(7, 1, 11, 999998888, 55),
	(8, 2, 21, 33334444, 55);

CREATE TABLE IF NOT EXISTS `secretario` (
	`pk_secretario` int(11) NOT NULL AUTO_INCREMENT,
	`fk_endereco` int(11) NOT NULL,
	`fk_telefone` int(11) NOT NULL,
	`fk_tipo_usuario` int(11) NOT NULL,
	`nome` varchar(100) NOT NULL,
	`email` varchar(100) NOT NULL,
	`senha` varchar(8) NOT NULL,
	`RG` varchar(9) NOT NULL,
	`CPF` INT(12) NOT NULL,
	`sexo` enum('M','F') NOT NULL,
	`data_nasc` date NOT NULL,
  `imagem` varchar(100) NULL,
	PRIMARY KEY (`pk_secretario`),
	UNIQUE KEY `email` (`email`),
	KEY `fk_endereco` (`fk_endereco`),
	KEY `fk_telefone` (`fk_telefone`),
	KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
	CONSTRAINT `secretario_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
	CONSTRAINT `secretario_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
	CONSTRAINT `secretario_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
);
REPLACE INTO `secretario` (`pk_secretario`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`) VALUES
	(1, 3, 1, 2, 'Beltrano de Tal', 'beltrano@example.com', 'senha123', '345678901', 987654321, 'M', '1990-01-01');



CREATE TABLE IF NOT EXISTS `psicologo` (
  `pk_psicologo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` INT(12) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `imagem` varchar(100) NULL,
  PRIMARY KEY (`pk_psicologo`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `psicologo_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `psicologo_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `psicologo_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
);
REPLACE INTO `psicologo` (`pk_psicologo`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`) VALUES
	(11, 1, 1, 1, 'Maria Silva', 'mariasilva@gmail.com', '12345678', '123456789', 1245678901, 'F', '1985-03-01'),
	(12, 2, 2, 1, 'João Souza', 'joaosouza@hotmail.com', '87654321', '987654321', 965432109, 'M', '1990-05-15'),
	(13, 3, 3, 1, 'Ana Santos', 'anasantos@yahoo.com', 'qwertyui', '24681012', 246112141, 'F', '1988-11-22'),
	(14, 4, 4, 1, 'Pedro Alves', 'pedroalves@gmail.com', 'asdfghjk', '369121518', 312151822, 'M', '1995-07-04'),
	(15, 5, 5, 1, 'Juliana Lima', 'julianalima@gmail.com', 'zxcvbnm', '151617181', 161718123, 'F', '1992-01-10');


CREATE TABLE IF NOT EXISTS `secretario_clinica` (
  `pk_secretario_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_secretario` int(11) NOT NULL,
  `fk_clinica` int(11) NOT NULL,
  PRIMARY KEY (`pk_secretario_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_secretario` (`fk_secretario`),
  CONSTRAINT `fk_secretario` FOREIGN KEY (`fk_secretario`) REFERENCES `secretario`(`pk_secretario`)
);
REPLACE INTO `secretario_clinica` (`pk_secretario_clinica`, `fk_secretario`, `fk_clinica`) VALUES
	(6, 1, 2);
	
CREATE TABLE IF NOT EXISTS `psicologo_clinica` (
  `pk_psicologo_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int(11) NOT NULL,
  `fk_clinica` int(11) NOT NULL,
  PRIMARY KEY (`pk_psicologo_clinica`),
  KEY `fk_clinica` (`fk_clinica`),
  KEY `fk_psicologo` (`fk_psicologo`),
  CONSTRAINT `fk_psicologo` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo`(`pk_psicologo`)
);
REPLACE INTO `psicologo_clinica` (`pk_psicologo_clinica`, `fk_psicologo`, `fk_clinica`) VALUES
	(24, 11, 2),
	(25, 11, 2),
	(26, 12, 2),
	(27, 13, 2),
	(28, 14, 2),
	(29, 15, 2);
	
CREATE TABLE IF NOT EXISTS `clinica` (
  `pk_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_psicologo_clinica` int(11) NOT NULL,
  `fk_secretario_clinica` int(11) NOT NULL,
  `cnpj` int(14) NOT NULL,
  PRIMARY KEY (`pk_clinica`),
  CONSTRAINT `fk_endereco` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco`(`pk_endereco`),
  CONSTRAINT `fk_telefone` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone`(`pk_telefone`),
  CONSTRAINT `fk_psicologo_clinica` FOREIGN KEY (`fk_psicologo_clinica`) REFERENCES `psicologo_clinica`(`pk_psicologo_clinica`),
  CONSTRAINT `fk_secretario_clinica` FOREIGN KEY (`fk_secretario_clinica`) REFERENCES `secretario_clinica`(`pk_secretario_clinica`)
);

REPLACE INTO `clinica` (`pk_clinica`, `fk_endereco`, `fk_telefone`, `fk_psicologo_clinica`, `fk_secretario_clinica`, `cnpj`) VALUES
	(2, 1, 1, 24, 6, 1234567);	
	
ALTER TABLE `psicologo_clinica`
ADD CONSTRAINT `fk_clinica`
FOREIGN KEY (`fk_clinica`)
REFERENCES `clinica`(`pk_clinica`);


CREATE TABLE IF NOT EXISTS `responsavel` (
  `pk_responsavel` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int(12) NOT NULL,
  PRIMARY KEY (`pk_responsavel`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `responsavel_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `responsavel_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `responsavel_ibfk_3` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
);
REPLACE INTO `responsavel` (`pk_responsavel`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `nome`, `email`, `RG`, `CPF`) VALUES
	(1, 1, 1, 1, 'Fulano de Tal', 'fulano@example.com', '123456789', 1234567890),
	(2, 2, 2, 1, 'Ciclano de Tal', 'ciclano@example.com', '987654321', 1098765432);
	
-- CREATE TABLE IF NOT EXISTS `tipo_atividade` (
--   `pk_tipo_atividade` int(11) NOT NULL AUTO_INCREMENT,
--   `finalidade` text NOT NULL,
--   `descricao` text NOT NULL,
--   PRIMARY KEY (`pk_tipo_atividade`)
-- );
-- REPLACE INTO `tipo_atividade` (`pk_tipo_atividade`, `finalidade`, `descricao`) VALUES
-- 	(1, 'Esportes', 'Atividades relacionadas a prática de esportes'),
-- 	(2, 'Artes', 'Atividades relacionadas a pintura e escultura'),
-- 	(3, 'Música', 'Atividades relacionadas a prática musical'),
-- 	(4, 'Teatro', 'Atividades relacionadas a prática teatral'),
-- 	(5, 'Dança', 'Atividades relacionadas a prática de dança');
	
	
-- CREATE TABLE IF NOT EXISTS `atividade` (
--   `pk_atividade` int(11) NOT NULL AUTO_INCREMENT,
--   `fk_tipo_atividade` int(11) NOT NULL,
--   PRIMARY KEY (`pk_atividade`),
--   KEY `fk_tipo_atividade` (`fk_tipo_atividade`),
--   CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`fk_tipo_atividade`) REFERENCES `tipo_atividade` (`pk_tipo_atividade`)
-- );
-- REPLACE INTO `atividade` (`pk_atividade`, `fk_tipo_atividade`) VALUES
-- 	(1, 1),
-- 	(5, 2),
-- 	(2, 3),
-- 	(3, 4),
-- 	(4, 5);
	
CREATE TABLE IF NOT EXISTS `paciente` (
  `pk_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_endereco` int(11) NOT NULL,
  `fk_telefone` int(11) NOT NULL,
  `fk_tipo_usuario` int(11) NOT NULL,
  `fk_responsavel` int(11) NOT NULL,
  `fk_psicologo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `RG` varchar(9) NOT NULL,
  `CPF` int(12) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `data_nasc` date NOT NULL,
  `imagem` varchar(100) NULL,
  PRIMARY KEY (`pk_paciente`),
  UNIQUE KEY `email` (`email`),
  KEY `psicologo` (`fk_psicologo`),
  KEY `fk_endereco` (`fk_endereco`),
  KEY `fk_telefone` (`fk_telefone`),
  KEY `fk_responsavel` (`fk_responsavel`),
  KEY `fk_tipo_usuario` (`fk_tipo_usuario`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`pk_endereco`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`fk_telefone`) REFERENCES `telefone` (`pk_telefone`),
  CONSTRAINT `paciente_ibfk_3` FOREIGN KEY (`fk_responsavel`) REFERENCES `responsavel` (`pk_responsavel`),
  CONSTRAINT `paciente_ibfk_4` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `paciente_ibfk_5` FOREIGN KEY (`fk_tipo_usuario`) REFERENCES `tipo_usuario` (`pk_tipo_usuario`)
);
REPLACE INTO `paciente` (`pk_paciente`, `fk_endereco`, `fk_telefone`, `fk_tipo_usuario`, `fk_responsavel`,`fk_psicologo`, `nome`, `email`, `senha`, `RG`, `CPF`, `sexo`, `data_nasc`) VALUES
	(2, 1, 2, 3, 1, 11, 'Joãozinho da Silva', 'joaozinho@example.com', 'senha123', '111111111', 123456789, 'M', '2010-01-01'),
	(3, 2, 1, 3, 2, 11, 'Mariazinha Pereira', 'mariazinha@example.com', 'senha123', '222222222', 109876543, 'F', '2012-01-01'),
	(4, 3, 4, 3, 1, 12, 'Pedrinho Souza', 'pedrinho@example.com', 'senha123', '333333333', 246801357, 'M', '2014-01-01'),
	(5, 4, 3, 3, 2, 13, 'Lucinha Carvalho', 'lucinha@example.com', 'senha123', '444444444', 135790246, 'F', '2016-01-01'),
	(6, 5, 5, 3, 2, 12, 'Carlos Eduardo', 'carlos@example.com', 'senha123', '555555555', 864209753, 'M', '2018-01-01');
	
	

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
);

-- Copiando dados para a tabela clinica_psicologica.atividades_paciente: ~0 rows (aproximadamente)

INSERT INTO `atividades_paciente` (`pk_atividades_paciente`, `fk_paciente`, `fk_psicologo`, `assunto_atividade`, `atividade`, `data`) VALUES
	(1, 2, 11, 'Esporte', 'fazer mais esporte', '2023-04-13');


-- CREATE TABLE IF NOT EXISTS `emocoes` (
--   `pk_emocoes` int(11) NOT NULL AUTO_INCREMENT,
--   `local_img` text NOT NULL,
--   `descricao` text,
--   `emoji` varchar(50) NOT NULL,
--   `intensidade` int(5) NOT NULL,
--   PRIMARY KEY (`pk_emocoes`)
-- );
-- REPLACE INTO `emocoes` (`pk_emocoes`, `local_img`, `descricao`, `emoji`,`intensidade`) VALUES
-- 	(1, '', 'triste', 'foto_triste',45),
-- 	(2, '', 'feliz', 'foto_triste',65),
-- 	(3, '', 'indiferente', 'foto_triste',85),
-- 	(4, '', 'euforico', 'foto_triste',95),
-- 	(5, '', 'ancioso', 'foto_triste',100);


CREATE TABLE IF NOT EXISTS `red_flag` (
  `pk_red_flag` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `cor` varchar(50) NOT NULL,
  `grau` varchar(50) NOT NULL,
  PRIMARY KEY (`pk_red_flag`)
);
REPLACE INTO `red_flag` (`pk_red_flag`, `descricao`, `cor`, `grau`) VALUES
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
	
	
CREATE TABLE IF NOT EXISTS `consulta` (
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
);
REPLACE INTO `consulta` (`pk_consulta`, `fk_paciente`, `fk_psicologo`, `fk_redflag`, `data_hora`) VALUES
	(16, 2, 12, 2, '2022-05-12 11:00:00'),
	(17, 3, 13, 3, '2022-05-14 12:00:00');
	
	
CREATE TABLE IF NOT EXISTS `anotacoes_psicologo` (
  `pk_anotacoes_psicologo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_psicologo` int(11) NOT NULL,
  `fk_consulta` int(11) NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `anotacoes` text,
  PRIMARY KEY (`pk_anotacoes_psicologo`),
  KEY `fk_psicologo` (`fk_psicologo`),
  KEY `fk_consulta` (`fk_consulta`),
  CONSTRAINT `anotacoes_psicologo_ibfk_1` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`),
  CONSTRAINT `anotacoes_psicologo_ibfk_2` FOREIGN KEY (`fk_consulta`) REFERENCES `consulta` (`pk_consulta`)
);
REPLACE INTO `anotacoes_psicologo` (`pk_anotacoes_psicologo`, `fk_psicologo`, `fk_consulta`, `data`,`hora`, `anotacoes`) VALUES
	(11, 11, 16, '2022-05-10', '11:00:00', 'O paciente está com problemas de ansiedade'),
	(12, 12, 17, '2022-05-12', '12:00:00', 'O paciente está com problemas de autoestima');
	
	
CREATE TABLE IF NOT EXISTS `anotacoes_paciente` (
  `pk_anotacoes_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_redflag` int(11) NOT NULL,
  `fk_paciente` int(11) NOT NULL,
  `fk_psicologo` int(11) NOT NULL,
  `anotacao` VARCHAR(500),
  `emocao` VARCHAR(50),
  `intensidade` INT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`pk_anotacoes_paciente`),
  KEY `fk_paciente` (`fk_paciente`),
  CONSTRAINT `anotacoes_paciente_ibfk_2` FOREIGN KEY (`fk_redflag`) REFERENCES `red_flag` (`pk_red_flag`),
  CONSTRAINT `anotacoes_paciente_ibfk_3` FOREIGN KEY (`fk_paciente`) REFERENCES `paciente` (`pk_paciente`),
  CONSTRAINT `anotacoes_paciente_ibfk_5` FOREIGN KEY (`fk_psicologo`) REFERENCES `psicologo` (`pk_psicologo`)
);
REPLACE INTO `anotacoes_paciente` (`pk_anotacoes_paciente`, `fk_redflag`, `fk_paciente`,`fk_psicologo`, `anotacao`, `data`,`hora`) VALUES
	(29, 1, 2,11, 'Estou me sentindo muito ansioso', '2022-05-10', '11:30:00'),
	(30, 2, 3,11, 'Estou me sentindo triste e sem autoestima', '2022-05-12', '12:30:00');






