<?php

if($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Sub Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar tipos de internet
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-warning">

      <div class="box-header with-border">
  
        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarServicio">
          
          Agregar internet

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr class="bg-primary">
           
           <th style="width:10px">#</th>
           <th class="text-uppercase">Servicio</th>
           <th class="text-uppercase">velocidad</th>
           <th class="text-uppercase">Precio</th>
           <th class="text-uppercase">Opciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <?php 

            $item = null;

            $valor = null;

            $servicios = ControladorServicio::CtrMostrarServicio($item, $valor);

            foreach ($servicios as $key => $value) {
              echo '<tr>

                <td>'.($key+1).'</td>

                <td class="text-uppercase">'.$value["nombre"].'</td>

                <td >'.$value["intensidad"].' Mbps</td>

                <td>$'.number_format($value["precio"],2).'</td>

                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-primary btnEditarServicio" idservicio="'.$value["idservicio"].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-pencil-alt"></i></button>

                    <button class="btn btn-danger btnEliminarServicio" idservicio="'.$value["idservicio"].'"><i class="fa fa-trash"></i></button>

                  </div>  

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



<!--=====================================
MODAL AGREGAR SERVICIO
======================================-->

<div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar Servicio <span class="fa fa-th pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL SERVICIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoServicio" placeholder="Nombre Servicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL VELOCIDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-rss"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevaVelocidad" placeholder="Velocidad internet" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoPrecio" placeholder="Precio de Servicio" min="0" step="any" required>

              </div>

            </div>

          </div>

        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">  Salir</button>

          <button type="submit" class="btn btn-primary">  Guardar servicio</button>

        </div>

      </form>

      <?php

        $crearServicio = new ControladorServicio();
        $crearServicio -> ctrCrearServicio();

        ?>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar Servicio <span class="fa fa-pencil pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL SERVICIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarServicio" id="editarServicio" required>

                <input type="hidden" name="idServicio" id="idServicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL VELOCIDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-rss"></i></span> 

                <input type="number" class="form-control input-lg" name="EditarVelocidad" id="EditarVelocidad"  required>

              </div>

            </div>


            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="number" class="form-control input-lg" name="editarPrecio" id="editarPrecio" min="0" step="any" required>

              </div>

            </div>

          </div>

        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">  Salir</button>

          <button type="submit" class="btn btn-primary">  Guardar Servicio</button>

        </div>

        <?php

        $editarServicio = new ControladorServicio();
        $editarServicio -> ctrEditarServicio();

        ?>


      </form>

    </div>

  </div>

</div>


<?php
  
  $borrarServicio = new ControladorServicio();
  $borrarServicio -> ctrBorrarServicio();

?>


        