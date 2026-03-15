<?php
require_once __DIR__ . "/../donnees/Database.php";

class Visite {
    private $db;
    private string $code;
    private string $date;
    private string $motif;
    private string $rapport;

    public function __construct(string $code, string $date, string $motif, string $rapport) {
        $this->code = $code;
        $this->date = $date;
        $this->motif = $motif;
        $this->rapport = $rapport;
    }

    public static function getById(int $num) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT vCode, vDate, vMotif, vRapport FROM VISITE WHERE vCode = ?");
            $stmt->execute([$num]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Visite(
                    $result['vCode'],
                    $result['vDate'],
                    $result['vMotif'],
                    $result['vRapport']
                );
            } else return null;
        } catch (Exception $e) {
            error_log("Erreur Visite (getById): ". $e->getMessage());
            return null;
        }
    }

    public static function getAll(): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT vCode, vDate, vMotif, vRapport FROM VISITE");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $visiteurs = [];
            foreach ($results as $result) {
                $visiteurs[] = new Visite(
                    $result['vCode'],
                    $result['vDate'],
                    $result['vMotif'],
                    $result['vRapport']
                );
            }

            return $visiteurs;
        } catch (Exception $e) {
            error_log("Erreur Visite (getAll):". $e->getMessage());
            return [];
        }
    }

    public static function getAllByVisiteur(int $num): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT vCode, vDate, vMotif, vRapport FROM VISITE WHERE vVisiteur = ?");
            $stmt->execute([$num]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $visiteurs = [];
            foreach ($results as $result) {
                $visiteurs[] = new Visite(
                    $result['vCode'],
                    $result['vDate'],
                    $result['vMotif'],
                    $result['vRapport']
                );
            }

            return $visiteurs;
        } catch (Exception $e) {
            error_log("Erreur Visite (getAllByVisiteur):". $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère le code de la visite
     * @return string Code de la visite.
    */
    public function getCode() {
        return $this->code;
    }

    /**
     * Récupère la date de la visite.
     * @return string Date de la visite.
    */ 
    public function getDate() {
        return $this->date;
    }
    
    /**
     * Récupère le motif de la visite.
     * @return string Motif de la visite.
    */
    public function getMotif() {
        return $this->motif;
    }

    /**
     * Récupère le rapport de la visite.
     * @return string Rapport de la visite.
    */
    public function getRapport() {
        return $this->rapport;
    }
    
    /**
     * Récupère le praticien de la visite.
     * @return Praticien Praticien de la visite.
    */
    public function getPraticien() {
        require_once(BASE_PATH . 'modele/Praticien.php');
        return Praticien::getByVisite($this->code);
    }
    
    /**
     * Récupère le premier médicament de la visite.
     * @return Medicament Premier médicament de la visite.
    */
    public function getEchantillons(): array {
        require_once(BASE_PATH . 'modele/Medicament.php');
        $echantillons = [];
        try {
            $database = new Database();
            $db = $database->connexionDB();
            foreach (Medicament::getAllByVisite($this->code) as $medicament) {
                $echantillon = [];

                $qteStmt = $db->prepare("SELECT prQteEchantillon FROM PRESENTATION WHERE prVisite = ? AND prMedicament = ?");
                $qteStmt->execute([$this->code, $medicament->getDepotLegal()]);
                $qte = $qteStmt->fetch(PDO::FETCH_ASSOC);

                if ($qte) {
                    $echantillon[] = $medicament;
                    $echantillon[] = $qte['prQteEchantillon'];
                    $echantillons[] = $echantillon;
                }
            }

            return $echantillons;
        } catch (Exception $e) {
            error_log("Erreur Visite (getEchantillons): ". $e->getMessage());
            return [];
        }
    }

    /**
     * Définit le praticien de la visite.
     * @param Praticien $praticien Praticien de la visite.
    */
    public function setPraticien(int $num) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("UPDATE PRATICIEN SET vPraticien = ? WHERE vCode = ?", [$num, $this->code]);
            $result = $stmt->execute();

            return $result;
        } catch (Exception $e) {
            error_log("Erreur Visite (setPraticien): ". $e->getMessage());
        }
    }
    
    public function addEchantillon(string $depotLegal) {
        require_once(BASE_PATH . 'modele/Medicament.php');
        try {
            $database = new Database();
            $db = $database->connexionDB();
            $addition = false;

            /** @var array $echantillons */
            $echantillons = $this->getEchantillons();
            $medicament = Medicament::getById($depotLegal);

            if (!$medicament) {
                error_log("Erreur Visite (addEchantillon): Médicament avec dépôt légal " . $depotLegal . " non trouvé.");
                return false;
            }

            foreach ($echantillons as $echantillon) {
                if ($echantillon[0]->getDepotLegal() === $depotLegal) {
                    $echantillon[1] += 1;
                    $stmt = $db->prepare("UPDATE PRESENTATION SET prQteEchantillon = ? WHERE prVisite = ? AND prMedicament = ?");
                    $stmt->execute([$echantillon[1], $this->code, $depotLegal]);
                    $addition = true;
                }
            }

            if (!$addition) {
                if (count($echantillons) >= 2) {
                    error_log("Erreur Visite (addEchantillon): Limite de 2 échantillons atteinte pour la visite " . $this->code);
                    return false;
                } else {
                    $stmt = $db->prepare("INSERT INTO PRESENTATION (prVisite, prMedicament, prQteEchantillon) VALUES (?, ?, ?)");
                    $result = $stmt->execute([$this->code, $depotLegal, 1]);
                    return $result;
                }
            }
        } catch (Exception $e) {
            error_log("Erreur Visite (addEchantillon): ". $e->getMessage());
        }
    }

    public function removeEchantillon(string $depotLegal, int $qte = 0) {
        require_once(BASE_PATH . 'modele/Medicament.php');
        try {
            $database = new Database();
            $db = $database->connexionDB();

            /** @var array $echantillons */
            $echantillons = $this->getEchantillons();
            $medicament = Medicament::getById($depotLegal);

            if (!$medicament) {
                error_log("Erreur Visite (removeEchantillon): Médicament avec dépôt légal " . $depotLegal . " non trouvé.");
                return false;
            }

            foreach ($echantillons as $echantillon) {
                if ($echantillon[0]->getDepotLegal() === $depotLegal) {
                    $echantillon[1] -= $qte;
                    if ($echantillon[1] < 1) {
                        $stmt = $db->prepare("DELETE FROM PRESENTATION WHERE prVisite = ? AND prMedicament = ?");
                        $result = $stmt->execute([$this->code, $depotLegal]);
                    } else {
                        $stmt = $db->prepare("UPDATE PRESENTATION SET prQteEchantillon = ? WHERE prVisite = ? AND prMedicament = ?");
                        $result = $stmt->execute([$echantillon[1], $this->code, $depotLegal]);
                    }
                }
            }

            return $result;
        } catch (Exception $e) {
            error_log("Erreur Visite (removeEchantillon): ". $e->getMessage());
        }
    }
}

?>