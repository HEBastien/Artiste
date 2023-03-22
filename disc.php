<?php

    // on importe le contenu du fichier "db.php"
    include "db.php";
    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();

    // on lance une requête pour chercher toutes les fiches d'artistes
    $requete = $db->query("SELECT * FROM disc
    JOIN artist
    ON artist.artist_id = disc.artist_id;");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO - Liste</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="d-flex align-items-center pt-2">
        <h1 class="me-auto">Liste des disques (<?php echo count($tableau) ?>)</h1>
        <a href="disc_new.php">
        <button class="btn btn-primary">Ajouter</button>
        </a>
    </div>
  <div class="row">
  <?php foreach ($tableau as $disc): ?>
    <div class="col-md-6 col-12 mx-auto mt-5">
        <div class="row no-gutters">
            <div class="col-md-6 col-12 d-flex justify-content-center">
                <img class="img_disc" src="../../assets/images/<?= $disc->disc_picture ?>" alt="">
            </div>
            <div class="col-md-6 col-12">
            <p> <span class = "fw-bold"> 
                <span class = "h2"><?= $disc->disc_title ?></span> <br>
                <?= $disc->artist_name ?> <br>
                Label : <?= $disc->disc_label ?> </span><br>
                <span class="fw-bold">Year : <?= $disc->disc_year ?> </span><br>
                <span class="fw-bold">Genre : <?= $disc->disc_genre ?></span><br>
            </p><br><br>
            <button type="button" class="btn btn-primary">Détails</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>