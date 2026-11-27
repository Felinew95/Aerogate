package util;

import java.util.HashMap;
import java.util.Map;

import config.ConfigClient;

import data.Reponse;

/**
 * Fournit des méthodes pour manipuler des données JSON simples.
 *
 * @author Alexandre BURIN
 * @version 1.0
 */
public class JsonUtil {
	
	/**
	 * Convertit une chaîne JSON en objet Reponse.
	 *
	 * <p>
	 * Le JSON doit contenir les clés "statut", "passager",
	 * "siege" et "message", associées à des valeurs textuelles.
	 *
	 * @param json chaîne JSON à convertir
	 * @return réponse correspondant aux données JSON
	 * @throws IllegalArgumentException si le format JSON est invalide
	 *                                  ou si une propriété est mal formée
	 */
	public static Reponse creerReponse(String json) throws IllegalArgumentException {
		// Vérification du format
		json = json.strip();
        if (!json.startsWith("{") || !json.endsWith("}")) {
            throw new IllegalArgumentException("Format JSON invalide.");
        }
		
		// Retrait des accolades
		json = json.substring(1, json.length()-1).strip();
		
		// Création du dictionnaire 
		Map<String, String> valeurs = new HashMap<String, String>();
		
		// Séparation des différentes propriétés
		String[] props = json.split(",", ConfigClient.MAX_PROPRIETES);
		if (props.length != 2 && props.length != 4) {
			throw new IllegalArgumentException("Nombre de propriétés JSON invalide.");
		}
		
		// Construction du dictionnaire
		for (String prop: props) {
			String[] elts = prop.split(":", 2);
			
			if (elts.length != 2) {
                throw new IllegalArgumentException(
                        "Propriété JSON invalide : " + prop
                );
            }
			
			// Nettoyage de la clé et de la valeur
            String cle = elts[0].strip().replace("\"", "");
            String valeur = elts[1].strip().replace("\"", "");
			
			valeurs.put(cle, valeur);
		}
				
		return new Reponse(
				valeurs.get(ConfigClient.CLE_STATUT_REPONSE),
				valeurs.get(ConfigClient.CLE_PASSAGER_REPONSE),
				valeurs.get(ConfigClient.CLE_SIEGE_REPONSE),
				valeurs.get(ConfigClient.CLE_MESSAGE_REPONSE)
		);
	}
}
