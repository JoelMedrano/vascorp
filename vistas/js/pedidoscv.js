/* 
* cargamos la tabla para articulos en pedidos
*/
$(".tablaArticulosPedidos").DataTable({
    ajax: "ajax/tabla-pedidos.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/* 
* VISUALIZAR DETALLE DE ARTICULOS QUE LLEVAN ESA MATERIA PRIMA
*/
$(".tablaArticulosPedidos").on("click", ".agregarArtPed", function () {

    var cliente = document.getElementById("seleccionarCliente").value;
    var vendedor = document.getElementById("seleccionarVendedor").value;

    //console.log(cliente);
    $("#cliente").val(cliente);
    $("#vendedor").val(vendedor);

    /* 
    *datos para la cabecera
    */
    var mod = $(this).attr("modelo");
    //console.log(mod);

    var datos = new FormData();
    datos.append("mod", mod);
    
    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDet){

            //console.log(respuestaDet);

            $("#precio").val(respuestaDet["precio_venta"]);

		}

	})
    


    /* 
    * datos para la tabla
    */

    var modelo = $(this).attr("modelo");
        
	var datosColor = new FormData();
	datosColor.append("modelo", modelo);

	$.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datosColor,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){ 

            //console.log("respuesta", respuesta);

            $("#modeloModal").val(modelo);
           
            $(".detalleCT").remove();

			for(var id of respuesta){

                /* TALLA 1 */
                if(id.t1 == 1){

                    var talla1 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" value=0 min="0"></td>'

                }else{

                    var talla1 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" readonly></td>'

                }

                /* TALLA 2 */                
                if(id.t2 == 1){

                    var talla2 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla2 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" readonly></td>'

                }
                
                /* TALLA 3 */                
                if(id.t3 == 1){

                    var talla3 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla3 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" readonly></td>'

                }  
                
                /* TALLA 4 */                
                if(id.t4 == 1){

                    var talla4 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla4 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" readonly></td>'

                }  
                
                /* TALLA 5 */                
                if(id.t5 == 1){

                    var talla5 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla5 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" readonly></td>'

                }  
                
                /* TALLA 6 */                
                if(id.t6 == 1){

                    var talla6 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla6 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" readonly></td>'

                }  
                
                /* TALLA 7*/        
                if(id.t7 == 1){

                    var talla7 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla7 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" readonly></td>'

                }  
                
                /* TALLA 8 */                
                if(id.t8 == 1){

                    var talla8 = '<td><input style="width:100%" class="cantidad" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'" value=0 min="0"></td>'

                }else{
                    
                    var talla8 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'" readonly></td>'

                }                  

                var fila ='<tr class="detalleCT">' +
                                '<td>' + id.modelo + ' </td>' +
                                '<td>' + id.color + ' </td>' +
                                talla1 +
                                talla2 +
                                talla3 +
                                talla4 +
                                talla5 +
                                talla6 +
                                talla7 +
                                talla8 +
                                
                            '</tr>' 

                              
				$('.tablaColTal').append(

                    fila


                )

			}


		}

    })
    
  
})

/* 
* BOTON ACTUALIZAR
*/
$(".btnCrearPedido").click(function () {

    var pedido = $(this).attr("pedido");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;

})


$(".btnCalCant").click(function () {

    var totalCantidad=0;
    $(".prueba").each(function(){

        totalCantidad+=parseInt($(this).val()) || 0;     
    
    });

    var precio=document.getElementById("precio").value;

    var totalSoles = (totalCantidad * precio)

    

    $("#totalCantidad").val(totalCantidad);
    
    $("#totalSoles").val(totalSoles);
    $("#totalSoles").number(true, 2);

    //console.log(totalSoles);
    //console.log(totalCantidad);
    

})




