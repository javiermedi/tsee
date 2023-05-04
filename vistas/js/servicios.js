$('.tablaPser').DataTable( {
    "ajax": "ajax/datatable-servicio-produc.ajax.php",
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

});


/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaPser tbody").on("click", "button.agregarProductoS", function(){

  var idProducto = $(this).attr("idProducto");


  $(this).removeClass("btn-info agregarProductoS");

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

          $("button[idProducto='"+idProducto+"']").addClass("btn-info agregarProductoS");

          return;

            }

            $(".nuevoProductoSer").append(

            '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del producto -->'+
            
            '<div class="col-xs-6" style="padding-right:0px">'+
            
              '<div class="input-group">'+
                
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-trash"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProductoS" value="'+descripcion+'" readonly required>'+

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

          sumarTotalPreciosSer()

          sumarTotalDelServicio()



          // AGREGAR IMPUESTO

    /*      agregarImpuestoSer()
*/
          // AGRUPAR PRODUCTOS EN FORMATO JSON

          listarProductosSer()

          // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

          //$(".nuevoPrecioProducto").number(true, 2);

        }

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPser").on("draw.dt", function(){

  if(localStorage.getItem("quitarProducto") != null){

    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for(var i = 0; i < listaIdProductos.length; i++){

      $("button.recuperarBotonS[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
      $("button.recuperarBotonS[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-info agregarProductoS');

    }


  }


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioServi").on("click", "button.quitarProducto", function(){

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

  $("button.recuperarBotonS[idProducto='"+idProducto+"']").removeClass('btn-default');

  $("button.recuperarBotonS[idProducto='"+idProducto+"']").addClass('btn-info agregarProductoS');

  if($(".nuevoProductoSer").children().length == 0){
   
    if ($(".nuevoServicios").children().length == 0) {
   
    $("#nuevoImpuestoSer").val(0);
    $("#TotalProductoS").val(0);
    $("#totalVenta").val(0);
    $("#TotalProductoS").attr("total",0);
    $("#nuevoTotalSer").val(0);
   
    sumarTotalDelServicio()

    }else{

     sumarTotalDelServicio()
    $("#TotalProductoS").val(0);
    $("#totalVenta").val(0);
    $("#TotalProductoS").attr("total",0);
   
    }
    
    $("#nuevoTotalSer").val($("#TotalServicios").val());

  }else { 

    // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosSer()

      sumarTotalDelServicio()

      // AGREGAR IMPUESTO
          
  /*      agregarImpuestoSer()
*/
        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosSer()

  }

})


//CAMBIAR SELECT
$(".formularioServi").on("change", "select.nuevoPrecioProduc", function(){

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

$(".formularioServi").on("change", "select.nuevaDescripcionProducto", function(){

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

          listarProductosSer()

        }

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioServi").on("change", "input.nuevaCantidadProducto", function(){

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

    sumarTotalPreciosSer();
    sumarTotalDelServicio()
    swal({
        title: "La cantidad supera la Cantidad",
        text: "¡Sólo hay "+$(this).attr("stock")+" disponibles!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

      return;

  }

  // SUMAR TOTAL DE PRECIOS

  sumarTotalPreciosSer()

  sumarTotalDelServicio()



  // AGREGAR IMPUESTO
          
/*    agregarImpuestoSer()
*/
    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosSer()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosSer(){

  var precioItem = $(".nuevoPrecioProducto");
  var arraySumaPrecio = [];   

  for(var i = 0; i < precioItem.length; i++){

     arraySumaPrecio.push(Number($(precioItem[i]).val()));
     
  }

  function sumaArrayPrecios(total, numero){

    return total + numero;

  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
  $("#TotalProductoS").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#TotalProductoS").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

/*function agregarImpuestoSer(){

  var impuesto = $("#nuevoImpuestoSer").val();
  var precioTotal = $("#TotalProductoS").attr("total");

  var precioImpuesto = Number(precioTotal * impuesto/100);

  var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
  
  $("#TotalProductoS").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  $("#nuevoImpuestoSer").val(precioImpuesto);

  $("#nuevoPrecioNetoSer").val(precioTotal);

}

*//*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

/*$("#nuevoImpuestoSer").change(function(){

  agregarImpuestoSer();

});

*/
/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioServi").on("change", "input#nuevoEfectivoSer", function(){

  var efectivo = $(this).val();

  var cambio =  Number(efectivo) - Number($('#nuevoTotalSer').val());

  var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#CambioEfectivoSer').children().children('#nuevoCambioSer');

  nuevoCambioEfectivo.val(cambio);
  
  $("#nuevoEfectivoSer").val(efectivo);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioServi").on("change", "input#nuevoCodigoTransaccion", function(){

  // Listar método en la entrada
     listarMetodos()


})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosSer(){

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

  $("#listaProducS").val(JSON.stringify(listaProductos));
  
}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idProductos = $(".quitarProducto");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaPser tbody button.agregarProductoS");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for(var i = 0; i < idProductos.length; i++){

    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idProductos[i]).attr("idProducto");
    
    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for(var j = 0; j < botonesTabla.length; j ++){

      if($(botonesTabla[j]).attr("idProducto") == boton){

        $(botonesTabla[j]).removeClass("btn-info agregarProductoS");
        $(botonesTabla[j]).addClass("btn-default");

      }
    }

  }
  
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaPser').on( 'draw.dt', function(){

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



/*====================================================================================
=            JAVASCRIPT PARA AGREGAR SERVICOS EN LA VISTA CREAR SERVICIOS            =
====================================================================================*/
$('.tablaServicio').DataTable( {
    "ajax": "ajax/datatable-servicio.ajax.php",
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

});

/*=============================================================================
=            AGREGAR SERVICIOS A LA VISTA SERVICIOS DESDE LA TABLA            =
=============================================================================*/

$(".tablaServicio tbody").on("click", "button.agregarServisio", function(){

  var idService = $(this).attr("idService");

  $(this).removeClass("btn-info agregarServisio");

  $(this).addClass("btn-default");
 
  var datos = new FormData();
  datos.append("idService", idService);

  $.ajax({

      url:"ajax/service.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        var nombre = respuesta["nombre"];
        var costo = respuesta["costo"];
        
        $(".nuevoServicios").append(

          '<div class="row" style="padding:5px 15px">'+

              '<!-- Nombre del servicio -->'+
            
              '<div class="col-xs-6" style="padding-right:0px">'+
            
                '<div class="input-group">'+
                  
                  '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idService="'+idService+'"><i class="fa fa-trash"></i></button></span>'+

                  '<input type="text" class="form-control nuevoNombreServicio" idService="'+idService+'" name="agregarServisio" value="'+nombre+'" readonly required>'+

                '</div>'+

              '</div>'+

              '<!-- Precio del servicio -->'+

              '<div class="col-xs-2 Prec">'+
              
              '<div class="input-group">'+
              
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

                '<input type="number" class="form-control nuevoPrecioServ" name="nuevoPrecioServ" value="'+costo+'" readonly>'+ 

              '</div>'+

            '</div>'+
            
          '</div>')
      
      sumarTotalPrecioServicio()
      sumarTotalDelServicio()
      listaServicoss()


      }

  })

});

/*==================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
====================================================*/

$(".tablaServicio").on("draw.dt", function(){

  if(localStorage.getItem("quitarServicio") != null){

    var listaIdServicio = JSON.parse(localStorage.getItem("quitarServicio"));

    for(var i = 0; i < listaIdServicio.length; i++){

      $("button.recuperarBotonServicio[idService='"+listaIdServicio[i]["idService"]+"']").removeClass('btn-default');
      $("button.recuperarBotonServicio[idService='"+listaIdServicio[i]["idService"]+"']").addClass('btn-info agregarServisio');

    }


  }


})

/*=============================================
QUITAR SERVICIOS Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioServi").on("click", "button.quitarServicio", function(){

  $(this).parent().parent().parent().parent().remove();

  var idService = $(this).attr("idService");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if(localStorage.getItem("quitarServicio") == null){

    idQuitarServicio = [];
  
  }else{

    idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

  }

  idQuitarServicio.push({"idService":idService});
  

  localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));

  $("button.recuperarBotonServicio[idService='"+idService+"']").removeClass('btn-default');

  $("button.recuperarBotonServicio[idService='"+idService+"']").addClass('btn-info agregarServisio');

if($(".nuevoServicios").children().length == 0 ){
    
   if ($(".nuevoProductoSer").children().length == 0 && $(".nuevoServicios").children().length == 0) {      
      
    $("#nuevoImpuestoVenta").val(0);
    $("#TotalServicios").val(0);
    $("#totalVenta").val(0);
    $("#TotalServicios").attr("total",0);
    $("#nuevoTotalSer").val(0);

      sumarTotalDelServicio()
    
    }else{
    
      sumarTotalDelServicio()
    $("#nuevoImpuestoVenta").val(0);
    $("#TotalServicios").val(0);
    $("#totalVenta").val(0);
    $("#TotalServicios").attr("total",0);

    }
    $("#nuevoTotalSer").val($("#TotalProductoS").val());  
    swal({
        title: "Servico vacio",
        text: "¡Para poder realizar la Orden, debe agregar un servicio!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

      return;

  }else{

    sumarTotalPrecioServicio()
    sumarTotalDelServicio()
    listaServicoss()

  }
    
})

function sumarTotalPrecioServicio(){

  var precioItem = $(".nuevoPrecioServ");
  var arraySumaPrecioServicio = [];   

  for(var i = 0; i < precioItem.length; i++){

     arraySumaPrecioServicio.push(Number($(precioItem[i]).val()));
     
  }

  function sumaArrayPreciosServicios(total, numero){

    return total + numero;

  }

  var sumaTotalPrecioServicios = arraySumaPrecioServicio.reduce(sumaArrayPreciosServicios);
  
  $("#TotalServicios").val(sumaTotalPrecioServicios);
  $("#totalVenta").val(sumaTotalPrecioServicios);
  $("#TotalServicios").attr("total",sumaTotalPrecioServicios);

}

function sumarTotalDelServicio(){

  var servi = $("#TotalServicios").val();
  var produc = $("#TotalProductoS").val();


  var totalF = Number(servi) + Number(produc);

  $("#nuevoTotalSer").val(totalF);

}

/*=============================================
LISTAR TODOS SERVICIOS
=============================================*/
function listaServicoss(){

  var listaDeServicios = [];

  var nombre =  $(".nuevoNombreServicio");

  var precio = $(".nuevoPrecioServ");

  for(var i = 0; i < nombre.length; i++){

    listaDeServicios.push({
      "id" : $(nombre[i]).attr("idService"),
      "nombre" : $(nombre[i]).val(),
      "precio" : $(precio[i]).val(),
    },)
  }
    $("#listaServicio").val(JSON.stringify(listaDeServicios));
    
}

/*===============================================================
=            VERIFICAR QUE LISTA SERVICIO ESTE VACIA            =
===============================================================*/


$(".formularioServi").on("click", "button.guardarOrdenServi", function(){

if($(".nuevoServicios").children().length == 0 ){
 swal({
        type: "error",
        title: "Servico vacio",
        text: "¡Para poder realizar la Orden, debe agregar un servicio!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

      }).then(function(result){

        if(result.value){
        
          window.location = "realizar-servicio";

        }

    });
  }
})

$(document).on("click", ".btnEditarOrdenServicio", function(){

 var idOrdenSer = $(this).attr("idOrdenSer");
 
 window.location = "index.php?ruta=editar-orden-ser&idOrdenSer="+idOrdenSer;


});

/*=================================================
=             Eliminar Orden Servicio             =
=================================================*/

$(".tablasOrden").on("click", ".btnEliminarOrdenServicio", function(){

  var idOrdenServicio = $(this).attr("idOrdenServicio");
 Swal.fire({
        title: '¿Está seguro de borrar el servicio?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar servicio!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=orden-servicio&idOrdenServicio="+idOrdenServicio;
        }

  })

})


/*=================================================
=             IMPRIMIR FACTURA ORDEN SERVICIO     =
=================================================*/

$(".tablasOrden").on("click", ".btnImprimirFacturaOrdenServicio", function(){

  var codigo = $(this).attr("codigo");
 
  window.open("extensiones/tcpdf/pdf/factura-servicio.php?codigo="+codigo, "_blank");

})

/*=================================================
=             IMPRIMIR TICKET ORDEN SERVICIO     =
=================================================*/

$(".tablasOrden").on("click", ".btnTicketOrdenServicio", function(){


  var codigo = $(this).attr("codigo");
            
  window.open("extensiones/tcpdf/pdf/factura-servi.php?codigo="+codigo, "_blank");

})
