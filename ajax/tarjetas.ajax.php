<?php
require_once '../controladores/tarjetas.controlador.php';
require_once '../modelos/tarjetas.modelo.php';
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';

class AjaxTarjetas{
	# Método para eliminar la info de tarjetas
	public $idTarjeta;
	public function ajaxEliminarTarjeta(){

        $idTarjeta=$this->idTarjeta;
        
		$respuesta=ControladorTarjetas::ctrEliminarTarjeta($idTarjeta);
        echo $respuesta;
        
	}
}

// OBJETOS
if(isset($_POST["idTarjeta"])){

	$eliminarTarjeta=new AjaxTarjetas();
	$eliminarTarjeta->idTarjeta=$_POST["idTarjeta"];
    $eliminarTarjeta->ajaxEliminarTarjeta();
    
}