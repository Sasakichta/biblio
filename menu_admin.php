<?php 
if (isset($_GET['option'])) {
$option = $_GET['option'];
}
else {
$option = 'membre';
}

// On se  connecte, voir code du fichier connexion.php ci-dessus
require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois
?>


<div class="container-fluid">
  <div>
      <?php
      if ($option == 'livre') { ?>


        <div class="container pt-5">
                <div class="d-flex justify-content-center">
                    <div class="border border-5 border-dark p-4">
                        <form name="connexion" method="post">
                            <h2 class="text-center mb-4">Ajouter un livre</h2>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Auteur</label>
                                <input type="text" class="form-control" id="auteur" name="auteur" placeholder="Saisissez votre e@mail">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Titre</label>
                                <input type="password" class="form-control" id="titre" name="titre">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">ISBN13</label>
                                <input type="password" class="form-control" id="ISBN13" name="ISBN13">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Année de parution</label>
                                <input type="password" class="form-control" id="annee_parution" name="annee_parution">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Résumé</label>
                                <input type="password" class="form-control" id="resume" name="resume">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Image</label>
                                <input type="password" class="form-control" id="image" name="image">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit" name="connexion">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


     <?php 
     

    $select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");

    //Trouver le dernier numéro de livre pour incrémentation automatique
    $select = $connexion->prepare("SELECT MAX(nolivre) FROM livre");
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();

    while ($enregistrement = $select->fetch()) {
        $dernier_nolivre = $enregistrement->nolivre;
    }
    //Fin de recherche de nolivre


    //Recherche du numéro d'auteur via le nom donné
    $select = $connexion->prepare("SELECT noauteur FROM auteur where nom=:nomAuteur");
    $select->bindValue(":nomAuteur", $_REQUEST["auteur"]);
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();

    while ($enregistrement = $select->fetch()) {
        $noAuteur = $enregistrement->noauteur;
    }
    //Fin de recherche de noauteur

    $select = $connexion->prepare('INSERT INTO livre (`nolivre`, `noauteur`, `titre`, `isbn13`, `anneeparution`, `resume`, `dateajout`, `image`) 
    VALUES ($dernier_nolivre + 1, $noAuteur, $_REQUEST["titre"], $noAuteur, $_REQUEST["ISBN13"], $noAuteur, $_REQUEST["annee_parution"], "resume.", "2023-12-22", "https://lien.com/images/image.jpg")');
    
    
    }
//Fin d'ajout de livre



    // Affichage du menu pour créer un membre
      else if ($option == 'membre') {
        ?>
        
            <div class="container pt-5">
                <div class="d-flex justify-content-center">
                    <div class="border border-5 border-dark p-4">
                        <form name="connexion" method="post">
                            <h2 class="text-center mb-4">Créer un membre</h2>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Mail</label>
                                <input type="text" class="form-control" id="mail" name="mail" placeholder="Saisissez votre e@mail">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="mdp" name="mdp">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Nom</label>
                                <input type="password" class="form-control" id="nom" name="nom">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="password" class="form-control" id="prenom" name="prenom">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Adresse</label>
                                <input type="password" class="form-control" id="adresse" name="adresse">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Ville</label>
                                <input type="password" class="form-control" id="ville" name="ville">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Code Postal</label>
                                <input type="password" class="form-control" id="cp" name="cp">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit" name="connexion">Créer un membre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

      <?php




      }
      ?>
  </div>
</div>