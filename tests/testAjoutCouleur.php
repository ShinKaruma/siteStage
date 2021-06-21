<?php

include_once '../modeles/fonctionAccesBDD.php';
$lePdo  = connexionBDD();
$idPlateforme = 5;
$valCouleur = "#00ffff";
$result = ajoutCouleur($lePdo, $idPlateforme, $valCouleur);
var_dump($result);