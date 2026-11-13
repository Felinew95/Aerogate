<?php
declare(strict_types=1);

/**
 * vol.php - Page de détail d'un vol
 *
 * Cette page permet d'afficher les informations détaillées
 * d'un vol sélectionné à partir de son identifiant.
 *
 * Elle récupère les données du vol depuis la session et
 * présente les informations correspondantes à l'utilisateur.
 *
 * @author Alexandre BURIN
 * @version 1.0
 */

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/include/functions.inc.php';

// Démarrage de la session pour la conservation des données
session_start();

// Vérification si les vols sont déjà en session
if (!isset($_SESSION['vols'])) {
    $_SESSION['vols'] = getVols();
} 

// Récupération de l'ID du vol depuis l'URL
$id = (int) $_GET['id'] ?? 0;
$nb_vols = count($_SESSION['vols']);

// Vérification de l'ID du vol
if ($id <= 0 || $id > $nb_vols) {
    die('Erreur: Aucun vol correspondant trouvé dans l\'intervalle [1 - ' . $nb_vols . ']');
}

// Récupération du vol correspondant à l'ID
$vol = $_SESSION['vols'][$id - 1];

/**
 * Numéro du vol
 * @var string $numeroVol Numéro du vol
 */
$numeroVol = htmlspecialchars($vol->getNumero(), encoding:"utf-8");

/**
 * Date de départ du vol
 * @var string $date_depart Date de départ du vol
 */
$date_depart = htmlspecialchars($vol->getDateDepart(), encoding:"utf-8");

/**
 * Heure de départ du vol
 * @var string $heure_depart Heure de départ du vol
 */
$heure_depart = htmlspecialchars($vol->getHeureDepart(), encoding:"utf-8");

/**
 * Heure d'arrivée du vol
 * @var string $heure_arrivee Heure d'arrivée du vol
 */
$heure_embarquement = htmlspecialchars($vol->getHeureArrivee(), encoding:"utf-8");

/**
 * Avion associé au vol
 * @var Avion $avion Avion
 */
$avion = $vol->getAvion();

/**
 * Immatriculation de l'avion
 * @var string $immatriculation Immatriculation de l'avion
 */
$immatriculation = htmlspecialchars($avion->getImmatriculation(), encoding:"utf-8");

/**
 * Modèle de l'avion
 * @var string $modele Modèle de l'avion
 */
$modele = htmlspecialchars($avion->getModele(), encoding:"utf-8");

/**
 * Capacité maximale de l'avion
 * @var int $capacite_max Capacité maximale de l'avion
 */
$capacite_max = $avion->getCapacite();

/**
 * Compagnie aérienne associée à l'avion
 * @var Compagnie $compagnie Compagnie aérienne
 */
$compagnie = $avion->getCompagnie();

/**
 * Nom de la compagnie aérienne
 * @var string $nom_compagnie Nom de la compagnie aérienne
 */
$nom_compagnie = htmlspecialchars($compagnie->getNom(), encoding:"utf-8");

/**
 * Code IATA de la compagnie aérienne
 * @var string $code_iata_compagnie Code IATA de la compagnie aérienne
 */
$code_iata_compagnie = htmlspecialchars($compagnie->getCodeIata(), encoding:"utf-8");

/**
 * Téléphone de la compagnie aérienne
 * @var string $telephone_compagnie Téléphone de la compagnie aérienne
 */
$telephone_compagnie = htmlspecialchars($compagnie->getTelephone(), encoding:"utf-8");

/**
 * Adresse de la compagnie aérienne
 * @var string $adresse_compagnie Adresse de la compagnie aérienne
 */
$adresse_compagnie = (string) $compagnie->getAdresse();

/**
 * Aeroport d'arrivée du vol
 * @var Aeroport $aeroport_arrive Aeroport d'arrivée
 */
$aeroport_arrive = $vol->getAeroportArrivee();

/**
 * Nom de l'aéroport d'arrivée
 * @var string $nom_aeroport_arrive Nom de l'aéroport d'arrivée
 */
$nom_aeroport_arrive = htmlspecialchars($aeroport_arrive->getNom(), encoding:"utf-8");

/**
 * Code IATA de l'aéroport d'arrivée
 * @var string $code_iata_aeroport_arrive Code IATA de l'aéroport d'arrivée
 */
$code_iata_aeroport_arrive = htmlspecialchars($aeroport_arrive->getCodeIata(), encoding:"utf-8");

/**
 * Adresse de l'aéroport d'arrivée
 * @var string $adresse_aeroport_arrive Adresse de l'aéroport d'arrivée
 */
$adresse_aeroport_arrive = (string) $aeroport_arrive->getAdresse();

// Métadonnées de la page

/**
 * Titre de la page
 * @var string $titre Titre de la page
 */
$titre = 'AGT : Vol ' . $numeroVol;

/**
 * Description de la page
 * @var string $description Description de la page
 */
$description = "Page de détail d'un vol";

/**
 * Mots-clés de la page
 * @var string $keywords Mots-clés de la page
 */
$keywords = "tableau de bord, vols, aéroport, avion, compagnie";

/**
 * Titre de l'en-tête
 * @var string $titreHeader Titre de l'en-tête
 */
$titreHeader = 'Vol ' . $numeroVol;

// Récupération des billets et personnes associés au vol
$billets = getBilletsByIdVol($id);

// Inclusion de l'en-tête
require_once __DIR__ . '/include/header.inc.php';

?>

    <main>
        <!-- Affichage des informations du vol -->
        <section class="vol-content">
            <h2>Informations du vol</h2>    

            <!-- Affiche des informations générales du vol -->
            <div class="info-vol-general">
                <div class="info-vol-general-header">
                    <i class="fas fa-plane"></i>
                    <h2>Informations générales : </h2>
                </div>
               
        
                <div class="info-vol-content">
                    <span class="vol-info-item">Numéro du vol : <?= $numeroVol ?></span>
                    <span class="vol-info-item">Date de départ : <?= $date_depart ?></span>
                    <span class="vol-info-item">Heure de départ : <?= $heure_depart ?></span>
                    <span class="vol-info-item">Heure d'embarquement : <?= $heure_embarquement ?></span>
                </div>
            </div>

            <!-- Affiche des informations de la compagnie aérienne -->
            <div class="info-compagnie-vol">
                <div class="info-compagnie-vol-header">
                    <i class="fas fa-building"></i>
                    <h2>Compagnie aérienne</h2>
                </div>

                <div class="info-compagnie-content">
                    <span class="compagnie-info-item">Nom : <?= $nom_compagnie ?></span>
                    <span class="compagnie-info-item">Code IATA : <?= $code_iata_compagnie ?></span>
                    <span class="compagnie-info-item">Téléphone : <?= $telephone_compagnie ?></span>
                    <span class="compagnie-info-item">Adresse : <?= $adresse_compagnie ?></span>
                </div>
            </div>

            <!-- Affiche des informations de l'avion -->
            <div class="info-avion-vol">
                <div class="info-avion-vol-header">
                    <i class="fas fa-plane"></i>
                    <h2>Avion</h2>
                </div>

                <div class="info-avion-content">
                    <span class="avion-info-item">Immatriculation : <?= $immatriculation ?></span>
                    <span class="avion-info-item">Modèle : <?= $modele ?></span>
                    <span class="avion-info-item">Capacité maximale : <?= $capacite_max ?></span>
                </div>
            </div>

            <!-- Affiche des informations de la destination -->
            <div class="info-arrivee-vol">
                <div class="info-arrivee-vol-header">
                    <i class="fas fa-map-marker-alt"></i>
                    <h2>Destination</h2>
                </div>

                <div class="info-arrivee-content">
                    <span class="arrivee-info-item">Aéroport : <?= $nom_aeroport_arrive ?></span>
                    <span class="arrivee-info-item">Code IATA : <?= $code_iata_aeroport_arrive ?></span>
                    <span class="arrivee-info-item">Adresse : <?= $adresse_aeroport_arrive ?></span>
                </div>
            </div>
        </section>

        <!-- Affichage des passagers -->
        <section class="passagers-content">
            <h2>Tableau des passagers</h2>

            <!-- Tableau des passagers -->
            <?php 
                echo (empty($billets) ? 
                    '<p>Aucun passager pour ce vol.</p>' : 
                    creerTablePassager($numeroVol, $billets));
            ?>
        </section>
    </main>

<?php
// Inclusion du pied de page
require_once __DIR__ . '/include/footer.inc.php';