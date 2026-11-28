<?php
declare(strict_types=1);

/**
 * functions-info.inc.php - Module d'informations
 * 
 * Ce module contient les fonctions l'extraction d'informations
 * importantes pour le tableau de bord.
 * 
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Inclusion des classes requises
require_once __DIR__ . '/../../assets/class/Personnel.php';

/**
 * Compte le nombre de personnels actifs
 * 
 * @param Personnel[] $personnels Tableau des personnels
 * @return int Nombre de personnels actifs
 */
function getPersonnelsActifs(array $personnels): int {
    $nombre = 0;

    foreach ($personnels as $personnel) {
        if ($personnel->getStatut()) {
            $nombre++;
        }
    }

    return $nombre;
}

/**
 * Compte le nombre de vols d'aujourd'hui
 * 
 * @param Vol[] $vols Tableau des vols
 * @return int Nombre de vols d'aujourd'hui
 */
function getVolsAujourdhui(array $vols): int {
    $nombre = 0;

    foreach ($vols as $vol) {
        if ($vol->getDateDepart() === date('d/m/Y')) {
            $nombre++;
        }
    }

    return $nombre;
}

/**
 * Compte le nombre d'éléments présents dans une table.
 *
 * Construit et exécute une requête SQL afin de compter
 * le nombre de lignes présentes dans la table indiquée.
 *
 * @param string $table Nom de la table.
 *
 * @return int Nombre d'éléments dans la table.
 */
function getNbEltsTable(string $table): int {
    $donnees = getInfosSQL("SELECT COUNT(*) AS nombre FROM $table");
    return (int) ($donnees[0]['nombre'] ?? 0);
}
