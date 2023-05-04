<?php 

  $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title"><b>Crear nuevo mensaje </b> </h3>

  </div>

  <form method="post" enctype="multipart/form-data">
  
    <div class="box-body">

      <!--=====================================
      =   PARA QUIEN VA DIRIJIDO EL MENSAJE   =
      ======================================-->

      <div class="form-group">

         <input type="hidden" class="form-control" value="<?php echo $_SESSION["id"]; ?>" name="remitente">

        <label>Para:</label>

      <?php if ($_SESSION["usuario"] != "admin"): ?>

            <?php if (isset($_GET["para"])): ?>
          
              <input type="text" class="form-control" value="<?php echo $_GET["para"]; ?>" readonly required>

              <input type="hidden" class="form-control" name="receptor" value="<?php echo $_GET["id_para"]; ?>">

            <?php else: ?>

              <select class="form-control select2" name="receptor" style="width: 100%;">
            
                <option selected="selected">Seleccionar usuario</option>

              <?php foreach ($usuarios as $key => $value): ?>

                <?php if ($value["id"] != $_SESSION["id"]): ?>
                  
                  <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>

                <?php endif ?>
                
              <?php endforeach ?>

              </select>
              
            <?php endif ?> 

      <?php else: ?> 

        <?php if (isset($_GET["para"])): ?>
          
          <input type="text" class="form-control" value="<?php echo $_GET["para"]; ?>" readonly required>

          <input type="hidden" class="form-control" name="receptor" value="<?php echo $_GET["id_para"]; ?>">

        <?php else: ?>

          <select class="form-control select2" name="receptor[]" multiple="multiple" data-placeholder="Seleccionar usuarios" style="width: 100%;">

            <?php foreach ($usuarios as $key => $value): ?>

              <?php if ($value["id"] != $_SESSION["id"]): ?>
                
                <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>

              <?php endif ?>
              
            <?php endforeach ?>      

            <option value="0">Todos los usuarios</option>

          </select>

        <?php endif ?>

      <?php endif ?> 


      </div>

      <!--=====================================
      =   ASUNTO DEL MENSAJE   =
      ======================================-->

      <div class="form-group">

        <label>Asunto</label>

        <?php if (isset($_GET["asunto"])): ?>
            
          <input type="text" class="form-control" value="<?php echo $_GET["asunto"] ?>" name="asunto" readonly required>          

        <?php else: ?>

          <input type="text" class="form-control" name="asunto" required>

        <?php endif ?>

      </div>

      <!--=====================================
                =   EL MENSAJE   =
      ======================================-->

      <div class="form-group">

            <textarea id="compose-textarea" name="msj" class="form-control" style="height: 300px">


            </textarea>

      </div>

      <!--=====================================
        =   ARCHIVOS ADJUNTOS DEL MENSAJE   =
      ======================================-->

      <div class="form-group">

        <div class="btn btn-default btn-file">

          <i class="fa fa-paperclip"></i> Adjuntar
          <input type="file" class="subirAdjuntos" multiple>

          <input type="hidden" name="adjuntos" class="archivosTemporales">

        </div>

        <p class="help-block">Archivos con peso máximo de 32MB</p>

      </div>

    </div>
    
    <div class="box-footer">

        <ul class="mailbox-attachments clearfix">

        </ul>

      <div class="pull-right">

        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>

      </div>

      <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</button>

    </div>

  </form>

  <?php 

    $crearMensaje = new ControladorSoporte();
    $crearMensaje -> ctrCrearTicket();

  ?>
  

</div>
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>