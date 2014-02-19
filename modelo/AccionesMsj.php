<?php
//require_once('DB.php');

class AccionesMsj {
    protected $mensajes = array();
    
    public function nuevo_mensaje($codigo) {
        $mensaje = DB::obtieneMensaje($codigo);
        $this->mensajes[] = $mensaje;
    }
    
    public function get_mensaje() { return $this->mensajes; }
    
    public function get_autor($codigo) {
        $mensaje = DB::obtieneMensaje($codigo);
        $this->mensajes[] = $mensaje;        
    }
    
    public function vacia() {
        if(count($this->productos) == 0) return true;
        return false;
    }
    
   public function guarda_lista() { $_SESSION['lista'] = $this; }
    
    public static function carga_mensajes() {
        if (!isset($_SESSION['lista'])) return new AccionesMsj();
        else return ($_SESSION['lista']);
    }
    
    public function muestra() {
       if (count($this->mensajes)==0){
           print "<p>No hay mensajes</p>";
       }
       else{
           foreach ($this->mensajes as $mensaje){ 
               $mensaje->muestra();               
           }
       }
    }
}

?>
