<?php
declare(strict_types=1);

/**
 * Avion.php - Classe de représentation d'un avion
 *
 * Cette classe permet de représenter un avion et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque avion est caractérisé par un identifiant, une immatriculation,
 * un modèle, une capacité en nombre de passagers et la compagnie à laquelle 
 * il appartient.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un avion ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 * 
 * Versions :
 *     - 1.0 : Version initiale
 *     - 1.1 : Ajout de la compagnie à laquelle appartient l'avion
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.1
 */

/**
 * Classe Avion
 *
 * Représente un avion et regroupe l'ensemble de ses
 * informations dans un objet unique.
 */
class Avion {

    /**
     * @var int Identifiant unique de l'avion.
     */
    private int $id;

    /**
     * @var string Immatriculation de l'avion.
     */
    private string $immatriculation;

    /**
     * @var string Modèle de l'avion.
     */
    private string $modele;

    /**
     * @var int|string Capacité maximale de l'avion.
     */
    private int|string $capacite;

    /**
     * @var Compagnie Compagnie à laquelle appartient l'avion.
     */
    private Compagnie $compagnie;

    /**
     * Constructeur de la classe Avion.
     *
     * Initialise un nouvel avion avec l'ensemble de ses informations.
     *
     * @param int $id Identifiant unique de l'avion.
     * @param string $immatriculation Immatriculation de l'avion.
     * @param string $modele Modèle de l'avion.
     * @param int|string $capacite Capacité maximale de l'avion.
     * @param Compagnie $compagnie Compagnie à laquelle appartient l'avion.
     */
    public function __construct(
        int $id,
        string $immatriculation,
        string $modele,
        int|string $capacite,
        Compagnie $compagnie
    ) {
        $this->id = $id;
        $this->immatriculation = $immatriculation;
        $this->modele = $modele;
        $this->capacite = $capacite;
        $this->compagnie = $compagnie;
    }

    /**
     * Récupère l'identifiant de l'avion.
     *
     * @return int Identifiant unique de l'avion.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Récupère l'immatriculation de l'avion.
     *
     * @return string Immatriculation de l'avion.
     */
    public function getImmatriculation(): string {
        return $this->immatriculation;
    }

    /**
     * Récupère le modèle de l'avion.
     *
     * @return string Modèle de l'avion.
     */
    public function getModele(): string {
        return $this->modele;
    }

    /**
     * Récupère la capacité de l'avion.
     *
     * @return int|string Capacité maximale de l'avion.
     */
    public function getCapacite(): int|string {
        return $this->capacite;
    }
    
    /**
     * Récupère la compagnie de l'avion.
     *
     * @return Compagnie Compagnie à laquelle appartient l'avion.
     */
    public function getCompagnie(): Compagnie {
        return $this->compagnie;
    }
}
