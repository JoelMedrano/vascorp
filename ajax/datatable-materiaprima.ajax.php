<?php

require_once "../controladores/materiaprima.controlador.php";
require_once "../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){


/*         echo '{"data": [[
            "1",
            "00001",
            "CIN001",
            "CINTA",
            "CINTA BEBE ANCHA 7MM",
            "1040.000000",
            "VERDE MILITAR",
            "MTS",
            "0.063900",
            "botones"
            ],[
            "2",
            "00002",
            "ADH002",
            "ADHESIVO",
            "AUTOADHESIVO PARA HANG TAG",
            "0.000000",
            "BLANCO",
            "UND",
            "0.005900",
            "botones"
            ],[
            "3",
            "00004",
            "ADH003",
            "ADHESIVO",
            "AUTOADHESIVO TALLERO",
            "0.000000",
            "6",
            "UND",
            "0.002000",
            "botones"
            ],[
            "4",
            "00005",
            "ADH003",
            "ADHESIVO",
            "AUTOADHESIVO TALLERO",
            "0.000000",
            "8",
            "UND",
            "0.002000",
            "botones"
            ],[
            "5",
            "00006",
            "ADH003",
            "ADHESIVO",
            "AUTOADHESIVO TALLERO",
            "0.000000",
            "10",
            "UND",
            "0.002000",
            "botones"
            ]]}';
 */









        $item = null;     
        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima($item, $valor);	

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         
            
/*             $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima'><i class='fa fa-pencil'></i></button></div>";  */

                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima'><i class='fa fa-pencil'></i></button></div>";
    
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