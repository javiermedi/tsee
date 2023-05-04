<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Administrar cotizaciónes
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-danger">

      <div class="box-header with-border">
  
        <a href="crearCotizacion">

            <button class="btn btn-warning">
              
              Crear cotización

            </button>

        </a>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr class="bg-warning">
           
           <th style="width:10px">id</th>
           <th>Código</th>
           <th>Remitente</th>
           <th>sucursal</th>
           <th>comentario</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Opciónes</th>


         </tr> 

        </thead>

       <tbody>

        <?php 

          $item = null;
          $valor = null;

          $Cotizacion = ControladorCotiz::ctrMostrarCotiz($item, $valor);


          foreach ($Cotizacion as $key => $value) {
            
            echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$value["codigo"].'</td>
              <td>'.$value["remitente"].'</td>
              <td>'.$value["sucursal"].'</td>
              <td>'.$value["comentarios"].'</td>
              <td>'.$value["total"].'</td>
              <td>'.$value["fecha"].'</td>

            
              <td>

                <div class="btn-group">
                  <button class="btn btn-warning btnCot" idCot="'.$value["id"].'"> <i class="fas fa-file-pdf"></i> </button>

                  <button class="btn btn-danger btnEliminarCot" idCot="'.$value["id"].'"><i class="fa fa-trash"></i></button>';
                  

               echo '</div>  

              </td>

            </tr>';

          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php
  
  $borrarCotizacion = new ControladorCotiz();
  $borrarCotizacion -> ctrBrorrarCotiz();

?>
