CREATE DATABASE IF NOT EXISTS testdb;

USE testdb;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO users (name, email) VALUES ('Kimin Park1', 'lkasd7512@gmail.com');
INSERT INTO users (name, email) VALUES ('Kimin Park2', 'lkasd7512@naver.com');