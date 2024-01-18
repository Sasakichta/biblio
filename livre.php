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
          <?php include 'entete.php';?>
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

$msg = " ";

if (isset($_SESSION['profil'])) {
    $msg = '<form name="ajout_panier" method="post"> <button class="btn btn-primary" type="submit" name="ajout_panier"> Ajouter au panier</button> </form>';
}
else {
    $msg = "Vous devez vous connecter pour pouvoir réserver";
}


if (isset($_SESSION['panier'])){
for($x = 0; $x < 5; $x++) {
  if ($_SESSION['panier'][1][$x] == $_GET['idLivre']) {
      $msg =  "Vous avez déja emprunté ce livre !";
  }
}
}
echo "<h1> Disponible </h1>"."<br>".$msg; 
echo "<br>";
echo "<br>";

if (isset($_POST['ajout_panier'])) {


  if (!isset($_SESSION['livres']) ) { //MISE EN VARIABLE DE SESSION POUR RECUPERER LES VALEURS SI ON QUITTE LA PAGE.

    $_SESSION['livres'] = array("vide", "vide", "vide", "vide", "vide"); //possibilité de reserver 5 livres max | Les id des livres réservés sont inscrits ici
    
  }
  
  if (!isset($_SESSION['emprunts'])) { //pour ajouter le nombre d'emprunts plus tard, on dois créer une variable emprunt pour définir sa valeur ensuite
    $_SESSION['emprunts'] = 0;
    }

    //additioner le nombre de livre emprunté dans le panier que ce sois validé ou non
    require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
    $select = $connexion->prepare("SELECT * FROM emprunter");
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();
  while ($enregistrement = $select->fetch()){
        if ($enregistrement->mel == $_SESSION['mail']) {
          $_SESSION['emprunts'] ++;
        }
  }

    if (isset($_SESSION['panier']) and $_SESSION['panier'][0] == 5) {          //le nombre d'emprunt étant de 5 max
      echo "<h1>Vous ne pouvez pas ajouter plus</h1><br>";
    }

    else {
      $emprunts = $_SESSION['emprunts'];
      $livre = $_GET['idLivre'];
      $livres = $_SESSION['livres'];

      if(isset($_SESSION['panier'])) {
        $emprunts = $_SESSION['panier'][0]; // Récupérer la valeur actuelle pour éviter de revenir à 0
      }
      if(isset($_SESSION['panier'])) {
        $livres = $_SESSION['panier'][1]; // Récupérer la valeur actuelle pour éviter de revenir à 0
      }


      $_SESSION['panier'] = array($emprunts, $livres); //nombre d'emprunt, le livre emprunté,

        //On ajoute le livre uniquement s'il ne l'a pas déja prit
        $ajout_possible = true;
        for($x = 0; $x < 5; $x++) {
          if ($_SESSION['panier'][1][$x] == $_GET['idLivre']) {
              $ajout_possible = false;
          }
        }
        //Fin d'ajout de livre

      if ($ajout_possible == true) {
      //$_SESSION['panier'][0] ++;
      $_SESSION['panier'][1][$emprunts] = $livre;     //Le énième livre emprunté par le membre = livre choisi
      $_SESSION['panier'][0] ++;
      }
    }
}




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