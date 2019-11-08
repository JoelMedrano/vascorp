<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Ordenes de Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Ordenes de corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-ordencorte">

          <button class="btn btn-primary">

            Agregar Orden de Corte

          </button>

        </a>

      </div>

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        
       <table class="table table-bordered table-striped dt-responsive tablaOrdenCorte">
         
        <thead>
         
         <tr>
           
           <th>Orden de Corte</th>
           <th>Responsable</th>
           <th><center>Cantidad Total</center></th>
           <th>Saldo</th> 
           <th>Estado</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVisualizarOC" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle de la Orden de Corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL OC-->
            
            <div class="form-group col-lg-3">
              
              <label>Orden de Corte</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="ordencorte" id="ordencorte" required readonly></strong>

              </div>

            </div>

            
            <!-- ENTRADA PARA LA FECHA-->
            
            <div class="form-group col-lg-3">

              <label>Creación</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="fecha" id="fecha" required readonly></strong>

              </div>

            </div>   

            <!-- ENTRADA PARA LA CONFIGURACION-->
            
            <div class="form-group col-lg-3">

              <label>Configuración</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="configuracion" id="configuracion" required readonly></strong>

              </div>

            </div>               


            <!-- ENTRADA PARA LA RESPONSABLE-->
            
            <div class="form-group col-lg-3">

              <label>Responsable</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="nombre" id="nombre" required readonly></strong>

              </div>

            </div>            
   
            
            <!-- ENTRADA PARA LA CANTIDAD-->
            
            <div class="form-group col-lg-4">

              <label>Cantidad Inicial</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="cantidad" id="cantidad" required readonly></strong>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL SALDO-->
            
            <div class="form-group col-lg-4">

              <label>Saldo Actual</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="saldo" id="saldo" required readonly></strong>

              </div>

            </div>     

            <!-- ENTRADA PARA EL ESTADO-->
            
            <div class="form-group col-lg-4">

              <label>Estado</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <strong><input type="text" class="form-control input-sm" name="estado" id="estado" required readonly></strong>

              </div>

            </div>
                       
            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
            <label>TABLA DETALLES</label>
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalleOC">

              <thead>

                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>S</th>
                  <th>M</th>
                  <th>L</th>
                  <th>XL</th>
                  <th>XXL</th>
                  <th>XS</th>
                  <th></th>
                  <th></th>
                </tr>

                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>28</th>
                  <th>30</th>
                  <th>32</th>
                  <th>34</th>
                  <th>36</th>
                  <th>38</th>
                  <th>40</th>
                  <th>42</th>
                </tr>

                <tr>
                  <th>Ord. Corte</th>
                  <th>Modelo</th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>3</th>
                  <th>4</th>
                  <th>6</th>
                  <th>8</th>
                  <th>10</th>
                  <th>12</th>
                  <th>14</th>
                  <th>16</th>
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