<!DOCTYPE html>
<html lang="fr"> 

<head>
  <title>Formulaire</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<?php 

// Commentaire sur une ligne

/*
Sur Plusieurs lignes
*/


// On se  connecte, voir code du fichier connexion.php ci-dessus
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois


$nomAuteur = $_REQUEST["recherche"];

// $select = $connexion->prepare("SELECT * FROM action where numeroActivite=:codeActivite");
$select = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) where nom=:nomAuteur");

  $select->bindValue(":nomAuteur", $nomAuteur);

  $select->setFetchMode(PDO::FETCH_OBJ);
  $select->execute();









 while ($enregistrement = $select->fetch()){
  
 echo $enregistrement->titre." "."($enregistrement->anneeparution)<br><br>";
}

?>


</body>