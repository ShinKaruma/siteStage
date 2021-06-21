<?php

include_once '../modeles/fonctionAccesBDD.php';

$lePdo = connexionBDD();

$plateforme = 2;

$couleur = getCouleur($lePdo, $plateforme);

var_dump($couleur);