<?php
include_once '../modeles/fonctionAccesBDD.php';

$lePDO = connexionBDD();

var_dump($lePDO);

$result = getAllType($lePDO);
var_dump($result);