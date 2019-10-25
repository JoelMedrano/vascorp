<?php

require_once "conexion.php";

class ModeloMovimientos{

   /* 
   * total unidades vendidas del mes acutal
   */
   static public function mdlTotUndVen($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT   MONTH(m.fecha) AS mes,
                                                         SUM(m.cantidad) AS total_venta 
                                                      FROM $tabla m
                                                      WHERE YEAR(m.fecha) = '2019' 
                                                         AND MONTH(m.fecha) = MONTH(NOW()) 
                                                         AND m.tipo IN ('S02', 'S03', 'S70', 'E05', 'E21') 
                                                      GROUP BY MONTH(m.fecha)");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }

   /* 
   * total unidades producidas del mes actual
   */
   static public function mdlTotUndProd($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT   MONTH(m.fecha) AS mes,
                                                         SUM(m.cantidad) AS total_produccion 
                                                      FROM $tabla m
                                                      WHERE YEAR(m.fecha) = '2019' 
                                                         AND MONTH(m.fecha) = MONTH(NOW()) 
                                                         AND m.tipo = 'E20' 
                                                      GROUP BY MONTH(m.fecha)");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

   }
   
   /* 
   * sacamos los meses con movimientos
   */

   static public function mldMesesMov($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT   MONTH(m.fecha) AS mes,
                                                      CASE
                                                      WHEN MONTH(m.fecha) = '1' 
                                                      THEN 'Ene' 
                                                      WHEN MONTH(m.fecha) = '2' 
                                                      THEN 'Feb' 
                                                      WHEN MONTH(m.fecha) = '3' 
                                                      THEN 'Mar' 
                                                      WHEN MONTH(m.fecha) = '4' 
                                                      THEN 'Abr' 
                                                      WHEN MONTH(m.fecha) = '5' 
                                                      THEN 'May' 
                                                      WHEN MONTH(m.fecha) = '6' 
                                                      THEN 'Jun' 
                                                      WHEN MONTH(m.fecha) = '7' 
                                                      THEN 'Jul' 
                                                      WHEN MONTH(m.fecha) = '8' 
                                                      THEN 'Ago' 
                                                      WHEN MONTH(m.fecha) = '9' 
                                                      THEN 'Sep' 
                                                      WHEN MONTH(m.fecha) = '10' 
                                                      THEN 'Oct' 
                                                      WHEN MONTH(m.fecha) = '11' 
                                                      THEN 'Nov' 
                                                      ELSE 'Dic' 
                                                      END AS nom_mes 
                                                   FROM
                                                      $tabla m 
                                                   WHERE YEAR(m.fecha) = '2019' 
                                                   GROUP BY MONTH(m.fecha)");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de ventas por mes
   */
   static public function mdlTotalMesVent($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                      MONTH(m.fecha) AS mes,
                                                      SUM(m.cantidad) AS total_mesV 
                                                   FROM
                                                      $tabla m 
                                                   WHERE YEAR(m.fecha) = '2019' 
                                                      AND m.tipo IN ('S02', 'S03', 'S70', 'E05', 'E21') 
                                                   GROUP BY MONTH(m.fecha)");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de produccion por mes
   */
   static public function mdlTotalMesProd($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                      MONTH(m.fecha) AS mes,
                                                      SUM(m.cantidad) AS total_mesP 
                                                   FROM
                                                      $tabla m 
                                                   WHERE YEAR(m.fecha) = '2019' 
                                                      AND m.tipo='E20'
                                                   GROUP BY MONTH(m.fecha)");

      $stmt -> execute();

      return $stmt -> fetchall();

   }   

}