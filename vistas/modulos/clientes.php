<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente

        </button>

      </div>

      <div class="box-body">

      <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaClientes">

          <thead>

            <tr>

              <th>Código</th>
              <th>Nombre</th>
              <th>Tip. Pers.</th>
              <th>Tip. Doc.</th>
              <th>Documento</th>
              <th>Teléfono</th>
              <th>Ubigeo</th>
              <th>Ingreso al sistema</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>


          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- DATOS PRINCIPALES -->

            <div class="box box-primary col-lg-12 ">

              <div class="box-header">

                <b>Datos Principales</b>

              </div>

              <!-- ENTRADA PARA EL CODIGO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="codigoCliente" placeholder="Código" required>

                </div>

              </div>

              <!-- ENTRADA PARA RAZON SOCIAL -->

              <div class="form-group col-lg-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="nombre" placeholder="Razón Social o Nombre Completo" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TIPO DOCUMENTO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="tipo_documento" name="tipo_documento" required>

                    <option value="">Tipo Documento</option>

                    <option value="SD">SIN DOCUMENTO</option>
                    <option value="DNI">DNI</option>
                    <option value="C. Extra.">C. Extra.</option>
                    <option value="RUC">RUC</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                    <option value="C. Diplom.">C. Diplom.</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DEL DOCUMENTO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="documento" placeholder="Nro. Documento" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TIPO PERSONA -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="tipo_persona" name="tipo_persona" required>

                    <option value="">Tipo Persona</option>

                    <option value="NATURAL">Natural</option>
                    <option value="JURÍDICA">Jurídica</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="ape_paterno" placeholder="Apellido Paterno">

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="ape_materno" placeholder="Apellido Materno">

                </div>

              </div>

              <!-- ENTRADA PARA NOMBRES -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="nombres" placeholder="Nombres">

                </div>

              </div>


            </div>

            <!-- FIN DATOS PRINCIPALES -->

            <!-- DATOS DIRECCION -->

            <div class="box box-warning col-lg-12 ">

              <div class="box-header">

                <b>Dirección</b>

              </div>

              <!-- ENTRADA PARA LA DIRECCION -->

              <div class="form-group col-lg-8">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="direccion" placeholder="Direccion de Facturación" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL UBIGEO -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm selectpicker" id="ubigeo" name="ubigeo" data-live-search="true" required>

                    <option value="">Ubigeo</option>

                    <?php
                    
                    $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                    #var_dump("ubigeo", $ubigeo);
                    foreach ($ubigeo as $key => $value) {

                      echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';

                    }

                    
                    ?>

                    

                  </select>

                </div>

              </div>              

            </div>

            <!-- FIN DATOS DIRECCION -->
            
            <!-- DATOS DIRECCION -->

            <div class="box box-success col-lg-12 ">

              <div class="box-header">

                <b>CONTACTO</b>

              </div>

              <!-- ENTRADA PARA EL TELEFONO 1 -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="telefono" placeholder="Telefono - 1" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TELEFONO 1 -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="telefono2" placeholder="Telefono - 2" required>

                </div>

              </div> 
              
              <!-- ENTRADA PARA EL E-MAIL -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="email" placeholder="E - mail" required>

                </div>

              </div>
              
              <!-- ENTRADA PARA EL CONTACTO -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="contacto" placeholder="Contacto" required>

                </div>

              </div>      
              
              <!-- ENTRADA PARA EL VENDEDOR -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="vendedor" name="vendedor" required>

                    <option value="">Vendedor</option>
                    <option value="00">00   - Oficina</option>
                    <option value="02">02   - Manuel Vasquez</option>
                    <option value="07">07   - Antonio Diaz</option>
                    <option value="18A">18A - Oscar Ponce</option>
                    <option value="19">19   - Juan Carlos Diaz</option>
                    <option value="20">20   - Amelia Portal</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA LOS GRUPOS -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="grupo" name="grupo">

                    <option value="">Grupo</option>
                    <option value="JOEL">Joel</option>

                  </select>

                </div>

              </div>               
              
              <!-- ENTRADA PARA LA LISTA DE PRECIOS -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="lista_precios" name="lista_precios" required>

                    <option value="">Lista de Precios</option>
                    <option value="06">06 - Mayoristas</option>
                    <option value="07">07 - Distribuidores</option>

                  </select>

                </div>

              </div>
              
                

            </div>

            <!-- FIN DATOS DIRECCION -->              



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- DATOS PRINCIPALES -->

            <div class="box box-primary col-lg-12 ">

              <div class="box-header">

                <b>Datos Principales</b>

              </div>

              <!-- ENTRADA PARA EL CODIGO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarCodigoCliente" id="editarCodigoCliente" placeholder="Código" readonly required>

                </div>

              </div>

              <!-- ENTRADA PARA RAZON SOCIAL -->

              <div class="form-group col-lg-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarNombre" id="editarNombre" placeholder="Razón Social o Nombre Completo" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TIPO DOCUMENTO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="editarTipo_documento" name="editarTipo_documento" required>

                    <option value="">Tipo Documento</option>

                    <option value="SD">SIN DOCUMENTO</option>
                    <option value="DNI">DNI</option>
                    <option value="C. Extra.">C. Extra.</option>
                    <option value="RUC">RUC</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                    <option value="C. Diplom.">C. Diplom.</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DEL DOCUMENTO -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" id="editarDocumento" name="editarDocumento" placeholder="Nro. Documento" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TIPO PERSONA -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="editarTipo_persona" name="editarTipo_persona" required>

                    <option value="">Tipo Persona</option>

                    <option value="NATURAL">Natural</option>
                    <option value="JURÍDICA">Jurídica</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarApe_paterno" id="editarApe_paterno" placeholder="Apellido Paterno">

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarApe_materno" id="editarApe_materno" placeholder="Apellido Materno">

                </div>

              </div>

              <!-- ENTRADA PARA NOMBRES -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarNombres" id="editarNombres" placeholder="Nombres">

                </div>

              </div>


            </div>

            <!-- FIN DATOS PRINCIPALES -->

            <!-- DATOS DIRECCION -->

            <div class="box box-warning col-lg-12 ">

              <div class="box-header">

                <b>Dirección</b>

              </div>

              <!-- ENTRADA PARA LA DIRECCION -->

              <div class="form-group col-lg-8">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarDireccion" id="editarDireccion" placeholder="Direccion de Facturación" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL UBIGEO -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm selectpicker" id="editarUbigeo" name="editarUbigeo" data-live-search="true" required>

                    <?php
                    
                    $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                    #var_dump("ubigeo", $ubigeo);

                    foreach ($ubigeo as $key => $value) {

                      echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';

                    }

                    
                    ?>

                    

                  </select>

                </div>

              </div>              

            </div>

            <!-- FIN DATOS DIRECCION -->
            
            <!-- DATOS DIRECCION -->

            <div class="box box-success col-lg-12 ">

              <div class="box-header">

                <b>CONTACTO</b>

              </div>

              <!-- ENTRADA PARA EL TELEFONO 1 -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarTelefono" id="editarTelefono" placeholder="Telefono - 1" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL TELEFONO 1 -->

              <div class="form-group col-lg-2">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarTelefono2" id="editarTelefono2" placeholder="Telefono - 2" required>

                </div>

              </div> 
              
              <!-- ENTRADA PARA EL E-MAIL -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarEmail" id="editarEmail" placeholder="E - mail" required>

                </div>

              </div>
              
              <!-- ENTRADA PARA EL CONTACTO -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <input type="text" class="form-control input-sm" name="editarContacto" id="editarContacto" placeholder="Contacto" required>

                </div>

              </div>      
              
              <!-- ENTRADA PARA EL VENDEDOR -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="editarVendedor" name="editarVendedor" required>

                    <option value="">Vendedor</option>
                    <option value="00">00   - Oficina</option>
                    <option value="02">02   - Manuel Vasquez</option>
                    <option value="07">07   - Antonio Diaz</option>
                    <option value="18A">18A - Oscar Ponce</option>
                    <option value="19">19   - Juan Carlos Diaz</option>
                    <option value="20">20   - Amelia Portal</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA LOS GRUPOS -->

              <div class="form-group col-lg-4">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="editarGrupo" name="editarGrupo">

                    <option value="">Grupo</option>
                    <option value="JOEL">Joel</option>

                  </select>

                </div>

              </div>               
              
              <!-- ENTRADA PARA LA LISTA DE PRECIOS -->

              <div class="form-group col-lg-3">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                  <select class="form-control input-sm" id="editarLista_precios" name="editarLista_precios" required>

                    <option value="">Lista de Precios</option>
                    <option value="06">06 - Mayoristas</option>
                    <option value="07">07 - Distribuidores</option>

                  </select>

                </div>

              </div>
              
                

            </div>

            <!-- FIN DATOS DIRECCION -->              



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente->ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

