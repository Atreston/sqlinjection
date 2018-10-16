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
        <form method="post" action="validar_registro.php">
            <p>USUARIO: <input name="user" id="user" type="email" size="10"></p>
            <p>CONTRASEÑA: <input name="password" id="password" type="password" size="10"></p>
            <p>REPITA CONTRASEÑA: <input name="rpassword" id="rpassword" type="password" size="10"></p>
            <input type="submit" value="Registrar">
            <div name="err" id="err"></div>
        </form>
	</body>
</html>