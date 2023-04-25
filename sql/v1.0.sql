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

CREATE TABLE images (
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	image LONGBLOB NOT NULL,
	name TEXT NOT NULL,
	type VARCHAR (30) NOT NULL
);

create table products (
	id integer auto_increment primary key,
    name varchar(200) not null,
    price decimal(20, 4) not null,
    seller_id integer not null,
    image_id integer not null,
    foreign key (seller_id) references users(id),
    foreign key (image_id) references images(id)
);

create table cart (
	id integer auto_increment primary key,
    product_id integer not null,
    quantity integer not null,
    seller_id integer not null,
    foreign key (seller_id) references users(id),
    foreign key (product_id) references products(id)
);