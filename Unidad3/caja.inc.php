<?php
class Caja{
    var $alto;
    var $ancho;
    var $largo;
    var $contenido;

    function __construct($alto=1, $ancho=1, $largo=1) {
        $this->alto = $alto;
        $this->ancho = $ancho;
        $this->largo = $largo;
        $this->contenido = "";
    }

    function introduce($cosa) {
        $this->contenido = $cosa;
    }
    function muestra_contenido() {
        echo $this->contenido;
    }
}