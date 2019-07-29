use xkopac05;
set names 'utf8'; 

DROP TABLE IF EXISTS distribuce_se_dodava_do;
DROP TABLE IF EXISTS bezny_uzivatel_ohodnotil_hospodu;
DROP TABLE IF EXISTS bezny_uzivatel_sleduje_pivovar;
DROP TABLE IF EXISTS bezny_uzivatel_odebira_pivovar;
DROP TABLE IF EXISTS bezny_uzivatel_ohodnotil_pivo;
DROP TABLE IF EXISTS sladek_pridal_distribuci;
DROP TABLE IF EXISTS sladek_uvaril_pivo;
DROP TABLE IF EXISTS surovina_pochazi_z;
DROP TABLE IF EXISTS pivo_je_uvareno_z;

DROP TABLE IF EXISTS distribuce;
DROP TABLE IF EXISTS pivo_hodnoceni;
DROP TABLE IF EXISTS pivovar_hodnoceni;
DROP TABLE IF EXISTS pivo;
DROP TABLE IF EXISTS recept;
DROP TABLE IF EXISTS sladek;
DROP TABLE IF EXISTS ramcova_smlouva;
DROP TABLE IF EXISTS pivovar;
DROP TABLE IF EXISTS surovina;
DROP TABLE IF EXISTS kvasnice;
DROP TABLE IF EXISTS chmel;
DROP TABLE IF EXISTS slad;
DROP TABLE IF EXISTS bezny_uzivatel;
DROP TABLE IF EXISTS vydejni_misto;
DROP TABLE IF EXISTS prodejna;
DROP TABLE IF EXISTS certifikovana_prodejna;
DROP TABLE IF EXISTS hospoda;

CREATE TABLE pivovar(
  id_pivovar INT NOT NULL AUTO_INCREMENT,
  znacka VARCHAR(60) NOT NULL,
  rok_zalozeni INT NOT NULL,

  PRIMARY KEY (id_pivovar)
);

CREATE TABLE pivovar_hodnoceni(
  id_pivovar_hodnoceni INT NOT NULL AUTO_INCREMENT,
  fk_pivovaru INT NOT NULL,
  FOREIGN KEY (fk_pivovaru) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE,
    
  rating INT,
  PRIMARY KEY (id_pivovar_hodnoceni)
);

CREATE TABLE pivo(
  id_pivo INT NOT NULL AUTO_INCREMENT,
  fk_pivovar INT NOT NULL,
  FOREIGN KEY (fk_pivovar) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE,

  nazev VARCHAR(128) NOT NULL,
  barva INT NOT NULL,
  styl_kvaseni VARCHAR(64) NOT NULL,
  typ   VARCHAR(64) NOT NULL,
  obsah_alkoholu INT NOT NULL,
  PRIMARY KEY (id_pivo)
);

CREATE TABLE pivo_hodnoceni(
  id_pivo_hodnoceni INT NOT NULL AUTO_INCREMENT,
  fk_pivo INT NOT NULL,
  FOREIGN KEY (fk_pivo) REFERENCES pivo(id_pivo) ON DELETE CASCADE ON UPDATE CASCADE,
    
  rating INT,
  PRIMARY KEY (id_pivo_hodnoceni)
);

CREATE TABLE surovina(
  id_sur INT NOT NULL AUTO_INCREMENT,
  puvod VARCHAR(128) NOT NULL,

  PRIMARY KEY (id_sur)
);

CREATE TABLE kvasnice(
  id_kvas INT PRIMARY KEY REFERENCES surovina (id_sur) ON DELETE CASCADE ON UPDATE CASCADE,

  skupenstvi VARCHAR(128) NOT NULL,
  druh VARCHAR(128) NOT NULL
);

CREATE TABLE chmel(
  id_chmel INT PRIMARY KEY REFERENCES surovina (id_sur) ON DELETE CASCADE ON UPDATE CASCADE,

  aroma VARCHAR(128) NOT NULL,
  horkost VARCHAR(128) NOT NULL,
  podil_alfa_kyselin INT NOT NULL,
  doba_sklizne VARCHAR(128) NOT NULL
);

CREATE TABLE slad(
  id_slad INT PRIMARY KEY REFERENCES surovina (id_sur) ON DELETE CASCADE ON UPDATE CASCADE,

  barva VARCHAR(64) NOT NULL,
  extrakt INT NOT NULL
);

CREATE TABLE bezny_uzivatel(
  id_uz INT NOT NULL AUTO_INCREMENT,
  login VARCHAR(64) NOT NULL,
  heslo VARCHAR(128) NOT NULL,
  email VARCHAR(128) NOT NULL,
  uspechy VARCHAR(128) NOT NULL,
  vypita_piva INT NOT NULL,

  PRIMARY KEY (id_uz)
);

CREATE TABLE sladek(
  id_sladek INT PRIMARY KEY REFERENCES bezny_uzivatel (id_uz),

  jmeno VARCHAR(128) NOT NULL,
  heslo VARCHAR(128) NOT NULL,
  prijmeni VARCHAR(128) NOT NULL,
  druh VARCHAR(128) NOT NULL,
  diplom VARCHAR(128) NOT NULL,

  zamestnan_v INT,
  FOREIGN KEY (zamestnan_v) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE
  );

CREATE TABLE recept(
  id_recept INT NOT NULL AUTO_INCREMENT,
  fk_sladek INT NOT NULL,
  FOREIGN KEY (fk_sladek) REFERENCES sladek(id_sladek) ON DELETE CASCADE ON UPDATE CASCADE,

  text_receptu VARCHAR(1024) NOT NULL,
  pokus VARCHAR(32) NOT NULL,

   PRIMARY KEY (id_recept)
);

CREATE TABLE distribuce(
  id_distribuce INT NOT NULL AUTO_INCREMENT,
  fk_pivo INT NOT NULL,
  FOREIGN KEY (fk_pivo) REFERENCES pivo(id_pivo) ON DELETE CASCADE ON UPDATE CASCADE,

  forma VARCHAR(128) NOT NULL,

  PRIMARY KEY(id_distribuce)
);

CREATE TABLE vydejni_misto(
  id_mist INT NOT NULL AUTO_INCREMENT,
  jmeno VARCHAR(128) NOT NULL,
  adresa VARCHAR(256) NOT NULL,
  mnozstvi INT NOT NULL,

  PRIMARY KEY (id_mist)
);

CREATE TABLE prodejna(
  id_mist INT PRIMARY KEY REFERENCES bezny_uzivatel (id_uz)
);

CREATE TABLE certifikovana_prodejna(
  id_mist INT PRIMARY KEY REFERENCES bezny_uzivatel (id_uz)
);

CREATE TABLE hospoda(
  id_mist INT PRIMARY KEY REFERENCES bezny_uzivatel (id_uz)
);

CREATE TABLE ramcova_smlouva(
  id_smlouv INT NOT NULL AUTO_INCREMENT,
  sleva VARCHAR(1024) NOT NULL,

  hospoda INT NOT NULL,
  pivovar INT NOT NULL,

  CONSTRAINT primary_smlouv PRIMARY KEY (id_smlouv),
  FOREIGN KEY (hospoda) REFERENCES vydejni_misto(id_mist) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pivovar) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE distribuce_se_dodava_do(
    distribuce INT NOT NULL,
    vydejni_misto INT NOT NULL,

    CONSTRAINT primary_distribuce_se_dodava_do PRIMARY KEY (distribuce, vydejni_misto),

    FOREIGN KEY (distribuce) REFERENCES distribuce(id_distribuce) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (vydejni_misto) REFERENCES vydejni_misto(id_mist) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bezny_uzivatel_ohodnotil_hospodu(
    bezny_uzivatel INT NOT NULL,
    hospoda INT NOT NULL,

     CONSTRAINT primary_bezny_uzivatel_ohodnotil_hospodu PRIMARY KEY (bezny_uzivatel, hospoda),

    FOREIGN KEY (hospoda) REFERENCES hospoda(id_mist) ON DELETE CASCADE ON UPDATE CASCADE, -- WARNING: vydejni misto/hospoda?
    FOREIGN KEY (bezny_uzivatel) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bezny_uzivatel_sleduje_pivovar(

    bezny_uzivatel INT NOT NULL,
    pivovar INT NOT NULL,

     CONSTRAINT primary_bezny_uzivatel_sleduje_pivovar PRIMARY KEY (bezny_uzivatel, pivovar),

    FOREIGN KEY (bezny_uzivatel) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pivovar) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bezny_uzivatel_odebira_pivovar(
    bezny_uzivatel INT NOT NULL,
    pivovar INT NOT NULL,

     CONSTRAINT primary_bezny_uzivatel_odebira_pivovar PRIMARY KEY (bezny_uzivatel, pivovar),

    CONSTRAINT foreign_bezny_uzivatel_odebira_pivovar FOREIGN KEY (bezny_uzivatel) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT foreign_pivovar_odebira_pivovar FOREIGN KEY (pivovar) REFERENCES pivovar(id_pivovar) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE bezny_uzivatel_ohodnotil_pivo(
    bezny_uzivatel INT NOT NULL,
    pivo INT NOT NULL,

    CONSTRAINT primary_bezny_uzivatel_ohodnotil_pivo PRIMARY KEY (bezny_uzivatel, pivo),
    
    CONSTRAINT foreign_bezny_uzivatel_ohodnotil_pivo_uzivatel FOREIGN KEY (bezny_uzivatel) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT foreign_bezny_uzivatel_ohodnotil_pivo FOREIGN KEY (pivo) REFERENCES pivo(id_pivo) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE sladek_pridal_distribuci(
    sladek INT NOT NULL,
    distribuce INT NOT NULL,

    CONSTRAINT primary_sladek_distr PRIMARY KEY (sladek, distribuce),

    CONSTRAINT foreign_sladek_prid FOREIGN KEY (sladek) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT foreign_distribuce_pridal FOREIGN KEY (distribuce) REFERENCES distribuce(id_distribuce) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE sladek_uvaril_pivo(
    sladek INT NOT NULL,
    pivo INT NOT NULL,

    CONSTRAINT primary_sladek_uvaril_pivo PRIMARY KEY (sladek, pivo),

    CONSTRAINT uvaril_pivo FOREIGN KEY (pivo) REFERENCES pivo(id_pivo) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT sladek_uvaril FOREIGN KEY (sladek) REFERENCES bezny_uzivatel(id_uz) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE surovina_pochazi_z(
    certif_prodejna INT NOT NULL,
    surovina INT NOT NULL,

    CONSTRAINT primary_surovina_pochazi_z PRIMARY KEY (certif_prodejna, surovina),

    CONSTRAINT pochazi_z_prodejna FOREIGN KEY (certif_prodejna) REFERENCES certifikovana_prodejna(id_mist) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT pochazi_z_surovina FOREIGN KEY (surovina) REFERENCES surovina(id_sur) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pivo_je_uvareno_z(
    pivo INT NOT NULL,
    surovina INT NOT NULL,

    CONSTRAINT primary_pivo_je_uvareno_z PRIMARY KEY (pivo, surovina),

    CONSTRAINT je_uvareno_pivo FOREIGN KEY (pivo) REFERENCES pivo(id_pivo) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT je_uvareno_surovina FOREIGN KEY (surovina) REFERENCES surovina(id_sur) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO pivovar VALUES(NULL, 'Plzensky prazdroj', 1842);
INSERT INTO pivovar VALUES(NULL, 'Pivovar Jelinkova Vila', 2003);
INSERT INTO pivovar VALUES(NULL, 'Pivovar Velke Brezno', 2003);
INSERT INTO pivovar VALUES(NULL, 'Balonovy pivovar Radesin', 2003);
INSERT INTO pivovar VALUES(NULL, 'Staropramen', 1871);
INSERT INTO pivovar VALUES(NULL, 'Beroun', 1998);
INSERT INTO pivovar VALUES(NULL, 'Beneöov', 1897);
INSERT INTO pivovar VALUES(NULL, 'B¯eznice', 1506);
INSERT INTO pivovar VALUES(NULL, 'K·cov', 1842);
INSERT INTO pivovar VALUES(NULL, 'Kl·öter', 1967);
INSERT INTO pivovar VALUES(NULL, 'Kruöovice', 1517);
INSERT INTO pivovar VALUES(NULL, 'Kutn· Hora', 1573);
INSERT INTO pivovar VALUES(NULL, 'Nymburk', 1895);
INSERT INTO pivovar VALUES(NULL, 'Podkov·Ú', 1434);
INSERT INTO pivovar VALUES(NULL, 'RakovnÌk', 1453);
INSERT INTO pivovar VALUES(NULL, '⁄nÏtice', 1857);
INSERT INTO pivovar VALUES(NULL, 'VelkÈ Popovice', 1842);
INSERT INTO pivovar VALUES(NULL, 'Vysok˝ Chlumec', 2003);
INSERT INTO pivovar VALUES(NULL, 'Oliv˘v Pivovar', 2003);
INSERT INTO pivovar VALUES(NULL, '»eskÈ BudÏjovice - Budvar', 1842);
INSERT INTO pivovar VALUES(NULL, '»eskÈ BudÏjovice - mÏöùansk˝', 2003);
INSERT INTO pivovar VALUES(NULL, 'ProtivÌn', 2003);
INSERT INTO pivovar VALUES(NULL, 'Strakonice', 2003);
INSERT INTO pivovar VALUES(NULL, 'T¯eboÚ', 1842);
INSERT INTO pivovar VALUES(NULL, 'Chodov· Plan·', 1842);
INSERT INTO pivovar VALUES(NULL, 'Kout na äumavÏ', 2003);
INSERT INTO pivovar VALUES(NULL, 'Gambrinus PlzeÚ', 2003);
INSERT INTO pivovar VALUES(NULL, 'MÏöùansk˝ pivovar PlzeÚ', 2003);
INSERT INTO pivovar VALUES(NULL, 'Ch¯ÌË', 1842);
INSERT INTO pivovar VALUES(NULL, 'Chodov· Plan·', 1842);
INSERT INTO pivovar VALUES(NULL, 'Kout na äumavÏ', 2003);
INSERT INTO pivovar VALUES(NULL, 'Gambrinus PlzeÚ', 2003);
INSERT INTO pivovar VALUES(NULL, 'MÏöùansk˝ pivovar PlzeÚ', 2003);
INSERT INTO pivovar VALUES(NULL, 'Ch¯ÌË', 1842);

INSERT INTO pivo VALUES(NULL, 3, 'Pilsner Urquell', 8, 'spodne', 'Svetly lezak', 5.1);
INSERT INTO pivo VALUES(NULL, 2,'Harach - Svetly lezak original ', 14.5, 'spodne', 'Svetly lezak', 5.2);

INSERT INTO distribuce VALUES(NULL, 2, 'Becka 50l');
INSERT INTO distribuce VALUES(NULL, 1, 'Nepitelny patok');

INSERT INTO bezny_uzivatel VALUES(NULL, 'uzivatel','heslo', 'lukas@email.cz', 'level: Brouk Pytlik', 27);
INSERT INTO sladek VALUES(1, 'sladek','heslo','Nedovaril', 'Amater', 'Nejhorsi pivo roku.', 1);