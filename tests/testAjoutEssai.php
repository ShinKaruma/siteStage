<?php
include_once '../modeles/fonctionAccesBDD.php';
$client = "CHANEL";
$date = "2021-6-9";
$idProjet = "PR1050";
$idEssai = "2021-1030";
$config = 42;
$plateforme = 4;

$etat = ajoutEssai(connexionBDD(), $idEssai, $idProjet, $client, $plateforme, $date, $config);

var_dump($etat);