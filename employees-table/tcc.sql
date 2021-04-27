phpMyAdmin SQL Dump
 version 4.1.14
 http://www.phpmyadmin.net

 Host: 127.0.0.1
 Generation Time: May 16, 2017 at 10:53 AM
 Server version: 5.6.17
 PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
!40101 SET NAMES utf8 ;


create database tcc;
use tcc;

create table endereco (
cod int not null auto_increment,
cidade varchar(50) default ("Balneário Gaivota"),
rua varchar (70),
 n_da_casa int,
bairro varchar(40) default ("Lagoa de Fora"),
primary key (cod));

create table cliente  (
cod int not null auto_increment,
login int,
nome varchar (60),
cpf int,
n_de_telefone int,
endereco int,
primary key (cod),
constraint fk_endereco foreign key (endereco) references endereco (cod));
create table tipo_de_produto  (
cod int not null auto_increment,
descricao varchar(120) null,
primary key (cod));

create table marca (
cod int not null auto_increment,
descricao varchar(120),
primary key (cod));compracompraclientecompra

create table forma_de_retirada  (
cod int not null auto_increment,
descricao varchar(50),
primary key (cod));

create table frete  (
cod int not null auto_increment,
descricao varchar(200),
cep varchar(9) default("88955-000"),
valor real,
primary key (cod));

create table login  (
cod int not null auto_increment,
email varchar(254),
senha varchar (8),
primary key (cod));

create table produto (
cod int not null auto_increment,
descrcicao varchar(120),
valor real,
imagem varchar(200),
obs varchar(200) ,
marca varchar(50),
tipo_de_produto int,
primary key (cod),
constraint fk_tpproduto foreign key (tipo_de_produto) references tipo_de_produto (cod));
create table forma_de_pagamento  (
cod int not null auto_increment,
descricao varchar(100),
quant_parcelas int default("2"),
primary key (cod));
create table compra  (
cod int not null auto_increment,
cliente int,
produto int,
forma_de_pagamento int,
forma_de_retirada int,
frete int,
obs varchar (200),
hora_da_compra time default (curdate()),
dia_da_compra date default (curdate()),
primary key (cod),

constraint fk_cliente foreign key (cliente) references cliente (cod),
constraint fk_produto foreign key (produto) references produto (cod),
constraint fk_forma_de_pagamento foreign key (forma_de_pagamento) references forma_de_pagamento (cod),
constraint fk_forma_de_retirada foreign key (forma_de_retirada) references forma_de_retirada (cod),
constraint fk_frete foreign key (frete) references frete (cod));
INSERT INTO `tcc` (`id`, `name`, `address`, `salary`) VALUES
(1, 'Roland Mendel', 'C/ Araquil, 67, Madrid', 5000),
(2, 'Victoria Ashworth', '35 King George, London', 6500),
(3, 'Martin Blank', '25, Rue Lauriston, Paris', 8000);