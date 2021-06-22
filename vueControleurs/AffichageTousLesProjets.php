<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../images/icone/favicon.ico">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
        <title>Affichage de tous les projets</title>
    </head>
    <body>
        <nav>
            <a href="../index.php">Retourner à l'acceuil</a>
            <a href="CalendrierPlanning.php">Afficher le calendrier</a>
            <a href="ajoutPlateformeEtAjoutConfig.php">Ajouter des plateformes et des configurations</a>
        </nav>
        <div id="infosProjet">
            <table>
                <caption>Projets en cours</caption>
                <tr>
                    <th>Identifiant du projet</th>
                    <th>Identifiant de l'essai</th>
                    <th>Plateforme de l'essai</th>
                    <th>Config de l'essai</th>
                    <th>Date de début de l'essai</th>
                    <th>Date de fin de l'essai</th>
                    <th>Essai terminé ?</th>
                    <?php
                    include_once '../modeles/fonctionAccesBDD.php';
                    $pdo = connexionBDD();
                    $tousLesProjets = getListeProjet($pdo);

                    for ($i = 0, $size = count($tousLesProjets); $i < $size; $i++) {

                        $nbEssai = getNbEssai($pdo, $tousLesProjets[$i]['idProjet']);
                        $tousLesEssaisParProjet = getEssaiByProjet($pdo, $tousLesProjets[$i]['idProjet']);

                        if ($nbEssai[0] > 0) {
                            echo '<tr>';
                            echo "<td rowspan='" . ((int) $nbEssai[0] + 1) . "'>" . $tousLesProjets[$i]['idProjet'] . "</td>";
                            echo '</tr>';

                            for ($j = 0; $j < count($tousLesEssaisParProjet); $j++) {
                                $plateforme = $tousLesEssaisParProjet[$j]['idPlateforme'];
                                $couleur = getCouleur($pdo, $plateforme);
                                echo '<tr>';
                                echo "<td style='color: " . $couleur . "'>" . $tousLesEssaisParProjet[$j]['idEssai'] . "</td>";
                                echo "<td style='color: " . $couleur . "'>" . $tousLesEssaisParProjet[$j]['libellePlat'] . "</td>";
                                echo "<td style='color: " . $couleur . "'>" . $tousLesEssaisParProjet[$j]['libelleConfig'] . "</td>";
                                echo "<td style='color: " . $couleur . "'>" . $tousLesEssaisParProjet[$j]['dateDebut'] . "</td>";
                                echo "<td style='color: " . $couleur . "'>" . $tousLesEssaisParProjet[$j]['dateFin'] . "</td>";
                                if ($tousLesEssaisParProjet[$j]['Termine'] == 1) {
                                    echo "<td>&#x2705;</td>";
                                } else {
                                    echo "<td>&#x274C;</td>";
                                }
                                echo '</tr>';
                            }
                        }
                    }
                    ?>

            </table>
        </div>
        <a name="DlPdf" id="BoutonDl" onclick="toPdf()" style="cursor: pointer;">&#x1F4BE;</a>
        <script src="../js/script.js"></script>
    </body>
</html>
