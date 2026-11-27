"""
Module : verifs.py

Description :
    Ce module permet de vérifier les informations d'un billet d'embarquement
    transmises par un client, de contrôler les autorisations de l'agent
    et de générer une réponse adaptée au résultat des vérifications.

Auteur : Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
Version : 1.0
"""

# Importation des modules et constantes
from config.constantes import REQUETE_INFOS_BILLET, LISTE_IDS, LISTE_PORTE_ET_VOL, HOTE_DEFAUT_DB, PORT_DEFAUT_DB, \
    USER_DEFAUT_DB, PASSWD_DEFAUT_DB, NOM_DB, REQUETE_INFOS_AGENT, LISTE_STATUT_AGENT
from traitement.connexion_bd import fermer_connexion, recup_curseur

def verifier_porte_et_num_vol(demande: dict) -> None:
    """
    Vérifie la conformité de la porte d'embarquement et du numéro de vol.

    Chaque champ doit contenir une chaîne de caractères ASCII
    alphanumérique dont la longueur respecte la limite configurée.

    :param demande: Dictionnaire contenant les données de la demande
    :return: None si les champs sont conformes
    :raises ValueError: si un champ est absent ou incorrect
    """
    for champ, taille in LISTE_PORTE_ET_VOL:
        # Récupération de la valeur
        valeur = demande.get(champ)

        # Vérification de la conformité des données
        if not isinstance(valeur, str) or not 1 <= len(valeur) <= taille or not valeur.isascii() or not valeur.isalnum():
            raise ValueError(f"Champ incorrect : {champ}.")

def verifier_identifiants(demande: dict) -> None:
    """
    Vérifie la validité des identifiants présents dans la demande.

    Chaque identifiant doit être un entier strictement positif.
    Les valeurs booléennes sont également rejetées.

    :param demande: Dictionnaire contenant les données de la demande
    return: None si les identifiants sont conformes
    :raises ValueError: Si un identifiant est absent ou incorrect
    """
    for champ in LISTE_IDS:
        # Récupération de la valeur
        valeur = demande.get(champ)

        # Vérification du type
        if type(valeur) is not int or valeur <= 0:
            raise ValueError(f"Identifiant incorrect : {champ}.")

def verifier_billet(demande: dict) -> dict:
    """
    Vérifie un billet d'embarquement à partir d'une demande client.

    La fonction valide le format et les données de la demande,
    récupère les informations du billet et de l'agent dans la base
    de données, puis génère une réponse selon le résultat des contrôles.

    :param demande: Données transmises par le client
    :return: Réponse contenant le statut et le message de vérification,
             ainsi que les informations du passager si les contrôles
             sont conformes
    :raises ValueError: Si la demande ou ses données sont incorrectes
    """
    # Vérification des données
    verifier_porte_et_num_vol(demande)
    verifier_identifiants(demande)

    # Connexion
    connexion, curseur = recup_curseur(
        host=HOTE_DEFAUT_DB,
        port=PORT_DEFAUT_DB,
        user=USER_DEFAUT_DB,
        password=PASSWD_DEFAUT_DB,
        dbname=NOM_DB
    )

    try:
        # Récupération du billet
        billet = curseur.execute(
            REQUETE_INFOS_BILLET,
            (demande["id_billet"],),
        ).fetchone()

        agent = curseur.execute(
            REQUETE_INFOS_AGENT,
            (demande["id_scan"], demande["id_agent"]),
        ).fetchone()
    finally:
        # Fermeture de la connexion, même en cas d’erreur SQL
        fermer_connexion(connexion, curseur)

    # Création de la réponse
    return creer_reponse(agent, billet, demande)

def creer_reponse(agent: dict, billet: dict, demande: dict) -> dict:
    """
    Génère la réponse correspondant aux résultats des vérifications.

    La fonction vérifie successivement l'existence du billet,
    les autorisations de l'agent, la porte d'embarquement
    et le numéro de vol.

    :param agent: Informations de l'agent récupérées en base
    :param billet: Informations du billet récupérées en base
    :param demande: Données transmises par le client
    :return: Réponse contenant le statut et le message de contrôle.
             En cas de contrôles conformes, elle contient également
             le nom du passager et son numéro de siège
    """
    # Vérification de l'existence du billet
    if not billet:
        return {"statut": "REFUSE", "message": "Billet introuvable."}

    # Vérification du statut de l'agent
    if not agent or not agent["statut_personnel"] or agent["role_personnel"] not in LISTE_STATUT_AGENT:
        return {"statut": "REFUSE", "message": "Agent non autorisé sur ce scanner."}

    # Vérification de la cohérence des portes
    if billet["porte"].upper() != demande["porte"].upper():
        return {"statut": "REFUSE", "message": "Porte incorrecte."}

    # Vérification de la porte du scanner
    if agent["porte"].upper() != demande["porte"].upper():
        return {"statut": "REFUSE", "message": "Scanner affecté à une autre porte."}

    # Vérification de la cohérence des numéros de vol
    if billet["numero_vol"].upper() != demande["numero_vol"].upper():
        return {"statut": "REFUSE", "message": "Numéro de vol incorrect."}

    # Réponse classique
    return {
        "statut": "CONTROLES_CONFORMES",
        "passager": billet["prenom_pers"] + " " + billet["nom_pers"],
        "siege": billet["numero_siege"],
        "message": "Vérification réussie.",
    }
