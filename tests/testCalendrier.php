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
        <title></title>
    </head>
    <body>
        <?php
          //$lePdo = connexionBDD();  
        ?>
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
                                    <button class="button" id="add-button">Add Event</button>
                                </div>
                            </div>
                            <div class="events-container">
                            </div>
                            <div class="dialog" id="dialog">
                                <h2 class="dialog-header"> Add New Event </h2>
                                <form class="form" id="form">
                                    <div class="form-container" align="center">
                                        <label class="form-label" id="valueFromMyButton" for="name">projet</label>
                                        <input class="input" type="text" id="projet" maxlength="36">
                                        <label class="form-label" id="valueFromMyButton" for="name">essai</label>
                                        <input class="input" type="text" id="essai" maxlength="36">
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
        
        <script src="../script/jquery.min.js"></script>
        <script src="../script/popper.js"></script>
        <script src="../script/bootstrap.min.js"></script>
        <script src="../script/main.js"></script>
    </body>
</html>
