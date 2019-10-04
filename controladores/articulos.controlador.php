<?php

class controladorArticulos{

	/*=============================================
	MOSTRAR ARTICULOS
	=============================================*/

	static public function ctrMostrarArticulos($item, $valor){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

		return $respuesta;

	}


}