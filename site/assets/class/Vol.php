<?php
declare(strict_types=1);

/**
 * Vol.php - Classe de représentation d'un vol
 *
 * Cette classe permet de représenter un vol et de gérer
 * ses différentes informations à travers des attributs privés.
 *
 * Chaque vol est caractérisé par un identifiant, un numéro,
 * une date de départ, une heure de départ etune heure d'arrivée.
 * 
 * Chaque vol est associé à un aéroport de départ et un aéroport d'arrivée.
 * Chaque vol est associé à une adresse et à un avion.
 *
 * La classe fournit un constructeur pour initialiser les informations
 * d'un vol ainsi que des accesseurs (getters) permettant de consulter
 * ses différents attributs.
 * 
 * Versions :
 *      - 1.0 : Version initiale
 *      - 1.1 : Ajout des aéroports de départ et d'arrivée. Ajout de 
 *              l'adresse de l'aéroport et de l'avion associé au vol.    
 *
 * @author Alexandre BURIN
 * @version 1.1
 */

// Inclusion des classes
require_once __DIR__ . '/Aeroport.php';
require_once __DIR__ . '/Avion.php';

/**
 * Classe Vol
 *
 * Représente un vol et regroupe l'ensemble de ses
 * informations dans un objet unique.
 */
class Vol {

    /**
     * @var int Identifiant unique du vol.
     */
    private int $id;

    /**
     * @var string Numéro du vol.
     */
    private string $numero;

    /**
     * @var string Date de départ du vol.
     */
    private string $date_depart;

    /**
     * @var string Heure de départ du vol.
     */
    private string $heure_depart;

    /**
     * @var string Heure d'arrivée du vol.
     */
    private string $heure_arrivee;

    /**
     * @var Aeroport Aéroport de départ pour le vol
     */
    private Aeroport $aeroport_depart;

    /**
     * @var Aeroport Aéroport d'arrivée pour le vol
     */
    private Aeroport $aeroport_arrivee;

    /**
     * @var Avion Avion utilisé pour le vol
     */
    private Avion $avion;

    /**
     * Constructeur de la classe Vol.
     *
     * Initialise un nouveau vol avec l'ensemble de ses informations.
     *
     * @param int $id Identifiant unique du vol.
     * @param string $numero Numéro du vol.
     * @param string $date_depart Date de départ du vol.
     * @param string $heure_depart Heure de départ du vol.
     * @param string $heure_arrivee Heure d'arrivée du vol.
     * @param Aeroport $aeroport_depart Aéroport de départ pour le vol.
     * @param Aeroport $aeroport_arrivee Aéroport d'arrivée pour le vol.
     * @param Avion $avion Avion utilisé pour le vol.
     */
    public function __construct(
        int $id,
        string $numero,
        string $date_depart,
        string $heure_depart,
        string $heure_arrivee,
        Aeroport $aeroport_depart,
        Aeroport $aeroport_arrivee,
        Avion $avion
    ) {
        $this->id = $id;
        $this->numero = $numero;
        $this->date_depart = $date_depart;
        $this->heure_depart = $heure_depart;
        $this->heure_arrivee = $heure_arrivee;
        $this->aeroport_depart = $aeroport_depart;
        $this->aeroport_arrivee = $aeroport_arrivee;
        $this->avion = $avion;
    }

    /**
     * Récupère l'identifiant du vol.
     *
     * @return int Identifiant unique du vol.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Récupère le numéro du vol.
     *
     * @return string Numéro du vol.
     */
    public function getNumero(): string {
        return $this->numero;
    }

    /**
     * Récupère la date de départ du vol.
     *
     * @return string Date de départ du vol.
     */
    public function getDateDepart(): string {
        return $this->date_depart;
    }

    /**
     * Récupère l'heure de départ du vol.
     *
     * @return string Heure de départ du vol.
     */
    public function getHeureDepart(): string {
        return $this->heure_depart;
    }

    /**
     * Récupère l'heure d'arrivée du vol.
     *
     * @return string Heure d'arrivée du vol.
     */
    public function getHeureArrivee(): string {
        return $this->heure_arrivee;
    }

    /**
     * Récupère l'aéroport de départ du vol.
     *
     * @return Aeroport Aéroport de départ pour le vol.
     */
    public function getAeroportDepart(): Aeroport {
        return $this->aeroport_depart;
    }

    /**
     * Récupère l'aéroport d'arrivée du vol.
     *
     * @return Aeroport Aéroport d'arrivée pour le vol.
     */
    public function getAeroportArrivee(): Aeroport {
        return $this->aeroport_arrivee;
    }

    /**
     * Récupère l'avion utilisé pour le vol.
     *
     * @return Avion Avion utilisé pour le vol.
     */
    public function getAvion(): Avion {
        return $this->avion;
    }
}
