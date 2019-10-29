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

	$item = "Codpro";
	$valor = $this->idMateriaPrima;

	$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($item, $valor);

  	echo json_encode($respuesta);

  }

  /* 
  * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
  */
  public $articuloMP;

	public function ajaxVisualizarMateriaPrima(){

		$item = "codpro";
		$valor = $this->articuloMP;

		$respuesta = ControladorMateriaPrima::ctrVisualizarMateriaPrima($item, $valor);

		echo json_encode($respuesta);
  
  }

  /* 
  * VISUALIZAR DETALLE DE LA MATERIA PRIMA
  */
  public function ajaxVisualizarMateriaPrimaDetalle(){

		$item = "mat_pri";
		$valor = $this->articuloMPDetalle;

		$respuestaDetalle = ControladorMateriaPrima::ctrVisualizarMateriaPrimaDetalle($item, $valor);

		echo json_encode($respuestaDetalle);
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

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMP"])){

	$visualizarMateriaPrima = new AjaxMateriaPrima();
	$visualizarMateriaPrima -> articuloMP = $_POST["articuloMP"];
	$visualizarMateriaPrima -> ajaxVisualizarMateriaPrima();
  
}

/* 
 * VISUALIZAR DETALLE DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMPDetalle"])){

  $visualizarMateriaPrimaDetalle = new AjaxMateriaPrima();
	$visualizarMateriaPrimaDetalle -> articuloMPDetalle = $_POST["articuloMPDetalle"];
	$visualizarMateriaPrimaDetalle -> ajaxVisualizarMateriaPrimaDetalle();
  
}