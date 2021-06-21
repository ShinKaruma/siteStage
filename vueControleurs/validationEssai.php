<?php

include_once '../modeles/fonctionAccesBDD.php';

$lePdo = connexionBDD();

$idEssai = htmlspecialchars($_REQUEST['p']);

$executionOK = validationEssai($lePdo, $idEssai);

echo $executionOK;