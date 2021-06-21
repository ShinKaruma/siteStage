<?php
include_once '../modeles/fonctionAccesBDD.php';
$lePdo = connexionBDD();
$idPlateforme = 5;
$libellePlat = "test";
$result = ajoutPlateforme($lePdo, $idPlateforme, $libellePlat);
var_dump($result);