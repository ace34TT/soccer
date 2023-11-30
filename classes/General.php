<?php

require_once 'flight/Flight.php';

class General
{
    public function __construct()
    {
        // parent::__construct();
    }
    public static function findAll()
    {
        $db = Flight::db();
        $stmt = $db->query('SELECT * FROM v_StatsEquipeGeneral');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        Flight::json($result);
        header('Content-Type: text/html; charset=utf-8');
    }
    public static function findType($typeEquipe)
    {
        $db = Flight::db();
        $sql = "SELECT * FROM v_StatsEquipeGeneral WHERE idTypeEquipe = %s";
        $sql = sprintf($sql, $typeEquipe);
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        Flight::json($result);
    }

    public static function insert($idCompetEquipe, $buts, $carteJaune, $carteRouge, $possession, $passesReussies, $AeriensGagnes, $noteEquipe)
    {
        $db = Flight::db();
        $sql = "INSERT INTO StatsEquipe VALUES (null, %d, %d, %d, %d, %d, %d, %d, %d )";
        $sql = sprintf($sql, $idCompetEquipe, $buts, $carteJaune, $carteRouge, $possession, $passesReussies, $AeriensGagnes, $noteEquipe);
        $stmt = $db->query($sql);
        $db = null;
    }
}
