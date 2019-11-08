/*
todo: TARJETAS
* cambiar en la tabla tarjetas el importe, tiene que ser el neto - ok
* activar y desactivar las tarjetas - adicional graba quien aprobo o rechazo - ok
* ver la opcion de saber cuando editaron la tarjeta y quien fue. - ok
* poner descripcion en botones - ok
* copiar tarjetas - ok
* asignar tejido principal - ok
* visualizar detale de tarjeta - ok
* calcular cantidad que necesita cierta cantidad de prendas - ok
! sacar  reporte en excel
// se puede poner la cantidad de prendas que rinden por kilo? en tarjeta.


todo: ESCRITORIO
* hacer escritorio - cajas superiores - ok
* hacer escritorio - cajas inferiores - ok
* hacer escritorio - graficos. ok
* hacer escritorio con datos para gerencia - seguir agregando
// cargar escritorio - barra de progreso - toma el mismo tiempo


todo: MATERIA PRIMA
* revisar materia prima por articulo - ok
* modulo para actualizar el costo - ok

todo: ARTICULOS
! copiar articulos
! sacar informacion en un modal
! hacer reportes en excel

todo: PRODUCCION
* configurar % de urgencias - ok
* crear orden de corte - ok
* listar ordenes de corte - ok
* editar orden de corte - ok
* eliminar orden de corte
! ver el detalle de la Orden de corte 


todo: OTROS
* etiquetar codigo - ok
* asginar roles - MANTENER SIEMPRE ACTIVO

todo: BACKEND SISTEMAS

* actualizar totales unidades - ok
* actualizar totales soles - ok
* hacer backup automatico - ok
* listar backups disponibles - ok

todo: ROLES
* SISTEMAS
    - TODOS LOS MODULOS / TODOS LOS BOTONES - CONTROL TOTAL
* SUPERVISORES
    - QUITAR LOS MODULOS DE PRUEBA
* PRODUCCION
    - ESCRITORIO - UNIDADES
    - MODULOS: MAESTROS - TARJETAS
    - QUITAR BOTONES ELIMINAR  DE TODO MENOS DE ARTICULOS
* LOGISTICA
    - ESCRITORIO - UNIDADES
    - MODULOS: MAESTROS - TARJETAS - QUITAR CREAR TARJETAS
    - QUITAR BOTONES ELIMINAR  DE TODO
* DISEÑO
- ESCRITORIO - UNIDADES
    - MODULOS: MAESTROS - TARJETAS
    - QUITAR BOTONES ELIMINAR  DE TODO MENOS DE TARJETAS
* COSTOS
    - ESCRITORIO - UNIDADES
    - MODULOS: MAESTROS - TARJETAS
    - QUITAR BOTONES ELIMINAR  DE TODO MENOS DE TARJETAS
* VENTAS

*/


SELECT 
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
  detalles_ordencortejf doc 
  LEFT JOIN articulojf a 
    ON doc.articulo = a.articulo 
WHERE doc.ordencorte = '1011' 
GROUP BY doc.ordencorte,
  a.modelo,
  a.nombre,
  a.color ;


