
<?php
include_once '../modeles/fonctionAccesBDD.php';
$lePdo = connexionBDD();
$sortie = getListeProjet($lePdo);
for ($i = 0, $size = count($sortie); $i < $size; $i++) {
    echo $sortie[$i]['idProjet'].'<br>';
}
?>