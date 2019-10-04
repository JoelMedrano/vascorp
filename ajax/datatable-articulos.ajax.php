<?php

require_once "../controladores/articulos.controlador.php";
require_once "../modelos/articulos.modelo.php";

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

require_once "../controladores/colores.controlador.php";
require_once "../modelos/colores.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class TablaArticulos{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaArticulos(){

        $item = null;     
        $valor = null;

        $articulos = ControladorArticulos::ctrMostrarArticulos($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

        /*=============================================
        TRAEMOS LA IMAGEN
        =============================================*/ 

        $imagen = "<img src='".$articulos[$i]["imagen"]."' width='40px'>";

        /*=============================================
        TRAEMOS LA CATEGORÍA
        =============================================*/ 

        $item = "id";
        $valor = $articulos[$i]["id_marca"];

        $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);
        
        /*=============================================
        STOCK
        =============================================*/ 

        if($articulos[$i]["stock"] <= 10){

            $stock = "<button class='btn btn-danger'>".$articulos[$i]["stock"]."</button>";

        }else if($articulos[$i]["stock"] > 11 && $articulos[$i]["stock"] <= 15){

            $stock = "<button class='btn btn-warning'>".$articulos[$i]["stock"]."</button>";

        }else{

            $stock = "<button class='btn btn-success'>".$articulos[$i]["stock"]."</button>";

        }        

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$articulos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$articulos[$i]["id"]."' codigo='".$articulos[$i]["codigo"]."' imagen='".$articulos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$imagen.'",
            "'.$articulos[$i]["articulo"].'",
            "'.$marcas["marca"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["tipo"].'",
            "'.$articulos[$i]["estado"].'",
            "'.$articulos[$i]["stock"].'",
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
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaArticulos();
$activarArticulos -> mostrarTablaArticulos();