<?php

include_once '../modeles/fonctionAccesBDD.php';
$lePdo  = connexionBDD();
$idPlateforme = 5;
$libelleConfig = "CONFIG TEST";
$result = ajoutConfig($lePdo, $idPlateforme, $libelleConfig);
var_dump($result);