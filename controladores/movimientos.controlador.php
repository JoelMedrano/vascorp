<?php

class ControladorMovimientos{

    /* 
    * total unidades vendidas del mes actual
    */
    static public function ctrTotUndVen(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotUndVen($tabla);

        return $respuesta;

    }

    /* 
    * total unidades producidas del mes actual
    */
    static public function ctrTotUndProd(){

        $tabla = "movimientosjf";

        $respuesta = ModeloMovimientos::mdlTotUndProd($tabla);

        return $respuesta;

    }

    /* 
    * sacar los meses con movimientos
    */
    static public function ctrMesesMov(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mldMesesMov($tabla);

        return $respuesta;

    }

    /* 
    * sacamos los totales de ventas por mes
    */
    static public function ctrTotalMesVent(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotalMesVent($tabla);

        return $respuesta;
    }

    /* 
    * sacamos los totales de produccion por mes
    */
    static public function ctrTotalMesProd(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotalMesProd($tabla);

        return $respuesta;
    } 
    
    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrMostrarTotales($item, $valor){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mldMostrarTotales($tabla, $item, $valor);

        return $respuesta;

    }


}