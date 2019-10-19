<?php

require_once "conexion.php";

class ModeloTarjetas{

	/* 
	* Método para mostrar las tarjetas
	*/
	static public function mdlMostrarTarjetas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT       t.id,
                                                                t.codigo,
                                                                t.articulo,
                                                                t.usuario,
                                                                u.nombre as nom_usu,
                                                                t.total,
                                                                t.estado AS estado_tarjeta,
                                                                t.fecha,
                                                                a.id as id_articulo,
                                                                a.articulo,
                                                                m.marca,
                                                                a.modelo,
                                                                a.nombre,
                                                                a.cod_color,
                                                                a.color,
                                                                a.cod_talla,
                                                                a.talla,
                                                                CONCAT(a.color,' - ',a.talla) AS packing,
                                                                a.estado AS estado_articulo 
                                                            FROM 
                                                                $tabla t
                                                                LEFT JOIN articulojf a 
                                                                    ON t.articulo = a.articulo
                                                                LEFT JOIN marcasjf m
                                                                    ON a.id_marca=m.id
                                                                LEFT JOIN usuariosjf u
                                                                    ON t.usuario=u.id  
                                                            ORDER BY t.codigo DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	/* 
	* Método para Mostrar los detalles de tarjetas
	*/
	static public function mdlMostraDetallesTarjetas($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/* 
	* Método para guardar las tarjetas
	*/
	static public function mdlGuardarTarjetas($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,articulo,usuario,impuesto,neto,total,estado) VALUES (:codigo,:articulo,:usuario,:impuesto,:neto,:total,:estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}
	
	/* 
	* Método para guardar detalle de las tarjetas
	*/
	static public function mdlGuardarDetallesTarjeta($tabla,$datos){

		$sql="INSERT INTO $tabla(articulo,mat_pri,consumo,precio_mp,total_detalle) VALUES (:articulo,:mat_pri,:consumo,:precio_mp,:total_detalle)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_INT);
		$stmt->bindParam(":mat_pri",$datos["mat_pri"],PDO::PARAM_STR);
		$stmt->bindParam(":consumo",$datos["consumo"],PDO::PARAM_INT);
		$stmt->bindParam(":precio_mp",$datos["precio_mp"],PDO::PARAM_STR);
		$stmt->bindParam(":total_detalle",$datos["total_detalle"],PDO::PARAM_STR);

		$stmt->execute();

		$stmt=null;
	}

    /* 
	* Método para pedir último Id de tarjeta
	*/	
	static public function mdlUltimoIdTarjeta($tabla){
		$sql="SELECT * FROM $tabla ORDER BY id DESC LIMIT 1";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;
	}

	/* 
	* Método para sacar el ultimo id de la tarjeta
	*/	
	static public function mdlUltimoCodigoTarjeta(){

		$sql="SELECT 
		MAX(t.codigo) AS ultimo_codigo
		FROM
		  tarjetasjf t";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;


	}
       
	/* 
	* Método para editar las tarjetas  
	*/
	static public function mdlEditarTarjetas($tabla,$datos){

		$sql="UPDATE $tabla SET impuesto=:impuesto,neto=:neto,total=:total WHERE articulo=:articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
	}
	
	/* 
	* Método para eliminar los detalles de la tarjeta
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
	* Método para eliminar la tarjeta
	*/
	static public function mdlEliminarTarjeta($tabla, $datos){

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