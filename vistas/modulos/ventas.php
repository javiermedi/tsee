<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #00C0EF">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-primary">

      <div class="box-header with-border">
  
        <a href="crear-venta">

            <button class="btn btn-warning">
              
              Agregar venta

            </button>

        </a>
        
        <button type="button" class="btn btn-success pull-right" id="daterange-btn">
              
          <span>
            <i class="fa fa-calendar"></i> Rango de fecha
          </span>

            <i class="fa fa-caret-down"></i>

        </button>

        <?php

        if (isset($_GET["fechaInicial"])) {
          
        echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte">';

        }

          ?>
        <button class="btn btn-danger pull-right" style="margin-right: 5px">Exportar a Excel</button>

        </a>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr class="bg-info">
           
           <th style="width:10px">#</th>
           <th>Sucursal</th>
           <th>Codigo</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Comentarios</th>
           <th>Neto</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Opciónes</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        if (isset($_GET["fechaInicial"])) {
          
          $fechaInicial = $_GET["fechaInicial"];
          $fechaFinal = $_GET["fechaFinal"];

        }else{

          $fechaInicial = Null;
          $fechaFinal = Null;

        }

            $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

            foreach ($respuesta as $key => $value) {
              echo '<tr>
                    <td>'.($key+1).'</td>
                    
                    <td>'.$value["sucursal"].'</td>';

                    if ($value["sucursal"] != "TAMAZULAPAM") {
                      echo '<td>TEJ'.$value["codigo"].'</td>';
                    }else{
                      echo '<td>TAM'.$value["codigo"].'</td>';
                    }
                    

                    $itemCliente = "id";
                    $valorCliente = $value["id_cliente"];

                    $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    echo '<td>'.$respuestaCliente["nombre"].'</td>';

                    $itemUsuario = "id";
                    $valorUsuario = $value["id_vendedor"];

                    $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    echo '<td>'.$respuestaUsuario["nombre"].'</td>
                    <td>'.$value["comentarios"].'</td>
                    <td>'.number_format($value["neto"],2).'</td>
                    <td>'.number_format($value["total"],2).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-info btnTicketVenta" codigoVenta="'.$value["codigo"].'"><i class="fas fa-print"></i></button>  

                        <button class="btn btn-warning btnImprimirFactura" codigoVenta="'.$value["codigo"].'"> <i class="fas fa-file-pdf"></i> </button>';

                      if($_SESSION["perfil"] == "Administrador"){

                        echo '<button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-trash"></i></button>';
                      }

                     echo '</div>  

                    </td>

                  </tr>';
            }

        ?>


        </tbody>

       </table>

       <?php

        $TicketVenta = new ControladorVentas();
        $TicketVenta -> ticket();

       ?>

       <?php

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();

      ?>



      </div>

    </div>

  </section>

</div>
      



