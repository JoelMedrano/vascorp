<?php
   
   require_once "conexion.php";

class ModeloOrdenCorte{

	/* 
	* Método para mostrar los datos de las ordenes de corte
	*/
	static public function mdlMostarOrdenCorte($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
															oc.codigo,
															oc.usuario,
															u.nombre,
															oc.total,
															oc.saldo,
															oc.configuracion,
															oc.estado,
															DATE(oc.fecha) AS fecha 
														FROM
															ordencortejf oc 
															LEFT JOIN usuariosjf u 
																ON oc.usuario = u.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;		


	}

  	/* 
	* Método para sacar el ultimo id de la tarjeta
	*/	
	static public function mdlUltimoCodigoOC($tabla){

		$sql="SELECT 
                        MAX(oc.codigo) AS ultimo_codigo 
                    FROM
                        $tabla oc";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;


	}
	
	/* 
	* Método para pedir último Id de orden de corte
	*/
	static public function mdlUltimoId(){

		$sql="SELECT MAX(codigo) AS ult_codigo
					FROM
						ordencortejf";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;
	}	
	
	/* 
	* Guardar cabecera de ORDENES DE CORTE
	*/
	static public function mdlGuardarOrdenCorte($tabla,$datos){

		$sql="INSERT INTO $tabla (
											codigo,
											usuario,
											total,
											saldo,
											configuracion,
											estado
										) 
										VALUES
											(
											:codigo,
											:usuario,
											:total,
											:saldo,
											:configuracion,
											:estado
											)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_INT);
		$stmt->bindParam(":saldo",$datos["saldo"],PDO::PARAM_STR);
		$stmt->bindParam(":configuracion",$datos["configuracion"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	/* 
	* Guardar detalle de las ordenes de corte
	*/
	static public function mdlGuardarDetallesOrdenCorte($tabla,$datos){

		$sql="INSERT INTO $tabla (ordencorte, articulo, cantidad, saldo) 
		VALUES
		  (:ordencorte, :articulo, :cantidad, :saldo)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":ordencorte",$datos["ordencorte"],PDO::PARAM_INT);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":saldo",$datos["saldo"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

	}	
	
	/* 
	* Método para Mostrar los detalles de orden de corte
	*/
	static public function mdlMostraDetallesOrdenCorte($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* Método para editar las ventas
	*/
	static public function mdlEditarOrdenCorte($tabla,$datos){

		$sql="UPDATE $tabla SET usuario=:usuario, total=:total, saldo=:saldo, lastUpdate=:lastUpdate WHERE codigo=:codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":saldo",$datos["saldo"],PDO::PARAM_STR);
		$stmt->bindParam(":lastUpdate",$datos["lastUpdate"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
		
	}

	/* 
	* Método para eliminar los detalles de la orden de corte
	*/
	static public function mdlEliminarDato($tabla,$item,$valor){

		$sql="DELETE FROM $tabla WHERE $item=:$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;
	}
	
	/* 
	* Método para eliminar la orden de corte
	*/
	static public function mdlEliminarOrdenCorte($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = $valor");

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	/* 
	* Método para vizualizar cabecera orden de corte
	*/
	static public function mdlVisualizaOrdenCorte($tabla, $item, $valor){

		$sql="SELECT 
					oc.id,
					oc.codigo,
					oc.usuario,
					u.nombre,
					oc.configuracion,
					oc.total,
					oc.saldo,
					oc.estado,
					DATE(oc.fecha) AS fecha 
				FROM
					$tabla oc 
					LEFT JOIN usuariosjf u 
					ON oc.usuario = u.id 
				WHERE oc.$item = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}
	
	/* 
	* Método para vizualizar detalle de la orden de corte
	*/
	static public function mdlVisualizarOrdenCorteDetalle($tabla, $item, $valor){

		$sql="SELECT 
						doc.ordencorte,
						a.modelo,
						a.nombre,
						a.color,
						SUM(
						CASE
							WHEN a.cod_talla = '1' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t1,
						SUM(
						CASE
							WHEN a.cod_talla = '2' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t2,
						SUM(
						CASE
							WHEN a.cod_talla = '3' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t3,
						SUM(
						CASE
							WHEN a.cod_talla = '4' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t4,
						SUM(
						CASE
							WHEN a.cod_talla = '5' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t5,
						SUM(
						CASE
							WHEN a.cod_talla = '6' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t6,
						SUM(
						CASE
							WHEN a.cod_talla = '7' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t7,
						SUM(
						CASE
							WHEN a.cod_talla = '8' 
							THEN doc.saldo 
							ELSE 0 
						END
						) AS t8,
						SUM(doc.saldo) AS subtotal 
					FROM
						$tabla doc 
						LEFT JOIN articulojf a 
						ON doc.articulo = a.articulo 
					WHERE doc.$item = $valor
					GROUP BY doc.ordencorte,
						a.modelo,
						a.nombre,
						a.color";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	



}