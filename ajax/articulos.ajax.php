<?php

// Requerimos el controlador y el modelo
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxArticulos{

	/* 
	* Activar-Desactivar Usuario
	*/
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
	
	/* 
	* EDITAR ARTICULO
	*/
	public $idArticulo;

	public function ajaxEditarArticulo(){

		$item = "id";
		$valor = $this->idArticulo;

		$respuesta = ControladorArticulos::ctrMostrarArticulos($item, $valor);

		echo json_encode($respuesta);

	}
	
	/* 
	* MOSTRAR ARTICULO PARA ORDEN DE CORTE
	*/
	public $articuloOC;

	public function ajaxMostrarArticuloOC(){

		$item = "articulo";
		$valor = $this->articuloOC;

		$respuesta = controladorArticulos::ctrMostrarArticulos($item, $valor);

		echo json_encode($respuesta);

	}

}

//OBJETOS

if(isset($_POST["activarId"])){
	$activar=new AjaxArticulos();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarArticulo();
}


/*=============================================
EDITAR ARTICULO
=============================================*/ 

if(isset($_POST["idArticulo"])){

	$editarArticulo = new AjaxArticulos();
	$editarArticulo -> idArticulo = $_POST["idArticulo"];
	$editarArticulo -> ajaxEditarArticulo();
  
}
  

/* 
* MOSTRAR ARTICULOS PARA ORDEN DE CORTE
*/ 
if( isset($_POST["articuloOC"])){

	$mostrarArticuloOC = new AjaxArticulos();
	$mostrarArticuloOC -> articuloOC = $_POST["articuloOC"];
	$mostrarArticuloOC -> ajaxMostrarArticuloOC();

}
