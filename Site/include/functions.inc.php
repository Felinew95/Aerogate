<?php
declare(strict_types=1);

/**
 * functions.inc.php - Module de fonctions utilitaires du site
 * 
 * Ce module contient les fonctions utilitaires du site.
 * Il permet de construire certains éléments pour les différentes pages.
 * 
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Fichiers requis pour le fonctionnement 
require_once __DIR__ . '/../assets/config/config.php';
require_once __DIR__ . '/helper.inc.php';

// Chargement des variables d'environnement
extraireVariablesEnv();

// Initalisation de la zone horaire
initialiserDateZone(ZONE_HORAIRE);

// Inclusions des fichiers de fonctions 
require_once __DIR__ . '/functions/functions-db.inc.php';
require_once __DIR__ . '/functions/functions-data.inc.php';
require_once __DIR__ . '/functions/functions-struct.inc.php';
require_once __DIR__ . '/functions/functions-info.inc.php';
