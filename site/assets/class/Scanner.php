<?php
declare(strict_types=1);

/**
 * Scanner.php - Classe de représentation d'un scanner
 *
 * Cette classe permet de représenter un scanner et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque scanner est caractérisé par un modèle et une adresse IP.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un scanner ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN
 * @version 1.0
 */
/**
 * Classe Scanner
 *
 * Représente un scanner identifié par son modèle et son adresse IP.
 */
class Scanner {

    /**
     * @var string Modèle du scanner.
     */
    private string $modele;

    /**
     * @var string Adresse IP du scanner.
     */
    private string $adresseIP;

    /**
     * Constructeur de la classe Scanner.
     *
     * Initialise le modèle et l'adresse IP du scanner.
     *
     * @param string $modele Modèle du scanner.
     * @param string $adresseIP Adresse IP du scanner.
     */
    public function __construct(string $modele, string $adresseIP) {
        $this->modele = $modele;
        $this->adresseIP = $adresseIP;
    }

    /**
     * Retourne le modèle du scanner.
     *
     * @return string Modèle du scanner.
     */
    public function getModele(): string {
        return $this->modele;
    }

    /**
     * Retourne l'adresse IP du scanner.
     *
     * @return string Adresse IP du scanner.
     */
    public function getAdresseIP(): string {
        return $this->adresseIP;
    }
}