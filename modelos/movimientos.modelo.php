<?php

require_once "conexion.php";

class ModeloMovimientos{

   /* 
   * total unidades vendidas del mes actual
   */
   static public function mdlTotUndVen($tabla, $valor){

      if( $valor == null){

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

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                         mes,
                                                         SUM(total_ventas) AS total_venta
                                                      FROM
                                                         $tabla t 
                                                         WHERE año = YEAR(NOW()) 
                                                         AND mes = MONTH(NOW()) - $valor
                                                         GROUP BY mes");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }



   }

   /* 
   * total unidades producidas del mes actual
   */
   static public function mdlTotUndProd($tabla, $valor){

      if($valor == null){

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                         mes,
                                                         SUM(total_produccion) AS total_produccion
                                                      FROM
                                                         $tabla t 
                                                         WHERE año = YEAR(NOW()) 
                                                         AND mes = MONTH(NOW()) 
                                                         GROUP BY mes");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                         mes,
                                                         SUM(total_produccion) AS total_produccion
                                                      FROM
                                                         $tabla t 
                                                         WHERE año = YEAR(NOW()) 
                                                         AND mes = MONTH(NOW()) - $valor
                                                         GROUP BY mes");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

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
                                                      SUM(t.total_produccion) AS produccion,
                                                      SUM(t.total_ventas_soles) AS ventasSoles,
                                                      SUM(t.total_pagos_soles) AS pagosSoles  
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
                     AND t.dia = v.dia 
                     LEFT JOIN 
                     (SELECT 
                        YEAR(v.fecha) AS año,
                        MONTH(v.fecha) AS mes,
                        DAY(v.fecha) AS dia,
                        SUM(v.total) / 1.18 AS ventas_soles 
                     FROM
                        ventajf v 
                     WHERE YEAR(v.fecha) = $valor1 
                        AND MONTH(v.fecha) = $valor2 
                     GROUP BY YEAR(v.fecha),
                        MONTH(v.fecha),
                        DAY(v.fecha)) AS v1 
                     ON t.año = v1.año 
                     AND t.mes = v1.mes 
                     AND t.dia = v1.dia 
                     LEFT JOIN 
                     (SELECT 
                        YEAR(p1.fecha) AS año,
                        MONTH(p1.fecha) AS mes,
                        DAY(p1.fecha) AS dia,
                        SUM(p1.total) AS pagos_soles 
                     FROM
                        pagosjf p1 
                     WHERE YEAR(p1.fecha) = $valor1 
                        AND MONTH(p1.fecha) = $valor2 
                        AND p1.tipo_cobro IN ('00', '05', '06', '80', '82', 'TR') 
                     GROUP BY YEAR(p1.fecha),
                        MONTH(p1.fecha),
                        DAY(p1.fecha)) AS p1 
                     ON t.año = p1.año 
                     AND t.mes = p1.mes 
                     AND t.dia = p1.dia SET t.total_produccion = IFNULL(p.produccion, 0),
                     t.total_ventas = IFNULL(v.venta, 0),
                     t.total_ventas_soles = IFNULL(v1.ventas_soles, 0),
                     t.total_pagos_soles = IFNULL(p1.pagos_soles, 0) 
                  WHERE t.año = $valor1 
                     AND t.mes = $valor2";

		$stmt=Conexion::conectar()->prepare($sql);

		

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;


	}

   /* 
   * sacamos las ventas por mes y año
   */
   static public function mdlTotalesSolesVenta($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                                            m.codigo,
                                                            m.descripcion AS mes,
                                                            ROUND(v1.ventas_soles1/1000,0) AS ano1,
                                                            ROUND(v2.ventas_soles2/1000,0) AS ano2,
                                                            ROUND(v3.ventas_soles3/1000,0) AS ano3 
                                                         FROM
                                                            meses m 
                                                            LEFT JOIN 
                                                            (SELECT 
                                                               t.año,
                                                               t.mes,
                                                               SUM(t.total_ventas_soles) AS ventas_soles1 
                                                            FROM
                                                               $tabla t 
                                                            WHERE t.año = YEAR(NOW()) - 2 
                                                            GROUP BY t.año,
                                                               t.mes) AS v1 
                                                            ON m.codigo = v1.mes 
                                                            LEFT JOIN 
                                                            (SELECT 
                                                               t.año,
                                                               t.mes,
                                                               SUM(t.total_ventas_soles) AS ventas_soles2 
                                                            FROM
                                                               $tabla t 
                                                            WHERE t.año = YEAR(NOW()) - 1 
                                                            GROUP BY t.año,
                                                               t.mes) AS v2 
                                                            ON m.codigo = v2.mes 
                                                            LEFT JOIN 
                                                            (SELECT 
                                                               t.año,
                                                               t.mes,
                                                               SUM(t.total_ventas_soles) AS ventas_soles3 
                                                            FROM
                                                               $tabla t 
                                                            WHERE t.año = YEAR(NOW()) 
                                                            GROUP BY t.año,
                                                               t.mes) AS v3 
                                                            ON m.codigo = v3.mes");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los pagos por mes y año
   */
   static public function mdlTotalesSolesPagos($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                                               m.codigo,
                                                               m.descripcion AS mes,
                                                               ROUND(p1.pagos_soles1/1000,0) AS ano1,
                                                               ROUND(p2.pagos_soles2/1000,0) AS ano2,
                                                               ROUND(p3.pagos_soles3/1000,0) AS ano3 
                                                            FROM
                                                               meses m 
                                                               LEFT JOIN 
                                                               (SELECT 
                                                                  t.año,
                                                                  t.mes,
                                                                  SUM(t.total_pagos_soles) AS pagos_soles1 
                                                               FROM
                                                               $tabla t 
                                                               WHERE t.año = YEAR(NOW()) - 2 
                                                               GROUP BY t.año,
                                                                  t.mes) AS p1 
                                                               ON m.codigo = p1.mes 
                                                               LEFT JOIN 
                                                               (SELECT 
                                                                  t.año,
                                                                  t.mes,
                                                                  SUM(t.total_pagos_soles) AS pagos_soles2 
                                                               FROM
                                                               $tabla t 
                                                               WHERE t.año = YEAR(NOW()) - 1 
                                                               GROUP BY t.año,
                                                                  t.mes) AS p2 
                                                               ON m.codigo = p2.mes 
                                                               LEFT JOIN 
                                                               (SELECT 
                                                                  t.año,
                                                                  t.mes,
                                                                  SUM(t.total_pagos_soles) AS pagos_soles3 
                                                               FROM
                                                               $tabla t 
                                                               WHERE t.año = YEAR(NOW()) 
                                                               GROUP BY t.año,
                                                                  t.mes) AS p3 
                                                               ON m.codigo = p3.mes");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * total unidades vendidas del mes actual
   */
   static public function mdlTotDiasProd($tabla, $valor){

      $stmt = Conexion::conectar()->prepare("SELECT 
                                                      COUNT(*) AS dias_produccion 
                                                   FROM
                                                      $tabla t 
                                                   WHERE t.año = YEAR(NOW()) 
                                                      AND t.mes = MONTH(NOW()) - $valor 
                                                      AND total_produccion > 0");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 
   
   /* 
   * modelos mas vendidos 
   */
   static public function mdlMovMes($tabla, $valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                      CASE
                                                      WHEN LEFT (m.articulo, 1) = 1 
                                                      THEN LEFT (m.articulo, 5) 
                                                      ELSE LEFT (m.articulo, 4) 
                                                      END AS modelo,
                                                      SUM(m.cantidad) AS ventas 
                                                   FROM
                                                      $tabla m 
                                                   WHERE YEAR(m.fecha) = YEAR(NOW()) 
                                                      AND MONTH(m.fecha) = MONTH(NOW()) 
                                                      AND m.tipo IN ('E05', 'E21', 'S02', 'S03', 'S70') 
                                                   GROUP BY (
                                                      CASE
                                                         WHEN LEFT (m.articulo, 1) = 1 
                                                         THEN LEFT (m.articulo, 5) 
                                                         ELSE LEFT (m.articulo, 4) 
                                                      END
                                                      ) 
                                                   ORDER BY SUM(m.cantidad) DESC 
                                                   LIMIT 10");

         $stmt -> execute();

         return $stmt -> fetchALL();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                      CASE
                                                      WHEN LEFT (m.articulo, 1) = 1 
                                                      THEN LEFT (m.articulo, 5) 
                                                      ELSE LEFT (m.articulo, 4) 
                                                      END AS modelo,
                                                      SUM(m.cantidad) AS ventas 
                                                   FROM
                                                      $tabla m 
                                                   WHERE YEAR(m.fecha) = YEAR(NOW()) 
                                                      AND MONTH(m.fecha) = MONTH(NOW()) - $valor
                                                      AND m.tipo IN ('E05', 'E21', 'S02', 'S03', 'S70') 
                                                   GROUP BY (
                                                      CASE
                                                         WHEN LEFT (m.articulo, 1) = 1 
                                                         THEN LEFT (m.articulo, 5) 
                                                         ELSE LEFT (m.articulo, 4) 
                                                      END
                                                      ) 
                                                   ORDER BY SUM(m.cantidad) DESC 
                                                   LIMIT 10");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

      }


   }    

   /* 
   * modelos mas vendidos 
   */
   static public function mdlSumaUnd($tabla, $valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                      SUM(total_ventas) AS sumaUnd 
                                                   FROM
                                                      $tabla t 
                                                   WHERE t.año = YEAR(NOW()) 
                                                      AND t.mes = MONTH(NOW())");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("SELECT 
                                                      SUM(total_ventas) AS sumaUnd 
                                                   FROM
                                                      $tabla t 
                                                   WHERE t.año = YEAR(NOW()) - $valor
                                                      AND t.mes = MONTH(NOW())");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }


   }    


}