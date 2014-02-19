<?php
require_once('Mensaje.php');

class DB {  
    protected static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=proyecto";
        $usuario = 'root';
        $contrasena = '';
        
        $proyecto = new PDO($dsn, $usuario, $contrasena, $opc);
        $resultado = null;
        
        if (isset($proyecto)){ 
            $resultado = $proyecto->query($sql);
        }
        return $resultado;
    }

    public static function obtieneMensajes() {
        $sql = "SELECT content_title, content_message, content_date, content_owner FROM forum;";
        $resultado = self::ejecutaConsulta ($sql);
        $mensajes = array();

	if($resultado) {
           $row = $resultado->fetch();
            while ($row != null) {
                $mensajes[] = new Mensaje($row);
                $row = $resultado->fetch();
            }
	}
        return $mensajes;
    }

    
    public static function obtieneMensaje($codigo) {
        $sql = "SELECT content_title, content_message, content_date, content_owner FROM forum";
        $sql .= " WHERE content_id='" . $codigo . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $mensaje = null;

	if(isset($resultado)) {
            $row = $resultado->fetch();
            $mensaje = new Mensaje($row);
	}
        
        return $mensaje;    
    }
    
    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT user_name, user_nick FROM users ";
        $sql .= "WHERE user_name='$nombre' ";
        $sql .= "AND user_pass='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta ($sql);
        $verificado = false;

        if(isset($resultado)) {
            $fila = $resultado->fetch();
            if($fila !== false){ $verificado=true;}
        }
        return $verificado;
    }
    public static function insertaUsuario($nombre, $contrasena, $emai, $nick) {
        $sql = "INSERT INTO users(user_name, user_pass, user_email, user_nick) VALUES ('".$nombre."','".md5($contrasena)."','".$emai."','".$nick."');";
        $resultado = self::ejecutaConsulta ($sql);
        $verificado=false;
        if(isset($resultado)) {
            if($resultado != false){
                $verificado=true;                
            }
        }
        return $verificado;
    }
    
}

?>