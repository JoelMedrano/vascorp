<?php

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxUrgencias{

    /* 
	* VISUALIZAR LA CABECERA DE LA URGENCIA
	*/
	public $codigo;
	public function ajaxVisualizarUrgencias(){


		$valor = $this->codigo;

		$respuesta = controladorArticulos::ctrMostrarUrgencia($valor);

		echo json_encode($respuesta);
	
    }
    
	/* 
	* VISUALIZAR DETALLE DE LA MATERIA PRIMA
	*/
	public function ajaxVisualizarUrgenciasDetalle(){

        $valor = $this->codigoD;

        $respuestaDetalle = controladorArticulos::ctrMostrarUrgenciaDetalle($valor);

        echo json_encode($respuestaDetalle);
    }    


}

/* 
 * VISUALIZAR LA CABECERA DE LA URGENCIA
*/
if(isset($_POST["codigo"])){

	$visualizarUrgencias = new AjaxUrgencias();
	$visualizarUrgencias -> codigo = $_POST["codigo"];
	$visualizarUrgencias -> ajaxVisualizarUrgencias();
  
}

/* 
 * VISUALIZAR DETALLE DE LA URGENCIA
*/
if(isset($_POST["codigoD"])){

    $visualizarUrgenciasDetalle = new AjaxUrgencias();
    $visualizarUrgenciasDetalle -> codigoD = $_POST["codigoD"];
    $visualizarUrgenciasDetalle -> ajaxVisualizarUrgenciasDetalle();

}