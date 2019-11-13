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
            todo: orden de corte
            */
             $codigo = "<b>OC - ".$ordencorte[$i]["codigo"]."</b>";   


            /* 
            todo: url
            */ 

            $url='index.php?ruta=rpt_ordencorte?id=';


            /* 
            todo: Traemos las acciones
            */
                $botones =  "<div class='btn-group'><button class='btn btn-info btnVisualizarOC' title='Visualizar Orden Corte' data-toggle='modal' data-target='#modalVisualizarOC' codigo='".$ordencorte[$i]["codigo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-warning  btnEditarOC' title='Editar Orden de Corte' codigo='".$ordencorte[$i]["codigo"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger  btnEliminarOC' title='Eliminar Orden de Corte' codigo='".$ordencorte[$i]["codigo"]."'><i class='fa fa-times'></i><button class='btn btn-success  btnReporteOC' title='Reporte Orden de Corte' codigo='".$ordencorte[$i]["codigo"]."'><i class='fa fa-file-excel-o'></i></button></div>";

                $datosJson .= '[
                "'.$codigo.'",
                "'.$ordencorte[$i]["nombre"].'",
                "<center><b>'.$total.'</b></center>",
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