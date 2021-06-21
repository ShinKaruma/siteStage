<?php

include_once '../modeles/fonctionAccesBDD.php';

$result = getConfig(connexionBDD(), 3);
var_dump($result);