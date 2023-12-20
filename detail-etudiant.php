<?php

require_once "./src/utils/dates.php";
require_once "./src/modele/promotionDB.php";

    $id = $_GET["id"];
    $prenom = $_GET["prenom"];
    $nom = $_GET["nom"];
    $email = $_GET["email"];
    $dateNaissance = $_GET["dateNaissance"];
    $adresse = $_GET["adresse"];
    $telephone = $_GET["telephone"];
    $image = $_GET["image"];
    $idPromotion = $_GET["idPromotion"];

    require_once "./src/modele/etudiantDB.php";
    $promotions=selectAllPromotions();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenair-detail">
    <ul class="menu">
        <li><a href="index.php">Liste des étudiants</a></li>
        <li><a href="nouvelEtudiant.php">Nouvel étudiant</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="chercherEtudiant.php">Rechercher un Etudiant</a></li>
    </ul>
    <div class="carte-unique">
        <?php if (!empty($image)){?>
        <img src="Images/<?= $image?>" alt="image">
        <?php }else{ ?>
        <p>Aucune image pour cet éleve</p>
        <?php }?>
        <p>Prénom : <?= ucfirst($prenom)?></p>
        <p>Nom : <?= strtoupper($nom)?></p>
        <p>Email : <?= $email?></p>
        <p>Naissance : <?php $stampNaissance = strtotime($dateNaissance);
                              echo date("d/m/Y", $stampNaissance)?></p>
        <p>Age : <?php $age = date("d/m/Y", $stampNaissance);
                        $age = Age($age);
                      if ($age<18){ ?>
                        <span class="mineur"> <?= $age?> </span>
                      <?php }else{ ?>
                      <span class="majeur"> <?= $age;}?></span> ans</p>
        <p>Adresse : <?= $adresse?></p>
        <p>Téléphone : <?= $telephone?></p>
        <?php if($idPromotion==null) { ?>
            Promotion : Aucune promotion
        <?php }else{ ?>
        <p>Promotion : <?= $promotions[$idPromotion-1]["intitule_promotion"]?></p>
        <?php } ?>

    </div>
        <footer>Edité par Alexandre Gascon</footer>
    </div>
</body>
</html>