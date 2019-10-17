<?php

require_once "conexion.php";

class ModeloMateriaPrima{

	/*=============================================
	MOSTRAR MATERIA PRIMA
	=============================================*/

	static public function mdlMostrarMateriaPrima($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT   	
														p.Codpro,
														SUBSTRING(p.CodFab, 1, 6) AS codlinea,
														tb4.Des_larga AS linea,
														p.DesPro,
														CONCAT(p.DesPro,' - ',tb.Des_Larga) AS descripcion,
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
                                                    ORDER BY SUBSTRING(p.CodFab, 1, 6) ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }    
    
	/*=============================================
	EDITAR ARTICULO
	=============================================*/
	static public function mdlEditarMateriaPrima($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET despro = :despro WHERE codpro = :codpro");

		$stmt->bindParam(":despro", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":codpro", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	    



}