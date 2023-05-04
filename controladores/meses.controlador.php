<?php

class ControladorMeses{

	/*--=====================================
        MOSTRAR MESES 
  ======================================-->*/

	static public function CtrMostrarMeses($item, $valor){

		$tabla = "meses";

		$respuesta = ModeloMeses::mdlMostrarMeses($tabla, $item, $valor);

		return $respuesta;

	}

	/*--=====================================
        MOSTRAR MESES PAGADOS 
  ======================================-->*/

	static public function ctrMostrarMesesPag($item, $valor){

		$tabla = "mesespa";

		$mesespa = ModeloMeses::mdlMostrarMesesPag($tabla, $item, $valor);

		return $mesespa;

	}


}



	
