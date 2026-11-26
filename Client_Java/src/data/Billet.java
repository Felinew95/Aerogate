package data;

import java.util.Locale;

/**
 * Représente un billet utilisé lors d'une opération de scan à l'embarquement.
 * 
 * <p>
 * La classe contient les informations relatives au billet, au scanner,
 * à l'agent et au vol. Elle permet également de convertir les données
 * du billet au format JSON.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */
public class Billet {
	
	/**
     * Identifiant du billet.
     */
	private int idBillet;
	
	/**
     * Identifiant du scanner utilisé.
     */
	private int idScanner;
	
	/**
     * Identifiant de l'agent responsable du scan.
     */
	private int idAgent;
	
	/**
     * Porte d'embarquement associée au billet.
     */
	private String porte;
	
	/**
     * Numéro du vol associé au billet.
     */
	private String numeroVol;
	
	/**
     * Initialise un billet avec les informations nécessaires
     * à son identification et à son scan.
     *
     * @param idBillet identifiant du billet
     * @param idScanner identifiant du scanner
     * @param idAgent identifiant de l'agent
     * @param porte porte d'embarquement
     * @param numeroVol numéro du vol
     */
	public Billet(int idBillet, int idScanner, int idAgent, String porte, String numeroVol) {
		this.idBillet = idBillet;
		this.idScanner = idScanner;
		this.idAgent = idAgent;
		this.porte = porte;
		this.numeroVol = numeroVol;
	}

	/**
     * Retourne l'identifiant du billet.
     *
     * @return identifiant du billet
     */
	public int getIdBillet() {
		return idBillet;
	}

	/**
     * Retourne l'identifiant du scanner.
     *
     * @return identifiant du scanner
     */
	public int getIdScanner() {
		return idScanner;
	}
	
	/**
     * Retourne l'identifiant de l'agent.
     *
     * @return identifiant de l'agent
     */
	public int getIdAgent() {
		return idAgent;
	}
	
	/**
     * Retourne la porte d'embarquement.
     *
     * @return porte d'embarquement
     */
	public String getPorteEmbarquement() {
		return porte;
	}
	
	/**
     * Retourne le numéro du vol.
     *
     * @return numéro du vol
     */
	public String getNumeroVol() {
		return numeroVol;
	}
	
	/**
     * Convertit les informations du billet en une chaîne au format JSON.
     *
     * @return représentation JSON du billet
     */
	public String toJSON() {
		return String.format(
				Locale.ROOT,
				"{\"id_billet\":%d,\"id_scan\":%d,\"id_agent\":%d,\"porte\":\"%s\",\"numero_vol\":\"%s\"}",
				this.getIdBillet(), 
				this.getIdScanner(), 
				this.getIdAgent(), 
				this.getPorteEmbarquement(), 
				this.getNumeroVol()
		);
	}
	
	/**
     * Retourne une représentation textuelle du billet.
     *
     * @return représentation textuelle du billet
     */
	@Override
	public String toString() {
		return "Billet [idBillet=" + idBillet + ", idScanner=" + idScanner + ", idAgent=" + idAgent
				+ ", porteEmbarquement=" + porte + ", numeroVol=" + numeroVol + "]";
	}	
}
