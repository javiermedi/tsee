<?php

		error_reporting(0);

if (isset($_GET["fechaInicial"])) {

  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];

}else{

  $fechaInicial = Null;
  $fechaFinal = Null;

}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

	$arrayFechas = array();
	$arrayVentas = array();

	$sumaPagoMes = array();
foreach ($respuesta as $key => $value) {

	#Capturamos sólo el año  y el mes
	$fecha = substr($value["fecha"],0,7);
	
	#Introducir las  fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las ventas
	$arrayVentas = array($fecha => $value["total"]);

	#Sumamos los pagos que ocurrieron en el mismo mes
	foreach ($arrayVentas as $key => $value) {
		
		$sumaPagoMes[$key] += $value;
	}
}

$noRepetirFechas = array_unique($arrayFechas);

?>

<!--=======================================
=            GRAFICO DE VENTAS            =
========================================-->
<div class="box box-primary box-teal-gradient">
	
	<div class="box-header">
		
			<i class="fa fa-chart-bar"></i>

		<h3 class="box-title">Gráfico de Ventas</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">
		
	 <div class="chart tab-pane active" id="revenue-chart-ventas" style="position: relative; height: 300px;"></div>
	</div>

</div>

<script>
	var area = new Morris.Area({
    element   : 'revenue-chart-ventas',
    resize    : true,
    data      : [

     <?php
     if ($noRepetirFechas!= null) {

     
     foreach($noRepetirFechas as $key){

     	echo "{y: '".$key."', ventas: ".$sumaPagoMes[$key]."},";

    } 
         	echo "{y: '".$key."', ventas: ".$sumaPagoMes[$key]."}";

     }else{

         	echo "{y: '0', ventas: '0'}";

     }    	

     ?>
    ],
    xkey      	  : 'y',
    ykeys     	  : ['ventas'],
    labels    	  : ['ventas'],
    lineColors 	  : ['#3c8dbc'],
    hideHover 	  : 'auto',
    preUnits  	  : '$',
    gridTextSize  : 10
  });

</script>