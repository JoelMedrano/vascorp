/* 
* TABLA CON LAS VENTAS TOTALES POR MES
*/
$('.tablaMovimientos').DataTable( {
    "ajax": "ajax/tabla-movimientos.ajax.php",
    "deferRender": true,
	"retrieve": true,
    "processing": true,
    "order": [[0, "desc"]],
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

/* 
* ACTUALIZAR TOTALES DEL MES
*/
$(".tablaMovimientos").on("click", ".btnActualizarMes", function () {

	var año = $(this).attr("año");
    var mes = $(this).attr("mes");
    
    /* console.log(año, mes); */

    var datos = new FormData();
    datos.append("año", año);
    datos.append("mes", mes);
    
    $.ajax({

		url: "ajax/movimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			/* console.log("respuesta",respuesta); */
			
			if (respuesta == "ok") {
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue Actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then((result) => {
					if (result.value) {
						window.location = "movimientos";
					}
				});
			}
		
		}
	})

})