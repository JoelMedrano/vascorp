<?php

class controladorArticulos{

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function ctrMostrarArticulos($item, $valor){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

		return $respuesta;

	}

	/* 
	* MOSTRAR SIN TARJETA
	*/
	static public function ctrMostrarSinTarjeta($item, $valor){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlMostrarSinTarjeta($tabla, $item, $valor);

		return $respuesta;

	}	

	/* 
	* MOSTRAR CANTIDAD DE PEDIDOS
	*/
	static public function ctrArticulosPedidos(){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlArticulosPedidos($tabla);

		return $respuesta;

	}	

	/* 
	* MOSTRAR CANTIDAD DE FALTANTES
	*/
	static public function ctrArticulosFaltantes(){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlArticulosFaltantes($tabla);

		return $respuesta;

	}	

	/* 
	* CREAR ARTICULO
	*/
	static public function ctrCrearArticulo(){

        if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "vistas/img/articulos/default/anonymous.png";

				if(isset($_FILES["nuevaImagen"]["tmp_name"])){

				 list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

				 $nuevoAncho = 500;
				 $nuevoAlto = 500;

				 /*=============================================
				 CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				 =============================================*/

				 $directorio = "vistas/img/articulos/".$_POST["nuevoCodigo"];

				 mkdir($directorio, 0755);

				 /*=============================================
				 DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				 =============================================*/

				 if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

					 /*=============================================
					 GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					 =============================================*/

					 $aleatorio = mt_rand(100,999);

					 $ruta = "vistas/img/articulos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

					 $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

					 $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					 imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					 imagejpeg($destino, $ruta);

				 }

				 if($_FILES["nuevaImagen"]["type"] == "image/png"){

					 /*=============================================
					 GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					 =============================================*/

					 $aleatorio = mt_rand(100,999);

					 $ruta = "vistas/img/articulos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

					 $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

					 $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					 imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					 imagepng($destino, $ruta);

				 }

			 }				

                $tabla = "articulojf";

				$datos = array("id_marca" => $_POST["nuevaMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "cod_color" => $_POST["nuevoColor"],
							   "cod_talla" => $_POST["nuevaTalla"],
							   "tipo" => $_POST["nuevoTipo"],
							   "articulo" => $_POST["nuevoCodigo"],
							   "color" => $_POST["color"],
							   "talla" => $_POST["talla"],
							   "imagen" => $ruta);

                $respuesta = ModeloArticulos::mdlIngresarArticulo($tabla, $datos);
                
				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El articulo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "articulos";

										}
									})

						</script>';

				}                


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El articulo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "articulos";

							}
						})

			  	</script>';
			}
		}


	}

	/* 
	* EDITAR ARTICULO
	*/
	static public function ctrEditarArticulo(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["imagenActual"];

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/articulos/".$_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/articulos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/articulos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/articulos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "articulojf";

				$datos = array("descripcion" => $_POST["editarDescripcion"],
							"articulo" => $_POST["editarCodigo"],
							"imagen" => $ruta);

				$respuesta = ModeloArticulos::mdlEditarArticulo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "El articulo ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "articulos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡El articulo no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "articulos";

							}
						})

				</script>';
			}
		}

	}	

	/* 
	* BORRAR ARTICULO
	*/
	static public function ctrEliminarArticulo(){

		if(isset($_GET["idArticulo"])){

			$tabla ="articulojf";
			$datos = $_GET["idArticulo"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/articulos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/articulos/'.$_GET["articulo"]);

			}

			$respuesta = ModeloArticulos::mdlEliminarArticulo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El articulo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "articulos";

								}
							})

				</script>';

			}		
		}


	}	

	/* 
	* SACAR CONFIGURACION DE URGENCIAS
	*/
	static public function ctrConfiguracion(){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlConfiguracion($tabla);

		return $respuesta;

	}

    /* 
    * CONFIGURAR PORCENTAJE SALTA A CREAR OC
    */
    static public function ctrConfigurarUrgencia(){

        if(isset($_POST["urgencia"])){

            $tabla = "articulojf";

			$dato = $_POST["urgencia"];
			
			var_dump("dato", $dato);

			$respuesta = ModeloArticulos::mdlConfigurarUrgencia($tabla, $dato);
			
			if ($respuesta == "ok"){

				echo	'<script>

							swal({
								type: "success",
								title: "El porcentaje de urgencias ha sido configurado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
											if (result.value) {

											window.location = "crear-ordencorte";

											}
										})

						</script>';

			}

        }

	}

    /* 
    * CONFIGURAR PORCENTAJE SALTA A CREAR OC
    */
    static public function ctrConfigurarUrgenciaLista(){

        if(isset($_POST["urgencia"])){

            $tabla = "articulojf";

			$dato = $_POST["urgencia"];
			
			var_dump("dato", $dato);

			$respuesta = ModeloArticulos::mdlConfigurarUrgencia($tabla, $dato);
			
			if ($respuesta == "ok"){

				echo	'<script>

							swal({
								type: "success",
								title: "El porcentaje de urgencias ha sido configurado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
											if (result.value) {

											window.location = "urgencias";

											}
										})

						</script>';

			}

        }

	}	
	
	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/	
	static public function ctrMostrarArticulosUrgencia(){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlMostrarArticulosUrgencia($tabla);

		return $respuesta;
		
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/	
	static public function ctrMostrarUrgencia($valor){

		$tabla = "articulojf";
		
		$respuesta = ModeloArticulos::mdlMostrarUrgencia($tabla,$valor);

		return $respuesta;
		
	}	


	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA - DETALLE
	*/	
	static public function ctrMostrarUrgenciaDetalle($valor){

		$tabla = "detalles_tarjetajf";
		
		$respuesta = ModeloArticulos::mdlVisualizarUrgenciasDetalle($tabla,$valor);

		return $respuesta;
		
	}		

}

