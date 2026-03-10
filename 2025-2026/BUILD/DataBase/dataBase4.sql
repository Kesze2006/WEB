DROP DATABASE IF EXISTS verzio4;

CREATE DATABASE IF NOT EXISTS verzio4
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_hungarian_ci;

USE verzio4;

-- ======================
-- SZEREPEK
-- ======================

CREATE TABLE szerepek(
    id INT AUTO_INCREMENT PRIMARY KEY,
    szerep VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO szerepek (szerep) VALUES
('diak'),
('tanar'),
('admin');

-- ======================
-- FELHASZNÁLÓ
-- ======================

CREATE TABLE felhasznalo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    jelszo_hash VARCHAR(255) NOT NULL,
    szerep_id INT NOT NULL,
    email_megerositve BOOLEAN DEFAULT FALSE,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (szerep_id)
        REFERENCES szerepek(id)
);

-- ======================
-- SESSION
-- ======================

CREATE TABLE session (
    id INT AUTO_INCREMENT PRIMARY KEY,
    felhasznalo_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,
    lejarat DATETIME NOT NULL,
    kilepes BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (felhasznalo_id)
        REFERENCES felhasznalo(id)
        ON DELETE CASCADE
);

-- ======================
-- FELHASZNÁLÓ TOKENEK
-- ======================

CREATE TABLE felhasznalo_tokenek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    felhasznalo_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    tipus ENUM('email_megerosites','jelszo_reset') NOT NULL,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,
    felhasznalva BOOLEAN DEFAULT FALSE,
    lejarat DATETIME NOT NULL,

    FOREIGN KEY (felhasznalo_id)
        REFERENCES felhasznalo(id)
        ON DELETE CASCADE
);

-- ======================
-- TÍPUSOK
-- ======================

CREATE TABLE tipusok(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipus VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO tipusok (tipus) VALUES
('publikus'),
('privat');

-- ======================
-- KURZUSOK
-- ======================

CREATE TABLE kurzusok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    leiras TEXT,
    tipus_id INT NOT NULL,
    letrehozo_id INT NOT NULL,
    letszam INT NOT NULL DEFAULT 0,
    max_letszam INT NOT NULL,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tipus_id)
        REFERENCES tipusok(id),

    FOREIGN KEY (letrehozo_id)
        REFERENCES felhasznalo(id)
);

-- ======================
-- KURZUS MEGHÍVÓKÓD
-- ======================

CREATE TABLE kurzus_meghivo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kurzus_id INT NOT NULL,
    kod VARCHAR(10) NOT NULL UNIQUE,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (kurzus_id)
        REFERENCES kurzusok(id)
        ON DELETE CASCADE
);

-- ======================
-- KURZUS RÉSZTVEVŐK
-- ======================

CREATE TABLE kurzus_resztvevo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kurzus_id INT NOT NULL,
    felhasznalo_id INT NOT NULL,
    csatlakozott DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (kurzus_id)
        REFERENCES kurzusok(id)
        ON DELETE CASCADE,

    FOREIGN KEY (felhasznalo_id)
        REFERENCES felhasznalo(id)
        ON DELETE CASCADE,
);

/*
-- ======================
-- FELADATOK
-- ======================

CREATE TABLE feladatok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kurzus_id INT NOT NULL,
    cim VARCHAR(255) NOT NULL,
    leiras TEXT,
    max_pont INT,
    hatarido DATETIME,
    letrehozva DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (kurzus_id)
        REFERENCES kurzusok(id)
        ON DELETE CASCADE
);

-- ======================
-- BEADÁSOK
-- ======================

CREATE TABLE beadasok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    feladat_id INT NOT NULL,
    diak_id INT NOT NULL,
    fajl_url VARCHAR(255),
    megjegyzes TEXT,
    beadva DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (feladat_id)
        REFERENCES feladatok(id)
        ON DELETE CASCADE,

    FOREIGN KEY (diak_id)
        REFERENCES felhasznalo(id)
        ON DELETE CASCADE,

    UNIQUE(feladat_id, diak_id)
);

-- ======================
-- ÉRTÉKELÉS
-- ======================

CREATE TABLE jegyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beadas_id INT NOT NULL UNIQUE,
    pont INT,
    megjegyzes TEXT,
    ertekelve DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (beadas_id)
        REFERENCES beadasok(id)
        ON DELETE CASCADE
);