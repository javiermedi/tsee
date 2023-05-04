<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Inicio
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
       <?php

        include "reportes/cajas-superiores.php";

        ?>
    </div>
    <div class="row">

      <div class="col-md-6 col-xs-12">
              
              <?php 

              include"reportes/productos-mas-vendidos.php";

              ?>

            </div> 


            <div class="col-md-6 col-xs-12">
              
              <?php 

              include"reportes/productos-recientes.php";

              ?>

            </div>
      
    </div>

  </section>

</div>