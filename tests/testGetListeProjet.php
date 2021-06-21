<?php
include_once '../modeles/fonctionAccesBDD.php';

$lePDO = connexionBDD();

var_dump($lePDO);

$result = getListeProjet($lePDO);
var_dump($result);