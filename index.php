<!DOCTYPE html>
<?php
include_once 'modeles/fonctionAccesBDD.php';
$lePdo = connexionBDD();
?>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="images/icone/favicon.ico">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
        <title>Acceuil</title>
    </head>
    <body>
        <nav>
            <a class="nav" href="vueControleurs/affichageTousLesProjets.php">Afficher tous les projets</a>
            <a class="nav" href="vueControleurs/CalendrierPlanning.php">Afficher le Calendrier</a>
            <a class="nav" href="vueControleurs/ajoutPlateformeEtAjoutConfig.php">Ajouter des plateformes et des configurations</a>
            <a class="nav" href="doc_technique.odt" download='doc_technique.odt'>Télécharger la documentation technique</a>
        </nav>
        <br>

        <div id="infosProjet">
            <?php
            $ajd = getDateAjd($lePdo);
            $essaiAjd = getEssaiAjd($lePdo, $ajd);
            if (count($essaiAjd)>0){
                echo '<table style="width: 100%">';
                echo '<caption>Essais du jour</catption>';
                echo "<th>Identifiant de l'essai</th>
                <th>Plateforme de l'essai</th>
                <th>Config de l'essai</th>
                <th>Essai terminé ?</th>";
                for ($j = 0; $j < count($essaiAjd); $j++) {
                    $plateforme = $essaiAjd[$j]['idPlateforme'];
                    $couleur = getCouleur($lePdo, $plateforme);
                    echo '<tr>';
                    echo "<td style='color: " . $couleur . "'>" . $essaiAjd[$j]['idEssai'] . "</td>";
                    echo "<td style='color: " . $couleur . "'>" . $essaiAjd[$j]['libellePlat'] . "</td>";
                    echo "<td style='color: " . $couleur . "'>" . $essaiAjd[$j]['libelleConfig'] . "</td>";
                    if ($essaiAjd[$j]['Termine'] == 1) {
                        echo "<td>&#x2705;</td>";
                    } else {
                        echo "<td>&#x274C;</td>";
                    }
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
            else{
                echo "<p style='color:#F00'>Il n'y a aucun essai de prévu pour aujourd'hui";
            }
            ?>

            

        <script src="js/script.js"></script>
    </body>
</html>
