<?php

class Database {
    private $ip = '192.168.100.100';
    private $user = "adminGSB";
    private $pass = "g8sdvdb448";
    private $database = "gsbbdcr";

    public function connexionDB() {
        $dsn = "mysql:host={$this->ip};dbname={$this->database};charset=utf8mb4";
        try {
            $db = new PDO($dsn, $this->user, $this->pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            error_log("Erreur de connexion : " . $e->getMessage());
            die("Erreur de connexion à la base de données");
        }
    }
}

?>