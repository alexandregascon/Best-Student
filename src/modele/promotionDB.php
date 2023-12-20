<?php

require_once "connexionDB.php";


// SELECT * FROM PROMOTION
function selectAllPromotions() : array{
    $connexion = createConnection();

    // 2. Exécution de la requête
    // 2.1 Préparation de la requête
    $requeteSQL = "SELECT * FROM promotion";
    $requete = $connexion->prepare($requeteSQL);
    // 2.2 Envoi de la requête au server de BDD soit un SGBD afin qu'elle soit exécutée
    $requete->execute();
    // A l'issue de l'instruction précédente, $requeet contient les enregistrements envoyés par le SGBD

    // 3. Récupération des enregistrements
    $promotions = $requete->fetchAll(PDO::FETCH_ASSOC); // Fetch = Récupérer    Fetch_Assoc = Récupérer sous forme de tableau associatif

    return $promotions;
}