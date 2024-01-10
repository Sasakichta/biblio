<?php
// Démarrer la session
session_start();

// Détruire la session si elle existe
if (isset($_SESSION)) {
    session_unset();
    session_destroy();
}

// Redirection vers la page d'accueil après la déconnexion
header("Location: index.php");
exit();
?>

