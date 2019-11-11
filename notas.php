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
! alerta con stock menor al promedio del año

todo: ARTICULOS
! copiar articulos
! sacar informacion en un modal
! hacer reportes en excel

todo: PRODUCCION
* configurar % de urgencias - ok
* crear orden de corte - ok
* listar ordenes de corte - ok
* editar orden de corte - ok
* eliminar orden de corte - ok
* ver el detalle de la Orden de corte -ok
* hacer tabla de urgencias articulo - ok
* ver materia prima faltante - ok
* hacer tabla urgencias mp

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


<!-- 

PARA EL DETALLE DE LAS ORDENES DE COMPRA
 -->

 SELECT 
  ocd.codpro,
  ocd.nro,
  DATE(oc.fecemi) AS emision,
  DATE(oc.fecllegada) AS llegada,
  p.razpro,
  ocd.canpro AS cantidad_pedida,
  ocd.cantni AS saldo,
  oc.estac 
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
  AND YEAR(oc.fecemi) = '2019'

  <!-- 

  para ver el detalle de tarjetas con faltantes y en oc

  SELECT 
  dt.articulo,
  dt.mat_pri,
  mp.descripcionMP,
  mp.unidad,
  mp.stockMP,
  dt.tej_princ,
  dt.consumo,
  CASE
    WHEN dt.consumo > mp.stockMP 
    THEN 'Faltante' 
    ELSE '' 
  END AS urgenciaMp,
  CASE
    WHEN oc.codpro IS NULL 
    THEN '-' 
    ELSE 'En OC' 
  END AS alerta 
FROM
  detalles_tarjetajf dt 
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
WHERE dt.articulo = '10211651'

   -->