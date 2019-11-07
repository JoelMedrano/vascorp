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
