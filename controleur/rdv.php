<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/gsbapplicr/config.php');
require_once(BASE_PATH . 'modele/Visite.php');
require_once(BASE_PATH . 'modele/Visiteur.php');
require_once(BASE_PATH . 'modele/Medicament.php');

include_once(BASE_PATH. "controleur/estAuthentifie.php");

$visite = Visite::getById($_POST['rdv']);
$praticien = $visite->getPraticien();
$echantillons = $visite->getEchantillons();
$visiteJour = date('d/m/Y', strtotime($visite->getDate()));
$visiteHeure = date('H:i', strtotime($visite->getDate()));

include_once(BASE_PATH. "vue/components/head.php");
include_once(BASE_PATH. "vue/components/navbar.php");
include_once(BASE_PATH. "vue/rdv.php");
include_once(BASE_PATH. "vue/components/footer.php");

?>