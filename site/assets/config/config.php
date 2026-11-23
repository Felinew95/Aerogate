<?php
declare(strict_types=1);

/**
 * config.php - Fichier de configuration du projet
 * 
 * Ce fichier contient les constantes utilisées dans le projet.
 * Elle est utilisé pour les différentes pages et fonctions.
 * 
 * @author Alexandre BURIN
 * @version 1.0.0
 */

/**
 * Constante contenant le chemin vers le fichier d'environnement.
 * @var string Chemin vers le fichier d'environnement
 */
const FICHIER_ENV = '.env';

/**
 * Constante contenant le fuseau horaire par défaut.
 * @var string Fuseau horaire par défaut
 */
const ZONE_HORAIRE = 'Europe/Paris';

/**
 * Constante contenant les tables valides 
 * pour les requêtes SQL.
 * 
 * @var array Tableaux des tables valides
 */
const TABLES_VALIDES = ["compagnie", "aeroport", "personne", "personnel"];

/**
 * Constante contenant les cartes des informations importantes
 * affichées sur le tableau de bord.
 * 
 * Une constante ne peut pas appeler de fonction : "valeur" contient
 * donc le nom de la fonction à appeler et son argument
 * (null pour les fonctions qui utilisent les vols ou les personnels de la page).
 * 
 * @var array Tableau des informations importantes
 */
const TABLEAU_INFORMATIONS_IMPORTANTES = [
    "Vol" => [
        "titre" => "Nombre de vols aujourd'hui",
        "valeur" => [
            "fonction" => "getVolsAujourdhui",
            "argument" => null
        ],
        "icone" => "fa-plane",
        "sous-titre" => "Vols programmés aujourd'hui"
    ],

    "Personnel" => [
        "titre" => "Personnels actifs",
        "valeur" => [
            "fonction" => "getPersonnelsActifs",
            "argument" => null
        ],
        "icone" => "fa-users",
        "sous-titre" => "Nombre de personnels actifs"
    ],

    "Billet" => [
        "titre" => "Billets",
        "valeur" => [
            "fonction" => "getNbEltsTable",
            "argument" => "billet"
        ],
        "icone" => "fa-ticket",
        "sous-titre" => "Billets enregistrés"
    ],

    "Avion" => [
        "titre" => "Avions",
        "valeur" => [
            "fonction" => "getNbEltsTable",
            "argument" => "avion"
        ],
        "icone" => "fa-plane",
        "sous-titre" => "Avions enregistrés"
    ],

    "Compagnie" => [
        "titre" => "Compagnies",
        "valeur" => [
            "fonction" => "getNbEltsTable",
            "argument" => "compagnie"
        ],
        "icone" => "fa-building",
        "sous-titre" => "Compagnies aériennes"
    ],

    "Aeroport" => [
        "titre" => "Aéroports",
        "valeur" => [
            "fonction" => "getNbEltsTable",
            "argument" => "aeroport"
        ],
        "icone" => "fa-plane-departure",
        "sous-titre" => "Aéroports enregistrés"
    ],

    "Scanner" => [
        "titre" => "Scanners",
        "valeur" => [
            "fonction" => "getNbEltsTable",
            "argument" => "scanner"
        ],
        "icone" => "fa-solid fa-barcode",
        "sous-titre" => "Scanners enregistrés"
    ]
];
