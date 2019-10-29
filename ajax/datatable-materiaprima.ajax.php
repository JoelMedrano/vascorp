<?php

require_once "../controladores/materiaprima.controlador.php";
require_once "../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $item = null;     
        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima($item, $valor);	

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $botones = "<div class='btn-group'><button class='btn btn-info btnVisualizarArticulos' title='Visualizar Articulos' data-toggle='modal' data-target='#modalVisualizarArticulos' articuloMP='".$materiaprima[$i]["codigo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima'><i class='fa fa-pencil'></i></button></div>";
    
                $datosJson .= '[
                "'.($i+1).'",
                "'.$materiaprima[$i]["codigo"].'",
                "'.$materiaprima[$i]["codlinea"].'",
                "'.$materiaprima[$i]["linea"].'",
                "'.$materiaprima[$i]["descripcion"].'",
                "'.$materiaprima[$i]["color"].'",
                "'.$materiaprima[$i]["stock"].'",
                "'.$materiaprima[$i]["unidad"].'",
                "'.$materiaprima[$i]["cospro"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/ 
$activarMateriaPrima = new TablaMateriaPrima();
$activarMateriaPrima -> mostrarTablaMateriaPrima();