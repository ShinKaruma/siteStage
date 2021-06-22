<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="../style/styleCalendrier.css">
        <link rel="icon" href="../images/icone/favicon.ico">
        <title>Planning</title>
    </head>
    <body>
        <?php
        include_once '../modeles/fonctionAccesBDD.php';
        $lePdo = connexionBDD();
        ?>
        <nav>
            <a href="../index.php">Retourner à l'acceuil</a>
            <a href="AffichageTousLesProjets.php">Afficher tous les projets</a>
            <a href="ajoutPlateformeEtAjoutConfig.php">Ajouter des plateformes et des configurations</a>
        </nav>
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content w-100">
                            <div class="calendar-container">
                                <div class="calendar"> 
                                    <div class="year-header"> 
                                        <span class="left-button fa fa-chevron-left" id="prev"> </span> 
                                        <span class="year" id="label"></span> 
                                        <span class="right-button fa fa-chevron-right" id="next"> </span>
                                    </div> 
                                    <table class="months-table w-100"> 
                                        <tbody>
                                            <tr class="months-row">
                                                <td class="month">Jan</td> 
                                                <td class="month">Fev</td> 
                                                <td class="month">Mar</td> 
                                                <td class="month">Avr</td> 
                                                <td class="month">Mai</td> 
                                                <td class="month">Jui</td> 
                                                <td class="month">Juil</td>
                                                <td class="month">Aoû</td> 
                                                <td class="month">Sep</td> 
                                                <td class="month">Oct</td>          
                                                <td class="month">Nov</td>
                                                <td class="month">Dec</td>
                                            </tr>
                                        </tbody>
                                    </table> 

                                    <table class="days-table w-100"> 
                                        <td class="day">Dim</td> 
                                        <td class="day">Lun</td> 
                                        <td class="day">Mar</td> 
                                        <td class="day">Mer</td> 
                                        <td class="day">Jeu</td> 
                                        <td class="day">Ven</td> 
                                        <td class="day">Sam</td>
                                    </table> 
                                    <div class="frame"> 
                                        <table class="dates-table w-100"> 
                                            <tbody class="tbody">             
                                            </tbody> 
                                        </table>
                                    </div> 
                                    <button class="button" id="add-button">Ajouter un Essai</button>
                                </div>
                            </div>
                            <div class="events-container">
                            </div>
                            <div class="dialog" id="dialog">
                                <h2 class="dialog-header"> Ajouter un nouvel essai </h2>
                                <form class="form" id="form">
                                    <div class="form-container" align="center">
                                        <p id='outputErreur' style="color:#f00"></p>
                                        <label class="form-label" id="valueFromMyButton" for="essai">Saisir le numéro d'essai</label>
                                        <input class="input" type="text" id="essai" maxlength="36" placeholder="Identifiant de l'essai">
                                        <label class="form-label" id="valueFromMyButton" for="projet">Saisir l'identifiant du projet</label>
                                        <input type="text" class="input" id="projet" name="projet" placeholder="Identifiant du projet">
                                         
                                        <label class="form-label" id="valueFromMyButton" for="plateforme">Choisir la plateforme</label>
                                        <select id="plateforme" name="plateforme" onchange="getConfig(this.value)">
                                            <?php
                                            $sortiePlat = getAllPlateforme($lePdo);
                                            for ($i = 0, $size = count($sortiePlat); $i < $size; $i++) {
                                                echo '<option value="' . $sortiePlat[$i]['idPlateforme'] . '">' . $sortiePlat[$i]['libellePlat'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <label class="form-label" id="valueFromMyButton" for="config">Choisir une configuration</label>
                                        <select id="config" name="config"></select>
                                        <br>
                                        <label class="form-label" id="valueFromMyButton" for="dateFin">Choisir une date de fin (optionnel)</label>
                                        <input type="date" id="dateFin">
                                        <br><br>


                                        <input type="button" value="Cancel" class="button" id="cancel-button">
                                        <input type="button" value="OK" class="button button-white" id="ok-button">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p id="outputPHP"></p>
        <!-- The actual snackbar -->
        <div id="snackbarReussite" >Date mise à jour</div>

        <!-- The actual snackbar -->
        <div id="snackbarEchec" >Échec de la mise à jour de la date</div>

        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
