create database trabalho_php;

use trabalho_php;

create table users (
	id int auto_increment primary key,
    email varchar(50) not null,
    password varchar(100) not null,
    role char(1),
    nome varchar(50) not null,
    salt varchar(50) not null,
    endereco varchar(50) not null,
    cep varchar(8),
    cidade_estado varchar(50) not null
);