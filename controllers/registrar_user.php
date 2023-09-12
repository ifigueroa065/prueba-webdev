<?php
    if (empty($_POST["registro"])) {
         
        if (empty($_POST["username"]) or empty($_POST["password"])) {
            echo '<div class="alerta">Uno de los campos está vacío</div>'
            
            
        } else {
            $username=$_POST["username"];
            $password=$_POST["password"];

        }
        
    }
?>