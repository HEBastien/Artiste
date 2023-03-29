<?php

require "db.php";
$db = connexionBase();
$requete = $db->prepare("SELECT * FROM disc
JOIN artist
ON artist.artist_id = disc.artist_id
WHERE disc_id=?;");
$requete->execute(array($_GET["id"]));
$mydisc1 = $requete->fetch(PDO::FETCH_OBJ);
$requete = $db->query("SELECT * FROM artist");
$myartist = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO - Ajout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
<div class="container">

<div class="d-flex align-items-center pt-2">
        <h1 class="me-auto">Formulaire de modification</h1>
        <a href="disc.php">
        <button class="btn btn-success">Retour</button>
        </a>
    </div>
        <hr>
    <h2>Modifier un vinyle</h2>
    
    <form class="row g-3" action="script_disc_update.php" method="post" enctype="multipart/form-data">
    <div class="col-12">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="<?= $mydisc1->disc_title ?>" value="<?= $mydisc1->disc_title ?>" required>
  </div>
  <div class="col-12">
    <label for="artist" class="form-label">Artist</label>
    <select class="form-select" id="artist" name="artist"  required>
      <option selected value="<?= $mydisc1->artist_id ?>"><?= $mydisc1->artist_name ?></option>
      <?php foreach ($myartist as $artist): ?>
      <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name?></option>
      <?php endforeach; ?>
    </select>
    </div>
    
    <div class="col-12">
    <label for="year" class="form-label">Year</label>
    <input type="text" class="form-control" id="year" name="year"  placeholder="<?= $mydisc1->disc_year ?>" value="<?= $mydisc1->disc_year?>" required>
  </div>

    <div class="col-12">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre"  placeholder="<?= $mydisc1->disc_genre ?>" value="<?= $mydisc1->disc_genre ?>" required>
  </div>

    <div class="col-12">
    <label for="label" class="form-label">Label</label>
    <input type="text" class="form-control" id="label" name="label"  placeholder="<?= $mydisc1->disc_label ?>" value="<?= $mydisc1->disc_label ?>" required>
  </div>

    <div class="col-12">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="<?= $mydisc1->disc_price ?>" value="<?= $mydisc1->disc_price ?>" >
  </div>

  <div class="input-group mb-3">
  <label class="input-group-text" for="picture">Picture</label>
  <input type="file" class="form-control" id="picture" name="picture" />
  </div>
  <img src="assets/images/<?= $mydisc1->disc_picture ?>" alt="" class="w-25">
  <div>
  <input type="hidden" class="form-control" id="id" name="id" value="<?= $mydisc1->disc_id ?>"/>
  <input type="submit" value="Submit" class="btn btn-primary">
  <input type="reset" value="Reset" class="btn btn-secondary">
  </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>