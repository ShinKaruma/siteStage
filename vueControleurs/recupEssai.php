<?php

include_once '../modeles/fonctionAccesBDD.php';

$result = getAllEssai(connexionBDD());

for ($i = 0; $i < count($result); $i++) {
    $plateforme = $result[$i]['idPlateforme'];
    $couleur = getCouleur(connexionBDD(), $plateforme);
    array_push($result[$i], $couleur);
}

echo json_encode($result);
