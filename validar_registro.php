<?php

session_start();
if( isset( $_SESSION['user'] ) ) {
    header( "Location: http://localhost/index.php" );
}

if( isset( $_POST['user'] ) && isset( $_POST['password'] ) ) {
    //$user = mysql_real_escape_string($_POST['user']); //usamos un string absoluto para evitar sqlinjection
    $password = sha1($_POST['password']); //encriptamos el password
    $rpassword = sha1($_POST['rpassword']); //encriptamos la confirmación del password
    if( $password == $rpassword ) {
        $conexion = new mysqli( "localhost", "root", "", "practicas" );
        //pass = 1234
    
        $sql = "INSERT INTO users(user,password) values('{$_POST['user']}','{$password}')";
        $resultado = $conexion->query( $sql );
        echo "Registro completado\n";
        echo "su usuario: {$_POST['user']}\n Entre a ";
        echo '<a href="\index.php\">Aqui</a>';
        echo "para ir a la pagina de inicio de sesion.";
    
    }else{
        header("Location: http://localhost/registro.php");
    }
    
}

?>