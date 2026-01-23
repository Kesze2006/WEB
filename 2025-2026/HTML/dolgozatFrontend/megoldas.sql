--1.feladat
--kész

--2.feladat
Select hirfolyam.megnevezes,felhasznalo.email,felhasznalo.veznev,felhasznalo.utonev
From felhasznalo,hirfolyam
Where felhasznalo.id=hirfolyam.moderator;

--3.feladat
Select tartalom From uzed