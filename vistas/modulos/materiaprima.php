<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Materia Prima
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar materia prima</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaMateriaPrima" width="100%">
         
        <thead>

          <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Cod. Línea</th>
           <th>Línea</th>
           <th>Descripcion</th>
           <th>Color</th>
           <th>Stock</th>
           <th>Unidad</th>
           <th>Costo</th>
           <th style="width:100px">Acciones</th>

         </tr>

          <!-- <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Extn.</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr> -->

        </thead>

        <tbody>

        
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL EDITAR MATERIA PRIMA
======================================-->

<div id="modalEditarMateriaPrima" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Materia Prima</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" placeholder="Ingresar código" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" placeholder="Ingresar nombre" required>

              </div>

            </div>            
                       


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar artículo</button>

        </div>

      </form>

      <?php

      $editarMateriaPrima = new ControladorMateriaPrima();
      $editarMateriaPrima -> ctrEditarMateriaPrima();

      ?>    

    </div>

  </div>

</div>



<!--=====================================
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVisualizarArticulos" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" method="post">

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

            <!-- ENTRADA PARA CODIGO DE LA MATERIA PRIMA-->
            
            <div class="form-group col-lg-3">
              
              <label>CodPro</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codpro" id="codpro" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO DE LA LINEA-->
            
            <div class="form-group col-lg-3">

              <label>Código Línea</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codLinea" id="codLinea" required readonly>

              </div>

            </div>            

            <!-- ENTRADA PARA LA LINEA-->
            
            <div class="form-group col-lg-6">

              <label>Línea</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="linea" id="linea" required readonly>

              </div>

            </div>      
            
            <!-- ENTRADA PARA EL CODIGO DE FABRICA-->
            
            <div class="form-group col-lg-3">

              <label>CodFab</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codfab" id="codfab" required readonly>

              </div>

            </div>
            
            <!-- ENTRADA PARA LA DESCRIPCION-->
            
            <div class="form-group col-lg-9">

              <label>Descripcion</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="descripcion" id="descripcion" required readonly>

              </div>

            </div>     

            <!-- ENTRADA PARA EL COLOR-->
            
            <div class="form-group col-lg-3">

              <label>Color</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="color" id="color" required readonly>

              </div>

            </div>     

            <!-- ENTRADA PARA EL STOCK-->
            
            <div class="form-group col-lg-3">

              <label>Stock</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="stock" id="stock" required readonly>

              </div>

            </div> 
            
            <!-- ENTRADA PARA EL PROVEEDOR-->
            
            <div class="form-group col-lg-6">

              <label>Proveedor Principal</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="proveedor" id="proveedor" required readonly>

              </div>

            </div>             

            <!-- TABLA DE DETALLES -->
            
            <label>TABLA DETALLES</label>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalleArticulo">

                <thead>

                  <tr>

                    <th style="width:100px">Articulo</th>
                    <th style="width:100px">Modelo</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Estado</th>
                    <th>Consumo</th>
                    <th style="width:60px">TP</th>

                  </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>



      </form>

    </div>

  </div>

</div>