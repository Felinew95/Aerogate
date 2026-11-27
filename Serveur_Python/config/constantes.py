"""
Module : Constantes de configuration du serveur

Description :
    Ce module regroupe les paramètres de connexion à la base de données,
    les champs attendus dans les demandes client, les statuts autorisés
    ainsi que les requêtes SQL utilisées pour les vérifications.

Auteur : Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
Version : 1.0
"""

# Hôte par défaut de la base de données
HOTE_DEFAUT_DB: str = "localhost"

# Port par défaut de la base de données
PORT_DEFAUT_DB: str = "5432"

# Nom par défaut de la base de données
NOM_DB: str = "postgres"

# Utilisateur par défaut de la base de données
USER_DEFAUT_DB: str = "postgres"

# Mot de passe par défaut de la base de données
PASSWD_DEFAUT_DB: str = "Stf421veve10@"

# Liste des identifiants
LISTE_IDS: tuple = ("id_billet", "id_scan", "id_agent")

# Liste de la porte et numéro de vol avec la limite maximale de caractères
LISTE_PORTE_ET_VOL: tuple = (("porte", 5), ("numero_vol", 20))

# Liste des statuts d'un agent
LISTE_STATUT_AGENT: tuple = ("Embarquement", "Controle", "Superviseur")

# Requête pour obtenir les informations du billet
REQUETE_INFOS_BILLET: str = """
            SELECT b.porte, b.numero_siege, v.numero_vol,
                   p.nom_pers, p.prenom_pers
            FROM billet b
            JOIN vol v ON v.id_vol = b.id_vol
            JOIN passager pa ON pa.id_pers = b.id_pers
            JOIN personne p ON p.id_pers = pa.id_pers
            WHERE b.id_billet = %s
            """

# Requête pour obtenir les informations de l'agent concerné
REQUETE_INFOS_AGENT: str = """
            SELECT p.role_personnel, p.statut_personnel
            FROM utilise u
            JOIN personnel p ON p.id_pers = u.id_pers
            WHERE u.id_scan = %s AND u.id_pers = %s
            """

# Nom du log
NOM_LOG: str = "Aérogate"

# Fichier des logs
NOM_FICHIER_LOG: str = "aerogate.log"

# Adresse du serveur
HOTE_SERVEUR: str = "127.0.0.1"

# Port du serveur
PORT_SERVEUR: int = 5000

# Temps de connexion maximal au serveur
TIMEOUT_CONNEXION: int = 10

# Maximum de clients pour les demandes
MAX_CLIENTS: int = 5

# Nombre de caractères maximal dans un message
NB_MAX_CHAR_REPONSE: int = 4097

# Statut pour la demande de connexion
STATUT_DEMANDE: str = "DEMANDE"

# Statut pour tentative de connexion
STATUT_CONNEXION: str = "CONNEXION"

# Statut de résultat à la demande
STATUT_RESULTAT = "RESULTAT"

# Statut d'erreur survenu lors de la requête
STATUT_ERREUR_REQUETE: str = "ERREUR_REQUETE"

# Statut d'erreur lorsque le serveur a l'impossibilité de traité la demande
STATUT_ERREUR_SERVEUR: str = "ERREUR_SERVEUR"

# Statut de réponse correcte
STATUT_REPONSE_CORRECTE: str = "CONTROLES_CONFORMES"

# Statut si le client quitte de manière imprévue avant envoi de la réponse
STATUT_DECONNEXION_PREMATUREE: str = "DECONNEXION_PREMATUREE"