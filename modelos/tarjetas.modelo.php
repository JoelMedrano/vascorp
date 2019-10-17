<?php

require_once "conexion.php";

class ModeloTarjetas{

	/*=============================================
	MOSTRAR TARJETAS
	=============================================*/

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
                                                                a.id,
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
                                                            ORDER BY t.articulo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
       


}