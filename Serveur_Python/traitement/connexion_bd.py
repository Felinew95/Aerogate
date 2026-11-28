"""
Module : connexion_bd.py

Description :
    Ce module permet de gérer la connexion à une base de données PostgreSQL.
    Il charge les paramètres de connexion depuis un fichier .env et fournit
    les fonctions nécessaires à l'ouverture, à l'interrogation et à la
    fermeture de la connexion.

Auteur : Alexandre BURIN, Menaouer AMMARI, Hugo DELHELLE
Version : 1.0
"""

# Importation des modules
from psycopg import Connection, Cursor, connect
from psycopg.rows import dict_row

def ouvrir_connexion_bd(
        host: str | None,
        port: str | None,
        user: str | None,
        password: str | None,
        dbname: str | None
):
    """
    Ouvre une connexion à la base de données PostgreSQL.

    :param host: Adresse de l'hôte de la base de données.
    :param port: Port de connexion à la base de données.
    :param user: Nom de l'utilisateur de la base de données.
    :param password: Mot de passe de connexion.
    :param dbname: Nom de la base de données.
    :return: Connexion à la base de données.
    """
    # Ouverture de la connexion
    connexion = connect(
        host=host,
        port=port,
        user=user,
        password=password,
        dbname=dbname
    )

    return connexion

def recup_curseur(
        host: str | None,
        port: str | None,
        user: str | None,
        password: str | None,
        dbname: str | None
) -> tuple[Connection, Cursor]:
    """
    Établit une connexion à la base de données et récupère un curseur.

    :param host: Adresse de l'hôte de la base de données.
    :param port: Port de connexion à la base de données.
    :param user: Nom de l'utilisateur de la base de données.
    :param password: Mot de passe de connexion.
    :param dbname: Nom de la base de données.
    :return: Tuple contenant la connexion et le curseur.
    :raises SystemExit: Si une erreur survient lors de la connexion.
    """
    try:
        # Ouverture de la connexion
        connexion = ouvrir_connexion_bd(
            host=host,
            port=port,
            user=user,
            password=password,
            dbname=dbname
        )

        return connexion, connexion.cursor(row_factory=dict_row)
    except Exception as err:
        print(f"Erreur lors de la connexion : {err}")
        exit(1)

def fermer_connexion(connexion: Connection, curseur: Cursor) -> None:
    """
    Ferme le curseur puis la connexion à la base de données.

    :param connexion: Connexion à fermer.
    :param curseur: Curseur à fermer.
    :return: None.
    """

    # Fermeture du curseur
    curseur.close()

    # Fermeture de la connexion
    connexion.close()