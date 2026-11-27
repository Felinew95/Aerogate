
-- Définition du type CATEGORIE

CREATE TYPE CATEGORIE AS ENUM ('1ERE', 'BUSINESS', 'ECONOMIE');


-- Table ADRESSE

CREATE TABLE adresse (
    id_adr INTEGER,
    numero_adr INTEGER NOT NULL,
    nom_adr VARCHAR(100) NOT NULL,
    code_postal CHAR(5) NOT NULL,
    ville_adr VARCHAR(50) NOT NULL,
    pays_adr VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_adr),
    CHECK (numero_adr > 0),
    CHECK (TRIM(nom_adr) <> ''),
    CHECK (code_postal ~ '^[0-9]{5}$'),
    CHECK (TRIM(ville_adr) <> ''),
    CHECK (TRIM(pays_adr) <> '')
);


-- Table AEROPORT

CREATE TABLE aeroport (
    id_aero INTEGER,
    nom_aero VARCHAR(100) NOT NULL,
    code_iata CHAR(3) NOT NULL,
    id_adr INTEGER NOT NULL,

    PRIMARY KEY (id_aero),
    UNIQUE (code_iata),
    CHECK (TRIM(nom_aero) <> ''),
    CHECK (code_iata ~ '^[A-Z]{3}$'),
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);


--  Table COMPAGNIE

CREATE TABLE compagnie (
    id_comp INTEGER,
    nom_comp VARCHAR(50) NOT NULL,
    code_iata CHAR(2) NOT NULL,
    telephone_comp CHAR(10) NOT NULL,
    id_adr INTEGER NOT NULL,

    PRIMARY KEY (id_comp),
    UNIQUE (code_iata),
    CHECK (TRIM(nom_comp) <> ''),
    CHECK (code_iata ~ '^[A-Z0-9]{2}$'),
    CHECK (telephone_comp ~ '^0[0-9]{9}$'),
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);


-- Table PERSONNE

CREATE TABLE personne (
    id_pers INTEGER,
    nom_pers VARCHAR(30) NOT NULL,
    prenom_pers VARCHAR(50) NOT NULL,
    telephone_pers CHAR(10) NOT NULL,
    date_naissance DATE NOT NULL,
    email_pers VARCHAR(200) NOT NULL,
    id_adr INTEGER NOT NULL,

    PRIMARY KEY (id_pers),
    CHECK (TRIM(nom_pers) <> ''),
    CHECK (TRIM(prenom_pers) <> ''),
    CHECK (telephone_pers ~ '^0[0-9]{9}$'),
    CHECK (date_naissance <= CURRENT_DATE),
    CHECK (email_pers LIKE '%_@_%._%'),
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);


--  Table PASSAGER

CREATE TABLE passager (
    id_pers INTEGER,
    numero_passeport VARCHAR(20) NOT NULL,
    nationalite_passager VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_pers),
    UNIQUE (numero_passeport),
    CHECK (numero_passeport ~ '^[A-Z0-9]+$'),
    CHECK (TRIM(nationalite_passager) <> ''),
    FOREIGN KEY (id_pers) REFERENCES personne(id_pers)
);


--  Table PERSONNEL

CREATE TABLE personnel (
    id_pers INTEGER,
    role_personnel VARCHAR(50) NOT NULL,
    matricule_personnel VARCHAR(20) NOT NULL,
    statut_personnel BOOLEAN NOT NULL DEFAULT TRUE,

    PRIMARY KEY (id_pers),
    UNIQUE (matricule_personnel),
    CHECK (TRIM(role_personnel) <> ''),
    CHECK (matricule_personnel ~ '^[A-Za-z0-9]+$'),
    FOREIGN KEY (id_pers) REFERENCES personne(id_pers)
);


--  Table AVION

CREATE TABLE avion (
    id_avion INTEGER,
    immatriculation VARCHAR(10) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    capacite_max INTEGER NOT NULL,
    id_comp INTEGER NOT NULL,

    PRIMARY KEY (id_avion),
    UNIQUE (immatriculation),
    CHECK (immatriculation ~ '^[A-Z0-9-]+$'),
    CHECK (TRIM(modele) <> ''),
    CHECK (capacite_max > 0),
    FOREIGN KEY (id_comp) REFERENCES compagnie(id_comp)
);


-- 8. Table vol

CREATE TABLE vol (
    id_vol INTEGER,
    numero_vol VARCHAR(20) NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    heure_embarquement TIME NOT NULL,
    id_aero_depart INTEGER NOT NULL,
    id_aero_arrive INTEGER NOT NULL,
    id_avion INTEGER NOT NULL,

    PRIMARY KEY (id_vol),
    UNIQUE (numero_vol, date_depart, heure_depart),
    CHECK (numero_vol ~ '^[A-Z0-9]+$'),
    CHECK (heure_embarquement < heure_depart),
    FOREIGN KEY (id_aero_depart) REFERENCES aeroport(id_aero),
    FOREIGN KEY (id_aero_arrive) REFERENCES aeroport(id_aero),
    FOREIGN KEY (id_avion) REFERENCES avion(id_avion)
);


--  Table BILLET

CREATE TABLE billet (
    id_billet INTEGER,
    numero_siege VARCHAR(3) NOT NULL,
    categorie CATEGORIE NOT NULL,
    porte VARCHAR(5) NOT NULL,
    id_pers INTEGER NOT NULL,
    id_vol INTEGER NOT NULL,

    PRIMARY KEY (id_billet),
    UNIQUE (numero_siege, id_vol),
    CHECK (numero_siege ~ '^[0-9]{1,2}[A-Z]$'),
    CHECK (porte ~ '^[A-Z0-9]{1,5}$'),
    FOREIGN KEY (id_pers) REFERENCES passager(id_pers),
    FOREIGN KEY (id_vol) REFERENCES vol(id_vol)
);


--  Table SCANNER

CREATE TABLE scanner (
    id_scan INTEGER,
    modele VARCHAR(20) NOT NULL,
    adresse_ip INET NOT NULL,
    porte VARCHAR(5) NOT NULL,

    PRIMARY KEY (id_scan),
    UNIQUE (adresse_ip),
    CHECK (TRIM(modele) <> ''),
    CHECK (porte ~ '^[A-Z0-9]{1,5}$')
);


--  Table IDENTIFIE

CREATE TABLE identifie (
    id_scan INTEGER NOT NULL,
    id_billet INTEGER NOT NULL,

    PRIMARY KEY (id_scan, id_billet),
    FOREIGN KEY (id_scan) REFERENCES scanner(id_scan),
    FOREIGN KEY (id_billet) REFERENCES billet(id_billet)
);


--  Table UTILISE

CREATE TABLE utilise (
    id_scan INTEGER NOT NULL,
    id_pers INTEGER NOT NULL,

    PRIMARY KEY (id_scan, id_pers),
    FOREIGN KEY (id_scan) REFERENCES scanner(id_scan),
    FOREIGN KEY (id_pers) REFERENCES personnel(id_pers)
);
