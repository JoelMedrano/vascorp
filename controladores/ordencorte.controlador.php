<?php

class ControladorOrdenCorte{

    /* 
    * MOSTRAR DATOS DE LAS ORDENES DE CORTE
    */
    static public function ctrMostrarOrdenCorte($item, $valor){

        $tabla = "ordencortejf";

        $respuesta = ModeloOrdenCorte::mdlMostarOrdenCorte($tabla, $item, $valor);

        return $respuesta;

    }

    /* 
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoOC(){

        $tabla = "ordencortejf";

        $respuesta = ModeloOrdenCorte::mdlUltimoCodigoOC($tabla);

        return $respuesta;

    }

    /* 
    * CREAR ORDEN DE CORTE
    */
    static public function ctrCrearOrdenCorte(){

        /* 
        todo: Verificamos que traiga datos
        */
        if( isset($_POST["nuevaOrdenCorte"]) &&
            isset($_POST["idUsuario"]) &&
            isset($_POST["configuracion"])){

                #var_dump("nuevaOrdenCorte", $_POST["nuevaOrdenCorte"]);

                if($_POST["listaArticulosOC"] == ""){

                    /* 
                    ? Mostramos una alerta suave si viene vacia
                    */
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡No se seleccionó ningún artículo. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="crear-ordencorte";}
                            });
                        </script>';

                }else{

                    /* 
                    ? Actualizamos la cantidad de la orden de corte
                    */

                    $listaArticulos = json_decode($_POST["listaArticulosOC"], true);

                    #var_dump("listaArticulos", $listaArticulos);

                    foreach($listaArticulos as $value){

                        $tabla = "articulojf";

                        $valor = $value["articulo"];

                        $item1 = "ord_corte";
                        $valor1 = $value["ord_corte"];

                        ModeloArticulos::mdlActualizarUnDato($tabla, $item1, $valor1, $valor);

                    }

                    /* 
                    * GUARDAR LA ORDEN DE CORTE
                    */

                    $datos = array( "usuario"=>$_POST["idUsuario"],
                                    "codigo"=>$_POST["nuevaOrdenCorte"],
                                    "configuracion"=>$_POST["configuracion"],
                                    "total"=>$_POST["totalOrdenCorte"],
                                    "saldo"=>$_POST["totalOrdenCorte"],
                                    "estado"=>"Pendiente");

                    #var_dump("datos", $datos);
                    
                    $respuesta = ModeloOrdenCorte::mdlGuardarOrdenCorte("ordencortejf", $datos);

                    if($respuesta == "ok"){

                        /* 
                        * GUARDAR DETALLE DE ORDEN DE CORTE
                        */

                        $ultimoId = ModeloOrdenCorte::mdlUltimoId();
                        #var_dump("ultimoId", $ultimoId[0]["ult_codigo"]);

                        foreach($listaArticulos as $key=>$value){

                            $datosD = array("ordencorte"=>$ultimoId[0]["ult_codigo"],
                                            "articulo"=>$value["articulo"],
                                            "cantidad"=>$value["cantidad"]);

                            #var_dump("datosD", $datosD);

                            ModeloOrdenCorte::mdlGuardarDetallesOrdenCorte("detalles_ordencortejf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue registrada con éxito!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location="ordencorte";}
                                });
                            </script>';                        

                    }else{

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="crear-ordencorte";}
							});
						</script>';

                    }



                }

        }


    }



}