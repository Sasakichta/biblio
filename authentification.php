<?php
if (!isset($_POST['connexion']) and !isset($_SESSION['profil']) ) { //on affiche le formulaire de connexion si le membre n'a pas cliqué sur "envoyer"
    /* L'entrée btnEnvoyer est vide = le formulaire n'a pas été posté, on affiche le formulaire */

    echo ('<div class="container pt-5">
    <div class="d-flex justify-content-center">
        <div class="border border-5 border-dark p-4">
            <form name="connexion" method="post">
                <h2 class="text-center mb-4">Se connecter</h2>
                <div class="mb-3">
                    <label for="nom" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Saisissez votre e@mail">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp">
                </div>');
                
            if (isset($_REQUEST["recherche"])) {                                              //Verification pour éviter le crash lors d'une authentification sur la page recherche
            echo '<input type="hidden" name="recherche" value="'.$_REQUEST["recherche"].'">';
            }

                echo ('<div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit" name="connexion">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>');
}





if (isset($_POST['connexion'])) { //Lorsque qu'il clique sur le bouton de connexion

    //On recherche dans la table utilisateur pour connecter le membre avec son id et mdp correspondant
    require_once('connexion.php'); 
    $select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");  
    $select->bindValue(":mail", $_POST['id']);
    $select->bindValue(":mdp", $_POST['mdp']);
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();


    while ($enregistrement = $select->fetch()) {
        $_SESSION["utilisateur"] = $enregistrement->nom . " " . $enregistrement->prenom;
        $_SESSION["profil"] = $enregistrement->profil;
        $_SESSION["mail"] = $enregistrement->mel;
        $_SESSION["adresse"] = $enregistrement->adresse;
        $_SESSION["codepostal"] = $enregistrement->codepostal;
        $_SESSION["ville"] = $enregistrement->ville;
    }
    if (!isset($_REQUEST["recherche"])) {            //On refresh pas la page après connexion s'il est dans la page "recherche" car ça crash
        echo '<meta http-equiv="refresh" content="0" />';
        }
 
}

if (isset($_SESSION['profil']) ) { //Si l'utilisateur est connecté alors remplacer le formulaire de connexion par le formulaire de déconnexion

    ?>
    <div class="container pt-5">
        <div class="d-flex justify-content-center">
            <div class="border border-5 border-dark p-4">
                <form name="deconnexion" method="post" action="traitement_deconnexion.php">
                    <?php
                    echo "<h2 class='text-center mb-4'>" . $_SESSION["utilisateur"] . "</h2>";
                    echo "<br>";
                    echo "<h5 class='text-center mb-4'>" . "(" . $_SESSION["profil"] . ")" . "</h5>";

                    echo "<label for='nom' class='form-label text-center'>" . $_SESSION["mail"] . "</label>";
                    echo "<br>";
                    echo "<br>";

                    echo "<class='form-label text-center'>" . $_SESSION["adresse"];
                    echo "<br>";
                    echo "<class='form-label text-center'>" . $_SESSION["codepostal"] . ", " . $_SESSION["ville"];
                    ?>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Déconnexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>