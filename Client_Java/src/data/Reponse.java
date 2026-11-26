package data;

/**
 * Représente la réponse reçue du serveur après une demande de scan.
 * 
 * <p>
 * La réponse contient le statut de l'opération ainsi qu'un message
 * décrivant son résultat.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */
public class Reponse {
	
	/**
     * Statut de l'opération de scan.
     */
	private String statut;
	
	/**
     * Nom complet du passager associé au billet.
     */
	private String passager;
	
	/**
     * Numéro du siège attribué au passager.
     */
	private String siege;
	
	/**
     * Message décrivant le résultat de l'opération.
     */
	private String message;
	
	public Reponse(String statut, String passager, String siege, String message) {
		this.statut = statut;
		this.passager = passager;
		this.siege = siege;
		this.message = message;
	}

	/**
     * Retourne le statut de l'opération.
     *
     * @return statut de l'opération
     */
	public String getStatut() {
		return statut;
	}
	
	/**
     * Retourne le nom complet du passager.
     *
     * @return nom complet du passager
     */
	public String getPassager() {
		return passager;
	}

	/**
     * Retourne le numéro du siège attribué.
     *
     * @return numéro du siège
     */
	public String getSiege() {
		return siege;
	}

	/**
     * Retourne le message associé à la réponse.
     *
     * @return message de la réponse
     */
	public String getMessage() {
		return message;
	}
	
	/**
	 * Retourne une représentation textuelle de la réponse.
	 *
	 * @return représentation textuelle de la réponse
	 */
	@Override
	public String toString() {
		StringBuilder affichage = new StringBuilder();
		affichage.append("Statut : ").append(this.getStatut()).append("\n");
		
		if (passager != null) {
			affichage.append("Passager : ").append(this.getPassager()).append("\n");
		}
		if (siege != null) {
			affichage.append("Siège : ").append(this.getSiege()).append("\n");
		}
		
		affichage.append("Message : ").append(this.getMessage()).append("\n");
		return affichage.toString();
	}
}
