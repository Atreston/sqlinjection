<?php 

function connect($dbuser,$dbpassword)
{
    try {
        $db = new mysqli('localhost', $dbuser, $dbpassword);
        return $db;
    } catch ( mysqli_sqlexception $e) {
        return false;
    }
}

function redirect($uri)
{
    //función para redirigir, notese en mi entorno estoy utilizando el puerto 3000
     header( "Location: http://localhost/sqlinjection/{$uri}" );
}

function login($db,$usr,$pass)
{
    //$user = mysql_real_escape_string($usr); //usamos un string absoluto para evitar sqlinjection
    $password = sha1($pass); //encriptamos el password
    $query ="SELECT user FROM users WHERE user='{$user}' AND password='{$password}'";
    try {
    //$db->beginTransaction(); //usando mysqli()
    $result = $db->query($query);
    if( $result->num_rows > 0 ){
        foreach($result as $row) {
        $suser = $row['user'];
        }    
    }
    //Establecemos información de sesión
    $_SESSION['user'] = $suser;
    //$db->commit(); //termina la consulta con la DB
    $db->close();
    //En este momento ya hemos validado el login de usuario, por lo que redirigimos a la página de bienvenido
    redirect("bienvenido.php");
    } catch ( mysqli_sql_exception $e ) {
        //$db->rollBack();
        echo "<p>Ha ocurrido un error en el inicio de sesión.</p>";
        //die();//termino del script
    }
}

function register($db)
{
    //Primero obtenemos las entradas de la forma
    $user = mysql_real_escape_string($_POST['user']); //usamos un string absoluto para evitar sqlinjection
    $password = sha1($_POST['password']); //encriptamos el password
    $rpassword = sha1($_POST['rpassword']); //encriptamos la confirmación del password
    
    //Ahora validamos, si la validación es correcta procedemos a ejecutar la inserción en la DB
    if(validateInputs($user,$password,$rpassword))
    {
        //ya hemos validado los inputs, ahora comprobemos que el usuario este libre
        if(!validateUsername($db, $user))
        {
        //ahora creamos nuestra query
        $query = "INSERT INTO users(user,password) values('{$user}','{$password}')";
        try {  
            $db->beginTransaction();//iniciamos transacción DBO
            $db->exec($query); //ejecutamos la inserción de datos y el registro
            $db->commit();//terminamos la conexión exitosamente
            echo "Registro completado\n su usuario:{$user} y su password:{$_POST['password']}".
                  "\n Entre <a href=\"bienvenido.php\">Aqui</a> para ir a la pagina de bienvenida";
          } catch (Exception $e) {
            $db->rollBack(); //Si falla la conexión, tiramos la conexión
            echo "<p>Ocurrio un error, el registro no pudo ser completado</p>";
          }            
        }else{
            echo "<p>El nombre de usuario ya existe, por lo que no se pudo completar el registro.</p>";
        }
    
    }
    else //de lo contrario cancelamos el proceso
    {
        echo "<p>Los datos de registro son invalidos, intente de nuevo.</p>";
        $db = null;
        die();
    }    
}


function validateInputs($user,$pass,$rpass)
{
    //primeramente validamos que los passwords sean coincidentes
    if($pass!="" && $pass!=$rpass)
        return false; //si no lo son no se realiza el registro.
    //segundo validamos que el usuario sea un email
    if($user!="")
    {
        if(!filter_var($user,FILTER_VALIDATE_EMAIL))
        {
            return false; //si no es un email valido no pasa la prueba
        }
    }
    return true; // si pasa las pruebas se regresa un valor verdadero
}

//Esta función es muy importante, pues validamos que el nombre de usuario sea unico
function validateUsername($db,$username)
{
    $existe=false; //por defecto asumimos que no existe el nombre de usuario
    $username = mysql_real_escape_string($username);
    $query = "SELECT user FROM users WHERE user='{$username}'";
        try {  
            $db->beginTransaction();//iniciamos transacción DBO
            $result = $db->query($query); //Consultamos si ya existe el username
            //terminamos la conexión exitosamente
            $db->commit();
            foreach ($result as $value) {
            echo $value['user']."<br/>";  
            echo $username."<br/>";
           //en caso de haber encontrado una coincidencia regresamos false para denegar el registro
           if($value['user']==$username)
               $existe = true; //se encontro una coincidencia
               return $existe;
           }
            
          } catch (Exception $e) {
            $db->rollBack(); //Si falla la conexión, tiramos la conexión
            echo "<p>Ocurrio un error, el registro no pudo ser completado</p>";
            $existe=false; //colocamos falso para evitar crear un registro cuando hubo error
          }   
          return $existe;
}

?>