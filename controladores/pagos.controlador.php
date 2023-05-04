<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPagos{


	/*=============================================
	CREAR VENTA
	=============================================*/
	static public function ejecutarVenta(){

		if(isset($_POST["CambioPago"])){

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "pagos";

			$datos = array("mes" => $_POST["nuevoMes"],
							"cliente" => $_POST["nuevoCliente"],
							"servicio" => $_POST["nuevoServicio"],
							"importe" => $_POST["nuevoPagoS"],
							"cambio" => $_POST["CambioPago"],
							"folio" => $_POST["nuevoFolio"],
							"vendedor" => $_POST["nuevoVendedor"],
							"comentarios" => $_POST["NuevocomenPag"],
							"sucursal" => $_POST["nuevaSucursal"],
							"direccion" => $_POST["nuevaDirec"],
							"total" => $_POST["nuevoPrecioPago"]);

			$respuesta = ModeloPagos::mdlIngresarPago($tabla, $datos);

			if($respuesta == "ok"){

				$john = "EC-PM-5890";
				$conector = new WindowsPrintConnector($john);
				$imprimir = new Printer($conector);
				$imprimir -> pulse();

				
				echo'<script>

				swal({
					  type: "success",
					  title: "El cobro ah sido realizado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pagos";

								}
							})

				</script>';

			}

		}

	}

static public function ctrCrearVenta(){

			/*=============================================
			ACTUALIZAR LOS MESES PAGADOS
			=============================================*/
	if (isset($_POST["nuevoMes"]) == 1) {
				
		switch ($_POST["nuevoMes"]) {
		    case 1:

		    $id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["enero"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "enero";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}

		        break;
		    case 2:

		    $id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["febrero"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "febrero";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}
		        

		    	break;
		    case 3: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["marzo"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "marzo";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;

		    case 4: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["abril"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "abril";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		 	case 5: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["mayo"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "mayo";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;   
		    case 6: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["junio"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "junio";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 7: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["julio"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "julio";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 8: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["agosto"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "agosto";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 9: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["septiembre"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "septiembre";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 10: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["octubre"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "octubre";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 11: 

		   	$id = $_POST["nuevoCliente"];
        	$item = "id";
        	$valor = $id;

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["noviembree"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "noviembree";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;
		    case 12: 

		   	
        	$item = "id";
        	$valor = $_POST["nuevoCliente"];

        	$clienP = ControladorClientesI::ctrMostrarClientesI($item, $valor);

        	if ($clienP["diciembre"] != null) {
        		
        		echo'<script>

				swal({
					  type: "error",
					  title: "El mes ya esta pagado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

        	}else {

				$item1b = "diciembre";

				$tablaClientes = "clientes";
					
				$valor1b = $_POST["nuevaFecha"];
				$valor = $_POST["nuevoCliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$respuestaPago = ControladorPagos::ejecutarVenta();

        	}     
				
		    break;


		}	

	} 

}


	/*--=====================================
        MOSTRAR MESES 
  ======================================-->*/

	static public function CtrMostrarPagos($item, $valor){

		$tabla = "pagos";

		$respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

		return $respuesta;


	}

	/*=============================================
	TICKET DE VENTAS 
	=============================================*/
	static public function ticket(){

		if(isset($_GET["idPago"])){
		
			$codigo = $_GET["idPago"];
		//var_dump($codigo);

			$itemPago = "id";

			$respuestaPago = ControladorPagos::CtrMostrarPagos($itemPago, $codigo);

			$itemClie = "id";
        	$valorClie = $respuestaPago["cliente"];

        	$cliente = ControladorClientesI::ctrMostrarClientesI($itemClie, $valorClie);

        	$itemVendedor = "id";
			$valorVendedor = $respuestaPago["vendedor"];

			$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

			$itemMes = "id";
            $valorMes = $respuestaPago["mes"];

            $mes = ControladorMeses::CtrMostrarMeses($itemMes, $valorMes);

			$fecha = $respuestaPago["fecha"];

			$itemSer = "idservicio";
            $valorSer = $respuestaPago["servicio"];

            $servic = ControladorServicio::CtrMostrarServicio($itemSer, $valorSer);

			$john = "5890X";
			$conector = new WindowsPrintConnector($john);
			$imprimir = new Printer($conector);

			$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
			$imprimir -> text($fecha."\n");//Hora y Fecha
			$imprimir -> feed(1);//dejar un renglon en blanco
			$imprimir -> text("SERVICIOS TSEE \n");
			$imprimir -> text("SUCURSAL: ".$respuestaPago["sucursal"]."\n");
			$imprimir -> text("Dirección: ".$respuestaPago["direccion"]."\n");
			$imprimir -> text("Teléfono: 953 128 19 49"."\n");

			if ($respuestaPago["sucursal"] != "TAMAZULAPAM") {

				$imprimir -> text("TICKET N. TEJ".$respuestaPago["folio"]."\n");

			} else {

				$imprimir -> text("TICKET N. TAM".$respuestaPago["folio"]."\n");

			}

				
			$imprimir -> feed(1);

			$imprimir -> text("Cliente: ".$cliente["nombre"]."\n");

			$imprimir -> text("Vendedor: ".$respuestaVendedor["nombre"]."\n");

			$imprimir -> feed(1);

			$imprimir->setJustification(Printer::JUSTIFY_LEFT);

			$imprimir -> text("Servicio: ".$servic["nombre"]."\n");

			$imprimir->setJustification(Printer::JUSTIFY_RIGHT);

			$imprimir->text("$ ".number_format($servic["precio"],2)." Mes x 1 = $ ".number_format($servic["precio"],2)."\n");

			$imprimir -> feed(1); //Alimentamos el papel 1 vez		
				
			$imprimir->text("NETO: $ ".number_format($servic["precio"],2)."\n"); //precio de el neto

			$imprimir->text("IMPUESTO: $ ".number_format($respuestaPago["impuesto"],2)."\n"); //precio de el impuesto

			$imprimir->text("- - - - - - - - - - - - - - - -\n");

			$imprimir->text("TOTAL: $ ".number_format($servic["precio"],2)."\n"); //precio de el total

			$imprimir->text("- - - - - - - - - - - - - - - -\n");

			$imprimir->text("PAGA CON: $ ".number_format($respuestaPago["importe"],2)."\n");
			$imprimir->text("SU CAMBIO: $ ".number_format($respuestaPago["cambio"],2)."\n");

			$imprimir -> feed(1); // 1 vez salto de linea*/	

			$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
			$imprimir->text("Gracias por su preferencia");

			$imprimir -> feed(6);

			$imprimir -> cut(); //Cortamos el papel 

			$imprimir -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder..window.location = "ventas";

			$imprimir -> close();



			echo'<script>

				swal({
					  type: "success",
					  title: "El ticket ah sido impreso correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "pagos";

								}
							})

			</script>';



		}			

	}

	/*--=====================================
        BORRAR PAGO
  ======================================-->*/
static public function ctrBorrarPago(){

	if(isset($_GET["id"])){

			
			$id = $_GET["id"];
        	$item = "id";
        	$valor = $id;

        	$Pago = ControladorPagos::CtrMostrarPagos($item, $valor);

        	$mes = $Pago["mes"];

		switch ($mes) {
		    case 1:	        	

				$item1b = "enero";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;
		    case 2:	        	

				$item1b = "febrero";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break; 
		    case 3:	        	

				$item1b = "marzo";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;     
		    case 4:	        	

				$item1b = "abril";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break; 
		    case 5:	        	

				$item1b = "mayo";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;        
		    case 6:	        	

				$item1b = "junio";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;    
			case 7:	        	

				$item1b = "julio";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;
		    case 8:	        	

				$item1b = "agosto";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;    	
		    case 9:	        	

				$item1b = "septiembre";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;    
		    case 10:	        	

				$item1b = "octubre";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;
		    case 11:	        	

				$item1b = "noviembree";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;
		    case 12:	        	

				$item1b = "diciembre";
				$tablaClientes = "clientes";
				$valor1b = '';
				$valor = $Pago["cliente"];

				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				$BorrarPago = ControladorPagos::borraPago();

		        break;        

		}
			
	}
		
}


/*--=====================================
        BORRAR PAGO
  ======================================-->*/
	static public function borraPago(){

		if(isset($_GET["id"])){

			$tabla ="pagos";
			$datos = $_GET["id"];

			$respuesta = ModeloPagos::mdlBorrarPago($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El pago ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "pagos";

									}
								})

					</script>';
			}
			
		}

	}


	/*--=====================================
        BORRAR PAGO
  ======================================-->*/
static public function ctrBorrarTodPagos(){

	if(isset($_GET["idCpago"])){

		$item1b = "enero";
		$tablaClientes = "clientes";
		$valor1b = '';
		$valor = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);


//======================================= ====================================
	        	

		$item2b = "febrero";
		$tabla2 = "clientes";
		$valor2b = '';
		$valor2 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item2b, $valor2b, $valor2);


//======================================= ====================================


		$item3b = "marzo";
		$tabla3 = "clientes";
		$valor3b = '';
		$valor3 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla3, $item3b, $valor3b, $valor3);	


//======================================= ====================================

		$item4b = "abril";
		$tabla4 = "clientes";
		$valor4b = '';
		$valor4 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla4, $item4b, $valor4b, $valor4);

//======================================= ====================================

		$item5b = "mayo";
		$tabla5 = "clientes";
		$valor5b = '';
		$valor5 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla5, $item5b, $valor5b, $valor5);

//======================================= ====================================
        	

		$item6b = "junio";
		$tabla6 = "clientes";
		$valor6b = '';
		$valor6 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla6, $item6b, $valor6b, $valor6);		

//======================================= ====================================
     	

		$item7b = "julio";
		$tabla7 = "clientes";
		$valor7b = '';
		$valor7 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla7, $item7b, $valor7b, $valor7);	

//======================================= ====================================


		$item8b = "agosto";
		$tabla8 = "clientes";
		$valor8b = '';
		$valor8 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla8, $item8b, $valor8b, $valor8);		

//======================================= ====================================

		$item9b = "septiembre";
		$tabla9 = "clientes";
		$valor9b = '';
		$valor9 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla9, $item9b, $valor9b, $valor9);		

//======================================= ====================================

		$itemoct = "octubre";
		$tablaoct = "clientes";
		$valor1oct = '';
		$valoroct = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaoct, $itemoct, $valor1oct, $valoroct);		

//======================================= ====================================

		$item11b = "noviembree";
		$tabla11 = "clientes";
		$valor11b = '';
		$valor11 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla11, $item11b, $valor11b, $valor11);

//======================================= ====================================


		$item12b = "diciembre";
		$tabla12 = "clientes";
		$valor12b = '';
		$valor12 = $_GET["idCpago"];

		$fechaCliente = ModeloClientes::mdlActualizarCliente($tabla12, $item12b, $valor12b, $valor12);				



				echo'<script>

				swal({
					  type: "success",
					  title: "Se restablecieron datos de cliente correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes-internet";

								}
							})

				</script>';

		        
			
	}
		
}





}

