<?php

require_once "src/modele/etudiantDB.php";
require_once "src/modele/promotionDB.php";
require_once "./src/utils/dates.php";

$promotions=selectAllPromotions();
$etudiants=selectAllStudents();

$idPromotion = $_GET["idPromotion"]

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détail par promotion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenair-detail-par-id">
        <ul class="menu">
            <li><a href="index.php">Liste des étudiants</a></li>
            <li><a href="nouvelEtudiant.php">Nouvel étudiant</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="chercherEtudiant.php">Rechercher un Etudiant</a></li>
        </ul>
    <?php
        $presence = 0;
        foreach($etudiants as $etudiant){
            if($etudiant["id_promotion"]==$idPromotion){ ?>
                    <?php $presence=1;?>
                <div class="card">
            <div class="image">
                <?php if (!empty($etudiant["image_etudiant"])){?>
                    <img src="Images/<?= $etudiant["image_etudiant"]?>" alt="image">
                <?php }else{ ?>
                    <p>Aucune image pour cet éleve</p>
                <?php }?>
            </div>
            <div class="prenom">
                <p><?= ucfirst($etudiant["prenom_etudiant"])?></p>
            </div>

            <div class="nom">
                <p><?= strtoupper($etudiant["nom_etudiant"])?></p>
            </div>
            <div class="date_naissance">
                <?php $stampNaissance = strtotime($etudiant["date_naissance_etudiant"]);
                $naissance = date("d/m/Y", $stampNaissance)?>
                <p><?= $naissance?></p>
            </div>
            <div class="ageIndex">
                <p><?php $age=Age($naissance) ?></p>
                <p><?php if ($age<18){ ?>
                        <span class="mineur"> <?= $age?> </span>
                    <?php }else{ ?>
                    <span class="majeur"> <?= $age;}?></span> ans</p>
            </div>
                        <?php if($idPromotion==null) { ?>
                            <p class="promotion">Promotion : Aucune promotion</p>
                        <?php }else{ ?>
                            <p class="promotion">Promotion : <?= $promotions[$idPromotion-1]["intitule_promotion"]?></p>
                        <?php } ?>
    </div>
            <?php }
        } if($presence != 1){ ?>
        <p class="aucun-eleve">Aucun élève ne correspond à la recherche</p>
    <?php }?>
    </div>
    <footer class="footer-promotion">Edité par Alexandre Gascon</footer>

</body>
</html>