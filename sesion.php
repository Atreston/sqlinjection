<?php
include('conectarbd.php');
session_start();
//En esta página revisamos  que no se haya iniciado sesión, si el usuario inicia
//sesión, no hay necesidad de hacer el logín, por lo que lo redirigimos a la página
//de bienvenido
if(isset($_SESSION['user']))
{
    redirect("bienvenido.php");
}

?>