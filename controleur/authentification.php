<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/gsbapplicr/config.php');
require_once(BASE_PATH . 'modele/Visiteur.php');

session_start();

if (isset($_POST['identifiant']) && isset($_POST['mdp']) && !empty($_POST['identifiant']) && !empty($_POST['mdp'])) {
    $authentification = Visiteur::getByAuthentification($_POST['identifiant'], $_POST['mdp']);
    var_export($authentification);

    if ($authentification) {
        $_SESSION['user'] = $authentification;
        header('Location: /gsbapplicr/controleur/accueil.php');
    } else {
        header('Location: /gsbapplicr/controleur/authentification.php');
    }
    exit;
}

include_once(BASE_PATH. "vue/components/head.php");
include_once(BASE_PATH. "vue/components/navbar.php");
include_once(BASE_PATH. "vue/authentification.php");
include_once(BASE_PATH. "vue/components/footer.php");