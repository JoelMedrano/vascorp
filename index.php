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

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";

require_once "modelos/marcas.modelo.php";
require_once "modelos/colores.modelo.php";
require_once "modelos/articulos.modelo.php";
require_once "modelos/materiaprima.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();