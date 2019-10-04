/*=============================================
EDITAR COLOR
=============================================*/
$(".tablas").on("click", ".btnEditarColor", function () {

    var idColor = $(this).attr("idColor");

    var datos = new FormData();
    datos.append("idColor", idColor);

    $.ajax({

        url: "ajax/colores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idColor").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["cod_color"]);
            $("#editarColor").val(respuesta["nom_color"]);

        }

    })

})


/*=============================================
ELIMINAR COLOR
=============================================*/
$(".tablas").on("click", ".btnEliminarColor", function(){

	var idColor = $(this).attr("idColor");
	
	swal({
        title: '¿Está seguro de borrar el color?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar color!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=colores&idColor="+idColor;
        }

  })

})