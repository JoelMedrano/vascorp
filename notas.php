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
! sacar reporte en excel
* agregar codigo de linea y unidad de pedido.
// se puede poner la cantidad de prendas que rinden por kilo? en tarjeta.


todo: ESCRITORIO
* cambiar imagen del login - ok
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
* hacer tabla urgencias mp - ok
* sacar reporte de orden de corte a excel - ok
* sacar reporte de urgencias - ok.

todo: OTROS
* etiquetar codigo - ok
* asginar roles - MANTENER SIEMPRE ACTIVO
* notificaar el porque de la anulacion - YUDY

todo: BACKEND SISTEMAS

* actualizar totales unidades - ok
* actualizar totales soles - ok
* hacer backup automatico - ok
* listar backups disponibles - ok

todo: TICKETS:

* Permitir cambiar imagen de usuario y contraseña - ok
* hacer bandeja de entrada - ok

todo: HACER MODULO DE VENTAS PARA MEDIAS
* empezar con clientes - ok
* modulo de pedidos


todo: ROLES
* SISTEMAS
- TODOS LOS MODULOS / TODOS LOS BOTONES - CONTROL TOTAL
* SUPERVISORES
- QUITAR LOS MODULOS DE PRUEBA
* PRODUCCION
- ESCRITORIO - UNIDADES
- MODULOS: MAESTROS - TARJETAS
- QUITAR BOTONES ELIMINAR DE TODO MENOS DE ARTICULOS
* LOGISTICA
- ESCRITORIO - UNIDADES
- MODULOS: MAESTROS - TARJETAS - QUITAR CREAR TARJETAS
- QUITAR BOTONES ELIMINAR DE TODO
* DISEÑO
- ESCRITORIO - UNIDADES
- MODULOS: MAESTROS - TARJETAS
- QUITAR BOTONES ELIMINAR DE TODO MENOS DE TARJETAS
* COSTOS
- ESCRITORIO - UNIDADES
- MODULOS: MAESTROS - TARJETAS
- QUITAR BOTONES ELIMINAR DE TODO MENOS DE TARJETAS
* VENTAS

*/

if($respuesta = "ok"){

echo '  <script>

         window.location="index.php?ruta=crear-pedidocv&pedido='.$_POST["pedido"].'";

        </script>';

}