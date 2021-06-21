<?php
include_once '../modeles/fonctionAccesBDD.php';
date_default_timezone_set('UTC');
$essai = $_REQUEST['p'];
$date = $_REQUEST['d'];
$timestamp = date('Y-m-d',strtotime($date));
$executionOK = updateDateEssai(connexionBDD(), $essai, $timestamp);

echo $executionOK;