<?php
class Mensaje {
    protected $codigo;
    protected $titulo;
    protected $mensaje;
    protected $fecha;
    protected $autor;
    
    public function getcodigo() {return $this->codigo; }
    public function gettitulo() {return $this->titulo; }
    public function getmensaje() {return $this->mensaje; }
    public function getfecha() {return $this->fecha; }
    public function getautor() {return $this->autor; }
        
    public function muestra() { print "<p>" . $this->titulo . "</p>"+"<p>" . $this->mensaje . "</p>"; }
    
    function __construct($row) {
        $this->codigo = $row['content_id'];
        $this->titulo = $row['content_title'];
        $this->mensaje = $row['content_message'];
        $this->fecha = $row['content_date'];
        $this->autor = $row['content_owner'];
    }

}
?>
