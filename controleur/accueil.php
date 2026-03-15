<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/gsbapplicr/config.php');
require_once(BASE_PATH . 'modele/Visite.php');
require_once(BASE_PATH . 'modele/Visiteur.php');

include_once(BASE_PATH. "controleur/estAuthentifie.php");

$visites = Visite::getAllByVisiteur($_SESSION['user']->getNum());

include_once(BASE_PATH. "vue/components/head.php");
include_once(BASE_PATH. "vue/components/navbar.php");
include_once(BASE_PATH. "vue/accueil.php");
include_once(BASE_PATH. "vue/components/footer.php");

?>