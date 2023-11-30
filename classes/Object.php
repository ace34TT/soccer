<?php

require_once 'flight/Flight.php';

class General
{
    public function __construct()
    {
        // parent::__construct();
    }
    public static function insertJoueur($nomJoueur, $idEquipe, $numero)
    {
        $db = Flight::db();
        $sql = "INSERT INTO StatsEquipe VALUES (null, '%s', %s, %s)";
        $sql = sprintf($nomJoueur, $idEquipe, $numero);
        $stmt = $db->query($sql);
        $db = null;
    }
}
