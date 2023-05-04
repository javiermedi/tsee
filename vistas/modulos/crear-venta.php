<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

      <!--=====================================
                F O R M U L A R I O
      ======================================-->
<div class="row">
  <div class="col-lg-12 col-xs-12">
        
        <div class="box box-solid box-success">
          
          <div class="box-header with-border">
            <h4>Carrito de Compras <span class="fa fa-cart-arrow-down"></span></h4>
          </div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group row">
                  <div class="col-xs-6" style="padding-right: 0px">
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"];?>" readonly>
                    
                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"];?>">

                  </div>

                  </div>


            <div class="form-group col-xs-3">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-home"></i></span>

                <select class="form-control" name="nuevaSucursal" id="nuevaSucursal" required>
                  
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

                       $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                       if (!$ventas) {
                         echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                       }else {
                         foreach ($ventas as $key => $value) {
                           # code...
                         }
                         $codigo = $value["codigo"] + 1;

                         echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
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
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

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
                    <span class="input-group-addon"><button type="button" class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal"> Agregar cliente</button></span>

                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="input-group">
                    <span class="input-group-addon"><button type="button" class="btn btn-danger fa fa-plus " data-toggle="modal" data-target="#modalAgregarProductoV" data-dismiss="modal"> Agregar producto</button></span>

                  </div>
                </div>

            </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>


                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-success hidden-lg btnAgregarProducto">Agregar producto</button>

                <br>

                <!--=====================================
                        AGREGAR COMENTARIOS DE VENTA
                ======================================-->
                <div class="input-group">
                    <h4 class="text-center">Comentarios de venta</h4>
                  <textarea class="form-control input-lg" rows="3" cols="120" name="Nuevocomentario" id="Nuevocomentario" placeholder="Comentarios"></textarea>

                </div>
                <br>


                <input type="hidden" id="listaProductos" name="listaProductos">

                <input type="hidden" id="listaProduc" name="listaProduc">
                

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

                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0">

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0000" readonly required>
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  <!--
                  <div class="col-xs-6" style="padding-right:0px">
                    
                    <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                                          
                      </select>    

                    </div>

                  </div>-->

                    
                    
                    <div class="col-xs-4"> 
                      <h4 class="text-center">Pago</h4>
                    <div class="input-group"> 

                     <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                      <input type="text" class="form-control input-lg" id="nuevoValorEfectivo" name="nuevoValorEfectivo" value="" placeholder="000000" required>

                    </div>

                   </div>

                   <div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">
                    <h4 class="text-center">Cambio</h4>
                    <div class="input-group">

                     <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                      <input type="text" class="form-control input-lg" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="000000" readonly required>

                    </div>

                   </div>
                  

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago" value="Efectivo">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-success fa fa-save pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>

</div>

  </section>

</div>






<!--=======================M O D A L E S=========================-->

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProductoV" class="modal fade" role="dialog">

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
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
              
              <thead>
                
                <tr class="bg-warning">
                    
                   <th style="width:10px">#</th>
                   <th>Descripción</th>
                   <th>Código</th>
                   <th>Cantidad</th>
                   <th>U/medida</th>
                   <th>P/venta1</th>
                   <th>P/venta2</th>
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

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-success pull-right fa fa-save ">Guardar cliente</button>

        </div>

      </form>
      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
      ?>

    </div>

  </div>

</div>


