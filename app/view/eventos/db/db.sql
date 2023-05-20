CREATE DATABASE agendas;

USE agendas;

CREATE TABLE eventos(
id INT(11)NOT  NULL AUTO_INCREMENT,
title VARCHAR(100) NULL,
START DATE NULL,
color VARCHAR(20) NULL,
PRIMARY KEY (id)
);   	

vida informatico as



create database comanda;

use comanda;

create table tbProduto(
    codProduto int(11) not null primary key auto_increment,
    descricao varchar(50) null,
    quantidade int(10) null, 
    valorUnitario decimal(10,2)
);
insert into tbProduto(descricao, quantidade,valorUnitario)
values ("refrigerante", 1, "7.00");
insert into tbProduto(descricao, quantidade,valorUnitario)
values ("suco", 10, "3.00");
insert into tbProduto(descricao, quantidade,valorUnitario)
values ("coxinha", 20, "5.00");
insert into tbProduto(descricao, quantidade,valorUnitario)
values ("hot-dog", 15, "10.00");

create table tbAtendente(
    codAtendente int(11) not null primary key auto_increment,
    nomeAtendente varchar(50) null,
    endereco varchar(50) null, 
    bairro varchar(50) null,
    cep varchar(15) null,
    municipio varchar(50) null, 
    cpf varchar(20) null, 
    rg varchar(15) null, 
    telefone varchar(15) null 
);
insert into tbAtendente(nomeAtendente, endereco, bairro, cep, municipio, cpf, rg, telefone)
values ("Jose", "Rua 15", "Jd. das flores", "05845-100", "São Paulo", "052.175.111-10", "31854845-7", "(11)92598-1021");
insert into tbAtendente(nomeAtendente, endereco, bairro, cep, municipio, cpf, rg, telefone)
values ("Carlos", "João de deus", "Vila das belezas", "07425-020", "São Paulo", "063.785.222-15", "42597520-9", "(11)95025-2030");

create table tbMesa(
    codMesa int(11) not null primary key auto_increment,
    codAtendente int,
    data_pedido varchar(15) null, 
    FOREIGN KEY (codAtendente) REFERENCES tbAtendente (codAtendente)
);

insert into tbMesa(codAtendente, data_pedido) values (1, "06/03/2023");
insert into tbMesa(codAtendente, data_pedido) values (2, "05/03/2023");

create table tbItensMesa(
    codItensMesa int(11) not null primary key auto_increment,
    codMesa int,
    codProduto int,
    quantidade int(20) null,
    valorTotal decimal(10,2),
    FOREIGN KEY (codProduto) REFERENCES tbProduto (codProduto),
    FOREIGN KEY (codMesa) REFERENCES tbMesa (codMesa)
);

insert into tbItensMesa(codMesa, codProduto, quantidade, valorTotal)
values (2,1,10,null);
insert into tbItensMesa(codMesa, codProduto, quantidade, valorTotal)
values (2,1,5,null);

