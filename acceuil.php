<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Formulaire</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

  <!-- <form name="nameForm" method="post" action="traitement.php">
    Nom: </br> <input type="text" name="nom"> </br>
    Prénom: </br> <input type="text" name="prenom"> </br>
    Adresse: </br> <input type="text" name="adresse">


    </br>
    </br>
    <input type="submit" value="Send">
    <input type="reset" value="Cancel">
  </form>




  <form name="tableForm" method="post" action="traitement.php">
    </br>
    </br>
    </br>
    Table: </br> <input type="text" name="table">



    </br>
    </br>
    <input type="submit" value="Send">
    <input type="reset" value="Cancel">
  </form>


  </br>
  </br>
  </br> -->





















  <?php

  // Commentaire sur une ligne
  
  /*
  Sur Plusieurs lignes
  */

  // On se  connecte, voir code du fichier connexion.php ci-dessus
  require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
  
  // Envoi de la requête vers MySQL
  
  $select = $connexion->prepare("SELECT * FROM activite");
  //$select = $connexion->prepare("SELECT * FROM agent where codePostal=33000");
  
  // Les résultats retournés par la requête seront traités en 'mode' objet
  $select->setFetchMode(PDO::FETCH_OBJ);
  $select->execute();
  // Parcours des enregistrements retournés par la requête : premier, deuxième…
  echo "Activité : ";


  echo "<form name='activite' method='post' action='traitement.php'>";

  echo "<select name=activite>";

  while ($enregistrement = $select->fetch())
  //{
  // Affichage des champs nom et prenom de la table 'agent'
  //echo '<h1>', $enregistrement->nom, ' ', $enregistrement->prenom, ' ', $enregistrement->adresse1, '</h1>';
//}
  {
    //echo '<h1>', $enregistrement->nom, '</h1>';
    echo "<option value=$enregistrement->numero> $enregistrement->libelle <option>";
  }
  echo "</select>";
  echo "<input type='submit' value='Send'>";
  echo "</form>";


  


  

  ?>

</body>