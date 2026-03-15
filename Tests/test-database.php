<?php

require_once(__DIR__ . '/../config.php');
require_once(BASE_PATH . 'donnees/Database.php');
require_once(BASE_PATH . 'modele/Visiteur.php');

echo "<h2>Tests de la base de données</h2>";
echo "<hr>";

// Test 1 : Connexion à la base de données
echo "<strong>Test 1 : Connexion à la base de données</strong><br>";
try {
    $database = new Database();
    $db = $database->connexionDB();
    if ($db !== null) {
        echo "✓ PASS - Connexion établie avec succès<br><br>";
    } else {
        echo "✗ FAIL - La connexion est NULL<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur de connexion : " . $e->getMessage() . "<br><br>";
}

// Test 2 : Test d'authentification valide avec Visiteur::getByAuthentification
echo "<strong>Test 2 : Authentification valide</strong><br>";
try {
    // Remplacez "Erreip" et "jGBh50bCgX" par un visiteur valide en base de données
    $visiteur = Visiteur::getByAuthentification("Erreip", "jGBh50bCgX");
    if ($visiteur !== null) {
        echo "✓ PASS - Visiteur trouvé : " . $visiteur->getNom() . " " . $visiteur->getPrenom() . "<br><br>";
    } else {
        echo "✗ FAIL - Aucun visiteur trouvé avec ces identifiants<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur lors de l'authentification : " . $e->getMessage() . "<br><br>";
}

// Test 3 : Test d'authentification invalide (mot de passe incorrect)
echo "<strong>Test 3 : Authentification invalide (mdp incorrect)</strong><br>";
try {
    $visiteur = Visiteur::getByAuthentification("Erreip", "mdp_incorrect");
    if ($visiteur === null) {
        echo "✓ PASS - Aucun visiteur trouvé (mdp incorrect, c'est normal)<br><br>";
    } else {
        echo "✗ FAIL - Un visiteur a été trouvé alors que le mdp est incorrect<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur lors de l'authentification : " . $e->getMessage() . "<br><br>";
}

// Test 4 : Test d'authentification invalide (nom d'utilisateur incorrect)
echo "<strong>Test 4 : Authentification invalide (identifiant incorrect)</strong><br>";
try {
    $visiteur = Visiteur::getByAuthentification("utilisateur_inexistant", "jGBh50bCgX");
    if ($visiteur === null) {
        echo "✓ PASS - Aucun visiteur trouvé (identifiant incorrect, c'est normal)<br><br>";
    } else {
        echo "✗ FAIL - Un visiteur a été trouvé alors que l'identifiant est incorrect<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur lors de l'authentification : " . $e->getMessage() . "<br><br>";
}

// Test 5 : Test getById pour récupérer un visiteur par son ID
echo "<strong>Test 5 : Récupération d'un visiteur par ID (Visiteur::getById)</strong><br>";
try {
    // Vous devez adapter le numéro à un ID valide en base de données
    $visiteur = Visiteur::getById(1);
    if ($visiteur !== null) {
        echo "✓ PASS - Visiteur trouvé : " . $visiteur->getNom() . " (ID: " . $visiteur->getNum() . ")<br><br>";
    } else {
        echo "✓ INFO - Aucun visiteur avec l'ID 1 (peut être normal selon la base)<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur lors de la requête : " . $e->getMessage() . "<br><br>";
}

// Test 6 : Affichage des properties du visiteur authentifié
echo "<strong>Test 6 : Affichage complet d'un visiteur authentifié</strong><br>";
try {
    $visiteur = Visiteur::getByAuthentification("Erreip", "jGBh50bCgX");
    if ($visiteur !== null) {
        echo "✓ PASS<br>";
        echo "  - Numéro : " . $visiteur->getNum() . "<br>";
        echo "  - Nom : " . $visiteur->getNom() . "<br>";
        echo "  - Prénom : " . $visiteur->getPrenom() . "<br>";
        echo "  - Labo : " . $visiteur->getLabo() . "<br><br>";
    } else {
        echo "✓ INFO - Visiteur non trouvé<br><br>";
    }
} catch (Exception $e) {
    echo "✗ FAIL - Erreur lors de l'authentification : " . $e->getMessage() . "<br><br>";
}

echo "<hr>";
echo "<strong>Tous les tests sont terminés.</strong>";

?>