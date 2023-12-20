<?php

require_once "src/modele/contactDB.php";
require_once "src/modele/horairesDB.php";

$horaires=selectAllHoraires();

$emetteur = "Beststudent@gmail.com";

$prenom=null;
$nom=null;
$email=null;
$sujet=null;
$telephone = null;
$message=null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["prenom"]))) {
        $erreurs["prenom"] = "Le prenom est obligatoire";
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
    if (empty(trim($_POST["sujet"]))) {
        $erreurs["sujet"] = "Le sujet est obligatoire";
    } else {
        $sujet = trim($_POST["sujet"]);
    }
    if (empty(trim($_POST["num"]))) {
        $erreurs["num"] = "Le numéro de téléphone est obligatoire";
    } else {
        $telephone = trim($_POST["num"]);
    }
    if (empty(trim($_POST["message"]))) {
        $erreurs["message"] = "Le message est obligatoire";
    } else {
        $message= trim($_POST["message"]);
    }

    if (empty($erreurs)) {

        $horodatage = date("Y-m-d H:i:s", time());

        $entetes = [
            "from" => $emetteur,
            // "text/plain" correspond au type MIME du contenu
            "content-type" => "text/html; charset=utf-8",];
        $messageAuto= "Vote demande à été reçu et sera traitée dans les plus brefs délais";

        mail($email, $sujet,$messageAuto,$entetes);

        // Traitements des données saisies
        // Renvoyer une réponse HTTP au navigateur lui demandant de lancer une nouvelle
        // requête HTTP vers index.php
        header("Location: validation-mail.php");
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
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="contenair-contact">
<ul class="menu">
    <li><a href="index.php">Liste des étudiants</a></li>
    <li><a href="nouvelEtudiant.php">Nouvel étudiant</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="chercherEtudiant.php">Rechercher un Etudiant</a></li>
</ul>

<!-- Un côté formulaire de contact et l'auter coté infos de l'école + horaires-->
    <div class="contacter">
    <p class="titre-contact">Pour nous contacter</p>
    <form action="" method="post">
        <label for="nom">Prénom*</label>
        <input type="text" id="prenom" name="prenom" value="<?= $prenom?>">
        <?php
        // Tester si il y a une erreur pour le champ nom
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

        <label for="nom">Numéro de téléphone*</label>
        <input type="text" id="num" name="num" value="<?= $telephone?>">
        <?php
        // Tester si il y a une erreur pour le champ nom
        if (isset ($erreurs["num"])){ ?>
            <p class="erreur-validation"><?= $erreurs["num"]?></p>
        <?php } ?>

        <label for="nom">Sujet*</label>
        <input type="text" id="sujet" name="sujet" value="<?= $sujet?>">
        <?php
        // Tester si il y a une erreur pour le champ nom
        if (isset ($erreurs["sujet"])){ ?>
            <p class="erreur-validation"><?= $erreurs["sujet"]?></p>
        <?php } ?>

        <label for="message">Message*</label>
        <textarea name="message" id="message" cols="60" rows="10" value="<?= $message ?>"></textarea>
        <?php
        // Tester si il y a une erreur pour le champ nom
        if (isset ($erreurs["message"])){ ?>
            <p class="erreur-validation"><?= $erreurs["message"]?></p>
        <?php } ?>

        <input type="submit" value="Envoyer">



    </form>
        <?php if (!empty($prenom) and !empty($nom) and !empty($email) and !empty($telephone) and !empty($sujet) and !empty($message)){
        addContact("$prenom","$nom","$email","$sujet","$telephone","$message","$horodatage");
        } ?>

    </div>

    <div class="informations">
        <p class="ville-ecole">Nous nous situons à Besançon</p>
        <p class="telephone-ecole">Téléphone : 0609562082</p>
        <p class="email-ecole">Email : beststudent@ac-besancon.fr</p>
        <h3>Nos horaires : </h3>

<!--        --><?php //foreach($horaires as $horaire){
//            if((date("N",time())!=$horaire["id_horaire"])){ ?>
<!--                    --><?php //if($horaire["jour"]=="Mercredi"){ ?>
<!--                        <p>--><?//= $horaire["jour"] ?><!-- : de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!--</p>-->
<!--                --><?php //}else{?>
<!--                <p>--><?//= $horaire["jour"] ?><!-- : de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!-- et de --><?//= $horaire["debut_aprem"]?><!-- à --><?//= $horaire["fin_aprem"];}?><!--</p>-->
<!---->
<!--           --><?php //}elseif(date("N",time())==$horaire["id_horaire"] and date("l",time())!="Wednesday" and date("H:i",time())>=$horaire["debut_matin"] and date("H:i",time())<=$horaire["fin_matin"]){ ?>
<!--                <span>--><?//= $horaire["jour"] ?><!-- : </span> <span class="bonHoraire">de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!-- </span> <span class="mauvaisHoraire">et de --><?//= $horaire["debut_aprem"]?><!-- à --><?//= $horaire["fin_aprem"]?><!--</span>-->
<!---->
<!--                    --><?php //}elseif(date("N",time())==$horaire["id_horaire"] and date("l",time())=="Wednesday" and date("H:i",time())>=$horaire["debut_matin"] and date("H:i",time())<="12h00"){?>
<!--                        <span>--><?//= $horaire["jour"] ?><!-- : </span> <span  class="bonHoraire">de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!--</span>-->
<!---->
<!--            --><?php //}elseif(date("N",time())==$horaire["id_horaire"] and date("l",time())!="Wednesday" and date("H:i",time())>=$horaire["debut_aprem"] and date("H:i",time())<=$horaire["fin_aprem"]){ ?>
<!--        <span>--><?//= $horaire["jour"] ?><!-- : </span> <span  class="mauvaisHoraire">de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!-- </span> <span  class="bonHoraire">et de --><?//= $horaire["debut_aprem"]?><!-- à --><?//= $horaire["fin_aprem"]?><!--</span> <p> </p>-->
<!--            --><?php //}elseif(date("N",time())==$horaire["id_horaire"] and date("l",time())=="Wednesday" and date("H:i",time())>$horaire["fin_matin"]){?>
<!--        <span>--><?//= $horaire["jour"] ?><!-- : </span> <span class="mauvaisHoraire">de --><?//= $horaire["debut_matin"]?><!-- à --><?//= $horaire["fin_matin"]?><!--</span> <p> </p>-->
<!--            --><?php //}
//        } ?>

        <?php foreach($horaires as $horaire){
            if($horaire["jour"]!="Mercredi"){ ?>
            <p><?= $horaire["jour"] ?> : de <?= $horaire["debut_matin"]?> à <?= $horaire["fin_matin"]?> et de <?= $horaire["debut_aprem"]?> à <?= $horaire["fin_aprem"] ?></p>
        <?php }else{ ?>
                <p><?= $horaire["jour"] ?> : de <?= $horaire["debut_matin"]?> à <?= $horaire["fin_matin"]?></p>
       <?php  }} ?>

    </div>

<footer class="footer">Edité par Alexandre Gascon</footer>
</div>
</html>


<!--Tu prends le time stamp du jour. date("N", timestamp)-->