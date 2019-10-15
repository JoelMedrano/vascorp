/*=============================================
CARGAR LA TABLA DINÁMICA DE MATERIA PRIMA
=============================================*/

/* $.ajax({

    url: "ajax/datatable-materiaprima.ajax.php",
    success: function (respuesta) {

        console.log("respuesta", respuesta);

    }

}) */


$('.tablaMateriaPrima').DataTable( {
    "ajax": "ajax/datatable-materiaprima.ajax.php",
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


/*=============================================
EDITAR ARTICULO
=============================================*/

$(".tablaMateriaPrima tbody").on("click", "button.btnEditarMateriaPrima", function(){

	var idMateriaPrima = $(this).attr("idMateriaPrima");

	/* console.log("idMateriaPrima", idMateriaPrima); */

	var datos = new FormData();
	datos.append("idMateriaPrima", idMateriaPrima);
	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            console.log("respuesta", respuesta);
			
			$("#editarCodigo").val(respuesta["CodPro"]);

			$("#editarDescripcion").val(respuesta["DesPro"]);
 
   
		}
  
	})	



})
