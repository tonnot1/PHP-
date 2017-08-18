-- se connecter à une DB avec root dans invite de commande
mysql -u root -p
-- en php vu qu'on est pas encore dans la DB

-- voir les bases de données existantes
SHOW DATABASES;

-- Creer une DB
CREATE DATABASE newsletter_db;

-- Se connecter à une DB
USE newsletter_db;

-- Voir les tables
SHOW TABLES;

-- Creer une table
CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR (255) NOT NULL,
login VARCHAR (255) NOT NULL,
password VARCHAR (255) NOT NULL,
nom VARCHAR (255) NOT NULL,
prenom VARCHAR (255) NOT NULL,
created_at DATETIME NOT NULL,
CONSTRAINT user_pk PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- voir les détail d'une table
DESC user;