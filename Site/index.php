<?php
declare(strict_types=1);

/**
 * index.php - Tableau de bord
 * 
 * Ce module affiche le tableau de bord de l'aéroport avec les informations importantes
 * sur les vols, le personnel et les scanners.
 * 
 * Les informations sont récupérées depuis la base de données postgres.
 * 
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Inclusion des fichiers nécessaires
require_once 'include/functions.inc.php';

// Démarrage de la session pour la conservation des données
session_start();

// Métadonnées de la page 

/**
 * Titre de la page
 * @var string $titre Titre de la page
 */
$titre = 'AGT : Tableau de bord';

/**
 * Description de la page
 * @var string $description Description de la page
 */
$description = 'Tableau de bord des vols';

/**
 * Mots-clés de la page
 * @var string $keywords Mots-clés de la page
 */
$keywords = 'tableau de bord, vols, aéroport, avion, compagnie';

/**
 * Titre de l'en-tête
 * @var string $titreHeader Titre de l'en-tête
 */
$titreHeader = 'Tableau de bord';

if (empty($_SESSION['vols'])) {
    /**
     * Récupération de la liste des vols
     * @var array $vols Tableau des vols
     */
    $vols = getVols();

    // Ajout dans la session pour la conservation des données
    $_SESSION['vols'] = $vols;
} else {
    // Récupération de la liste des vols depuis la session si elle existe
    $vols = $_SESSION['vols'];
}

/**
 * Récupération de la liste des scanners
 * @var array $scanners Tableau des scanners
 */
$scanners = getScanners();

/**
 * Récupération de la liste des personnels
 * @var array|null $personnels Tableau des personnels
 */
$personnels = getPersonnels();

// Inclusion de l'en-tête
require_once 'include/header.inc.php';

?>

    <main>
        <!-- Informations importantes -->
        <section class="info-importantes">
            <h2>Informations importantes</h2>

            <!-- Affichage des cartes des informations importantes -->
            <?= creerSectionInfosImportantes($vols, $personnels); ?>
        </section>

        <!-- Liste des éléments -->
        <section class="liste-elements"> 
            <h2>Liste des éléments</h2>

            <article class="liste-content">
                <div>
                    <h3>Liste des vols</h3>
                    <!-- Affichage de la liste des vols -->
                    <?php 
                        echo (!empty($vols) ? 
                            creerListeVols($vols) : 
                            '<p>Aucun vol enregistré</p>');
                    ?>
                </div>

                <!-- Liste des scanners -->
                <div>
                    <h3>Liste des scanners</h3>

                    <!-- Affichage de la liste des scanners -->
                    <?php 
                        echo (!empty($scanners) ? 
                            creerListeScanners($scanners) : 
                            '<p>Aucun scanner enregistré</p>');
                    ?>
                </div>
            </article>
        </section>

        <!-- Liste des personnels -->
        <section class="liste-personnels">
            <h2>Liste des personnels</h2>

            <!-- Affichage des cartes des personnels -->
            <?php if (!empty($personnels)): ?>                
                <div class="personnels-content">
                    <?php foreach ($personnels as $personnel): ?>
                        <div class="personnel-card">
                            <div class="personnel-card-header">
                                <h3><?php echo $personnel->getPrenom() . ' ' . $personnel->getNom(); ?></h3>
                            </div>

                            <div class="personnel-infos">
                                <span><i class="fas fa-birthday-cake"></i> Date de naissance : <?php echo $personnel->getDateNaissance(); ?></span>
                                <span><i class="fas fa-phone"></i> Téléphone : <?php echo $personnel->getTelephone(); ?></span>
                                <span><i class="fas fa-envelope"></i> Email : <?php echo $personnel->getEmail(); ?></span>
                                <span><i class="fas fa-user-tag"></i> Rôle : <?php echo $personnel->getRole(); ?></span>
                                <span><i class="fas fa-id-card"></i> Matricule : <?php echo $personnel->getMatricule(); ?></span>
                                <span><i class="fas fa-toggle-on"></i> Statut : <?php echo $personnel->getStatut() ? 'Actif' : 'Inactif'; ?></span>
                            </div>

                            <div class="personnel-scanners">
                                <h4>Scanners attribués</h4>

                                <?= creerListeScanners($personnel->getScanners()) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Aucun personnel enregistré</p>
            <?php endif; ?>
        </section>
    </main>

<?php
// Inclusion du pied de page
require_once 'include/footer.inc.php';