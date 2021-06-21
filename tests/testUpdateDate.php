<?php
include_once '../modeles/fonctionAccesBDD.php';
date_default_timezone_set('UTC');
$essai = "2021-894";
$date = "2021-06-15";
$timestamp = date('Y-m-d',strtotime($date));
var_dump($timestamp);
$executionOK = updateDateEssai(connexionBDD(), $essai, $timestamp);

var_dump($executionOK);