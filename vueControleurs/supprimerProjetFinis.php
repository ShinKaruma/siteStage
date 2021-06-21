<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Suppreisson d'un Projet</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../images/icone/favicon.ico">
    </head>
    <body>
        <nav>
            <a href="../index.php">Acceuil</a>
            <a href="ajoutProjet.php">Ajouter un projet</a>
            <a href="AffichageTousLesProjets.php">Afficher tous les projets</a>
        </nav>
        <?php
        include_once '../modeles/fonctionAccesBDD.php';
        $lePdo = connexionBDD();
        ?>

        <table>
            <tr>
                <th>Identifiant du projet</th>
                <th>Client du projet</th>
                <th>plateforme du projet</th>
                <th>Supression ?</th>
            </tr>
            <?php
            $sortieProjetFini = getProjetFinis($lePdo);
            for ($i = 0, $size = count($sortieProjetFini); $i < $size; $i++) {
                echo '<tr>
                                <td>' . $sortieProjetFini[$i]['idProjet'] . '</td>
                                <td>' . $sortieProjetFini[$i]['client'] . '</td>
                                <td>'.$sortieProjetFini[$i]['libelleConfig'].'</td>
                                <td><a id="'.$sortieProjetFini[$i]['idProjet'].'"style="cursor: pointer;" onclick="maFonction(this.id)"> &#9989; </a> </td>
                     </tr>';
            }
            ?>
        </table>
        
        <script>
            function maFonction(value){
                alert(value);
            }
        </script>
    </body>
</html>
