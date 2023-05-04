/*=============================================
EDITAR SERVICIO
=============================================*/

$(".tablas").on("click", ".btnEditarServicio", function(){

  var idservicio = $(this).attr("idservicio");

  var datos = new FormData();
  datos.append("idservicio", idservicio);

  $.ajax({
      url: "ajax/servicio.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#editarServicio").val(respuesta["nombre"]);
        $("#EditarVelocidad").val(respuesta["intensidad"]);
        $("#editarPrecio").val(respuesta["precio"]);
        $("#idServicio").val(respuesta["idservicio"]);

      }

  })

})



/*=============================================
ELIMINAR SERVICIO
=============================================*/
$(".tablas").on("click", ".btnEliminarServicio", function(){

   var idservicio = $(this).attr("idservicio");

   swal({
    title: '¿Está seguro de borrar el servicio?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar servicio!'
   }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=servicios&idservicio="+idservicio;

    }

   })

})
