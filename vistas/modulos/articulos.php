<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Artículos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar artículos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArticulo">
          
          Agregar artículos

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaArticulos" width="100%">
         
        <thead>

          <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Artículo</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Color</th>
           <th>Talla</th>
           <th>Tipo</th>
           <th>Estado</th>
           <th>Stock</th>
           <th>Acciones</th>

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
MODAL AGREGAR MARCA
======================================-->

<div id="modalAgregarArticulo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar articulo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Seleccionar marca</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                  foreach ($marcas as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaModelo" placeholder="Ingresar modelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar nombre" required>

              </div>

            </div>            

            <!-- ENTRADA PARA SELECCIONAR COLOR -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-dashboard"></i></span> 

                <select class="form-control input-lg" id="nuevoColor" name="nuevoColor" required>
                  
                  <option value="">Seleccionar color</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $colores = ControladorColores::ctrMostrarColores($item, $valor);

                  foreach ($colores as $key => $value) {
                    
                    echo '<option value="'.$value["cod_color"].'">'.$value["cod_color"].' - '.$value["nom_color"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA TALLAS -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <select class="form-control input-lg" id="nuevaTalla" name="nuevaTalla" required>

                  <option value="">Selecionar talla</option>

                  <option value="1">S</option>

                  <option value="2">M</option>

                  <option value="3">L</option>

                  <option value="4">XL</option>

                  <option value="5">XXL</option>

                  <option value="6">XS</option>

                  <option value="2">4</option>

                  <option value="3">6</option>

                  <option value="4">8</option>

                  <option value="5">10</option>

                  <option value="6">12</option>

                  <option value="7">14</option>

                  <option value="8">16</option>

                  <option value="1">28</option>

                  <option value="2">30</option>

                  <option value="3">32</option>

                  <option value="4">34</option>

                  <option value="5">36</option>

                  <option value="6">38</option>

                  <option value="7">40</option>

                  <option value="8">42</option>

                </select>

              </div>

            </div>       

            <!-- ENTRADA PARA TIPO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-height"></i></span> 

                <select class="form-control input-lg" id="nuevoTipo" name="nuevoTipo">
                  
                  <option value="">Selecionar tipo</option>

                  <option value="BRASIER">BRASIER</option>

                  <option value="TRUSA">TRUSA</option>

                  <option value="TOP">TOP</option>

                  <option value="BODY">BODY</option>

                  <option value="BOXER V">BOXER V</option>

                  <option value="BVD NIÑOS">BVD NIÑOS</option>

                  <option value="GUAPITAS">GUAPITAS</option>

                  <option value="SK">SK</option>

                </select>

              </div>

            </div>                      

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/articulos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>



    </div>

  </div>

</div>


