DROP DATABASE verzio1;

CREATE DATABASE IF NOT EXISTS verzio1
    DEFAULT CHARACTER SET= utf8 
    DEFAULT COLLATE = utf8_hungarian_ci;
USE verzio1;

CREATE TABLE szerepek(
    id INT AUTO_INCREMENT PRIMARY KEY,
    szerep VARCHAR(255) NOT NULL unique
);

INSERT INTO szerepek (szerep) VALUES
('tanulo'),
('tanar'),
('admin');

CREATE TABLE felhasznalo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL unique,
    jelszo_hash VARCHAR(255) NOT NULL,
    szerep_id INT NOT NULL,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT szerep_fk
        FOREIGN KEY (szerep_id)
        REFERENCES szerepek(id)
);

CREATE TABLE session(
    id INT AUTO_INCREMENT PRIMARY KEY,
    felhasznalo_id INT NOT NULL,
    token VARCHAR(255) NOT NULL unique,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,
    lejarat DATETIME NOT NULL,
    kilepes BOOLEAN DEFAULT FALSE,
    CONSTRAINT felhasznalo_fk
        FOREIGN KEY (felhasznalo_id)
        REFERENCES felhasznalo(id)
        ON DELETE CASCADE
);
/*Ezt majd a létrehozáskor kell a táblába rakni*/
ALTER TABLE felhasznalo
ADD email_megerositve TINYINT(1) DEFAULT 0,
ADD email_token VARCHAR(64),
ADD email_token_lejarat DATETIME;
