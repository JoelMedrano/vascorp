<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Tarjetas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Tarjetas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-tarjeta">

          <button class="btn btn-primary">
            
            Agregar Tarjetas

          </button>

        </a>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaTarjetas">
         
        <thead>
         
         <tr>
           

           <th>Código Interno</th>
           <th>Estado Tarjeta</th>
           <th style="width:50px">Fecha</th>
           <th>Total</th> 
           <th>Responsable</th>
           <th>Artículo</th>
           <th>Modelo</th>
           <th>Descripcion</th>
           <th>Color-Talla</th>
           <th>Estado Artículo</th>
           <th style="width:150px">Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL ASIGNAR TEJIDO PRINCIPAL
======================================-->

<div id="modalTejidoPrincipal" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Tejido Principal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL ARTICULO-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="editarArticulo" id="editarArticulo" required>

                 <input type="hidden"  name="idTarjeta" id="idCategoria" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR LA MATERIA PRIMA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span> 

                <select class="form-control input-lg" id="mpPrincipal" name="mpPrincipal" required>
                  
                  <option value="">Seleccionar Materia Prima</option>
 
                </select>

              </div>

            </div>            
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
