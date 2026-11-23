<?php
declare(strict_types=1);

/**
 * helper.inc.php - Fonctions utilitaires du site
 * 
 * Ce module contient des fonctions utilitaires réutilisables dans le site.
 * Il est utile pour toutes les pages du site.
 * 
 * @author Alexandre BURIN
 * @version 1.0.0
 */

// Inclusion du fichier de configuration
require_once 'assets/config/config.php';


/**
 * Initialise le fuseau horaire par défaut pour l'application.
 *
 * Si aucun fuseau horaire n'est actuellement configuré,
 * la fonction applique celui passé en paramètre.
 *
 * @param string $zone Le fuseau horaire à définir (ex: "Europe/Paris")
 * @return void
 */
function initialiserDateZone(string $zone): void {
    $timezone = date_default_timezone_get();
    if (empty($timezone)) {
        date_default_timezone_set($zone);
    }
}


/**
 * Lit le contenu d'un fichier et retourne ses lignes.
 *
 * Cette fonction tente de lire un fichier ligne par ligne.
 * Si le fichier ne peut pas être lu, elle retourne null.
 *
 * @param string $chemin Chemin vers le fichier à lire
 * @return array|null Retourne un tableau de lignes ou null en cas d'échec
 */
function lireFichier(string $chemin): ?array {
    $fichier = file($chemin);
    if ($fichier === false) {
        return null;
    }
    return $fichier;
}

/**
 * Charge les variables d'environnement depuis un fichier .env.
 *
 * Cette fonction lit le fichier `.env` situé à la racine du projet,
 * ignore les lignes vides ainsi que les commentaires (lignes commençant par #),
 * puis extrait les paires clé/valeur au format :
 *
 * KEY=VALUE
 *
 * Chaque variable est ensuite :
 * - ajoutée à l'environnement système via putenv()
 * - stockée dans le tableau global $_ENV
 *
 * @param string $chemin Chemin vers le fichier .env (par défaut '.env')
 * @return void
 */
function extraireVariablesEnv(string $chemin = FICHIER_ENV) : void {
    // Lecture du fichier .env ligne par ligne
    $fichier = lireFichier($chemin);
    if ($fichier === null) {
        return;
    }

    foreach ($fichier as $ligne) {
        $ligne = trim($ligne);

        // Ignore les commentaires et les lignes vides
        if (str_starts_with($ligne, '#') || $ligne === '') {
            continue;
        }

        // Sépare la clé et la valeur (limité à 2 parties)
        [$key, $value] = explode('=', $ligne, 2);

        // Injection dans l'environnement système
        putenv("$key=$value");

        // Stockage dans $_ENV pour accès global dans PHP
        $_ENV[$key] = $value;
    }
}

/**
 * Formate une date selon le format de séparation demandé.
 *
 * Sépare les différentes parties d'une date à l'aide du séparateur
 * d'origine, puis reconstruit la date avec le nouveau séparateur
 * en inversant l'ordre des éléments (jour, mois, année).
 *
 * @param string $date Date à formater.
 * @param string $format_depart Séparateur utilisé dans la date d'origine.
 * @param string $format_arrivee Séparateur souhaité pour la date formatée.
 *
 * @return string Date reformattée au format jour, mois et année.
 */
function formaterDate(string $date, string $format_depart, string $format_arrivee) : string {
    // Mise en tableau des parties de la date
    $date = explode($format_depart, $date);
    
    // Récupération des parties de la date
    $annee = $date[0];
    $mois = $date[1];
    $jour = $date[2];

    // Reconstruction de la date dans le format demandé
    return implode($format_arrivee, [$jour, $mois, $annee]);
}