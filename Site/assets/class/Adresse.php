<?php
declare(strict_types=1);

/**
 * Adresse.php - Classe de représentation d'une adresse
 *
 * Cette classe permet de représenter une adresse et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque adresse est caractérisée par un numéro, un nom de rue,
 * un code postal, une ville et un pays.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'une adresse ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0.0
 */

/**
 * Classe Adresse
 *
 * Représente une adresse et regroupe l'ensemble de ses
 * informations dans un objet unique.
 */
class Adresse {

    /**
     * @var int Numéro de l'adresse.
     */
    private int $numero;

    /**
     * @var string Nom de la rue.
     */
    private string $nom;

    /**
     * @var string Code postal de l'adresse.
     */
    private string $codePostal;

    /**
     * @var string Ville de l'adresse.
     */
    private string $ville;

    /**
     * @var string Pays de l'adresse.
     */
    private string $pays;

    /**
     * Constructeur de la classe Adresse.
     *
     * Initialise une nouvelle adresse avec l'ensemble de ses informations.
     *
     * @param int $numero Numéro de l'adresse.
     * @param string $nom Nom de la rue.
     * @param string $codePostal Code postal de l'adresse.
     * @param string $ville Ville de l'adresse.
     * @param string $pays Pays de l'adresse.
     */
    public function __construct(
        int $numero,
        string $nom,
        string $codePostal,
        string $ville,
        string $pays
    ) {
        $this->numero = $numero;
        $this->nom = $nom;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->pays = $pays;
    }

    /**
     * Récupère le numéro de l'adresse.
     *
     * @return int Numéro de l'adresse.
     */
    public function getNumero(): int {
        return $this->numero;
    }

    /**
     * Récupère le nom de la rue.
     *
     * @return string Nom de la rue.
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Récupère le code postal de l'adresse.
     *
     * @return string Code postal de l'adresse.
     */
    public function getCodePostal(): string {
        return $this->codePostal;
    }

    /**
     * Récupère la ville de l'adresse.
     *
     * @return string Ville de l'adresse.
     */
    public function getVille(): string {
        return $this->ville;
    }

    /**
     * Récupère le pays de l'adresse.
     *
     * @return string Pays de l'adresse.
     */
    public function getPays(): string {
        return $this->pays;
    }

    /**
     * Retourne une représentation textuelle de l'adresse.
     *
     * @return string Représentation textuelle de l'adresse.
     */
    public function __toString(): string {
        return $this->numero . ' ' . $this->nom . ', ' . $this->codePostal . ' ' . $this->ville . ', ' . $this->pays;
    }
}
