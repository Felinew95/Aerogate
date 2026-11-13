<?php
declare(strict_types=1);

/**
 * header.inc.php - Module qui regroupe les éléments communs à toutes les pages
 * 
 * Ce module représente l'en-tête de toutes les pages du site.
 * Il est utile pour éviter de répéter le même code sur chaque page.
 * 
 * @author Alexandre BURIN
 * @version 1.0
 */

// Directives requises 
require_once __DIR__ . '/functions.inc.php';
require_once __DIR__ . '/helper.inc.php';

/**
 * Variable pour le titre de la page
 */
$titre ??= "";

/**
 * Variable pour la description de la page
 */
$description ??= "";

/**
 * Variable pour les mots-clés de la page
 */
$keywords ??= "";

/**
 * Variable pour le titre de l'en-tête
 */
$titreHeader ??= "";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Configuration de base -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Métadonnées de la page -->
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?=  $keywords ?>">
    <meta name="author" content="Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE">
    
    <!-- Titre de la page -->
    <title><?= $titre ?></title>
    
    <!-- Styles globaux -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">

    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Icône du site -->
    <link rel="icon" href="assets/img/favicon.ico">
</head>
<body id="haut">
    <!-- En-tête du site -->
    <header>
        <div class="header-logo-container">
            <a href="index.php"><img src="assets/img/aerogate-logo.png" alt="Logo" class="header-logo" loading="lazy"></a>
        </div>

        <div class="header-title-container">
                <h1 class="header-title">Aérogate : <?= $titreHeader ?></h1>
        </div>
    </header>
    
    <!-- Contenu principal -->
    <main>