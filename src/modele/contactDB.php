<?php

require_once "connexionDB.php";

function addContact(string $prenom, string $nom, string $email, string $sujet, string $telephone, string $message, string $horodatage) : bool{
$connexion = createConnection();
// Créer la requête SQL
$requeteSQL = "INSERT INTO contact (prenom_contact, nom_contact, email_contact, sujet_contact, num_contact, message_contact, horodatage_contact)
VALUES (:prenom,:nom,:email,:sujet,:telephone,:message, :horodatage)";
$requete = $connexion->prepare($requeteSQL);
$requete->bindValue(":prenom",$prenom);
$requete->bindValue(":nom",$nom);
$requete->bindValue(":email",$email);
$requete->bindValue(":telephone",$telephone);
$requete->bindValue(":sujet",$sujet);
$requete->bindValue(":message",$message);
$requete->bindValue(":horodatage",$horodatage);

$requete->execute();
$new_student = $requete->fetch(PDO::FETCH_ASSOC);
return $new_student;
}