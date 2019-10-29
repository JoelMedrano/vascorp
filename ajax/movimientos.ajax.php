<?php

require_once '../controladores/movimientos.controlador.php';
require_once '../modelos/movimientos.modelo.php';

class AjaxMovimientos{

    /* 
    * 
    */
	public $activarId;
    public $activarTarjeta;
    
	public function ajaxActualizarMovimientos(){

		$tabla="totalesjf";
		
		$valor1=$this->año;
		
		$valor2=$this->mes;


		/* var_dump($tabla,$valor1,$valor2); */


		$respuesta=ModeloMovimientos::mdlActualizarMovimientos($tabla,$valor1,$valor2);

		echo $respuesta;
	}

}

if(isset($_POST["año"])){
	$actualizar=new AjaxMovimientos();
	$actualizar->año=$_POST["año"];
	$actualizar->mes=$_POST["mes"];
	$actualizar->ajaxActualizarMovimientos();
}