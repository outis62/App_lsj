<?php
// Commencez la session
session_start();

// Réinitialisez toutes les variables de session
$_SESSION = array();

// Détruisez la session
session_destroy();

// Redirigez vers une page de connexion ou d'accueil
header('Location: ../authentification.php');
exit;
?>
