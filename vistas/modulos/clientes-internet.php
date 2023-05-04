<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes Internet
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-danger">

      <div class="box-header with-border ">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCliente">
          
          Agregar cliente

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>

         <tr class="bg-primary">
           
           <th style="width:10px">#</th>
           <th class="text-uppercase">Nombre</th>
           <th class="text-uppercase">Servicio</th>
           <th class="text-uppercase">precio</th>
           <th class="text-uppercase">Teléfono</th>
           <th class="text-uppercase">Dirección</th>
           <th class="text-uppercase">RFC</th>
           <th class="text-uppercase">CFDI</th>
           <th class="text-uppercase">Fecha pago</th>
           <th class="text-uppercase">Opciones</th>

         </tr> 

        </thead>

        <tbody>
          
         <?php
            $item = null;
            $valor = null;

            $clientes = ControladorClientesI::ctrMostrarClientesI($item, $valor);

            foreach ($clientes as $key => $value) {
            
            if ($value["servicio"] != null) {
              
              echo '<tr>
                     <td>'.($key+1).'</td>
                     <td class="text-uppercase">'.$value["nombre"].'</td>';

                $item = "idservicio";
                $valor = $value["servicio"];

                $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                  echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                    <td class="text-uppercase">$'.number_format($servic["precio"],2).'</td>';

                     echo '<td>'.$value["telefono"].'</td>
                     <td class="text-uppercase">'.$value["direccion"].'</td>
                     <td>'.$value["rfc"].'</td>
                     <td>'.$value["cfdi"].'</td>
                     <td>'.$value["mensualidad"].'</td>

              <td>

                    <div class="btn-group">

                    <button class="btn btn-success btnCobrarClientI" idClientI="'.$value["id"].'"><i class="ion ion-social-usd"></i></button>';
                        
                        if($_SESSION["perfil"] == "Administrador"){

                    echo '<button class="btn btn-primary btnEditarClientI" data-toggle="modal" data-target="#modalEditarCliente" idClientI="'.$value["id"].'"><i class="fa fa-pencil-alt"></i></button>

                       <button class="btn btn-danger btnEliminarClientI" idClientI="'.$value["id"].'"><i class="fa fa-trash"></i></button>

                       <button class="btn btn-warning btnEliminarPagoC" idPagoCl="'.$value["id"].'"><i class="fas fa-sync-alt"></i></button>

                    </div>  

                  </td>

              </tr>';
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

      <?php
        $resetPago = new ControladorPagos();
        $resetPago -> ctrBorrarTodPagos();
      ?>



<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL 
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar cliente <span class="fa fa-users pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevClientI" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevTelClientI" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccionI" placeholder="Ingresar direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL RFC -->
            <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-genderless"></i></span> 

                    <input type="text" class="form-control input-lg" name="nuevoRFCI" placeholder="Ingresar RFC" >

                  </div>

                </div>

                <!-- ENTRADA PARA EL CFDI -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-certificate"></i></span> 

                    <input type="text" class="form-control input-lg" name="nuevoCFDII" placeholder="Ingresar CFDI" >
                    
                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SERVICIO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoServicioI" name="nuevoServicioI" required>
                  
                  <option value="">Seleccióne servicio</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorServicio::CtrMostrarServicio($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["idservicio"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


              <!-- ENTRADA PARA LA FECHA DE CONTRATACION -->
            
            <div class="form-group">
              
              <div class="input-group date">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaCont" placeholder="Ingresar fecha Contratacion" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="datepicker" required>

              </div>

            </div>


            <!-- ENTRADA PARA LA FECHA DE MESUALIDAD -->
            
            <div class="form-group">
              
              <div class="input-group date">
              
                <span class="input-group-addon"><i class="fas fa-calendar-day"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaMes" placeholder="Ingresar fecha mensualidad" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>

              </div>

            </div>

         </div>
 
      </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-primary pull-right">Guardar cliente</button>

        </div>

      </form>
      <?php
        $crearCliente = new ControladorClientesI();
        $crearCliente -> ctrCrearClienteI();
      ?>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL 
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar cliente <span class="fa fa-pencil pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editaClientI" id="editaClientI" required>

                <input type="hidden" class="form-control input-lg" name="idClienI" id="idClienI" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editaTelClientI" id="editaTelClientI" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editaDireccionI" id="editaDireccionI" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL RFC -->
            <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-genderless"></i></span> 

                    <input type="text" class="form-control input-lg" name="editaRFCI" id="editaRFCI">

                  </div>

                </div>

                <!-- ENTRADA PARA EL CFDI -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-certificate"></i></span> 

                    <input type="text" class="form-control input-lg" name="editaCFDII" id="editaCFDII">
                    
                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SERVICIO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editaServicioI" name="editaServicioI" required>
                  
                  <option value="">Seleccióne servicio</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorServicio::CtrMostrarServicio($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["idservicio"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


              <!-- ENTRADA PARA LA FECHA DE CONTRATACION -->
            
            <div class="form-group">
              
              <div class="input-group date">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="editaFechaCont" id="editaFechaCont" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="datepicker" required>

              </div>

            </div>


            <!-- ENTRADA PARA LA FECHA DE MESUALIDAD -->
            
            <div class="form-group">
              
              <div class="input-group date">
              
                <span class="input-group-addon"><i class="fas fa-calendar-day"></i></span> 

                <input type="text" class="form-control input-lg" name="editaFechaMes" id="editaFechaMes" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>

              </div>

            </div>

         </div>
 
      </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-primary pull-right">Guardar cliente</button>

        </div>

      </form>

          <?php
            $editarCliente = new ControladorClientesI();
            $editarCliente -> ctrEditarClienteI();
          ?>

    </div>

  </div>

</div>


  <?php
    $eliminarClienteI = new ControladorClientesI();
    $eliminarClienteI -> ctrEliminarClienteI();
  ?>