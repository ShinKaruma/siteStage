<?php
include_once '../modeles/fonctionAccesBDD.php';

$lePDO = connexionBDD();

var_dump($lePDO);

$idProjet = "PR1050";
$categorie = 4;
$result = getProjet($lePDO, $idProjet, $categorie);
var_dump($result);