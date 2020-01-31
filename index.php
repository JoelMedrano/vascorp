<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";

require_once "controladores/marcas.controlador.php";
require_once "controladores/colores.controlador.php";
require_once "controladores/articulos.controlador.php";
require_once "controladores/materiaprima.controlador.php";

require_once "controladores/tarjetas.controlador.php";
require_once "controladores/movimientos.controlador.php";

require_once "controladores/ordencorte.controlador.php";

require_once "controladores/contactos.controlador.php";
require_once "controladores/mensajes.controlador.php";

require_once "controladores/pedidos.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";

require_once "modelos/marcas.modelo.php";
require_once "modelos/colores.modelo.php";
require_once "modelos/articulos.modelo.php";
require_once "modelos/materiaprima.modelo.php";

require_once "modelos/tarjetas.modelo.php";
require_once "modelos/movimientos.modelo.php";

require_once "modelos/ordencorte.modelo.php";

require_once "modelos/contactos.modelo.php";
require_once "modelos/mensajes.modelo.php";

require_once "modelos/pedidos.modelo.php";



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();