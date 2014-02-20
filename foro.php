<?php
require_once('modelo/DB.php');
require_once('modelo/AccionesMsj.php');
session_start();

if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

if (isset($_POST['publicar'])){

if (empty($_POST['titulo']) || empty($_POST['mensaje'])) 
        $error = "Debes introducir todos los datos correctamente";
 else {
         if (DB::publicaMensaje($_POST['titulo'], $_POST['mensaje'],$_POST['email'],$_POST['nick'])) {
                session_start();
                header("Location: foro.php");                    
            }
            else {
                $error = "Datos no validos!";
            }
        
    }
}
$lista = AccionesMsj::carga_mensajes();

function creaFormularioMensajes()
{
    $mensajes = DB::obtieneMensajes();
    foreach ($mensajes as $p) {
        echo "<p><form id='" . $p->getcodigo() . "' action='foro.php' method='post'>";
        echo "<input type='hidden' name='cod' value='" . $p->getcodigo() . "'/>";
        echo "<p id=".$p->getcodigo()." class='titulo'>".$p->gettitulo() . ": </p>";
        echo "<p id=".$p->getcodigo()." class='mensaje'>".$p->getmensaje() . " .  <input type='submit' name='eliminar' value='Eliminar'/> </p>";
        echo "</form>";
        echo "</p>";
    }        
}
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Foro-<?php echo $_SESSION['usuario']; ?></title>
  <link href="css/foro.css" rel="stylesheet" type="text/css">
</head>

<body>

<header>
  <div id="encabezado">
    <h1>Foro de <?php echo $_SESSION['usuario']; ?></h1>
  </div>
</header>
  <section id="contenido">
<?php creaFormularioMensajes(); ?>
  </section>
    <section id="contenido2">
        <form action="foro.php">
            <label>Titulo: </label>
            <input type="text" name="titulo"><br />
            <label>Mensajes: </label>
            <textarea name="mensaje"></textarea><br />
            <label>Usuario: </label>
            <input type="text" name="usuario" disabled value="<?php echo $_SESSION['usuario']; ?>"><br />
            <input type="submit" name="publicar" value="Publicar Mensaje">
        </form>
  </section>
   <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Cerrar sesion : <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
  </div>
</body>
</html>
