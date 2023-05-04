<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaProductosCot{
/*=====================================================
CARGAR LA TABLA DINÀMICA DE PRODUCTOS VENTAS
=====================================================*/
	public function mostrarTablaProductosCot(){

		$item = null;
    $valor = null;
    $orden = "id";
      $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);  
    
      if(count($productos) == 0){

        echo '{"data": []}';

        return;
      }
    
      $datosJson = '{
      "data": [';

      for($i = 0; $i < count($productos); $i++){

        /*=============================================
      TRAEMOS LA IMAGEN
        =============================================*/ 

        $imagen = "<img src='".$productos[$i]["imagen"]."' width='60px'>";

        /*=============================================
      STOCK
        ============================================= 

        if($productos[$i]["stock"] <= 10){

          $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

        }else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

          $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

        }else{

          $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

        }*/

        /*=============================================
      TRAEMOS LAS ACCIONES
        =============================================*/ 

        $botones =  "<div class='btn-group'><button class='btn btn-info agregarProductoC recuperarBotonC' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

        $datosJson .='[
            "'.($i+1).'",
            "'.$productos[$i]["descripcion"].'",
            "'.$productos[$i]["codigo"].'",
            "'.$productos[$i]["stock"].'",
            "'.$productos[$i]["precio_venta"].'",
            "'.$productos[$i]["precio_ventaa"].'",
            "'.$productos[$i]["precio_ventaaa"].'",
            "'.$imagen.'",
            "'.$botones.'"
          ],';

      }

      $datosJson = substr($datosJson, 0, -1);

     $datosJson .=   '] 

     }';
    
    echo $datosJson; 
	}
}

/*=====================================================
ACTIVAR TABLA DE PRODUCTOS
=====================================================*/
$activarProductosCot = new TablaProductosCot();
$activarProductosCot -> mostrarTablaProductosCot(); 