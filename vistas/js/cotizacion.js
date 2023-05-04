/*=============================================
VARIABLE LOCAL STORANGE
=============================================

if (localStorage.getItem("capturarRango") != null) {

	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

}else{

	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');	

}*/

/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$('.tablaPCotiza').DataTable( {
    "ajax": "ajax/datatable-cotizacion.ajax.php",
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
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaPCotiza tbody").on("click", "button.agregarProductoC", function(){

	var idProducto = $(this).attr("idProducto");
	console.log("idProducto", idProducto);

	$(this).removeClass("btn-info agregarProductoC");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];
          	var precioDos = respuesta["precio_ventaa"];
          	var precioTres = respuesta["precio_ventaaa"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-info agregarProductoC");

			    return;

          	}

          	$(".nuevoProductoCot").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-trash"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProductoC" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+


	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-2 ingresoPrec">'+
              
              '<div class="input-group">'+
              
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

                '<select class="form-control nuevoPrecioProduc" name="nuevoPrecioProduc" required>'+

                  '<option value="'+precio+'">'+precio+'</option>'+

                  '<option value="'+precioDos+'">'+precioDos+'</option>'+

                  '<option value="'+precioTres+'">'+precioTres+'</option>'+

                '</select>'+

              '</div>'+

            '</div>'+
	          

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-2 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0.5" value="0" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" step="any" required>'+

	          '</div>' +

	          


            '<!-- Precio Final del producto -->'+

	          '<div class="col-xs-2 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" value="" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+
	          
	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPreciosCot()

	        // AGREGAR IMPUESTO

	        agregarImpuestoCot()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductosCot()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        //$(".nuevoPrecioProducto").number(true, 2);

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPCotiza").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBotonC[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBotonC[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-info agregarProductoC');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioCotiz").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBotonC[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBotonC[idProducto='"+idProducto+"']").addClass('btn-info agregarProductoC');

	if($(".nuevoProductoCot").children().length == 0){

		$("#nuevoImpuestoCot").val(0);
		$("#nuevoTotalCoti").val(0);
		$("#nuevoTotalCoti").val(0);
		$("#nuevoTotalCoti").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosCot()

    	// AGREGAR IMPUESTO
	        
        agregarImpuestoCot()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosCot()

	}

})


//CAMBIAR SELECT
$(".formularioCotiz").on("change", "select.nuevoPrecioProduc", function(){

	var prec = $(this).val();
	
	var txt = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	txt.val(prec);
	//alert("si detecta el click: "+txt.val());
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var total = nuevaCantidadProducto.val()*prec;
	//alert("total: "+total);
	txt.val(total);
})


/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioCotiz").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductosCot()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCotiz").on("change", "input.nuevaCantidadProducto", function(){

	var prec = $(this).parent().parent().children(".ingresoPrec").children().children(".nuevoPrecioProduc");
	
	var txt = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	
	var nuevaCantidadProducto = $(this);

	var total = nuevaCantidadProducto.val()*prec.val();
	
	txt.val(total);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var total = nuevaCantidadProducto.val()*prec.val();
	
		txt.val(total);

		sumarTotalPreciosCot();

		swal({
	      title: "La cantidad supera la Cantidad",
	      text: "¡Sólo hay "+$(this).attr("stock")+" disponibles!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosCot()

	// AGREGAR IMPUESTO
	        
    agregarImpuestoCot()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosCot()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosCot(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];   

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalCoti").val(sumaTotalPrecio);
	$("#nuevoTotalCoti").val(sumaTotalPrecio);
	$("#nuevoTotalCoti").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuestoCot(){

	var impuesto = $("#nuevoImpuestoCot").val();
	var precioTotal = $("#nuevoTotalCoti").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalCoti").val(totalConImpuesto);

	$("#nuevoTotalCoti").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNetoCot").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoCot").change(function(){

	agregarImpuestoCot();

});


/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioCotiz").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalCoti').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);
	
	$("#nuevoValorEfectivo").val(efectivo);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioCotiz").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosCot(){

	var listaProductos = [];

	var listaProduc = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProduc");

	var total = $(".nuevoPrecioProducto");
	//var sucursal = $("#nuevaSucursal");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).val(),
							  "total" : $(total[i]).val()},)

	}

	$("#listaProduct").val(JSON.stringify(listaProductos));
	
}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaPCotiza tbody button.agregarProductoC");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-info agregarProductoC");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaPCotiza').on( 'draw.dt', function(){

	quitarAgregarProducto();

})



/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarCot", function(){

  var idCot = $(this).attr("idCot");

  swal({
        title: '¿Está seguro de borrar la cotización?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar cotización!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cotizacion&idCot="+idCot;
            
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnCot", function(){

	var idCot = $(this).attr("idCot");
						
	window.open("extensiones/tcpdf/pdf/cotizacion.php?id="+idCot, "_blank");

})


/*=============================================
RANGO DE FECHAS DE CALENDARIO
=============================================*/

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Los últimos 7 días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
          'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
          'El mes pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

        var fechaInicial = start.format('YYYY-MM-DD');
        
        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn span").html();

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

      }
    )

/*=============================================
CANCELAR RANGO DE FECHAS DE CALENDARIO
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";

})


/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})




