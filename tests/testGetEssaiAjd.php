<?php

include_once '../modeles/fonctionAccesBDD.php';

$lePdo = connexionBDD();

$date = getDateAjd($lePdo);

$essai = getEssaiAjd($lePdo, $date);

var_dump($essai);