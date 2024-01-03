<div class="container pt-5">
    <div class="d-flex justify-content-center">
        <div class="border border-5 border-dark p-4">
            <form name="connexion" method="post" action="traitement.php">
                <h2 class="text-center mb-4">Se connecter</h2>
                <div class="mb-3">
                    <label for="nom" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Saisissez votre e@mail">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>
