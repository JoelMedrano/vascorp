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
                                            "cantidad"=>$value["cantidad"],
                                            "saldo"=>$value["cantidad"]);

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

	/* 
	* MOSTRAR DATOS DEL DETALLE DE LAS TARJETAS
	*/
	static public function ctrMostrarDetallesOrdenCorte($item,$valor){

		$tabla = "detalles_ordencortejf";

		$respuesta = ModeloOrdenCorte::mdlMostraDetallesOrdenCorte($tabla,$item,$valor);

		return $respuesta;

    }
    
    /* 
    * Editar Orden de Corte
    */
    static public function ctrEditarOrdenCorte(){

        if(isset($_POST["editarCodigo"]) && isset($_POST["idUsuario"]) && isset($_POST["listaArticulosOC"])){

            #var_dump($_POST["editarCodigo"], $_POST["idUsuario"],$_POST["listaArticulosOC"]);

            if($_POST["listaArticulosOC"] == ""){

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se cambio ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="index.php?ruta=editar-ordencorte&codigo='.$_POST["codigoE"].'";}
						});
					</script>';              

            }else{

                /* 
                todo: Traemos los datos del detalle de Orden de Corte
                */
                $detaOC = ModeloOrdenCorte::mdlMostraDetallesOrdenCorte("detalles_ordencortejf", "ordencorte", $_POST["editarCodigo"]);
                #var_dump("detaOC", $detaOC);

                /* 
                todo: Cabiamos los codigos de al lista por los codigos de articulos
                */
                foreach($detaOC as $key=>$value){

                    $infoArt = controladorArticulos::ctrMostrarArticulos("articulo",$value["articulo"]);
                    $detaOC[$key]["articulo"]=$infoArt["articulo"];
                    #var_dump("detaOC", $detaOC[$key]["articulo"]);

                }

                if($_POST["listaArticulosOC"] == ""){

                    $listaArticulosOC = $detaOC;
                    $validarCambio = false;

                }else{

                    $listaArticulosOC = json_decode($_POST["listaArticulosOC"], true);
                    $validarCambio = true;

                }

                if($validarCambio){

                    /* 
                    todo: Actualizamos en articulos las ord_Corte
                    */
                    foreach($listaArticulosOC as $key=>$value){

                        $item1 = "ord_corte";
                        $valor1 = $value["ord_corte"];
                        $valor2 = $value["articulo"];

                        ModeloArticulos::mdlActualizarUnDato("articulojf", $item1, $valor1, $valor2);

                    }

                }

                /* 
                todo: Editamos los cambios de la cabecera Orden de Corte
                */
                $datos = array( "codigo"=>$_POST["editarCodigo"],
                                "usuario"=>$_POST["idUsuario"],
                                "total"=>$_POST["totalOrdenCorte"],
                                "saldo"=>$_POST["totalOrdenCorte"],
                                "lastUpdate"=>$_POST["fechaActual"]);
                #var_dump("datos", $datos);

                $respuesta = ModeloOrdenCorte::mdlEditarOrdenCorte("ordencortejf", $datos);

                if($respuesta == "ok"){

                    /* 
                    todo: Editamos los cambios del detalle Ordenes de Corte, primero eliminamos los detalles
                    */

                    $eliminarDato = ModeloOrdenCorte::mdlEliminarDato("detalles_ordencortejf", "ordencorte", $_POST["editarCodigo"]);

                    $eliminarDato = "ok";

                    if($eliminarDato == "ok"){

                        foreach($listaArticulosOC as $key=>$value){

                            #var_dump("listaArticulosOC", $listaArticulosOC);

                            $datosD = array("ordencorte"=>$_POST["editarCodigo"],
                                            "articulo"=>$value["articulo"],
                                            "cantidad"=>$value["cantidad"],
                                            "saldo"=>$value["cantidad"]);

                            #var_dump("datosD", $datosD);

                            ModeloOrdenCorte::mdlGuardarDetallesOrdenCorte("detalles_ordencortejf", $datosD);

                        }

                        # Mostramos una alerta suave
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "Felicitaciones",
                                    text: "¡La información fue Actualizada con éxito!",
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
									window.location="ordencorte";}
							});
						</script>';

                    }


                }else{

				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="ordencorte";}
						});
					</script>';

                }                                

            }

        }

    }

    /* 
    *Método para eliminar las ordenes de corte
    */
    static public function ctrEliminarOrdenCorte($codigo){

        $item = "codigo";
        $infoOC = ModeloOrdenCorte::mdlMostraDetallesOrdenCorte("ordencortejf", $item, $codigo);
        #var_dump("infoOC", $infoOC);

        $detaOC = ModeloOrdenCorte::mdlMostraDetallesOrdenCorte("detalles_ordencortejf", "ordencorte", $codigo);
        #var_dump("detaOC", $detaOC);

        /* 
        todo: Actualizamos orden de corte en Articulojf
        */
        foreach($detaOC as $key=>$value){

            $itemA = "articulo";
            $valorA = $value["articulo"];
    
            $infoA = ModeloArticulos::mdlMostrarArticulos("articulojf", $itemA, $valorA);
            #var_dump("infoA", $infoA);

            $ord_corte = $infoA["ord_corte"] - $value["cantidad"];
            #var_dump("ord_corte", $ord_corte);

            ModeloArticulos::mdlActualizarUnDato("articulojf", "ord_corte", $ord_corte, $value["articulo"]);

        }

        /* 
        todo: Eliminamos la cabecera de Orden de corte
        */
        $tablaOC = "ordencortejf";
        $itemOC = "codigo";
        $valorOC = $codigo;

        $respuesta = ModeloOrdenCorte::mdlEliminarDato($tablaOC, $itemOC, $valorOC);

        if($respuesta == "ok"){

            /* 
            todo: Eliminamos el detalle de Orden de corte
            */
            $tablaDOC = "detalles_ordencortejf";
            $itemDOC = "ordencorte";
            $valorDOC = $codigo;

            ModeloOrdenCorte::mdlEliminarDato($tablaDOC, $itemDOC, $valorDOC);

        }

        return $respuesta;

    }    

}