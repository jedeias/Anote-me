CREATE DATABASE clinica_psicologica;

use clinica_psicologica;



CREATE TABLE tipo_atividade(
pk_tipo_atividade int not NULL auto_increment,
finalidade text not null,
descricao TEXT not NULL,
PRIMARY KEY(pk_tipo_atividade)
);

CREATE TABLE atividade(
pk_atividade INT NOT NULL auto_increment,
fk_tipo_atividade INT,
PRIMARY KEY (pk_atividade),
FOREIGN KEY (fk_tipo_atividade) REFERENCES tipo_atividade (pk_tipo_atividade)
);

DESC atividade;

CREATE TABLE emocoes(
pk_emocoes INT NOT NULL auto_increment,
local_img TEXT NOT NULL,
descricao TEXT,
sentimento VARCHAR(50) NOT NULL,
intensidade varchar(5) NULL,
PRIMARY KEY(pk_emocoes)
);

DESC emocoes;

CREATE TABLE red_flag(
pk_red_flag INT NOT NULL auto_increment,
descricao TEXT,
cor VARCHAR(50) NOT NULL,
grau VARCHAR(50) NOT NULL,
PRIMARY KEY (pk_red_flag)
);

DESC red_flag;

CREATE TABLE endereco(
pk_endereco INT NOT NULL auto_increment,
rua VARCHAR(120) NOT NULL,
numero VARCHAR(8) NOT NULL,
bairro VARCHAR(100) NOT NULL,
cep INT (8) NOT NULL,
cidade VARCHAR(50) NOT NULL,
estado CHAR(2) NOT NULL,
complemento VARCHAR(100) NOT NULL,
PRIMARY KEY (pk_endereco)
);

DESC endereco;

CREATE TABLE tipo_telefone(
pk_tipo_telefone INT NOT NULL auto_increment,
descricao TEXT,
tipo_telefone VARCHAR(50) NOT NULL,
PRIMARY KEY(pk_tipo_telefone)
);

DESC tipo_telefone;

CREATE TABLE telefone(
pk_telefone INT NOT NULL auto_increment,
fk_tipo_telefone INT NOT NULL,
ddd INT(2) NOT NULL,
numero INT(11) NOT NULL,
ddi INT(2) NOT NULL,
PRIMARY KEY(pk_telefone),
FOREIGN KEY (fk_tipo_telefone) REFERENCES tipo_telefone(pk_tipo_telefone)
);

DESC telefone;

CREATE table tipo_usuario(
pk_tipo_usuario int not null auto_increment,
tipo_user VARCHAR (100) not null,
primary KEY (pk_tipo_usuario)
);

CREATE TABLE responsavel(
pk_responsavel INT NOT NULL auto_increment,
fk_endereco INT NOT NULL,
fk_telefone INT NOT NULL,
fk_tipo_usuario int not null,
nome VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
RG VARCHAR(9) NOT NULL,
CPF VARCHAR(11) NOT NULL,
PRIMARY KEY(pk_responsavel),
FOREIGN KEY(fk_endereco) REFERENCES endereco(pk_endereco),
FOREIGN KEY(fk_telefone) REFERENCES telefone(pk_telefone)
);

alter TABLE responsavel 
add FOREIGN KEY(fk_tipo_usuario)
REFERENCES tipo_usuario(pk_tipo_usuario);

ALTER TABLE responsavel ADD UNIQUE KEY (email);

DESC responsavel;

CREATE TABLE secretario(
pk_secretario int not NULL auto_increment,
fk_endereco INT NOT NULL,
fk_telefone int NOT null,
fk_tipo_usuario int not NULL,
nome VARCHAR(100) not NULL,
email VARCHAR(100) not NULL,
senha VARCHAR(8) not NULL,
RG VARCHAR(9) not NULL,
CPF int(11) not NULL,
sexo enum('M','F') not NULL,
data_nasc date not null,
PRIMARY KEY(pk_secretario),
unique key (email),
FOREIGN KEY(fk_endereco) REFERENCES endereco(pk_endereco),
FOREIGN KEY(fk_telefone) REFERENCES telefone(pk_telefone),
FOREIGN KEY(fk_tipo_usuario) REFERENCES tipo_usuario(pk_tipo_usuario)
);

DESC secretario;

CREATE TABLE paciente(
pk_paciente int not null auto_increment,
fk_endereco INT NOT NULL,
fk_telefone int NOT	null,
fk_tipo_usuario int not NULL,
fk_responsavel INT NOT NULL,
nome VARCHAR(100) not NULL,
email VARCHAR(100) not NULL,
senha VARCHAR(8) not NULL,
RG VARCHAR(9) not NULL,
CPF int(11) not NULL,
sexo enum('M','F') not NULL,
data_nasc date not null,
PRIMARY KEY(pk_paciente),
unique key (email),
FOREIGN KEY(fk_endereco) REFERENCES endereco(pk_endereco),
FOREIGN KEY(fk_telefone) REFERENCES telefone(pk_telefone),
FOREIGN KEY(fk_responsavel) REFERENCES responsavel(pk_responsavel),
FOREIGN KEY(fk_tipo_usuario) REFERENCES tipo_usuario(pk_tipo_usuario)
);

desc paciente;

CREATE TABLE psicologo(
pk_psicologo int not null auto_increment,
fk_endereco INT NOT NULL,
fk_telefone int NOT	null,
fk_tipo_usuario int not NULL,
nome VARCHAR(100) not NULL,
email VARCHAR(100) not NULL,
senha VARCHAR(8) not NULL,
RG VARCHAR(9) not NULL,
CPF int(11) not NULL,
CRP varchar(12) null,
sexo enum('M','F') not NULL,
data_nasc date not null,
PRIMARY KEY(pk_psicologo),
unique key (email),
FOREIGN KEY(fk_endereco) REFERENCES endereco(pk_endereco),
FOREIGN KEY(fk_telefone) REFERENCES telefone(pk_telefone),
FOREIGN KEY(fk_tipo_usuario) REFERENCES tipo_usuario(pk_tipo_usuario)
);

DESC psicologo;

CREATE TABLE clinica(
pk_clinica int not null auto_increment,
fk_endereco INT NOT NULL,
fk_telefone int NOT	null,
fk_psicologo_clinica int not null,
fk_secretario_clinica int not null,
cnpj int (14) not null,
PRIMARY key(pk_clinica),
FOREIGN KEY(fk_endereco) REFERENCES endereco(pk_endereco),
FOREIGN KEY(fk_telefone) REFERENCES telefone(pk_telefone)
);

CREATE TABLE psicologo_clinica(
pk_psicologo_clinica int not null auto_increment,
fk_psicologo int not null,
fk_clinica int not null,
PRIMARY KEY(pk_psicologo_clinica),
FOREIGN KEY(fk_clinica) REFERENCES clinica(pk_clinica),
FOREIGN KEY(fk_psicologo) REFERENCES psicologo(pk_psicologo)
);

ALTER TABLE clinica ADD FOREIGN KEY (fk_psicologo_clinica) REFERENCES psicologo_clinica(pk_psicologo_clinica);

CREATE TABLE secretario_clinica(
pk_secretario_clinica int not null auto_increment,
fk_secretario int not null,
fk_clinica int not null,
PRIMARY KEY(pk_secretario_clinica),
FOREIGN KEY(fk_clinica) REFERENCES clinica(pk_clinica),
FOREIGN KEY(fk_secretario) REFERENCES secretario(pk_secretario)
);

ALTER TABLE clinica ADD FOREIGN KEY (fk_secretario_clinica) REFERENCES secretario_clinica(pk_secretario_clinica);

create table consulta(
pk_consulta int not null auto_increment, 
fk_paciente int not null,
fk_psicologo int not null,
fk_redflag int not null,
data_hora datetime not null,
primary key(pk_consulta),
foreign key(fk_paciente) references paciente(pk_paciente),
foreign key(fk_psicologo) references psicologo(pk_psicologo),
foreign key(fk_redflag) references red_flag(pk_red_flag)
);

create table anotacoes_psicologo(
pk_anotacoes_psicologo int not null auto_increment,
fk_psicologo int not null,
fk_consulta int not null,
data_hora datetime not null,
anotacoes text null,
PRIMARY KEY (pk_anotacoes_psicologo),
foreign key(fk_psicologo) references psicologo(pk_psicologo),
foreign key(fk_consulta) references consulta(pk_consulta)
);


create table anotacoes_paciente(
pk_anotacoes_paciente int not null auto_increment,
fk_redflag int not null,
fk_emocoes int not null,
fk_paciente int not null,
fk_anotacoes_psicologo int not null,
anotacoes text null,
data_hora datetime not null,

primary key(pk_anotacoes_paciente),
foreign key(fk_emocoes) references emocoes(pk_emocoes),
foreign key(fk_paciente) references paciente(pk_paciente),
foreign key(fk_anotacoes_psicologo) references anotacoes_psicologo(pk_anotacoes_psicologo)
);

SHOW TABLES;


