<?php
require_once "conexion.php";

class ModeloPedidos{

    /* 
    * MOSTRAR TEMPORAL CABECERA
    */
    static public function mdlMostrarTemporal($tabla, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo = $valor ORDER BY id ASC");

        $stmt -> execute();

        return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;

    }    
    
    /* 
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraDetallesTemporal($tabla, $valor){

		$sql="SELECT * FROM $tabla WHERE codigo=$valor ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}    

    /*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporal($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, cliente, vendedor) VALUES (:codigo, :cliente, :vendedor)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*
	* GUARDAR DETALLE DE TEMPORAL
	*/
	static public function mdlGuardarTemporalDetalle($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, articulo, cantidad, precio) VALUES (:codigo, :articulo, :cantidad, :precio)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
    }
    
    /*  
    * ELIMINAR ARTICULO REPETIDO
    */
	static public function mdlEliminarDetalleTemporal($tabla, $eliminar){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo AND articulo = :articulo");

        $stmt -> bindParam(":codigo", $eliminar["codigo"], PDO::PARAM_INT);
        $stmt -> bindParam(":articulo", $eliminar["articulo"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }
    
    /* 
    * ACTUALIZAR TALONARIO +1
    */
	static public function mdlActualizarTalonario(){

		$sql="UPDATE talonariosjf SET pedido = pedido+1";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		$stmt=null;

	}    


}