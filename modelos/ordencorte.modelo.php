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
	* Método para guardar detalle de las ordenes de corte
	*/
	static public function mdlGuardarDetallesOrdenCorte($tabla,$datos){

		$sql="INSERT INTO $tabla (ordencorte, articulo, cantidad) 
		VALUES
		  (:ordencorte, :articulo, :cantidad)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":ordencorte",$datos["ordencorte"],PDO::PARAM_INT);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;

	}	
	


}