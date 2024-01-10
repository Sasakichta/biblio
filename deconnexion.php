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