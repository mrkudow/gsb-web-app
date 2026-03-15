<?php
require_once __DIR__ . "/../donnees/Database.php";

class Praticien
{
    private int $num;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $region;
    private string $specialite;
    private string $lieu;
    private float $coefNotoriete;

    public function __construct(int $num, string $nom, string $prenom, string $adresse, string $region, string $specialite, string $lieu, string $coefNotoriete) {
        $this->num = $num;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->region = $region;
        $this->specialite = $specialite;
        $this->lieu = $lieu;
        $this->coefNotoriete = $coefNotoriete;
    }

    public static function getById(int $num) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT pNum, pNom, pPrenom, CONCAT(pRue, ' ', pCP, ' ', pVille) as pAdresse, rNom as pRegion, tLibelle as pSpecialite, tLieu as pLieu, pCoefNotoriete FROM PRATICIEN INNER JOIN REGION ON REGION.rCode = PRATICIEN.region INNER JOIN TYPE_PRATICIEN TP ON TP.tCode = PRATICIEN.tCode WHERE pNum = ?");
            $stmt->execute([$num]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                return new Praticien(
                    $result['pNum'],
                    $result['pNom'],
                    $result['pPrenom'],
                    $result['pAdresse'],
                    $result['pRegion'],
                    $result['pSpecialite'],
                    $result['pLieu'],
                    $result['pCoefNotoriete']
                );
            } else return null;
        } catch (Exception $e) {
            error_log("Erreur Praticien (getById): " . $e->getMessage());
            return null;
        }
    }

    public static function getByVisite(int $code) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT pNum, pNom, pPrenom, CONCAT(pRue, ' ', pCP, ' ', pVille) as pAdresse, rNom as pRegion, tLibelle as pSpecialite, tLieu as pLieu, pCoefNotoriete FROM PRATICIEN INNER JOIN REGION ON REGION.rCode = PRATICIEN.region INNER JOIN TYPE_PRATICIEN TP ON TP.tCode = PRATICIEN.tCode INNER JOIN VISITE ON VISITE.vPraticien = PRATICIEN.pNum WHERE VISITE.vCode = ?");
            $stmt->execute([$code]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Praticien(
                    $result['pNum'],
                    $result['pNom'],
                    $result['pPrenom'],
                    $result['pAdresse'],
                    $result['pRegion'],
                    $result['pSpecialite'],
                    $result['pLieu'],
                    $result['pCoefNotoriete']
                );
            } else return null;
        } catch (Exception $e) {
            error_log('Erreur Praticien (getByVisite): ' . $e->getMessage());
        }
    }

    public static function getAll(): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT pNum, pNom, pPrenom, CONCAT(pRue, ' ', pCP, ' ', pVille) as pAdresse, rNom as pRegion, tLibelle as pSpecialite, tLieu as pLieu, pCoefNotoriete FROM PRATICIEN INNER JOIN REGION ON REGION.rCode = PRATICIEN.region INNER JOIN TYPE_PRATICIEN TP ON TP.tCode = PRATICIEN.tCode");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $praticiens = [];
            foreach ($results as $result) {
                $praticiens[] = new Praticien(
                    $result['pNum'],
                    $result['pNom'],
                    $result['pPrenom'],
                    $result['pAdresse'],
                    $result['pRegion'],
                    $result['pSpecialite'],
                    $result['pLieu'],
                    $result['pCoefNotoriete']
                );
            }

            return $praticiens;
        } catch (Exception $e) {
            error_log("Erreur Praticien (getAll):" . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère le numéro du praticien.
     */
    public function getNum() {
        return $this->num;
    }

    /**
     * Récupère le nom du praticien.
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Récupère le prénom du praticien.
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Récupère l'adresse du praticien.
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Récupère la région du praticien.
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Récupère la spécialité du praticien.
     */
    public function getSpecialite() {
        return $this->specialite;
    }

    /**
     * Récupère le lieu de travail du praticien.
     */
    public function getLieu() {
        return $this->lieu;
    }

    /**
     * Récupère le coefficient de notoriété du praticien.
     */
    public function getCoefNotoriete() {
        return $this->coefNotoriete;
    }
}
