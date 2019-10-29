<?php

require_once "conexion.php";

class ModeloMovimientos{

   /* 
   * total unidades vendidas del mes acutal
   */
   static public function mdlTotUndVen($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      mes,
                                                      SUM(total_ventas) AS total_venta
                                                   FROM
                                                      $tabla t 
                                                      WHERE año = YEAR(NOW()) 
                                                      AND mes = MONTH(NOW()) 
                                                      GROUP BY mes");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }

   /* 
   * total unidades producidas del mes actual
   */
   static public function mdlTotUndProd($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      mes,
                                                      SUM(total_produccion) AS total_produccion
                                                   FROM
                                                      totalesjf t 
                                                      WHERE año = YEAR(NOW()) 
                                                      AND mes = MONTH(NOW()) 
                                                      GROUP BY mes");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }
   
   /* 
   * sacamos los meses con movimientos
   */

   static public function mldMesesMov($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      t.mes,
                                                      CASE
                                                      WHEN t.mes = '1' 
                                                      THEN 'Enero' 
                                                      WHEN t.mes = '2' 
                                                      THEN 'Febrero' 
                                                      WHEN t.mes = '3' 
                                                      THEN 'Marzo' 
                                                      WHEN t.mes = '4' 
                                                      THEN 'Abril' 
                                                      WHEN t.mes = '5' 
                                                      THEN 'Mayo' 
                                                      WHEN t.mes = '6' 
                                                      THEN 'Junio' 
                                                      WHEN t.mes = '7' 
                                                      THEN 'Julio' 
                                                      WHEN t.mes = '8' 
                                                      THEN 'Agosto' 
                                                      WHEN t.mes = '9' 
                                                      THEN 'Septiembre' 
                                                      WHEN t.mes = '10' 
                                                      THEN 'Octubre' 
                                                      WHEN t.mes = '11' 
                                                      THEN 'Noviembre' 
                                                      ELSE 'Diciembre' 
                                                      END AS nom_mes 
                                                   FROM
                                                      $tabla t 
                                                   WHERE t.año = YEAR(NOW())
                                                   GROUP BY t.mes");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de ventas por mes
   */
   static public function mdlTotalMesVent($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                         t.mes,
                                                         SUM(total_ventas) AS total_mesV
                                                         FROM
                                                         $tabla t 
                                                         WHERE t.año = YEAR(NOW())
                                                         GROUP BY t.mes");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de produccion por mes
   */
   static public function mdlTotalMesProd($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      t.mes,
                                                      SUM(total_produccion) AS total_mesP
                                                      FROM
                                                      $tabla t 
                                                      WHERE t.año = YEAR(NOW())
                                                      GROUP BY t.mes");

      $stmt -> execute();

      return $stmt -> fetchall();

   }
   
   /* 
   * sacamos los totales por mes de la  nueva tabla TOTALES
   */

  static public function mldMostrarTotales($tabla, $item, $valor){

      if($item != null){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

         $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetch();

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                      CONCAT(t.año,'-',t.mes) AS llave,
                                                      t.año,
                                                      t.mes,
                                                      CASE
                                                         WHEN t.mes = '1' 
                                                         THEN 'Enero' 
                                                         WHEN t.mes = '2' 
                                                         THEN 'Febrero' 
                                                         WHEN t.mes = '3' 
                                                         THEN 'Marzo' 
                                                         WHEN t.mes = '4' 
                                                         THEN 'Abril' 
                                                         WHEN t.mes = '5' 
                                                         THEN 'Mayo' 
                                                         WHEN t.mes = '6' 
                                                         THEN 'Junio' 
                                                         WHEN t.mes = '7' 
                                                         THEN 'Julio' 
                                                         WHEN t.mes = '8' 
                                                         THEN 'Agosto' 
                                                         WHEN t.mes = '9' 
                                                         THEN 'Septiembre' 
                                                         WHEN t.mes = '10' 
                                                         THEN 'Octubre' 
                                                         WHEN t.mes = '11' 
                                                         THEN 'Noviembre' 
                                                         ELSE 'Diciembre' 
                                                      END AS nom_mes,
                                                      SUM(t.total_ventas) AS ventas,
                                                      SUM(t.total_produccion) AS produccion 
                                                   FROM
                                                      $tabla t 
                                                   WHERE YEAR(NOW()) >= t.año
                                                   GROUP BY t.año,
                                                      t.mes");

         $stmt -> execute();

         return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

   }

   /* 
	* Método para actualizar los totales por dia
	*/
	static public function mdlActualizarMovimientos($tabla,$valor1,$valor2){
	
		$sql="UPDATE 
                  $tabla t 
                  LEFT JOIN 
                  (SELECT 
                     YEAR(m.fecha) AS año,
                     MONTH(m.fecha) AS mes,
                     DAY(m.fecha) AS dia,
                     SUM(m.cantidad) AS produccion 
                  FROM
                     movimientosjf m 
                  WHERE m.tipo = 'E20' 
                     AND YEAR(m.fecha) = $valor1 
                     AND MONTH(m.fecha) = $valor2
                  GROUP BY YEAR(m.fecha),
                     MONTH(m.fecha),
                     DAY(m.fecha)) AS p 
                  ON t.año = p.año 
                  AND t.mes = p.mes 
                  AND t.dia = p.dia 
                  LEFT JOIN 
                  (SELECT 
                     YEAR(m.fecha) AS año,
                     MONTH(m.fecha) AS mes,
                     DAY(m.fecha) AS dia,
                     SUM(m.cantidad) AS venta 
                  FROM
                     movimientosjf m 
                  WHERE m.tipo IN ('S02', 'S03', 'S70', 'E05', 'E21') 
                  AND YEAR(m.fecha) = $valor1 
                     AND MONTH(m.fecha) = $valor2
                  GROUP BY YEAR(m.fecha),
                     MONTH(m.fecha),
                     DAY(m.fecha)) AS v 
                  ON t.año = v.año 
                  AND t.mes = v.mes 
                  AND t.dia = v.dia SET t.total_produccion = IFNULL(p.produccion,0),
                  t.total_ventas = IFNULL(v.venta,0) 
               WHERE t.año= $valor1 
                  AND t.mes = $valor2";

		$stmt=Conexion::conectar()->prepare($sql);

		

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;


	}


}