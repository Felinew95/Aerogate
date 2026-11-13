<?php
declare(strict_types=1);

/**
 * functions-data.inc.php - Module de traitement des données
 * 
 * Ce module contient les fonctions pour traiter les données
 * récupérées depuis une base de données.
 * 
 * @author Alexandre BURIN
 * @version 1.0
 */

// Inclusion du fichier des requêtes SQL
require_once __DIR__ . '/../../assets/config/requetes.php';

// Inclusion des classes objets
require_once __DIR__ . '/../../assets/class/Vol.php';
require_once __DIR__ . '/../../assets/class/Avion.php';
require_once __DIR__ . '/../../assets/class/Compagnie.php';
require_once __DIR__ . '/../../assets/class/Adresse.php';
require_once __DIR__ . '/../../assets/class/Aeroport.php';
require_once __DIR__ . '/../../assets/class/Billet.php';
require_once __DIR__ . '/../../assets/class/Passager.php';
require_once __DIR__ . '/../../assets/class/Scanner.php';
require_once __DIR__ . '/../../assets/class/Personnel.php';

// Inclusion des fonctions de base de données
require_once __DIR__ . '/functions-db.inc.php';

/**
 * Récupère l'avion associé à un vol à partir de son identifiant.
 *
 * Exécute une requête SQL avec une jointure entre les tables vol
 * et avion afin de récupérer les informations de l'avion associé
 * au vol demandé.
 *
 * Les données récupérées sont normalisées puis utilisées pour
 * construire et retourner un objet Avion.
 *
 * @param int $id Identifiant du vol.
 *
 * @return Avion Objet représentant l'avion associé au vol.
 */
function getAvionByIdVol(int $id): Avion {
    // Récupération des données 
    $avion = getInfosSQL(REQUETE_GET_AVION_BY_ID_VOL, params: [':id' => $id])[0];

    // Normalisation des données
    $id_avion = (int) ($avion['id_avion'] ?? 0);
    $immatriculation = $avion['immatriculation'] ?? 'Inconnu';
    $modele = $avion['modele'] ?? 'Inconnu';
    $capacite_max = (int) $avion['capacite_max'] ?? 'Inconnu';
    $compagnie = getCompagnieByIdAvion($id_avion);

    // Retourne l'objet Avion
    return new Avion($id_avion, $immatriculation, $modele, $capacite_max, $compagnie);
}

/**
 * Récupère la compagnie aérienne associée à un vol.
 *
 * Récupère dans un premier temps l'avion associé au vol afin
 * d'obtenir son identifiant. Exécute ensuite une requête SQL
 * avec une jointure entre les tables avion et compagnie
 * pour récupérer les informations de la compagnie correspondante.
 *
 * Les données récupérées sont normalisées puis utilisées pour
 * construire et retourner un objet Compagnie.
 *
 * @param int $id Identifiant de l'avion.
 *
 * @return Compagnie Objet représentant la compagnie aérienne associée au vol.
 */
function getCompagnieByIdAvion(int $id): Compagnie {
    // Récupération des données liées à la compagnie
    $compagnie = getInfosSQL(REQUETE_GET_COMPAGNIE_BY_ID_AVION, params: [':id' => $id])[0];

    // Normalisation des données
    $id_comp = (int) ($compagnie['id_comp'] ?? 0);
    $nom_comp = $compagnie['nom_comp'] ?? 'Inconnu';
    $code_iata = $compagnie['code_iata'] ?? 'Inconnu';
    $telephone_comp = $compagnie['telephone_comp'] ?? 'Inconnu';
    $adresse = getAdresseByIdTable($id_comp, 'compagnie');
    
    // Retourne l'objet Compagnie
    return new Compagnie($id_comp, $nom_comp, $code_iata, $telephone_comp, $adresse);
}

/**
 * Normalise les données d'une adresse et crée un objet Adresse.
 *
 * Récupère les différentes informations d'une adresse depuis
 * un tableau associatif, attribue des valeurs par défaut lorsque
 * certaines données sont absentes, puis construit un objet Adresse.
 *
 * @param array $adresse Tableau associatif contenant les informations de l'adresse.
 *
 * @return Adresse Objet Adresse créé à partir des données normalisées.
 */
function normaliserAdresse(array $adresse): Adresse {
    // Normalisation des données
    $numero_adr = (int) ($adresse['numero_adr'] ?? 0);
    $nom_adr = $adresse['nom_adr'] ?? 'Inconnu';
    $code_postal = $adresse['code_postal'] ?? 'Inconnu';
    $ville_adr = $adresse['ville_adr'] ?? 'Inconnu';
    $pays_adr = $adresse['pays_adr'] ?? 'Inconnu';
    
    // Retourne l'objet Adresse
    return new Adresse($numero_adr, $nom_adr, $code_postal, $ville_adr, $pays_adr);
}

/**
 * Récupère l'adresse d'une compagnie ou d'un aéroport.
 *
 * Exécute une requête SQL en fonction du type de table spécifié
 * pour récupérer les informations de l'adresse correspondante.
 *
 * Les données récupérées sont normalisées puis utilisées pour
 * construire et retourner un objet Adresse.
 *
 * @param int $id Identifiant de la compagnie ou de l'aéroport.
 * @param string $table Le nom de la table (compagnie ou aeroport).
 *
 * @return Adresse Objet représentant l'adresse de la compagnie ou de l'aéroport.
 * 
 * @throws Exception Si la table spécifiée n'est pas valide.
 */
function getAdresseByIdTable(int $id, string $table): Adresse {
    // Vérification que la table est valide
    if (!in_array($table, TABLES_VALIDES, true)) {
        throw new Exception("Table invalide : $table");
    }

    // Choix de la requête en fonction de la table
    $requete = null;
    switch ($table) {
        case 'compagnie':
            $requete = REQUETE_GET_ADRESSE_COMPAGNIE_BY_ID_COMP;
            break;
        case 'aeroport':
            $requete = REQUETE_GET_ADRESSE_AEROPORT_BY_ID_AERO;
            break;
        case 'personne':
            $requete = REQUETE_GET_ADRESSE_PERSONNE_BY_ID_PERS;
            break;
    }

    // Récupération de l'adresse
    $adresse = getInfosSQL(
        requete: $requete,
        params: [':id' => $id]
    )[0];

    // Normalisation des données
    return normaliserAdresse($adresse);
}

/**
 * Récupère les aéroports de départ et d'arrivée d'un vol.
 *
 * Exécute une requête SQL pour récupérer les informations des aéroports
 * de départ et d'arrivée d'un vol en fonction de son identifiant.
 *
 * Les données récupérées sont normalisées puis utilisées pour
 * construire et retourner un tableau contenant les objets Aeroport
 * de départ et d'arrivée.
 *
 * @param int $id Identifiant du vol.
 *
 * @return Aeroport[] Tableau contenant les objets Aeroport de départ et d'arrivée.
 */
function getAeroportsVolById(int $id): array {
    // Récupération des aéroports
    $aeroports = getInfosSQL(REQUETE_GET_AEROPORTS_VOL_BY_ID, params: [':id' => $id])[0];

    // Normalisation des données de l'aéroport de départ 
    $id_aero_dep = (int) ($aeroports['id_aero_dep'] ?? 0);
    $nom_aero_dep = $aeroports['nom_aero_dep'] ?? '';
    $code_iata_dep = $aeroports['code_iata_dep'] ?? '';
    $adresse_aero_dep = getAdresseByIdTable($id_aero_dep, "aeroport");

    // Normalisation des données de l'aéroport d'arrivée
    $id_aero_arr = (int) ($aeroports['id_aero_arr'] ?? 0);
    $nom_aero_arr = $aeroports['nom_aero_arr'] ?? '';
    $code_iata_arr = $aeroports['code_iata_arr'] ?? '';
    $adresse_aero_arr = getAdresseByIdTable($id_aero_arr, "aeroport");

    // Création des objets Aeroport
    $aeroport_dep = new Aeroport($id_aero_dep, $nom_aero_dep, $code_iata_dep, $adresse_aero_dep);
    $aeroport_arr = new Aeroport($id_aero_arr, $nom_aero_arr, $code_iata_arr, $adresse_aero_arr);

    // Normalisation des données
    return [
        "depart" => $aeroport_dep,
        "arrivee" => $aeroport_arr
    ];
}

/**
 * Récupère l'ensemble des vols enregistrés dans la base de données.
 *
 * Exécute une requête SQL afin de récupérer les informations des vols,
 * puis parcourt les résultats pour créer un objet Vol correspondant
 * à chaque enregistrement.
 *
 * Les dates de départ sont également formatées avant la création
 * des objets. Les objets Vol sont ensuite regroupés dans un tableau.
 *
 * @return Vol[] Tableau contenant les objets Vol récupérés.
 */
function getVols(): array {
    // Récupération des données
    $vols = getInfosSQL(REQUETE_GET_VOLS);

    // Liste pour stocker les objets Vol
    $volsObj = [];

    // Création des objets Vol
    foreach ($vols as $vol) {
        // Récupération des données
        $id = (int) $vol['id_vol'] ?? 0;
        $numero = $vol['numero_vol'] ?? 'Inconnu';
        
        $date_depart = $vol['date_depart'] ?? 'Inconnu';
        $date_depart = formaterDate($date_depart, '-', '/');

        $heure_depart = $vol['heure_depart'] ?? 'Inconnu';
        $heure_embarquement = $vol['heure_embarquement'] ?? 'Inconnu';

        $avion = getAvionByIdVol($id);

        $aeroports = getAeroportsVolById($id);
        $aeroport_dep = $aeroports["depart"];
        $aeroport_arr = $aeroports["arrivee"];

        // Ajout dans la liste
        $volsObj[] = new Vol($id, $numero, $date_depart, $heure_depart, $heure_embarquement, $aeroport_dep, $aeroport_arr, $avion);
    }
    
    // Retourne la liste des vols
    return $volsObj;
}

/**
 * Récupère les billets associés à un vol.
 *
 * Exécute une requête SQL afin de récupérer les informations des billets
 * et des passagers associés à un vol, puis construit les objets Billet
 * correspondants.
 *
 * @param int $id Identifiant du vol.
 *
 * @return Billet[] Tableau d'objets Billet associés au vol.
 */
function getBilletsByIdVol(int $id): array {
    // Récupération des données
    $donnees = getInfosSQL(REQUETE_GET_PERSONNES_BY_ID_VOL, params: [':id' => $id]);

    // Normalisation des données 
    $billets = [];
    foreach($donnees as $billet) {
        // Récupération des informations du billet
        $numero_siege = htmlspecialchars($billet['numero_siege'] ?? 'Inconnu', encoding: 'UTF-8');
        $categorie = htmlspecialchars($billet['categorie'] ?? 'Inconnu', encoding: 'UTF-8');
        $porte = htmlspecialchars($billet['porte'] ?? 'Inconnu', encoding: 'UTF-8');
        
        // Récupération des informations du passager
        $nom_passager = htmlspecialchars($billet['nom_pers'] ?? 'Inconnu', encoding: 'UTF-8');
        $prenom_passager = htmlspecialchars($billet['prenom_pers'] ?? 'Inconnu', encoding: 'UTF-8');
        $date_naissance_passager = htmlspecialchars($billet['date_naissance'] ?? 'Inconnu', encoding: 'UTF-8');
        $telephone_passager = htmlspecialchars($billet['telephone_pers'] ?? 'Inconnu', encoding: 'UTF-8');
        $email_passager = htmlspecialchars($billet['email_pers'] ?? 'Inconnu', encoding: 'UTF-8');
        $numero_passport = htmlspecialchars($billet['numero_passeport'] ?? 'Inconnu', encoding: 'UTF-8');
        $nationalite_passager = htmlspecialchars($billet['nationalite_passager'] ?? 'Inconnu', encoding: 'UTF-8');
        $adresse_passager = getAdresseByIdTable((int) ($billet['id_pers'] ?? 0), 'personne');

        // Création de l'objet passager
        $passager = new Passager(
            $nom_passager, 
            $prenom_passager, 
            $date_naissance_passager, 
            $telephone_passager, 
            $email_passager, 
            $adresse_passager,
            $numero_passport, 
            $nationalite_passager
        );
        
        // Ajout du billet dans la liste
        $billets[] = new Billet($numero_siege, $categorie, $porte, $passager);
    }

    return $billets;
}

/**
 * Normalise les données des scanners récupérées depuis la base de données.
 *
 * Parcourt les données afin de récupérer le modèle et l'adresse IP
 * de chaque scanner, puis construit les objets Scanner correspondants.
 *
 * @param array $donnees Données brutes des scanners.
 *
 * @return Scanner[] Tableau d'objets Scanner.
 */
function normaliserScanners(array $donnees): array {
    $scanners = [];

    // Normalisation des données
    foreach ($donnees as $scanner) {
        $modele = htmlspecialchars($scanner['modele'] ?? 'Inconnu', encoding: 'UTF-8');
        $adresseIP = htmlspecialchars($scanner['adresse_ip'] ?? 'Inconnu', encoding: 'UTF-8');
        
        $scanners[] = new Scanner($modele, $adresseIP);
    }

    return $scanners;
}

/**
 * Récupère la liste des scanners enregistrés dans la base de données.
 *
 * Exécute une requête SQL afin de récupérer les informations des scanners,
 * normalise les données obtenues puis construit les objets Scanner
 * correspondants.
 *
 * @return Scanner[] Tableau d'objets Scanner.
 */
function getScanners(): array {
    // Récupération des données 
    $donnees = getInfosSQL(REQUETE_GET_SCANNERS);

    // Normalisation des données
    return normaliserScanners($donnees);
}

/**
 * Récupère les scanners associés à un membre du personnel.
 *
 * Exécute une requête SQL afin de récupérer les scanners utilisés
 * par le membre du personnel identifié, puis normalise les données
 * obtenues pour construire les objets Scanner correspondants.
 *
 * @param int $id Identifiant du membre du personnel.
 *
 * @return Scanner[] Tableau des scanners associés au personnel.
 */
function getScannersByIdPersonnel(int $id): array {
    // Récupération des données
    $donnees = getInfosSQL(REQUETE_GET_SCANNERS_BY_ID_PERSONNEL, [':id' => $id]);

    // Normalisation des données
    return normaliserScanners($donnees);
}

/**
 * Récupère la liste des personnels enregistrés dans la base de données.
 *
 * Exécute une requête SQL afin de récupérer les informations des personnels,
 * normalise les données obtenues puis construit les objets Personnel
 * correspondants.
 *
 * @return Personnel[] Tableau d'objets Personnel.
 */
function getPersonnels() : array {
    // Récupération des données
    $donnees = getInfosSQL(REQUETE_GET_PERSONNELS);

    // Normalisation des données 
    $personnels = [];
    foreach ($donnees as $personnel) {
        // Récupération des informations liés au personnel
        $nom_personnel = htmlspecialchars($personnel["nom_pers"] ?? 'Inconnu', encoding:"UTF-8");
        $prenom_personnel = htmlspecialchars($personnel["prenom_pers"] ?? 'Inconnu', encoding:"UTF-8");
        $date_naissance_personnel = htmlspecialchars($personnel["date_naissance"] ?? 'Inconnu', encoding:"UTF-8");
        $telephone_personnel = htmlspecialchars($personnel["telephone_pers"] ?? 'Inconnu', encoding:"UTF-8");
        $email_personnel = htmlspecialchars($personnel["email_pers"] ?? 'Inconnu', encoding:"UTF-8");
        $adresse_personnel = getAdresseByIdTable((int) ($personnel["id_adr"] ?? 0), "personne");

        $role_personnel = htmlspecialchars($personnel["role_personnel"] ?? 'Inconnu', encoding:"UTF-8");
        $matricule_personnel = htmlspecialchars($personnel["matricule_personnel"] ?? 'Inconnu', encoding:"UTF-8");
        $status_personnel = (bool) $personnel["statut_personnel"];

        $scanners = getScannersByIdPersonnel((int) $personnel["id_pers"]);

        $personnels[] = new Personnel(
            $nom_personnel,
            $prenom_personnel,
            $date_naissance_personnel,
            $telephone_personnel,
            $email_personnel,
            $adresse_personnel,
            $role_personnel,
            $matricule_personnel,
            $status_personnel,
            $scanners
        );
    }

    return $personnels;
}
