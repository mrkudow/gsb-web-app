<?php 
require_once __DIR__ . "/../donnees/Database.php";

class Medicament {
    private $db;
    private string $depotLegal;
    private string $nomCommercial;
    private string $famille;
    private string $composition;
    private string $effets;
    private string $contreIndications;
    private float $prix;

    /**
     * 
     */
    public function __construct(string $depotLegal, string $nomCommercial, string $famille, string $composition, string $effets, string $contreIndications, float $prix) {
        $this->depotLegal = $depotLegal;
        $this->nomCommercial = $nomCommercial;
        $this->famille = $famille;
        $this->composition = $composition;
        $this->effets = $effets;
        $this->contreIndications = $contreIndications;
        $this->prix = $prix;
    }

    /**
     * 
     */
    public static function getById(string $depotLegal) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT mDepotLegal, mNomCommercial, fLibelle AS mFamille, mComposition, mEffets, mContreIndications, mPrix FROM MEDICAMENT INNER JOIN FAMILLE ON FAMILLE.fCode = MEDICAMENT.fCode WHERE mDepotLegal = ?");
            $stmt->execute([$depotLegal]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Medicament(
                    $result['mDepotLegal'],
                    $result['mNomCommercial'],
                    $result['mFamille'],
                    $result['mComposition'],
                    $result['mEffets'],
                    $result['mContreIndications'],
                    $result['mPrix'] ?? -1.0
                );
            } else return null;
        } catch (Exception $e) {
            error_log("Erreur Medicament (getById): ". $e->getMessage());
            return null;
        }
    }

    /**
     * 
     */
    public static function getAllByVisite(string $code): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT mDepotLegal, mNomCommercial, fLibelle AS mFamille, mComposition, mEffets, mContreIndications, mPrix FROM MEDICAMENT INNER JOIN FAMILLE ON FAMILLE.fCode = MEDICAMENT.fCode INNER JOIN PRESENTATION ON mDepotLegal = prMedicament INNER JOIN VISITE ON vCode = prVisite WHERE vCode = ?");
            $stmt->execute([$code]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicaments = [];
            foreach ($results as $result) {
                $medicaments[] = new Medicament(
                    $result['mDepotLegal'],
                    $result['mNomCommercial'],
                    $result['mFamille'],
                    $result['mComposition'],
                    $result['mEffets'],
                    $result['mContreIndications'],
                    $result['mPrix'] ?? -1.0
                );                
            }

            return $medicaments;
        } catch (Exception $e) {
            error_log("Erreur Medicament (getAllByVisite):". $e->getMessage());
            return [];
        }
    }

    /**
     * 
     */
    public static function getAll(): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare('SELECT mDepotLegal, mNomCommercial, fLibelle AS mFamille, mComposition, mEffets, mContreIndications, mPrix FROM MEDICAMENT INNER JOIN FAMILLE ON FAMILLE.fCode = MEDICAMENT.fCode');
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $medicaments = [];
            foreach ($results as $result) {
                $medicaments[] = new Medicament(
                    $result['mDepotLegal'],
                    $result['mNomCommercial'],
                    $result['mFamille'],
                    $result['mComposition'],
                    $result['mEffets'],
                    $result['mContreIndications'],
                    $result['mPrix'] ?? -1.0
                );
            }

            return $medicaments;
        } catch (Exception $e) {
            error_log("Erreur Medicament (getAll):". $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère le dépôt légal du médicament.
     * @return string Dépôt légal du médicament.
     */
    public function getDepotLegal() {
        return $this->depotLegal;
    }

    /**
     * Récupère le nom commercial du médicament.
     * @return string Nom commercial du médicament.
     */
    public function getNomCommercial() {
        return $this->nomCommercial;
    }

    /**
     * Récupère la famille du médicament.
     * @return string Famille du médicament.
    */
    public function getFamille() {
        return $this->famille;
    }

    /**
     * Récupère la composition du médicament.
     * @return string Composition du médicament.
     */
    public function getComposition() {
        return $this->composition;
    }

    /**
     * Récupère les effets du médicament.
     * @return string Effets du médicament.
     */
    public function getEffets() {
        return $this->effets;
    }

    /**
     * Récupère les contres indications du médicament.
     * @return string Contre-indications du médicament.
     */
    public function getContreIndications() {
        return $this->contreIndications;
    }

    /**
     * Récupère le prix du médicament.
     * @return string Prix du médicament.
     */
    public function getPrix() {
        return $this->prix;
    }
}

?>