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
    deleted TINYINT not null default 0,
    foreign key (seller_id) references users(id),
    foreign key (image_id) references images(id)
);

create table cart (
	  id integer auto_increment primary key,
    product_id integer not null,
    quantity integer not null,
    buyer_id integer not null,
    foreign key (buyer_id) references users(id),
    foreign key (product_id) references products(id)
);

create table sale (
	  id integer auto_increment primary key,
    buyer_id integer not null,
    total_price float not null,
    sale_date timestamp default current_timestamp,
    foreign key (buyer_id) references users(id)
);

create table sale_details (
	  id integer auto_increment primary key,
	  product_id integer not null,
    quantity integer not null,
    sale_id integer not null,
    foreign key (product_id) references products(id),
    foreign key (sale_id) references sale(id)
);