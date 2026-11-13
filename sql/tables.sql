
-- Création du type CATEGORIE pour le vol
CREATE TYPE CATEGORIE AS ENUM ('1ERE', 'BUSINESS', 'ECONOMIE');

-- Création de la table adresse
CREATE TABLE adresse (
    id_adr SERIAL PRIMARY KEY,
    numero_adr INTEGER NOT NULL CHECK (numero_adr > 0),
    nom_adr VARCHAR(100) NOT NULL,
    code_postal CHAR(5) NOT NULL CHECK (code_postal ~ '^[0-9]{5}$'),
    ville_adr VARCHAR(50) NOT NULL,
    pays_adr VARCHAR(50) NOT NULL
);

-- Création de la table aeroport
CREATE TABLE aeroport (
    id_aero SERIAL PRIMARY KEY,
    nom_aero VARCHAR(100) NOT NULL,
    code_iata CHAR(3) NOT NULL UNIQUE CHECK (code_iata ~ '^[A-Z]{3}$'),
    id_adr INTEGER NOT NULL,
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);

-- Création de la table compagnie
CREATE TABLE compagnie (
    id_comp SERIAL PRIMARY KEY,
    nom_comp VARCHAR(50) NOT NULL,
    code_iata CHAR(2) NOT NULL UNIQUE CHECK (code_iata ~ '^[A-Z0-9]{2}$'),
    telephone_comp CHAR(10) NOT NULL CHECK (telephone_comp ~ '^0[0-9]{9}$'),
    id_adr INTEGER NOT NULL,
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);

-- Création de la table personne
CREATE TABLE personne (
    id_pers SERIAL PRIMARY KEY,
    nom_pers VARCHAR(30) NOT NULL,
    prenom_pers VARCHAR(50) NOT NULL,
    telephone_pers CHAR(10) NOT NULL CHECK (telephone_pers ~ '^0[0-9]{9}$'),
    date_naissance DATE NOT NULL,
    email_pers VARCHAR(200) NOT NULL,
    id_adr INTEGER NOT NULL,
    FOREIGN KEY (id_adr) REFERENCES adresse(id_adr)
);

-- Création de la table passager
CREATE TABLE passager (
    id_pers INTEGER PRIMARY KEY,
    numero_passeport VARCHAR(20) NOT NULL UNIQUE CHECK (numero_passeport ~ '^[A-Z0-9]+$'),
    nationalite_passager VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_pers) REFERENCES personne(id_pers)
);

-- Création de la table personnel
CREATE TABLE personnel (
    id_pers INTEGER PRIMARY KEY,
    role_personnel VARCHAR(50) NOT NULL,
    matricule_personnel VARCHAR(20) NOT NULL UNIQUE CHECK (matricule_personnel ~ '^[A-Za-z0-9]+$'),
    statut_personnel BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (id_pers) REFERENCES personne(id_pers)
);

-- Création de la table avion
CREATE TABLE avion (
    id_avion SERIAL PRIMARY KEY,
    immatriculation VARCHAR(10) NOT NULL UNIQUE CHECK (immatriculation ~ '^[A-Z0-9-]+$'),
    modele VARCHAR(100) NOT NULL,
    capacite_max INTEGER NOT NULL CHECK (capacite_max > 0),
    id_comp INTEGER NOT NULL,
    FOREIGN KEY (id_comp) REFERENCES compagnie(id_comp)
);

-- Création de la table vol
CREATE TABLE vol (
    id_vol SERIAL PRIMARY KEY,
    numero_vol VARCHAR(20) NOT NULL CHECK (numero_vol ~ '^[A-Z0-9]+$'),
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    heure_embarquement TIME NOT NULL CHECK (heure_embarquement < heure_depart),
    id_aero_depart INTEGER NOT NULL,
    id_aero_arrive INTEGER NOT NULL,
    id_avion INTEGER NOT NULL,
    UNIQUE (numero_vol, date_depart, heure_depart),
    FOREIGN KEY (id_aero_depart) REFERENCES aeroport(id_aero),
    FOREIGN KEY (id_aero_arrive) REFERENCES aeroport(id_aero),
    FOREIGN KEY (id_avion) REFERENCES avion(id_avion)
);

-- Création de la table billet
CREATE TABLE billet (
    id_billet SERIAL PRIMARY KEY,
    numero_siege VARCHAR(3) NOT NULL,
    categorie CATEGORIE NOT NULL,
    porte VARCHAR(5) NOT NULL,
    id_pers INTEGER NOT NULL,
    id_vol INTEGER NOT NULL,
    UNIQUE (numero_siege, id_vol),
    FOREIGN KEY (id_pers) REFERENCES passager(id_pers),
    FOREIGN KEY (id_vol) REFERENCES vol(id_vol)
);

-- Création de la table scanner
CREATE TABLE scanner (
    id_scan SERIAL PRIMARY KEY,
    modele VARCHAR(20) NOT NULL,
    adresse_ip INET NOT NULL UNIQUE
);

-- Création de la table identifie
CREATE TABLE identifie (
    id_scan INTEGER NOT NULL,
    id_billet INTEGER NOT NULL,
    PRIMARY KEY (id_scan, id_billet),
    FOREIGN KEY (id_scan) REFERENCES scanner(id_scan),
    FOREIGN KEY (id_billet) REFERENCES billet(id_billet)
);

-- Création de la table utilise
CREATE TABLE utilise (
    id_scan INTEGER NOT NULL,
    id_pers INTEGER NOT NULL,
    PRIMARY KEY (id_scan, id_pers),
    FOREIGN KEY (id_scan) REFERENCES scanner(id_scan),
    FOREIGN KEY (id_pers) REFERENCES personnel(id_pers)
);