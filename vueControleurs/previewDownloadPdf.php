<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Preview Download</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    </head>
    <body>
        <style>table, th, td{
                border: 1px solid #000;  
                border-collapse: collapse;
            }</style>
        <a onclick="toPdf();" style="cursor: pointer">Télécharger le PDF</a>
        <a onclick="window.location.href = 'AffichageTousLesProjets.php'" style="cursor: pointer">Retourner à la page précédente</a>
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
                    $ligne = 0;
                    for ($i = 0, $size = count($tousLesProjets); $i < $size; $i++) {
                        $nbEssai = getNbEssai($pdo, $tousLesProjets[$i]['idProjet']);
                        $tousLesEssaisParProjet = getEssaiByProjet($pdo, $tousLesProjets[$i]['idProjet']);
                        echo '<tr>';
                        echo "<td rowspan='" . ((int) $nbEssai[0] + 1) . "'>" . $tousLesProjets[$i]['idProjet'] . "</td>";
                        echo '</tr>';

                        for ($j = 0; $j < count($tousLesEssaisParProjet); $j++) {
                            $ligne++;
                            if ($ligne % 40 == 0) {
                                echo '</tr>';
                                echo '</table>';
                                echo '<table>';
                                echo '<tr>';
                                echo '<td colspan="7" style="page-break-before: always;"></td>';
                                echo '</tr>';
                                echo '</table>';
                                $plateforme = $tousLesEssaisParProjet[$j]['idPlateforme'];
                                $couleur = getCouleur($pdo, $plateforme);
                                echo '<table>';
                                echo '<tr>
                    <th>Identifiant du projet</th>
                    <th>Identifiant de l\'essai</th>
                    <th>Plateforme de l\'essai</th>
                    <th>Config de l\'essai</th>
                    <th>Date de début de l\'essai</th>
                    <th>Date de fin de l\'essai</th>
                    <th>Essai terminé ?</th>
                    </tr>';
                                echo '<tr>';
                                echo "<td rowspan='" . ((int) $nbEssai[0] + 1) . "'>" . $tousLesProjets[$i]['idProjet'] . "</td>";
                                echo '</tr>';
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
                            } else {
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
                            }
                        }
                    }
                    ?>
            </table>
        </div>
    </body>
    <script src="../js/script.js"></script>
</html>
