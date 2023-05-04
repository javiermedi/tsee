<?php 
  
  $item = null;
  $valor = null;
  $orden = "id";
  
  $ventas = ControladorVentas::ctrSumaTotalVentas();

  $categori = ControladorCategorias::ctrMostrarCategorias($item, $valor);
  $totalCategotias = count($categori);


  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
  $totalClientes = count($clientes);

  $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
  $totalProductos = count($productos);

?>

<div class="col-md-3 col-xs-12">
    <div class="info-box bg-aqua">
          
      <span class="info-box-icon"><i class="ion- ion-social-usd"></i></span>

          <div class="info-box-content">
            
            <span class="info-box-text">Ventas</span>

            <span class="info-box-number">$<?php echo number_format($ventas["total"],2); ?></span>

            <div class="progress">
            
              <div class="progress-bar" style="width: 0%"></div>
            
            </div>

             <a href="ventas" class="small-box-footer bg-aqua info-box-text">
                  Más info <i class="fa fa-arrow-circle-right"></i>
              </a>

          </div>
        
    </div>

</div>

<div class="col-md-3 col-xs-12">
   
   <div class="info-box bg-green">
   
          <span class="info-box-icon"><i class="ion ion-clipboard"></i></span>

      <div class="info-box-content">
   
          <span class="info-box-text">Categorias</span>
   
          <span class="info-box-number"><?php echo number_format($totalCategotias); ?></span>

        <div class="progress">
        
            <div class="progress-bar" style="width: 0%"></div>
        
        </div>

         <a href="categorias" class="small-box-footer bg-green info-box-text">
                  Más info <i class="fa fa-arrow-circle-right"></i>
              </a>

      </div>

    </div>

</div>

<div class="col-md-3 col-xs-12">
  
  <div class="info-box bg-red">
      
      <span class="info-box-icon"><i class="ion ion-person-add"></i></span>

            <div class="info-box-content">
      
              <span class="info-box-text">Clientes</span>
      
              <span class="info-box-number"><?php echo number_format($totalClientes); ?></span>

              <div class="progress">
      
                <div class="progress-bar" style="width: 0%"></div>
      
              </div>
              
              <a href="clientes" class="small-box-footer bg-red info-box-text">
                  Más info <i class="fa fa-arrow-circle-right"></i>
              </a>

            </div>
      
  </div>

</div>

<div class="col-md-3 col-xs-12">

    <div class="info-box bg-yellow">

      <span class="info-box-icon"><i class="ion ion-ios-cart"></i></span>

      <div class="info-box-content">

        <span class="info-box-text">Productos</span>

        <span class="info-box-number"><?php echo number_format($totalProductos); ?></span>

        <div class="progress">

          <div class="progress-bar" style="width: 0%"></div>

        </div>

        <a href="productos" class="small-box-footer bg-yellow info-box-text">
                  Más info <i class="fa fa-arrow-circle-right"></i>
              </a>

      </div>

  </div>

</div>
