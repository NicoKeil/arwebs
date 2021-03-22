CREATE DATABASE IF NOT EXISTS project_arwebs;

USE project_arwebs;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
username        varchar(50) not null, 
password        varchar(255) not null,
email           varchar(255) not null,
created_at      datetime,
CONSTRAINT pk_users PRIMARY KEY (id),
CONSTRAINT uq_email UNIQUE(email) 
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS categories(
id              int(255) auto_increment not null,
name          varchar(100) not null,
icon          varchar(255),
CONSTRAINT pk_categories PRIMARY KEY(id) 
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS products(
id              int(255) auto_increment not null,
category_id    int(255) not null,
name            varchar(100) not null,
image          varchar(255),
CONSTRAINT pk_products PRIMARY KEY(id),
CONSTRAINT fk_products_category FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDb;