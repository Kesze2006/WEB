CREATE DATABASE rest_demo CHARACTER SET utf8mb4;
USE rest_demo;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(64),
    token_expiry DATETIME
);

INSERT INTO users (username, password)
VALUES ('admin', SHA2('admin123', 256));
