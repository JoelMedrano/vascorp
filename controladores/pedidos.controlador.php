<?php

class ControladorPedidos{

    /* 
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTemporal($valor){

		$tabla = "temporaljf";

		$respuesta = ModeloPedidos::mdlMostrarTemporal($tabla, $valor);

		return $respuesta;

    }    
    
    /* 
    *MOSTRAR DETALLE DE TAMPOERAL
    */
	static public function ctrMostrarDetallesTemporal($valor){

		$tabla = "detalle_temporal";

		$respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $valor);

		return $respuesta;

	}    

    static public function ctrCrearPedido(){

        if(isset($_POST["pedido"])){

            /* 
            todo: VARIABLES GLOBALES DEL TALONARIO
            */
            $tabla = "temporaljf";

            #ver si ya existe el pedido
            $pedido = ModeloPedidos::mdlMostrarTemporal($tabla, $_POST["pedido"]);
            #var_dump("pedido", $pedido);

            if($pedido["codigo"] != ""){ #si ya existe

                /* 
                todo: GUARDAR EL DETALLE TEMPORAL - CUANDO YA EXISTE EL TEMPORAL
                */
                $valor = $_POST["modeloModal"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_temporal";                
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $_POST["pedido"];
                    $val4 = $_POST["precio"];

                    if($val2 > 0){

                        #1ero eliminar si ya se registro
                        $eliminar = array(  "codigo" => $val3,
                                            "articulo" => $val1);
                        
                        $limpiar = ModeloPedidos::mdlEliminarDetalleTemporal($tabla, $eliminar);
                        #var_dump("eliminar", $eliminar);
                        #var_dump("limpiar", $limpiar);

                        $datos = array( "codigo"    => $val3,
                                        "articulo"  => $val1,
                                        "cantidad"  => $val2,
                                        "precio"    => $val4);
                        #var_dump("datos", $datos);

                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);
                        #var_dump("respuesta", $respuesta);

                        if($respuesta = "ok"){

                            echo '  <script>
                            
                                     window.location="index.php?ruta=crear-pedidocv&pedido='.$_POST["pedido"].'";
                            
                                    </script>';
                            
                        }

                    }

                }



            }else{ #si no existe

                #vemos el numero que sigue en el talonario y actualizamos en +1
                $numero = ControladorMovimientos::ctrMostrarTalonario();
                $talonario = $numero["pedido"] + 1;
                ModeloPedidos::mdlActualizarTalonario();

                /* 
                todo: GUARDAR CABECERA
                */
                $datos = array( "codigo" => $talonario,
                                "cliente" => $_POST["cliente"],
                                "vendedor" => $_POST["vendedor"]);

                ModeloPedidos::mdlGuardarTemporal($tabla, $datos);

                /* 
                todo: GUARDAR EL DETALLE TEMPORAL
                */
                $valor = $_POST["modeloModal"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach($respuesta as $value){
                    
                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_temporal";                
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $talonario;
                    $val4 = $_POST["precio"];

                    if($val2 > 0){

                        $datos = array( "codigo"    => $val3,
                                        "articulo"  => $val1,
                                        "cantidad"  => $val2,
                                        "precio"    => $val4);
                        #var_dump("datos", $datos);

                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);
                        #var_dump("respuesta", $respuesta);

                        if($respuesta = "ok"){

                            echo '  <script>
                            
                                     window.location="index.php?ruta=crear-pedidocv&pedido='.$talonario.'";
                            
                                    </script>';
                            
                            }



                    }

                }

            }

        }

    }

}