<?php 
declare(strict_types=1);

/**
 * Aeroport.php - Classe de représentation d'un aéroport
 *
 * Cette classe permet de représenter un aéroport et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque aéroport est caractérisé par un identifiant, un nom,
 * un code IATA et une adresse.
 *
 * La classe utilise la composition d'objets en intégrant une instance
 * de la classe Adresse afin de représenter les informations
 * géographiques de l'aéroport.
 *
 * Elle fournit un constructeur pour initialiser les informations
 * d'un aéroport ainsi que des accesseurs (getters) permettant
 * de consulter ses différents attributs.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0.0
 */

// Inclusion des classes objets
require_once __DIR__ . '/Adresse.php';

/**
 * Classe Aeroport
 *
 * Représente un aéroport et regroupe l'ensemble de ses
 * informations dans un objet unique.
 */
class Aeroport {

    /**
     * @var int Identifiant unique de l'aéroport.
     */
    private int $id;

    /**
     * @var string Nom de l'aéroport.
     */
    private string $nom;

    /**
     * @var string Code IATA de l'aéroport.
     */
    private string $code_iata;

    /**
     * @var Adresse Adresse de l'aéroport.
     */
    private Adresse $adresse;
    
    /**
     * Constructeur de la classe Aeroport.
     *
     * Initialise un nouvel aéroport avec l'ensemble de ses informations.
     *
     * @param int $id Identifiant unique de l'aéroport.
     * @param string $nom Nom de l'aéroport.
     * @param string $code_iata Code IATA de l'aéroport.
     * @param Adresse $adresse Adresse de l'aéroport.
     */
    public function __construct(
        int $id,
        string $nom,
        string $code_iata,
        Adresse $adresse
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->code_iata = $code_iata;
        $this->adresse = $adresse;
    }
    
    /**
     * Récupère l'identifiant de l'aéroport.
     *
     * @return int Identifiant unique de l'aéroport.
     */
    public function getId(): int {
        return $this->id;
    }
    
    /**
     * Récupère le nom de l'aéroport.
     *
     * @return string Nom de l'aéroport.
     */
    public function getNom(): string {
        return $this->nom;
    }
    
    /**
     * Récupère le code IATA de l'aéroport.
     *
     * @return string Code IATA de l'aéroport.
     */
    public function getCodeIata(): string {
        return $this->code_iata;
    }
    
    /**
     * Récupère l'adresse de l'aéroport.
     *
     * @return Adresse Objet représentant l'adresse de l'aéroport.
     */
    public function getAdresse(): Adresse {
        return $this->adresse;
    }
}
