<?php

include_once '../modeles/fonctionAccesBDD.php';
$lePdo = connexionBdd();
$dateDebut = htmlspecialchars($_POST['date']);
$idProjet = htmlspecialchars($_POST['idProjet']);
$idEssai = htmlspecialchars($_POST['idEssai']);
$config = htmlspecialchars($_POST['config']);
$plateforme = htmlspecialchars($_POST['plateforme']);
$dateFin = htmlspecialchars($_POST['dateFin']);

$etat = ajoutEssai($lePdo, $idEssai, $idProjet, $plateforme, $dateDebut, $dateFin, $config);
echo json_encode($etat);