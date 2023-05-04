<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar orden servicio
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #00C0EF">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-primary">

      <div class="box-header with-border">
  
        <a href="realizar-servicio">

            <button class="btn btn-warning">
              
              Agregar orden servico

            </button>

        </a>
        
       
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablasOrden">
         
        <thead>
         
         <tr class="bg-info">
           
           <th style="width:10px">#</th>
           <th>Sucursal</th>
           <th>Codigo</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Técnico</th>
           <th>Comentario</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Opciónes</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = Null;
          $valor = Null;


            $respuesta = ControladorService::ctrMostrarOrdenService($item, $valor);

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

                    echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                    $itemTecnico = "id";
                    $valorTecnico = $value["id_tecnico"];

                    $respuestaTecnico = ControladorUsuarios::ctrMostrarUsuarios($itemTecnico, $valorTecnico);

                    echo '<td>'.$respuestaTecnico["nombre"].'</td>
                    <td>'.$value["comentarios"].'</td>
                    <td>'.number_format($value["total"],2).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-info btnTicketOrdenServicio" codigo="'.$value["codigo"].'"><i class="fas fa-print"></i></button>  

                        <button class="btn btn-warning btnImprimirFacturaOrdenServicio" codigo="'.$value["codigo"].'"> <i class="fas fa-file-pdf"></i> </button> 

                        <button class="btn btn-success btnEditarOrdenServicio" idOrdenSer="'.$value["id"].'"> <i class="fa fa-pencil-alt"></i> </button>
                        ';

                      if($_SESSION["perfil"] == "Administrador"){

                        echo '<button class="btn btn-danger btnEliminarOrdenServicio" idOrdenServicio="'.$value["id"].'"><i class="fa fa-trash"></i></button>';
                      }

                     echo '</div>  

                    </td>

                  </tr>';
            }

        ?>


        </tbody>

       </table>

        <?php

        $eliminarOrndeServicio= new ControladorService();
        $eliminarOrndeServicio-> ctrEliminarOrdenServicio();

       ?>

      </div>

    </div>

  </section>

</div>
      



