<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-warning">

      <div class="box-header with-border ">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCliente">
          
          Agregar cliente

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>

         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Compras</th>
           <th>RFC</th>
           <th>CFDI</th>
           <th>Ùltima compra</th>
           <th>Opciones</th>

         </tr> 

        </thead>

        <tbody>
          
         <?php
            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value) {
              
              echo '<tr>
                     <td>'.($key+1).'</td>
                     <td class="text-uppercase">'.$value["nombre"].'</td>';

              echo '<td>'.$value["telefono"].'</td>
                     <td>'.$value["direccion"].'</td>
                     <td>'.$value["compras"].'</td>
                     <td>'.$value["rfc"].'</td>
                     <td>'.$value["cfdi"].'</td>
                     <td>'.$value["ultima_compra"].'</td>
                    
                  <td>';


                   if($_SESSION["perfil"] == "Administrador"){

                    echo '<div class="btn-group">
                      
                        <button class="btn btn-primary btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil-alt"></i></button>

                      <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-trash"></i></button>';

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
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#F39C12; color:white">

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

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL RFC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-genderless"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoRFC" placeholder="Ingresar RFC" >

              </div>

            </div>


            <!-- ENTRADA PARA EL CFDI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-certificate"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCFDI" placeholder="Ingresar CFDI" >

              </div>

            </div>
         </div>
 
      </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save ">Guardar cliente</button>

        </div>

      </form>
      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
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

        <div class="modal-header" style="background:#F39C12; color:white">

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

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>    
                <input type="hidden"  name="idCliente" id="idCliente">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>
                     <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>

              </div>

            </div>
           
                <!-- ENTRADA PARA EL RFC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-genderless"></i></span> 

                <input type="text" class="form-control input-lg" name="editarRFC" id="editarRFC">

              </div>

            </div>


            <!-- ENTRADA PARA EL CFDI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-certificate"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCFDI" id="editarCFDI" >

              </div>

            </div>

         </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save ">Guardar cliente</button>

        </div>

      </form>
      <?php
        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();
      ?>
 
    </div>

  </div>

</div>
      <?php
        $eliminarCliente = new ControladorClientes();
        $eliminarCliente -> ctrEliminarCliente();
      ?>