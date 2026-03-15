<?php
require_once __DIR__ . "/../donnees/Database.php";

class Visiteur {
    private $db;
    private int $num;
    private string $nom;
    private string $prenom;
    private string $labo;

    public function __construct(int $num, string $nom, string $prenom, string $labo) {
        $this->num = $num;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->labo = $labo;
    }

    public static function getById(int $num) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT viNum, viNom, viPrenom, lLibelle AS viLab FROM VISITEUR INNER JOIN LABO ON LABO.lCode = VISITEUR.viLabo WHERE viNum = ?");
            $stmt->execute([$num]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {

                return new Visiteur(
                    $result['viNum'],
                    $result['viNom'],
                    $result['viPrenom'],
                    $result['viLab']
                );
            } else return null;
        } catch (Exception $e) {
            error_log("Erreur Visiteur (getById): ". $e->getMessage());
            return null;
        }
    }

    public static function getByAuthentification(string $user, string $mdp) {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT viNum, viNom, viPrenom, lLibelle AS viLab FROM VISITEUR INNER JOIN LABO ON LABO.lCode = VISITEUR.viLabo WHERE viNom = ? AND viMdp = ?");
            $stmt->execute([$user, $mdp]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Visiteur(
                    $result['viNum'],
                    $result['viNom'],
                    $result['viPrenom'],
                    $result['viLab']
                );
            } else return null;
        } catch (Exception $e) {
            error_log("Erreur Visiteur (getByAuthentification): ". $e->getMessage());
            return null;
        }
    }

    public static function getAll(): array {
        try {
            $database = new Database();
            $db = $database->connexionDB();

            $stmt = $db->prepare("SELECT pNum, pNom, pPrenom, CONCAT(pRue.' '.pCP.' '.pVille) as pAdresse, rNom as pRegion, tLibelle as pSpecialite, tLieu as pLieu, pCoefNotoriete FROM PRATICIEN INNER JOIN REGION ON REGION.rCode = PRATICIEN.region INNER JOIN TYPE_PRATICIEN TP ON TP.tCode = PRATICIEN.tCode");
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $visiteurs = [];
            foreach ($results as $result) {
                $visiteurs[] = new Visiteur(
                    $result['viNum'],
                    $result['viNom'],
                    $result['viPrenom'],
                    $result['viLab']
                );
            }

            return $visiteurs;
        } catch (Exception $e) {
            error_log("Erreur Visiteur (getAll):". $e->getMessage());
            return [];
        }
    }

    public function getNum():int {
        return $this->num;
    }
    
    public function getNom():string{
        return $this->nom;
    }

    public function getPrenom():string{
        return $this->prenom;
    }

    public function getLabo():string{
        return $this->labo;
    }
}

?>