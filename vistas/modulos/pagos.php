<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar pagos de servicios
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-warning">

      <div class="box-header with-border">
  

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr class="bg-primary">
           
           <th style="width:10px">#</th>
           <th class="text-uppercase">cliente</th>
           <th class="text-uppercase">servicio</th>
           <th class="text-uppercase">P/servicio</th>
           <th class="text-uppercase">mes</th>
           <th class="text-uppercase">comentarios</th>
           <th class="text-uppercase">Pago</th>
           <th class="text-uppercase">Sucursal</th>
           <th class="text-uppercase">fecha</th>
           <th class="text-uppercase">Opciónes</th>

         </tr> 

        </thead>

        <tbody>
          
          <?php 

            $ruso = null;
            $john = null;

            $pagos = ControladorPagos::CtrMostrarPagos($ruso, $john);

            foreach ($pagos as $key => $value) {

              $itemSer = "idservicio";
              $valorSer = $value["servicio"];

              $servic = ControladorServicio::CtrMostrarServicio($itemSer, $valorSer);

              $itemClie = "id";
              $valorClie = $value["cliente"];

              $cliente = ControladorClientesI::ctrMostrarClientesI($itemClie, $valorClie); 

              $itemMes = "id";
              $valorMes = $value["mes"];

              $mes = ControladorMeses::CtrMostrarMeses($itemMes, $valorMes);   
                
              echo '<tr>

                <td>'.($key+1).'</td>

                <td class="text-uppercase">'.$cliente["nombre"].'</td>
                <td class="text-uppercase">'.$servic["nombre"].'</td>
                <td class="text-uppercase">$ '.number_format($servic["precio"],2).'</td>
                <td class="text-uppercase">'.$mes["nombre"].'</td>
                <td class="text-uppercase">'.$value["comentarios"].'</td>
                <td class="text-uppercase">'.number_format($value["importe"],2).'</td>
                <td class="text-uppercase">'.$value["sucursal"].'</td>
                <td class="text-uppercase">'.$value["fecha"].'</td>


                <td>

                    <div class="btn-group">

                    <button class="btn btn-info btnImpriTick" idTick="'.$value["id"].'"><i class="fas fa-print"></i></button>

                    <button class="btn btn-warning btnImpriBoleta" idBoleta="'.$value["id"].'"><i class="fas fa-file-pdf"></i></button>';

                       if($_SESSION["perfil"] == "Administrador"){

                    echo '<button class="btn btn-danger btnEliminarPago" idPago="'.$value["id"].'"><i class="fa fa-trash"></i></button>

                    </div>  

                  </td>


                </tr>';

               } 
          }

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php
  
  $borrarPago = new ControladorPagos();
  $borrarPago -> ctrBorrarPago();

?>

      <?php 

        $TicketPago = new ControladorPagos();
        $TicketPago -> ticket();

       ?>