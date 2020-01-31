<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Crear pedido

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear pedido</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-7 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" metohd="post">

                        <div class="box-body">

                            <div class="box">

                                <?php
                                                                
                                    date_default_timezone_set('America/Lima');
                                    $ahora=date('Y/m/d h:i:s');                                

                                ?>

                                <!--=====================================
                                ENTRADA DEL RESPONSABLE
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                        <input type="text" class="form-control input-sm" id="nuevoResponsable" name="nuevoResponsable" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                                        <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL CODIGO
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                        <?php

                                        $pedido = $_GET["pedido"];
                                        #var_dump("pedido", $pedido);

                                        echo '<input type="text" class="form-control input-sm" id="nuevoCodigo" name="nuevoCodigo" value="' . $pedido . '" readonly>';

                                        ?>



                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL CLIENTE
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                        <?php

                                        $valor = $_GET["pedido"];

                                        $pedido = ControladorPedidos::ctrMostrarTemporal($valor);
                                        #var_dump("pedido", $pedido);

                                        if ($pedido["codigo"] != "") {

                                            $cliente = ControladorClientes::ctrMostrarClientes("id", $pedido["cliente"]);

                                            echo '<input type="text" class="form-control input-sm" id="seleccionarCliente" name="seleccionarCliente" value="' . $cliente["nombre"] . '" readonly>';
                                            #var_dump("nombre", $cliente["nombre"]);

                                        } else {

                                            echo '<select class="form-control selectpicker" id="seleccionarCliente" name="seleccionarCliente" data-live-search="true" required>

                                                <option value="">Seleccionar cliente</option>';

                                            $item = null;
                                            $valor = null;

                                            $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                                            foreach ($categorias as $key => $value) {

                                                echo '<option value="' . $value["id"] . '">' . $value["codigo"] . ' - ' . $value["nombre"] . '</option>';
                                            }

                                            echo '</select>

                                            <span class="input-group-addon"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarClienteP" data-dismiss="modal">Agregar
                                                    cliente</button></span>';
                                        }


                                        ?>



                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL VENDEDOR
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>

                                        <?php

                                        $valor = $_GET["pedido"];

                                        $pedido = ControladorPedidos::ctrMostrarTemporal($valor);
                                        #var_dump("pedido", $pedido);

                                        if ($pedido["codigo"] != "") {

                                            echo '<input type="text" class="form-control input-sm" id="seleccionarVendedor" name="seleccionarVendedor" value="' . $pedido["vendedor"] . '" readonly>';
                                        } else {

                                            echo '<select class="form-control" id="seleccionarVendedor" name="seleccionarVendedor" required>

                                                    <option value="">Vendedor</option>
                                                    <option value="00">00 - Oficina</option>
                                                    <option value="02">02 - Manuel Vasquez</option>
                                                    <option value="07">07 - Antonio Diaz</option>
                                                    <option value="18A">18A - Oscar Ponce</option>
                                                    <option value="19">19 - Juan Carlos Diaz</option>
                                                    <option value="20">20 - Amelia Portal</option>

                                                </select>';
                                        }

                                        ?>



                                    </div>

                                </div>

                                <!--=====================================
                                        TITULOS
                                ======================================-->

                                <div class="box box-primary">

                                    <div class="row">

                                        <div class="col-xs-7">

                                            <label>Item</label>

                                        </div>

                                        <div class="col-xs-2">

                                            <label for="">Cantidad</label>

                                        </div>

                                        <div class="col-xs-3">

                                            <label for="">Total S/ IGV</label>

                                        </div>

                                    </div>

                                </div>



                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevoProductoPedido">

                                    <?php

                                    #tremos la lista de items
                                    $listaArtPed = ControladorPedidos::ctrMostrarDetallesTemporal($_GET["pedido"]);
                                    #var_dump("listaArtPed", $listaArtPed);

                                    foreach ($listaArtPed as $key => $value) {

                                        $infoArtPed = controladorArticulos::ctrMostrarArticulos("articulo", $value["articulo"]);

                                        $total_detalle = $value["cantidad"] * $value["precio"];
                                        #var_dump("infoArtPed", $infoArtPed);

                                        echo '  <div class="row" style="padding:5px 15px">

                                                <div class="col-xs-7" style="padding-right:0px">

                                                    <div class="input-group">
                                
                                                        <span class="input-group-addon">

                                                            <button type="button" class="btn btn-danger btn-xs quitarProducto" articulo="' . $infoArtPed["articulo"] . '"><i class="fa fa-times"></i></button>

                                                        </span>
                                    
                                                        <input type="text" class="form-control nuevaDescripcionArticulo input-sm" articulo="' . $infoArtPed["articulo"] . '" name="agregarProducto" value="' . $infoArtPed["packing"] . '" articuloP="' . $infoArtPed["articulo"] . '" readonly required>
                                
                                                    </div>
                                                
                                                </div>

                                                <div class="col-xs-2">

                                                    <input type="number" class="form-control nuevaCantidadArtPed input-sm" name="nuevaCantidadArtPed" min="1" value="' . $value["cantidad"] . '" required>
                            
                                                </div>

                                                <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                                                    <div class="input-group">
                                
                                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    
                                                        <input type="text" class="form-control nuevoPrecioArt" precioReal="' . $value["precio"] . '" name="nuevoPrecioArt" value="' . $total_detalle . '" readonly required>
                                
                                                    </div>
                            
                                              </div>

                            
                                            
                                    
                                            </div>';
                                    }



                                    ?>

                                </div>

                                <input type="hidden" id="listaProductosPedidos" name="listaProductosPedidos">

                                <hr>

                                <div class="row">

                                    <!--=====================================
                                    ENTRADA IMPUESTOS Y TOTAL
                                    ======================================-->

                                    <div class="col-xs-12 pull-right">

                                        <table class="table">

                                            <thead>

                                                <tr>
                                                    <th>Descuento</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" class="form-control" min="0" id="nuevoDescuento" name="nuevoDescuento" placeholder="0" required>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                                        </div>

                                                    </td>

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" class="form-control" min="0" id="nuevoIGV" name="nuevoIGV" value="18" required>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                                        </div>

                                                    </td>

                                                    <td style="width: 40%">

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                            <input type="number" min="1" class="form-control" id="nuevoTotalPedido" name="nuevoTotalPedido" placeholder="00000" readonly required>


                                                        </div>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <hr>

                                <!--=====================================
                                ENTRADA MÉTODO DE PAGO
                                ======================================-->

                                <div class="form-group row">

                                    <div class="col-xs-6" style="padding-right:0px">

                                        <div class="input-group">

                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="Contra Entrega">Contra Entrega</option>
                                                <option value="Factura a 30 días">Factura a 30 días</option>
                                                <option value="3 - Letras">3 - Letras</option>
                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-xs-6" style="padding-right:0px">

                                        <div class="input-group">

                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>

                                                <option value="">Seleccione Agencia</option>
                                                <option value="91">Marvisur</option>
                                                <option value="97">Prueba</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <br>

                            </div>

                        </div>

                        <div class="box-footer" id="footer">

                            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

                        </div>

                    </form>

                </div>

            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->

            <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

                <div class="box box-warning">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaArticulosPedidos">

                            <thead>

                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Modelo</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Talla</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>


            </div>

            <div>
                <a href="#footer"><b>Ir al Final</b></a>
            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR ARTICULOS
======================================-->

<div id="modalAgregarClienteP" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 60% !important;">

        <div class="modal-content">

            <form role="form" method="post" class="formularioPedido">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Detalle Artículos</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="box box-primary">

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="modeloModal" name="modeloModal" readonly>

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                    <input type="text" class="form-control input-sm" id="precio" name="precio">

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="cliente" name="cliente" placeholder="Tiene que escoger el Cliente" required>

                                </div>

                            </div>

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="vendedor" name="vendedor" placeholder="Tiene que escoger el Vendedor" required>

                                </div>

                            </div>


                            <?php

                            $pedido = $_GET["pedido"];

                            echo '<input type="hidden" class="form-control input-sm" id="pedido" name="pedido" value="' . $pedido . '" readonly>';


                            ?>


                        </div>

                        <div class="box box-warning col-lg-12">

                            <!-- TABLA DE DETALLES -->

                            <label>TABLA DETALLES</label>

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive tablaColTal" width="100%">

                                    <thead>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">S</th>
                                            <th style="width:100px">M</th>
                                            <th style="width:100px">L</th>
                                            <th style="width:100px">XL</th>
                                            <th style="width:100px">XXL</th>
                                            <th style="width:100px">XS</th>
                                            <th style="width:100px"></th>
                                            <th style="width:100px"></th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">28</th>
                                            <th style="width:100px">30</th>
                                            <th style="width:100px">32</th>
                                            <th style="width:100px">34</th>
                                            <th style="width:100px">36</th>
                                            <th style="width:100px">38</th>
                                            <th style="width:100px">40</th>
                                            <th style="width:100px">42</th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px">Modelo</th>
                                            <th style="width:200px">Color</th>
                                            <th style="width:100px">3</th>
                                            <th style="width:100px">4</th>
                                            <th style="width:100px">6</th>
                                            <th style="width:100px">8</th>
                                            <th style="width:100px">10</th>
                                            <th style="width:100px">12</th>
                                            <th style="width:100px">14</th>
                                            <th style="width:100px">16</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <tr class="detalleCT">

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>




                    </div>

                </div>

                <div class="box box-success">

                    <div class="form-group col-lg-4">

                        <label> Total Unidades</label>

                        <div class="input-group">

                            <input type="text" name="totalCantidad" id="totalCantidad" readonly>


                        </div>

                    </div>

                    <div class="form-group col-lg-4">

                        <label> Total Soles</label>

                        <div class="input-group">

                            <input type="text" name="totalSoles" id="totalSoles" readonly>


                        </div>


                    </div>

                    <div class="form-group col-lg-4">

                        <label></label>

                        <div class="input-group">

                            <button type="button" class="btn btn-success pull-left btnCalCant">Calcular</button>

                        </div>


                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar Modelo</button>

                </div>



            </form>

            <?php

            $crearPedido = new ControladorPedidos();
            $crearPedido->ctrCrearPedido();

            ?>

        </div>

    </div>

</div>