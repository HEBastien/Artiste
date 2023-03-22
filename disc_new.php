<?php

    // on importe le contenu du fichier "db.php"
    include "db.php";
    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();

    // on lance une requête pour chercher toutes les fiches d'artistes
    $requete = $db->query("SELECT * FROM artist");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
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

    <h1>Le formulaire d'ajout</h1>
        <hr>
    <h2>Ajouter un vinyle</h2>
    
    <form class="row g-3" action="script_disc_ajout.php" method="post" enctype="multipart/form-data">
    <div class="col-12">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" required>
  </div>
  <div class="col-12">
    <label for="artist" class="form-label">Artist</label>
    <select class="form-select" id="artist" name="artist"  required>
      <option selected disabled value="">Choose...</option>
      <?php foreach ($tableau as $artist): ?>
      <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name?></option>
      <?php endforeach; ?>
    </select>
    </div>
    
    <div class="col-12">
    <label for="year" class="form-label">Year</label>
    <input type="text" class="form-control" id="year" name="year"  placeholder="Enter Year" value="" required>
  </div>

    <div class="col-12">
    <label for="genre" class="form-label">Genre</label>
    <input type="text" class="form-control" id="genre" name="genre"  placeholder="Enter Genre(Rock,Pop,Prog" value="" required>
  </div>

    <div class="col-12">
    <label for="label" class="form-label">Label</label>
    <input type="text" class="form-control" id="label" name="label"  placeholder="Enter label(EMI,Warner,PolyGram,Univers sale ...)" value="" required>
  </div>

    <div class="col-12">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price"  >
  </div>

  <div class="input-group mb-3">
  <label class="input-group-text" for="picture">Picture</label>
  <input type="file" class="form-control" id="picture" name="picture" />
  </div>

  <div>
  <input type="submit" value="Submit" class="btn btn-primary">
  <input type="reset" value="Reset" class="btn btn-secondary">
  </div>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>