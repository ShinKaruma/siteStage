<?php

function connexionBDD() {
    $bdd = 'mysql:host=localhost;dbname=bdd_test_ceti';
    $user = 'root';
    $password = 'root';

    try {

        $ObjConnexion = new PDO($bdd, $user, $password, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {

        echo $e->getMessage();
    }

    return $ObjConnexion;
}

function getDateAjd($objConnexion) {
    $requete = "select NOW()";
    $monObjPdoStatement = $objConnexion->prepare($requete);
    $monObjPdoStatement->execute();
    $result = $monObjPdoStatement->fetch();
    $monObjPdoStatement->closeCursor();
    $data = explode(" ", $result[0]);
    return $data[0];
}

function getListeProjet($lePdo) {
    $requete = "select distinct idProjet from essai";
    $etat = $lePdo->prepare($requete);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function getAllEssai($lePdo) {
    $requete = "select idProjet, idEssai, dateDebut, dateFin, essai.idPlateforme, plateforme.libellePlat, config.libelleConfig from essai join plateforme on essai.idPlateforme = plateforme.idPlateforme join config on config.idConfig = essai.idConfig where Termine = 0";
    $etat = $lePdo->prepare($requete);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function getAllPlateforme($lePdo) {
    $requete = "select * from plateforme";
    $etat = $lePdo->prepare($requete);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function getConfig($lePdo, $plateforme) {
    $requete = "select idConfig, libelleConfig from config where idPlateforme = :plateforme";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":plateforme", $plateforme);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function updateDateEssai($lePdo, $idEssai, $date) {
    $requete = "update essai set dateDebut = :date where idEssai = :idEssai";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(':date', $date);
    $etat->bindValue(':idEssai', $idEssai);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}

function ajoutEssai($lePdo, $idEssai, $idProjet, $plateforme, $dateDebut, $dateFin, $idConfig) {
    $requete = "insert into essai(idEssai, idProjet, idPlateforme, dateDebut, dateFin, idConfig) values (:idEssai, :idProjet, :plateforme, :dateDebut, :dateFin, :config)";

    $etat = $lePdo->prepare($requete);

    $etat->bindValue(":idEssai", $idEssai);
    $etat->bindValue(":idProjet", $idProjet);
    $etat->bindValue(":plateforme", $plateforme);
    $etat->bindValue(":dateDebut", $dateDebut);
    if ($dateFin == null) {
        $etat->bindValue(":dateFin", $dateDebut);
    } else {
        $etat->bindValue(":dateFin", $dateFin);
    }
    $etat->bindValue(":config", $idConfig);

    $executionOk = $etat->execute();
    $etat->closeCursor();

    return $executionOk;
}

function getCouleur($lePdo, $plateforme) {
    $requete = "select valCouleur from couleur where idPlateforme = :plateforme";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":plateforme", $plateforme);
    $etat->execute();
    $result = $etat->fetch();
    $etat->closeCursor();
    return $result[0];
}

function validationEssai($lePdo, $essai) {
    $requete = "update essai set Termine = 1 where idEssai = :essai";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":essai", $essai);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}

function getNbEssai($lePdo, $idProjet) {
    $requete = "select count(*) from essai where idProjet = :projet";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":projet", $idProjet);
    $etat->execute();
    $result = $etat->fetch();
    $etat->closeCursor();
    return $result;
}

function getEssaiByProjet($lePdo, $idProjet) {
    $requete = "select idEssai, plateforme.libellePlat, config.libelleConfig, dateDebut, dateFin, Termine, essai.idPlateforme from essai join config on essai.idConfig = config.idConfig join plateforme on essai.idPlateforme = plateforme.idPlateforme where idProjet = :projet";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":projet", $idProjet);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function getEssaiAjd($lePdo, $ajd) {
    $requete = "select idEssai, idProjet, plateforme.libellePlat, config.libelleConfig, essai.idPlateforme, Termine from essai join config on essai.idConfig = config.idConfig join plateforme on essai.idPlateforme = plateforme.idPlateforme where dateDebut = :ajd or dateFin = :ajd";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":ajd", $ajd);
    $etat->execute();
    $result = $etat->fetchAll();
    $etat->closeCursor();
    return $result;
}

function ajoutPlateforme($lePdo, $idPlateforme, $libellePlat) {
    $requete = "insert into plateforme(idPlateforme, libellePlat) values (:idPlateforme, :libellePlat)";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":idPlateforme", $idPlateforme);
    $etat->bindValue(":libellePlat", $libellePlat);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}

function ajoutCouleur($lePdo, $idPlateforme, $valCouleur) {
    $requete = "insert into couleur(valCouleur, idPlateforme) values (:valCouleur, :idPlateforme)";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":idPlateforme", $idPlateforme);
    $etat->bindValue(":valCouleur", $valCouleur);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}

function ajoutConfig($lePdo, $idPlateforme, $libelleConfig) {
    $requete = "insert into config(idPlateforme, libelleConfig) values (:idPlateforme, :libelleConfig)";
    $etat = $lePdo->prepare($requete);
    $etat->bindValue(":idPlateforme", $idPlateforme);
    $etat->bindValue(":libelleConfig", $libelleConfig);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}


function delEssaisTermines($lePdo){
    $requete = "delete from essai where Termine = 1";
    $etat = $lePdo->prepare($requete);
    $executionOk = $etat->execute();
    $etat->closeCursor();
    return $executionOk;
}