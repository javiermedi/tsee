<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

			

			<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<?php
			
		if ($_SESSION["perfil"] == "Administrador") {

			echo '<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';
		}
			

		if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Sub Administrador") {

			echo '<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>

			<li>

				<a href="productos">
					<i class="fab fa-product-hunt"></i>
					
					<span>Productos</span>

				</a>

			</li>';

		}

		if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Sub Administrador" || $_SESSION["perfil"] == "Vendedor") {

			echo '<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-cart"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-file-invoice-dollar"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							<i class="fa fa-cart-plus"></i>
							<span>Crear venta</span>

						</a>

					</li>

					<li>

						<a href="reportes">
							
							<i class="fa fa-chart-pie"></i>
							<span>Reportes de ventas</span>

						</a>

					</li>


				</ul>

			</li>';
			
		}	
?>
			

			<li class="treeview">

			<a href="#">

				<i class="fa fa-list-ul"></i>
				
				<span>Cotización</span>
				
				<span class="pull-right-container">
				
					<i class="fa fa-angle-left pull-right"></i>

				</span>

			</a>
					
			<ul class="treeview-menu">

			<li>

					<a href="cotizacion">
						
						<i class="fa fa-circle"></i>
						<span>Administar cotización</span>

					</a>

				</li>
	
				<li>

					<a href="crearCotizacion">
						
						<i class="fa fa-circle"></i>
						<span>Crear cotización</span>

					</a>

				</li>
				

			</ul>

		</li>			
			<!-- =========================================== 
						SERVICIOS
			=============================================-->
			<li class="treeview">

				<a href="#">

					<i class="fab fa-servicestack"></i>
					
					<span>Servicios</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="service">

							<i class="fa fa-concierge-bell"></i>
							
							<span>Servicios</span>

						</a>

					</li>

					<li>

						<a href="realizar-servicio">

							<i class="fas fa-laptop-medical"></i>
							<span>Crear servicio</span>

						</a>

					</li>

					<li>

						<a href="orden-servicio">

							<i class="fa fa-file-invoice-dollar"></i>
							<span>Administar servicios</span>

						</a>

					</li>
					

				</ul>

			</li>
			<!-- =========================================== 
						RENTA DE INTERNET 
			=============================================-->

			<li class="treeview">

				<a href="#">

					<i class="fa fa-broadcast-tower"></i>
					
					<span>Internet</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>
						
				<ul class="treeview-menu">

					<?php

				if ($_SESSION["perfil"] == "Administrador") {

					echo '<li>

						<a href="servicios">
							
							<i class="fa fa-circle"></i>
							<span>Servicios</span>

						</a>

					</li>';
				}

				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Sub Administrador" || $_SESSION["perfil"] == "Vendedor") {

					echo '<li>

						<a href="clientes-internet">
							
							<i class="fa fa-user-secret"></i>
							<span>Clientes</span>

						</a>

					</li>

					<li>

						<a href="pagos">
							
							<i class="fa fa-file-invoice-dollar"></i>
							<span>Administrar pagos</span>

						</a>

					</li>	
					
					<li>

						<a href="historial">
							<i class="fa fa-hand-holding-usd"></i>
							<span>Pago Atrasados</span>

						</a>

					</li>';
				}
					?>

				</ul>

			</li>

			<li>

				<a href="chat">

					<i class="fa fa-comments"></i>
					<span>Chat</span>

				</a>

			</li>

		</ul>

	 </section>

</aside>