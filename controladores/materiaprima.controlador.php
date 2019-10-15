<?php

class ControladorMateriaPrima{

	/*=============================================
	MOSTRAR MATERIA PRIMA
	=============================================*/

	static public function ctrMostrarMateriaPrima($item, $valor){

		$tabla = "producto";

		$respuesta = ModeloMateriaPrima::mdlMostrarMateriaPrima($tabla, $item, $valor);

		return $respuesta;

    }

	/*=============================================
		EDITAR MATERIA PRIMA
	=============================================*/

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
}