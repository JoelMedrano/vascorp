<?php

// Requerimos el controlador y el modelo
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';

class AjaxMateriaPrima{

  /*=============================================
  EDITAR ARTICULO
  =============================================*/ 

  public $idMateriaPrima;
/*   public $traerProductos;
  public $nombreProducto; */

  public function ajaxEditarMateriaPrima(){

	$item = "codpro";
	$valor = $this->idMateriaPrima;

	$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($item, $valor);

  	echo json_encode($respuesta);

  }

}


/*=============================================
EDITAR ARTICULO
=============================================*/ 

if(isset($_POST["idMateriaPrima"])){

	$editarMateriaPrima = new AjaxMateriaPrima();
	$editarMateriaPrima -> idMateriaPrima = $_POST["idMateriaPrima"];
	$editarMateriaPrima -> ajaxEditarMateriaPrima();
  
  }