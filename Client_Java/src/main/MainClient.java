package main;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;

import java.net.InetSocketAddress;
import java.net.Socket;

import java.nio.charset.StandardCharsets;

import java.util.Locale;
import java.util.Scanner;

import config.ConfigClient;

import data.Billet;
import data.Reponse;
import util.JsonUtil;

/**
 * Point d'entrée du client chargé de transmettre les demandes de scan
 * de billets au serveur.
 * 
 * <p>
 * La classe permet de saisir les informations d'un billet depuis
 * la console, de vérifier leur validité et de communiquer avec
 * le serveur à l'aide d'une connexion TCP.
 *
 * @author Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
 * @version 1.0
 */
public class MainClient {
	
	/**
     * Récupère les informations d'un billet depuis la console
     * et vérifie leur validité.
     * 
     * <p>
     * Les identifiants doivent être strictement positifs.
     * La porte d'embarquement et le numéro du vol doivent
     * respecter les expressions régulières définies dans
     * la configuration du client.
     *
     * @param clavier scanner utilisé pour lire les saisies
     * @return billet créé si les données sont valides,
     *         null dans le cas contraire
     * @throws NumberFormatException si un identifiant
     *         ne peut pas être converti en entier
     */
	private static Billet creerBilletViaCMD(Scanner clavier) throws NumberFormatException {
		// Récupération de l'identifiant du billet 
		System.out.print("Identifiant du billet : ");
		int id_billet = Integer.parseInt(clavier.nextLine().strip());
		
		// Récupération de l'identifiant du scanner
		System.out.print("Identifiant du scanner : ");
		int id_scanner = Integer.parseInt(clavier.nextLine().strip());
		
		// Récupération de l'identifiant de l'agent
		System.out.print("Identifiant de l'agent : ");
		int id_agent = Integer.parseInt(clavier.nextLine().strip());
		
		// Récupération du numéro de la porte d'embarquement
		System.out.print("Porte d'embarquement : ");
		String porte_embarquement = clavier.nextLine().strip().toUpperCase(Locale.ROOT);

		// Récupération du numéro du vol
		System.out.print("Numero du vol : ");
		String numero_vol = clavier.nextLine().strip().toUpperCase(Locale.ROOT);

		// Reconstitution du billet 
		return (
				id_billet <= 0 || 
				id_scanner <= 0 || 
				id_agent <= 0 || 
				!porte_embarquement.matches(ConfigClient.REGEX_PORTE_EMBARQUEMENT) || 
				!numero_vol.matches(ConfigClient.REGEX_NUMERO_VOL)
				) ? 
				null : 
				new Billet(id_billet, id_scanner, id_agent, porte_embarquement, numero_vol);
	}
	
	/**
     * Établit une connexion avec le serveur, lui transmet une demande
     * au format JSON et affiche la réponse reçue.
     * 
     * <p>
     * La communication utilise une connexion TCP et des flux
     * encodés en UTF-8.
     *
     * @param hote adresse du serveur
     * @param demande demande JSON à transmettre au serveur
     * @throws IOException si une erreur survient lors
     *         de la connexion ou de la communication
     */
	private static void reponseServeur(String hote, int port, String demande) throws IOException {
		try (Socket connexion = new Socket()) {
		    // Connexion au serveur
		    connexion.connect(new InetSocketAddress(hote, port), ConfigClient.TIMEOUT_CONNECTION);

		    // Préparation des flux de communication
		    BufferedWriter sortie = new BufferedWriter(
		            new OutputStreamWriter(connexion.getOutputStream(), StandardCharsets.UTF_8));
		    BufferedReader entree = new BufferedReader(
		            new InputStreamReader(connexion.getInputStream(), StandardCharsets.UTF_8));
		    
		    // Envoi des données au serveur
		    sortie.write(demande);
		    sortie.newLine();

		    // Vide la mémoire tampon
		    sortie.flush();

		    // Réception de la réponse du serveur   
		    String json = entree.readLine();
		    if (json == null || json.isBlank()) {	
		    	System.out.println("Aucune reponse du serveur.");
		    	return;
		    }
		    
		    // Extraction des informations de la réponse 
		    Reponse obj_reponse = JsonUtil.creerReponse(json);

		    // Affichage de la réponse
		    System.out.println(obj_reponse);
		}
	}
	
	/**
     * Lance le client.
     * 
     * <p>
     * L'adresse du serveur peut être fournie en argument.
     * Si aucun argument n'est renseigné, l'adresse par défaut
     * définie dans la configuration est utilisée.
     * 
     * <p>
     * La méthode récupère les informations du billet,
     * vérifie leur validité puis transmet la demande au serveur.
     *
     * @param args arguments de lancement, le premier pouvant
     *             contenir l'adresse du serveur
     */
	public static void main(String[] args) {
        try (Scanner clavier = new Scanner(System.in)) {
        	// Recherche de l'hôte et du port de connexion
            String hote = args.length >= 1 ? args[0] : ConfigClient.HOST_DEFAUT;
            int port = args.length == 2 ? Integer.parseInt(args[1]) : ConfigClient.PORT_DEFAUT;
            
        	// Création du billet 
            Billet billet = creerBilletViaCMD(clavier);
            
            // Vérification de la création
            if (billet == null) {
            	System.out.println("Saisie incorrecte.");
            	return;
            }
            System.out.println("\n");
            
            // Construction de la demande JSON
            String demande = billet.toJSON();
            
            // Réponse du serveur 
            reponseServeur(hote, port, demande);
        } catch (NumberFormatException erreur) {
            System.out.println("Le port ou les identifiants doivent être des entiers.");
        } catch (IOException erreur) {
            System.out.println("Communication impossible avec le serveur (" + erreur.getMessage() + ")");
        }
    }
}
