<?php
    // Récupération Données
    $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;


    if ($_FILES["picture"]["error"] == 0) {
        $image = $_FILES["picture"]["name"];
        // tmp_name => temporary name = nom temporaire du fichier 
        $typefichier = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($_FILES["picture"]["type"],$typefichier)){
            $image = Null;
        }
        else {
            $direction = 'assets/images';
            move_uploaded_files($_FILES["picture"]["tmp_name"], "$direction/$picture");
        }
    }
    else {
        $image = Null;
    }

    // En cas d'erreur, on renvoie vers le formulaire
    if ($title == Null || $artist == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $image == Null ) {
        header("Location: disc_new.php");
        exit;
    }

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();

try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id, disc_picture ) VALUES (:title, :year, :label, :genre, :price, :artist, :image);");

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":title", $title, PDO::PARAM_STR);
    $requete->bindValue(":year", $year, PDO::PARAM_INT);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_INT);
    $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
    $requete->bindValue(":image", $image, PDO::PARAM_STR) ;

    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: disc.php");

// Fermeture du script
exit;
?>