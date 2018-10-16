<?php
session_start();
if( isset( $_SESSION['user']) ) {
    header( "Location: http://localhost/bienvenido.php" );
}

if(isset( $_POST['user'] ) && isset( $_POST['password']) ) {
    $conexion = new mysqli( "localhost", "root", "", "practicas" );
    //pass = 1234
    $usuario = $_POST['user'];
    $password = sha1( $_POST['password'] );
    $sql = "SELECT user FROM users WHERE user = '{$usuario}' AND password = '{$password}'";
    $resultado = $conexion->query( $sql );
    $row = $resultado->fetch_assoc();
    if( $row ) {  //verificar que este if no se ejecute si resultado esta vacio
        $_SESSION['user'] = $row['user'];
        header('Location: http://localhost/bienvenido.php');
    }
    else {
        header( "Location: http://localhost/index.php" );
    }
}
?>