<?php

require_once "../controladores/articulos.controlador.php";
require_once "../modelos/articulos.modelo.php";

/* require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";
 */
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
        STOCK
        =============================================*/ 

        if($articulos[$i]["stock"] <= $articulos[$i]["configuracion"] ){

            $stock = "<button class='btn btn-danger btn-xs'>".$articulos[$i]["stock"]."</button>";

        }else{

            $stock = "<button class='btn btn-primary btn-xs'>".$articulos[$i]["stock"]."</button>";

        }
        
        /*=============================================
        ESTADO
        =============================================*/ 

        if($articulos[$i]["estado"] == "Descontinuado"){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivar' idArticulo='".$articulos[$i]["id"]."' estadoArticulo='Activo'>Inactivo</button>";

        }else if($articulos[$i]["estado"] == "CampañaD"){

            $estado = "<button class='btn btn-warning btn-xs'>CampañaD</button>";

        }else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivar' idArticulo='".$articulos[$i]["id"]."' estadoArticulo='Descontinuado'>Activo</button>";

        }

        /*=============================================
        TARJETA
        =============================================*/ 

        if($articulos[$i]["tarjeta"] == "Pendiente"){


            $tarjeta = "<span style='font-size:85%' class='label label-danger'>Pendiente</span>";

        }elseif($articulos[$i]["tarjeta"] == "No Necesario"){

            $tarjeta = "<span style='font-size:85%' class='label label-default'>No Necesario</span>";

        }else{

            $tarjeta = "<span style='font-size:85%' class='label label-info'>Listo</span>";

        }        


        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/
        
        if( $_GET["perfil"]=="Supervisor" ||
            $_GET["perfil"]=="Sistemas"){

                $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarArticulo' idArticulo='".$articulos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarArticulo'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarArticulo' idArticulo='".$articulos[$i]["id"]."' articulo='".$articulos[$i]["articulo"]."' imagen='".$articulos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

        }else{

                $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarArticulo' idArticulo='".$articulos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarArticulo'><i class='fa fa-pencil'></i></button></div>"; 

        }
        


            $datosJson .= '[
            "'.($i+1).'",
            "'.$imagen.'",
            "'.$articulos[$i]["articulo"].'",
            "'.$articulos[$i]["marca"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["tipo"].'",
            "'.$estado.'",
            "'.$stock.'",
            "'.$tarjeta.'",
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