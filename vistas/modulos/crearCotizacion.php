<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear cotización
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

      <!--=====================================
                F O R M U L A R I O
      ======================================-->
        
        <div class="box box-solid box-success">
          
          <div class="box-header with-border">
            <h4>Carrito de Compras <span class="fa fa-cart-arrow-down"></span></h4>
          </div>

          <form role="form" method="post" class="formularioCotiz">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group row">
                  <div class="col-xs-6" style="padding-right: 0px">
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoRemiten" name="nuevoRemiten" value="<?php echo $_SESSION["nombre"];?>" readonly>
                    
                    <input type="hidden" name="idRemiten" value="<?php echo $_SESSION["id"];?>">

                  </div>

                  </div>


            <div class="form-group col-xs-3">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-home"></i></span>

                <select class="form-control" name="SucursalCot" id="SucursalCot" required>
                  
                  <option value="">Selecionar sucursal</option>

                  <option value="TAMAZULAPAM">TAMAZULAPAM</option>

                  <option value="TEJUPAM">TEJUPAM</option>

                </select>

              </div>

            </div>
                

                <!--=====================================
                        ENTRADA DEL VENDEDOR
                ======================================-->
                
                  <div class="col-lg-3">
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                      $item = null;
                      $valor = null;

                       $cotizacion = ControladorCotiz::ctrMostrarCotiz($item, $valor);
                       if (!$cotizacion) {
                         echo '<input type="text" class="form-control" id="CodCot" name="CodCot" value="10001" readonly>';
                       }else {
                         foreach ($cotizacion as $key => $value) {
                           # code...
                         }
                         $codigo = $value["codigo"] + 1;

                         echo '<input type="text" class="form-control" id="CodCot" name="CodCot" value="'.$codigo.'" readonly>';
                       }

                    ?>

                  </div>
                  </div>
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group row">

                  <div class="col-lg-8" style="padding-right: 0px">
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" id="selecCliente" name="selecCliente" required>

                      <?php

                      $item = null;
                      $valor = null;
                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($categorias as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                      ?>

                    </select>
                    </div>
                    </div>

                <div class="col-lg-2">
                  <div class="input-group">
                    <span class="input-group-addon"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="input-group">
                    <span class="input-group-addon"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarProductoCot" data-dismiss="modal">Agregar producto</button></span>

                  </div>
                </div>

            </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProductoCot">

                </div>

                <!--=====================================
                        AGREGAR COMENTARIOS DE VENTA
                ======================================-->
                <div class="input-group">
                    <h4 class="text-center">Comentarios de cotización</h4>
                  <textarea class="form-control input-lg" rows="3" cols="120" name="NuevocomentarioCot" id="NuevocomentarioCot" placeholder="Comentarios"></textarea>

                </div>

                <input type="hidden" id="listaProduct" name="listaProduct">
                

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoCot" name="nuevoImpuestoCot" placeholder="0">

                               <input type="hidden" name="nuevoPrecioNetoCot" id="nuevoPrecioNetoCot" required>
                        
                            </div>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalCoti" name="nuevoTotalCoti" total="" placeholder="0000" readonly required>
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-success fa fa-save pull-right">Guardar cotización</button>

          </div>

        </form>

        <?php

          $crearCotizacion = new ControladorCotiz();
          $crearCotizacion -> ctrCrearCotixacion();
         
        ?>

        </div>

  </section>

</div>

<!--=======================M O D A L E S=========================-->

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProductoCot" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
              CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#008648; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar producto</h4>

        </div>

        <!--=====================================
              CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaPCotiza" width="100%">
              
              <thead>
                
                <tr class="bg-warning">
           
                   <th style="width:10px">#</th>
                   <th>Descripción</th>
                   <th>Código</th>
                   <th>Cantidad</th>
                   <th>P/venta1</th>
                   <th>P/venta2</th>
                   <th>P/venta3</th>
                   <th>Imagen</th>
                   <th>Opciones</th>

                </tr>

              </thead>

            </table>            

         </div>
 
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal"> Salir</button>

        </div>
      
    </div>

  </div>

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

        <div class="modal-header" style="background:#008648; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar cliente</h4>

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
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoRFC" placeholder="Ingresar RFC" >

              </div>

            </div>


            <!-- ENTRADA PARA EL CFDI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCFDI" placeholder="Ingresar CFDI" >

              </div>

            </div>
         </div>
 
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-success pull-right">Guardar cliente</button>

        </div>

      </form>
      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
      ?>

    </div>

  </div>

</div>


