<?php
include_once '../modeles/fonctionAccesBDD.php';

$result = getAllPlateforme(connexionBDD());
var_dump($result);