/*=============================================
CARGAR LA TABLA DINÁMICA DE ARTICULOS
=============================================*/

/* $.ajax({

    url: "ajax/datatable-articulos.ajax.php",
    success: function (respuesta) {

        console.log("respuesta", respuesta);

    }

}) */


$('.tablaArticulos').DataTable( {
    "ajax": "ajax/datatable-articulos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}    
} );

// ACTIVANDO-DESACTIVANDO USUARIO
$(document).on("click",".btnActivar",function(){
	// Capturamos el id del usuario y el estado
	var idArticulo=$(this).attr("idArticulo");
	var estadoArticulo=$(this).attr("estadoArticulo");
	// Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",idArticulo);
	datos.append("activarEstado",estadoArticulo);
	$.ajax({
		url:"ajax/articulos.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
			if(window.matchMedia("(max-width:767px)").matches){
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location="articulos";}
				});}}
	});
	// Cambiamos el estado del botón físicamente
	if(estadoArticulo=='DESCONTINUADO'){
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Inactivo");
		$(this).attr("estadoArticulo","Activo");}
	else{
		$(this).addClass("btn-success");
		$(this).removeClass("btn-danger");
		$(this).html("Activo");
		$(this).attr("estadoArticulo","DESCONTINUADO");}
});