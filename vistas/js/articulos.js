/*=============================================
CARGAR LA TABLA DINÁMICA DE ARTICULOS
=============================================*/

$.ajax({

    url: "ajax/datatable-articulos.ajax.php",
    success: function (respuesta) {

        console.log("respuesta", respuesta);

    }

})


$('.tablaArticulos').DataTable( {
    "ajax": "ajax/datatable-articulos.ajax.php"

} );