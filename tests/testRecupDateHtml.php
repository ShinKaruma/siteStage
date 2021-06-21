<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form name="testDate" action="#" method="POST">
            <input type="date" name="date">
            <input type="submit" value="submit" name="submit">
        </form>
        <?php
            if(isset($_POST['submit'])){
                var_dump($_POST['date']);
            }
        ?>
    </body>
</html>
