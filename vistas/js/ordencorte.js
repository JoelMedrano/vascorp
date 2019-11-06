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