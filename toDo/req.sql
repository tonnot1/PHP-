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
id_user INT NOT NULL AUTO_INCREMENT,
login VARCHAR (255) NOT NULL,
email VARCHAR (255) NOT NULL,
password VARCHAR (255) NOT NULL,
is_admin BOOLEAN NOT NULL,
prenom VARCHAR (255) NOT NULL,
nom VARCHAR (255) NOT NULL,
created_at DATETIME NOT NULL,
CONSTRAINT pk_id_user PRIMARY KEY (id_user)
)ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE task(
id_task INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
titre VARCHAR (255) NOT NULL,
resume VARCHAR (255) NOT NULL,
content TEXT NOT NULL,
created_at DATETIME NOT NULL,
id_user INT NOT NULL,
id_statut INT NOT NULL,
CONSTRAINT pk_id_user FOREIGN KEY (id_user) REFERENCES user(id_user),
CONSTRAINT pk_id_statut FOREIGN KEY (id_statut) REFERENCES statut(id_statut)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--**********************************************--
CREATE TABLE statut(
id_statut INT NOT NULL AUTO_INCREMENT,
libelle VARCHAR (255) NOT NULL,
created_at DATETIME NOT NULL,
CONSTRAINT pk_id_statut PRIMARY KEY (id_statut)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- voir les détail d'une table
DESC user;

INSERT INTO user VALUES ('id-user', 'papa','toto@gmail.c','','','')