<?php 
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois

$select = $connexion->prepare("SELECT image FROM livre ORDER BY dateajout desc"); //On selectionne les images de la bdd dans l'ordre décroissant (2 derniers ajout)
$select->setFetchMode(PDO::FETCH_OBJ);
$select->execute();


//On defini les images des 2 derniers ajouts dans des variables qu'on affiche ensuite dans le carroussel
$compteur=0;
 while ($enregistrement = $select->fetch()){
  if ($compteur==0) {
    $Image=$enregistrement->image;
  }
  if ($compteur==1) {
    $Image2=$enregistrement->image;
  }
 $compteur ++;
}







echo ('<div class="container-fluid mt-3">
  <h3 class="text-center mb-1">⬇️ Derniers ajouts ⬇️</h3>
  <p class="text-center mb-1">Ci-dessous un apperçu de nos 2 dernières aquisitions.</p>
    <br>
</div>');


echo '<div id="demo" class="carousel slide" data-bs-ride="carousel">';

  // Les boutons indicateurs du carroussel
 echo ('<div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
  </div>');
  
  //Les images du carroussel
  echo '<div class="carousel-inner">
    <div class="carousel-item active">
      <img src='.$Image.' alt="image" class="d-block" style="width:100%">
    </div>';
    echo '<div class="carousel-item">
      <img src='.$Image2.' alt="image" class="d-block" style="width:100%">
    </div>
  </div>';
  
  //Les flèches de control du carroussel
  echo ('<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>');



// mit en commentaire car jugé inutile par vs code
// mais contenant la balise fermante de php