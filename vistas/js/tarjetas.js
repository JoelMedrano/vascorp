/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

/* $.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

}) */

/* no tocar */

$('.tablaTarjetas').DataTable( {
    "ajax": "ajax/datatable-tarjetas.ajax.php",
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

/* no tocar */


$('.tablaMateriaPrimaTarjetas').DataTable( {
    "ajax": "ajax/datatable-materiaprimaTarjetas.ajax.php",
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
AGREGANDO MATERIA PRIMA A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaMateriaPrimaTarjetas tbody").on("click", "button.agregarMP", function () {

	var idMateriaPrima = $(this).attr("idMateriaPrima");
  
	/* console.log("idMateriaPrima", idMateriaPrima); */
  
	$(this).removeClass("btn-primary agregarMP");
  
	$(this).addClass("btn-default");
  
  
	var datos = new FormData();
	datos.append("idMateriaPrima", idMateriaPrima);
  
	$.ajax({
  
	  url: "ajax/materiaprima.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
	  contentType: false,
	  processData: false,
	  dataType: "json",
	  success: function (respuesta) {
  
/* 		console.log("respuesta", respuesta); */

		var codigo=respuesta["Codpro"];
		var descripcion = respuesta["descripcion"];
		var stock = respuesta["CodAlm01"];
		var precio = respuesta["cospro"];

/* 		console.log("codigo",codigo);
		console.log("descripcion",descripcion);
		console.log("stock",stock);
		console.log("precio",precio); */

		/* agregar campos */

		$(".nuevaMateriaPrima").append(

			'<div class="row" style="padding:5px 15px">' +
	
			'<!-- Descripción del producto -->' +
	
			'<div class="col-xs-7" style="padding-right:0px">' +
	
			'<div class="input-group">' +
	
			'<span class="input-group-addon input-sm"><button type="button" class="btn btn-danger btn-xs quitarMP" idMateriaPrima="' + idMateriaPrima + '"><i class="fa fa-times"></i></button></span>' +
	
			'<input type="text" class="form-control input-sm nuevaDescripcionProducto" idMateriaPrima="' + idMateriaPrima + '" name="agregarMP" value="' + descripcion + '" codigoP="'+codigo+'" readonly required>' +
	
			'</div>' +
	
			'</div>' +
	
			'<!-- Cantidad del producto -->' +
	
			'<div class="col-xs-2">' +
	
			'<input type="number" class="form-control input-sm nuevaCantidadProducto" name="nuevaCantidadProducto" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
	
			'</div>' +
	
			'<!-- Precio del producto -->' +
	
			'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
	
			'<div class="input-group">' +
	
			'<span class="input-group-addon"><i class="fa fa-money"></i></span>' +
	
			'<input type="text" class="form-control input-sm nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto" value="' + precio + '" readonly required>' +
	
			'</div>' +
	
			'</div>' +
	
			'</div>');
  
			/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */

			sumarTotalPreciosT();

			$(".nuevoPrecioProducto").number(true, 6);

			agregarImpuestoT();

			listarMP();

  
	  }


  
	})
  
  });

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaMateriaPrimaTarjetas").on("draw.dt", function () {

	/* console.log("tabla"); */
  
	if (localStorage.getItem("quitarMP") != null) {
  
	  var listaIdMateriaPrima = JSON.parse(localStorage.getItem("quitarMP"));
  
	  for (var i = 0; i < listaIdMateriaPrima.length; i++) {
  
		$("button.recuperarBoton[idMateriaPrima='" + listaIdMateriaPrima[i]["idMateriaPrima"] + "']").removeClass('btn-default');

		$("button.recuperarBoton[idMateriaPrima='" + listaIdMateriaPrima[i]["idMateriaPrima"] + "']").addClass('btn-primary agregarMP');
  
	  }
  
  
	}
  
  })

/*=============================================
QUITAR MATERIA PRIMA DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarMateriaPrima = [];

localStorage.removeItem("quitarMP");

$(".formularioMateriaPrima").on("click", "button.quitarMP", function () {

  /* console.log("boton"); */

  $(this).parent().parent().parent().parent().remove();

  var idMateriaPrima = $(this).attr("idMateriaPrima");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMP") == null) {

    idQuitarMateriaPrima = [];

  } else {

    idQuitarMateriaPrima.concat(localStorage.getItem("quitarMP"))

  }

  idQuitarMateriaPrima.push({
    "idMateriaPrima": idMateriaPrima
  });

  localStorage.setItem("quitarMP", JSON.stringify(idQuitarMateriaPrima));

  $("button.recuperarBoton[idMateriaPrima='" + idMateriaPrima + "']").removeClass('btn-default');

  $("button.recuperarBoton[idMateriaPrima='" + idMateriaPrima + "']").addClass('btn-primary agregarMP');


  if ($(".nuevaMateriaPrima").children().length == 0) {

    $("#nuevoImpuestoTarjeta").val(0);
    $("#nuevoTotalTarjeta").val(0);
    $("#totalTarjeta").val(0);
    $("#nuevoTotalTarjeta").attr("total", 0);

  } else {

/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */


	sumarTotalPreciosT();

	agregarImpuestoT();

	listarMP();

  }

})


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioMateriaPrima").on("change", "input.nuevaCantidadProducto", function () {

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  
	/* console.log("precio", precio.val()); */
  
	var precioFinal = $(this).val() * precio.attr("precioReal");
  
  
	precio.val(precioFinal);


	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);
  
  
/* AQUI AGREGAR SUMARTOTALPRECIOST - AGREGAR IMPUESTOS - LISTAR PRODUCTOS */

	sumarTotalPreciosT();

	agregarImpuestoT();
	
	listarMP();
  
  })

  
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosT() {

	var precioItem = $(".nuevoPrecioProducto");
  
	var arraySumaPrecioT = [];
  
	for (var i = 0; i < precioItem.length; i++) {
  
	  arraySumaPrecioT.push(Number($(precioItem[i]).val()));
  
  
	}
  
	  /* console.log("arraySumaPrecioT", arraySumaPrecioT); */
  
	function sumaArrayPrecios(total, numero) {
  
	  return total + numero;
  
	}
  
	var sumaTotalPrecio = arraySumaPrecioT.reduce(sumaArrayPrecios);
  
	  /* console.log("sumaTotalPrecio", sumaTotalPrecio); */
  
	$("#nuevoTotalTarjeta").val(sumaTotalPrecio);
		$("#totalTarjeta").val(sumaTotalPrecio);
	$("#nuevoTotalTarjeta").attr("total", sumaTotalPrecio);
  
  
  }

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoT() {

	var impuesto = $("#nuevoImpuestoTarjeta").val();
	var precioTotal = $("#nuevoTotalTarjeta").attr("total");
  
	var precioImpuesto = Number(precioTotal * impuesto / 100);
  
	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
  
	$("#nuevoTotalTarjeta").val(totalConImpuesto);
  
	$("#totalTarjeta").val(totalConImpuesto);
  
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
  
	$("#nuevoPrecioNeto").val(precioTotal);
  
  }
  
  /*=============================================
  CUANDO CAMBIA EL IMPUESTO
  =============================================*/
  
  $("#nuevoImpuestoTarjeta").change(function () {
  
	agregarImpuestoT();
  
  });

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalTarjeta").number(true, 6);


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/


function listarMP() {

	var listaMP = [];

	var descripcion = $(".nuevaDescripcionProducto");
  
	var cantidad = $(".nuevaCantidadProducto");
  
	var precio = $(".nuevoPrecioProducto");
  
	for (var i = 0; i < descripcion.length; i++) {
  
	  listaMP.push({
		"id": $(descripcion[i]).attr("idMateriaPrima"),
		"codigo":$(descripcion[i]).attr("codigoP"),
		"descripcion": $(descripcion[i]).val(),
		"cantidad": $(cantidad[i]).val(),
		"precio": $(precio[i]).attr("precioReal"),
		"total": $(precio[i]).val()
	  })
  
	}
  
	/* 
	! comentar luego de prubas
	*/
	/* console.log("listaMP", JSON.stringify(listaMP)); */
  
	$("#listaMP").val(JSON.stringify(listaMP));
  
  }

/*=============================================
BOTON EDITAR TARJETA
=============================================*/
$(".tablaTarjetas").on("click", ".btnEditarTarjeta", function () {

	var idTarjeta = $(this).attr("idTarjeta");

  window.location = "index.php?ruta=editar-tarjeta&idTarjeta=" + idTarjeta;
  
})

// Formato para los números en las cajas
$(".nuevoPrecioProducto").number(true,6);
$("#totalTarjeta").number(true,6);


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProductoT() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idMateriaPrima = $(".quitarMP");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTablaT = $(".tablaMateriaPrimaTarjetas tbody button.agregarMP");

	//Recorremos en un ciclo para obtener los diferentes idMateriaPrima que fueron agregados a la venta
	for (var i = 0; i < idMateriaPrima.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idMateriaPrima[i]).attr("idMateriaPrima");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaT.length; j++) {

			if ($(botonesTablaT[j]).attr("idMateriaPrima") == boton) {

				$(botonesTablaT[j]).removeClass("btn-primary agregarMP");
				$(botonesTablaT[j]).addClass("btn-default");

			}
		}

	}

}


/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaMateriaPrimaTarjetas').on('draw.dt', function () {

	quitarAgregarProductoT();

})

/*=============================================
BORRAR TARJETA
=============================================*/
$(".tablaTarjetas").on("click", ".btnEliminarTarjeta", function () {

	var idTarjeta = $(this).attr("idTarjeta");

	swal({
		type: "warning",
		title: "Advertencia",
		text: "¿Está seguro de eliminar la Tarjeta? ¡Si no está seguro, puede cancelar la acción!",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: "¡Si, eliminar Tarjeta!",
		cancelButtonText: "Cancelar",
	}).then(function (result) {
		if (result.value) {
			var datos = new FormData();
			datos.append("idTarjeta", idTarjeta);
			$.ajax({
				url: "ajax/tarjetas.ajax.php",
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
								window.location = "tarjetas";
							}
						});
					}
				}
			});
		}
	});

})