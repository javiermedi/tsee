<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>


<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #00A65A">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-success">

      <div class="box-header with-border">
  
        <button class="btn btn-warning glyphicon-plus" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
         
        <thead>
         
          <tr class="bg-success">
           
           <th style="width:10px">#</th>
           <th>Descripción</th>
           <th>Marca</th>
           <th>Código</th>
           <th>Núm/serie</th>
           <th>Categoría</th>
           <th>Cantidad</th>
           <th>U/medida</th>
           <th>P/compra</th>
           <th>P/venta</th>
           <th>Imagen</th>
           <th>Opciones</th>
           
         </tr> 

        </thead>

       </table>

       <input type="hidden" value="<?php $_SESSION["perfil"] ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar producto <span class="fa fa-product-hunt pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>


            <!-- ENTRADA PARA CODIGO Y SERIE-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                    <!-- ENTRADA PARA CODIGO -->                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                      <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO SERIE -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                      <input type="text" class="form-control input-lg" id="nuevaSerie" name="nuevaSerie" placeholder="Número de serie">

                  </div>
                </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" required>

              </div>

            </div>      

            <!-- ENTRADA PARA LA CANTIDAD Y UNIDAD DE MEDIDA-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                    <!-- ENTRADA PARA LA CANTIDAD -->
              
                    <div class="input-group">
              
                     <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                      <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Cantidad">

                    </div>

                </div>

                <!-- ENTRADA PARA UNIDAD DE MEDIDA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 

                <select class="form-control input-lg" name="nuevaMedida">
                  
                  <option value="">Unidad de medida</option>

                  <option value="M">M</option>

                  <option value="Pza">Pza</option>

                  <option value="Kg">Kg</option>

                </select>

              </div>

            </div>

          </div>            

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA 1-->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta 1" required>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA PRECIO VENTA2 -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVentaa" name="nuevoPrecioVentaa" min="0" step="any" placeholder="Precio de venta 2" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA 3-->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVentaaa" name="nuevoPrecioVentaaa" min="0" step="any" placeholder="Precio de venta 3" required>

                  </div>

                </div>

            </div>
            
            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Los chavis</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save ">Guardar producto</button>

        </div>

      </form>

        <?php

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar producto <span class="fa fa-pencil pull-left"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA CODIGO Y SERIE-->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                    <!-- ENTRADA PARA CODIGO -->                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                      <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

                  </div>

                </div>

                <!-- ENTRADA PARA SERIE -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                      <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" readonly required >

                  </div>
                </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-clipboard-list"></i><i class="fas fa-clipboard-list"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" required>

              </div>

            </div> 

             <!-- ENTRADA PARA LA CANTIDAD Y UNIDAD DE MEDIDA-->

          <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                    <!-- ENTRADA PARA LA CANTIDAD -->
              
                    <div class="input-group">
              
                     <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                     <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

                    </div>

                </div>

                <!-- ENTRADA PARA UNIDAD DE MEDIDA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
              
                    <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 

                  <select class="form-control input-lg" name="editarMedida">
                  
                      <option value="" id="editarMedida"></option>

                      <option value="M">M</option>

                      <option value="Pza">Pza</option>

                      <option value="Kg">Kg</option>

                    </select>

                  </div>

                </div>

              </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" required>

                  </div>

                </div>

            </div>


            <!-- ENTRADA PARA PRECIO VENTA2 -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVentaa" name="editarPrecioVentaa" min="0" step="any" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA 3-->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVentaaa" name="editarPrecioVentaaa" min="0" step="any" required>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save ">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      



