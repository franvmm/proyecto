<?php
require_once('modelo/DB.php');
require_once('modelo/AccionesMsj.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}
if (isset($_POST['guardar'])){
     if (DB::eliminaMensaje($_POST['cod'],$_POST['name'],$_POST['pass'],$_POST['nick'],$_POST['email'])) {
                header("Location: foro.php");                    
            }
            else {
                $error = "Datos no validos!";
            }
}
function cargaDatosUser(){
    $usuario = DB::obtieneDatosUser();
        echo "<p><form id='" . $usuario['user_id'] . "' action='perfil.php' method='post'>";
        echo "<input type='hidden' name='cod' value='".$usuario['user_id'] ."' />";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Nombre: <input type='text' name='name' value='".$usuario['user_name'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Password: <input type='password' name='pass' value='".$usuario['user_pass'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Nick: <input type='text' name='nick' value='".$usuario['user_nick'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='mensaje'>Email: <input type='text' name='email' value='".$usuario['user_email'] ."' /></p>"
                . " <input type='submit' name='guardar' value='Guardar Cambios'/>";
        echo "</form>";
        echo "</p>";
         
}
/*function cargaDatosAmigos(){
    $usuario = DB::obtieneDatosAmigos();
        echo "<p><form id='" . $usuario['user_id'] . "' action='perfil.php' method='post'>";
        echo "<input type='hidden' name='cod' value='".$usuario['user_id'] ."' />";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Nombre: <input type='text' name='name' value='".$usuario['user_name'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Password: <input type='password' name='pass' value='".$usuario['user_pass'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='titulo'>Nick: <input type='text' name='nick' value='".$usuario['user_nick'] ."' /></p>";
        echo "<p id=".$usuario['user_id'] ." class='mensaje'>Email: <input type='text' name='email' value='".$usuario['user_email'] ."' /></p>"
                . " <input type='submit' name='guardar' value='Guardar Cambios'/>";
        echo "</form>";
        echo "</p>";
         
}*/
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Perfil-<?php echo $_SESSION['usuario']; ?></title>
  <link href="css/foro.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />
</head>

<body>

<header>
  <div id="encabezado">
    <h1>Perfil de <?php echo $_SESSION['usuario']; ?></h1>
  </div>
  <nav>
  <ul class="NavPropio">
                <li id="home"><a href="./foro.php">Mensajes</a></li>
                <li id="news"><a href="./perfil.php">Perfil</a></li>
                
                <li id="services"><a href="./multim.php">Multimedia</a></li>
                <li id="contact"><a href="./usuarios.php">Usuarios del foro</a></li>
                <li id="about"><a href="./acercaD.php">Acerca de</a></li>
       </ul>  
</nav>
</header>
  <section id="contenido">
<?php cargaDatosUser(); ?>
  </section>
    <section id="contenidoAmigos">
<?php // cargaDatosAmigos(); ?>
  </section>
  <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Cerrar sesion : <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
  </div>
</body>
</html>
