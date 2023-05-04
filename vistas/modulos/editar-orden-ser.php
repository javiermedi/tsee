<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar orden servicio
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #F39C12">T S E E</span></li>
    
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
            

             
            <?php

            $item = "id";
            $valor = $_GET["idOrdenSer"];

            $ordenServicio = ControladorService::ctrMostrarOrdenService($item, $valor);
            

            $item = "id";
            $valor = $ordenServicio["id_tecnico"];
            $tecnicoA = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

             ?>
              
              <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right: 0px">
                  
                  <div class="input-group">
                  <?php
                  $item = "id";
                  $valor = $ordenServicio["id_vendedor"];
                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                  ?>
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="idVendedorS" name="idVendedorS" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                    
                    <input type="hidden" name="idVendedorS" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                  </div>
                
                <div class="form-group col-xs-3">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="ion ion-home"></i></span>
                       
                       <input type="text" class="form-control" name="SucursalSer"  id="SucursalSer"  value="<?php echo $ordenServicio["sucursal"] ?>" readonly>

                    </div>

                  </div>
                      

                <!--=====================================
                        ENTRADA  DEL Codigo
                ======================================-->
                
                <div class="col-lg-3">
                 
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                         <input type="text" class="form-control" id="CodiOrdenSerEditar" name="CodiOrdenSerEditar" value="<?php echo $ordenServicio["codigo"] ?>" readonly>

                  

                    </div>

                  </div>
                
                </div>

                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->

                <?php

                     
                if ($ordenServicio["codigoV"] == 0) {
                        
                      $item = null;
                      $valor = null;

                       $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);    

                       if (!$ventas) {
                         echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                       }else {
                        
                         foreach ($ventas as $key => $value) {
                           # code...
                         }
                         $codigo = $value["codigo"] + 1;

                         echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                       }
                }else{
                       $item = "codigo";
                      $valor = $ordenServicio["codigoV"];

                       $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                       
                         echo '<input type="hidden" class="form-control" id="nuevaVentas" name="nuevaVentas" value="'.$ordenServicio["codigoV"].'" readonly> 

                         <input type="hidden" class="form-control" id="idVenta" name="idVenta" value="'.$ventas["id"].'" readonly>';
                        
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
                   <?php
                      $item = "id";
                      $valor = $ordenServicio["id_cliente"];
                      $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                                    
                      echo'<input type="text" class="form-control" name="selecCliente"  id="selecCliente"  value="'.$cliente["nombre"].'" readonly> 
                      
                      <input type="hidden" name="idCliente" value="'.$cliente["id"].'"> 
                      ';
                    ?>

                    </select>
                 
                  </div>
                
                </div>


                  <div class="col-lg-4" style="padding-right: 0px">
                   <label>Técnico</label>
                    <div class="input-group">
                     
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  
                      <select class="form-control" id="selecTecnico" name="selecTecnico" required>';

                        <option value="<?php echo $tecnicoA["id"] ?>"><?php echo $tecnicoA["nombre"] ?></option>
                        
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

                  <?php 

                  $listarServicios = json_decode($ordenServicio["servicios"], true);
                  if ($ordenServicio["servicios"]!= null) {
                
                  foreach ($listarServicios as $key => $value) {
                    
                    echo'  <div class="row" style="padding:5px 15px">

                      <!-- Nombre del servicio -->
                    
                      <div class="col-xs-6" style="padding-right:0px">
                    
                        <div class="input-group">
                          
                          <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idService="'.$value["id"].'"><i class="fa fa-trash"></i></button></span>

                          <input type="text" class="form-control nuevoNombreServicio" idService="'.$value["id"].'" name="agregarServisio" value="'.$value["nombre"].'" readonly required>

                        </div>

                      </div>

                      <!-- Precio del servicio -->

                      <div class="col-xs-2 Prec">
                      
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                        <input type="number" class="form-control nuevoPrecioServ" name="nuevoPrecioServ" value="'.$value["precio"].'" readonly> 

                      </div>

                    </div>
                    
                  </div>';
                  }
                }
                  ?>

                </div>


                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <h4 class="text-center">Productos</h4>
                <div class="form-group row nuevoProductoSer">

                  <?php 

                  $listarProductos = json_decode($ordenServicio["productos"], true);
                  if ($ordenServicio["productos"]!= null) {
                   
                     foreach ($listarProductos as $key => $value) {
                    
                    $item = "id";
                    $valor = $value["id"];
                    $orden = "id";
                    
                    $respuestaP = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                    $stockAntiguo = $respuestaP["stock"]+ $value["cantidad"];

                 echo '<div class="row" style="padding:5px 15px">

                    <!-- Descripción del producto -->
                        
                        <div class="col-xs-6" style="padding-right:0px">
                        
                          <div class="input-group">
                            
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-trash"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProductoS" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>


                        <!-- Precio del producto -->

                        <div class="col-xs-2 ingresoPrec">
                          
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                              
                            <select class="form-control nuevoPrecioProduc" name="nuevoPrecioProduc" required>

                              <option value="'.$value["precio"].'">'.$value["precio"].'</option> 

                              <option value="'.$respuestaP["precio_venta"].'">'.$respuestaP["precio_venta"].'</option>

                              <option value="'.$respuestaP["precio_ventaa"].'">'.$respuestaP["precio_ventaa"].'</option>

                              <option value="'.$respuestaP["precio_ventaaa"].'">'.$respuestaP["precio_ventaaa"].'</option>

                            </select>

                          </div>

                        </div>
                        

                        <!-- Cantidad del producto -->

                        <div class="col-xs-2 ingresoCantidad">
                          
                           <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0.5" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" step="any" required>

                        </div>

                        
                       <!-- Precio Final del producto -->

                        <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                               
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$value["total"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
               
                          </div>
                           
                        </div>
                        
                      </div>';

                  }
                  }
                 

                  ?>

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

                              <input type="number" class="form-control " min="0" id="TotalServicios" name="TotalServicios" value="<?php echo $ordenServicio["totalS"] ?>" total="" readonly>
                        
                            </div>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control " id="TotalProductoS" name="TotalProductoS" total="" value="<?php echo $ordenServicio["totalP"] ?>" readonly>
                        
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
                    <textarea class="form-control input-lg" rows="2" cols="110" name="NuevocomentarioSer" id="NuevocomentarioSer" ><?php echo $ordenServicio["comentarios"] ?></textarea>
                    
                    <input type="hidden" id="Nuevocomentario" name="Nuevocomentario" value=" ">
                    <input type="hidden" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value=" ">
                    
                    <input type="hidden" id="NuevocomentarioSer" name="NuevocomentarioSer" value=" <?php echo $ordenServicio["comentarios"] ?>">
                
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

                              <input type="text" class="form-control " id="nuevoTotalSer" name="nuevoTotalSer" total="" value="<?php echo $ordenServicio["total"] ?>" readonly>
                        
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

                      <input type="number" class="form-control " id="nuevoEfectivoSer" name="nuevoEfectivoSer" total="" value="<?php echo $ordenServicio["importe"] ?>"  required>
                
                      </div>             

                  </div>

                  <div class="col-lg-2" id="CambioEfectivoSer">
                    <br>
                    <label>Cambio</label>
                    <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>
                    
                    <input type="text" class="form-control " id="nuevoCambioSer" name="nuevoCambioSer" value="<?php echo $ordenServicio["cambio"] ?>" readonly >
                  </div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago" value="Efectivo">

                </div>
                  
              </div>
              <br>

          </div>

          <div class="box-footer">

            <button type="submit"    class="btn btn-success fa fa-save pull-right ">Guardar cambios</button>

          </div>

        
        </form>

        <?php

          $editarOrdenSevicio = new ControladorService();
          $editarOrdenSevicio -> ctrEditarOrdenService();
         
        ?>

        </div>

  </section>

</div>

<!--=======================M O D A L E S=========================-->

<!--=====================================
MODAL AGREGAR PRODUCTO
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


