<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar colores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar colores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarColor">
          
          Agregar color

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Color</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $colores = ControladorColores::ctrMostrarColores($item, $valor);

          foreach ($colores as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["cod_color"].'</td>

                    <td>'.$value["nom_color"].'</td>';

                    if( $_SESSION["perfil"] == "Supervisores" ||
                        $_SESSION["perfil"] == "Sistemas"){

                          echo '<td>

                                <div class="btn-group">
                                    
                                  <button class="btn btn-warning btnEditarColor" data-toggle="modal" data-target="#modalEditarColor" idColor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
          
                                  <button class="btn btn-danger btnEliminarColor" idColor="'.$value["id"].'"><i class="fa fa-times"></i></button>
          
                                </div>  
          
                              </td>';

                    }else{

                      echo '<td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btnEditarColor" data-toggle="modal" data-target="#modalEditarColor" idColor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                              </div>  

                            </td>';

                      
                    }




                  echo '</tr>';
          
            }

        ?>
         
         
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR COLOR
======================================-->

<div id="modalAgregarColor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Color</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoColor" placeholder="Ingresar color" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar color</button>

        </div>

      </form>


      <?php

        $crearColor = new ControladorColores();
        $crearColor -> ctrCrearColor();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR COLOR
======================================-->

<div id="modalEditarColor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar color</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarColor" id="editarColor" required>
                <input type="hidden" id="idColor" name="idColor">
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

      <?php

        $editarColor = new ControladorColores();
        $editarColor -> ctrEditarColor();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarColor = new ControladorColores();
  $eliminarColor -> ctrEliminarColor();

?>