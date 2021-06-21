<?php
include_once '../modeles/fonctionAccesBDD.php';

$lePDO = connexionBDD();

var_dump($lePDO);

$result = getAllCat($lePDO);
var_dump($result);