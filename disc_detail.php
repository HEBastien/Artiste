<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];

    // On crée une requête préparée avec condition de recherche :
    $requete = $db->prepare("SELECT * FROM disc
    JOIN artist
    ON artist.artist_id = disc.artist_id
    WHERE disc_id=?;");
    // on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
    $requete->execute(array($id));

    // on récupère le 1e (et seul) résultat :
    $DiscDetail = $requete->fetch(PDO::FETCH_OBJ);

    // on clôt la requête en BDD
    $requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>disc_detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
<div class=container>
    <h1>Details</h1>
    <div class="row no-gutters">
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Titre</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->disc_title ?>">
  </div>
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Artiste</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->artist_name ?>">
  </div> 
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Year</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->disc_year ?>">
  </div>
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Genre</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->disc_genre ?>">
  </div>
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Label</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->disc_label ?>">
  </div>
  <div class="mb-3 col-md-6 col-12">
      <label for="disabledTextInput" class="form-label">Price</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="<?= $DiscDetail->disc_price ?>">
  </div>  
  <div class="mb-3 col-12">
      <label for="disabledTextInput" class="form-label">Picture</label>
      <br>
      <img class="img_disc" src="../../assets/images/<?= $DiscDetail->disc_picture ?>" alt="">
  </div>
  </div>
  <a href="disc_update.php?id=<?= $DiscDetail->disc_id ?>">
<button type="button" class="btn btn-primary">Modifier</button>
  </a>
  <a href="script_disc_delete.php?id=<?= $DiscDetail->disc_id ?>"><button type="button" class="btn btn-danger" onclick="return confirm ('Supprimer le disque ?')">Supprimer</button></a>
<a href="disc.php"><button type="button" class="btn btn-secondary">Retour</button></a>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>