<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Bibliothèque</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>



<body>






<div class="container-fluid">
 


    <div class="row">
        <div class="col-md-8">
          <?php include 'entete.html';?>
        </div>
        <div class="col-md-4">
        <img src="images/photo.jpeg" class="imgPos" style="width:625px;height:226px;" alt="Image">
        </div>


        
    </div>


    <div class="row">

    <div class="col-md-3"></div>

          <div class="col-md-5">
            
          <?php 

// Commentaire sur une ligne

/*
Sur Plusieurs lignes
*/




// On se  connecte, voir code du fichier connexion.php ci-dessus
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois

// $select = $connexion->prepare("SELECT * FROM action where numeroActivite=:codeActivite");
$select = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) where nolivre=:id");

  $select->bindValue(":id", $_GET['idLivre']);
  $select->setFetchMode(PDO::FETCH_OBJ);
  $select->execute();

 while ($enregistrement = $select->fetch()){
 //echo $enregistrement->titre." "."($enregistrement->anneeparution)<br><br>";
 echo "Auteur : ".$enregistrement->nom." ".$enregistrement->prenom;
 echo "<br>";
 echo "<br>";
 echo "ISBN13 : ".$enregistrement->isbn13;
 echo "<br>";
 echo "<br>";
 echo "Résumé du livre : <br>";
 echo $enregistrement->resume;
 echo "<br>";
 echo "<img src=".$enregistrement->image.' alt=Chicago'.'class=d-block>';

}
?>
            
          </div>

          <div class="col-md-4">
            <?php include 'authentification.php';?>
          </div>
    </div>
    <div class="row"></div>

</div>


  <?php

  // Commentaire sur une ligne
  
  /*
  Sur Plusieurs lignes
  */

  ?>

</body>