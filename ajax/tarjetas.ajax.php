<?php

session_start();


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

	// Activar-Desactivar tarjeta
	public $activarId;
	public $activarTarjeta;
	public function ajaxActivarDesactivarTarjeta(){

		$tabla="tarjetasjf";
		$item1="estado";
		$valor1=$this->activarTarjeta;
		$item2="id";
		$valor2=$this->activarId;
		$item3="usu_aprob";
		$valor3=$_SESSION["id"];;

		var_dump($tabla,$item1,$valor1,$item2,$valor2,$item3,$valor3);

		$respuesta=ModeloTarjetas::mdlActualizarTarjeta($tabla,$item1,$valor1,$item2,$valor2,$item3,$valor3);
		echo $respuesta;
	}	


}

// OBJETOS
if(isset($_POST["idTarjeta"])){

	$eliminarTarjeta=new AjaxTarjetas();
	$eliminarTarjeta->idTarjeta=$_POST["idTarjeta"];
    $eliminarTarjeta->ajaxEliminarTarjeta();
    
}

//OBJETOS

if(isset($_POST["activarId"])){
	$activar=new AjaxTarjetas();
	$activar->activarId=$_POST["activarId"];
	$activar->activarTarjeta=$_POST["activarTarjeta"];
	$activar->ajaxActivarDesactivarTarjeta();
}