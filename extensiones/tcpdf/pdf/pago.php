<?php

require_once "../../../controladores/pagos.controlador.php";
require_once "../../../modelos/pagos.modelos.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/meses.controlador.php";
require_once "../../../modelos/meses.modelo.php";

require_once "../../../controladores/sevicios.controlador.php";
require_once "../../../modelos/servicio.modelo.php";


class imprimirFacturaPago{

public $codigo;

public function traerImpresionFacturaPago(){

//TRAEMOS LA INFORMACIÓN DEL PAGO

$itemPago = "id";
$valorPago = $this->codigo;

$respuestaPago = ControladorPagos::CtrMostrarPagos($itemPago, $valorPago);

$fecha = substr($respuestaPago["fecha"],0,-8);
$importe = number_format($respuestaPago["importe"],2);
$cambio = number_format($respuestaPago["cambio"],2);
$folio = $respuestaPago["folio"];
$sucursal = $respuestaPago["sucursal"];

if ($sucursal != "TEJUPAM") {
	$cod = "TEJ";
}else {

	$cod = "TAM";
}

$direccion = $respuestaPago["direccion"];
$comentarios = $respuestaPago["comentarios"];
$impuesto = number_format($respuestaPago["impuesto"],2);
$total = number_format($respuestaPago["total"],2);

$itemSer = "idservicio";
$valorSer = $respuestaPago["servicio"];

$servic = ControladorServicio::CtrMostrarServicio($itemSer, $valorSer);
 $pre = number_format($servic["precio"],2);


//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaPago["cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaPago["vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACIÓN DEL MES

$itemMes = "id";
$valorMes = $respuestaPago["mes"];

$respuestaMes = ControladorMeses::CtrMostrarMeses($itemMes, $valorMes);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdfPago = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdfPago -> setPrintHeader(false);
$pdfPago->startPageGroup();

$pdfPago->AddPage();

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

			<td style="background-color:white; width:80px; text-align:center; color:red"><br>BOLETA N.<br>$cod$folio
			</td>

		</tr>

		<tr>
			<br>
				<td style="width:350px">
					SUCURSAL: $sucursal 
					<br>
					DIRECCION: $direccion
				</td>
			<br>
		</tr>

	</table>

EOF;

$pdfPago->writeHTML($bloque1, false, false, false, false, '');

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
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdfPago->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Servicio</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Mes</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdfPago->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$servic[nombre]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$respuestaMes[nombre]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$pre
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$pre
			</td>


		</tr>

	</table>


EOF;

$pdfPago->writeHTML($bloque4, false, false, false, false, '');


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
				$ $pre
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

		<tr>

			<td>

			<div style="font-size:22px; text-align:center; line-height:15px;">
			<h4 class="label_gracias">¡Gracias por su preferencia!</h4>
			</div>

			</td>

		</tr>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<tr>
		<td style="padding-top: 550px">

		<div style="padding-top: 550px" > 
		<img src="images/pie.jpg" width: 550px; height: 200px; />
		</div>

		</td>
		</tr>

	</table>


EOF;

$pdfPago->writeHTML($bloque5, false, false, false, false, '');



$pdfPago->Output('pago.pdf', 'D');

}

}

$BoletaPago = new imprimirFacturaPago();
$BoletaPago -> codigo = $_GET["codigo"];
$BoletaPago -> traerImpresionFacturaPago();

?>