
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cobros de internet
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol> 

  </section>

  <section class="content">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-solid box-success">
            <div class="box-header with-border">
              <h2 class="box-title text-center text-uppercase">Datos del cliente</h2>
            </div>
            
            <div class="box-body">
              
          <?php
                
                $id = $_GET["idClient"];
                $item = "id";
                $valor = $id;

                $servic = ControladorClientesI::ctrMostrarClientesI($item, $valor);
              
              echo ' <h4 class="text-uppercase"><b>Nombre:</b> '.$servic["nombre"].'</h4> 
                <h4 class="text-uppercase"><b>Dirección:</b> '.$servic["direccion"].'</h4>
                <h4 class="text-uppercase"><b>teléfono:</b> '.$servic["telefono"].'</h4>
                <h4 class="text-uppercase"><b>rfc:</b> '.$servic["rfc"].'</h4>';

                $item = "idservicio";
                $valor = $servic["servicio"];

                $servis = ControladorServicio::CtrMostrarServicio($item, $valor);
                
                echo ' <h4 class="text-uppercase"><b>Servicio:</b> '.$servis["nombre"].'</h4>';

          ?>

            </div>

          </div>
          <!-- = = = = = = = = = = = = = = = = = = = = = = = = = = = = = -->

          <div class="box box-solid box-danger">
            <div class="box-header">
              <h3 class="box-title text-uppercase">Pago de servicio.</h3>
            </div>
          
            <div class="box-body">
                
                 <?php
                
                $id = $_GET["idClient"];
                $item = "id";
                $valor = $id;

                $clent = ControladorClientesI::ctrMostrarClientesI($item, $valor);

                $item = "idservicio";
                $valor = $clent["servicio"];

                $servis = ControladorServicio::CtrMostrarServicio($item, $valor);

                echo ' <h1 class="text-uppercase text-center"><b>Total a pagar:</b> $'.number_format($servis["precio"],2).'</h1>';

          ?>

            </div>
          
          </div>
          
        </div>
        <!-- /.col -->
        <div class="col-md-6">

          <div class="box box-solid box-warning">
            <div class="box-header">
              <?php

                $año = date("Y");

                echo '<h3 class="box-title text-uppercase">Pagos del año '.$año.'</h3>';
                ?>
              
            </div>
            
      <form role="form" method="post" class="formularioPago">

            <div class="box-body">
    <!-- = = = = = = = = = = = = = = = = = = = = = = = = = = = = = -->            
            <div class="form-group row">

                <div class="col-xs-12 col-sm-4">
                
                  <div class="input-group">
                  
                <?php

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["enero"]!=null) {
                    echo '<h5 class="box-title text-uppercase">enero '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">enero '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);
                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["febrero"]!=null) {
                    echo '<h5 class="box-title text-uppercase">febrero '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">febrero '.$pendiente.'</h5>';
                  }
                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);
                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["marzo"]!=null) {
                    echo '<h5 class="box-title text-uppercase">marzo '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">marzo '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);
                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["abril"]!=null) {
                    echo '<h5 class="box-title text-uppercase">abril '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">abril '.$pendiente.'</h5>';
                  } 

                ?>
                  
                    

                  </div>

                </div>

                <!-- 12 meses retantes -->

                <div class="col-xs-12 col-sm-4">
                
                  <div class="input-group">

      
               <?php

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["mayo"]!=null) {
                    echo '<h5 class="box-title text-uppercase">mayo '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">mayo '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];

                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["junio"]!=null) {
                    echo '<h5 class="box-title text-uppercase">junio '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">junio '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["julio"]!=null) {
                    echo '<h5 class="box-title text-uppercase">julio '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">julio '.$pendiente.'</h5>';
                  }
                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["agosto"]!=null) {
                    echo '<h5 class="box-title text-uppercase">agosto '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">agosto '.$pendiente.'</h5>';
                  } 

                ?>
                    
                  </div>

                </div>
    
               <div class="col-xs-12 col-sm-4">
                
                  <div class="input-group">

               <?php

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["septiembre"]!=null) {
                    echo '<h5 class="box-title text-uppercase">septiembre '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">septiembre '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["octubre"]!=null) {
                    echo '<h5 class="box-title text-uppercase">octubre '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">octubre '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["noviembree"]!=null) {
                    echo '<h5 class="box-title text-uppercase">noviembre '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">noviembre '.$pendiente.'</h5>';
                  }

                  $item = "id";
                  $valor = $_GET["idClient"];
                  $mesesPag = ControladorClientes::ctrMostrarClientes($item, $valor);

                  $pagado='<button class="btn btn-success btn-xs">Pagado</button>';
                  $pendiente='<button class="btn btn-info btn-xs">Pendiente</button>';

                  if ($mesesPag["diciembre"]!=null) {
                    echo '<h5 class="box-title text-uppercase">diciembre '.$pagado.'</h5>';
                  }else{
                    echo '<h5 class="box-title text-uppercase">diciembre '.$pendiente.'</h5>';
                  }  

                ?>
                    
                  </div>

                </div>

            </div>
              

      <!-- = = = = = = = = = = = = = = = = = = = = = = = = = = = = = -->
              <br>
              <br>
              <div class="form-group col-xs-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-home"></i></span>

                <select class="form-control input-lg" name="nuevaSucursal" id="nuevaSucursal" required>
                  
                  <option value="">Selecionar sucursal</option>

                  <option value="TAMAZULAPAM">TAMAZULAPAM</option>

                  <option value="TEJUPAM">TEJUPAM</option>

                </select>

              </div>

            </div>

            <?php

                      $item = null;
                      $valor = null;

                       $pagos = ControladorPagos::CtrMostrarPagos($item, $valor);
                       if (!$pagos) {
                         echo '<input type="hidden" class="form-control" id="nuevoFolio" name="nuevoFolio" value="20001" readonly>';
                       }else {
                         foreach ($pagos as $key => $value) {
                           # code...
                         }
                         $folio = $value["folio"] + 1;

                         echo '<input type="hidden" class="form-control input-lg" id="nuevoFolio" name="nuevoFolio" value="'.$folio.'" required>';
                       }

                    ?>

            <div class="form-group col-xs-6"> 
                      
              <div class="input-group"> 

               <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>

                <select class="form-control input-lg" name="nuevoMes" id="nuevoMes" required>
                  
                  <option value="">Selecionar mes</option>

                  ?>
                  <?php

                  $item = null;
                  $valor = null;

                  $mese = ControladorMeses::CtrMostrarMeses($item, $valor);

                  foreach ($mese as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!--=====================================
                        AGREGAR COMENTARIOS DE VENTA
                ======================================-->
            <div class="input-group">
              <h4 class="text-center">Comentarios de pago</h4>
              <textarea class="form-control input-lg" rows="3" cols="120" name="NuevocomenPag" id="NuevocomenPag" placeholder="Comentarios"></textarea>

            </div>
            <br>

                <div class="col-xs-5" style="margin-left: 55px"> 
                      <h4 class="text-center"><b>Pago</b></h4>
                    <div class="input-group"> 

                     <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                      <input type="number" class="form-control input-lg" id="nuevoPagoS" name="nuevoPagoS" placeholder="000000" required>

                      <input type="hidden" class="form-control input-lg" id="nuevaDirec" name="nuevaDirec" value="" placeholder="000000" required>

                    </div>

                </div>

                <?php
                date_default_timezone_set('America/Mexico_City');

                $fecha = date('d-m-Y');
                $hora = date('H:i:s');

                $fechaActual = $fecha.' '.$hora;

                echo '<input type="hidden" class="form-control input-lg" id="nuevaFecha" name="nuevaFecha" value="'.$fechaActual.'" required>';


                //= = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

                $itemClien = "id";
                $valorClien = $_GET["idClient"];

                $clientes = ControladorClientesI::ctrMostrarClientesI($itemClien, $valorClien);

                $item = "idservicio";
                $valor = $clientes["servicio"];

                $servis = ControladorServicio::CtrMostrarServicio($item, $valor);
                
                $precio = $servis["precio"];

                echo ' <input type="hidden" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" value="'.$valorClien.'" step="any" required>

                <input type="hidden" class="form-control input-lg" id="nuevoServicio" name="nuevoServicio" value="'.$valor.'" step="any" required>

                

                <input type="hidden" class="form-control input-lg" id="nuevoPrecioPago" name="nuevoPrecioPago" value="'.$precio.'" step="any" required>';


                ?>

                <input type="hidden" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["id"];?>">

                <div class="col-xs-5" id="capturarCambioEfectivo" style="padding-left:0px">
                    <h4 class="text-center"><b>Cambio</b></h4>
                  <div class="input-group">

                     <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                      <input type="text" class="form-control input-lg" id="CambioPago" name="CambioPago" step="any" value="" placeholder="000000" readonly required>

                  </div>

                </div>

                <div class="col-xs-12">
                    <br>
                  <button type="submit" class="btn btn-lg btn-success pull-right">Guardar pago</button>
                    <br>
                  <br>
                </div>

            </div>

            </form>

            <?php 

              $guardarPago = new ControladorPagos();

              $guardarPago -> ctrCrearVenta();

            ?>
            
          </div>
          
        </div>
        
      </div>
      
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-uppercase">Historial de pagos.</h3>
            </div>
          
            <div class="box-body">
                
                 <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr class="bg-info">
           
           <th style="width:10px">id</th>
           <th>Nombre</th>
           <th>Folio</th>
           <th>Servicio</th>
           <th>Mes</th>
           <th>Importe</th>

         </tr> 

        </thead>

       <tbody>

        <?php 

          $ruso = null;
          $john = null;

          $pagos = ControladorPagos::CtrMostrarPagos($ruso, $john);

          foreach ($pagos as $key => $value) {  

            if ($value["cliente"] == $_GET["idClient"]) {


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

                <td class="text-uppercase">'.$cliente["nombre"].'</td>';

                if ($value["sucursal"] != "TAMAZULAPAM") {
                  echo '<td class="text-uppercase">TEJ'.$value["folio"].'</td>';
                }else{
                  echo '<td class="text-uppercase">TAM'.$value["folio"].'</td>';
                }
                

               echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                <td class="text-uppercase">'.$mes["nombre"].'</td>
                <td class="text-uppercase">'.$value["importe"].'</td>
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



