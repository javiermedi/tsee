<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorService{

	/*--=====================================
        CREAR SERVICIO
  ======================================-->*/

	static public function CtrCrearService(){
		
		if(isset($_POST["nuevoServicio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoServicio"])){

				$tabla = "service";

				$datos = array("nombre" => $_POST["nuevoServicio"], 
							   "costo" => $_POST["precioServicio"]);

				$respuesta = ModeloService::mdlIngresarService($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue agregado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "service";

						}

					});
				

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "success",
						title: "¡El servicio no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "service";

						}

					});
				

					</script>';

			}

		}
	}


	/*--=====================================
        MOSTRAR SERVICIO
  ======================================-->*/

  static public function ctrMostrarService($item, $valor){

  	$tabla = "service";

  	$respuesta = ModeloService::mdlMostrarService($tabla, $item, $valor);

  	return $respuesta;

  }


/*--=====================================
        EDITAR SERVICIO
  ======================================-->*/

	static public function CtrEditarService(){

		if(isset($_POST["editarService"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarService"])){

				$tabla = "service";

				$datos = array("nombre" => $_POST["editarService"], 
							   "costo" => $_POST["EditarPrecioService"], 
							   "id"=>$_POST["idService"]);

				$respuesta = ModeloService::mdlEditarService ($tabla, $datos);
	
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "service";

						}

					});
				

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "success",
						title: "¡El servicio no puede ir vacia o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "service";

						}

					});
				

					</script>';

			}

		}
	}


	/*=============================================
	BORRAR SERVICIO 
	=============================================*/

	static public function ctrBorrarService(){

		if(isset($_GET["idService"])){

			$tabla ="service";
			$datos = $_GET["idService"];

			$respuesta = ModeloService::mdlBorrarService($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El servicio ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "service";

									}
								})

					</script>';
			}
		}
		
	}


/*====================================================================================================
=            CONTROLADOR PARA CREAR ORDEN DEL SERVICO                                                =
====================================================================================================*/

# =======================================================
# =          METODO CREAR ORDEN DEL SERVICIO           =
# =======================================================

static public function ctrCrearOrdenService(){

	if (isset($_POST["CodiOrdenSer"])) {
    	
		if ($_POST["nuevoEfectivoSer"] >= $_POST["nuevoTotalSer"]) {

    			# =====================================================
    			# =           RALIZAR LA VENTA DE PRODUCTOS           =
   	 			# =====================================================
    		
    		if ($_POST["listaProducS"] != " " && $_POST["listaProducS"] != null) {
    			
    			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos = json_decode($_POST["listaProducS"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";
			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["selecCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Mexico_City');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";


			$datos = array("id_vendedor"=>$_SESSION["id"],
						   "id_cliente"=>$_POST["selecCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProducS"],
						   "comentarios"=>$_POST["Nuevocomentario"],
						   "impuesto"=>$_POST["nuevoImpuestoVenta"],
						   "neto"=>$_POST["TotalProductoS"],
						   "total"=>$_POST["TotalProductoS"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "sucursal"=>$_POST["SucursalSer"],
						   "importe"=>$_POST["nuevoEfectivoSer"],
						   "cambio"=>$_POST["nuevoCambioSer"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
    			
				$tablaS = "servicioc";

      			$datosS = array("id_vendedor"=>$_SESSION["id"],
      						   "id_cliente"=>$_POST["selecCliente"],
      						   "codigo"=>$_POST["CodiOrdenSer"],
      						   "id_tecnico"=>$_POST["selecTecnico"],
      						   "productos"=>$_POST["listaProducS"],
      						   "servicios"=>$_POST["listaServicio"],
      						   "comentarios"=>$_POST["NuevocomentarioSer"],
      						   "sucursal"=>$_POST["SucursalSer"],
      						   "neto"=>$_POST["nuevoTotalSer"],
      						   "total"=>$_POST["nuevoTotalSer"],
      						   "totalP"=>$_POST["TotalProductoS"],
      						   "totalS"=>$_POST["TotalServicios"],
      						   "codigoV" =>$_POST["nuevaVenta"],
      						   "importe"=>$_POST["nuevoEfectivoSer"],
      						   "cambio"=>$_POST["nuevoCambioSer"]);

      		$respuestaS = ModeloService::mdlIngresarOrdenServicio($tablaS, $datosS);
      			
      			if($respuestaS == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue agregado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}else{

						echo '<script>

					swal({

						type: "error",
						title: "¡La orden del servicio no puede ir vacia!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}

      		}else{

      			$tablaS = "servicioc";
      			$codigoVe = " ";
      			$datosS = array("id_vendedor"=>$_SESSION["id"],
      						   "id_cliente"=>$_POST["selecCliente"],
      						   "codigo"=>$_POST["CodiOrdenSer"],
      						   "id_tecnico"=>$_POST["selecTecnico"],
      						   "productos"=>$_POST["listaProducS"],
      						   "servicios"=>$_POST["listaServicio"],
      						   "comentarios"=>$_POST["NuevocomentarioSer"],
      						   "sucursal"=>$_POST["SucursalSer"],
      						   "neto"=>$_POST["nuevoTotalSer"],
      						   "total"=>$_POST["nuevoTotalSer"],
      						   "totalP"=>$_POST["TotalProductoS"],
      						   "totalS"=>$_POST["TotalServicios"],
      						   "codigoV" =>$codigoVe,
      						   "importe"=>$_POST["nuevoEfectivoSer"],
      						   "cambio"=>$_POST["nuevoCambioSer"]);

      		$respuestaS = ModeloService::mdlIngresarOrdenServicio($tablaS, $datosS);
      			
      			if($respuestaS == "ok"){

					echo '<script>	

					swal({

						type: "success",
						title: "¡El servicio fue agregado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}else{

						echo '<script>

					swal({

						type: "error",
						title: "¡La orden del servicio no puede ir vacia!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}


      		}
    		
		}else {

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "Tu pago debe ser mayo al total a pagar",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "realizar-servicio";

								}
							})

				</script>';

			}
    	}
    }


    /*--=====================================
        MOSTRAR SERVICIO
  ======================================-->*/

  static public function ctrMostrarOrdenService($item, $valor){

  	$tabla = "servicioc";

  	$respuesta = ModeloService::mdlMostrarOrdenService($tabla, $item, $valor);

  	return $respuesta;

  }


/*--=====================================
        EDITAR ORDEN SERVICIO
 ======================================-->*/

  static public function ctrEditarOrdenService(){

	if (isset($_POST["CodiOrdenSerEditar"])) {
    	
		if ($_POST["nuevoEfectivoSer"]>=$_POST["nuevoTotalSer"]) {

    			# =====================================================
    			# =           RALIZAR LA VENTA DE PRODUCTOS           =
    			# =====================================================
    			$itemS = "id";
    		$valorS = $_GET["idOrdenSer"];

    		$serviciosR = ControladorService::ctrMostrarOrdenService($itemS, $valorS);
    		 
    		 # ==================================================================
			# =          VERIFICAR SI HAY CAMBIO EN LISTA SERVICIOS           =
			# ==================================================================
			if ($_POST["listaServicio"] == "") {
				$listaServicio = $serviciosR["servicios"];
			} else {
				$listaServicio = $_POST["listaServicio"];
			}
			


    		if ($serviciosR["productos"]!= ""  && $serviciosR["codigoV"] == 0) {
    			
    		/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/
			
			$listaProductos = json_decode($_POST["listaProducS"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";
			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["selecCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Mexico_City');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";


			$datos = array("id_vendedor"=>$_SESSION["id"],
						   "id_cliente"=>$_POST["idCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProducS"],
						   "comentarios"=>$_POST["Nuevocomentario"],
						   "impuesto"=>$_POST["nuevoImpuestoVenta"],
						   "neto"=>$_POST["TotalProductoS"],
						   "total"=>$_POST["TotalProductoS"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "sucursal"=>$_POST["SucursalSer"],
						   "importe"=>$_POST["nuevoEfectivoSer"],
						   "cambio"=>$_POST["nuevoCambioSer"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
		
				$tablaS = "servicioc";

      			$datosS = array("id_vendedor"=>$_SESSION["id"],
      						   "id_cliente"=>$_POST["idCliente"],
      						   "codigo"=>$_POST["CodiOrdenSerEditar"],
      						   "id_tecnico"=>$_POST["selecTecnico"],
      						   "productos"=>$_POST["listaProducS"],
      						   "servicios"=>$listaServicio,
      						   "comentarios"=>$_POST["NuevocomentarioSer"],
      						   "sucursal"=>$_POST["SucursalSer"],
      						   "neto"=>$_POST["nuevoTotalSer"],
      						   "total"=>$_POST["nuevoTotalSer"],
      						   "totalP"=>$_POST["TotalProductoS"],
      						   "totalS"=>$_POST["TotalServicios"],
      						   "codigoV" =>$_POST["nuevaVenta"],
      						   "importe"=>$_POST["nuevoEfectivoSer"],
      						   "cambio"=>$_POST["nuevoCambioSer"]);

      		$respuestaS = ModeloService::mdlEditarOrdenServicio($tablaS, $datosS);
      			
      			if($respuestaS == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}else{

						echo '<script>

					swal({

						type: "error",
						title: "¡La orden del servicio no puede ir vacia!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}

      		}else{

      		/*=====================================================
      		FORMATEAR TABLA DE PRODUCTOS Y  LA DE  CLIENTES
      		=======================================================*/
      		$tabla = "ventas";
      		$item = "codigo";

			$valor = $serviciosR["codigoV"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			if ($_POST["listaProducS"] == "") {
      				$listaProductos = $traerVentas["productos"];
      			} else {
      				$listaProductos = $_POST["listaProducS"];
      			}

			$producto = json_encode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($producto as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
					
			    $tablaProducto = "productos";	

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";
			   
			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProducto, $item, $valor, $orden);

			    $item1a = "ventas";
			    $valor1a = $traerProducto["ventas"] - $value["cantidad"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

			    $item1b = "stock";
			    $valor1b = $value["cantidad"] + $traerProducto["stock"];

			    $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemClente = "id";
			$valorClente = $_POST["idCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemClente, $valorClente);
			
			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

	      		/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

      			$listaProductos_2 = json_decode($listaProductos, true);

			$totalProductosComprados_2 = array();

			foreach ($listaProductos_2 as $key => $value) {

			   array_push($totalProductosComprados_2, $value["cantidad"]);
				
			   $tablaProductos_2 = "productos";

			    $item_2 = "id";
			    $valor_2 = $value["id"];
			    $orden_2 = "id";
			    $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden_2);

				$item1a_2 = "ventas";
				$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

			    $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "stock";
				$valor1b_2 = $value["stock"];

				$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

			}

			$tablaClientes_2 = "clientes";

			$item_2 = "id";
			$valor_2 = $_POST["selecCliente"];

			$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

			$item1a_2 = "compras";
			$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

			$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

			$item1b_2 = "ultima_compra";

			date_default_timezone_set('America/Mexico_City');

				$fecha_2 = date('Y-m-d');
				$hora_2 = date('H:i:s');
				
			$valor1b_2 = $fecha_2.' '.$hora_2;

			$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);
						

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_SESSION["id"],
						   "id_cliente"=>$_POST["idCliente"],
						   "codigo"=>$_POST["nuevaVentas"],
						   "productos"=>$listaProductos,
						   "comentarios"=>$_POST["Nuevocomentario"],
						   "impuesto"=>$_POST["nuevoImpuestoVenta"],
						   "neto"=>$_POST["TotalProductoS"],
						   "total"=>$_POST["TotalProductoS"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "sucursal"=>$_POST["SucursalSer"],
						   "importe"=>$_POST["nuevoEfectivoSer"],
						   "cambio"=>$_POST["nuevoCambioSer"]);

		# ===============================================================================
		# =           VERIFICAR SI NO SE ELIMINARON PRODUCTOS DEL SERCIEVICIO           =
		# ===============================================================================
							
		if ($listaProductos == null || $listaProductos == " " ) {
				
			$datos = $_POST["idVenta"];


			$tabla = "ventas";

			$item = "id";
			$valor = $_POST["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);


			# =======================================
			# =           ELIMINAR VENTAS           =
			# =======================================

			$respuesta =ModeloVentas::mdlEliminarVenta($tabla, $datos);

				$tablaS = "servicioc";
				$codigoV= "0";
      				$datosS = array("id_vendedor"=>$_SESSION["id"],
      						   "id_cliente"=>$_POST["idCliente"],
      						   "codigo"=>$_POST["CodiOrdenSerEditar"],
      						   "id_tecnico"=>$_POST["selecTecnico"],
      						   "productos"=>$listaProductos,
      						   "servicios"=>$listaServicio,
      						   "comentarios"=>$_POST["NuevocomentarioSer"],
      						   "sucursal"=>$_POST["SucursalSer"],
      						   "neto"=>$_POST["nuevoTotalSer"],
      						   "total"=>$_POST["nuevoTotalSer"],
      						   "totalP"=>$_POST["TotalProductoS"],
      						   "totalS"=>$_POST["TotalServicios"],
      						   "codigoV" =>$codigoV,
      						   "importe"=>$_POST["nuevoEfectivoSer"],
      						   "cambio"=>$_POST["nuevoCambioSer"]);

      			$respuestaS = ModeloService::mdlEditarOrdenServicio($tablaS, $datosS);
      			
      			if($respuestaS == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}else{

						echo '<script>

					swal({

						type: "error",
						title: "¡La orden del servicio javi no puede ir vacia!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}

				
		} else {
				
			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

				$tablaS = "servicioc";
      			$datosS = array("id_vendedor"=>$_SESSION["id"],
      						   "id_cliente"=>$_POST["idCliente"],
      						   "codigo"=>$_POST["CodiOrdenSerEditar"],
      						   "id_tecnico"=>$_POST["selecTecnico"],
      						   "productos"=>$listaProductos,
      						   "servicios"=>$listaServicio,
      						   "comentarios"=>$_POST["NuevocomentarioSer"],
      						   "sucursal"=>$_POST["SucursalSer"],
      						   "neto"=>$_POST["nuevoTotalSer"],
      						   "total"=>$_POST["nuevoTotalSer"],
      						   "totalP"=>$_POST["TotalProductoS"],
      						   "totalS"=>$_POST["TotalServicios"],
      						   "codigoV" =>$_POST["nuevaVentas"],
      						   "importe"=>$_POST["nuevoEfectivoSer"],
      						   "cambio"=>$_POST["nuevoCambioSer"]);

      		$respuestaS = ModeloService::mdlEditarOrdenServicio($tablaS, $datosS);
      			
      			if($respuestaS == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio fue editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}else{

						echo '<script>

					swal({

						type: "error",
						title: "¡La orden del servicio no puede ir vacia!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "orden-servicio";

						}

					});
				

					</script>';

				}


      		}
			}
				
      		# ===================================
      		# =           SE TERMINA            =
      		# ===================================		
    		
		}else {

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "Tu pago debe ser mayo al total a pagar",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "orden-servicio";

								}
							})

				</script>';

			}
    	}
    }


# ===============================================
# =           ELIMINAR ORDEN SERVICIO           =
# ===============================================

static public function ctrEliminarOrdenServicio(){

	if (isset($_GET["idOrdenServicio"])) {
	
		$tablaSer = "servicioc";

		$item = "id";
		$valor = $_GET["idOrdenServicio"];

		$ordenServicio = ModeloService::mdlMostrarOrdenService($tablaSer, $item, $valor);

		# ==========================================================
		# =           VERIFICAR SI PRODUCTOS VIENE LLENO           =
		# ==========================================================
		
		
		
		if ($ordenServicio["codigoV"] != 0 && $ordenServicio["codigoV"] != "") {
			
			$tabla = "ventas";

			$item = "codigo";
			$valor = $ordenServicio["codigoV"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);
		} 


		# ===============================================
		# =           ELIMINAR ORDEN SERVICIO           =
		# ===============================================
		
		$respuestaSer = ModeloService::mdBorrarOrdenServicio($tablaSer, $_GET["idOrdenServicio"]);
		
		if($respuestaSer == "ok"){

			echo '<script>

			swal({

				type: "success",
				title: "¡El servicio fue eliminado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){
				
					window.location = "orden-servicio";

				}

			});
		

			</script>';

		}else{

			echo '<script>

			swal({

				type: "error",
				title: "¡Error no se puede eliminar el servicio!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){
				
					window.location = "orden-servicio";

				}

			});
		

			</script>';

				}


	}


}


}






