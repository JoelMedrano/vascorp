<?php

require_once "conexion.php";

class ModeloArticulos{

	/*=============================================
	MOSTRAR ARTICULOS
	=============================================*/

	static public function mdlMostrarArticulos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 	a.id,
															a.articulo,
															a.id_marca,
															m.marca,
															a.modelo,
															a.nombre,
															a.cod_color,
															a.color,
															a.cod_talla,
															a.talla,
															a.estado,
															a.stock,
															IFNULL(v.ult_mes, 0) AS ventas,
															a.tipo,
															a.imagen 
														FROM
															$tabla a 
															LEFT JOIN marcasjf m 
															ON a.id_marca = m.id 
															LEFT JOIN 
															(SELECT 
																m.articulo,
																SUM(m.cantidad)/3 AS ult_mes 
															FROM
																movimientosjf m 
															WHERE m.tipo IN ('S02', 'S03', 'S70') 
																AND YEAR(m.fecha) = '2019' 
																AND (
																MONTH(m.fecha) BETWEEN MONTH(NOW()) - 3 
																AND MONTH(NOW()) - 1
																) 
															GROUP BY m.articulo) v 
															ON a.articulo = v.articulo 
														ORDER BY a.articulo ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE ARTICULO
	=============================================*/
	static public function mdlIngresarArticulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (articulo, id_marca, modelo, nombre, cod_color, color, cod_talla, talla, tipo, imagen) VALUES (:articulo, :id_marca, :modelo, :nombre, :cod_color, :color, :cod_talla, :talla, :tipo, :imagen)");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_color", $datos["cod_color"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_talla", $datos["cod_talla"], PDO::PARAM_STR);
		$stmt->bindParam(":talla", $datos["talla"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	

	
	// Método para activar y desactivar un usuario
	static public function mdlActualizarArticulo($tabla,$item1,$valor1,$item2,$valor2){

		$sql="UPDATE $tabla SET $item1=:$item1 WHERE $item2=:$item2";
		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":".$item2,$valor2,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;
	}

	/*=============================================
	EDITAR ARTICULO
	=============================================*/
	static public function mdlEditarArticulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, imagen = :imagen WHERE articulo = :articulo");

		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	

	/*=============================================
	BORRAR ARTICULO
	=============================================*/

	static public function mdlEliminarArticulo($tabla, $datos){

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