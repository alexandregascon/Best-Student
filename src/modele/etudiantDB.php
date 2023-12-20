<?php

require_once "connexionDB.php";

// SELECT * FROM ETUDIANT
function selectAllStudents() : array{
    $connexion = createConnection();

    // 2. Exécution de la requête
    // 2.1 Préparation de la requête
    $requeteSQL = "SELECT * FROM etudiant";
    $requete = $connexion->prepare($requeteSQL);
    // 2.2 Envoi de la requête au server de BDD soit un SGBD afin qu'elle soit exécutée
    $requete->execute();
    // A l'issue de l'instruction précédente, $requeet contient les enregistrements envoyés par le SGBD

    // 3. Récupération des enregistrements
    $etudiants = $requete->fetchAll(PDO::FETCH_ASSOC); // Fetch = Récupérer Fetch_Assoc = Récupérer sous forme de tableau associatif

    return $etudiants;
}

// INSERT INTO etudiant (champ1, champ2, champ3) VALUES (?,?,?)

function addStudent(string $prenom, string $nom, string $email, string $naissance, string $adresse, string $telephone, string $image, int $idPromotion) : bool{
    $connexion = createConnection();
    // Créer la requête SQL
    $requeteSQL = "INSERT INTO etudiant (prenom_etudiant, nom_etudiant, email_etudiant, date_naissance_etudiant, adresse_etudiant, telephone_etudiant, image_etudiant, id_promotion) 
                    VALUES (:prenom,:nom,:email,:naissance,:adresse,:telephone, :image, :idPromotion)";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":prenom",$prenom);
    $requete->bindValue(":nom",$nom);
    $requete->bindValue(":email",$email);
    $requete->bindValue(":naissance",$naissance);
    $requete->bindValue(":adresse",$adresse);
    $requete->bindValue(":telephone",$telephone);
    $requete->bindValue(":image",$image);
    $requete->bindValue(":idPromotion",$idPromotion);

    $requete->execute();
    $new_student = $requete->fetch(PDO::FETCH_ASSOC);
    return $new_student;
}

function addStudentSansPromotion(string $prenom, string $nom, string $email, string $naissance, string $adresse, string $telephone, string $image) : bool{
    $connexion = createConnection();
    // Créer la requête SQL
    $requeteSQL = "INSERT INTO etudiant (prenom_etudiant, nom_etudiant, email_etudiant, date_naissance_etudiant, adresse_etudiant, telephone_etudiant, image_etudiant) 
                    VALUES (:prenom,:nom,:email,:naissance,:adresse,:telephone, :image)";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":prenom",$prenom);
    $requete->bindValue(":nom",$nom);
    $requete->bindValue(":email",$email);
    $requete->bindValue(":naissance",$naissance);
    $requete->bindValue(":adresse",$adresse);
    $requete->bindValue(":telephone",$telephone);
    $requete->bindValue(":image",$image);

    $requete->execute();
    $new_student = $requete->fetch(PDO::FETCH_ASSOC);
    return $new_student;
}