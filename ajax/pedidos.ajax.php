<?php

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxPedidos{

    /* 
	* VISUALIZAR COLORES
	*/
	public function ajaxVerColores(){

        $item = "modelo";
        $valor = $this->modelo;

        $respuesta = controladorArticulos::ctrVerColores($item, $valor);
       
        echo json_encode($respuesta);
    }

    /* 
	* VISUALIZAR COLORES
	*/
	public function ajaxVerDatos(){

        $valor = $this->mod;

        $respuestaDet = controladorArticulos::ctrVerPrecios($valor);
       
        echo json_encode($respuestaDet);
    }    


}

/* 
 * VISUALIZAR COLORES
*/
if(isset($_POST["modelo"])){

    $visualizarMateriaPrimaDetalle = new AjaxPedidos();
    $visualizarMateriaPrimaDetalle -> modelo = $_POST["modelo"];
    $visualizarMateriaPrimaDetalle -> ajaxVerColores();

}

/* 
 * VISUALIZAR precios y otros
*/
if(isset($_POST["mod"])){

    $visualizarMateriaPrimaDetalle = new AjaxPedidos();
    $visualizarMateriaPrimaDetalle -> mod = $_POST["mod"];
    $visualizarMateriaPrimaDetalle -> ajaxVerDatos();

}