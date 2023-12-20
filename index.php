<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <div class="contenair">
        <header><img src="Images/Logo.png" alt="logo"></header>
        <ul class="menu">
            <li><a href="index.php">Liste des étudiants</a></li>
            <li><a href="nouvelEtudiant.php">Nouvel étudiant</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="chercherEtudiant.php">Rechercher un Etudiant</a></li>
        </ul>
        <p class="list">Liste des étudiants :</p>
        <?php

        require_once "./src/modele/etudiantDB.php";
        require_once "./src/modele/promotionDB.php";
        require_once "./src/utils/dates.php";

        $etudiants=selectAllStudents();
        $promotions=selectAllPromotions();

        if(empty($etudiants)) {
            echo "Il n'y a aucun enregistrement";
        }else {
            foreach ($etudiants as $etudiant) {
             ?><div class="card">
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
                <a href="detail-etudiant.php?prenom=<?= $etudiant["prenom_etudiant"]?>&nom=<?= $etudiant["nom_etudiant"]?>&id=<?= $etudiant["id_etudiant"]?>&email=<?= $etudiant["email_etudiant"]?>&dateNaissance=<?= $etudiant["date_naissance_etudiant"]?>&adresse=<?= $etudiant["adresse_etudiant"]?>&telephone=<?= $etudiant["telephone_etudiant"]?>&image=<?= $etudiant["image_etudiant"]?>&idPromotion=<?= $etudiant["id_promotion"]?>"><button>Voir</button></a>
        </div>
            <?php }
        }?>
    </div>
    <footer>Edité par Alexandre Gascon</footer>
    </body>
</html>