<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>


<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Administrar categorías
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-danger">

      <div class="box-header with-border">
  
        <button class="btn btn-warning glyphicon-plus" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar categoría

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr class="bg-warning">
           
           <th style="width:10px">id</th>
           <th>Nombre</th>
           <th>Opciones</th>

         </tr> 

        </thead>

       <tbody>

        <?php 

          $item = null;
          $valor = null;

          $categorias = ControladorCategorias::CtrMostrarCategorias($item, $valor);


          foreach ($categorias as $key => $value) {
            
            echo '<tr>
              <td>'.($key+1).'</td>
              <td>'.$value["categoria"].'</td>
            
              <td>

                <div class="btn-group">
                  
                  <button class="btn btn-primary btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil-alt"></i></button>';

              if($_SESSION["perfil"] == "Administrador"){

                  echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-trash"></i></button>';
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

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#DD4B39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar categoria <span class="fa fa-th pull-left"></h4>

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

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoria" required>

              </div>

            </div>

          </div>

        </div>
            
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left fa fa-close" data-dismiss="modal">  Salir</button>

          <button type="submit" class="btn btn-success fa fa-save">  Guardar categoria</button>

        </div>

        <?php

          $crearCategorias = new ControladorCategorias();
          $crearCategorias -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#DD4B39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar categoria <span class="fa fa-pencil pull-left"></h4>

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

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                <input type="hidden" name="idCategoria" id="idCategoria" required>

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

          $editarCategorias = new ControladorCategorias();
          $editarCategorias -> ctrEditarCategoria();

        ?>


      </form>

    </div>

  </div>

</div>

<?php
  
  $borrarCategorias = new ControladorCategorias();
  $borrarCategorias -> ctrBorrarCategoria();

?>
