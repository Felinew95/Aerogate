<?php
declare(strict_types=1);

// Inclusion des classes nécessaires
require_once __DIR__ . '/../../assets/class/Vol.php';

/**
 * Génère une liste HTML de vols.
*
 * Parcourt un tableau d'objets Vol afin de récupérer leur numéro
 * et leur date de départ, puis construit une liste HTML
 * contenant les informations de chaque vol.
 *
 * @param Vol[] $vols Tableau d'objets Vol à afficher.
 *
 * @return string Liste HTML contenant les informations des vols.
 */
function creerListeVols(array $vols): string {
    $html = "<ul>\n";

    foreach ($vols as $vol) {
        // Récupération des informations utiles
        $id = $vol->getId();
        $numero = htmlspecialchars($vol->getNumero(), encoding:"utf-8");
        $date_depart = htmlspecialchars($vol->getDateDepart(), encoding:"utf-8");

        // Ajout du vol à la liste
        $html .= "\t\t\t\t<li><a href=\"vol.php?id=" . $id . '">Vol ' . $numero . ' - ' . $date_depart  . "</a></li>\n";
    }

    return $html . "\t\t\t</ul>\n";
}

/**
 * Génère une liste HTML contenant les informations des scanners.
 *
 * Parcourt le tableau des scanners afin de récupérer leur modèle
 * et leur adresse IP, puis construit une liste HTML présentant
 * les informations de chaque scanner.
 *
 * @param Scanner[] $scanners Tableau d'objets Scanner à afficher.
 *
 * @return string Liste HTML contenant les informations des scanners.
 */
function creerListeScanners(array $scanners) : string {
    $html = "<ul>\n";
    
    // Création de la liste des scanners
    foreach ($scanners as $scanner) {
        // Récupération des informations
        $modele = $scanner->getModele();
        $adresseIP = $scanner->getAdresseIP();

        // Ajout du scanner à la liste
        $html .= "\t\t\t\t<li>" . $modele . " - " . $adresseIP . "</li>\n";
    }
    
    return $html . "\t\t\t</ul>\n";
}

/**
 * Génère un tableau HTML contenant les informations des passagers d'un vol.
 *
 * Parcourt les billets associés au vol afin de récupérer les informations
 * personnelles de chaque passager ainsi que les informations de son billet.
 * Construit ensuite un tableau HTML présentant ces données.
 *
 * @param string $numero_vol Numéro du vol concerné.
 * @param Billet[] $billets Tableau des billets associés au vol.
 *
 * @return string Tableau HTML contenant les informations des passagers.
 */
function creerTablePassager(string $numero_vol, array $billets) : string {
    $html = "<table>\n";
    
    // Création du sous titre
    $html .= "\t\t\t\t<caption>Tableau des passager du vol " . $numero_vol . "</caption>\n";

    // Création de l'en-tête
    $html .= "\t\t\t\t<thead>\n";
    $html .= "\t\t\t\t\t<tr>\n";
    
    $html .= "\t\t\t\t\t\t<th>Nom</th>\n";
    $html .= "\t\t\t\t\t\t<th>Prénom</th>\n";
    $html .= "\t\t\t\t\t\t<th>Date de naissance</th>\n";
    $html .= "\t\t\t\t\t\t<th>Téléphone</th>\n";
    $html .= "\t\t\t\t\t\t<th>Email</th>\n";

    $html .= "\t\t\t\t\t\t<th>Numéro de passeport</th>\n";
    $html .= "\t\t\t\t\t\t<th>Nationalité</th>\n";
    
    $html .= "\t\t\t\t\t\t<th>Numéro de siège</th>\n";
    $html .= "\t\t\t\t\t\t<th>Catégorie</th>\n";
    $html .= "\t\t\t\t\t\t<th>Porte d'embarquement</th>\n";
    
    $html .= "\t\t\t\t\t</tr>\n";
    $html .= "\t\t\t\t</thead>\n";

    // Création du corps
    $html .= "\t\t\t\t<tbody>\n";
    foreach ($billets as $billet) {
        // Récupération de la personne associé au billet 
        $personne = $billet->getPassager();
        
        // Création d'une ligne pour chaque passager
        $html .= "\t\t\t\t\t<tr>\n";
        
        $html .= "\t\t\t\t\t\t<td>" . $personne->getNom() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getPrenom() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getDateNaissance() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getTelephone() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getEmail() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getNumeroPasseport() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $personne->getNationalite() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $billet->getNumeroSiege() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $billet->getCategorie() . "</td>\n";
        $html .= "\t\t\t\t\t\t<td>" . $billet->getPorte() . "</td>\n";

        $html .= "\t\t\t\t\t</tr>\n";
    }

    $html .= "\t\t\t\t</tbody>\n";
    $html .= "\t\t\t</table>\n";

    return $html;
}

/**
 * Génère une section HTML présentant les informations importantes d'Aérogate.
 *
 * Parcourt les informations configurées dans le tableau fourni afin de
 * calculer les différentes valeurs à afficher. Utilise les données des vols
 * et du personnel déjà récupérées lorsque cela est nécessaire, puis construit
 * une carte HTML pour chaque indicateur avec son icône, son titre, sa valeur
 * et son sous-titre.
 *
 * @param Vol[] $vols Liste des vols disponibles.
 * @param Personnel[] $personnels Liste des membres du personnel.
 * @param array $infos Configuration des informations importantes à afficher.
 *
 * @return string Code HTML contenant les cartes d'informations importantes.
 */
function creerSectionInfosImportantes(array $vols, array $personnels, array $infos = TABLEAU_INFORMATIONS_IMPORTANTES): string {
    $html = "<div class=\"info-content\">";
    
    foreach ($infos as $info) {
        $fonction = $info['valeur']['fonction'];
        $argument = $info['valeur']['argument'];

        $valeur = match ($fonction) {
            'getVolsAujourdhui' => getVolsAujourdhui($vols),
            'getPersonnelsActifs' => getPersonnelsActifs($personnels),
            'getNbEltsTable' => getNbEltsTable($argument),
            default => 0,
        };

        $html .= "<div class=\"info-card\">";
        $html .= "<div class=\"info-card-header\">";
        $html .= "<i class=\"fas " . $info['icone'] . "\"></i>";
        $html .= "<span class=\"info-card-title\">" . $info['titre'] . "</span>";
        $html .= "</div>";
        $html .= "<div class=\"info-card-content\">";
        $html .= "<p class=\"info-card-value\">" . $valeur . "</p>";
        $html .= "<p class=\"info-card-subtitle\">" . $info['sous-titre'] . "</p>";
        $html .= "</div>";
        $html .= "</div>";
    }
    
    $html .= "</div>";
    
    return $html;
}