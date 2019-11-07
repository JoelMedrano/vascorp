<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventasjf";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	// Método para Mostrar los detalles de ventas
	static public function ctrMostrarDetallesVentas($item,$valor){

		$tabla="detalles_ventajf";

		$respuesta=ModeloVentas::mdlMostraDetallesVentas($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevaVenta"]) && 
		   isset($_POST["seleccionarCliente"]) && 
		   isset($_POST["listaProductos"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listaProductos"]==""){
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
								window.location="crear-venta";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaProductos=json_decode($_POST["listaProductos"],true);
				
				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					$tabla="productosjf";
					$item="id";
					$valor=$value["id"];

					$comprasTotales=$comprasTotales+$value["cantidad"];
					$respuestaProducto=ModeloProductos::mdlMostrarProductos($tabla,$item,$valor);


					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$respuestaProducto["ventas"]+$value["cantidad"];
					ModeloVentas::mdlActualizarUnDato($tabla,$item1,$valor1,$valor);


					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["stock"];
					ModeloVentas::mdlActualizarUnDato($tabla,$item2,$valor2,$valor);

				}

				
				# Traemos la información del cliente
				$tabla="clientesjf";
				$item="id";
				$valor=$_POST["seleccionarCliente"];
				$cliente=ModeloClientes::mdlMostrarCliente($tabla,$item,$valor);

				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$cliente["compras"]+$comprasTotales;
				ModeloVentas::mdlActualizarUnDato($tabla,$item2,$valor2,$valor);

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$item3="ultima_compra";
				$valor3=date('Y/m/d h:i:s');
				ModeloVentas::mdlActualizarUnDato($tabla,$item3,$valor3,$valor);	
				
				/* ==============================================
				GUARDAMOS LA VENTA
				============================================== */

				$datos=array("codigo"=>$_POST["nuevaVenta"],
							 "id_cliente"=>$_POST["seleccionarCliente"],
							 "id_vendedor"=>$_POST["idVendedor"],
							 "impuesto"=>$_POST["nuevoPrecioImpuesto"],
							 "neto"=>$_POST["nuevoPrecioNeto"],
							 "total"=>$_POST["totalVenta"],
							 "metodo_pago"=>$_POST["listaMetodoPago"],
							 "estado"=>"AC");

				$respuesta=ModeloVentas::mdlGuardarVentas("ventasjf",$datos);

				if($respuesta=="ok"){

					$ultimoId=ModeloVentas::mdlUltimoId("ventasjf",
														$_POST["seleccionarCliente"],
														$_POST["idVendedor"]);

					foreach($listaProductos as $key=>$value){

						$datos=array("id_venta"=>$ultimoId[0]["id"],
									 "producto"=>$value["codigo"],
									 "cantidad"=>$value["cantidad"],
									 "precio"=>$value["precio"],
									 "total_detalle"=>$value["total"]);

					ModeloVentas::mdlGuardarDetallesVenta("detalles_ventajf",$datos);
					
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
									window.location="ventas";}
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
									window.location="crear-venta";}
							});
						</script>';
					}				
			}			
		}

	}	

	// Método para Editar las ventas
	public function ctrEditarVentas(){

		if(isset($_POST["editarVenta"]) && isset($_POST["idClienteVenta"]) && isset($_POST["listaProductos"])){

			# Formateamos la tabla de Productos y de Clientes
			# Traemos los detalles asociados a la venta a editar
		
			$detaProductos=ModeloVentas::mdlMostraDetallesVentas("detalles_ventajf","id_venta",$_POST["editarVenta"]);

			# Cambiamos los id de la lista por los id de los Productos
			foreach($detaProductos as $key=>$value){

				$infoPro=ControladorProductos::ctrMostrarProductos("codigo",$value["producto"]);
				$detaProductos[$key]["id"]=$infoPro["id"];
			
			}	

			if($_POST["listaProductos"]==""){

				$listaProductos=$detaProductos;
				$validarCambio=false;

			}else{

				$listaProductos=json_decode($_POST["listaProductos"],true);
				$validarCambio=true;

			}
			
			if($validarCambio){

				# Traemos la información del cliente
				$itemCliente="id";
				$valorCliente=$_POST["idClienteVenta"];

				$cliente=ModeloClientes::mdlMostrarCliente("clientesjf",$itemCliente,$valorCliente);

				$comprasTotales=$cliente["compras"];

				foreach($detaProductos as $key=>$value){

					# Traemos los productos por ID en cada interacción
					$valor=$value["id"];

					$infoProducto=ModeloProductos::mdlMostrarProductos("productosjf","id",$valor);

					# Realizamos la resta de compras totales
					$comprasTotales=$comprasTotales-$value["cantidad"];

					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$infoProducto["ventas"]-$value["cantidad"];

					ModeloVentas::mdlActualizarUnDato("productosjf",$item1,$valor1,$valor);

					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["cantidad"]+$infoProducto["stock"];
					ModeloVentas::mdlActualizarUnDato("productosjf",$item2,$valor2,$valor);

				}
				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$comprasTotales;
				ModeloVentas::mdlActualizarUnDato("clientesjf",$item2,$valor2,$_POST["idClienteVenta"]);

				# Actualizamos los datos con lo que viene en las cajas
				# Modificamos la información de los productos comprados en un array

				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					# Traemos los productos por ID en cada interacción
					$valor=$value["id"];

					$respuestaProducto=ModeloProductos::mdlMostrarProductos("productosjf","id",$valor);

					# Realizamos la suma de compras totales
					$comprasTotales=$comprasTotales+$value["cantidad"];

					# Actualizamos las ventas en la tabla productos
					$item1="ventas";
					$valor1=$respuestaProducto["ventas"]+$value["cantidad"];

					ModeloVentas::mdlActualizarUnDato("productosjf",$item1,$valor1,$valor);

					# Actualizamos el stock en la tabla productos
					$item2="stock";
					$valor2=$value["stock"];
					ModeloVentas::mdlActualizarUnDato("productosjf",$item2,$valor2,$valor);
				}

				# Traemos la información del cliente
				$item="id";
				$valor=$_POST["idClienteVenta"];

				$cliente=ModeloClientes::mdlMostrarCliente("clientesjf",$item,$valor);

				# Actualizamos el compras en la tabla Clientes
				$item2="compras";
				$valor2=$cliente["compras"]+$comprasTotales;

				ModeloVentas::mdlActualizarUnDato("clientesjf",$item2,$valor2,$_POST["idClienteVenta"]);

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$item3="ultima_compra";
				$valor3=date('Y/m/d h:i:s');

				ModeloVentas::mdlActualizarUnDato("clientesjf",$item3,$valor3,$_POST["idClienteVenta"]);

			}
			
			/* ==============================================
			EDITAMOS LOS CAMBIOS DE LA VENTA listaMetodoPago
			============================================== */
			$datos=array("codigo"=>$_POST["editarVenta"],
						 "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						 "neto"=>$_POST["nuevoPrecioNeto"],
						 "total"=>$_POST["totalVenta"],
						 "metodo_pago"=>$_POST["listaMetodoPago"]);
						 						

			$respuesta=ModeloVentas::mdlEditarVentas("ventasjf",$datos);

			/* var_dump($_POST["listaMetodoPago"]); */

			/* var_dump("datos", $datos); */

			if($respuesta=="ok"){

				# Eliminamos los detalles de la venta
				$eliminarDeta=ModeloVentas::mdlEliminarDato("detalles_ventajf","id_venta",$_POST["editarVenta"]);

				if($eliminarDeta=="ok"){

					# Guardamos los nuevos detalles de la venta
					foreach($listaProductos as $key=>$value){

						$datos=array("id_venta"=>$_POST["editarVenta"],
									 "producto"=>$value["codigo"],
									 "cantidad"=>$value["cantidad"],
									 "precio"=>$value["precio"],
									 "total_detalle"=>$value["total"]);

						ModeloVentas::mdlGuardarDetallesVenta("detalles_ventaJF",$datos);
					
					
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
									window.location="ventas";}
							});
						</script>';
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
									window.location="ventas";}
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
								window.location="ventas";}
						});
					</script>';
				
			}			



		}		
	} 


	// Método para Eliminar las ventas
	static public function ctrEliminarVenta($idVenta){

		# Nos traemos la información de la Venta
		$item="id";
		$infoVenta=ModeloVentas::mdlMostrarVentas("ventasjf",$item,$idVenta);

		/* var_dump("infoventa", $infoVenta); */

		# ACTUALIZAMOS ÚLTIMA FECHA DE COMPRA
		# Traemos todas las ventas
		$todasVentas=ModeloVentas::mdlMostrarVentas("ventasjf",null,null);

		$arrayFechas=array();

		foreach($todasVentas as $key=>$value){	

			# Traemos todas las fechas del cliente al que se le borra la venta
			if($value["id_cliente"]==$infoVenta["id_cliente"]){

				# Almacenamos las fechas en el array
				array_push($arrayFechas,$value["fecha"]);
			
			}
		}

		# Válidamos que el array sea mayor a 1
		if(count($arrayFechas)>1){

			# Validamos que la fecha de la venta que se va a borrar sea la penúltima fecha
			if($infoVenta["fecha"]>$arrayFechas[count($arrayFechas)-2]){

				$item="ultima_compra";
				$valor=$arrayFechas[count($arrayFechas)-2];
				ModeloVentas::mdlActualizarUnDato("clientesjf",$item,$valor,$infoVenta["id_cliente"]);
			
			}
			# Si es la última
			else{
				$item="ultima_compra";
				$valor=$arrayFechas[count($arrayFechas)-1];
				ModeloVentas::mdlActualizarUnDato("clientesjf",$item,$valor,$infoVenta["id_cliente"]);}
		}else{
			$item="ultima_compra";
			$valor="0000-00-00 00:00:00";
			ModeloVentas::mdlActualizarUnDato("clientesjf",$item,$valor,$infoVenta["id_cliente"]);

		}

		# Formateamos la tabla de Productos y de Clientes

		$detalleProductos=ModeloVentas::mdlMostraDetallesVentas("detalles_ventajf","id_venta",$idVenta);
		/* var_dump("detalleProductos", $detalleProductos); */		
		
/* 		$productosEliminados=json_decode($detalleProductos["id"],true);
		var_dump("productosEliminados", $productosEliminados); */

		# Traemos la información del cliente
		$itemCliente="id";
		$valorCliente=$infoVenta["id_cliente"];

		$cliente=ModeloClientes::mdlMostrarCliente("clientesjf",$itemCliente,$valorCliente);

		$comprasTotales=$cliente["compras"];

		/* var_dump("productosEliminados", $productosEliminados); */

		foreach($detalleProductos as $key=>$value){

			# Traemos los productos por ID en cada interacción
			$item="codigo";
			$valor=$value["producto"];
			

			$infoProducto=ModeloProductos::mdlMostrarProductos("productosjf",$item,$valor);


			# Realizamos la resta de compras totales
			$comprasTotales=$comprasTotales-$value["cantidad"];

			# Actualizamos las ventas en la tabla productos
			$item1="ventas";
			$valor1=$infoProducto["ventas"]-$value["cantidad"];

			ModeloVentas::mdlActualizarUnDatoProducto("productosjf",$item1,$valor1,$valor);

			/* var_dump("ventas: ", $infoProducto["ventas"]," cantidad",$value["cantidad"]); */

			/* var_dump("formula","update productosjf set",$item1,"=",$valor1,"codigo=",$valor); */

			# Actualizamos el stock en la tabla productos
			$item2="stock";
			$valor2=$value["cantidad"]+$infoProducto["stock"];

			ModeloVentas::mdlActualizarUnDatoProducto("productosjf",$item2,$valor2,$valor);
		}
		# Actualizamos el compras en la tabla Clientes
		$item2="compras";
		$valor2=$comprasTotales;
		ModeloVentas::mdlActualizarUnDato("clientesjf",$item2,$valor2,$valorCliente);

		/* ==============================================
		ELIMINAMOS LA VENTA
		============================================== */
		$respuesta=ModeloVentas::mdlEliminarVenta("ventasjf",$idVenta);

		if($respuesta == "ok"){

			#eliminamos el detalla

			$respuesta2=ModeloVentas::mdlEliminarDato("detalles_ventajf","id_venta",$idVenta);

		}

		return $respuesta;


	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventasjf";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventasjf";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}	

  
}