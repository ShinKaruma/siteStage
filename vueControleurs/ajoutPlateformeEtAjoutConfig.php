<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    include_once '../modeles/fonctionAccesBDD.php';
    $lepdo = connexionBDD();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Ajout Plateforme et Configuration</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../images/icone/favicon.ico">
    </head>
    <body>
        <nav>
            <a class="nav" href="../index.php">Retourner à l'acceuil</a>
            <a class="nav" href="AffichageTousLesProjets.php">Afficher tous les projets</a>
            <a class="nav" href="CalendrierPlanning.php">Afficher le calendrier</a>
        </nav>
        <table>
            <td>
                <form method="POST" action="#">
                    <label for="libellePlat">Saisir le nom de la plateforme</label>
                    <input type="text" id="libellePlat" name="libellePlat">
                    <br>
                    <label for="libellePlat">Saisir l'identifiant de la plateforme</label>
                    <input type="text" id="idPlateforme" name="idPlateforme">
                    <br>
                    <label>Choisir la couleur de la plateforme</label>
                    <input type="color" id="valCouleur" name="valCouleur">
                    <br>
                    <input type="submit" name="submitPlateforme" value="Valider l'ajout">
                </form>
            </td>
            <td>
                <form method="POST" action="#">
                    <label for="libelleConfig">Saisir le nom de la configuration</label>
                    <input type="text" id="libelleConfig" name="libelleConfig">
                    <br>
                    <label>Choisir la plateforme de la configuration</label>
                    <select>
                        <?php
                        $sortiePlat = getAllPlateforme($lepdo);
                        var_dump($sortiePlat);
                        for ($i = 0; $i < count($sortiePlat); $i++) {
                            echo '<option value="' . $sortiePlat[$i]['idPlateforme'] . '">' . $sortiePlat[$i]['libellePlat'] . '</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <input type="submit" name="submitConfig" value="valider l'ajout de la Configuration">
                </form>
            </td>
        </table>
        <?php
        if (isset($_POST['submitPlateform'])) {
            $idPlateforme = htmlspecialchars($_POST['idPlateforme']);
            $libellePlat = htmlspecialchars($_POST['libellePlat']);
            $valCouleur = htmlspecialchars($_POST['valCouleur']);

            $result = ajoutPlateforme($lepdo, $idPlateforme, $libellePlat);

            if ($result) {
                $result2 = ajoutCouleur($lepdo, $idPlateforme, $valCouleur);

                if ($result2) {
                    echo 'La plateforme a bien été ajoutée.';
                } else {
                    echo 'Il y a eu une erreur dans l\'ajout de la couleur de la plateforme';
                }
            } else {
                echo "Il y a eu une erreur dans l'ajout de la plateforme";
            }
        }
        ?>

    </body>
</html>