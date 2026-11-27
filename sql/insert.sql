-- Insertion des donnees dans la table adresse
INSERT INTO adresse (id_adr, numero_adr, nom_adr, code_postal, ville_adr, pays_adr) VALUES
(1, 10, 'Rue de Paris', '95700', 'Roissy-en-France', 'France'),
(2, 25, 'Avenue des Champs', '75008', 'Paris', 'France'),
(3, 8, 'Rue de la Gare', '69125', 'Colombier-Saugnieu', 'France'),
(4, 42, 'Boulevard du Port', '13700', 'Marignane', 'France'),
(5, 15, 'Rue Nationale', '59810', 'Lesquin', 'France'),
(6, 12, 'Avenue des Pins', '06200', 'Nice', 'France'),
(7, 30, 'Allee des Peupliers', '31700', 'Blagnac', 'France'),
(8, 18, 'Rue de l''Aeroport', '33700', 'Merignac', 'France'),
(9, 100, 'Rue de la Paix', '75002', 'Paris', 'France'),
(10, 45, 'Avenue Victor Hugo', '69006', 'Lyon', 'France'),
(11, 22, 'Rue du Commerce', '13001', 'Marseille', 'France'),
(12, 17, 'Boulevard Gambetta', '59000', 'Lille', 'France'),
(13, 8, 'Rue de la Republique', '06000', 'Nice', 'France'),
(14, 55, 'Avenue Jean Jaures', '31000', 'Toulouse', 'France');

-- Insertion des donnees dans la table aeroport
INSERT INTO aeroport (id_aero, nom_aero, code_iata, id_adr) VALUES
(1, 'Paris Charles de Gaulle', 'CDG', 1),
(2, 'Paris Orly', 'ORY', 2),
(3, 'Lyon Saint-Exupery', 'LYS', 3),
(4, 'Marseille Provence', 'MRS', 4),
(5, 'Lille Lesquin', 'LIL', 5),
(6, 'Nice Cote d''Azur', 'NCE', 6),
(7, 'Toulouse-Blagnac', 'TLS', 7),
(8, 'Bordeaux-Merignac', 'BOD', 8);

-- Insertion des donnees dans la table compagnie
INSERT INTO compagnie (id_comp, nom_comp, code_iata, telephone_comp, id_adr) VALUES
(1, 'Air France', 'AF', '0141567800', 9),
(2, 'Transavia', 'TO', '0892058888', 2),
(3, 'EasyJet', 'U2', '0176543210', 10),
(4, 'Air Corsica', 'XK', '0495209500', 11),
(5, 'Volotea', 'V7', '0187654321', 12),
(6, 'Air Caraibes', 'TX', '0820004000', 13);

-- Insertion des donnees dans la table personne
INSERT INTO personne (id_pers, nom_pers, prenom_pers, telephone_pers, date_naissance, email_pers, id_adr) VALUES
(1, 'Martin', 'Emma', '0612345678', '2001-04-15', 'emma.martin@mail.fr', 1),
(2, 'Delhelle', 'Hugo', '0623456789', '2004-11-02', 'hugo.delhelle@mail.fr', 2),
(3, 'Robert', 'Lea', '0634567890', '2002-07-23', 'lea.robert@mail.fr', 3),
(4, 'Petit', 'Lucas', '0645678901', '1998-01-30', 'lucas.petit@mail.fr', 4),
(5, 'Moreau', 'Chloe', '0656789012', '2000-09-12', 'chloe.moreau@mail.fr', 5),
(6, 'Bernard', 'Louis', '0667890123', '1999-03-18', 'louis.bernard@mail.fr', 6),
(7, 'Dubois', 'Camille', '0678901234', '1997-06-25', 'camille.dubois@mail.fr', 7),
(8, 'Thomas', 'Nathan', '0689012345', '1995-12-09', 'nathan.thomas@mail.fr', 8),
(9, 'Richard', 'Ines', '0690123456', '2003-08-14', 'ines.richard@mail.fr', 9),
(10, 'Simon', 'Gabriel', '0601234567', '1996-05-06', 'gabriel.simon@mail.fr', 10),
(11, 'Laurent', 'Manon', '0611122233', '2000-02-11', 'manon.laurent@mail.fr', 11),
(12, 'Lefebvre', 'Jules', '0622233344', '1998-09-21', 'jules.lefebvre@mail.fr', 12),
(13, 'Michel', 'Sarah', '0633344455', '2001-12-03', 'sarah.michel@mail.fr', 13),
(14, 'Garcia', 'Adam', '0644455566', '1994-07-19', 'adam.garcia@mail.fr', 14),
(15, 'David', 'Julie', '0655566677', '2002-06-08', 'julie.david@mail.fr', 1),
(16, 'Bertrand', 'Thomas', '0666677788', '1993-10-27', 'thomas.bertrand@mail.fr', 2),
(17, 'Roux', 'Lina', '0677788899', '1999-04-16', 'lina.roux@mail.fr', 3),
(18, 'Vincent', 'Paul', '0688899900', '2000-01-05', 'paul.vincent@mail.fr', 4),
(19, 'Fournier', 'Clara', '0699900011', '2003-03-22', 'clara.fournier@mail.fr', 5),
(20, 'Morel', 'Antoine', '0600011122', '1997-11-14', 'antoine.morel@mail.fr', 6),
(21, 'Girard', 'Eva', '0611223344', '2001-08-30', 'eva.girard@mail.fr', 7),
(22, 'Andre', 'Maxime', '0622334455', '1996-02-17', 'maxime.andre@mail.fr', 8),
(23, 'Lefevre', 'Alice', '0633445566', '2004-05-25', 'alice.lefevre@mail.fr', 9),
(24, 'Mercier', 'Theo', '0644556677', '1995-09-09', 'theo.mercier@mail.fr', 10),
(25, 'Durand', 'Thomas', '0655667788', '1985-03-18', 'thomas.durand@aerogate.fr', 1),
(26, 'Leroy', 'Sarah', '0666778899', '1987-06-25', 'sarah.leroy@aerogate.fr', 2),
(27, 'Roux', 'Nicolas', '0677889900', '1984-12-09', 'nicolas.roux@aerogate.fr', 3),
(28, 'Fournier', 'Julie', '0688990011', '1986-08-14', 'julie.fournier@aerogate.fr', 4),
(29, 'Burin', 'Alexandre', '0699001122', '2005-05-06', 'alexandre.burin@aerogate.fr', 5),
(30, 'Garcia', 'Sophie', '0600112233', '1990-04-12', 'sophie.garcia@aerogate.fr', 6),
(31, 'Petit', 'Marc', '0611224455', '1988-07-20', 'marc.petit@aerogate.fr', 7),
(32, 'Thomas', 'Laura', '0622335566', '1992-10-15', 'laura.thomas@aerogate.fr', 8);

-- Insertion des donnees dans la table passager
INSERT INTO passager (id_pers, numero_passeport, nationalite_passager) VALUES
(1, 'FR123456', 'Francaise'),
(2, 'FR234567', 'Francaise'),
(3, 'FR345678', 'Francaise'),
(4, 'FR456789', 'Francaise'),
(5, 'FR567890', 'Francaise'),
(6, 'FR678901', 'Francaise'),
(7, 'FR789012', 'Francaise'),
(8, 'FR890123', 'Francaise'),
(9, 'FR901234', 'Francaise'),
(10, 'FR112233', 'Francaise'),
(11, 'FR223344', 'Francaise'),
(12, 'FR334455', 'Francaise'),
(13, 'FR445566', 'Francaise'),
(14, 'FR556677', 'Francaise'),
(15, 'FR667788', 'Francaise'),
(16, 'FR778899', 'Francaise'),
(17, 'FR889900', 'Francaise'),
(18, 'FR990011', 'Francaise'),
(19, 'FR101112', 'Francaise'),
(20, 'FR121314', 'Francaise'),
(21, 'FR141516', 'Francaise'),
(22, 'FR161718', 'Francaise'),
(23, 'FR181920', 'Francaise'),
(24, 'FR202122', 'Francaise');

-- Insertion des donnees dans la table personnel
INSERT INTO personnel (id_pers, role_personnel, matricule_personnel, statut_personnel) VALUES
(25, 'Accueil', 'AG1001', TRUE),
(26, 'Embarquement', 'AG1002', TRUE),
(27, 'Controle', 'AG1003', TRUE),
(28, 'Superviseur', 'AG1004', TRUE),
(29, 'Assistance', 'AG1005', TRUE),
(30, 'Controle', 'AG1006', TRUE),
(31, 'Embarquement', 'AG1007', FALSE),
(32, 'Securite', 'AG1008', TRUE);

-- Insertion des donnees dans la table avion
INSERT INTO avion (id_avion, immatriculation, modele, capacite_max, id_comp) VALUES
(1, 'F-GKXA', 'Airbus A320', 180, 1),
(2, 'F-HTVA', 'Boeing 737-800', 189, 2),
(3, 'G-EZAA', 'Airbus A319', 156, 3),
(4, 'F-HXKA', 'Airbus A320neo', 186, 4),
(5, 'EC-NOS', 'Airbus A319', 150, 5),
(6, 'F-HBNA', 'Airbus A350-900', 324, 1),
(7, 'F-HUVA', 'Airbus A321neo', 220, 2),
(8, 'F-GZCP', 'Airbus A330-300', 300, 6);

-- Insertion des donnees dans la table vol
INSERT INTO vol (id_vol, numero_vol, date_depart, heure_depart, heure_embarquement, id_aero_depart, id_aero_arrive, id_avion) VALUES
(1, 'AF1001', '2026-11-20', '08:30:00', '07:50:00', 1, 3, 1),
(2, 'TO2002', '2026-11-20', '10:15:00', '09:35:00', 2, 4, 2),
(3, 'U23003', '2026-11-20', '13:40:00', '13:00:00', 3, 1, 3),
(4, 'XK4004', '2026-11-20', '16:20:00', '15:40:00', 4, 2, 4),
(5, 'V75005', '2026-11-21', '07:45:00', '07:05:00', 5, 6, 5),
(6, 'AF1006', '2026-11-21', '11:30:00', '10:50:00', 6, 7, 6),
(7, 'TO2007', '2026-11-21', '15:00:00', '14:20:00', 7, 8, 7),
(8, 'TX8008', '2026-11-22', '18:10:00', '17:30:00', 8, 1, 8);

-- Insertion des donnees dans la table billet
INSERT INTO billet (id_billet, numero_siege, categorie, porte, id_pers, id_vol) VALUES
(1, '12A', 'ECONOMIE', 'A12', 1, 1),
(2, '4C', 'BUSINESS', 'A12', 2, 1),
(3, '18F', 'ECONOMIE', 'A12', 3, 1),
(4, '2A', '1ERE', 'B05', 4, 2),
(5, '21B', 'ECONOMIE', 'B05', 5, 2),
(6, '8C', 'BUSINESS', 'B05', 6, 2),
(7, '14D', 'ECONOMIE', 'C08', 7, 3),
(8, '3A', 'BUSINESS', 'C08', 8, 3),
(9, '22F', 'ECONOMIE', 'C08', 9, 3),
(10, '2B', '1ERE', 'D03', 10, 4),
(11, '16A', 'ECONOMIE', 'D03', 11, 4),
(12, '5C', 'BUSINESS', 'D03', 12, 4),
(13, '19A', 'ECONOMIE', 'E11', 13, 5),
(14, '6B', 'BUSINESS', 'E11', 14, 5),
(15, '24C', 'ECONOMIE', 'E11', 15, 5),
(16, '1A', '1ERE', 'F02', 16, 6),
(17, '9D', 'BUSINESS', 'F02', 17, 6),
(18, '27F', 'ECONOMIE', 'F02', 18, 6),
(19, '15A', 'ECONOMIE', 'G04', 19, 7),
(20, '7C', 'BUSINESS', 'G04', 20, 7),
(21, '30F', 'ECONOMIE', 'G04', 21, 7),
(22, '3B', '1ERE', 'H10', 22, 8),
(23, '11D', 'BUSINESS', 'H10', 23, 8),
(24, '28A', 'ECONOMIE', 'H10', 24, 8);

-- Insertion des donnees dans la table scanner
-- Insertion des données dans la table scanner

INSERT INTO scanner (id_scan, modele, adresse_ip, porte) VALUES
(1, 'SCA100', '192.168.10.10', 'A12'),
(2, 'SCA101', '192.168.10.11', 'B05'),
(3, 'SCA102', '192.168.10.12', 'C08'),
(4, 'SCA103', '192.168.10.13', 'D03'),
(5, 'SCA104', '192.168.10.14', 'E11'),
(6, 'SCA200', '192.168.20.10', 'F02'),
(7, 'SCA201', '192.168.20.11', 'G04'),
(8, 'SCA202', '192.168.20.12', 'H10');


-- Insertion des données dans la table identifie

INSERT INTO identifie (id_scan, id_billet) VALUES
(1, 1), (1, 2), (1, 3),
(2, 4), (2, 5), (2, 6),
(3, 7), (3, 8), (3, 9),
(4, 10), (4, 11), (4, 12),
(5, 13), (5, 14), (5, 15),
(6, 16), (6, 17), (6, 18),
(7, 19), (7, 20), (7, 21),
(8, 22), (8, 23), (8, 24);

-- Insertion des donnees dans la table utilise
INSERT INTO utilise (id_scan, id_pers) VALUES
(1, 25),
(2, 26),
(3, 27),
(4, 28),
(5, 29),
(6, 30),
(1, 31),
(2, 32);
