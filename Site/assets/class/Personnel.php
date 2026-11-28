<?php
declare(strict_types=1);

/**
 * Personnel.php - Classe de représentation d'un membre du personnel
 *
 * Cette classe permet de représenter un membre du personnel et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque membre du personnel est caractérisé par un nom, un prénom, une date de naissance,
 * un numéro de téléphone, une adresse e-mail, une adresse, un rôle, un matricule
 * et un statut.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un membre du personnel ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */

// Inclusion des classes nécessaires
require_once __DIR__ . '/Personne.php';
require_once __DIR__ . '/Scanner.php';

/**
 * Classe Personnel
 *
 * Représente un membre du personnel héritant des informations
 * personnelles définies dans la classe abstraite Personne.
 */
class Personnel extends Personne {

    /**
     * @var string Rôle du membre du personnel.
     */
    private string $role;

    /**
     * @var string Matricule du membre du personnel.
     */
    private string $matricule;

    /**
     * @var bool Statut du membre du personnel.
     */
    private bool $statut;

    /**
     * @var Scanner[] Scanners assignés au membre du personnel.
     */
    private array $scanners;

    /**
     * Constructeur de la classe Personnel.
     *
     * Initialise les informations personnelles héritées de Personne
     * ainsi que les informations propres au membre du personnel.
     *
     * @param string $nom Nom du membre du personnel.
     * @param string $prenom Prénom du membre du personnel.
     * @param string $dateNaissance Date de naissance.
     * @param string $telephone Numéro de téléphone.
     * @param string $email Adresse e-mail.
     * @param Adresse $adresse Adresse de résidence.
     * @param string $role Rôle du membre du personnel.
     * @param string $matricule Matricule du membre du personnel.
     * @param bool $statut Statut du membre du personnel.
     * @param Scanner[] $scanners Scanners assignés au membre du personnel.
     */
    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $telephone,
        string $email,
        Adresse $adresse,
        string $role,
        string $matricule,
        bool $statut,
        array $scanners = []
    ) {
        parent::__construct($nom, $prenom, $dateNaissance, $telephone, $email, $adresse);
        $this->role = $role;
        $this->matricule = $matricule;
        $this->statut = $statut;
        $this->scanners = $scanners;
    }

    /**
     * Retourne le rôle du membre du personnel.
     *
     * @return string Rôle du membre du personnel.
     */
    public function getRole(): string {
        return $this->role;
    }

    /**
     * Retourne le matricule du membre du personnel.
     *
     * @return string Matricule du membre du personnel.
     */
    public function getMatricule(): string {
        return $this->matricule;
    }

    /**
     * Retourne le statut du membre du personnel.
     *
     * @return bool Statut du membre du personnel.
     */
    public function getStatut(): bool {
        return $this->statut;
    }
    
    /**
     * Retourne les scanners assignés au membre du personnel.
     *
     * @return Scanner[] Scanners assignés au membre du personnel.
     */
    public function getScanners(): array {
        return $this->scanners;
    }
}
