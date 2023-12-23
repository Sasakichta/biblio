<?php 
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois


$select = $connexion->prepare("SELECT image FROM livre ORDER BY dateajout desc");

 // $select->bindValue(":codeActivite", $codeActivite);

  $select->setFetchMode(PDO::FETCH_OBJ);
  $select->execute();

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
  <p class="text-center mb-1">Ci-dessus un apperçu de nos 2 dernières aquisitions.</p>
    <br>
</div>');

echo '<div id="demo" class="carousel slide" data-bs-ride="carousel">';

  // Indicators/dots
 echo ('<div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
  </div>');
  
  //The slideshow/carousel

  echo '<div class="carousel-inner">
    <div class="carousel-item active">
      <img src='.$Image.' alt="Los Angeles" class="d-block" style="width:100%">
    </div>';
    echo '<div class="carousel-item">
      <img src='.$Image2.' alt="Chicago" class="d-block" style="width:100%">
    </div>
  </div>';
  
  // Left and right controls/icons
  echo ('<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>');

?>