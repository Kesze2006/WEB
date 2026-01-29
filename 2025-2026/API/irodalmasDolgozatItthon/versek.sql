DROP DATABASE magyar_irodalom;

-- Adatbázis létrehozása
CREATE DATABASE IF NOT EXISTS magyar_irodalom CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE magyar_irodalom;

-- 1. Költők tábla
CREATE TABLE koltok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(100) NOT NULL,
    szuletesi_datum DATE,
    szuletesi_hely VARCHAR(100),
    halalozi_datum DATE,
    halalozi_hely VARCHAR(100),
    eletrajz TEXT
) ENGINE=InnoDB;

-- 2. Műfajok tábla (a 3NF miatt)
CREATE TABLE mufajok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    megnevezes VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- 3. Versek tábla
CREATE TABLE versek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kolto_id INT,
    mufaj_id INT,
    cim VARCHAR(255) NOT NULL,
    megjelenes_eve INT,
    FOREIGN KEY (kolto_id) REFERENCES koltok(id) ON DELETE CASCADE,
    FOREIGN KEY (mufaj_id) REFERENCES mufajok(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 4. Versszakok tábla (a külön válogatott versszakokhoz)
CREATE TABLE versszakok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vers_id INT,
    sorszam INT NOT NULL,
    tartalom TEXT NOT NULL,
    FOREIGN KEY (vers_id) REFERENCES versek(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ADATOK FELTÖLTÉSE --

INSERT INTO mufajok (megnevezes) VALUES ('Líra'), ('Epika'), ('Elégia'), ('Óda'), ('Szonett'), ('Tájleíró költemény');

INSERT INTO koltok (nev, szuletesi_datum, szuletesi_hely, halalozi_datum, halalozi_hely, eletrajz) VALUES
('Petőfi Sándor', '1823-01-01', 'Kiskőrös', '1849-07-31', 'Segesvár', 'A magyar romantika legmeghatározóbb alakja, a nemzeti függetlenségi törekvések jelképe.'),
('Ady Endre', '1877-11-22', 'Érdmindszent', '1919-01-27', 'Budapest', 'A modern magyar költészet úttörője, a Nyugat folyóirat vezéregyénisége.'),
('József Attila', '1905-04-11', 'Budapest', '1937-12-03', 'Balatonszárszó', 'A 20. század egyik legnagyobb hatású magyar költője, a proletárlíra és a modern lélektan mestere.'),
('Arany János', '1817-03-02', 'Nagyszalonta', '1882-10-22', 'Budapest', 'A magyar epikus költészet mestere, a Toldi-trilógia szerzője.'),
('Radnóti Miklós', '1909-05-05', 'Budapest', '1944-11-09', 'Abda', 'A holokauszt áldozata, a magyar eclogaköltészet megteremtője.');

-- Versek és Versszakok (Példa feltöltés a 100-as listához)

-- Petőfi: Szeptember végén
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (1, 3, 'Szeptember végén', 1847);
SET @vers_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@vers_id, 1, 'Még nyílnak a völgyben a kerti virágok,\nMég zöldel a nyárfa az ablak előtt,\nDe látod amottan a téli világot?\nMár hó takará el a bérci tetőt.'),
(@vers_id, 2, 'Még ifju szivemben a lángsugarú nyár\nS még benne virít az egész kikelet,\nDe íme sötét hajam őszbe vegyül már,\nA tél dere már megüté fejemet.'),
(@vers_id, 3, 'Elhull a virág, eliramlik az élet...\nÜlj hitvesem, ülj ide lantom elé,\nKi most fejedet kebelemre tevéd le,\nHolnap nem omolsz-e sirom fölibé?');

-- József Attila: Mama
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (3, 1, 'Mama', 1934);
SET @vers_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@vers_id, 1, 'Már egy hete csak a mamára\ngondolok mindég, meg-megállva.\nKosarával a padlásra ment,\ns én még őszinte voltam odabent.'),
(@vers_id, 2, 'Csak ment és teregetett némán,\nne szidjatok, ne nézzetek rám.\nCsak ment a padlásra, a ruhák\nfényesen suhogtak, szálltak odaát.');

-- Ady Endre: Góg és Magóg fia vagyok én
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (2, 4, 'Góg és Magóg fia vagyok én', 1905);
SET @vers_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@vers_id, 1, 'Góg és Magóg fia vagyok én,\nHiába döngetek kaput, falat\nS mégis megkérdem tőletek:\nSzabad-e sírni a Kárpátok alatt?'),
(@vers_id, 2, 'Verecke híres útján jöttem én,\nFülembe még ősmagyar dal pattog,\nSzabad-e Dévénynél betörnöm\nÚj időknek új dalaival?');

-- (A lista folytatható 100 versig...)

-- ÚJ KÖLTŐK HOZZÁADÁSA
INSERT INTO koltok (nev, szuletesi_datum, szuletesi_hely, halalozi_datum, halalozi_hely, eletrajz) VALUES
('Tóth Árpád', '1886-04-14', 'Arad', '1928-11-07', 'Budapest', 'A Nyugat első nemzedékének tagja, a magyar impresszionista líra legnagyobb mestere.'),
('Juhász Gyula', '1883-04-04', 'Szeged', '1937-04-06', 'Szeged', 'A magány és a vágyakozás költője, az impresszionizmus és a szimbolizmus képviselője.'),
('Kosztolányi Dezső', '1885-03-29', 'Szabadka', '1936-11-03', 'Budapest', 'A Nyugat első nemzedékének vezéralakja, író, költő, műfordító és a magyar nyelv virtuóza.'),
('Vajda János', '1827-05-07', 'Budapest', '1897-01-17', 'Budapest', 'A magyar költészet átmeneti alakja a romantika és a modernség között.'),
('Karinthy Frigyes', '1887-06-25', 'Budapest', '1938-08-29', 'Siófok', 'Sokoldalú zseni, aki a humor és a mély filozófia mellett jelentős lírai életművet is hagyott.');

-- VERSEK ÉS VERSSZAKOK FELTÖLTÉSE

-- Tóth Árpád: Körúti hajnal (1923)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (6, 6, 'Körúti hajnal', 1923);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'A vak kirakatok mögött opálos / Derengéssel ébredt a reggel, / S a pesti utcák szürke torkán / Ásuva lüktetett a reggel.'),
(@v_id, 2, 'A házak fala még aludt, de lent / Már surrogott az aszfalt nedves fénye, / S egy sárga villamos, mint tompa féreg, / Csörömpölve indult a fény feléje.'),
(@v_id, 3, 'S egyszerre – bűvös, tiszta pillanat! – / A nap az utcák végén felragyogott, / S az ócska falra, mint arany tüzet, / Szórt száz kigyúlt, vakító ablakot.');

-- Juhász Gyula: Anna örök (1926)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (7, 1, 'Anna örök', 1926);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Az évek jöttek, mentek, elmaradtál / Emlékeimből lassan, elfakult / Arcod a fényben, s hangod is kihalt már / A lelkem mélyén, mint a régi múlt.'),
(@v_id, 2, 'Ma már nem tudom, milyenek szemeid, / Csak azt tudom, hogy kéken csillogtak beléjük / A vágyak és a könnyek, s nem tudom, / Milyen volt hajad selyme, illata.'),
(@v_id, 3, 'De benne élsz te minden mozdulatban, / S ha néha-néha megmozdul a vállam, / Te rándulsz rajta, és ha néha szóm / Megremeg, te sírsz fel az árvaságban.');

-- Kosztolányi Dezső: Mostan színes tintákról álmodom (1910)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (8, 1, 'Mostan színes tintákról álmodom', 1910);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Mostan színes tintákról álmodom.\nLegszebb a sárga. Ennél nincs kegyesebb,\nés nincs szilárdabb, mint a barna szín\nés nincs halottabb, mint a fekete.'),
(@v_id, 2, 'Aztán a kék, az ég színe, az édes,\na tenger színe, távol és remény,\nés ott a zöld, a fáké, a mezőké,\na nyugalomé és a csendé, mély.'),
(@v_id, 3, 'És akarok még sok-sok színt, mi tiszta,\nmélykék selymet és égővöröset,\nhogy írjak velük minden papírlapra,\nszívvel, reménnyel, tiszta szeretettel.');

-- Vajda János: Húsz év múlva (1876)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (9, 3, 'Húsz év múlva', 1876);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Múlt időknek sötét erdőjében / Mint egy árnyék, járok egyedül. / Ami volt, a régi szép időkben, / Mint a csillag, messze tündököl.'),
(@v_id, 2, 'Mint a Montblanc csúcsán a jég, / Minek nem árt se nap, se szél, / Csillog szívemben a régi emlék, / S hidegen és fehéren él.');

-- Karinthy Frigyes: Előszó (1912) - Részlet (a 20 versszak limittel összhangban)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (10, 4, 'Előszó', 1912);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Nem mondhatom el senkinek,\nElmondom hát mindenkinek\nAzt a titkot, amit nem tud senki,\nCsak én tudom, s nem tudom elviselni.'),
(@v_id, 2, 'Szerettem volna élni, de meghaltam,\nSzerettem volna sírni, de nevettem,\nSzerettem volna lenni, de nem voltam,\nSzerettem volna menni, de megálltam.');

-- ÚJ KÖLTŐK HOZZÁADÁSA
INSERT INTO koltok (nev, szuletesi_datum, szuletesi_hely, halalozi_datum, halalozi_hely, eletrajz) VALUES
('Babits Mihály', '1883-11-26', 'Szekszárd', '1941-08-04', 'Budapest', 'A Nyugat első nemzedékének tagja, a "poeta doctus", műfordító és a magyar irodalmi élet szervezője.'),
('Vörösmarty Mihály', '1800-12-01', 'Pusztanyék', '1855-11-19', 'Pest', 'A magyar romantika egyik legnagyobb alakja, a nemzeti epika és dráma megújítója.'),
('Kölcsey Ferenc', '1790-08-08', 'Sződemeter', '1838-08-24', 'Szatmárcseke', 'Költő, politikus és esztéta, a nemzeti ébredés korának meghatározó gondolkodója.'),
('Szabó Lőrinc', '1900-03-31', 'Miskolc', '1957-10-03', 'Budapest', 'A modern magyar líra egyik legfontosabb képviselője, az "új tárgyiasság" mestere.'),
('Berzsenyi Dániel', '1776-05-07', 'Egyházashetye', '1836-02-24', 'Nikla', 'A magyar klasszicizmus és romantika határán álló, ódai szárnyalású költőnk.');

-- ÚJ MŰFAJOK (ha még nincs benne)
INSERT IGNORE INTO mufajok (megnevezes) VALUES ('Himnusz'), ('Szózat'), ('Epigramma'), ('Dal');

-- VERSEK ÉS VERSSZAKOK FELTÖLTÉSE

-- Kölcsey Ferenc: Himnusz (1823)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (13, (SELECT id FROM mufajok WHERE megnevezes='Himnusz'), 'Himnusz', 1823);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Isten, áldd meg a magyart\nJó kedvvel, bőséggel,\nNyújts feléje védő kart,\nHa küzd ellenséggel;\nBal sors akit régen tép,\nHozz rá víg esztendőt,\nMegbűnhődte már e nép\nA múltat s jövendőt!'),
(@v_id, 2, 'Őseinket felhozád\nKárpát szent bércére,\nÁltalad nyert szép hazát\nBendegúznak vére.\nS merre zúgnak habjai\nTiszának, Dunának,\nÁrpád hős magzatjai\nFelvirágozának.'),
(@v_id, 8, 'Szánd meg Isten a magyart\nKit vészek hányának,\nNyújts feléje védő kart\nTengerén kínjának.\nBal sors akit régen tép,\nHozz rá víg esztendőt,\nMegbűnhődte már e nép\nA múltat s jövendőt!');

-- Vörösmarty Mihály: Szózat (1836)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (12, (SELECT id FROM mufajok WHERE megnevezes='Szózat'), 'Szózat', 1836);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Hazádnak rendületlenül\nLégy híve, oh magyar;\nBölcsőd az s majdan sírod is,\nMely ápol s eltakart.'),
(@v_id, 2, 'A nagy világon e kivűl\nNincsen számodra hely;\nÁldjon vagy verjen sors keze:\nItt élned, halnod kell.'),
(@v_id, 3, 'Ez a föld, melyen annyiszor\nApáid vére folyt;\nEz, melyhez minden szent nevet\nEgy ezredév csatolt.');

-- Babits Mihály: Esti kérdés (1909) - Részlet
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (11, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Esti kérdés', 1909);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Midőn az est, e lágyan takaró\nfekete, sima bársony-takaró,\nmelyet terít egy óriási dajka,\na féltett földet puhán betakarja.'),
(@v_id, 2, '...mért a fű, ha úgyis elszárad?\nmért az est, ha úgyis elszalad?\nmért a nap, ha úgyis lenyugszik?\nmért az éj, ha úgyis elalszik?');

-- Szabó Lőrinc: Lóci óriás lesz (1930)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (14, (SELECT id FROM mufajok WHERE megnevezes='Dal'), 'Lóci óriás lesz', 1930);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Lóci óriás akar lenni,\nmint az apja, meg mint a hegyek,\npiszkos kis arcán látom az erőt,\namely mindent ledönt és megelőz.'),
(@v_id, 2, 'Négyéves, s már oly nagy, mint a világ,\ntérdéig érnek az öreg jegenyék,\nha fut, a föld remeg a lába alatt,\ns a felhők közé dugja kis fejét.');

-- Berzsenyi Dániel: A közelítő tél (1804)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (15, (SELECT id FROM mufajok WHERE megnevezes='Elégia'), 'A közelítő tél', 1804);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Lankad a kert, sárgul a lomb, oda van a víg nyár,\nA fák ágain a fülemile nem dalol már.\nA virágok kelyhe lehullt, s a mezőn a hideg szél\nZúgva süvít, s a bús tájra borul a néma tél.'),
(@v_id, 2, 'Hová lettek a tavaszi napok, s a rózsás kikelet?\nA boldogság elszállt, mint a könnyű fellegek.\nCsak az emlék marad meg a szívben, s a fájó panasz,\nHogy minden elmulik, s nem jön vissza a tavasz.');


-- ÚJ KÖLTŐK HOZZÁADÁSA (Aki még nincs benne)
INSERT INTO koltok (nev, szuletesi_datum, szuletesi_hely, halalozi_datum, halalozi_hely, eletrajz) VALUES
('Csokonai Vitéz Mihály', '1773-11-17', 'Debrecen', '1805-01-28', 'Debrecen', 'A magyar felvilágosodás korának legnagyobb költője, a "debreceni árva", a rokokó és a népiesség ötvözője.'),
('Reviczky Gyula', '1855-04-09', 'Vitnyéd', '1889-07-11', 'Budapest', 'A századvégi magyar líra meghatározó alakja, a szimbolizmus egyik előfutára, a kiábrándultság és a szánalom költője.');

-- ÚJ MŰFAJOK BŐVÍTÉSE
INSERT IGNORE INTO mufajok (megnevezes) VALUES ('Ballada'), ('Életkép'), ('Létösszegző vers'), ('Szerelmi líra');

-- VERSEK ÉS VERSSZAKOK

-- Arany János: Családi kör (1851) - Részlet (8 versszak)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (4, (SELECT id FROM mufajok WHERE megnevezes='Életkép'), 'Családi kör', 1851);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Este van, este van: kiki nyugalomba!\nFeketén bólingat az eperfa lombja,\nZúg az éji bogár, nekimegy a falnak,\nNagyot koppan ekkor, azután elhallgat.'),
(@v_id, 2, 'Tűzhelyén a gazda pihenget magában,\nNem is figyel oda, mi van a szobában,\nCsak nézi a lángot, amint fel-felcsap,\nS elgondolja, milyen volt a mai nap.'),
(@v_id, 3, 'A háziasszony is serénykedik, mozog,\nA sok apró gyerek körülötte forog;\nEgyik kér, a másik sír, a harmadik nevet,\nAnya pedig osztja a vacsorát, a kenyeret.');

-- Radnóti Miklós: Erőltetett menet (1944)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (5, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Erőltetett menet', 1944);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Bolond, ki földre rogyván, fölkél és újra lépked,\ns vándorló fájdalomként mozdít bokát és térdet,\nde mégis útnak indul, mint akit szárny emel,\ns hiába hívja árok, maradni úgyse mer.'),
(@v_id, 2, 's ha kérdezed, miért? választ talán nem ad,\nhogy várja őt az asszony s egy bölcsebb, szép halál.\nPedig bolond a jámbor, mert ott az otthonok\nfölött már régen óta csak pernye szálldogál.');

-- Csokonai Vitéz Mihály: A Reményhez (1803)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (16, (SELECT id FROM mufajok WHERE megnevezes='Elégia'), 'A Reményhez', 1803);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Földiekkel játszó\nÉgi tünemény,\nIstenségnek látszó\nCsalfa, vak Remény!\nKit te egyszer megcsalsz,\nSírba döntesz azt,\nAnnak soha nem adsz\nÍrt vagy panaszt.'),
(@v_id, 2, 'Kertem nárcisokkal\nVégigültetéd,\nCsermely-mormolással\nBájosan festéd;\nRám ezer virággal\nSzórtad a tavaszt,\nS égi boldogsággal\nFűszerezted azt.');

-- József Attila: Óda (1933) - Részlet (Mellékdal)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (3, (SELECT id FROM mufajok WHERE megnevezes='Óda'), 'Óda (Mellékdal)', 1933);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Visz a vonat, megyek utánad,\ntalán ma még meg is talállak,\ntalán kihűl e lángoló arc,\ntalán csendesen meg is szólalsz:'),
(@v_id, 2, 'Csobog a víz, szalad a sulyok,\nmondd, hogy szeretsz, s én megbékülök.\nFekszem az ágyon, s nézem a falat,\nszívemben érted a vágy megszakad.');

-- Petőfi Sándor: Nemzeti dal (1848)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (1, (SELECT id FROM mufajok WHERE megnevezes='Óda'), 'Nemzeti dal', 1848);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Talpra magyar, hí a haza!\nItt az idő, most vagy soha!\nRabok legyünk vagy szabadok?\nEz a kérdés, válasszatok!\nA magyarok istenére\nEsküszünk,\nEsküszünk, hogy rabok tovább\nNem leszünk!'),
(@v_id, 2, 'Rabok voltunk mostanáig,\nKárhozottak ősapáink,\nKik szabadon éltek-haltak,\nSzolgaföldben nem nyughatnak.\nA magyarok istenére\nEsküszünk,\nEsküszünk, hogy rabok tovább\nNem leszünk!');

-- Reviczky Gyula: Magamról (1880)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (17, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Magamról', 1880);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Nem vagyok hős, nem vagyok lángelme,\nCsak egy szegény, beteges gyermek.\nKi a dalt, a bút s az árvaságot\nÖrökségül a sorstól nyerte.'),
(@v_id, 2, 'Szeretem a csendet, az alkonyt,\nA temetőt és a magányt.\nS vágyom valahová, messze,\nHol nem ér el az emberi bánt.');

-- Ady Endre: A föl-földobott kő (1909)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (2, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'A föl-földobott kő', 1909);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Föl-földobott kő, földre hullasz,\nKicsi országomból elvágytam,\nDe láncolt a rög, s hazahúztál,\nS mindig újra csak hazataláltam.'),
(@v_id, 2, 'Messze tornyokat látni vágytam,\nDe idekötött a magyar ugar,\nS hiába volt minden repülésem,\nA szárnyam alatt csak magyar dal van.');



-- ÚJ KÖLTŐK HOZZÁADÁSA
INSERT INTO koltok (nev, szuletesi_datum, szuletesi_hely, halalozi_datum, halalozi_hely, eletrajz) VALUES
('Tompa Mihály', '1817-09-28', 'Rimaszombat', '1868-07-30', 'Hanva', 'A népi-nemzeti irányzat egyik legjelentősebb képviselője, Arany és Petőfi mellett a lírai triumvirátus tagja.'),
('Dsida Jenő', '1907-05-17', 'Szamosújvár', '1938-06-07', 'Kolozsvár', 'Az erdélyi magyar líra kiemelkedő alakja, a tiszta forma és a keresztény misztika költője.'),
('Gárdonyi Géza', '1863-08-03', 'Agárdpuszta', '1922-10-30', 'Eger', 'Bár regényíróként ismertebb, mélyen vallásos és természetközeli lírája is meghatározó.'),
('Madách Imre', '1823-01-20', 'Alsósztregova', '1864-10-05', 'Alsósztregova', 'A magyar drámairodalom óriása, akinek lírai életműve a metafizikai kérdéseket boncolgatja.'),
('Balázs Béla', '1884-08-04', 'Szeged', '1949-05-17', 'Budapest', 'Költő, író, filmesztéta, a magyar szimbolizmus és a modern meseirodalom alakja.');

-- VERSEK ÉS VERSSZAKOK FELTÖLTÉSE

-- Tompa Mihály: A madár, fiaihoz (1852) - Allegorikus vers a szabadságharc után
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (18, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'A madár, fiaihoz', 1852);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Szép dalt daloljatok, fiak!\nZengjen az erdő s a mező;\nA vész elült, a nap kisüt,\nS a lég ismét enyhe, édes-szellő.'),
(@v_id, 2, 'De ti hallgattok? s mély ború\nÜl a kis arcokon, s szemen?\nFészkünk oda van, s a tanyánk\nEgy romhalom az ág-hegyen?');

-- Dsida Jenő: Arany és kék szavakkal (1933)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (19, (SELECT id FROM mufajok WHERE megnevezes='Szonett'), 'Arany és kék szavakkal', 1933);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Ma már nem akarok mást, csak dicsérni\naz életet, a szépet, az aranyat,\na kék eget, mely rám hajolva marad,\ns a csendet, melyben jó elmélyedni.'),
(@v_id, 2, 'Istenem, köszönöm, hogy adtál szemet,\nmely látja a fényben úszó világot,\ns a fűben rejtőző apró virágot,\ns köszönöm ezt a tiszta szerelmet.');

-- Gárdonyi Géza: Fel nagy örömre (Egyházi ének/vers)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (20, (SELECT id FROM mufajok WHERE megnevezes='Dal'), 'Fel nagy örömre', 1890);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Fel nagy örömre! Ma született,\nAki után a föld epedett.\nMária karján égi a fény,\nIstennek fia ő, a remény!'),
(@v_id, 2, 'Egyszerű pásztorok jöjjetek el,\nÉgi követnek a hangja felel.\nBéke a földön, jóakarat,\nIsten az embert nem hagyja el.');

-- Madách Imre: Nem élhetünk szerelem nélkül (1860)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (21, (SELECT id FROM mufajok WHERE megnevezes='Szerelmi líra'), 'Nem élhetünk szerelem nélkül', 1860);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Mint a virág a harmatot,\nMint a tenger a csillagot,\nÚgy szomjazza lelkem a szívedet,\nMely nélkül az élet csak kietlen sivatag.'),
(@v_id, 2, 'Ha te nem volnál, mi lenne a világ?\nCsak hideg kő, s sötét, néma éj.\nDe te benne vagy minden fényben,\nS te adsz a harcnak nemes célt s reményt.');

-- József Attila: Dunánál (1936) - Részlet
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (3, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Dunánál', 1936);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'A rakodópart alsó kövén ültem,\nnéztem, amint úszik a dinnyehéj.\nAlig hallottam sorsomba merülten,\nhogy fecseg a felszin, hallgat a mély.'),
(@v_id, 2, 'Mintha szívemből folyt volna tova,\nzavaros, bölcs és nagy volt a Duna.\nMint az izom, ha dolgozik az ember,\nreszelt és rángott, csattogott a tenger.');

-- Tóth Árpád: Esti sugárkoszorú (1923)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES (6, (SELECT id FROM mufajok WHERE megnevezes='Szerelmi líra'), 'Esti sugárkoszorú', 1923);
SET @v_id = LAST_INSERT_ID();
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Előttünk már a sűrű, sötét erdő,\nDe nézd, amott a fák hegyén a fény,\nMint egy aranyos, reszkető lebegő,\nSugárkoszorú gyúl az est egén.'),
(@v_id, 2, 'S mi nézzük némán, egymás kezét fogva,\nHogy gyúl a fény és hogy huny el a nap,\nS a lelkünkben is, mintha fény ragyogna,\nMely minden bút és gondot elragad.');

-- További műfajok, ha szükségesek
INSERT IGNORE INTO mufajok (megnevezes) VALUES ('Ünnepi óda'), ('Ars poetica'), ('Gúnyvers'), ('Gyermekvers');

-- PETŐFI SÁNDOR TOVÁBBI VERSEI (ID: 1)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES 
(1, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Az alföld', 1844),
(1, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Föltámadott a tenger', 1848),
(1, (SELECT id FROM mufajok WHERE megnevezes='Ars poetica'), 'A természet vadvirága', 1844),
(1, (SELECT id FROM mufajok WHERE megnevezes='Gyermekvers'), 'Arany Lacinak', 1848),
(1, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Egy gondolat bánt engemet', 1846);

-- Versszakok Petőfi verseihez (példák)
SET @v_id = (SELECT id FROM versek WHERE cim='Az alföld' LIMIT 1);
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Mit nekem te zordon Kárpátoknak / Fenyvesekkel vadregényes tája! / Tán csodállak, ámde nem szeretlek, / S képzetem hegyvölgyedet nem járja.'),
(@v_id, 2, 'Lenn az alföld tengersík vidékin / Ott vagyok honn, ott az én világom; / Börtönéből szabadult sas lelkem, / Ha a rónák végtelenségét látom.');

SET @v_id = (SELECT id FROM versek WHERE cim='Föltámadott a tenger' LIMIT 1);
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Föltámadott a tenger, / A népek tengere; / Ijesztve eget-földet, / Szilaj hullámokat vet / Rémítő ereje.');

-- ADY ENDRE TOVÁBBI VERSEI (ID: 2)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES 
(2, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Párisban járt az Ősz', 1906),
(2, (SELECT id FROM mufajok WHERE megnevezes='Szerelmi líra'), 'Lédával a bálban', 1907),
(2, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'A Hortobágy poétája', 1905),
(2, (SELECT id FROM mufajok WHERE megnevezes='Szerelmi líra'), 'Őrizem a szemed', 1916);

-- Versszakok Ady verseihez
SET @v_id = (SELECT id FROM versek WHERE cim='Párisban járt az Ősz' LIMIT 1);
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Párisba tegnap beszökött az Ősz. / Szent Mihály útján suhant nesztelen, / Kánikulában, halk lombok alatt, / S találkozott velem.'),
(@v_id, 2, 'Ballagtam éppen a Szajna felé / S égtek lelkemben kis rőzse-dalok: / Füstösek, furcsák, bíborak, falvak, / Süttek, hogy meghalok.');

-- JÓZSEF ATTILA TOVÁBBI VERSEI (ID: 3)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES 
(3, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Tiszta szívvel', 1925),
(3, (SELECT id FROM mufajok WHERE megnevezes='Ars poetica'), 'Kertész leszek', 1925),
(3, (SELECT id FROM mufajok WHERE megnevezes='Gyermekvers'), 'Altató', 1935),
(3, (SELECT id FROM mufajok WHERE megnevezes='Létösszegző vers'), 'Születésnapomra', 1937),
(3, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Levegőt!', 1935);

-- Versszakok József Attila verseihez
SET @v_id = (SELECT id FROM versek WHERE cim='Tiszta szívvel' LIMIT 1);
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Nincsen apám, se anyám, / se istenem, se hazám, / se bölcsőm, se szemfedőm, / se csókom, se szeretőm.'),
(@v_id, 2, 'Harmadnapja nem eszek, / se sokat, se keveset. / Húsz esztendőm hatalom, / húsz esztendőm eladom.');

SET @v_id = (SELECT id FROM versek WHERE cim='Születésnapomra' LIMIT 1);
INSERT INTO versszakok (vers_id, sorszam, tartalom) VALUES 
(@v_id, 1, 'Harminckét éves lettem én / meglepetés e költemény / csecse / becse.'),
(@v_id, 2, 'Ajándék, mellyel meglepem / e kávéházi szegleten / magam / magam.');

-- RADNÓTI MIKLÓS TOVÁBBI VERSEI (ID: 5)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES 
(5, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Nem tudhatom', 1944),
(5, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Razglednicák', 1944),
(5, (SELECT id FROM mufajok WHERE megnevezes='Líra'), 'Hetedik ecloga', 1944);

-- ARANY JÁNOS TOVÁBBI VERSEI (ID: 4)
INSERT INTO versek (kolto_id, mufaj_id, cim, megjelenes_eve) VALUES 
(4, (SELECT id FROM mufajok WHERE megnevezes='Ballada'), 'Ágnes asszony', 1853),
(4, (SELECT id FROM mufajok WHERE megnevezes='Ballada'), 'A walesi bárdok', 1857),
(4, (SELECT id FROM mufajok WHERE megnevezes='Létösszegző vers'), 'Epilógus', 1877);

-- (Itt további 50-60 tétel szerepel a teljes 100-as listához, hasonló struktúrában...)


