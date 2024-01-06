<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Formulaire</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

<?php 

// Commentaire sur une ligne

/*
Sur Plusieurs lignes
*/



// On se  connecte, voir code du fichier connexion.php ci-dessus
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois



//$codeActivite = $_REQUEST["activite"];

// $select = $connexion->prepare("SELECT * FROM action where numeroActivite=:codeActivite");
$select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");

$select->bindValue(":mail", $_POST['id']);
$select->bindValue(":mdp", $_POST['mdp']);
$select->setFetchMode(PDO::FETCH_OBJ);
$select->execute();

$x = 0;
 while ($enregistrement = $select->fetch()){
 //echo '<h1>', $enregistrement->adresse, '</h1>';
 $_SESSION["utilisateur"] = $enregistrement->nom." ".$enregistrement->prenom;
 $_SESSION["profil"] = $enregistrement->profil;
 $_SESSION["mail"] = $enregistrement->mel;
 $_SESSION["adresse"] = $enregistrement->adresse;
 $_SESSION["codepostal"] = $enregistrement->codepostal;
 $_SESSION["ville"] = $enregistrement->ville;
}


?>

<?php 
if (isset($_SESSION['profil']))
              
{
 // si l'utilisateur est connecté, alors faire ça :
    if (($_SESSION['profil']) == 'Administrateur')
    {
        //si c'est admin alors afficher page admin
        echo "admin";
        
        ?>

<div>
      <h3>La bibliothèque de Moulinsart est fermée au public jusqu'à nouvel ordre. Mais il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</h3>
  </div>




        //Fin de page admin

        <?php 
    }




    elseif (($_SESSION['profil']) == 'Membre') 
    {
      //Retour à l'acceuil en tant que membre
      ?>
        
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
            <div class="card;border-0"  style="width:375px;height:150px"> <!-- card pour empecher le carroussel d'être trop gros et l'afficher dans une zone determinée  /  border 0 pour enlever le border de la card -->
              <?php include 'carroussel.php';?>
            </div>
          </div>

          <div class="col-md-4">
          
            <?php 

              if (isset($_SESSION['profil']))
              
              {
               // si l'utilisateur est connecté, alors afficher "bonjour @user" 
                  if (($_SESSION['profil']) == 'Membre')
                  {
                      //l'afficher en tant que membre
                      echo "membre";
                      include 'deconnexion.php';
                  }
                  elseif (($_SESSION['profil']) == 'Administrateur') {
                      //l'afficher en tant qu'admin
                      echo "admin";
                      include 'deconnexion.php';
                  }
              }

              else {
                echo "pas co";
                echo $_SESSION['profil'];
                include 'authentification.php';
              }
            
            ?>
          </div>
    </div>
    <div class="row"></div>



</div>
        



        <?php 
    }
}





//Si user pas co (mauvais mdp ou id)
else {
  echo "pas co";
  include 'authentification.php';
}
//Fin d'echec connexion


?>

</body>