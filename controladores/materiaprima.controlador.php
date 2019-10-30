<?php

class ControladorMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function ctrMostrarMateriaPrima($item, $valor){

		$tabla = "producto";

		$respuesta = ModeloMateriaPrima::mdlMostrarMateriaPrima($tabla, $item, $valor);

		return $respuesta;

    }

	/* 
	*EDITAR NOMBRE DE MATERIA PRIMA
	*/
	static public function ctrEditarMateriaPrima(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				$tabla = "producto";

				$datos = array("descripcion" => $_POST["editarDescripcion"],
							"codpro" => $_POST["editarCodigo"]);

				$respuesta = ModeloMateriaPrima::mdlEditarMateriaPrima($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "La materia prima ha sido editada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "materiaprima";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡La Materia Prima no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "materiaprima";

							}
						})

				</script>';
			}
		}

	}
	
	/* 
	* Método para llenar datos al combo de materia prima
	*/
	static public function ctrTejidoPrincipal(){

		$tabla = "producto";

		$respuesta = ModeloMateriaPrima::mdlTejidoPrincipal($tabla);

		return $respuesta;

	}

	/* 
	* VISUALIZAR DATOS DE LA MATERIA PRIMA CABECERA
	*/
	static public function ctrVisualizarMateriaPrima($item, $valor){

		$tabla = "producto";

        $respuesta = ModeloMateriaPrima::mdlVisualizarMateriaPrima($tabla, $item, $valor);
        
        /* var_dump("respuesta", $respuesta); */

		return $respuesta;

	}

	/* 
	* VISUALIZAR DATOS DE LA MATERIA PRIMA DETALLE
	*/
	static public function ctrVisualizarMateriaPrimaDetalle($item, $valor){

		$tabla = "detalles_tarjetajf";

        $respuesta = ModeloMateriaPrima::mdlVisualizarMateriaPrimaDetalle($tabla, $item, $valor);
        
        /* var_dump("respuesta", $respuesta); */

		return $respuesta;

	}
	
	/* 
	*EDITAR COSTO DE MATERIA PRIMA
	*/
	static public function ctrEditarMateriaPrimaCosto(){

		if(isset($_POST["codigo"])){


			$tabla = "producto";

			$datos = array("codpro" => $_POST["codigo"],
						"cospro" => $_POST["costo"]);

			$respuesta = ModeloMateriaPrima::mdlEditarMateriaPrimaCosto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						type: "success",
						title: "La materia prima ha sido editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
									if (result.value) {

									window.location = "materiaprima";

									}
								})

					</script>';

			}else{

				echo'<script>

				swal({
					type: "danger",
					title: "La materia prima no ha sido editada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "materiaprima";

								}
							})

				</script>';


			}

		}

	}	

}