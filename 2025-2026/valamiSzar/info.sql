CREATE TABLE telepules (id INT NOT NULL AUTO_INCREMENT , nev varchar(50) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO telepules(nev) SELECT DISTINCT telepules FROM diakok ORDER BY telepules;
ALTER TABLE diakok ADD telepules_id INT NOT NULL AFTER telepules;
ALTER TABLE diakok ADD INDEX(telepules_id);
UPDATE diakok SET telepules_id=(SELECT telepules.id FROM telepules WHERE telepules.nev=diakok.telepules)
ALTER TABLE diakok DROP telepules;


CREATE TABLE targy (id INT NOT NULL AUTO_INCREMENT , nev varchar(50) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
INSERT INTO targy(nev) SELECT DISTINCT targy FROM orak ORDER BY targy;
ALTER TABLE orak ADD targy_id INT NOT NULL AFTER datum;
ALTER TABLE orak ADD INDEX(targy_id);
UPDATE orak SET targy_id=(SELECT targy.id FROM targy WHERE targy.nev=orak.targy);
ALTER TABLE orak DROP targy;

CREATE TABLE csoport (id INT NOT NULL AUTO_INCREMENT , nev varchar(50) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
INSERT INTO csoport(nev) SELECT DISTINCT csoport FROM orak ORDER BY csoport;
ALTER TABLE orak ADD csoport_id INT NOT NULL AFTER datum;
ALTER TABLE orak ADD INDEX(csoport_id);
UPDATE orak SET csoport_id=(SELECT csoport.id FROM csoport WHERE csoport.nev=orak.csoport);
ALTER TABLE orak DROP csoport;

CREATE TABLE terem (id INT NOT NULL AUTO_INCREMENT , nev varchar(50) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
INSERT INTO terem(nev) SELECT DISTINCT terem FROM orak ORDER BY terem;
ALTER TABLE orak ADD terem_id INT NOT NULL AFTER datum;
ALTER TABLE orak ADD INDEX(terem_id);
UPDATE orak SET terem_id=(SELECT terem.id FROM terem WHERE terem.nev=orak.terem);
ALTER TABLE orak DROP terem;

CREATE TABLE tanar (id INT NOT NULL AUTO_INCREMENT , nev varchar(50) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
INSERT INTO tanar(nev) SELECT DISTINCT tanar FROM orak ORDER BY tanar;
ALTER TABLE orak ADD tanar_id INT NOT NULL AFTER datum;
ALTER TABLE orak ADD INDEX(tanar_id);
UPDATE orak SET tanar_id=(SELECT tanar.id FROM tanar WHERE tanar.nev=orak.tanar);
ALTER TABLE orak DROP tanar;

ALTER TABLE diakok
  ADD CONSTRAINT telepules_fk FOREIGN KEY (telepules_id) REFERENCES telepules (id);

ALTER TABLE orak
  ADD CONSTRAINT targy_fk FOREIGN KEY (targy_id) REFERENCES targy (id),
  ADD CONSTRAINT csoport_fk FOREIGN KEY (csoport_id) REFERENCES csoport (id),
  ADD CONSTRAINT terem_fk FOREIGN KEY (terem_id) REFERENCES terem (id),
  ADD CONSTRAINT tanar_fk FOREIGN KEY (tanar_id) REFERENCES tanar (id);

--