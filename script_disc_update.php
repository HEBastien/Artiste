<?php
    // Récupération Données
    $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
    $id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;

    // recuperation image
    $uploads_dir = 'assets/images';
    if ($_FILES["picture"]["error"] != 0) { 
        $image = Null;
     } 
    else {
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
        $image = $_FILES['picture']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $image = Null;
        }
        else
        {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "$uploads_dir/$image");
        } 
    }
    // En cas d'erreur, on renvoie vers le formulaire
    if ($title == Null || $artist == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $id == Null ) {
        header("Location: disc_update.php");
        exit;
    }

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();
if ($image == Null){
    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("UPDATE disc SET disc_title = :title, artist_id = :artist , disc_year = :year , disc_genre = :genre , disc_label = :label , disc_price = :price
    
        WHERE disc_id = :id;");
    
        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":title", $title, PDO::PARAM_STR);
        $requete->bindValue(":year", $year, PDO::PARAM_INT);
        $requete->bindValue(":label", $label, PDO::PARAM_STR);
        $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
        $requete->bindValue(":price", $price, PDO::PARAM_INT);
        $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
        $requete->bindValue(":id", $id, PDO::PARAM_STR) ;
    
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
        die("Fin du script (script_disc_update.php)");
    }  
}

else {
try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("UPDATE disc SET disc_title = :title, artist_id = :artist , disc_year = :year , disc_genre = :genre , disc_label = :label , disc_price = :price , disc_picture = :image 

    WHERE disc_id = :id;");

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":title", $title, PDO::PARAM_STR);
    $requete->bindValue(":year", $year, PDO::PARAM_INT);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_INT);
    $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
    $requete->bindValue(":image", $image, PDO::PARAM_STR) ;
    $requete->bindValue(":id", $id, PDO::PARAM_STR) ;

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
    die("Fin du script (script_disc_update.php)");
}
}
// Si OK: redirection vers la page artists.php
header("Location: disc_detail.php?id=" . $id);

// Fermeture du script
exit;
?>