<?php 

	if (isset($_GET["idMsj"])) {
		
		$msj = ControladorSoporte::ctrMostrarTickets("id_soporte", $_GET["idMsj"]);
		
	} else {

		echo '<script>

			window.location = "chat";

		</script>';

	}

 ?>

 <?php if ($_GET["tipo"] == "recibidos"): ?>
 
 	<script >
    
        $('.menuReci').addClass("active");

	</script>
 
 <?php endif ?>

 <?php if ($_GET["tipo"] == "enviados"): ?>
 
 	<script >
    
        $('.menuEnvi').addClass("active");

	</script>
 
 <?php endif ?>


<div class="box box-primary box-outline">
	
	<!--=============================================
	=            CABECERA DE MENSAJE            =
	=============================================-->

	<div class="box-header">
		
		<h3 class="box-title">Leer mensaje</h3>

	</div>

	<!--=============================================
	=            CUERPO DE MENSAJE            =
	=============================================-->

	<div class="box-body p-0">
		
		<div class="mailbox-read-info">
			
			<h4><b>Asunto: </b><?php echo $msj[0]["asunto"]; ?></h4>

			<h6><span class="mailbox-read-time pull-right"><?php echo $msj[0]["fecha_soporte"]; ?></span></h6><br>

		</div>

		<div class="mailbox-controls with-border text-right">
			
			<div class="btn-group">
				
				<button type="button" class="btn btn-danger btn-sm btnPapelera" idTickets="<?php echo $msj[0]["id_soporte"]; ?>" idUsuario="<?php echo $_SESSION["id"]; ?>" data-toggle="tooltip" data-container="body" title="Eliminar">
					<i class="fa fa-trash"></i>
				</button>

				<?php 

					if ($_GET["tipo"] == "recibidos") {
						
						$para = ControladorUsuarios::ctrMostrarUsuarios("id", $msj[0]["remitente"]);

						$id_para = $msj[0]["remitente"];

						$direccion = array("Responder", '<i class="fas fa-reply-all"></i>');

					}

					if ($_GET["tipo"] == "enviados") {
						
						$para = ControladorUsuarios::ctrMostrarUsuarios("id", $msj[0]["receptor"]);

						$id_para = $msj[0]["receptor"];

						$direccion = array("Reenviar", '<i class="fa fa-share"></i>');
						
					}

				 ?>

				 <a href="index.php?ruta=chat&soporte=nuevo-ticket&para=<?php echo $para["nombre"]?>&asunto=<?php echo $msj[0]["asunto"]?>&id_para=<?php echo $id_para?>">
              		
						<button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-container="body" title="<?php echo $direccion[0]; ?>">
           		<?php echo $direccion[1]; ?>
            </button>

          </a>

			</div>

		</div>

		<!--=============================================	
		=            BODY DE MENSAJE            =
		=============================================-->

		<div class="mailbox-read-message p-4">
			
			<?php echo $msj[0]["mensaje"]; ?>

		</div>

	</div>

		<!--=============================================
		=            FOOTER DE MENSAJE            =
		=============================================-->

	<div class="box-footer bg-white">
		
		<ul class="mailbox-attachments clearfix">
			
			<?php 

				if($msj[0]["adjuntos"] != ""){

				$adjuntos = json_decode($msj[0]["adjuntos"], true);
				
					foreach($adjuntos as $key => $value) {
						
						if(substr($value, -3) == "png" || substr($value, -3) == "jpg" || substr($value, -4) == "jpeg"){

							echo '<li>
		                            
		                            <span class="mailbox-attachment-icon has-img"><img src="'.$value.'" alt="Attachment"></span><br>

		                            <div class="mailbox-attachment-info">

		                              <a href="'.$value.'" target="_blank" class="mailbox-attachment-name">
		                                <i class="fas fa-camera"></i> Imagen
		                              </a>
		                                  
		                              <a href="'.$value.'" target="_blank" class="btn btn-default btn-sm pull-right"><i class="fas fa-download"></i>
		                              </a>
		                                 
		                            </div>

		                    </li>';

		                }

						if(substr($value, -3) == "pdf"){

                    	echo '<li>

                            <span class="mailbox-attachment-icon"><i class="fas fa-file-pdf"></i></span>

                            <div class="mailbox-attachment-info">

                              <a href="'.$value.'" target="_blank" class="mailbox-attachment-name">
                                <i class="fas fa-papperclip"></i> PDF
                              </a>
                                  
                              <a href="'.$value.'" target="_blank" class="btn btn-default btn-sm pull-right"><i class="fa fa-download"></i>
                              </a>

                            </div>

                          </li>';

                  		}

                  		if(substr($value, -3) == "doc" || substr($value, -4) == "docx"){

                    	echo '<li>

                            <span class="mailbox-attachment-icon"><i class="fas fa-file-word"></i></span>

                            <div class="mailbox-attachment-info">

                              <a href="'.$value.'" target="_blank" class="mailbox-attachment-name">
                                <i class="fas fa-papperclip"></i> Word
                              </a>
                                  
                              <a href="'.$value.'" target="_blank" class="btn btn-default btn-sm pull-right"><i class="fa fa-download"></i>
                              </a>

                            </div>

                          </li>';

                  		}

                  		if(substr($value, -3) == "xls" || substr($value, -4) == "xlsx"){

                    	echo '<li>

                            <span class="mailbox-attachment-icon"><i class="fas fa-file-excel"></i></span>

                            <div class="mailbox-attachment-info">

                              <a href="'.$value.'" target="_blank" class="mailbox-attachment-name">
                                <i class="fas fa-papperclip"></i> Excel
                              </a>
                                  
                              <a href="'.$value.'" target="_blank" class="btn btn-default btn-sm pull-right"><i class="fa fa-download"></i>
                              </a>

                            </div>

                          </li>';

                  		}

					}

				}

			 ?>

		</ul>

		<div class="pull-right">

		<?php if ($_GET["tipo"] == "recibidos"): ?>

			<a href="index.php?ruta=chat&soporte=nuevo-ticket&para=<?php echo $para["nombre"]?>&asunto=<?php echo $msj[0]["asunto"]?>&id_para=<?php echo $id_para?>"> 
			  <button type="button" class="btn btn-primary"><i class="fa fa-reply"></i> Responder</button>
			 </a>
			
		<?php endif ?>

		<?php if ($_GET["tipo"] == "enviados"): ?>

			<a href="index.php?ruta=chat&soporte=nuevo-ticket&para=<?php echo $para["nombre"]?>&asunto=<?php echo $msj[0]["asunto"]?>&id_para=<?php echo $id_para?>">
			  <button type="button" class="btn btn-primary"><i class="fa fa-share"></i> Reenviar</button>
			</a>
			
		<?php endif ?>   
   
        </div>

        <button type="button" class="btn btn-danger btnPapelera" idTickets="<?php echo $msj[0]["id_soporte"]; ?>" idUsuario="<?php echo $_SESSION["id"]; ?>"><i class="fa fa-trash-o"></i> Eliminar</button>

	</div>

 </div>