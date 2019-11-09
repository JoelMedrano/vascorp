<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Urgencias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Urgencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalConfigurarUrgencia">

        Configuracion Actual

        <?php
        
        $configuracion = controladorArticulos::ctrConfiguracion();

        #var_dump("configuracion", $configuracion);

        $urgencia = $configuracion["urgencia"];


        ?>
          
          <?=$urgencia;?> %

        </button>

      </div>

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto"> 

       <table class="table table-bordered table-striped dt-responsive tablaUrgencias" width="100%">
         
        <thead>

          <tr>
           
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Color</th>
           <th>Talla</th>
           <th>Estado</th>
           <th>Proyección</th>
           <th>% Avance</th>
           <th>Stock</th>
           <th>Pedidos</th>
           <th>En Taller</th>
           <th>Alm. Corte</th>
           <th>Ord. Corte</th>
           <th>Ult 30d</th>
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
MODAL CONFIGURAR % DE URGENCIAS
======================================-->

<div id="modalConfigurarUrgencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Configurar Porcentaje</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <select class="form-control input-lg" id="urgencia" name="urgencia" required>

                  <option value="">Selecionar Porcentaje</option>

                  <option value="100">100 %</option>

                  <option value="90">90 %</option>

                  <option value="80">80 %</option>

                  <option value="70">70 %</option>

                  <option value="60">60 %</option>

                  <option value="50">50 %</option>

                  <option value="40">40 %</option>

                  <option value="30">30 %</option>

                  <option value="20">20 %</option>

                  <option value="10">10 %</option>

                  <option value="0">0 %</option>
                
                </select>

              </div>

            </div>       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar artículo</button>

        </div>

      </form>

      <?php

        $configurarUrgenciaLista = new controladorArticulos();
        $configurarUrgenciaLista -> ctrConfigurarUrgenciaLista();

      ?>  


    </div>

  </div>

</div>