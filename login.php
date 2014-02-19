<?php
require_once('modelo/DB.php');
$error="";
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])){

    if (empty($_POST['usuario']) || empty($_POST['password'] )) 
        $error = "Debes introducir un nombre de usuario y una contraseña";
    else {
        // Comprobamos las credenciales con la base de datos
        if (DB::verificaCliente($_POST['usuario'], $_POST['password'])){
            session_start();
            $_SESSION['usuario']=$_POST['usuario'];
            header("Location: foro.php");                    
        }
        else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $error = "Usuario o contraseña no válidos!";
        }
    }
}
if (isset($_POST['registro'])){
        header("Location: registro.php");
}
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Login-proyecto</title>
  <link href="css/proyecto.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="contenedor">
    <div id="logo"></div>
    <div id='login'>
    <form action='login.php' method='post'>
    <fieldset >
        <legend>Login</legend>
        <div><span class='error'><?php echo $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' id='password' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <input type='submit' name='enviar' value='Enviar' />
            <input type='submit' name='registro' value='Registro' />
        </div>
    </fieldset>
    </form>
    </div>
  </div>
</body>
</html>
