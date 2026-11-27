"""
Module : serveur.py

Description :
    Ce module assure le fonctionnement du serveur Aérogate.

    Il permet d'établir des connexions avec les clients, de recevoir
    leurs demandes au format JSON, de vérifier les informations des
    billets auprès de la base de données et de leur transmettre une
    réponse.

    Les événements importants sont enregistrés dans un journal.
    Celui-ci utilise un fichier avec rotation automatique et bascule
    vers la console en cas d'erreur d'accès au fichier.

Auteur : Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
Version : 1.0
"""

# Importation des modules et constantes
import json
import logging
import os
import socket
import psycopg

from logging import Logger
from logging.handlers import RotatingFileHandler
from config.constantes import *
from traitement.verifs import verifier_billet

def init_journal(nom_log: str = NOM_LOG, fichier_log: str = NOM_FICHIER_LOG) -> Logger:
    """
    Initialise le journal du serveur.

    Configure le logger du serveur avec le niveau INFO et désactive
    la propagation des messages vers les loggers parents.

    Les messages sont enregistrés dans un fichier avec rotation
    automatique. Si le fichier ne peut pas être créé ou ouvert,
    les messages sont redirigés vers la console.

    :return: Logger configuré pour le serveur.
    """
    # Initialisation du journal
    journal = logging.getLogger(nom_log)
    journal.setLevel(logging.INFO)
    journal.propagate = False

    if not journal.handlers:
        # Emplacement du fichier log
        dossier_parent = os.path.dirname(os.path.dirname(__file__))
        dossier_logs = os.path.join(dossier_parent, "logs")

        try:
            # Création du dossier et du fichier
            os.makedirs(dossier_logs, exist_ok=True)
            gestionnaire = RotatingFileHandler(
                os.path.join(dossier_logs, fichier_log),
                maxBytes=2_000_000, backupCount=3, encoding="utf-8",
            )
        except OSError:
            # En cas de répertoire non accessible.
            gestionnaire = logging.StreamHandler()

        # Affichage de l'heure, la date et du temps de traitement
        gestionnaire.setFormatter(logging.Formatter(
            "%(asctime)s | %(levelname)s | %(message)s"
        ))

        # Ajout des informations avant chaque demande
        journal.addHandler(gestionnaire)
    return journal

def lecture_demande(adresse_ip_client: str, connexion: socket.socket, journal: Logger) -> dict:
    """
        Lit et vérifie la demande envoyée par un client.

        Récupère le message transmis par le client, vérifie sa longueur
        et son format JSON, puis retourne les données sous forme de
        dictionnaire.

        Les informations relatives à la demande sont enregistrées dans
        le journal, sans exposer les données personnelles du passager.

        :param adresse_ip_client: Adresse IP du client connecté.
        :param connexion: Socket associé à la connexion du client.
        :param journal: Logger utilisé pour enregistrer les événements.
        :return: Dictionnaire contenant les données de la demande.
        """
    try:
        # Lecture de l'entrée
        with connexion.makefile("r", encoding="utf-8") as entree:
            ligne = entree.readline(NB_MAX_CHAR_REPONSE)

        # Vérification de l'entrée
        if not ligne.endswith("\n") or len(ligne) >= NB_MAX_CHAR_REPONSE:
            raise ValueError("Message incomplet ou trop long.")

        # Lecture du format de l'entrée en JSON
        demande = json.loads(ligne)

        # Vérification du format JSON
        if not isinstance(demande, dict):
            raise ValueError("Le format utilsé n'est pas JSON.")

        # Ne pas journaliser les noms, mots de passe ou données de passeport.
        journal.info(
            "%s | client=%s | billet=%r | scanner=%r | agent=%r",
            STATUT_DEMANDE, adresse_ip_client, demande.get("id_billet"),
            demande.get("id_scan"), demande.get("id_agent"),
        )

        # Évaluation des données
        reponse = verifier_billet(demande)
    except (ValueError, UnicodeError) as erreur:
        reponse = {"statut": STATUT_ERREUR_REQUETE, "message": str(erreur)}
    except OSError:
        reponse = {"statut": STATUT_ERREUR_REQUETE, "message": "Communication interrompue."}
    except psycopg.Error:
        reponse = {"statut": STATUT_ERREUR_SERVEUR, "message": "Base de données indisponible."}
    return reponse

def lancer_serveur() -> None:
    """
    Lance le serveur Aérogate.

    Initialise le socket serveur, attend les connexions des clients
    et traite leurs demandes successivement.

    Chaque demande est reçue au format JSON, vérifiée puis transmise
    à la fonction de contrôle des billets. Une réponse JSON est ensuite
    envoyée au client.

    Les événements de connexion, les demandes et les résultats sont
    enregistrés dans le journal.
    """
    # Journalisation des contrôles sans modifier le protocole client-serveur.
    journal = init_journal()

    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as serveur:
        # Initialisation du serveur
        serveur.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        serveur.bind((HOTE_SERVEUR, PORT_SERVEUR))
        serveur.listen(MAX_CLIENTS)

        # Mise à jour dans le log
        print(f"Serveur AeroGate disponible sur {HOTE_SERVEUR}:{PORT_SERVEUR}", end="\n\n")
        journal.info("%s | hote=%s | port=%s", STATUT_DEMANDE, HOTE_SERVEUR, PORT_SERVEUR)

        while True:
            # Récupération du client
            connexion, adresse = serveur.accept()
            adresse_ip_client = adresse[0]

            with connexion:
                # Initialisation du temps de connexion
                connexion.settimeout(TIMEOUT_CONNEXION)

                # Mise à jour du log
                print(f"Connexion du client {adresse_ip_client}")
                journal.info("%s | client=%s", STATUT_CONNEXION, adresse_ip_client)

                reponse = lecture_demande(adresse_ip_client, connexion, journal)

                # Résultat de la demande
                niveau = logging.INFO if reponse["statut"] == STATUT_REPONSE_CORRECTE else logging.WARNING
                journal.log(
                    niveau, "%s | client=%s | statut=%s | message=%s",
                    STATUT_RESULTAT, adresse_ip_client, reponse["statut"], reponse.get("message", ""),
                )

                # Envoi de la réponse au client
                try:
                    connexion.sendall((json.dumps(reponse, ensure_ascii=False) + "\n").encode("utf-8"))
                    print(f"Message envoyé au client : {adresse_ip_client}", end="\n\n")
                except OSError:
                    print("Connexion interrompue avant la réponse.")
                    journal.warning(" %s| client=%s", STATUT_DECONNEXION_PREMATUREE, adresse_ip_client)

def main() -> None:
    """
    Point d'entrée principal du serveur.

    Lance le serveur et intercepte l'interruption clavier afin
    de permettre un arrêt propre du programme.
    """
    # Lancement du serveur
    try:
        lancer_serveur()
    except KeyboardInterrupt:
        print("\nServeur arrêté.")

# Lancement du programme
if __name__ == "__main__":
    main()