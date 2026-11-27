-- Question 1 : Porte d'embarquement

SELECT porte
FROM billet
WHERE id_billet = 1;


-- Question 2 : Numéro de vol

SELECT v.numero_vol
FROM billet b
JOIN vol v ON v.id_vol = b.id_vol
WHERE b.id_billet = 1;


-- Question 3 : Horaires d'embarquement et de départ

SELECT v.heure_embarquement, v.heure_depart
FROM billet b
JOIN vol v ON v.id_vol = b.id_vol
WHERE b.id_billet = 1;


-- Question 4 : Aéroport de destination

SELECT a.nom_aero
FROM billet b
JOIN vol v ON b.id_vol = v.id_vol
JOIN aeroport a ON v.id_aero_arrive = a.id_aero
WHERE b.id_billet = 1;


-- Question 5 : Contrôle du prénom du passager

SELECT pe.prenom_pers AS prenom_enregistre,
       (pe.prenom_pers = 'Emma') AS prenom_correct
FROM billet b
JOIN passager pa ON pa.id_pers = b.id_pers
JOIN personne pe ON pe.id_pers = pa.id_pers
WHERE b.id_billet = 1;


-- Question 6 : Date de départ du vol

SELECT v.date_depart
FROM billet b
JOIN vol v ON v.id_vol = b.id_vol
WHERE b.id_billet = 1;


-- Question 7 : Numéro de siège attribué au passager

SELECT b.numero_siege, a.modele, a.capacite_max
FROM billet b
JOIN vol v ON v.id_vol = b.id_vol
JOIN avion a ON a.id_avion = v.id_avion
WHERE b.id_billet = 1;


-- Question 8 : Personnel habilité à utiliser un scanner

SELECT s.id_scan, pe.nom_pers, pe.prenom_pers,
       p.role_personnel, p.statut_personnel
FROM scanner s
JOIN utilise u ON u.id_scan = s.id_scan
JOIN personnel p ON p.id_pers = u.id_pers
JOIN personne pe ON pe.id_pers = p.id_pers
WHERE s.id_scan = 2;


-- Question 9 : Informations du passager et de son vol

SELECT b.id_billet, pe.nom_pers, pe.prenom_pers,
       v.numero_vol, v.date_depart
FROM billet b
JOIN passager pa ON pa.id_pers = b.id_pers
JOIN personne pe ON pe.id_pers = pa.id_pers
JOIN vol v ON v.id_vol = b.id_vol
WHERE b.id_billet = 1;


-- Question 10 : Vérification de l'identification du billet

SELECT EXISTS (
    SELECT 1
    FROM identifie
    WHERE id_billet = 1
) AS deja_identifie;
