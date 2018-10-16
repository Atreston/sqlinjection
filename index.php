<?php
    session_start();

    if( isset( $_SESSION['user']) ) {
        header( "Location: http://localhost/bienvenido.php" );
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Fraccionamiento residencial Puerta de acero</title>
        <style> 
            body{
                background: #00FFFF;
                color: #003EFF;
            }
            h1{
                color: #F700FF;
            }
            p{
                font-size: 20px;
                color: #FF0400;
            }
        </style>
    </head>
    <body>
        <center>
            <img src= "http://arteenelhierro.com/wp-content/uploads/hierro%20arte%20reja.png" height= "100" width= "300" >
            <h1>Fracionamiento recidencial Puerta de Acero</h1>
            <p>Administracion</p>
            <form action="validar_login.php" method= "POST">
                Usuario: <br>
                <input type= "text" name= "user"><br>
                Contraseña: <br>
                <input type= "password" name= "password"><br>
                <br>
                <input type="hidden" value="0">
                <input type= "submit" value= "Entrar"><br>
                <p>Si no se ha registrado haga click <a href="registro.php">aqui</a></p>
            </form>
        </center>
    </body>
</html>