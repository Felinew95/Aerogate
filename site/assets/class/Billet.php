<?php
declare(strict_types=1);

/**
 * Billet.php - Classe de représentation d'un billet d'avion
 *
 * Cette classe permet de représenter un billet d'avion et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque billet est caractérisé par un numéro de siège, une catégorie,
 * une porte d'embarquement et un passager associé.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un billet ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 *
 * @author Alexandre BURIN
 * @version 1.0
 */

// Inclusion des classes nécessaires
require_once __DIR__ . '/Passager.php';

/**
 * Classe Billet
 *
 * Représente un billet d'avion associé à un passager.
 */
class Billet {

    /**
     * @var string Numéro de siège du billet.
     */
    private string $numero_siege;

    /**
     * @var string Catégorie du billet.
     */
    private string $categorie;

    /**
     * @var string Porte d'embarquement.
     */
    private string $porte;

    /**
     * @var Passager Passager associé au billet.
     */
    private Passager $passager;

    /**
     * Constructeur de la classe Billet.
     *
     * Initialise les informations du billet et le passager associé.
     *
     * @param string $numero_siege Numéro du billet.
     * @param string $categorie Catégorie du billet.
     * @param string $porte Porte d'embarquement.
     * @param Passager $passager Passager associé au billet.
     */
    public function __construct(
        string $numero_siege,
        string $categorie,
        string $porte,
        Passager $passager
    ) {
        $this->numero_siege = $numero_siege;
        $this->categorie = $categorie;
        $this->porte = $porte;
        $this->passager = $passager;
    }

    /**
     * Retourne le numéro du billet.
     *
     * @return string Numéro du billet.
     */
    public function getNumeroSiege(): string {
        return $this->numero_siege;
    }

    /**
     * Retourne la catégorie du billet.
     *
     * @return string Catégorie du billet.
     */
    public function getCategorie(): string {
        return $this->categorie;
    }

    /**
     * Retourne la porte d'embarquement.
     *
     * @return string Porte d'embarquement.
     */
    public function getPorte(): string {
        return $this->porte;
    }

    /**
     * Retourne le passager associé au billet.
     *
     * @return Passager Passager associé au billet.
     */
    public function getPassager(): Passager {
        return $this->passager;
    }
}