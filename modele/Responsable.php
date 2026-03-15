<?php
require_once __DIR__ . "/../donnees/Database.php";

class Responsable {
    private $db;

    public function __construct() {
        try {
            $database = new Database();
            $this->db = $database->connexionDB();
        } catch (Exception $e) {
            error_log("Erreur initialisation Responsable : " . $e->getMessage());
            throw $e;
        }
    }

}

?>