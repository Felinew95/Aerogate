<?php
declare(strict_types=1);

/**
 * functions-db.inc.php - Module de gestion de la base de données PostgreSQL
 *
 * Ce module contient les fonctions permettant d'établir une connexion
 * à la base de données PostgreSQL et de récupérer les informations
 * stockées à l'aide de requêtes SQL.
 *
 * @author Alexandre BURIN
 * @version 1.0.0
 */

/**
 * Ouvre une connexion à la base de données PostgreSQL.
 *
 * Initialise une connexion PDO à la base de données hébergée
 * sur AlwaysData et configure les options de gestion des erreurs
 * ainsi que le mode de récupération des résultats.
 *
 * @return PDO Objet PDO représentant la connexion à la base de données.
 *
 * @throws PDOException En cas d'erreur de connexion à la base de données.
 */
function ouvrirBDD(): PDO {
    // Informations sur la base de données
    $host = $_ENV["DB_HOST"] ?? '';
    $port = $_ENV["DB_PORT"] ?? '';
    $dbname = $_ENV["DB_NAME"] ?? '';
    $user = $_ENV["DB_USER"] ?? '';
    $password = $_ENV["DB_PASSWORD"] ?? '';

    // Informations à transmettre
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    // Connexion à la base de données
    return new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

/**
 * Ferme la connexion à la base de données.
 * 
 * L'objet PDO est détruit pour fermer la connexion entre la base de données
 * et le serveur.
 *
 * @param PDO &$pdo Référence vers l'objet de connexion PDO.
 *
 * @return void
 *
 * @post La connexion à la base de données est fermée et l'objet PDO est
 *       réinitialisé à null.
 */
function fermerBDD(PDO &$pdo): void {
    // Fermeture de la connexion
    $pdo = null;
}

/**
 * Récupère les informations des prestations depuis la base de données.
 *
 * @param PDO $pdo Connexion à la base de données PostgreSQL.
 * @param string $requete Requête SQL à exécuter.
 * @param array $params Paramètres à lier à la requête.
 *
 * @return array Tableau contenant les résultats de la requête.
 */
function obtenirInfos(PDO $pdo, string $requete, array $params = []): array {
    // Préparation de la requête
    $stat = $pdo->prepare($requete);

    // Exécution de la requête
    $stat->execute($params);

    // Extraction des données
    return $stat->fetchAll();
}

/**
 * Exécute une requête de modification dans la base de données.
 *
 * Prépare la requête SQL fournie à l'aide de PDO, puis l'exécute
 * afin d'effectuer une opération sur la base de données.
 *
 * Cette fonction peut notamment être utilisée pour les requêtes
 * INSERT, UPDATE et DELETE.
 *
 * @param PDO $pdo Objet PDO représentant la connexion à la base de données.
 * @param string $requete Requête SQL à préparer et à exécuter.
 *
 * @return void
 *
 * @throws PDOException En cas d'erreur lors de la préparation ou
 *                      de l'exécution de la requête SQL.
 */
function miseAJourInfos(PDO $pdo, string $requete) : void {
    // Préparation de la requête
    $stat = $pdo->prepare($requete);

    // Exécution de la requête
    $stat->execute();
}

/**
 * Récupère des informations depuis la base de données PostgreSQL.
 *
 * Établit une connexion à la base de données à l'aide de la fonction
 * ouvrirBDD(), puis transmet la requête SQL fournie à la fonction
 * obtenir_infos() afin de l'exécuter et de récupérer les résultats.
 *
 * Les données récupérées sont retournées sous forme de tableaux
 * associatifs.
 *
 * En cas d'échec de connexion, le script est interrompu et un message
 * d'erreur est affiché.
 *
 * @param string $requete Requête SQL à exécuter pour récupérer les données.
 * @param array $params Paramètres à lier à la requête.
 *
 * @return array Tableau contenant les résultats de la requête sous
 *               forme de tableaux associatifs.
 *
 * @throws PDOException En cas d'échec de la connexion à la base de données.
 */
function getInfosSQL(string $requete, array $params = []): array {
    // Ouverture de la base de données
    try {
        $pdo = ouvrirBDD();
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // Récupération des données
    $donnees = obtenirInfos($pdo, $requete, $params);
    
    // Fermeture de la connexion
    fermerBDD($pdo);

    return $donnees;
}