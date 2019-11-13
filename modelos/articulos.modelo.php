<?php

require_once "conexion.php";

class ModeloArticulos
{

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function mdlMostrarArticulos($tabla, $item, $valor){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT *, CONCAT(modelo,' - ',nombre,' - ',color,' - ',talla) AS packing FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
															a.id,
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
															a.urgencia,
															ROUND(
															(
																IFNULL(v.ult_mes, 0) * a.urgencia / 100
															),
															0
															) AS configuracion,
															a.tipo,
															a.imagen 
														FROM
															articulojf a 
															LEFT JOIN marcasjf m 
															ON a.id_marca = m.id 
															LEFT JOIN 
															(SELECT 
																m.articulo,
																SUM(m.cantidad) AS ult_mes 
															FROM
																movimientosjf m 
															WHERE m.tipo IN ('S02', 'S03', 'S70') 
																AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
															GROUP BY m.articulo) v 
															ON a.articulo = v.articulo 
														ORDER BY a.articulo ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR CANTIDAD DE PEDIDOS
	*/
	static public function mdlArticulosPedidos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT 
														SUM(a.pedidos) AS pedidos 
													FROM
														$tabla a
														WHERE a.estado NOT IN ('descontinuado','campañad')");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR CANTIDAD DE FALTANTES
	*/
	static public function mdlArticulosFaltantes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT
														SUM(a.stock - a.pedidos) * - 1 AS faltantes 
													FROM
														articulojf a 
													WHERE a.stock < a.pedidos 
														AND a.estado NOT IN ('descontinuado', 'campañad')");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR ARTICULOS PENDIENTES DE TARJETAS
	*/
	static public function mdlMostrarSinTarjeta($tabla, $item, $valor){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 	a.id,
															a.articulo,
															CONCAT(
																a.modelo,
																' - ',
																a.nombre,
																' - ',
																a.color,
																' - ',
																a.talla
															) AS packing 
														FROM
															$tabla a 
															WHERE a.tarjeta = 'no' 
  															AND a.estado = 'activo'");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* REGISTRO DE ARTICULO
	*/
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

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* Método para activar y desactivar un usuario
	*/
	static public function mdlActualizarArticulo($tabla, $item1, $valor1, $item2, $valor2){

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE $item2=:$item2";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	/* 
	* EDITAR ARTICULO
	*/
	static public function mdlEditarArticulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, imagen = :imagen WHERE articulo = :articulo");

		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* BORRAR ARTICULO
	*/
	static public function mdlEliminarArticulo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/* 
	* Método para actualizar un dato CON EL articulo
	*/
	static public function mdlActualizarUnDato($tabla, $item1, $valor1, $valor2){

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE articulo=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* METODO PARA VER LA CONFIGURACION DE LAS URGENCIAS
	*/
	static public function mdlConfiguracion($tabla){

		$sql = "SELECT DISTINCT 
								urgencia 
							FROM
								$tabla";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/* 
	* CONFIGURAR PORCENTAJE DE URGENCIAS
	*/
	static public function mdlConfigurarUrgencia($tabla, $dato){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET urgencia = $dato");

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/
	static public function mdlMostrarArticulosUrgencia($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT 
														a.articulo,
														m.marca,
														a.modelo,
														a.nombre,
														a.color,
														a.talla,
														a.stock,
														a.pedidos,
														(a.stock - a.pedidos) AS stockB,
														a.ord_corte,
														a.alm_corte,
														a.taller,
														IFNULL(v.ult_mes, 0) AS ventas,
														a.urgencia,
														ROUND(
														(
															IFNULL(v.ult_mes, 0) * a.urgencia / 100
														),
														0
														) AS configuracion,
														a.tipo 
													FROM
														$tabla a 
														LEFT JOIN marcasjf m 
														ON a.id_marca = m.id 
														LEFT JOIN 
														(SELECT 
															m.articulo,
															SUM(m.cantidad) AS ult_mes 
														FROM
															movimientosjf m 
														WHERE m.tipo IN ('S02', 'S03', 'S70') 
															AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
														GROUP BY m.articulo) v 
														ON a.articulo = v.articulo 
													WHERE a.estado = 'CAMPAÑAD' 
														AND a.id_marca NOT IN ('4', '5', '6') 
													ORDER BY a.articulo ASC");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgencia($tabla, $valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
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
															a.urgencia,
															ROUND(
															(
																IFNULL(v.ult_mes, 0) * a.urgencia / 100
															),
															0
															) AS configuracion,
															CASE
															WHEN a.stock < 0 
															THEN 0 
															ELSE a.stock 
															END AS stock,
															(a.stock - a.pedidos) AS stockB,
															a.pedidos,
															a.tipo,
															a.taller,
															a.alm_corte,
															a.ord_corte,
															a.proyeccion,
															IFNULL(p.prod, 0) AS prod,
															IFNULL(
															ROUND(
																(IFNULL(p.prod, 0) / a.proyeccion) * 100,
																2
															),
															0
															) AS avance,
															IFNULL(v.ult_mes, 0) AS ult_mes 
														FROM
															$tabla a 
															LEFT JOIN marcasjf m 
															ON a.id_marca = m.id 
															LEFT JOIN 
															(SELECT 
																m.articulo,
																SUM(m.cantidad) AS prod 
															FROM
																movimientosjf m 
															WHERE YEAR(m.fecha) = '2019' 
																AND MONTH(m.fecha) >= 7 
																AND tipo = 'E20' 
															GROUP BY m.articulo) AS p 
															ON a.articulo = p.articulo 
															LEFT JOIN 
															(SELECT 
																m.articulo,
																SUM(m.cantidad) AS ult_mes 
															FROM
																movimientosjf m 
															WHERE m.tipo IN ('S02', 'S03', 'S70') 
																AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
															GROUP BY m.articulo) AS v 
															ON a.articulo = v.articulo 
														WHERE ROUND(
															(
																IFNULL(v.ult_mes, 0) * a.urgencia / 100
															),
															0
															) > (a.stock - a.pedidos) 
															AND a.estado = 'Activo'");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
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
														a.urgencia,
														CASE
														WHEN a.stock < 0 
														THEN 0 
														ELSE a.stock 
														END AS stock,
														(a.stock - a.pedidos) AS stockB,
														a.pedidos,
														a.tipo,
														a.taller,
														a.alm_corte,
														a.ord_corte,
														a.proyeccion 
													FROM
														articulojf a 
														LEFT JOIN marcasjf m 
														ON a.id_marca = m.id 
													WHERE a.estado = 'Activo' 
														AND a.articulo = $valor");

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS
	*/
	static public function mdlVisualizarUrgenciasDetalle($tabla, $valor){

		$sql="SELECT 
						dt.articulo,
						dt.mat_pri,
						mp.descripcionMP,
						mp.unidad,
						FORMAT(mp.stockMP,2) AS stockMP,
						CASE
						WHEN dt.tej_princ = 'si' 
						THEN 'SI' 
						ELSE '-' 
						END tej_princ,
						FORMAT(dt.consumo,4) AS consumo,
						CASE
						WHEN dt.consumo > mp.stockMP 
						THEN 'Faltante' 
						ELSE '-' 
						END AS urgenciaMp,
						CASE
						WHEN oc.codpro IS NULL 
						THEN '-' 
						ELSE 'En OC' 
						END AS alerta 
					FROM
						$tabla dt 
						LEFT JOIN articulojf a 
						ON dt.articulo = a.articulo 
						LEFT JOIN 
						(SELECT DISTINCT 
							p.Codpro,
							CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcionMP,
							tb2.Des_Corta AS unidad,
							p.CodAlm01 AS stockMP 
						FROM
							producto AS p,
							Tabla_M_Detalle AS tb,
							Tabla_M_Detalle AS tb2 
						WHERE tb.Cod_Tabla IN ('TCOL') 
							AND tb2.Cod_Tabla IN ('TUND') 
							AND tb.Cod_Argumento = p.ColPro 
							AND tb2.Cod_Argumento = p.UndPro) AS mp 
						ON dt.mat_pri = mp.codpro 
						LEFT JOIN 
						(SELECT DISTINCT 
							ocd.codpro 
						FROM
							ocomdet ocd 
							LEFT JOIN ocompra oc 
							ON ocd.nro = oc.nro 
							LEFT JOIN proveedor p 
							ON oc.codruc = p.codruc 
						WHERE oc.estac IN ('ABI', 'PAR') 
							AND ocd.estac IN ('ABI', 'PAR') 
							AND oc.estoco = '03' 
							AND ocd.estoco = '03' 
							AND YEAR(oc.fecemi) = '2019') AS oc 
						ON dt.mat_pri = oc.codpro 
					WHERE dt.articulo = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}



}
