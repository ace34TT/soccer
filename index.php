<?php

require_once 'flight/Flight.php';
require_once 'classes/General.php';
require_once 'classes/Attaque.php';
require_once 'classes/Defense.php';

Flight::route('/', function () {
    echo 'hello world!';
});
const DB_CONFIG = array('mysql:host=localhost;dbname=football', 'root', 'root');
const CONTEXT = 'http://localhost:80/football';
Flight::register('db', 'PDO', DB_CONFIG,
    function($db){
        try {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
);
//liste de tous les equipes en general
Flight::route('GET /stat/equip', function () {
    General::findAll();
});
//liste de tous les equipes domiciles en general
Flight::route('GET /stat/equip/domicile+', function () {
    General::findType(1);
});
//liste de tous les equipes exterieurs en general
Flight::route('GET /stat/equip/exterieur+', function () {
    General::findType(2);
});
//inserer nouveau statistiques en generale de 1 equipe
Flight::route('POST /stat/equip/@idCompetEquipe/@buts/@carteJaune/@carteRouge/@possesion/@passesReussies/@AeriensGagnes/@noteEquipe', function ($idCompetEquipe, $buts, $carteJaune, $carteRouge, $possession, $passesReussies, $AeriensGagnes, $noteEquipe) {
    General::insert($idCompetEquipe, $buts, $carteJaune, $carteRouge, $possession, $passesReussies, $AeriensGagnes, $noteEquipe);  
});

//liste de tous les equipes plan attacque
Flight::route('GET /stat/equip/attack', function () {
    Attaque::findAll();
});
//liste de tous les equipes domiciles plan attacque 
Flight::route('GET /stat/equip/attack/domicile+', function () {
    Attaque::findType(1);
});
//liste de tous les equipes exterieur plan attacque 
Flight::route('GET /stat/equip/attack/exterieur+', function () {
    Attaque::findType(2);
});
//inserer nouveau statistiques attaque de 1 equipe
Flight::route('POST /stat/equip/attack/@idCompetEquipe/@tirsPmAttaque/@tirsCAPm/@driblesPm/@fautesSubiesPm/@note', function ($idCompetEquipe,$tirsPmAttaque,$tirsCAPm,$driblesPm,$fautesSubiesPm,$note) {
    Attaque::insert($idCompetEquipe,$tirsPmAttaque,$tirsCAPm,$driblesPm,$fautesSubiesPm,$note);  
});
//liste de tous les equipes plan defense 
Flight::route('GET /stat/equip/defense', function () {
    Defense::findAll();
});
//liste de tous les equipes domiciles plan defense
Flight::route('GET /stat/equip/defense/domicile+', function () {
    Defense::findType(1);
});
//liste de tous les equipes exterieur plan defense 
Flight::route('GET /stat/equip/defense/exterieur+', function () {
    Defense::findType(2);
});
//inserer nouveau statistiques defense de 1 equipe
Flight::route('POST /stat/equip/defense/@idCompetEquipe/@tirsPmDefense/@taclesPm/@interceptionsPm/@fautesPm/@horsJeuxPm/@note', function ($idCompetEquipe,$tirsPmDefense,$taclesPm,$interceptionsPm,$fautesPm,$horsJeuxPm,$note) {
    Defense::insert($idCompetEquipe,$tirsPmDefense,$taclesPm,$interceptionsPm,$fautesPm,$horsJeuxPm,$note);  
});
// http://localhost:80/football/stat/equip/attack
// http://localhost:80/football/stat/equip/attack/1/5/10/0.0/0.0/0.0/0.0
//  http://localhost:80/football/stat/equip/3/22/2/2/2.2/2.3/2,6/2,5
//  http://localhost:80/football/stat/equip/defense/3/1/0/0/0/0/0

Flight::start();
?>