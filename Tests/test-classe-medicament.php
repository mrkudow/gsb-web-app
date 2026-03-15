<?php

require_once(__DIR__ . '/../config.php');
require_once(BASE_PATH . 'modele/Medicament.php');

echo "<h2>Tests de la classe Medicament</h2>";
echo "<hr>";

// Test 1 : Création d'instances
echo "<strong>Test 1 : Création d'instances de Medicament</strong><br>";
$medicament1 = new Medicament("123456", "Aspirine", "Analgésique", "Acide acétylsalicylique", "Diminue la douleur", "Contre-indications", 5.50);
$medicament2 = new Medicament("654321", "Doliprane", "Analgésique", "Paracétamol", "Diminue la fièvre", "Allergies", 4.00);
echo "✓ Instances créées avec succès<br><br>";

// Test 2 : getDepotLegal()
echo "<strong>Test 2 : Méthode getDepotLegal()</strong><br>";
$test = $medicament1->getDepotLegal() === "123456";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getDepotLegal() . "<br><br>";

// Test 3 : getNomCommercial()
echo "<strong>Test 3 : Méthode getNomCommercial()</strong><br>";
$test = $medicament1->getNomCommercial() === "Aspirine";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getNomCommercial() . "<br><br>";

// Test 4 : getFamille()
echo "<strong>Test 4 : Méthode getFamille()</strong><br>";
$test = $medicament1->getFamille() === "Analgésique";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getFamille() . "<br><br>";

// Test 5 : getComposition()
echo "<strong>Test 5 : Méthode getComposition()</strong><br>";
$test = $medicament1->getComposition() === "Acide acétylsalicylique";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getComposition() . "<br><br>";

// Test 6 : getEffets()
echo "<strong>Test 6 : Méthode getEffets()</strong><br>";
$test = $medicament1->getEffets() === "Diminue la douleur";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getEffets() . "<br><br>";

// Test 7 : getContreIndications()
echo "<strong>Test 7 : Méthode getContreIndications()</strong><br>";
$test = $medicament1->getContreIndications() === "Contre-indications";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getContreIndications() . "<br><br>";

// Test 8 : getPrix()
echo "<strong>Test 8 : Méthode getPrix()</strong><br>";
$test = $medicament1->getPrix() === 5.50;
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $medicament1->getPrix() . "<br><br>";

// Test 9 : Prix NULL avec opérateur ??
echo "<strong>Test 9 : Méthode getPrix() avec valeur NULL (??)</strong><br>";
$medicament3 = new Medicament("999999", "Ibuprofène", "Analgésique", "Ibudol", "Anti-inflammatoire", "Asthme", 0.0);
$test = $medicament3->getPrix() === null;
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . ($medicament3->getPrix() === null ? "NULL" : $medicament3->getPrix()) . "<br><br>";

// Test 10 : Deux objets différents
echo "<strong>Test 10 : Comparaison de deux Medicaments différents</strong><br>";
$test = $medicament1->getDepotLegal() !== $medicament2->getDepotLegal();
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Dépôt légal medicament1 : " . $medicament1->getDepotLegal() . ", medicament2 : " . $medicament2->getDepotLegal() . "<br><br>";

echo "<hr>";
echo "<strong>Tous les tests sont terminés.</strong>";

?>