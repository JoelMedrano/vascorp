<?php


class ControladorTarjetas{

	/* 
	* MOSTRAR DATOS DE LAS TARJETAS
	*/
	static public function ctrMostrarTarjetas($item, $valor){

		$tabla = "tarjetasjf";

        $respuesta = ModeloTarjetas::mdlMostrarTarjetas($tabla, $item, $valor);
        
        /* var_dump("respuesta", $respuesta); */

		return $respuesta;

	}

	/* 
	* MOSTRAR DATOS DEL DETALLE DE LAS TARJETAS
	*/
	static public function ctrMostrarDetallesTarjetas($item,$valor){

		$tabla="detalles_tarjetajf";

		$respuesta=ModeloTarjetas::mdlMostraDetallesTarjetas($tabla,$item,$valor);

		return $respuesta;

	}

	/* 
	* SACAR EL ULTIMO CODIGO
	*/
	static public function ctrUltimoCodigoTarjeta(){

		$respuesta = ModeloTarjetas::mdlUltimoCodigoTarjeta();

		return $respuesta;
	}

	/* 
	* CREAR TARJETAS
	*/
	static public function ctrCrearTarjeta(){
		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevaTarjeta"]) && 
		   isset($_POST["seleccionarArticulo"]) && 
		   isset($_POST["listaMP"])){

			/* var_dump("prueba",$_POST["listaMP"] ); */
			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listaMP"] == ""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ningún producto. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="crear-tarjeta";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaMP=json_decode($_POST["listaMP"],true);

				/* 
				! comentar luego de pruebas si trae datos
				*/
				
				/* var_dump("listaMP", $listaMP); */

				/*
				TODO - ACTUALIZAR QUE YA TIENE TARJETA
				*/

				$tablaA="articulojf";
				$item1="tarjeta";
				$valor1="si";

				$valor=$_POST["seleccionarArticulo"];

				/* var_dump("valor", $valor); */
				/* var_dump("update ", $tablaA, " set ", $item1, " = ", $valor1, " where articulo=", $valor); */

				ModeloArticulos::mdlActualizarUnDato($tablaA,$item1,$valor1,$valor);

				/*
				* GUARDAR TARJETA - CABECERA
				*/

				$datos=array("codigo"=>$_POST["nuevaTarjeta"],
							 "articulo"=>$_POST["seleccionarArticulo"],
							 "usuario"=>$_POST["idUsuario"],
							 "impuesto"=>$_POST["nuevoPrecioImpuesto"],
							 "neto"=>$_POST["nuevoPrecioNeto"],
							 "total"=>$_POST["totalTarjeta"],
							 "estado"=>"AC");

				/*
				! revisar que manda en la cabecera
				*/							 

				/* var_dump("datos cabecera", $datos); */

				$respuesta=ModeloTarjetas::mdlGuardarTarjetas("tarjetasjf",$datos);
				
				/* 
				* GUARDAR DETALLE DE TARJETA 
				*/

				if($respuesta=="ok"){

					$ultimoId=ModeloTarjetas::mdlUltimoIdTarjeta("tarjetasjf");
																			
					/* 
					! revisar que trae ultimo id
					*/							
					
					/* var_dump("ultimoId", $ultimoId[0]["articulo"]); */

					foreach($listaMP as $key=>$value){

						$datosD=array("articulo"=>$ultimoId[0]["articulo"],
									 "mat_pri"=>$value["codigo"],
									 "tej_princ"=>$value["tejido"],
									 "consumo"=>$value["cantidad"],
									 "precio_mp"=>$value["precio"],
									 "total_detalle"=>$value["total"]);
						/* 
						! revisar que esta llegando a datos
						*/
						
						/* var_dump("datos detalle", $datosD); */

					ModeloTarjetas::mdlGuardarDetallesTarjeta("detalles_tarjetajf",$datosD);
					
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
									window.location="tarjetas";}
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
									window.location="crear-tarjeta";}
							});
						</script>';
					}			

			}			

		
		}

	}

	/* 
	* EDITAR TARJETAS
	*/
	public function ctrEditarTarjetas(){

		if(isset($_POST["editarTarjeta"]) && 
		   isset($_POST["idArticuloTarjeta"]) && 
		   isset($_POST["listaMP"])){

			if($_POST["listaMP"] == ""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se cambio ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="index.php?ruta=editar-tarjeta&idTarjeta='.$_POST["idTarjetaE"].'";}
						});
					</script>';

			}else{

				/* 
				todo: traemos los datos del detalle tarjeta
				*/

				$detaMP=ModeloTarjetas::mdlMostraDetallesTarjetas("detalles_tarjetajf","articulo",$_POST["idArticuloTarjeta"]);

				/* 
				! ver que trae detaMP
				*/

				/* var_dump("detaMP", $detaMP); */

				/* 
				todo: cambiamos los id de la lista por los id de productos
				*/
				foreach($detaMP as $key=>$value){

					$infoMP=ControladorMateriaPrima::ctrMostrarMateriaPrima("Codpro",$value["mat_pri"]);

					$detaMP[$key]["mat_pri"]=$infoMP["Codpro"];

					/* 
					! ver que tiene detaMP
					*/

					/* var_dump("detaMP", $detaMP[$key]["mat_pri"]); */

				}

				if($_POST["listaMP"]==""){

					$listaMP=$detaMP;
					$validarCambio=false;

				}else{

					$listaMP=json_decode($_POST["listaMP"],true);
					$validarCambio=true;

				}

				/* 
				todo: editamos los cambios en la tabla TARJETAS
				*/

				$datos=array("usuario"=>$_POST["idUsuario"],
							"articulo"=>$_POST["idArticuloTarjeta"],
							"impuesto"=>$_POST["nuevoPrecioImpuesto"],
							"neto"=>$_POST["nuevoPrecioNeto"],
							"total"=>$_POST["totalTarjeta"],
							"lastUpdate"=>$_POST["fechaActual"]);
													

				$respuesta=ModeloTarjetas::mdlEditarTarjetas("tarjetasjf",$datos);
				
				if($respuesta=="ok"){

					/* 
					todo: eliminamos el detalle de las tarjetas
					*/
					
					$eliminarDeta=ModeloTarjetas::mdlEliminarDato("detalles_tarjetajf","articulo",$_POST["idArticuloTarjeta"]);

					if($eliminarDeta=="ok"){

						/* 
						todo: guardamos el nuevo detalle de la tarjeta
						*/

						foreach($listaMP as $key=>$value){

							$datosD=array("articulo"=>$_POST["idArticuloTarjeta"],
										"mat_pri"=>$value["codigo"],
										"tej_princ"=>$value["tejido"],
										"consumo"=>$value["cantidad"],
										"precio_mp"=>$value["precio"],
										"total_detalle"=>$value["total"]);

							/* 
							! revisar que esta llegando a datos
							*/
							
							/* var_dump("datos detalle", $datosD); */

							ModeloTarjetas::mdlGuardarDetallesTarjeta("detalles_tarjetajf",$datosD);

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
										window.location="tarjetas";}
								});
							</script>';
						}

					}else{
						# Mostramos una alerta suave
						echo '<script>
								swal({
									type: "error",
									title: "Error",
									text: "¡La información presento problemas al actualizar los Detalles. Por favor, comunicarse con el Administrador de la Base de Datos!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then((result)=>{
									if(result.value){
										window.location="tarjetas";}
								});
							</script>';
					}



				}else{
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="tarjetas";}
							});
						</script>';
					
				}

			}

	

		}
		
	} 	
	
	/* 
	* ELIMINAR LAS TARJETAS
	*/
	static public function ctrEliminarTarjeta($idTarjeta){

		/* 
		todo: traemos la informacion de la tarjeta
		*/

		$item="id";
		$infoTarjeta=ModeloTarjetas::mdlMostrarTarjetas("tarjetasjf",$item,$idTarjeta);

		/* 
		! veamos que trae infoTarjeta
		*/

		/* var_dump("infoTarjeta", $infoTarjeta); */

		/* 
		todo: actualizamos que el articulo ya no tiene tarjeta
		*/

		$tablaA="articulojf";
		$item1="tarjeta";
		$valor1="no";

		$valor=$infoTarjeta["articulo"];

		/* var_dump("valor", $valor); */
		/* var_dump("update ", $tablaA, " set ", $item1, " = ", $valor1, " where articulo=", $valor); */

		ModeloArticulos::mdlActualizarUnDato($tablaA,$item1,$valor1,$valor);

		/* 
		todo: eliminamos la tarjeta
		*/

		$respuesta=ModeloTarjetas::mdlEliminarTarjeta("tarjetasjf",$idTarjeta);

		if($respuesta == "ok"){

			/* 
			todo: eliminamos el detalle
			*/

			$respuesta2=ModeloTarjetas::mdlEliminarDato("detalles_tarjetajf","articulo",$infoTarjeta["articulo"]);

		}

		return $respuesta;		

	}
	
	/* 
	* TOTAL DE TARJETAS DE ARTICULOS ACTIVOS
	*/
	static public function ctrTarjetasActivas(){

        $tabla = "tarjetasjf";

        $respuesta = ModeloTarjetas::mdlTarjetasActivas($tabla);

        return $respuesta;

	}
	
	/* 
	* COPIAR TARJETAS
	*/	
	static public function ctrCopiarTarjetas(){

		if(isset($_POST["copiarTarjeta"])){

			/* 
			TODO: alerta si no cambiaron anda de la tarjeta
			*/
			
			if($_POST["listaMP"] == ""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se cambio ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="index.php?ruta=copiar-tarjeta&idTarjeta='.$_POST["tarjetaOrigen"].'";}
						});
					</script>';
			}else{

				/* 
				? trae lista luego de cambiar algun detalle
				*/

				$listaMP=json_decode($_POST["listaMP"],true);

				/* var_dump("listaMP", $listaMP); */

				/* 
				todo Actualizar que el articulo ya tiene tarjeta
				*/

				$tablaA = "articulojf";
				$item1 = "tarjeta";
				$valor1 = "si";
				$valor = $_POST["seleccionarArticulo"];
				
				ModeloArticulos::mdlActualizarUnDato($tablaA,$item1,$valor1,$valor);

				/* 
				todo GUARDAR CABECERA DE LA TARJETA
				*/

				$datos=array("codigo"=>$_POST["copiarTarjeta"],
				"articulo"=>$_POST["seleccionarArticulo"],
				"usuario"=>$_POST["idUsuario"],
				"impuesto"=>$_POST["nuevoPrecioImpuesto"],
				"neto"=>$_POST["nuevoPrecioNeto"],
				"total"=>$_POST["totalTarjeta"],
				"estado"=>"AC");

				/* var_dump("datos", $datos); */

				$respuesta=ModeloTarjetas::mdlGuardarTarjetas("tarjetasjf",$datos);

				/* var_dump("respuesta", $respuesta); */

				/* 
				todo GUARDAR DETALLE DE LA TARJETA
				*/
				if($respuesta == "ok"){

					foreach($listaMP as $key=>$value){

						$datosD=array("articulo"=>$_POST["seleccionarArticulo"],
						"mat_pri"=>$value["codigo"],
						"consumo"=>$value["cantidad"],
						"precio_mp"=>$value["precio"],
						"tej_princ"=>$value["tejido"],
						"total_detalle"=>$value["total"]);

						/* var_dump("datosD", $datosD); */

						ModeloTarjetas::mdlGuardarDetallesTarjeta("detalles_tarjetajf",$datosD);

						echo '<script>
						swal({
							type: "success",
							title: "Felicitaciones",
							text: "¡La información fue creada con éxito!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="tarjetas";}
						});
					</script>';

					}

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
								window.location="index.php?ruta=copiar-tarjeta&idTarjeta='.$_POST["tarjetaOrigen"].'";}
							});
						</script>';

				}


			}


		}

	}

}

