<?php

require_once "../controladores/articulos.controlador.php";
require_once "../modelos/articulos.modelo.php";

class TablaArticulosPedidos{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaArticulosPedidos(){


        $articulos = controladorArticulos::ctrListaArticulosPedidos();	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        #$botones =  "<div class='btn-group'><button class='btn btn-primary agregarArtPed recuperarBoton' articulo='".$articulos[$i]["articulo"]."'>Agregar</button></div>"; 
        $botones =  "<div class='btn-group'><button class='btn btn-primary agregarArtPed recuperarBoton' data-toggle='modal' data-target='#modalAgregarClienteP' modelo='".$articulos[$i]["modelo"]."' color='".$articulos[$i]["cant_color"]."' talla='".$articulos[$i]["cant_talla"]."'>Agregar</button></div>";

            $datosJson .= '[
            "'.($i+1).'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["cant_color"].'",
            "'.$articulos[$i]["cant_talla"].'",
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
ACTIVAR TABLA DE articulos
=============================================*/ 
$activarArticulosPedidos = new TablaArticulosPedidos();
$activarArticulosPedidos -> mostrarTablaArticulosPedidos();