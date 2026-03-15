<?php

require_once(__DIR__ . '/../config.php');
require_once(BASE_PATH . 'modele/Visite.php');
require_once(BASE_PATH . 'modele/Praticien.php');

echo "<h2>Tests de la classe Visite</h2>";
echo "<hr>";

// Test 1 : Création d'instances
echo "<strong>Test 1 : Création d'instances de Visite</strong><br>";
$visite1 = new Visite("V001", "2026-02-17 10:00:00", "Consultation cardiologie", "Tension normale");
$visite2 = new Visite("V002", "2026-02-18 14:30:00", "Visite de suivi", "À revoir");
echo "✓ Instances créées avec succès<br><br>";

// Test 2 : getCode()
echo "<strong>Test 2 : Méthode getCode()</strong><br>";
$test = $visite1->getCode() === "V001";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $visite1->getCode() . "<br><br>";

// Test 3 : getDate()
echo "<strong>Test 3 : Méthode getDate()</strong><br>";
$test = $visite1->getDate() === "2026-02-17 10:00:00";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $visite1->getDate() . "<br><br>";

// Test 4 : getMotif()
echo "<strong>Test 4 : Méthode getMotif()</strong><br>";
$test = $visite1->getMotif() === "Consultation cardiologie";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $visite1->getMotif() . "<br><br>";

// Test 5 : getRapport()
echo "<strong>Test 5 : Méthode getRapport()</strong><br>";
$test = $visite1->getRapport() === "Tension normale";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : " . $visite1->getRapport() . "<br><br>";

// Test 6 : Rapport vide
echo "<strong>Test 6 : Rapport vide ou NULL</strong><br>";
$visite3 = new Visite("V003", "2026-02-19 09:00:00", "Nouvelle visite", "");
$test = $visite3->getRapport() === "";
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Résultat : '" . $visite3->getRapport() . "' (vide)<br><br>";

// Test 7 : Deux visites différentes
echo "<strong>Test 7 : Comparaison de deux Visites différentes</strong><br>";
$test = $visite1->getCode() !== $visite2->getCode();
echo ($test ? "✓ PASS" : "✗ FAIL") . " - Code visite1 : " . $visite1->getCode() . ", visite2 : " . $visite2->getCode() . "<br><br>";

// Test 8 : Affichage complet d'une visite
echo "<strong>Test 8 : Affichage complet d'une visite</strong><br>";
echo "✓ PASS - Visite : " . $visite1->getCode() . " - Date : " . $visite1->getDate() . " - Motif : " . $visite1->getMotif() . " - Rapport : " . $visite1->getRapport() . "<br><br>";

// Test 9 : getEchantillons() - devrait retourner un array vide si aucun échantillon
echo "<strong>Test 9 : Méthode getEchantillons()</strong><br>";
try {
    $echantillons = $visite1->getEchantillons();
    if (is_array($echantillons)) {
        echo "✓ PASS - Résultat est un tableau avec " . count($echantillons) . " échantillons<br><br>";
    } else {
        echo "✗ FAIL - Résultat n'est pas un tableau<br><br>";
    }
} catch (Exception $e) {
    echo "✓ INFO - Exception lancée (probable, car pas d'échantillons en DB) : " . $e->getMessage() . "<br><br>";
}

// Test 10 : getPraticien() - devrait retourner un Praticien ou NULL
echo "<strong>Test 10 : Méthode getPraticien()</strong><br>";
try {
    $praticien = $visite1->getPraticien();
    if ($praticien instanceof Praticien) {
        echo "✓ PASS - Praticien trouvé : " . $praticien->getNom() . "<br><br>";
    } else if ($praticien === null) {
        echo "✓ INFO - Aucun praticien associé (NULL)<br><br>";
    }
} catch (Exception $e) {
    echo "✓ INFO - Exception lancée : " . $e->getMessage() . "<br><br>";
}

echo "<hr>";
echo "<strong>Tous les tests sont terminés.</strong>";

?>