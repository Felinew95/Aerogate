<?php
declare(strict_types=1);

/**
 * Personne.php - Classe de représentation d'une personne
 *
 * Cette classe permet de représenter une personne et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque personne est caractérisée par un nom, un prénom, une date de naissance,
 * un numéro de téléphone, une adresse e-mail et une adresse.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'une personne ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Inclusion des classes nécessaires
require_once __DIR__ . '/Adresse.php';

/**
 * Classe abstraitePersonne
 *
 * Représente une personne possédant des informations personnelles
 * ainsi qu'une adresse.
 */
abstract class Personne {

    /**
     * @var string Nom de la personne.
     */
    private string $nom;

    /**
     * @var string Prénom de la personne.
     */
    private string $prenom;

    /**
     * @var string Date de naissance de la personne.
     */
    private string $dateNaissance;

    /**
     * @var string Numéro de téléphone de la personne.
     */
    private string $telephone;

    /**
     * @var string Adresse e-mail de la personne.
     */
    private string $email;

    /**
     * @var Adresse Adresse de résidence de la personne.
     */
    private Adresse $adresse;

    /**
     * Constructeur de la classe Personne.
     *
     * Initialise les informations personnelles et l'adresse
     * de la personne.
     *
     * @param string $nom Nom de la personne.
     * @param string $prenom Prénom de la personne.
     * @param string $dateNaissance Date de naissance de la personne.
     * @param string $telephone Numéro de téléphone de la personne.
     * @param string $email Adresse e-mail de la personne.
     * @param Adresse $adresse Adresse de résidence de la personne.
     */
    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $telephone,
        string $email,
        Adresse $adresse
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
    }

    /**
     * Retourne le nom de la personne.
     *
     * @return string Nom de la personne.
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Retourne le prénom de la personne.
     *
     * @return string Prénom de la personne.
     */
    public function getPrenom(): string {
        return $this->prenom;
    }

    /**
     * Retourne la date de naissance de la personne.
     *
     * @return string Date de naissance.
     */
    public function getDateNaissance(): string {
        return $this->dateNaissance;
    }

    /**
     * Retourne le numéro de téléphone de la personne.
     *
     * @return string Numéro de téléphone.
     */
    public function getTelephone(): string {
        return $this->telephone;
    }

    /**
     * Retourne l'adresse e-mail de la personne.
     *
     * @return string Adresse e-mail.
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Retourne l'adresse de la personne.
     *
     * @return Adresse Adresse de résidence.
     */
    public function getAdresse(): Adresse {
        return $this->adresse;
    }
}