# AéroGate

AéroGate est une simulation d'un système de contrôle de billets d'embarquement dans un aéroport. Le projet a pour objectif de mettre en pratique les notions fondamentales de programmation réseau et de gestion de bases de données, à travers une architecture pouvant être enrichie par la suite.

L'application repose sur deux composants principaux :

- Un client Java, qui permet de transmettre les informations d'un billet à contrôler.
- Un serveur Python, qui réceptionne les demandes, interroge la base de données PostgreSQL et renvoie le résultat du contrôle.

La communication entre les deux composants s'effectue à l'aide du protocole TCP, avec des échanges de données au format JSON.

Le client Java n'accède jamais directement à la base de données : toutes les vérifications sont réalisées côté serveur.

Le code Python est principalement organisé en trois modules :

- `serveur/serveur.py` : gestion de la communication TCP avec le client Java et traitement des demandes.
- `serveur/verifs.py` : vérification des informations du billet et des autorisations associées.
- `serveur/connexion_bd.py` : gestion de la connexion à la base de données PostgreSQL.

## 1. Préparer PostgreSQL

Se connecter au serveur PostgreSQL avec la commande suivante :

```bash
psql --host <adresse_ip-ou-dns> --port <port> --username <utilisateur> --dbname <base_de_donnees>
```

Une fois connecté, créer la base de données `aerogate` :

```sql
CREATE DATABASE aerogate;
```

Se connecter ensuite à cette base :

```sql
\c aerogate
```

Pour créer les tables, exécuter le contenu du fichier `base/tables.sql` dans PostgreSQL.

Le fichier `base/insert.sql` permet ensuite d'insérer les données nécessaires aux tests.

Les scripts SQL sont prévus pour une base de données vide.

## 2. Installer la bibliothèque Psycopg pour Python

Le serveur utilise la bibliothèque psycopg pour communiquer avec PostgreSQL.

```bash
python pip install psycopg
```

## 3. Lancer le serveur

Démarrer le serveur Python avec la commande suivante depuis le répertoire Serveur_Python :

```bash
python -m main.serveur
```

Par défaut, le serveur écoute sur l'adresse locale `127.0.0.1` et le port `5000`.

## 4. Lancer le client

```bash
java -cp client ClientAeroGate
```

Si nécessaire, recompiler le programme avec Java 17 ou plus récent :

```bash
javac client/ClientAeroGate.java
```

Pour joindre le serveur depuis un autre poste :

```bash
java -cp client ClientAeroGate ADRESSE_IP_DU_SERVEUR
```

## 5. Exemples de demandes JSON

Les exemples suivants correspondent au jeu de données SQL fourni.

### 5.1. Demande correcte

Le billet `7` appartient à Lina Roux. Il est associé au scanner `3`, utilisé par l'agent `27`.
L'agent est actif et possède le rôle `Controle`.

```json
{"id_billet": 7, "id_scan": 3, "id_agent": 27, "porte": "C08", "numero_vol": "U23003"}
```

Résultat attendu : `CONTROLES_CONFORMES`.

### 5.2. Agent inactif

L'agent `31` est associé au scanner `1`, mais son statut est inactif (`FALSE`).

```json
{"id_billet": 1, "id_scan": 1, "id_agent": 31, "porte": "A12", "numero_vol": "AF1001"}
```

Résultat attendu : demande rejetée, car l'agent est inactif.

### 5.3. Numéro de vol incorrect

Le billet `7` correspond au vol `U23003`, et non au vol `AF1001`.

```json
{"id_billet": 7, "id_scan": 3, "id_agent": 27, "porte": "C08", "numero_vol": "AF1001"}
```

Résultat attendu : demande rejetée pour numéro de vol incorrect.

### 5.4. Porte incorrecte

Le billet `7` et le scanner `3` sont associés à la porte `C08`, et non à la porte `A12`.

```json
{"id_billet": 7, "id_scan": 3, "id_agent": 27, "porte": "A12", "numero_vol": "U23003"}
```

Résultat attendu : demande rejetée pour porte incorrecte.

### 5.5. Rôle de l'agent non autorisé

L'agent `25` est actif et associé au scanner `1`, mais son rôle est `Accueil`.

Ce rôle ne fait pas partie des rôles autorisés pour le contrôle.

```json
{"id_billet": 1, "id_scan": 1, "id_agent": 25, "porte": "A12", "numero_vol": "AF1001"}
```

Résultat attendu : demande rejetée pour rôle non autorisé.

## 6. Tests avec Netcat

Pour tester la communication avec le serveur, il est possible d'utiliser **Netcat (`nc`)**.

Dans un terminal, exécuter la commande suivante :

```bash
nc <adresse_ip-ou-dns> <port>
```

Remplacer `<adresse_ip-ou-dns>` par l'adresse IP ou le nom DNS du serveur, et `<port>` par le port d'écoute du serveur.

Une fois la connexion établie, envoyer une demande au format JSON, par exemple :

```json
{"id_billet": 7, "id_scan": 3, "id_agent": 27, "porte": "C08", "numero_vol": "U23003"}
```

Le serveur traite la demande et renvoie une réponse au format JSON indiquant le résultat des vérifications effectuées.
