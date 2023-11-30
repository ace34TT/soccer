<?php

require_once 'flight/Flight.php';

class Attaque
{
    public function __construct()
    {
        // parent::__construct();
    }
    public static function findAll()
    {
        $db = Flight::db();
        $stmt = $db->query('SELECT * FROM v_StatsEquipeAttaque');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        Flight::json($result);
        header('Content-Type: text/html; charset=utf-8');
    }
    public static function findType($typeEquipe)
    {
        $db = Flight::db();
        $sql = "SELECT * FROM v_StatsEquipeAttaque WHERE idTypeEquipe = %s";
        $sql = sprintf($sql, $typeEquipe);
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        Flight::json($result);
    }
    public static function insert($idCompetEquipe, $tirsPmAttaque, $tirsCAPm, $driblesPm, $fautesSubiesPm, $note)
    {
        $db = Flight::db();
        $sql = "INSERT INTO StatsEquipeAttaque VALUES (null, %d, %d, %d, %d, %d, %d)";
        $sql = sprintf($sql, $idCompetEquipe, $tirsPmAttaque, $tirsCAPm, $driblesPm, $fautesSubiesPm, $note);
        $stmt = $db->query($sql);
        $db = null;
    }
}
