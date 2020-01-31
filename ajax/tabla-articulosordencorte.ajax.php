<?php

require_once "../controladores/articulos.controlador.php";
require_once "../modelos/articulos.modelo.php";

class TablaArticulosOrdenCorte{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarArticuloOrdenCorte(){

        $articulos = controladorArticulos::ctrMostrarArticulosUrgencia();	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

    
        /* 
        todo: BOTONES
        */                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarArt recuperarBoton' articuloOC='".$articulos[$i]["articulo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>";
        
        /* 
        todo: PEDIDOS
        */
            $pedidos = "<center>".$articulos[$i]["pedidos"]."</center>";

        /* 
        todo: STOCK
        */
        if( $articulos[$i]["stockB"] <= 0){

            $stock = "<center><span class='label label-danger'>".$articulos[$i]["stockB"]."</span></center>";

        }else if( $articulos[$i]["stockB"] < $articulos[$i]["configuracion"]){

            $stock = "<center><b><span class='text-danger'>".$articulos[$i]["stockB"]."</span></b></center>";

        }else{

            $stock = "<center>".$articulos[$i]["stockB"]."</center>";

        }

        /* 
        todo: ORDEN CORTE
        */
        if( $articulos[$i]["ord_corte"] >0 ){

            $ord_corte = "<center><span style='font-size:85%' class='label label-default'>".$articulos[$i]["ord_corte"]."</span></center>";

        }else{

            $ord_corte = "<center>".$articulos[$i]["ord_corte"]."</center>";
            
        }

        /* 
        todo: ALMACEN DE CORTE
        */
        if( $articulos[$i]["alm_corte"] >0 ){

            $alm_corte = "<center><span style='font-size:85%' class='label label-success'>".$articulos[$i]["alm_corte"]."</span></center>";

        }else{

            $alm_corte = "<center>".$articulos[$i]["alm_corte"]."</center>";

        }  

        /* 
        todo: TALLER
        */
        if( $articulos[$i]["taller"] >0 ){

            $taller = "<center><span style='font-size:85%' class='label label-primary'>".$articulos[$i]["taller"]."</span></center>";

        }else{

            $taller = "<center>".$articulos[$i]["taller"]."</center>";

        }

      


            $datosJson .= '[
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$stock.'",
            "'.$pedidos.'",
            "'.$taller.'",
            "'.$alm_corte.'",
            "'.$ord_corte.'",
            "<center>'.$articulos[$i]["ventas"].'</center>",
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
ACTIVAR TABLA DE MATERIA PRIMA TARJETAS
=============================================*/ 
$activarArticuloOrdenCorte = new TablaArticulosOrdenCorte();
$activarArticuloOrdenCorte -> mostrarArticuloOrdenCorte();