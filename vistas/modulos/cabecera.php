 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->	
	<a href="inicio" class="logo">
		
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/john.png" class="img-responsive" style="padding:10px">

		</span>

	</a>

	
	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->
	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" >
	 	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu bg-success">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

					if($_SESSION["foto"] != ""){

						echo '<img src="'.$_SESSION["foto"].'" class="user-image img-circle">';

					}else{


						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image img-circle">';

					}


					?>
						
						<span class="hidden-xs text-warning"><?php  echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu ">
						
						<li class="user-body bg-success">
							
							<div class="pull-right">
								<?php

					if($_SESSION["foto"] != ""){

						echo '<td><img src="'.$_SESSION["foto"].'" class="img-thumbnail img-circle" width="110px"></td>';

					}else{


						echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail img-circle" width="110px"></td>';

					}


					?>
					<p></p>
								<span class="bg-primary"><?php  echo $_SESSION["nombre"]; ?></span>
								<p></p>

								<span class="hidden-xs text-center bg-primary"><?php  echo $_SESSION["perfil"]; ?></span>
								<p></p>

								<a href="salir" class="btn btn-warning btn-flat fa fa-times pull-ceter"> Cerrar sesión</a>
								<p></p>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>