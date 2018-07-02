DROP DATABASE MatchLove;
CREATE DATABASE MatchLove;
USE MatchLove;

CREATE TABLE Membre (
    IdMembre INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(70),
    Prenom VARCHAR(70),
    Pseudo VARCHAR(70),
    DateNaissance DATE,
    PhotoProfil VARCHAR(50),
    Sexe CHAR(1),
    Email VARCHAR(70),
    MotDePasse VARCHAR(70),
    DateInscription DATETIME,
    NbreVue INT
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Photo (
    IdPhoto INT PRIMARY KEY AUTO_INCREMENT,
    IdMembre INT,
    NomPhoto VARCHAR(50),
    FOREIGN KEY (IdMembre) REFERENCES Membre(IdMembre)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Question (
    Question VARCHAR(300),
    choix1 VARCHAR(100),
    choix2 VARCHAR(100),
    choix3 VARCHAR(100),
    choix4 VARCHAR(100)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Message (
    IdMessage INT PRIMARY KEY AUTO_INCREMENT,
    IdDestinateur INT,
    IdDestinataire INT,
    Message VARCHAR(10000),
    TempsEnvoi DATETIME,
    FOREIGN KEY (IdDestinateur) REFERENCES Membre(IdMembre),
    FOREIGN KEY (IdDestinataire) REFERENCES Membre(IdMembre)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 'IdMembre','Nom','Prenom','Pseudo','DateNaissance','PhotoProfil','Sexe','Email','mdp','dateInscription','nbreVue';

INSERT INTO Membre VALUES(NULL,'Jean','Richard','Mesi','1999-10-02','photo','m','jean.richard@gmail.com',SHA1('Jean'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Paul','Mathieu','Bengl','1998-11-04','photo','m','paul.mathieu@gmail.com',SHA1('Paul'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'David','Arthure','Faraon','1997-12-06','photo','m','david.arthure@gmail.com',SHA1('Arthure'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Pierre','Christian','flyie','1996-11-08','photo','m','pierre.christian@gmail.com',SHA1('Pierre'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Kerim','Sebastien','chinis','1995-10-27','photo','m','kerim.sebastien@hotmail.com',SHA1('Kerim'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Michael','John','Mim','1994-09-25','photo','m','michael.john@hotmail.com',SHA1('Michael'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Louis','Lee','Bouboul','1993-08-23','photo','m','louis.lee@hotmail.com',SHA1('Louis'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Dominic','Brandon','Titan','1992-07-21','photo','m','dominic.brandon@yahoo.fr',SHA1('Dominic'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Steeve','Cali','Beckett','1991-06-19','photo','m','steeve.cali@yahoo.fr',SHA1('Steeve'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Rosh','Timothe','Einstein','1990-05-17','photo','m','rosh.timothe@yahoo.fr',SHA1('Rosh'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Rak','Raoul','Kanu','1988-04-15','photo','m','rak.raoul@yopmail.com',SHA1('Rak'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Simon','Albert','papell','1986-03-13','photo','m','simon.albert@yopmail.com',SHA1('Simon'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Billy','Leonard','jagoo','1984-02-11','photo','m','billy.leonard@sfr.fr',SHA1('Billy'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Valverde','Moustafah','Cucus','1982-01-5','photo','m','valverde.moustafah@sfr.fr',SHA1('Valverde'),NOW(),0);

INSERT INTO Membre VALUES(NULL,'Carol','Kim','Mocades','1999-10-12','photo','f','carol.kim@gmail.com',SHA1('Carol'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Perri','Lucie','Junior','1998-11-29','photo','f','perri.lucie@gmail.com',SHA1('Perri'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Lara','Isabelle','Kayrah','1997-12-16','photo','f','lara.isabelle@gmail.com',SHA1('Lara'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Ebenine','Alisone','Mimie','1996-11-04','photo','f','ebenine.alisone@gmail.com',SHA1('Ebenine'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Cristelle','Maria','Angel','1995-10-02','photo','f','cristelle.maria@hotmail.com',SHA1('Cristelle'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Murielle','Christina','Calysta','1994-09-24','photo','f','murielle.christina@hotmail.com',SHA1('Murielle'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Anny','Jasmine','Flatoune','1993-08-14','photo','f','anny.jasmine@hotmail.com',SHA1('Anny'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Laureane','Aisha','Minouo','1992-07-18','photo','f','laureane.aisha@yahoo.fr',SHA1('Laureane'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Sylvie','Natacha','Imiscus','1991-06-15','photo','f','sylvie.natacha@yahoo.fr',SHA1('Sylvie'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Louisette','Megane','Clementine','1990-05-10','photo','f','louisette.megane@yahoo.fr',SHA1('Louisette'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Juliette','Celena','Jessica','1988-04-05','photo','f','juliette.celena@yopmail.com',SHA1('Juliette'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Karen','Sharon','Warious','1986-03-30','photo','f','karen.celena@yopmail.com',SHA1('Karen'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Sam','Sia','sphanx','1984-02-25','photo','f','sam.sia@sfr.fr',SHA1('Sam'),NOW(),0);
INSERT INTO Membre VALUES(NULL,'Dean','Linda','Dadilove','1982-01-20','photo','f','dean.linda@sfr.fr',SHA1('Dean'),NOW(),0);
