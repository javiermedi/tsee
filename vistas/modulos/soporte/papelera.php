<script >
    
        $('.menuEli').addClass("active");

</script>

<div class="box box-primary">

    <div class="box-header with-border">

        <!--==============================
        =            CABECERA            =
        ===============================-->

        <h3 class="box-title"><b>Mensajes Eliminados </b> </h3>

        <div class="box-tools">
                
                <div class="mailbox-controls pb-4">
                        
                        <button type="button" class="btn btn-primary btn-sm checkbox-toggle"><i class="fa fa-square"></i></button>

                <div class="btn-group">
                    
                    <a href="#">
                        
                        <button type="button" class="btn btn-warning btn-sm btnPapelera" data-toggle="tooltip" title="Recuperar mensajes" idTickets idUsuario="<?php echo $_SESSION["id"]; ?>" tipoTickets="enviado">
                            <i class="fa fa-recycle"></i>
                        </button>

                    </a>

                </div>

                <a href="index.php?ruta=chat&soporte=papelera" class="btn btn-success btn-sm"><i class="fas fa-redo-alt"></i></a>

                </div>

        </div>

    </div>

    <!--==============================
    =        CUERPO DE MSJ          =
    ===============================-->

    <div class="box-body p-3 mailbox-messages">
        
        <input type="hidden" class="tipoMsj" value="papelera">

        <input type="hidden" class="idUsuario" value="<?php echo $_SESSION["id"];?>">

        <table class="table table-striped dt-responsive tablaMsj " width="100%">
            
            <thead>
                
                <tr class="bg-info">
                    
                    <th>Selec</th>
                    <th>Remitente</th>
                    <th>Receptor</th>
                    <th>Asunto</th>
                    <th>Adjunto</th>
                    <th>Fecha y hora</th>

                </tr>

            </thead>

            <tbody>
                
                <!-- <tr>
                    
                    <td><input type="checkbox"></td>
                    <td>Ruso</td>
                    <td>Permiso</td>
                    <td><i class="fa fa-paperclip"></i></td>
                    <th>2021-07-15 15:49:46</th>

                </tr> -->

            </tbody>

        </table>

    </div>

</div>
