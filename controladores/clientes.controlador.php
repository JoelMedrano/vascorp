<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["codigoCliente"])){
			
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nombre"])){

			   $tabla = "clientesjf";

			   $datos = array("codigoCliente"=>$_POST["codigoCliente"],
						   "nombre"=>$_POST["nombre"],
						   "tipo_documento"=>$_POST["tipo_documento"],
						   "documento"=>$_POST["documento"],
						   "tipo_persona"=>$_POST["tipo_persona"],
						   "ape_paterno"=>$_POST["ape_paterno"],
						   "ape_materno"=>$_POST["ape_materno"],
						   "nombres"=>$_POST["nombres"],
						   "direccion"=>$_POST["direccion"],
						   "ubigeo"=>$_POST["ubigeo"],
						   "telefono"=>$_POST["telefono"],
						   "telefono2"=>$_POST["telefono2"],
						   "email"=>$_POST["email"],
						   "contacto"=>$_POST["contacto"],
						   "vendedor"=>$_POST["vendedor"],
						   "grupo"=>$_POST["grupo"],
						   "lista_precios"=>$_POST["lista_precios"]);
			#var_dump("datos", $datos);

			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La marca ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}



			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

				</script>';



			}


		}

    }   
    
	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientesjf";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCodigoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarNombre"])){

			   	$tabla = "clientesjf";

				$datos = array(	"codigoCliente"=>$_POST["editarCodigoCliente"],
								"nombre"=>$_POST["editarNombre"],
								"tipo_documento"=>$_POST["editarTipo_documento"],
								"documento"=>$_POST["editarDocumento"],
								"tipo_persona"=>$_POST["editarTipo_persona"],
								"ape_paterno"=>$_POST["editarApe_paterno"],
								"ape_materno"=>$_POST["editarApe_materno"],
								"nombres"=>$_POST["editarNombres"],
								"direccion"=>$_POST["editarDireccion"],
								"ubigeo"=>$_POST["editarUbigeo"],
								"telefono"=>$_POST["editarTelefono"],
								"telefono2"=>$_POST["editarTelefono2"],
								"email"=>$_POST["editarEmail"],
								"contacto"=>$_POST["editarContacto"],
								"vendedor"=>$_POST["editarVendedor"],
								"grupo"=>$_POST["editarGrupo"],
								"lista_precios"=>$_POST["editarLista_precios"]);
				#var_dump("datos", $datos);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
				#$respuesta = "false";

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}	

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientesjf";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}
	
	/* 
	* MOSTRAR UBIGEOS
	*/
	static public function ctrMostrarUbigeos(){

		$tabla = "ubigeo";

		$respuesta = ModeloClientes::mdlMostrarUbigeos($tabla);

		return $respuesta;

    }

    

}    