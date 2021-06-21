<?php
include_once '../modeles/fonctionAccesBDD.php';
$plateforme = $_REQUEST['p'];
$result = getConfig(connexionBDD(), $plateforme);
echo json_encode($result);