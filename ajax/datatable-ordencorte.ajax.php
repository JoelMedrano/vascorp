<?php

require_once "../controladores/ordencorte.controlador.php";
require_once "../modelos/ordencorte.modelo.php";

class TablaOrdenCorte{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaOrdenCorte(){

        $item = null;
        $valor = null;

        $ordencorte = ControladorOrdenCorte::ctrMostrarOrdenCorte($item, $valor);

        #var_dump("ordencorte", $ordencorte);

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ordencorte); $i++){
                   
            /* 
            todo: formato de miles
            */
            $total = number_format($ordencorte[$i]["total"],0);
            $saldo = number_format($ordencorte[$i]["saldo"],0);

            /* 
            todo: estado de orden de corte
            */
            if($ordencorte[$i]["estado"] == "Cerrado"){

                $estadoOC = "<span style='font-size:85%' class='label label-danger'>Cerrado</span>";

            }else if($ordencorte[$i]["estado"] == "Pendiente"){

                $estadoOC = "<span style='font-size:85%' class='label label-warning'>Pendiente</span>";

            }else{

                $estadoOC = "<span style='font-size:85%' class='label label-primary'>Parcial</span>";

            }

            /* 
            todo: Traemos las acciones
            */
                $botones =  "<div class='btn-group'><button class='btn btn-warning  btnEditarTarjeta' title='Editar Tarjeta' idTarjeta='".$ordencorte[$i]["codigo"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger  btnEliminarTarjeta' title='Eliminar Tarjeta' idTarjeta='".$ordencorte[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>";

                $datosJson .= '[
                "'.$ordencorte[$i]["codigo"].'",
                "'.$ordencorte[$i]["nombre"].'",
                "'.$total.'",
                "'.$saldo.'",
                "'.$estadoOC.'",
                "'.$ordencorte[$i]["fecha"].'",
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/ 
$activarOrdenCorte = new TablaOrdenCorte();
$activarOrdenCorte -> mostrarTablaOrdenCorte();