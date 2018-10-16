<?php
//Posteriormente ya que revisamos que no hay nadie "logeado", revisamos si hubo un
//intento de iniciar sesión, si hubo un "submit" 
if( isset( $_POST['user'] ) && isset( $_POST['password'] ) )
{
    //usuario y password de la DB
    $server = 'localhost';
    $dbuser ='root';
    $dbpassword ='';
    $dbname = 'practicas';

    //primero realizamos la conexión usando esta funcion
    $db = mysqli_connect($server, $dbuser, $dbpassword, $dbname);
    if( $db ){
        switch( $_POST['token'] ){
            case 1:
                $user = $_POST['user'];
                $password = $_POST['password'];//sha1( $_POST['password'] ); //encriptamos el password
                $query ="SELECT user FROM users WHERE user='{ $user }' AND password='{ $password }'";
                $result = $db->query($query);
                
                if( $result ){
                    $row = $result->fetch_all();
                    var_dump($row);
                }
                break;
            case 2:
                $user = mysql_real_escape_string( $_POST['user'] ); //usamos un string absoluto para evitar sqlinjection
                $password = sha1( $_POST['password'] ); //encriptamos el password
                $rpassword = sha1( $_POST['rpassword'] ); //encriptamos la confirmación del password
                
                $query = "INSERT INTO users(user,password) values('{$user}','{$password}')";
                $db->query($query);
                echo "Registro completado\n su usuario:{$user} y su password:{$_POST['password']}".
                              "\n Entre <a href=\"bienvenido.php\">Aqui</a> para ir a la pagina de bienvenida";          
                break;
        }
    }
    else
    {
        //echo $db;
        echo "<p>No se pudo establecer la conexión</p>";
        echo mysqli_connect_error();
    }    
}
//En caso de que no se haya colocado data desde la forma 
//no hacemos nada y esperamos a que se suba la data
?>