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
            <a class="nav" href="../index.php">Retourner à l'acceuil</a>
            <a class="nav" href="CalendrierPlanning.php">Afficher le calendrier</a>
            <a class="nav" href="ajoutPlateformeEtAjoutConfig.php">Ajouter des plateformes et des configurations</a>
        </nav>
        <div>
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
                        echo '<tr>';
                        echo "<td rowspan='" . ((int) $nbEssai[0] + 1) . "' style='page-break-before: always;'>" . $tousLesProjets[$i]['idProjet'] . "</td>";
                        echo '</tr>';

                        for ($j = 0; $j < count($tousLesEssaisParProjet); $j++) {
                            $plateforme = $tousLesEssaisParProjet[$j]['idPlateforme'];
                            $couleur = getCouleur($pdo, $plateforme);

                            echo '<tr>';
                            echo "<td style='color: " . $couleur . ";'>" . $tousLesEssaisParProjet[$j]['idEssai'] . "</td>";
                            echo "<td style='color: " . $couleur . ";'>" . $tousLesEssaisParProjet[$j]['libellePlat'] . "</td>";
                            echo "<td style='color: " . $couleur . ";'>" . $tousLesEssaisParProjet[$j]['libelleConfig'] . "</td>";
                            echo "<td style='color: " . $couleur . ";'>" . $tousLesEssaisParProjet[$j]['dateDebut'] . "</td>";
                            echo "<td style='color: " . $couleur . ";'>" . $tousLesEssaisParProjet[$j]['dateFin'] . "</td>";
                            if ($tousLesEssaisParProjet[$j]['Termine'] == 1) {
                                echo "<td>&#x2705;</td>";
                            } else {
                                echo "<td>&#x274C;</td>";
                            }
                            echo '</tr>';
                        }
                    }
                    ?>

            </table>
        </div>
        <button>Export HTML table to CSV file</button>
        <a name="DlPdf" id="BoutonDl" href="previewDownloadPdf.php" style="cursor: pointer;">&#x1F4BE;</a>
        <script src="../js/script.js"></script>
        <form method="POST" action="#"><input type="submit" name="purgeEssais" value="Purger les essais terminés"></form>
        <?php
        if (isset($_POST['purgeEssais'])) {
            $result = delEssaisTermines($pdo);
            echo '<script>alert("les Essais terminés ont bien étés effacés, l\'affichage se mettra à jour la prochaine fois que vous irez sur la page, veuillez ne pas actualiser pour éviter de surcharger le serveur");
                </script>';
        }
        ?>
    </body>
</html>
