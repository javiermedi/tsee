<?php

  $item = null;
  $valor = null;
  $orden ="id";

  $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

?>

<!-- PRODUCT LIST -->
<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productos agregados recientemente
</h3>

    <div class="box-tools pull-right">

    
    </div>
  
  </div>
  
  <div class="box-body">
  
    <ul class="products-list product-list-in-box">
     
     <?php  
      
      for ($i=0; $i < 7; $i++) { 

     echo '<li class="item">
  
        <div class="product-img">
  
          <img src="'. $productos[$i]["imagen"] .'" alt="Product Image">
  
        </div> 

        <div class="product-info">

            '. $productos[$i]["descripcion"].'
  
            <span class="label label-primary pull-right">$'.$productos[$i]["precio_venta"].'</span>
        
        </div>
      
      </li>';      
      
      }      
      ?>
    </ul>
  
  </div>

  <div class="box-footer text-center">
  
    <a href="productos" class="uppercase">Ver todos los productos</a>
  
  </div>
  
</div>