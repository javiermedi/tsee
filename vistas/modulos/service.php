<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Administrar servicios
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-primary">

      <div class="box-header with-border">
  
        <button class="btn btn-warning glyphicon-plus" data-toggle="modal" data-target="#modalAgregarServicio">
          
          Agregar servicio

        </button>

        <a href="realizar-servicio">

            <button class="btn btn-success">
              
              Realizar servicio

            </button>

        </a>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr class="bg-success">
           
           <th style="width:10px">id</th>
           <th>Nombre</th>
           <th>Costo</th>
           <th>Opciones</th>

         </tr> 

        </thead>

       <tbody>

        <?php 

          $item = null;
          $valor = null;

          $Service = ControladorService::CtrMostrarService($item, $valor);


          foreach ($Service as $key => $value) {
            
            echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$value["nombre"].'</td>
              <td>$ '.number_format($value["costo"],2).'</td>
            
              <td>

                <div class="btn-group">
                  
                  <button class="btn btn-primary btnEditarService" idService="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarService"><i class="fa fa-pencil-alt"></i></button>';

              if($_SESSION["perfil"] == "Administrador"){

                  echo '<button class="btn btn-danger btnEliminarService" idService="'.$value["id"].'"><i class="fa fa-trash"></i></button>';
              }    

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

<!--=====================================
MODAL AGREGAR CATEGORIA
======================================-->

<div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#DD4B39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar Servicio <span class="fa fa-th pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoServicio" placeholder="Ingresar servicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="number" class="form-control input-lg" name="precioServicio" placeholder="Ingresar precio" step="any" required>

              </div>

            </div>

          </div>

        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left fa fa-close" data-dismiss="modal">  Salir</button>

          <button type="submit" class="btn btn-success fa fa-save">  Guardar servico</button>

        </div>

        <?php

          $crearService = new ControladorService();
          $crearService -> CtrCrearService();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarService" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#DD4B39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar servicio <span class="fa fa-pencil pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarService" id="editarService" required>

                <input type="hidden" name="idService" id="idService" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="number" class="form-control input-lg" name="EditarPrecioService"
                id="EditarPrecioService" step="any" required>

              </div>

            </div>

          </div>

        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left fa fa-close" data-dismiss="modal">  Salir</button>

          <button type="submit" class="btn btn-success fa fa-save">  Guardar cambios</button>

        </div>

 
        <?php

          $editarService = new ControladorService();
          $editarService -> ctrEditarService();

        ?>


      </form>

    </div>

  </div>

</div>

<?php
  
  $borrarService = new ControladorService();
  $borrarService -> ctrBorrarService();

?>
