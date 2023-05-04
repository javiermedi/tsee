<?php

class ControladorCotiz{


        /* ======================================== 
                    MOSTRAR COTIZACIONES
        ========================================*/

    static public function ctrMostrarCotiz($item, $valor){

        $tabla = "cotizacion";

        $respuesta = ModeloCotiz::MdlMostrarCotiz($tabla, $item, $valor);

        return $respuesta;
    }

        /* ======================================== 
                    CREAR COTIZACIONES
        ========================================*/

    static public function ctrCrearCotixacion(){

      if (isset($_POST["CodCot"])) {
        
          $tabla = "cotizacion";

          $datos = array("remitente"=>$_POST["nuevoRemiten"],
                         "codigo"=>$_POST["CodCot"], 
                         "cliente"=>$_POST["selecCliente"],
                         "productos"=>$_POST["listaProduct"],
                         "comentarios"=>$_POST["NuevocomentarioCot"],
                         "descuento"=>$_POST["nuevoImpuestoCot"],
                         "neto"=>$_POST["nuevoPrecioNetoCot"],
                         "sucursal"=>$_POST["SucursalCot"],
                         "total"=>$_POST["nuevoTotalCoti"]);

          $respuesta = ModeloCotiz::mdlCrearCotiz($tabla, $datos);

          if ($respuesta == "ok") {
              
              echo'<script>

                swal({
                    type: "success",
                    title: "La cotización ha sido guardada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {

                        window.location = "cotizacion";

                        }
                      })

                </script>';

          } 

      }


    }

        /* ======================================== 
                      BORRAR COTIZACIONES
        ========================================*/

  static public function ctrBrorrarCotiz(){

    if (isset($_GET["idCot"])) {
      
        $tabla = "cotizacion";
        $dato = $_GET["idCot"];

        $respuesta = ModeloCotiz::mdlBorrarCotiz($tabla, $dato);

        if ($respuesta == "ok") {
          
          echo'<script>

                swal({
                    type: "success",
                    title: "¡La cotización a sido borrada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {

                        window.location = "cotizacion";

                        }
                      })

                </script>';

        }

    }

  }




}