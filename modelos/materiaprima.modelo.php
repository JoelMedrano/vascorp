<?php

require_once "conexion.php";

class ModeloMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function mdlMostrarMateriaPrima($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT   	
														p.Codpro,
														SUBSTRING(p.CodFab, 1, 6) AS codlinea,
														tb4.Des_larga AS linea,
														p.DesPro,
														CONCAT((SUBSTRING(p.CodFab, 1, 6)),' - ',p.DesPro,' - ',tb.Des_Larga, ' - ',tb2.Des_Corta) AS descripcion,
														p.CodAlm01,
														tb.Des_Larga AS color,
														tb2.Des_Corta AS unidad,
														p.cospro 
													FROM $tabla AS p,
														Tabla_M_Detalle AS tb,
														Tabla_M_Detalle AS tb1,
														Tabla_M_Detalle AS tb2,
														Tabla_M_Detalle AS tb4 			
													WHERE $item = :$item 
														AND tb.Cod_Tabla IN ('TCOL') 
														AND tb2.Cod_Tabla IN ('TUND') 
														AND tb4.Cod_Tabla IN ('TLIN') 
														AND tb1.Cod_Tabla IN ('TSUB') 
														AND tb.Cod_Argumento = p.ColPro 
														AND tb2.Cod_Argumento = p.UndPro 
														AND LEFT(p.CodFab, 3) = tb4.Des_Corta 
														AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
														AND tb4.Des_Corta = tb1.Des_Corta
														ORDER BY SUBSTRING(CodFab, 1, 6) ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                                        p.Codpro AS codigo,
                                                        SUBSTRING(p.CodFab, 1, 6) AS codlinea,
                                                        tb4.Des_larga AS linea,
                                                        p.DesPro AS descripcion,
                                                        p.CodAlm01 AS stock,
                                                        tb.Des_Larga AS color,
                                                        tb2.Des_Corta AS unidad,
                                                        p.cospro 
                                                    FROM
                                                        $tabla AS p,
                                                        Tabla_M_Detalle AS tb,
                                                        Tabla_M_Detalle AS tb1,
                                                        Tabla_M_Detalle AS tb2,
                                                        Tabla_M_Detalle AS tb4 
                                                    WHERE tb.Cod_Tabla IN ('TCOL') 
                                                        AND tb2.Cod_Tabla IN ('TUND') 
                                                        AND tb4.Cod_Tabla IN ('TLIN') 
                                                        AND tb1.Cod_Tabla IN ('TSUB') 
                                                        AND tb.Cod_Argumento = p.ColPro 
                                                        AND tb2.Cod_Argumento = p.UndPro 
                                                        AND LEFT(p.CodFab, 3) = tb4.Des_Corta 
                                                        AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
                                                        AND tb4.Des_Corta = tb1.Des_Corta
														AND p.estpro = '1' 
                                                    ORDER BY SUBSTRING(p.CodFab, 1, 6) ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }    
    
	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrima($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET despro = :despro WHERE codpro = :codpro");

		$stmt->bindParam(":despro", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":codpro", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* SACAR SOLO TELA Y BLONDA PARA EL TEJIDO PRINCIPAL
	*/

	static public function mdlTejidoPrincipal($tabla){

		$sql="SELECT DISTINCT 	p.Codpro,
								CONCAT(
								SUBSTRING(p.CodFab, 1, 6),
								' - ',
								p.DesPro,
								' - ',
								tb.Des_Larga
								) AS descripcion 
							FROM
								$tabla AS p,
								Tabla_M_Detalle AS tb,
								Tabla_M_Detalle AS tb1,
								Tabla_M_Detalle AS tb2,
								Tabla_M_Detalle AS tb4 
							WHERE tb4.Des_larga IN ('TELA', 'BLONDA') 
								AND tb.Cod_Tabla IN ('TCOL') 
								AND tb2.Cod_Tabla IN ('TUND') 
								AND tb4.Cod_Tabla IN ('TLIN') 
								AND tb1.Cod_Tabla IN ('TSUB') 
								AND tb.Cod_Argumento = p.ColPro 
								AND tb2.Cod_Argumento = p.UndPro 
								AND LEFT(p.CodFab, 3) = tb4.Des_Corta 
								AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
								AND tb4.Des_Corta = tb1.Des_Corta 
							ORDER BY SUBSTRING(CodFab, 1, 6) ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;
	}

	/* 
	* Método para vizualizar cabecera mateeria prima
	*/
	static public function mdlVisualizarMateriaPrima($tabla, $item, $valor){

		$sql="SELECT DISTINCT 
									p.codpro,
									tblin.des_larga AS linea,
									SUBSTRING(p.codfab, 1, 6) AS codlinea,
									p.codfab,
									p.despro AS descripcion,
									p.codpro,
									p.codalm01 as stock,
									tbund.des_corta AS unidad,
									tbcol.des_larga AS color,
									IFNULL(pmp.proveedores,'Pendiente') AS proveedor 
								FROM
									$tabla p 
									LEFT JOIN 
									(SELECT 
										codpro,
										CONCAT_WS('   -   ', prov1.razpro) AS proveedores 
									FROM
										preciomp pmp 
										LEFT JOIN proveedor prov1 
										ON pmp.codprov1 = prov1.codruc 
									GROUP BY pmp.codpro) AS pmp 
									ON pmp.codpro = p.codpro 
									INNER JOIN tabla_m_detalle AS tbund 
									ON p.undpro = tbund.cod_argumento 
									AND (tbund.Cod_Tabla = 'TUND') 
									INNER JOIN tabla_m_detalle AS tbcol 
									ON p.ColPro = tbcol.cod_argumento 
									AND (tbcol.Cod_Tabla = 'TCOL') 
									INNER JOIN tabla_m_detalle AS tblin 
									ON LEFT(p.codfab, 3) = tblin.des_corta 
									AND (tblin.cod_tabla = 'Tlin')
								WHERE p.$item = :$item
									AND p.estpro = '1'";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}
	
	/* 
	* Método para vizualizar detalle de la materia prima
	*/
	static public function mdlVisualizarMateriaPrimaDetalle($tabla, $item, $valor){

		$sql="SELECT 	dt.mat_pri,
						dt.articulo,
						a.modelo,
						a.nombre,
						a.color,
						a.talla,
						a.estado,
						dt.consumo,
						dt.tej_princ 
					FROM
						$tabla dt 
						LEFT JOIN articulojf a 
						ON dt.articulo = a.articulo
					WHERE dt.$item = :$item
					ORDER BY dt.articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* EDITAR COSTO DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrimaCosto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cospro = :cospro WHERE codpro = :codpro");

		$stmt->bindParam(":cospro", $datos["cospro"], PDO::PARAM_STR);
		$stmt->bindParam(":codpro", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* MOSTRAR MATERIA PRIMA PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgenciaAMP($tabla, $valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
														dt.mat_pri,
														mp.linea,
														mp.codfab,
														mp.descripcion,
														mp.color,
														mp.unidad,
														COUNT(dt.mat_pri) items
													FROM
														$tabla dt 
														LEFT JOIN 
														(SELECT DISTINCT 
															p.codpro,
															tblin.des_larga AS linea,
															SUBSTRING(p.codfab, 1, 6) AS codlinea,
															p.codfab,
															p.despro AS descripcion,
															p.codalm01 AS stockMP,
															tbund.des_corta AS unidad,
															tbcol.des_larga AS color,
															IFNULL(pmp.proveedores, 'Pendiente') AS proveedor 
														FROM
															producto p 
															LEFT JOIN 
															(SELECT 
																codpro,
																CONCAT_WS('   -   ', prov1.razpro) AS proveedores 
															FROM
																preciomp pmp 
																LEFT JOIN proveedor prov1 
																ON pmp.codprov1 = prov1.codruc 
															GROUP BY pmp.codpro) AS pmp 
															ON pmp.codpro = p.codpro 
															INNER JOIN tabla_m_detalle AS tbund 
															ON p.undpro = tbund.cod_argumento 
															AND (tbund.Cod_Tabla = 'TUND') 
															INNER JOIN tabla_m_detalle AS tbcol 
															ON p.ColPro = tbcol.cod_argumento 
															AND (tbcol.Cod_Tabla = 'TCOL') 
															INNER JOIN tabla_m_detalle AS tblin 
															ON LEFT(p.codfab, 3) = tblin.des_corta 
															AND (tblin.cod_tabla = 'Tlin') 
														WHERE p.estpro = '1') AS mp 
														ON dt.mat_pri = mp.codpro 
														LEFT JOIN 
														(SELECT 
															a.articulo 
														FROM
															articulojf a 
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
															AND a.estado = 'Activo') AS a 
														ON dt.articulo = a.articulo 
													WHERE a.articulo IS NOT NULL 
														AND dt.consumo > mp.stockMP 
														GROUP BY dt.mat_pri
														ORDER BY mp.linea");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
														p.codpro,
														SUBSTRING(p.codfab, 1, 6) AS codlinea,
														tblin.des_larga AS linea,
														p.codfab,
														p.despro AS descripcion,
														p.codalm01 AS stockMP,
														tbund.des_corta AS unidad,
														tbcol.des_larga AS color,
														IFNULL(pmp.proveedores, 'Pendiente') AS proveedor 
													FROM
														producto p 
														LEFT JOIN 
														(SELECT 
															codpro,
															CONCAT_WS('   -   ', prov1.razpro) AS proveedores 
														FROM
															preciomp pmp 
															LEFT JOIN proveedor prov1 
															ON pmp.codprov1 = prov1.codruc 
														GROUP BY pmp.codpro) AS pmp 
														ON pmp.codpro = p.codpro 
														INNER JOIN tabla_m_detalle AS tbund 
														ON p.undpro = tbund.cod_argumento 
														AND (tbund.Cod_Tabla = 'TUND') 
														INNER JOIN tabla_m_detalle AS tbcol 
														ON p.ColPro = tbcol.cod_argumento 
														AND (tbcol.Cod_Tabla = 'TCOL') 
														INNER JOIN tabla_m_detalle AS tblin 
														ON LEFT(p.codfab, 3) = tblin.des_corta 
														AND (tblin.cod_tabla = 'Tlin') 
													WHERE p.estpro = '1' 
														AND p.codpro = $valor");

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleOC($tabla, $valor){

		$sql="SELECT 
						ocd.codpro,
						ocd.nro,
						DATE(oc.fecemi) AS emision,
						DATE(oc.fecllegada) AS llegada,
						p.razpro,
						FORMAT(ocd.canpro,2) AS cantidad_pedida,
  						FORMAT(ocd.cantni,2) AS saldo,
						oc.estac 
					FROM
						$tabla ocd 
						LEFT JOIN ocompra oc 
						ON ocd.nro = oc.nro 
						LEFT JOIN proveedor p 
						ON oc.codruc = p.codruc 
					WHERE oc.estac IN ('ABI', 'PAR') 
						AND ocd.estac IN ('ABI', 'PAR') 
						AND oc.estoco = '03' 
						AND ocd.estoco = '03' 
						AND YEAR(oc.fecemi) = '2019' 
						AND ocd.codpro = $valor";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleART($tabla, $valor){

		$sql="SELECT DISTINCT
						a.articulo,
						a.modelo,
						a.nombre,
						a.color,
						a.talla,
						a.stock - a.pedidos AS stockB,
						a.pedidos 
					FROM
						$tabla a 
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
						LEFT JOIN detalles_tarjetajf dt 
						ON a.articulo = dt.articulo 
					WHERE ROUND(
						(
							IFNULL(v.ult_mes, 0) * a.urgencia / 100
						),
						0
						) > (a.stock - a.pedidos) 
						AND a.estado = 'Activo' 
						AND dt.mat_pri = $valor
						ORDER BY a.articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	


}