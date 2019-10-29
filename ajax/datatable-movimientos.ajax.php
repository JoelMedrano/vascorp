<?php

require_once "../controladores/movimientos.controlador.php";
require_once "../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMovimientos(){

        $item = null;     
        $valor = null;

        $movimientos = ControladorMovimientos::ctrMostrarTotales($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            /* 
            todo: RESALTAMOS EL NOMBRE DEL MES
            */

            $nombre_mes = "<label>".$movimientos[$i]["nom_mes"]."</labe>";
    
            /* 
            todo: TRAEMOS LOS BOTONES
            */       
            
            $botones =  "<div class='btn-group'><button class='btn btn-success btnActualizarMes' año='".$movimientos[$i]["año"]."' mes='".$movimientos[$i]["mes"]."'><i class='fa fa-refresh'></i></button></div>"; 

                $datosJson .= '[
                "'.($i+1).'",
                "'.$movimientos[$i]["año"].'",
                "'.$movimientos[$i]["mes"].'",
                "'.$nombre_mes.'",
                "'.number_format($movimientos[$i]["ventas"],0).'",
                "'.number_format($movimientos[$i]["produccion"],0).'",
                "'.$botones.'"
                ],';        
                }

                $datosJson=substr($datosJson, 0, -1);

                $datosJson .= '] 

                }';

            echo $datosJson;

    }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarMovimientos = new TablaMovimientos();
$activarMovimientos -> mostrarTablaMovimientos();