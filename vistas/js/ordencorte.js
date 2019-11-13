/* 
* CARGAR TABLA TARJETAS
*/
$('.tablaOrdenCorte').DataTable({
	"ajax": "ajax/datatable-ordencorte.ajax.php?perfil=" + $("#perfilOculto").val(),
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
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



/* 
* tabla de articulos con urgencia para orden de corte
*/
$('.tablaArticulosOrdenCorte').DataTable( {
    "ajax": "ajax/datatable-articulosordencorte.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
} );

/* 
* AGREGANDO LOS ARTICULOS A LA ORDEN DE CORTE DESDE LA TABLA
*/

$(".tablaArticulosOrdenCorte tbody").on("click", "button.agregarArt", function () {

    var articuloOC = $(this).attr("articuloOC");

    /* console.log("articuloOC", articuloOC); */

    $(this).removeClass("btn-primary agregarArt");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloOC", articuloOC);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            /* console.log("respuesta", respuesta); */

            var articulo = respuesta["articulo"];
            var packing = respuesta["packing"];
            var ord_corte = respuesta["ord_corte"];

            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloOC").append(

                '<div class="row" style="padding:5px 15px">' +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-9" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOC" articuloOC="' + articuloOC + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevaDescripcionProducto" articuloOC="' + articuloOC + '" name="agregarOC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Cantidad de la Orden de Corte -->" +

                    '<div class="col-xs-3">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloOC" name="nuevaCantidadArticuloOC" min="1" value="50" ord_corte="' + ord_corte + '" nuevoOrdCorte="' + Number(Number(ord_corte) + 50) + '" required>' +

                    "</div>" +
                
                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

                sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function () {
    /* console.log("tabla"); */

    if (localStorage.getItem("quitarOC") != null) {
        var listaIdArticuloOC = JSON.parse(localStorage.getItem("quitarOC"));

        for (var i = 0; i < listaIdArticuloOC.length; i++) {
            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").addClass("btn-primary agregarArt");
        }
    }
});

/* 
* QUITAR ARTICULO DE LA ORDEN DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloOC = [];

localStorage.removeItem("quitarOC");

$(".formularioOrdenCorte").on("click", "button.quitarOC", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();

    var articuloOC = $(this).attr("articuloOC");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarOC") == null) {

        idQuitarArticuloOC = [];

    } else {

        idQuitarArticuloOC.concat(localStorage.getItem("quitarOC"))

    }

    idQuitarArticuloOC.push({
        "articuloOC": articuloOC
    });

    localStorage.setItem("quitarOC", JSON.stringify(idQuitarArticuloOC));

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").removeClass('btn-default');

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").addClass('btn-primary agregarArt');


    if ($(".nuevoArticuloOC").children().length == 0) {

        $("#nuevoTotalOrdenCorte").val(0);
        $("#totalOrdenCorte").val(0);
        $("#nuevoTotalOrdenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC()


    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioOrdenCorte").on("change", "input.nuevaCantidadArticuloOC", function() {

    var nuevoOrdCorte = Number($(this).attr("ord_corte")) + Number($(this).val());

    $(this).attr("nuevoOrdCorte", Number(nuevoOrdCorte));

    /* console.log("nuevoOrdCorte", nuevoOrdCorte); */
  
    // SUMAR TOTAL DE UNIDADES

    sumarTotalOC();
  
    // AGREGAR IMPUESTO
  

    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarArticulosOC();


  });
  
/* 
* SUMAR EL TOTAL DE LAS ORDENES DE CORTE
*/
  
function sumarTotalOC() {

    var cantidadOc = $(".nuevaCantidadArticuloOC");
  
    /* console.log("cantidadOc", cantidadOc); */
  
    var arraySumarCantidades = [];

    for (var i = 0; i < cantidadOc.length; i++){

        arraySumarCantidades.push(Number($(cantidadOc[i]).val()));

    }
        /* console.log("arraySumarCantidades", arraySumarCantidades); */

    function sunaArrayCantidades(total, numero) {
        return total + numero;
    }

    var sumarTotal = arraySumarCantidades.reduce(sunaArrayCantidades);

    /* console.log("sumarTotal", sumarTotal); */

    $("#nuevoTotalOrdenCorte").val(sumarTotal);
    $("#totalOrdenCorte").val(sumarTotal);
    $("#nuevoTotalOrdenCorte").attr("total", sumarTotal);

  }

/* 
* FORMATO DE MILES AL TOTAL
*/
$("#nuevoTotalOrdenCorte").number(true, 0);

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listarArticulosOC() {

    var listaArticulos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloOC");
    
    for (var i = 0; i < descripcion.length; i++) {

      listaArticulos.push({

        id: $(descripcion[i]).attr("articuloOC"),
        articulo: $(descripcion[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        ord_corte: $(cantidad[i]).attr("nuevoOrdCorte")

      });
    }
  
    /* console.log("listaArticulos", JSON.stringify(listaArticulos)); */
  
    $("#listaArticulosOC").val(JSON.stringify(listaArticulos));
  }

/* 
* BOTON EDITAR ORDEN DE CORTE
*/
$(".tablaOrdenCorte").on("click", ".btnEditarOC", function () {

	var codigo = $(this).attr("codigo");

  window.location = "index.php?ruta=editar-ordencorte&codigo=" + codigo;
  
})

/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloOC() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var articuloOC = $(".quitarOC");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTablaOC = $(".tablaArticulosOrdenCorte tbody button.agregarArt");

	//Recorremos en un ciclo para obtener los diferentes articuloOC que fueron agregados a la venta
	for (var i = 0; i < articuloOC.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloOC[i]).attr("articuloOC");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaOC.length; j++) {

			if ($(botonesTablaOC[j]).attr("articuloOC") == boton) {

				$(botonesTablaOC[j]).removeClass("btn-primary agregarMP");
				$(botonesTablaOC[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function() {
    quitarAgregarArticuloOC();
  });
  

/*=============================================
BORRAR VENTA
=============================================*/
$(".tablaOrdenCorte").on("click", ".btnEliminarOC", function() {
    var codigo = $(this).attr("codigo");

    /* console.log("codigo", codigo); */

    swal({
		type: "warning",
		title: "Advertencia",
		text: "¿Está seguro de eliminar la Orden de Corte? ¡Si no está seguro, puede cancelar la acción!",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: "¡Si, eliminar Orden de Corte!",
		cancelButtonText: "Cancelar",
	}).then(function (result) {
		if (result.value) {
			var datos = new FormData();
			datos.append("codigo", codigo);
			$.ajax({
				url: "ajax/ordencorte.ajax.php",
				type: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function (respuesta) {

                    /* console.log("respuestaaaaaa", respuesta); */
                    
                    if (respuesta == "ok") {
						swal({
							type: "success",
							title: "¡Ok!",
							text: "¡La información fue Eliminada con éxito!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result) => {
							if (result.value) {
								window.location = "ordencorte";
							}
						});
					}


				}
			});
		}
	});

  });


/* 
* VISUALIZAR DETALLE DE LA ORDEN DE CORTE
*/ 
$(".tablaOrdenCorte").on("click", ".btnVisualizarOC", function () {

	var codigoOC = $(this).attr("codigo");
    //console.log("codigoOC", codigoOC);
    
    var datos = new FormData();
	datos.append("codigoOC", codigoOC);

	$.ajax({

		url:"ajax/ordencorte.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log("respuesta", respuesta);

            $("#ordencorte").val(respuesta["codigo"]);
            $("#fecha").val(respuesta["fecha"]);
            $("#configuracion").val(respuesta["configuracion"]);
            $("#nombre").val(respuesta["nombre"]);
            $("#cantidad").val(respuesta["total"]);
            $("#saldo").val(respuesta["saldo"]);
            $("#estado").val(respuesta["estado"]);

            $("#cantidad").number(true, 0);
            $("#saldo").number(true, 0);
			
		}

    })
    
    var codigoDOC = $(this).attr("codigo");	
    //console.log("codigoDOC", codigoDOC);

    var datosDOC = new FormData();
    datosDOC.append("codigoDOC", codigoDOC);
    
    $.ajax({

		url:"ajax/ordencorte.ajax.php",
		method: "POST",
		data: datosDOC,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

			//console.log("respuestaDetalle", respuestaDetalle);

            $(".detalleMP").remove();
            
			for(var id of respuestaDetalle){

                if(id.t1 > 0){

                    var t1 = id.t1;
                }else

                    var t1 = "";

                if(id.t2 > 0){

                    var t2 = id.t2;
                }else

                    var t2 = "";
                    
                if(id.t3 > 0){

                    var t3 = id.t3;
                }else

                    var t3 = "";
                    
                if(id.t4 > 0){

                    var t4 = id.t4;
                }else

                    var t4 = "";    
                    
                if(id.t5 > 0){

                    var t5 = id.t5;
                }else

                    var t5 = "";
                    
                if(id.t6 > 0){

                    var t6 = id.t6;
                }else

                    var t6 = "";
                    
                if(id.t7 > 0){

                    var t7 = id.t7;
                }else

                    var t7 = "";
                    
                if(id.t8 > 0){

                    var t8 = id.t8;
                }else

                    var t8 = "";                    

				$('.tablaDetalleOC').append(

					'<tr class="detalleMP">' +
						'<td>' + id.ordencorte + ' </td>' +
						'<td><b>' + id.modelo + ' </b></td>' +
						'<td>' + id.nombre + ' </td>' +
						'<td>' + id.color + ' </td>' +
						'<td><b>' + t1 + ' </b></td>' +
						'<td><b>' + t2 + ' </b></td>' +
						'<td><b>' + t3 + ' </b></td>' +
                        '<td><b>' + t4 + ' </b></td>' +
                        '<td><b>' + t5 + ' </b></td>' +
                        '<td><b>' + t6 + ' </b></td>' +
                        '<td><b>' + t7 + ' </b></td>' +
                        '<td><b>' + t8 + ' </b></td>' +
					'</tr>'

				)

			}            

		}

	})
  
})


/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaOrdenCorte").on("click", ".btnReporteOC", function () {

    var codigo = $(this).attr("codigo");
    console.log("codigo", codigo);

    window.location = "vistas/reportes_excel/rpt_ordencorte.php?codigo=" + codigo;
  
})