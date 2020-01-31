/* 
* CARGAR TABLA CLIENTES
*/
$('.tablaClientes').DataTable({
	"ajax": "ajax/tabla-clientes.ajax.php?perfil=" + $("#perfilOculto").val(),
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "asc"]],
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});

/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaClientes").on("click", ".btnEditarCliente", function () {

    var codigo = $(this).attr("codigo");
    console.log("codigo", codigo);

	var datos = new FormData();
	datos.append("codigo", codigo);
	
	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            //console.log(respuesta);
			
            $("#editarCodigoCliente").val(respuesta["codigo"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarTipo_documento").val(respuesta["tipo_documento"]);
            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarTipo_persona").val(respuesta["tipo_persona"]);
            $("#editarApe_paterno").val(respuesta["ape_paterno"]);
            $("#editarApe_materno").val(respuesta["ape_materno"]);
            $("#editarNombres").val(respuesta["nombres"]);
            $("#editarDireccion").val(respuesta["direccion"]);

            $("#editarUbigeo").val(respuesta["ubigeo"]);
            $("#editarUbigeo").selectpicker('refresh');

            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarTelefono2").val(respuesta["telefono2"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarContacto").val(respuesta["contacto"]);
            $("#editarVendedor").val(respuesta["vendedor"]);
            $("#editarGrupo").val(respuesta["grupo"]);
            $("#editarLista_precios").val(respuesta["lista_precios"]);



			
 
		}
  
	})	    



})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
	
	swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }

  })

})