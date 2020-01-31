<?php

class ControladorMovimientos{

    /* 
    * total unidades vendidas del mes actual
    */
    static public function ctrTotUndVen($valor){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotUndVen($tabla, $valor);

        return $respuesta;

    }

    /* 
    * total unidades producidas del mes actual
    */
    static public function ctrTotUndProd($valor){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotUndProd($tabla, $valor);

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

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrTotalesSolesVenta(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotalesSolesVenta($tabla);

        return $respuesta;

    }

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrTotalesSolesPagos(){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotalesSolesPagos($tabla);

        return $respuesta;

    }

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrTotDiasProd($valor){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlTotDiasProd($tabla, $valor);

        return $respuesta;

    }

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrMovMes($valor){

        $tabla = "movimientosjf";

        $respuesta = ModeloMovimientos::mdlMovMes($tabla, $valor);

        return $respuesta;

    }
    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrSumaUnd($valor){

        $tabla = "totalesjf";

        $respuesta = ModeloMovimientos::mdlSumaUnd($tabla, $valor);

        return $respuesta;

    }
    
    /* 
    * MOSTRAR ULTIMO NUMERO DE TALONARIO
    */
    static public function ctrMostrarTalonario(){

        $tabla = "talonariosjf";

        $respuesta = ModeloMovimientos::mdlMostrarTalonario($tabla);

        return $respuesta;

    }         
    

}