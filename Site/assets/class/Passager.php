<?php
declare(strict_types=1);

/**
 * Passager.php - Classe de représentation d'un passager
 *
 * Cette classe permet de représenter un passager et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque passager est caractérisé par un nom, un prénom, une date de naissance,
 * un numéro de téléphone, une adresse e-mail, une adresse, un numéro de passeport
 * et une nationalité.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un passager ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Inclusion des classes nécessaires
require_once __DIR__ . '/Personne.php';

/**
 * Classe Passager
 *
 * Représente un passager héritant des informations personnelles
 * définies dans la classe abstraite Personne.
 */
class Passager extends Personne {

    /**
     * @var string Numéro de passeport du passager.
     */
    private string $numeroPasseport;

    /**
     * @var string Nationalité du passager.
     */
    private string $nationalite;

    /**
     * Constructeur de la classe Passager.
     *
     * Initialise les informations personnelles héritées de Personne
     * ainsi que les informations propres au passager.
     *
     * @param string $nom Nom du passager.
     * @param string $prenom Prénom du passager.
     * @param string $dateNaissance Date de naissance du passager.
     * @param string $telephone Numéro de téléphone du passager.
     * @param string $email Adresse e-mail du passager.
     * @param Adresse $adresse Adresse de résidence du passager.
     * @param string $numeroPasseport Numéro de passeport du passager.
     * @param string $nationalite Nationalité du passager.
     */
    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $telephone,
        string $email,
        Adresse $adresse,
        string $numeroPasseport,
        string $nationalite
    ) {
        parent::__construct($nom, $prenom, $dateNaissance, $telephone, $email, $adresse);
        $this->numeroPasseport = $numeroPasseport;
        $this->nationalite = $nationalite;
    }

    /**
     * Retourne le numéro de passeport du passager.
     *
     * @return string Numéro de passeport.
     */
    public function getNumeroPasseport(): string {
        return $this->numeroPasseport;
    }

    /**
     * Retourne la nationalité du passager.
     *
     * @return string Nationalité du passager.
     */
    public function getNationalite(): string {
        return $this->nationalite;
    }
}