package config;

/**
 * Regroupe les constantes de configuration du client.
 * 
 * <p>
 * Cette classe contient les paramètres de connexion au serveur,
 * les expressions régulières de validation des données
 * et les clés utilisées dans les réponses JSON.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */
public class ConfigClient {
	
	/**
     * Adresse IP par défaut du serveur.
     */
	public static final String HOST_DEFAUT = "127.0.0.1";
	
	/**
     * Port de connexion au serveur.
     */
    public static final int PORT_DEFAUT = 5000;
    
    /**
     * Délai maximal de connexion au serveur, en millisecondes.
     */
    public static final int TIMEOUT_CONNECTION = 10000;
    
    /**
     * Expression régulière permettant de valider une porte
     * d'embarquement composée de 1 à 5 caractères alphanumériques.
     */
    public static final String REGEX_PORTE_EMBARQUEMENT = "[A-Z0-9]{1,5}";
    
    /**
     * Expression régulière permettant de valider un numéro de vol
     * composé de 1 à 20 caractères alphanumériques.
     */
    public static final String REGEX_NUMERO_VOL = "[A-Z0-9]{1,20}";
    
    /**
     * Clé JSON correspondant au statut de la réponse du serveur.
     */
    public static final String CLE_STATUT_REPONSE = "statut";
    
    /**
     * Clé JSON contenant le nom complet du passager.
     */
    public static final String CLE_PASSAGER_REPONSE = "passager";
    
    /**
     * Clé JSON contenant le numéro du siège du passager.
     */
    public static final String CLE_SIEGE_REPONSE = "siege";
    
    /**
     * Clé JSON correspondant au message de la réponse du serveur.
     */
    public static final String CLE_MESSAGE_REPONSE = "message";
}
