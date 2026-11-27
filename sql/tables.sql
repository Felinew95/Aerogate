-- Création du type CATEGORIE pour le vol
CREATE TYPE CATEGORIE AS ENUM ('1ERE', 'BUSINESS', 'ECONOMIE');

-- Création de la table adresse
CREATE TABLE adresse (
    id_adr SERIAL PRIMARY KEY,
    numero_adr INTEGER NOT NULL CHECK (numero_adr > 0),
    nom_adr VARCHAR(100) NOT NULL CHECK (nom_adr ~ '^[A-Za-zÀ-ÿ0-9 .''-]{2,100}$'),
    code_postal CHAR(5) NOT NULL CHECK (code_postal ~ '^[0-9]{5}$'),
    ville_adr VARCHAR(50) NOT NULL CHECK (ville_adr ~ '^[A-Za-zÀ-ÿ .''-]{2,50}$'),
    pays_adr VARCHAR(50) NOT NULL CHECK (pays_adr ~ '^[A-Za-zÀ-ÿ .''-]{2,50}$')
);

-- Création de la table aeroport
CREATE TABLE aeroport (
    id_aero SERIAL PRIMARY KEY,
    nom_aero VARCHAR(100) NOT NULL CHECK (nom_aero ~ '^[A-Za-zÀ-ÿ .''-]{2,100}$'),
    code_iata CHAR(3) NOT NULL UNIQUE CHECK (code_iata ~ '^[A-Z]{3}$'),
    id_adr INTEGER NOT NULL REFERENCES adresse(id_adr)
);

-- Création de la table compagnie
CREATE TABLE compagnie (
    id_comp SERIAL PRIMARY KEY,
    nom_comp VARCHAR(50) NOT NULL CHECK (nom_comp ~ '^[A-Za-zÀ-ÿ0-9 .''&-]{2,50}$'),
    code_iata CHAR(2) NOT NULL UNIQUE CHECK (code_iata ~ '^[A-Z0-9]{2}$'),
    telephone_comp CHAR(10) NOT NULL CHECK (telephone_comp ~ '^0[0-9]{9}$'),
    id_adr INTEGER NOT NULL REFERENCES adresse(id_adr)
);

-- Création de la table personne
CREATE TABLE personne (
    id_pers SERIAL PRIMARY KEY,
    nom_pers VARCHAR(30) NOT NULL CHECK (nom_pers ~ '^[A-Za-zÀ-ÿ .''-]{2,30}$'),
    prenom_pers VARCHAR(50) NOT NULL CHECK (prenom_pers ~ '^[A-Za-zÀ-ÿ .''-]{2,50}$'),
    telephone_pers CHAR(10) NOT NULL CHECK (telephone_pers ~ '^0[0-9]{9}$'),
    date_naissance DATE NOT NULL CHECK (date_naissance <= CURRENT_DATE),
    email_pers VARCHAR(200) NOT NULL CHECK (email_pers ~ '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'),
    id_adr INTEGER NOT NULL REFERENCES adresse(id_adr)
);

-- Création de la table passager
CREATE TABLE passager (
    id_pers INTEGER PRIMARY KEY REFERENCES personne(id_pers),
    numero_passeport VARCHAR(20) NOT NULL UNIQUE CHECK (numero_passeport ~ '^[A-Z0-9]+$'),
    nationalite_passager VARCHAR(50) NOT NULL CHECK (nationalite_passager ~ '^[A-Za-zÀ-ÿ -]{2,50}$')
);

-- Création de la table personnel
CREATE TABLE personnel (
    id_pers INTEGER PRIMARY KEY REFERENCES personne(id_pers),
    role_personnel VARCHAR(50) NOT NULL CHECK (role_personnel ~ '^[A-Za-zÀ-ÿ -]{2,50}$'),
    matricule_personnel VARCHAR(20) NOT NULL UNIQUE CHECK (matricule_personnel ~ '^[A-Za-z0-9]+$'),
    statut_personnel BOOLEAN NOT NULL DEFAULT TRUE
);

-- Création de la table avion
CREATE TABLE avion (
    id_avion SERIAL PRIMARY KEY,
    immatriculation VARCHAR(10) NOT NULL UNIQUE CHECK (immatriculation ~ '^[A-Z0-9-]+$'),
    modele VARCHAR(100) NOT NULL CHECK (modele ~ '^[A-Za-z0-9 .-]{2,100}$'),
    capacite_max INTEGER NOT NULL CHECK (capacite_max > 0),
    id_comp INTEGER NOT NULL REFERENCES compagnie(id_comp)
);

-- Création de la table vol
CREATE TABLE vol (
    id_vol SERIAL PRIMARY KEY,
    numero_vol VARCHAR(20) NOT NULL CHECK (numero_vol ~ '^[A-Z0-9]+$'),
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    heure_embarquement TIME NOT NULL CHECK (heure_embarquement < heure_depart),
    id_aero_depart INTEGER NOT NULL REFERENCES aeroport(id_aero),
    id_aero_arrive INTEGER NOT NULL REFERENCES aeroport(id_aero),
    id_avion INTEGER NOT NULL REFERENCES avion(id_avion),
    UNIQUE (numero_vol, date_depart, heure_depart)
);

-- Création de la table billet
CREATE TABLE billet (
    id_billet SERIAL PRIMARY KEY,
    numero_siege VARCHAR(3) NOT NULL CHECK (numero_siege ~ '^[0-9]{1,2}[A-Z]$'),
    categorie CATEGORIE NOT NULL,
    porte VARCHAR(5) NOT NULL CHECK (porte ~ '^[A-Z0-9]{1,5}$'),
    id_pers INTEGER NOT NULL REFERENCES passager(id_pers),
    id_vol INTEGER NOT NULL REFERENCES vol(id_vol),
    UNIQUE (numero_siege, id_vol)
);

-- Création de la table scanner
CREATE TABLE scanner (
    id_scan SERIAL PRIMARY KEY,
    modele VARCHAR(20) NOT NULL CHECK (modele ~ '^[A-Za-z0-9 _-]{2,20}$'),
    adresse_ip INET NOT NULL UNIQUE,
    porte VARCHAR(5) NOT NULL CHECK (porte ~ '^[A-Z0-9]{1,5}$')
);

-- Création de la table identifie
CREATE TABLE identifie (
    id_scan INTEGER NOT NULL REFERENCES scanner(id_scan),
    id_billet INTEGER NOT NULL REFERENCES billet(id_billet),
    PRIMARY KEY (id_scan, id_billet)
);

-- Création de la table utilise
CREATE TABLE utilise (
    id_scan INTEGER NOT NULL REFERENCES scanner(id_scan),
    id_pers INTEGER NOT NULL REFERENCES personnel(id_pers),
    PRIMARY KEY (id_scan, id_pers)
);
