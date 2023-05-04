<?php


use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class ControladorVentas{

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){
                    

		if(isset($_POST["nuevaVenta"])){

			if ($_POST["nuevoValorEfectivo"]>=$_POST["nuevoTotalVenta"]) {

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos = json_decode($_POST["listaProductos"], true);

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
			$valor = $_POST["seleccionarCliente"];

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

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "comentarios"=>$_POST["Nuevocomentario"],
						   "impuesto"=>$_POST["nuevoImpuestoVenta"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["nuevoTotalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "sucursal"=>$_POST["nuevaSucursal"],
						   "importe"=>$_POST["nuevoValorEfectivo"],
						   "cambio"=>$_POST["nuevoCambioEfectivo"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				$john = "EC-PM-5890";
				$conector = new WindowsPrintConnector($john);
				$imprimir = new Printer($conector);
				$imprimir -> pulse();

				
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

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

								window.location = "crear-venta";

								}
							})

				</script>';

			}


		}

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	TICKET DE VENTAS
	=============================================*/
	static public function ticket(){

		if(isset($_GET["codigoVent"])){
		
		$codigo = $_GET["codigoVent"];
		//var_dump($codigo);

			$itemVenta = "codigo";

			$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $codigo);

			$fecha = $respuestaVenta["fecha"];
			$productos = json_decode($respuestaVenta["productos"], true);
			$neto = number_format($respuestaVenta["neto"],2);
			$impuesto = number_format($respuestaVenta["impuesto"],2);
			$total = number_format($respuestaVenta["total"],2);
			$sucursal = $respuestaVenta["sucursal"];
			$comentarios = $respuestaVenta["comentarios"];
			$cambio = number_format($respuestaVenta["cambio"],2);
			$importe = number_format($respuestaVenta["importe"],2);


			if ($respuestaVenta["sucursal"] == "TEJUPAM") {
				$direcion = "AV. Insurgentes 2, Sec 1a, TEJUPAM";
			}elseif ($respuestaVenta["sucursal"] == "TAMAZULAPAM") {
				$direcion = "Carretera Cristobal Colón 62, San Cipriano";
			}

			//TRAEMOS LA INFORMACIÓN DEL CLIENTE

			$itemCliente = "id";
			$valorCliente = $respuestaVenta["id_cliente"];

			$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

			//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

			$itemVendedor = "id";
			$valorVendedor = $respuestaVenta["id_vendedor"];

			$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

				$john = "5890X";
				$conector = new WindowsPrintConnector($john);
				$imprimir = new Printer($conector);

				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				$imprimir -> text($fecha."\n");//Hora y Fecha
				$imprimir -> feed(1);//dejar un renglon en blanco
				$imprimir -> text("SERVICIOS TSEE \n");
				$imprimir -> text("SUCURSAL: ".$respuestaVenta["sucursal"]."\n");
				$imprimir -> text("Dirección: ".$direcion."\n");
				$imprimir -> text("Teléfono: 953 128 19 49"."\n");

				if ($respuestaVenta["sucursal"] != "TAMAZULAPAM") {
					$imprimir -> text("TICKET N. TEJ".$codigo."\n");
				} else {

					$imprimir -> text("TICKET N. TAM".$codigo."\n");

				}
				
				
				$imprimir -> feed(1);

				$imprimir -> text("Cliente: ".$respuestaCliente["nombre"]."\n");

				$imprimir -> text("Vendedor: ".$respuestaVendedor["nombre"]."\n");

				$imprimir -> feed(1);

				foreach ($productos as $key => $item) {

					$itemProducto = "descripcion";
					$valorProducto = $item["descripcion"];
					$orden = null;

					$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

					$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

					$precioTotal = number_format($item["total"], 2);

					$imprimir->setJustification(Printer::JUSTIFY_LEFT);

					$imprimir->text($item["descripcion"]."\n");//Nombre del producto

					$imprimir->setJustification(Printer::JUSTIFY_RIGHT);

					$imprimir->text("$ ".number_format($valorUnitario,2)." Und x ".$item["cantidad"]." = $ ".number_format($precioTotal,2)."\n");

				}

				$imprimir -> feed(1); //Alimentamos el papel 1 vez		
				
				$imprimir->text("NETO: $ ".$neto."\n"); //precio de el neto

				$imprimir->text("IMPUESTO: $ ".$impuesto."\n"); //precio de el impuesto

				$imprimir->text("- - - - - - - - - - - - - - - -\n");

				$imprimir->text("TOTAL: $ ".$total."\n"); //precio de el total

				$imprimir->text("- - - - - - - - - - - - - - - -\n");

				$imprimir->text("PAGA CON: $ ".$importe."\n");
				$imprimir->text("SU CAMBIO: $ ".$cambio."\n");

				$imprimir -> feed(1); // 1 vez salto de linea*/	

				$imprimir -> setJustification(Printer::JUSTIFY_CENTER);
				$imprimir->text("Muchas gracias por su compra"); 

				$imprimir -> feed(6); //6 veces salto de linea*/

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

								window.location = "ventas";

								}
							})

				</script>';

		}			

	}
	

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

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

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
			RANGO DE FECHAS
	=============================================*/

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

	$tabla = "ventas";
	$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

	return $respuesta;

	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #00A5F7;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #00A5F7;'>SUCURSAL</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>COMENTARIOS</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #00A5F7;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #00A5F7;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #00A5F7;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #00A5F7;'>FECHA</td>		
					</tr>");


			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["sucursal"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
		 			<td style='border:1px solid #eee;'>".$item["comentarios"]."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}


	/*=============================================
	DESCARGAR XML
	=============================================*/

	static public function ctrDescargarXML(){

		if(isset($_GET["xml"])){


			$tabla = "ventas";
			$item = "codigo";
			$valor = $_GET["xml"];

			$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			// PRODUCTOS

			$listaProductos = json_decode($ventas["productos"], true);

			// CLIENTE

			$tablaClientes = "clientes";
			$item = "id";
			$valor = $ventas["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			// VENDEDOR

			$tablaVendedor = "usuarios";
			$item = "id";
			$valor = $ventas["id_vendedor"];

			$traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

			//http://php.net/manual/es/book.xmlwriter.php

			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

			$objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

			$objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento
			
			// $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz

			// $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal

			// 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo

			// 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna

			// 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
			
			// 	$objetoXML->endElement(); // Final del nodo hijo
			
			// $objetoXML->endElement(); // Final del nodo raíz


			$objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');

			$objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {
				
				$objetoXML->text($value["descripcion"].", ");
			
			}

			

			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</fe:Invoice>');

			$objetoXML->endDocument(); // Final del documento

			return true;	
		}

	}

}

