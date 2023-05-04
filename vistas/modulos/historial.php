
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Historial de pagos atrasados
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active">Pagos</li>
    
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
           <th class="text-uppercase">nombre</th>
           <th class="text-uppercase">Dirección</th>
           <th class="text-uppercase">Telefono</th>
           <th class="text-uppercase">Servicio</th>
           <th class="text-uppercase">Estado de pago</th>
           <th class="text-uppercase">Opciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <?php
            $item = null;
            $valor = null;

            $clientes = ControladorClientesI::ctrMostrarClientesI($item, $valor);

            $mesActual = date("m");

            $boton='<button class="btn btn-danger btn-xs">Vencida</button>';

            foreach ($clientes as $key => $value) {
            
            if ($value["servicio"] != null) {
              
              switch ($mesActual) {
                  case 1:
                     
                     if ($value["enero"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }

                  break;
                  case 2:
                    
                    if ($value["febrero"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 3:

                     if ($value["marzo"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      } 

                  break;
                  case 4:
                      
                    if ($value["abril"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 5:
                      
                     if ($value["mayo"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      } 

                  break;
                  case 6:
                      
                     if ($value["junio"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      } 

                  break;
                  case 7:
                      
                    if ($value["julio"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 8:
                      
                    if ($value["agosto"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 9:
                      
                     if ($value["septiembre"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      } 

                  break;
                  case 10:
                      
                    if ($value["octubre"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 11:
                      
                    if ($value["noviembree"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  

                  break;
                  case 12:
                      
                    if ($value["diciembre"] == null) {
                        echo '<tr>
                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">'.$boton.'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>

                    </div>  

                  </td>

              </tr>';
                      }  
                      
                  break;
              }
              
              }
            }
          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>