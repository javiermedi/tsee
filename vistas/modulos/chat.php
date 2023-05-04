<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Mensajes 
    
    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="container-fluid">
      
      <div class="content">
        
        <div class="row">
          
          <div class="col-md-3">
            
            <?php 

            include "soporte/botones.php";

            ?>

          </div>

          <div class="col-md-9">
            
            <?php 

            if (isset($_GET["soporte"])) {
              
              include "soporte/".$_GET["soporte"].".php";

            } else {

              include "soporte/nuevo-ticket.php";

            }

            ?>

          </div>

        </div>

      </div>

      <?php 

          //include "soporte/nuevo-ticket.php";

       ?>

    </div>

  </section>

</div>