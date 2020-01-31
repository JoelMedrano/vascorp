<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaClientes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaClientes(){

        $item = null;     
        $valor = null;

        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($clientes); $i++){

            /* 
            todo: TIPO PERSONA
            */
            if($clientes[$i]["tipo_persona"] == "NATURAL"){

                $tipo_persona = "<span style='font-size:85%' class='label label-success'>NATURAL</span>";

                
            }else if($clientes[$i]["tipo_persona"] == "JURÍDICA"){

                $tipo_persona = "<span style='font-size:85%' class='label label-info'>JURÍDICA</span>";

            }else{

                $tipo_persona = "<span style='font-size:85%' class='label label-warning'></span>";

            }
            
            /* 
            todo: TIPO DOCUMENTO
            */
            if($clientes[$i]["tipo_documento"] == "DNI"){

                $tipo_documento = "<span style='font-size:85%' class='label label-primary'>DNI</span>";
                
            }elseif($clientes[$i]["tipo_documento"] == "RUC"){

                $tipo_documento = "<span style='font-size:85%' class='label label-danger'>RUC</span>";

            }
            else{

                $tipo_documento = "<span style='font-size:85%' class='label label-warning'></span>";

            }            


    
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         
            
            $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' codigo='".$clientes[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button></div>"; 

                $datosJson .= '[
                "'.$clientes[$i]["codigo"].'",
                "'.$clientes[$i]["nombre"].'",
                "'.$tipo_persona.'",
                "'.$tipo_documento.'",
                "'.$clientes[$i]["documento"].'",
                "'.$clientes[$i]["telefono"].'",
                "'.$clientes[$i]["ubigeo"].'",
                "'.$clientes[$i]["fecha"].'",
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
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarClientes = new TablaClientes();
$activarClientes -> mostrarTablaClientes();