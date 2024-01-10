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
                
            if (isset($_REQUEST["recherche"])) {
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





if (isset($_POST['connexion'])) {
    require_once('connexion.php'); // once : le fichier ne peut être inclus qu'une fois



    //$codeActivite = $_REQUEST["activite"];

    // $select = $connexion->prepare("SELECT * FROM action where numeroActivite=:codeActivite");
    $select = $connexion->prepare("SELECT * FROM utilisateur where mel=:mail AND motdepasse=:mdp");


    $select->bindValue(":mail", $_POST['id']);
    $select->bindValue(":mdp", $_POST['mdp']);
    $select->setFetchMode(PDO::FETCH_OBJ);
    $select->execute();

    $x = 0;
    while ($enregistrement = $select->fetch()) {
        //echo '<h1>', $enregistrement->adresse, '</h1>';
        $_SESSION["utilisateur"] = $enregistrement->nom . " " . $enregistrement->prenom;
        $_SESSION["profil"] = $enregistrement->profil;
        $_SESSION["mail"] = $enregistrement->mel;
        $_SESSION["adresse"] = $enregistrement->adresse;
        $_SESSION["codepostal"] = $enregistrement->codepostal;
        $_SESSION["ville"] = $enregistrement->ville;
    }

}

if (isset($_SESSION['profil']) ) {

    //if sesion admin alors redirection page admin


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
    /* echo ('<div class="container pt-5">
    <div class="d-flex justify-content-center">
        <div class="border border-5 border-dark p-4">
            <form name="deconnexion" method="post" action="traitement_deconnexion.php">
                
             "<h2 class="text-center mb-4">"'.$_SESSION["utilisateur"].'</h2>
             <br>"
             <h5 class="text-center mb-4">'."(".$_SESSION["profil"].")".'</h5>
    
             <label for="nom" class="form-label text-center">"'.$_SESSION["mail"].'</label>
             "<br>"
             "<br>"

             "<class="form-label text-center">'.$_SESSION["adresse"].
             '<br>"
             "<class="form-label text-center">'.$_SESSION["codepostal"].", ".$_SESSION["ville"].
                
                '<div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Déconnexion</button>
                </div>
            </form>
        </div>
    </div>
</div>');
*/



}
//echo $_SESSION['profil'];
?>