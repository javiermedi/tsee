<?php

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

$arrayClientes = array();

$arrayListaClientes = array();

foreach ($ventas as $key => $valueVentas) {
  
  foreach ($clientes as $key => $valueClientes) {
    
    if ($valueClientes["id"] == $valueVentas["id_cliente"]) {
      
      #Capturamos lo clientes en un mismo array
      array_push($arrayClientes, $valueClientes["nombre"]);

      #Cpturamos los nombres y los valores netos  en un mismo array
      $arrayListaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);

      #Sumamos  los netos de cada cliente
      foreach ($arrayListaClientes as $key => $value) {
        
        $sumaTotalClientes[$key] += $value;

      }

    }
    
  }
}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayClientes);

?>

<!--================================
=            COMPRADORES            =
=================================-->

<div class="box box-info">
	
	<div class="box-header with-border">
		
    <i class="fas fa-user-tag"></i>
    
		<h3 class="box-title">Clientes más frecuentes</h3>

	</div>

	<div class="box-body">
		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height:300px;"></div>

		</div>

	</div>

</div>

<script>
	
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,
      data: [
       
      <?php 
      foreach($noRepetirNombres as $value){

        echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";
        
      }
      ?>
      ],
      barColors: ['#21B9CB'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Ventas'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>