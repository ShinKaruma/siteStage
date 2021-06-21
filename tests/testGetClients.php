<?php
include_once '../modeles/fonctionAccesBDD.php';

 $lePdo = connexionBDD();
 
 $result = getClient($lePdo);
 
 var_dump($result);