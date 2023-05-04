<?php

require_once "../../../controladores/contizacion.controlador.php";
require_once "../../../modelos/cotizacion.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirCotizacion{

public $id;

public function traerImpresionCotizacion(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemCot = "id";
$valorCot = $this->id;

$respuestaCot = ControladorCotiz::ctrMostrarCotiz($itemCot, $valorCot);

$fecha = substr($respuestaCot["fecha"],0,-8);
$productos = json_decode($respuestaCot["productos"], true);
$neto = number_format($respuestaCot["neto"],2);
$impuesto = number_format($respuestaCot["descuento"],2);
$total = number_format($respuestaCot["total"],2);
$sucursal = $respuestaCot["sucursal"];
$comentarios = $respuestaCot["comentarios"];

if ($sucursal != "TEJUPAM") {
	$cod = "TEJ";
}else {

	$cod = "TAM";
}


if ($respuestaCot["sucursal"] == "TEJUPAM") {
	$direcion = "AV. Insurgentes 2, Sec 1a, TEJUPAM";
}elseif ($respuestaCot["sucursal"] == "TAMAZULAPAM") {
	$direcion = "Carretera Cristobal Colón 62, San Cipriano";
}

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaCot["cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf -> setPrintHeader(false);
$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			<br>
			<td style="width:150px"><img src="images/bloque.png"></td>

			<td style="background-color:white; width:310px">
				
				<div style="font-size:18px; text-align:center; line-height:15px;">

					TECNO SERVICE ABEN-EZER

				</div>

				<div style="font-size:14px; text-align:center; line-height:14px;">
					
					CUPL901126IF7
					<br>
					953 128 19 49
				</div>

			</td>

	

			<td style="background-color:white; width:80px; text-align:center; color:red"><br>COTIZACIÓN.<br>$respuestaCot[codigo]</td>

		</tr>

		<tr>
			<br>
				<td style="width:350px">
					SUCURSAL: $sucursal
					<br>
					DIRECCION: $direcion
				</td>
			<br>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaCot[remitente]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>

		<tr>
			<br>
			<td style="border: 1px solid #666; color:#333; background-color:white;height:65px; width:540px;">
				<p> COMENTARIOS:  $comentarios</p>
			</td>

		</tr>

	</table>

	<div style="font-size:18px; text-align:center; line-height:15px;">
		<h4 class="label_gracias">¡Precios sujetos a cambio sin previo aviso!</h4>
	</div>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('Cotizacion.pdf', 'D');

}

}

$Cotizacion = new imprimirCotizacion();
$Cotizacion -> id = $_GET["id"];
$Cotizacion -> traerImpresionCotizacion();

?>