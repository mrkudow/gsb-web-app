<?php

require_once(__DIR__ . '/../config.php');
require_once(BASE_PATH . 'modele/Praticien.php');

echo "<h2>Tests de la classe Praticien</h2>";
echo "<hr>";

// Test 1 : Création d'instances
echo "<strong>Test 1 : Création d'instances de Praticien</strong><br>";
$praticien1 = new Praticien(123, "Martin", "Jean", "123 Rue de Paris 75001", "Île-de-France", "Cardiologue", "Hôpital X", "9.5");
$praticien2 = new Praticien(456, "Dupont", "Marie", "456 Rue de Lyon 69000", "Rhône-Alpes", "Dermatologue", "Clinique Y", "8.2");
echo "✓ Instances créées avec succès<br><br>";

// Test 2 : getNum()
echo "<strong>Test 2 : Méthode getNum()</strong><br>";
$test = $praticien1->getNum() === 123;
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getNum() . "<br><br>";

// Test 3 : getNom()
echo "<strong>Test 3 : Méthode getNom()</strong><br>";
$test = $praticien1->getNom() === "Martin";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getNom() . "<br><br>";

// Test 4 : getPrenom()
echo "<strong>Test 4 : Méthode getPrenom()</strong><br>";
$test = $praticien1->getPrenom() === "Jean";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getPrenom() . "<br><br>";

// Test 5 : getAdresse()
echo "<strong>Test 5 : Méthode getAdresse()</strong><br>";
$test = $praticien1->getAdresse() === "123 Rue de Paris 75001";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getAdresse() . "<br><br>";

// Test 6 : getRegion()
echo "<strong>Test 6 : Méthode getRegion()</strong><br>";
$test = $praticien1->getRegion() === "Île-de-France";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getRegion() . "<br><br>";

// Test 7 : getSpecialite()
echo "<strong>Test 7 : Méthode getSpecialite()</strong><br>";
$test = $praticien1->getSpecialite() === "Cardiologue";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getSpecialite() . "<br><br>";

// Test 8 : getLieu()
echo "<strong>Test 8 : Méthode getLieu()</strong><br>";
$test = $praticien1->getLieu() === "Hôpital X";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getLieu() . "<br><br>";

// Test 9 : getCoefNotoriete()
echo "<strong>Test 9 : Méthode getCoefNotoriete()</strong><br>";
$test = $praticien1->getCoefNotoriete() === "9.5";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $praticien1->getCoefNotoriete() . "<br><br>";

// Test 10 : Comparaison de deux praticiens différents
echo "<strong>Test 10 : Comparaison de deux Praticiens différents</strong><br>";
$test = $praticien1->getNum() !== $praticien2->getNum();
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Num praticien1 : " . $praticien1->getNum() . ", praticien2 : " . $praticien2->getNum() . "<br><br>";

// Test 11 : Vérification du nom complet
echo "<strong>Test 11 : Affichage du nom complet</strong><br>";
$nomComplet = "Dr. " . $praticien1->getNom() . " " . $praticien1->getPrenom();
echo "✓ PASS - Nom complet : " . $nomComplet . "<br><br>";

echo "<hr>";
echo "<strong>Tous les tests sont terminés.</strong>";

?>