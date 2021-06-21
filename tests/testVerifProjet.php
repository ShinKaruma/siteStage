<?php
include_once '../modeles/fonctionAccesBDD.php';
$idProjet = "PR1050";
$client = "CHANEL";

$result = verifProjet(connexionBDD(), $idProjet, $client);

var_dump($result);