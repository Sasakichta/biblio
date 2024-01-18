<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Panier</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>






<div class="container-fluid">



  <div class="row">
    <div class="col-md-8">
      <?php include 'entete.php'; ?>
    </div>
    <div class="col-md-4">
      <img src="images/photo.jpeg" class="imgPos" style="width:625px;height:226px;" alt="Image">
    </div>



  </div>


  <div class="row">

    <div class="col-md-3"></div>



    <div class="col-md-5">
      <div class="card;border-0" style="width:375px;height:150px"> <!-- card pour empecher le carroussel d'être trop gros et l'afficher dans une zone determinée  /  border 0 pour enlever le border de la card -->


        <?php

//on récupère les données des livres pour afficher leurs noms dans le panier
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois

 //fin de récupération



        if (isset($_SESSION['profil']) or isset($_SESSION['panier'][1][0])) {
          echo "<h1>Votre panier</h1>";

           if (isset($_SESSION['panier'][1][0])){
          echo "<br>";
          echo "Nombre de livre emprunté : ".$_SESSION['panier'][0];
          echo "<br>";
          echo "<br>";
          
          //il peut ajouter que 5 livres max
          //si c'est pas encore défini alors déclarer une liste de 5 éléments
          //sinon ajouter les livres un par un dans cette liste
            $x = 0;
          do {

            $select = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) where nolivre=:id");
            $select->bindValue(":id", $_SESSION['panier'][1][$x]);
            $select->setFetchMode(PDO::FETCH_OBJ);
            $select->execute();

            while ($enregistrement = $select->fetch()){
              echo $enregistrement->prenom." ".$enregistrement->nom." - ".$enregistrement->titre;
              echo "<a href='panier.php?supprimer=".$x."'>"." Supprimer"."</a>";
              echo "<br>";
            }
            $x++; 

            if($x == count($_SESSION['panier'][1])) {break;} 
          } while (isset($_SESSION['panier'][1][$x]));      
        //} while ($x < count($_SESSION['panier'][1]));

        echo "<br><br>";
        echo "Attention : vous déconnecter videra votre panier.";
        echo '<form name="valider_panier" method="post"> <button class="btn btn-primary" type="submit" name="valider_panier"> Valider le panier</button> </form>';
      
      } 
      else {
            echo "<br>";
            echo "<br>";
            echo "Votre panier est vide !";
      }



      if (isset($_POST['valider_panier'])) {
          

        for($x = 0; $x < count($_SESSION['panier'][1]); $x++) {
          $date = date("y-m-j");
          $select = $connexion->prepare('INSERT INTO livre (`mel`, `nolivre`, `dateemprunt`, `dateretour`) 
          VALUES (:auteur, :titre, :ISBN13, :annee_parution)');
      
          $select->bindParam(':mel', $_SESSION['mail']);
          $select->bindParam(':nolivre', $_SESSION['panier'][1][$x]);
          $select->bindParam(':date_emprunt', $date);
          echo $date;
          strtotime('+1 day', $date);
          echo $date;
          $select->bindParam(':date_retour', $date);
          $select->execute();
        }

          unset($_SESSION["panier"]);
          echo '<meta http-equiv="refresh" content="0" />';
          echo "Votre panier à bien été validé !";
      }


      if (isset($_GET['supprimer'])) {
        
        if ($_SESSION['panier'][0] > 0) {
          $_SESSION['panier'][0]--;
        }
        $livre = $_GET['supprimer'];
        //$_SESSION["panier"][1][$livre] = 'vide';
        unset($_SESSION["panier"][1][$_GET['supprimer']]);
        //$_SESSION["panier"][1] = array_values($_SESSION["panier"][1]); // Réorganiser les clés numériques

      
      
      }




        } else {
          echo "Votre panier est vide car vous devez vous connecter";
        }

        ?>



      </div>
    </div>




    <div class="col-md-4">



      <?php
      include 'authentification.php';
      ?>




    </div>
  </div>


  <div class="row"></div>



</div>