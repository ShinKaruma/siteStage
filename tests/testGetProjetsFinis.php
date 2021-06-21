<?php

include_once '../modeles/fonctionAccesBDD.php';
 $result = getProjetFinis(connexionBDD());
 var_dump($result);