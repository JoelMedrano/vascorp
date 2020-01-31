<?php

require_once "conexion.php";

class ModeloColores{

	/*=============================================
	CREAR COLOR
	=============================================*/

	static public function mdlIngresarColor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_color, nom_color) VALUES (:cod_color, :nom_color)");

		$stmt->bindParam(":cod_color", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nom_color", $datos["color"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function mdlMostrarColores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR COLOR
	=============================================*/

	static public function mdlEditarColor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cod_color = :cod_color, nom_color = :nom_color WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_color", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nom_color", $datos["color"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR COLOR
	=============================================*/

	static public function mdlEliminarColor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

}