<?php
include_once '../modeles/fonctionAccesBDD.php';

$lePDO = connexionBDD();

var_dump($lePDO);

$idProjet = "PR1050";
$client = "CHANEL";
$categorie = 3;
$type = 1;
$quantite = 500;
$jours = 12;
$avancement = 0;
$resutlt = addProjet($lePDO, $idProjet, $client, $categorie, $type, $quantite, $jours, $avancement);
var_dump($resutlt);