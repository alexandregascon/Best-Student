<?php

    require_once "src/modele/promotionDB.php";
    require_once "src/modele/etudiantDB.php";

$promotions=selectAllPromotions();

    $prenom=null;
    $nom=null;
    $email=null;
    $dateNaissance=null;
    $adresse=null;
    $telephone=null;
    $image=null;
    $erreurs = [];
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           // Le formulaire a été soumis
           // Tester si tout les champs obligatoires sont saisis
           if($_POST["idPromotion"]==null){
               $idPromotion=null;
           }else{
               $idPromotion=$_POST["idPromotion"];
           }


           if (empty(trim($_POST["prenom"]))) {
               $erreurs["prenom"] = "Le prénom est obligatoire";
           } else {
               $prenom = trim($_POST["prenom"]);
           }

           if (empty(trim($_POST["nom"]))) {
               $erreurs["nom"] = "Le nom est obligatoire";
           } else {
               $nom = trim($_POST["nom"]);
           }

           if (empty(trim($_POST["email"]))) {
               $erreurs["email"] = "L'email est obligatoire";
           } else {
               $email = trim($_POST["email"]);
           }

           if (empty(trim($_POST["dateNaissance"]))) {
               $erreurs["dateNaissance"] = "La date de naissance est obligatoire";
           } else {
               $dateNaissance = trim($_POST["dateNaissance"]);
           }

           if (empty(trim($_POST["adresse"]))) {
               $erreurs["adresse"] = "L'adresse est obligatoire";
           } else {
               $adresse = trim($_POST["adresse"]);
           }

           if (empty(trim($_POST["telephone"]))) {
               $erreurs["telephone"] = "Le numéro de télephone est obligatoire";
           } else {
               $telephone = trim($_POST["telephone"]);
           }

               // Récupérer les infos liées à la photo
               $nomFichier = $_FILES["photo"]["name"];
               $typeFichier = $_FILES["photo"]["type"];
               $tmpFichier = $_FILES["photo"]["tmp_name"];
               $tailleFichier = $_FILES["photo"]["size"];
               $extensionFichier = pathinfo($nomFichier, PATHINFO_EXTENSION);

           // Tester si la photo a été envoyée
           if (empty($_FILES["photo"]["name"])){
               $erreurs["photo"] = "La photo est obligatoire";
           }else{
               // La photo est présente
               // Récupérer les infos liées à la photo
               $nomFichier = $_FILES["photo"]["name"];
               $typeFichier = $_FILES["photo"]["type"];
               $tmpFichier = $_FILES["photo"]["tmp_name"];
               $tailleFichier = $_FILES["photo"]["size"];
               $extensionFichier = pathinfo($nomFichier, PATHINFO_EXTENSION);

               // Teste si le fichier est une image
               if(!str_contains($typeFichier,"image")){
                   $erreurs["photo"]="Seules les images sont acceptées";
               }else{
                   if($tailleFichier>600 * 1024) {
                       $erreurs["photo"] = "L'image ne doit pas dépasser 600ko";
                       // Générer un nom de fichier unique
                   }else{$nomFichier = uniqid(). "." .$extensionFichier;

                       // Déplacer le fichier dans le dossier images
                       if(!move_uploaded_file($tmpFichier,"./Images/$nomFichier")){
                           $erreurs["photo"] = "Un problème interne est survenu.";
                       }
                   }
               }
           }

// Tester si il n'y a pas erreurs
           if (empty($erreurs)) {
               // Traitements des données saisies
               // Renvoyer une réponse HTTP au navigateur lui demandant de lancer une nouvelle
               // requête HTTP vers index.php
               header("Location: index.php");
           }
}
?>





<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout Etudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="contenair-newStudent">
<ul class="menu">
    <li><a href="index.php">Liste des étudiants</a></li>
    <li><a href="nouvelEtudiant.php">Nouvel étudiant</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="chercherEtudiant.php">Rechercher un Etudiant</a></li>
</ul>

<div class="formulaire">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="prenom">Prenom*</label>
        <input type="text" id="prenom" name="prenom" value="<?= $prenom?>">
        <?php
        // Tester si il y a une erreur pour le champ prénom
        if (isset ($erreurs["prenom"])){ ?>
            <p class="erreur-validation"><?= $erreurs["prenom"]?></p>
        <?php } ?>

        <label for="nom">Nom*</label>
        <input type="text" id="nom" name="nom" value="<?= $nom?>">
        <?php
        // Tester si il y a une erreur pour le champ nom
        if (isset ($erreurs["nom"])){ ?>
            <p class="erreur-validation"><?= $erreurs["nom"]?></p>
        <?php } ?>

        <label for="email">Email*</label>
        <input type="email" id="email" name="email" value="<?= $email?>">
        <?php
        // Tester si il y a une erreur pour le champ email
        if (isset ($erreurs["email"])){ ?>
            <p class="erreur-validation"><?= $erreurs["email"]?></p>
        <?php } ?>

        <label for="dateNaissance">Date de Naissance*</label>
        <input type="date" name="dateNaissance" id="dateNaissance" value="<?= $dateNaissance?>">
        <?php
        if (isset ($erreurs["dateNaissance"])){ ?>
            <p class="erreur-validation"><?= $erreurs["dateNaissance"]?></p>
        <?php } ?>

        <label for="adresse">Adresse*</label>
        <input type="text" name="adresse" id="adresse" value="<?= $adresse?>">
        <?php
        if (isset ($erreurs["adresse"])){ ?>
            <p class="erreur-validation"><?= $erreurs["adresse"]?></p>
        <?php } ?>

        <label for="telephone">Téléphone*</label>
        <input type="text" name="telephone" id="telephone" value="<?= $telephone?>">
        <?php
        if (isset ($erreurs["telephone"])){ ?>
            <p class="erreur-validation"><?= $erreurs["telephone"]?></p>
        <?php } ?>

        <label for="photo">Photo*</label>
        <input type="file" name="photo" id="photo" accept="image/png,image/jpg,image/jpeg" value="<?= $image?>">
        <?php
        if (isset ($erreurs["photo"])){ ?>
            <p class="erreur-validation"><?= $erreurs["photo"]?></p>
        <?php } ?>

        <label for="idPromotion">Promotion</label>
        <select name="idPromotion" id="idPromotion">
            <option value="">Aucune promotion</option>
            <?php foreach ($promotions as $promotion){ ?>
                <option value="<?= $promotion["id_promotion"] ?>"><?= $promotion["intitule_promotion"] ?></option>
            <?php } ?>
        </select>

        <p>* : champ obligatoire</p>

        <input type="submit" value="Envoyer">

    </form>

    <?php
    if (!empty($prenom) and !empty($nom) and !empty($email) and !empty($dateNaissance) and !empty($adresse) and !empty($telephone) and $erreurs["photo"]==null and $idPromotion!=null){
    addStudent("$prenom","$nom","$email","$dateNaissance","$adresse","$telephone", "$nomFichier","$idPromotion");
    }elseif(!empty($prenom) and !empty($nom) and !empty($email) and !empty($dateNaissance) and !empty($adresse) and !empty($telephone) and $erreurs["photo"]==null and $idPromotion==null){
        addStudentSansPromotion("$prenom","$nom","$email","$dateNaissance","$adresse","$telephone", "$nomFichier");
    } ?>

</div>
<footer>Edité par Alexandre Gascon</footer>
</div>
</body>
</html>