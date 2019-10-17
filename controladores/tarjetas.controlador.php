<?php

class ControladorTarjetas{

	/*=============================================
	MOSTRAR TARJETAS
	=============================================*/

	static public function ctrMostrarTarjetas($item, $valor){

		$tabla = "tarjetasjf";

        $respuesta = ModeloTarjetas::mdlMostrarTarjetas($tabla, $item, $valor);
        
        /* var_dump("respuesta", $respuesta); */

		return $respuesta;

	}

	/*=============================================
	CREAR TARJETA
	=============================================*/

	static public function ctrCrearTarjeta(){
		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevaTarjeta"]) && 
		   isset($_POST["seleccionarArticulo"]) && 
		   isset($_POST["listaMP"])){

			var_dump("prueba",$_POST["listaMP"] );
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


			
			}			

		
		}

	}


}