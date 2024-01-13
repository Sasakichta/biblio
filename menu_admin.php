<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}

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
      if ($option == 'livre') { 



        //Menu d'ajout de livre
        ?>
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
                                <button class="btn btn-primary" type="submit" name="ajouter">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         <?php 
    //Fin menu d'ajout de livre 




    //$select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");


    if (isset($_POST['ajouter'])) { //on execute que si le membre a cliqué sur "envoyer"

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



    //Fonction date pour récuperer la date du jour au format (xxxx-xx-xx) (annee, mois, jour)
    $date_jour = date("y-m-j");  
    //Fin de fonction date



    //On ajoute le livre
    $select = $connexion->prepare('INSERT INTO livre (`nolivre`, `noauteur`, `titre`, `isbn13`, `anneeparution`, `resume`, `dateajout`, `image`) 
    VALUES ($dernier_nolivre + 1, $noAuteur, $_REQUEST["titre"], $_REQUEST["ISBN13"], $_REQUEST["annee_parution"], $_REQUEST["resume"], $date_jour, $_REQUEST["image"])');
    //Fin de l'ajout
    
    }
    
}

//Fin d'ajout de livre



    // Affichage du menu pour créer un membre
      else if ($option == 'membre') {
        //Si cette action est éxecuté c'est qu'un mauvais mail à été rentré précédemment lors de la création du compte membre
        //Alors, en avertir l'utilisateur
        //cette verification est faite plus bas
        if(isset($_SESSION["mail_donne"]) and $_SESSION["mail_donne"] == "MAUVAIS MAIL") {
           echo ('<div class="container pt-5">
                <div class="d-flex justify-content-center">
                    <div class="border border-5 border-dark p-4">');
                        echo ("Erreur : Le mail rentré existe déja dans la base de donnée. <br><br>Veuillez rafraîchir la page.");
                    echo ('</div>
                </div>
            </div>');
            unset($_SESSION["mail_donne"]);
        }
        //Fin de verif du mail

        else if(!isset($_SESSION["mail_donne"]) or $_SESSION["mail_donne"] != "MAUVAIS MAIL") {
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
                                <button class="btn btn-primary" type="submit" name="creer">Créer un membre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      <?php
        }
    // Fin de l'affichage du menu pour créer un membre

    if (isset($_POST['creer'])) { //on execute que si le membre a cliqué sur "envoyer"
        
        //On verifie si le mail donné n'existe pas déja
            $select = $connexion->prepare("SELECT mel FROM utilisateur");
            $select->setFetchMode(PDO::FETCH_OBJ);
            $select->execute();

            while ($enregistrement = $select->fetch()) {
                $mail = $enregistrement->mel;
                if (isset($_REQUEST["mail"]) and $mail == $_REQUEST["mail"]) {
                    $mail = "MAUVAIS MAIL";
                    $_SESSION["mail_donne"] = $mail; // pour pas perdre la verification on la passe en var de session vu qu'on va refresh la page
                    echo '<meta http-equiv="refresh" content="0" />'; //On refresh la page
                }
            }
        //Fin de verif mail

    //On créer le membre
    if (!empty($_REQUEST["mail"])) {
        $select = $connexion->prepare('INSERT INTO utilisateur (`mel`, `motdepasse`, `nom`, `prenom`, `adresse`, `ville`, `codepostal`, `profil`) 
        VALUES (:mail, :mdp, :nom, :prenom, :adresse, :ville, :cp, "Membre")');
    
        $select->bindParam(':mail', $_REQUEST["mail"]);
        $select->bindParam(':mdp', $_REQUEST["mdp"]);
        $select->bindParam(':nom', $_REQUEST["nom"]);
        $select->bindParam(':prenom', $_REQUEST["prenom"]);
        $select->bindParam(':adresse', $_REQUEST["adresse"]);
        $select->bindParam(':ville', $_REQUEST["ville"]);
        $select->bindParam(':cp', $_REQUEST["cp"]);
    
        $select->execute();

        echo "Création réussie";
    } else {
        // Gérer le cas où le champ mail est vide
        echo 'Erreur : Le champ "Mail" ne peut pas être vide.';
    }
    //Fin de la création
      }
}
      ?>
  </div>
</div>