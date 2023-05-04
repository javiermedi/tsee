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
      
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #00C0EF">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-solid box-primary">

      <div class="box-header with-border">
  
        <button class="btn btn-info glyphicon-plus" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

      </div>

      <div class="box-body">
        
       <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr class="bg-info">
           
           <th style="width:10px">id</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Telefono</th>
           <th>Dirección</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Foto</th>
           <th>Último registro</th>
           <th>Opciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
       
       foreach ($usuarios as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td class="text-uppercase">'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["direccion"].'</td>';

                  echo '<td>'.$value["perfil"].'</td>';

                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                  }             

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail img-circle" width="60px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail img-circle" width="60px"></td>';

                  }

                  echo '<td>'.$value["ultimo_login"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-primary btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-alt"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-trash"></i></button>

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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar usuario <span class="fa fa-user pull-left"></h4>

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

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre y apellidos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>


            <!-- ENTRADA PARA TELEFONO -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>  

                    <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask>

                  </div>

                </div>

                <!-- ENTRADA PARA DIRECCION -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección">

                  </div>

                </div>

            </div>


            
            <!-- ENTRADA PARA PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Sub Administrador">Sub Administrador</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>



                <div class="form-group">
              
                  <div class="input-group">
              
                    <div class="panel text-center">SUBIR FOTO</div>

                    <input type="file" class="nuevaFoto" name="nuevaFoto">

                    <p class="help-block">Los chavis</p>

                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar img-circle" width="100px">

                  </div>

                </div>

             

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="btn btn-danger pull-left fa fa-close " data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save "> Guardar usuario</button>

        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar usuario <span class="fa fa-pencil pull-left"></h4>

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

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>


             <!-- ENTRADA PARA TELEFONO -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>  

                    <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>

                  </div>

                </div>

                <!-- ENTRADA PARA DIRECCION -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                    <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>

                  </div>

                </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Sub Administrador">Sub Administrador</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Los chavis</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar img-circle" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL <div class="modal-footer">
        ======================================-->

        <div class="modal-header" style="background:#3C8DBC; color:white">

          <button type="button" class="btn btn-danger pull-left fa fa-close" data-dismiss="modal"> Salir</button>

          <button type="submit" class="btn btn-warning pull-right fa fa-save "> Modificar usuario</button>

        </div>

     <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>

  </div>

</div>
<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 


