<?php 
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: /gsbapplicr/controleur/authentification.php');
        exit();
    }
?>