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
$select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");

$select->bindValue(":mail", $_POST['id']);
$select->bindValue(":mdp", $_POST['mdp']);
$select->setFetchMode(PDO::FETCH_OBJ);
$select->execute();

$x = 0;
 while ($enregistrement = $select->fetch()){
 //echo '<h1>', $enregistrement->adresse, '</h1>';
 $_SESSION["utilisateur"] = $enregistrement->nom." ".$enregistrement->prenom;
 
echo" 4";
 echo $enregistrement->profil;
 $profil = $enregistrement->profil;
}
$_SESSION["profil"] = $profil;
echo $_SESSION["profil"];
include 'index.php';


?>


</body>