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



//$codeActivite = $_REQUEST["activite"];

// $select = $connexion->prepare("SELECT * FROM action where numeroActivite=:codeActivite");
$select = $connexion->prepare("SELECT * FROM livre");

 // $select->bindValue(":codeActivite", $codeActivite);

  $select->setFetchMode(PDO::FETCH_OBJ);
  $select->execute();

 while ($enregistrement = $select->fetch()){
  $varImage=$enregistrement->image;
 //echo '<h1>', $enregistrement->image, '</h1>';
 echo "<img src='".$varImage."'class='imgPos' alt='Image'>";
}















$var=$_REQUEST["a"];

echo "$var";

?>


</body>