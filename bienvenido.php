<?php
    session_start();
    $user = $_SESSION['user'];
print_r($_SESSION);
    if( $_POST['ss'] == 1 ){
        session_destroy();
        header( "Location: http://localhost/index.php" );
    }
?>

<center>
    <img src= 'https://vecinos360.com/img/icono-principal-administrador.png' height= '300' width= '300' >
    <h1>Administracion</h1>
    Bienvenido <h2><?php echo $user;?></h2><br>
    <br>
    <button type = "button" class="btr" onclick ="javascript:void(window.open('https://jeancarlon-n.000webhostapp.com/Altas.html','_self', false));" title= "Alta de usuarios">Alta</button>
    <button type = "button" class="btr" onclick ="javascript:void(window.open('https://jeancarlon-n.000webhostapp.com/Cambios.php','_self', false));" title= "Actualizacion">Actualizar</button>
    <button type = "button" class="btr" onclick ="javascript:void(window.open('https://jeancarlon-n.000webhostapp.com/Bajas.php','_self', false));" title= "Eliminar">Bajas</button>
    <form action="bienvenido.php" method="post">
        <input type="hidden" name="ss" value="1">
        <input type="submit" value="Cerrar sesion">
    </form>
</center>

