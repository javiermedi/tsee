<?php

class ControladorClientesI{
	/*--=====================================
        CREAR CLIENTES
  ======================================-->*/

  	static public function ctrCrearClienteI(){
  
  		if (isset($_POST["nuevClientI"])) {
  			
  			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevClientI"]) &&
  				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevTelClientI"]) &&
  				preg_match('/^[#\.,\/-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccionI"])){
  				
  				$tabla = "clientes";

  				$datos =  array("nombre"=>$_POST["nuevClientI"],
								"telefono"=>$_POST["nuevTelClientI"],
								"direccion"=>$_POST["nuevaDireccionI"],
								"rfc"=>$_POST["nuevoRFCI"],
								"cfdi"=>$_POST["nuevoCFDII"],
								"servicio"=>$_POST["nuevoServicioI"],
								"contratacion"=>$_POST["nuevaFechaCont"],
								"mensualidad"=>$_POST["nuevaFechaMes"]);

  				$respuesta = ModeloClientesI::mdlIngresarClienteI($tabla, $datos);

  				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El cliente fue agregado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientes-internet";

						}

					})
				

					</script>';

				} 

  			} else {
  					echo '<script>

					swal({

						type: "error",
						title: "¡ EL cliente no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes-internet";

						}

					})
				

					</script>';
  			}

  		}
  	}
	/*--=====================================
        MOSTRAR CLIENTES
  ======================================-->*/  	
  static public function ctrMostrarClientesI($item, $valor){

  	$tabla = "clientes";

  	$respuesta = ModeloClientesI::mdlMostrarClientesI($tabla, $item, $valor);

  	return $respuesta;

  }

  /*=====================================
    EDITAR CLIENTE
  ======================================*/
    static public function ctrEditarClienteI(){

    	if (isset($_POST["editaClientI"])) {
  			
  			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaClientI"]) &&
  				preg_match('/^[()\-0-9 ]+$/', $_POST["editaTelClientI"]) &&
  				preg_match('/^[#\.,\/-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaDireccionI"])){
  				
  				$tabla = "clientes";

  				$datos =  array("id"=>$_POST["idClienI"],
  								"nombre"=>$_POST["editaClientI"],
								"telefono"=>$_POST["editaTelClientI"],
								"direccion"=>$_POST["editaDireccionI"],
								"rfc"=>$_POST["editaRFCI"],
								"cfdi"=>$_POST["editaCFDII"],
								"servicio"=>$_POST["editaServicioI"],
								"contratacion"=>$_POST["editaFechaCont"],
								"mensualidad"=>$_POST["editaFechaMes"]);

  				$respuesta = ModeloClientesI::mdlEditarClienteI($tabla, $datos);

  				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El cliente fue actualizado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientes-internet";

						}

					})
				

					</script>';

				} 

  			} else {
  					echo '<script>

					swal({

						type: "error",
						title: "¡ EL cliente no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes-internet";

						}

					})
				

					</script>';
  			}

  		}
		

	}

  /*=====================================
    ELIMINAR CLIENTE
  ======================================*/

  static public function ctrEliminarClienteI(){

  	if (isset($_GET["idClientI"])) {
  		
  		$tabla ="clientes";
  		$datos = $_GET["idClientI"];
  									
  		$respuesta = ModeloClientesI::mdlEliminarClienteI($tabla, $datos);

  		if ($respuesta == "ok") {
  				echo '<script>

					swal({

						type: "success",
						title: "¡El cliente ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientes-internet";

						}

					})
				

					</script>';

  		} 
  		
  	} 
  	

  }

}
