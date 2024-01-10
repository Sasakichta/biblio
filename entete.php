<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}

?>

<div class="container-fluid">
  <div>
      <h3>La bibliothèque de Moulinsart est fermée au public jusqu'à nouvel ordre. Mais il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</h3>
  </div>

  <br>
  <br>
  <br>

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark rounded">
      <div class="container-fluid rounded">
          <form class="d-flex w-100" method="post" action="Affichagerecherche.php">
              <input class="form-control me-2 flex-grow-1" type="text" placeholder="Rechercher dans le catalogue (Saisie du nom de l'auteur)" name="recherche">
            </form>
             <a href="panier.php" class="btn btn-primary">Panier</a>
      </div>
  </nav>
</div>
