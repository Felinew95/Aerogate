<?php
declare(strict_types=1);

/**
 * requetes.inc.php - Module de centralisation des requêtes SQL
 *
 * Ce module regroupe les requêtes SQL utilisées pour récupérer
 * les informations relatives aux vols, avions, compagnies,
 * adresses et aéroports.
 *
 * @author Alexandre BURIN
 * @version 1.0.0
 */

/**
 * Récupération de tous les vols
 * @var string Requête SQL pour récupérer tous les vols
 */
const REQUETE_GET_VOLS = "
    SELECT * FROM vol
";

/**
 * Récupération de l'avion associé à un vol
 * @var string Requête SQL pour récupérer l'avion associé à un vol
 */
const REQUETE_GET_AVION_BY_ID_VOL = "
    SELECT 
        a.id_avion, 
        a.immatriculation, 
        a.modele, 
        a.capacite_max
    FROM vol AS v
    JOIN avion AS a ON v.id_avion = a.id_avion
    WHERE v.id_vol = :id
";

/**
 * Récupération de la compagnie associée à un avion
 * @var string Requête SQL pour récupérer la compagnie associée à un avion
 */
const REQUETE_GET_COMPAGNIE_BY_ID_AVION = "
    SELECT 
        c.id_comp, 
        c.nom_comp, 
        c.code_iata, 
        c.telephone_comp,
        c.id_adr
    FROM avion AS a
    JOIN compagnie AS c ON a.id_comp = c.id_comp
    WHERE a.id_avion = :id
";

/**
 * Récupération de l'adresse d'une compagnie
 * @var string Requête SQL pour récupérer l'adresse d'une compagnie
 */
const REQUETE_GET_ADRESSE_COMPAGNIE_BY_ID_COMP = "
    SELECT 
        a.numero_adr, 
        a.nom_adr, 
        a.code_postal, 
        a.ville_adr, 
        a.pays_adr
    FROM compagnie AS c
    JOIN adresse AS a ON c.id_adr = a.id_adr
    WHERE c.id_comp = :id
";


/**
 * Récupération de l'adresse d'un aéroport
 * @var string Requête SQL pour récupérer l'adresse d'un aéroport
 */
const REQUETE_GET_ADRESSE_AEROPORT_BY_ID_AERO = "
    SELECT  
        adr.numero_adr, 
        adr.nom_adr, 
        adr.code_postal, 
        adr.ville_adr, 
        adr.pays_adr
    FROM aeroport AS aero
    JOIN adresse AS adr ON aero.id_adr = adr.id_adr
    WHERE aero.id_aero = :id
";

/**
 * Récupération des aéroports de départ et d'arrivée d'un vol
 * @var string Requête SQL pour récupérer les aéroports de départ et d'arrivée d'un vol
 */
const REQUETE_GET_AEROPORTS_VOL_BY_ID = "
    SELECT
        aero_dep.id_aero AS id_aero_dep,
        aero_dep.nom_aero AS nom_aero_dep,
        aero_dep.code_iata AS code_iata_dep,
        aero_arr.id_aero AS id_aero_arr,
        aero_arr.nom_aero AS nom_aero_arr,
        aero_arr.code_iata AS code_iata_arr
    FROM vol AS v
    JOIN aeroport AS aero_dep ON v.id_aero_depart = aero_dep.id_aero
    JOIN aeroport AS aero_arr ON v.id_aero_arrive = aero_arr.id_aero
    WHERE v.id_vol = :id
";

/**
 * Récupération des personnes associées à un vol
 * @var string Requête SQL pour récupérer les personnes associées à un vol
 */
const REQUETE_GET_PERSONNES_BY_ID_VOL = "
    SELECT
        b.numero_siege,
        b.categorie,
        b.porte,
        per.id_pers,
        per.nom_pers,
        per.prenom_pers,
        per.date_naissance,
        per.telephone_pers,
        per.email_pers,
        per.id_adr,
        pas.numero_passeport,
        pas.nationalite_passager
    FROM vol AS v
    JOIN billet AS b ON v.id_vol = b.id_vol
    JOIN passager AS pas ON b.id_pers = pas.id_pers
    JOIN personne AS per ON pas.id_pers = per.id_pers
    WHERE v.id_vol = :id
";

/**
 * Récupération des scanners
 * @var string Requête SQL pour récupérer les scanners
 */
const REQUETE_GET_SCANNERS = "
    SELECT modele, adresse_ip, porte FROM scanner
";

/**
 * Récupération de l'adresse d'une personne
 * @var string Requête SQL pour récupérer l'adresse d'une personne
 */
const REQUETE_GET_ADRESSE_PERSONNE_BY_ID_PERS = "
    SELECT
        adr.numero_adr,
        adr.nom_adr,
        adr.code_postal,
        adr.ville_adr,
        adr.pays_adr
    FROM personne AS per
    JOIN adresse AS adr ON per.id_adr = adr.id_adr
    WHERE per.id_pers = :id
";

/**
 * Récupération des personnels
 * @var string Requête SQL pour récupérer les personnels
 */
const REQUETE_GET_PERSONNELS = "
    SELECT 
        p.id_pers,
        p.nom_pers,
        p.prenom_pers,
        p.date_naissance,
        p.telephone_pers,
        p.email_pers,
        p.id_adr,
        per.role_personnel,
        per.matricule_personnel,
        per.statut_personnel
    FROM personne AS p
    JOIN personnel AS per ON p.id_pers = per.id_pers;
";

/**
 * Récupération des scanners par ID du personnel
 * @var string Requête SQL pour récupérer les scanners par ID du personnel
 */
const REQUETE_GET_SCANNERS_BY_ID_PERSONNEL = "
    SELECT 
        s.modele,
        s.adresse_ip,
        s.porte
    FROM scanner AS s 
    JOIN utilise AS u ON u.id_scan = s.id_scan
    JOIN personnel AS p ON u.id_pers = p.id_pers
    WHERE p.id_pers = :id
";
