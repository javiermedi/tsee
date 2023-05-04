<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Realizar servicio
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

      <!--=====================================
                F O R M U L A R I O
      ======================================-->
        
        <div class="box box-solid box-primary">
          
          <div class="box-header with-border">
            <h4>Servico <span class="fab fa-servicestack"></span></h4>
          </div>

          <form role="form" method="post" class="formularioServi">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right: 0px">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="idVendedorS" name="idVendedorS" value="<?php echo $_SESSION["nombre"];?>" readonly>
                    
                    <input type="hidden" name="idVendedorS" value="<?php echo $_SESSION["id"];?>">

                  </div>

                  </div>


                  <div class="form-group col-xs-3">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="ion ion-home"></i></span>

                      <select class="form-control" name="SucursalSer" id="SucursalSer" required>
                        
                        <option value="">Selecionar sucursal</option>

                        <option value="TAMAZULAPAM">TAMAZULAPAM</option>

                        <option value="TEJUPAM">TEJUPAM</option>

                      </select>

                    </div>

                  </div>
                      

                <!--=====================================
                        ENTRADA CODIGO
                ======================================-->
                
                <div class="col-lg-3">
                 
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                      $item = null;
                      $valor = null;

                       $ordenServicio = ControladorService::ctrMostrarOrdenService($item, $valor);
                       if (!$ordenServicio) {
                         echo '<input type="text" class="form-control" id="CodiOrdenSer" name="CodiOrdenSer" value="10001" readonly>';
                       }else {
                         foreach ($ordenServicio as $key => $value) {
                           # code...
                         }
                         $codigo = $value["codigo"] + 1;

                         echo '<input type="text" class="form-control" id="CodiOrdenSer" name="CodiOrdenSer" value="'.$codigo.'" readonly>';
                       }

                    ?>

                    </div>

                  </div>
                
                </div>

                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->
                 <?php

                      $item = null;
                      $valor = null;

                       $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                       if (!$ventas) {
                         echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                       }else {
                         foreach ($ventas as $key => $value) {
                           # code...
                         }
                         $codigoV = $value["codigo"] + 1;

                         echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigoV.'" readonly>';
                       }


                    ?>
                
                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group row">

                  <div class="col-lg-4" style="padding-right: 0px">
                   <label>Cliente</label>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  
                      <select class="form-control" id="selecCliente" name="selecCliente" required>

                      <?php

                      $item = null;
                      $valor = null;
                      $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($cliente as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                      ?>

                    </select>
                 
                  </div>
                
                </div>


                  <div class="col-lg-4" style="padding-right: 0px">
                   <label>Técnico</label>
                    <div class="input-group">
                     
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  
                      <select class="form-control" id="selecTecnico" name="selecTecnico" required>

                      <?php

                      $item = null;
                      $valor = null;
                      $tecnico = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                      foreach ($tecnico as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                      ?>

                    </select>
                 
                  </div>
                
                </div>

                <div class="col-lg-2">
                <br>
                  <div class="input-group">
                
                    <span class="input-group-addon"><button type="button" class="btn btn-success" data-toggle="modal" id="Agregarser" data-target="#modalAgregarServicio" data-dismiss="modal">Agregar servicio</button></span>

                  </div>
                
                </div>

                <div class="col-lg-2">
                <br>
                  <div class="input-group">
                
                    <span class="input-group-addon"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarProductoSer" data-dismiss="modal">Agregar producto</button></span>

                  </div>
                
                </div>

            </div>

                 <!--=====================================
                ENTRADA PARA agregar servicios
                ======================================--> 
                <h4 class="text-center">Servicios</h4>
                <div class="form-group row nuevoServicios" >
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <h4 class="text-center">Productos</h4>
                <div class="form-group row nuevoProductoSer">

                </div>

               <!--===============================================
               =            ENVIAR LAS LISTAS EN JSON            =
               ================================================-->
               
                <input type="hidden" id="listaProducS" name="listaProducS">
                
                <input type="hidden" id="listaServicio" name="listaServicio">

                <div class="row">

                  
                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-4">
                    
                  <table class="table">

                      <thead>

                        <tr>
                          <th>Total Servicio</th>
                          <th>Total Productos</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="number" class="form-control " min="0" id="TotalServicios" name="TotalServicios" placeholder="0000" total="" readonly>
                        
                            </div>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control " id="TotalProductoS" name="TotalProductoS" total="" placeholder="0000" readonly required>
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  
                  <!--=====================================
                          AGREGAR COMENTARIOS DE SERVICIO
                  ======================================-->
                  <div class="col-md-8">
                    
                  <div class="input-group">
                      <h4 class="text-center">Comentarios de Servicio</h4>
                    <textarea class="form-control input-lg" rows="2" cols="110" name="NuevocomentarioSer" id="NuevocomentarioSer" placeholder="Comentarios"></textarea>

                    <input type="hidden" id="Nuevocomentario" name="Nuevocomentario" value=" ">
                    <input type="hidden" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value=" ">

                  </div>

                  </div>

                </div>
                <br>

                <div class="row">
                   <div class="col-lg-4">
                 
                     <table class="table">

                      <thead>

                        <tr>
                          <th>Total Orden Servicio</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <!-- <td style="width: 50%">
                            
                            <div class="input-group">
                                                       
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoSer" name="nuevoImpuestoSer" placeholder="0">

                               <input type="hidden" name="nuevoPrecioNetoSer" id="nuevoPrecioNetoSer" required>
                        
                            </div>
                            </td> -->
                           <td style="width: 100%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control " id="nuevoTotalSer" name="nuevoTotalSer" total="" placeholder="0000" readonly required>
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>   
                
                </div>


                <div class="col-lg-4">
                </div>
                

                  <div class="col-lg-2">
                      <br>
                      <label>Pago</label>
                      <div class="input-group">
                        
                      <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                      <input type="number" class="form-control " id="nuevoEfectivoSer" name="nuevoEfectivoSer" total="" placeholder="0000"  required>
                
                      </div>             

                  </div>

                  <div class="col-lg-2" id="CambioEfectivoSer">
                    <br>
                    <label>Cambio</label>
                    <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>
                    
                    <input type="text" class="form-control " id="nuevoCambioSer" name="nuevoCambioSer" placeholder="0000" readonly >
                  </div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago" value="Efectivo">

                </div>
                  
              </div>
              <br>

          </div>

          <div class="box-footer">

            <button type="submit"    class="btn btn-success fa fa-save pull-right guardarOrdenServi"> Guardar Orden servicio</button>

          </div>

        </form>

        <?php

          $crearOrdenSevicio = new ControladorService();
          $crearOrdenSevicio -> ctrCrearOrdenService();
         
        ?>

        </div>

  </section>

</div>

<!--=======================M O D A L E S=========================-->

<!--=====================================
MODAL AGREGAR SERVICIO
======================================-->

<div id="modalAgregarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog ">

    <div class="modal-content">

        <!--=====================================
              CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#008648; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar servicio</h4>

        </div>

        <!--=====================================
              CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaServicio" width="100%">
              
              <thead>
                
                <tr class="bg-warning">
           
                   <th style="width:10px">#</th>
                   <th>Nombre Servicio</th>
                   <th>Costo</th>
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
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProductoSer" class="modal fade" role="dialog">
  
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
            
            <table class="table table-bordered table-striped dt-responsive tablaPser" width="100%">
              
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

          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> Salir</button>

        </div>
        
    </div>

  </div>

</div>


