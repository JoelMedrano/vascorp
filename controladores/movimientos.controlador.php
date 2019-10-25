<?php

class ControladorMovimientos{

    /* 
    * total unidades vendidas del mes actual
    */
    static public function ctrTotUndVen(){

        $tabla = "movimientosjf";

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

        $tabla = "movimientosjf";

        $respuesta = ModeloMovimientos::mldMesesMov($tabla);

        return $respuesta;

    }

    /* 
    * sacamos los totales de ventas por mes
    */
    static public function ctrTotalMesVent(){

        $tabla = "movimientosjf";

        $respuesta = ModeloMovimientos::mdlTotalMesVent($tabla);

        return $respuesta;
    }

    /* 
    * sacamos los totales de produccion por mes
    */
    static public function ctrTotalMesProd(){

        $tabla = "movimientosjf";

        $respuesta = ModeloMovimientos::mdlTotalMesProd($tabla);

        return $respuesta;
    }    

}