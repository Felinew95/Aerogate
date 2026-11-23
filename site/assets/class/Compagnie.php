<?php
declare(strict_types=1);

/**
 * Compagnie.php - Classe de représentation d'une compagnie aérienne
 *
 * Cette classe permet de représenter une compagnie aérienne et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque compagnie est caractérisée par un identifiant, un nom,
 * un code IATA, un numéro de téléphone et une adresse.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'une compagnie ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 * 
 * Versions :
 *     - 1.0 : Version initiale
 *     - 1.1 : Ajout de l'adresse de la compagnie
 *
 * @author Alexandre BURIN
 * @version 1.1
 */

/**
 * Classe Compagnie
 *
 * Représente une compagnie aérienne et regroupe l'ensemble de ses
 * informations dans un objet unique.
 */
class Compagnie {

    /**
     * @var int Identifiant unique de la compagnie.
     */
    private int $id;

    /**
     * @var string Nom de la compagnie aérienne.
     */
    private string $nom;

    /**
     * @var string Code IATA de la compagnie aérienne.
     */
    private string $code_iata;

    /**
     * @var string Numéro de téléphone de la compagnie.
     */
    private string $telephone;
    
    /**
     * @var Adresse Adresse de la compagnie.
     */
    private Adresse $adresse;

    /**
     * Constructeur de la classe Compagnie.
     *
     * Initialise une nouvelle compagnie avec l'ensemble de ses informations.
     *
     * @param int $id Identifiant unique de la compagnie.
     * @param string $nom Nom de la compagnie aérienne.
     * @param string $code_iata Code IATA de la compagnie aérienne.
     * @param string $telephone Numéro de téléphone de la compagnie.
     * @param Adresse $adresse Adresse de la compagnie.
     */
    public function __construct(
        int $id,
        string $nom,
        string $code_iata,
        string $telephone,
        Adresse $adresse
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->code_iata = $code_iata;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }

    /**
     * Récupère l'identifiant de la compagnie.
     *
     * @return int Identifiant unique de la compagnie.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Récupère le nom de la compagnie.
     *
     * @return string Nom de la compagnie aérienne.
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Récupère le code IATA de la compagnie.
     *
     * @return string Code IATA de la compagnie aérienne.
     */
    public function getCodeIata(): string {
        return $this->code_iata;
    }

    /**
     * Récupère le numéro de téléphone de la compagnie.
     *
     * @return string Numéro de téléphone de la compagnie.
     */
    public function getTelephone(): string {
        return $this->telephone;
    }

    /**
     * Récupère l'adresse de la compagnie.
     *
     * @return Adresse Adresse de la compagnie.
     */
    public function getAdresse(): Adresse {
        return $this->adresse;
    }
}
