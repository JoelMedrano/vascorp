/* 
 * BOTON VISUALIZAR URGENCIAS
 */
$(".tablaUrgencias").on("click", ".btnVerUrgencias", function () {

    var codigo = $(this).attr("codigo");
    //console.log("codigo", codigo);

    var datos = new FormData();
    datos.append("codigo", codigo);

    $.ajax({

        url: "ajax/urgencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta", respuesta);

            $("#articulo").val(respuesta["articulo"]);
            $("#modelo").val(respuesta["modelo"]);
            $("#nombre").val(respuesta["nombre"]);
            $("#color").val(respuesta["color"]);
            $("#talla").val(respuesta["talla"]);
            $("#stock").val(respuesta["stockB"]);
            $("#pedidos").val(respuesta["pedidos"]);
            $("#taller").val(respuesta["taller"]);
            $("#alm_corte").val(respuesta["alm_corte"]);
            $("#ord_corte").val(respuesta["ord_corte"]);
            $("#estado").val(respuesta["estado"]);
            
        }

    })

    var codigoD = $(this).attr("codigo");
    //console.log("codigoD", codigoD);

    var datosDetalle = new FormData();
	datosDetalle.append("codigoD", codigoD);

	$.ajax({

		url:"ajax/urgencias.ajax.php",
		method: "POST",
		data: datosDetalle,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

			//console.log("respuestaDetalle", respuestaDetalle);

            $(".detalleUrg").remove();
            
            for(var id of respuestaDetalle){

                $('.tablaDetalleUrgencia').append(

					'<tr class="detalleUrg">' +
						'<td>' + id.mat_pri + ' </td>' +
						'<td><b>' + id.descripcionMP + ' </b></td>' +
						'<td>' + id.consumo + ' </td>' +
						'<td>' + id.unidad + ' </td>' +
						'<td><center>' + id.stockMP + ' </center></td>' +
						'<td><center>' + id.tej_princ + ' </center></td>' +
						'<td><b>' + id.urgenciaMp + ' </b></td>' +
						'<td><b>' + id.alerta + ' </b></td>' +
					'</tr>'

				)

			}

		}

	})


})