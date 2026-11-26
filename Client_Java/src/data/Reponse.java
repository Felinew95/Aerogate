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
     * Message décrivant le résultat de l'opération.
     */
	private String message;
	
	/**
     * Initialise une réponse avec son statut et son message.
     *
     * @param statut statut de l'opération
     * @param message message associé à la réponse
     */
	public Reponse(String statut, String message) {
		this.statut = statut;
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
		return "Statut : " + this.getStatut() + "\n" +
			   "Message : " + this.getMessage() + "\n";
	}
}
