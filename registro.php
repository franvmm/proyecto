<?php
require_once('modelo/DB.php');
$error="";
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['registrarse'])){

    if (empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email'])) 
        $error = "Debes introducir todos los datos correctamente";
    else {
        if($_POST['password']==$_POST['password2']){
            if (DB::insertaUsuario($_POST['usuario'], $_POST['password'],$_POST['email'],$_POST['nick'])) {
                session_start();
                //$_SESSION['usuario']=$_POST['nick'];
                header("Location: login.php");                    
            }
            else {
                $error = "Datos no validos!";
            }
        }
        else{
            $error = "Las contraseñas no coinciden!";
        }
    }
}
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Registro-proyecto</title>
  <link href="css/proyecto.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="logo"></div>
    <div id='registro'>
    <form action='registro.php' method='post'>
    <fieldset >
        <legend>Registro</legend>
        <div><span class='error'><?php echo $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Nick:</label><br/>
            <input type='text' name='nick' id='nick' maxlength="100" /><br/>
        </div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' id='password' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password2' >Repite contraseña:</label><br/>
            <input type='password' name='password2' id='password' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='email' >Email:</label><br/>
            <input type='email' name='email' id='email' maxlength="100" /><br/>
        </div>
        <div class='campo'>
            <input type='submit' name='registrarse' value='Registrarse' />
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>
