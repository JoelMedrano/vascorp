<?php

require_once '../controladores/ordencorte.controlador.php';
require_once '../modelos/ordencorte.modelo.php';

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxOrdenCorte{

    public $codigo;

    public function ajaxEliminarOrdenCorte(){

        $codigo = $this->codigo;

        $respuesta = ControladorOrdenCorte::ctrEliminarOrdenCorte($codigo);

        echo $respuesta;

    }


}

/* 
* ELIMINAR ORDEN DE CORTE
*/
if(isset($_POST["codigo"])){

	$eliminarOrdenCorte=new AjaxOrdenCorte();
	$eliminarOrdenCorte->codigo=$_POST["codigo"];
    $eliminarOrdenCorte->ajaxEliminarOrdenCorte();
    
}