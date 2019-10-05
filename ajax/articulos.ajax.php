<?php

// Requerimos el controlador y el modelo
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxArticulos{

	// Activar-Desactivar Usuario
	public $activarId;
	public $activarEstado;
	public function ajaxActivarDesactivarArticulo(){
		$tabla="articulojf";
		$item1="estado";
		$valor1=$this->activarEstado;
		$item2="id";
		$valor2=$this->activarId;
		$respuesta=ModeloArticulos::mdlActualizarArticulo($tabla,$item1,$valor1,$item2,$valor2);
		echo $respuesta;
	}    

}

//OBJETOS

if(isset($_POST["activarId"])){
	$activar=new AjaxArticulos();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarArticulo();
}