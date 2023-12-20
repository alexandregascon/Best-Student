 <?php

// 1. Créer la connexion à la BDD : db_etudiant

const DB_HOST = "localhost:3306"; //Adresse IP de la machine : port de la BDD
const DB_NAME = "db_etudiants";
const DB_USER = "root";
const DB_PASSWORD = "";

function createConnection() : PDO{
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8"; // Type de serveur de BDD : l'host ; le nom de la BDD ; Type d'encodage
    try{
        $connexion = new PDO($dsn, DB_USER, DB_PASSWORD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;
    } catch(PDOException $erreur){
        die("Erreur : ". $erreur->getMessage());
    }
}