<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Reportes de Ventas

    </h1>

    <ol class="breadcrumb">
      
      <li class="active"><span style="color: #DD4B39">V E N S I</span></li>
    
    </ol>

  </section>

  <section class="content">

    
    <div class="box box-solid ">

      <div class="box-header with-border">
  
        <button type="button" class="btn btn-success " id="daterange-btn2">
              
          <span>
            <i class="fa fa-calendar"></i> Rango de fecha
          </span>

            <i class="fa fa-caret-down"></i>

        </button>


        <div class="box-tools pull-right">
        
   
        </div>

        <div class="box-body">
        
         <div class="row">
           
            <div class="col-xs-12">
              
              <?php

              include "reportes/grafico-ventas.php";

              ?>
            </div>

            <div class="col-md-6 col-xs-12" >
              
              <?php 

              include "reportes/vendedores.php"
 
              ?>

            </div>

            <div class="col-md-6 col-xs-12" >
              
              <?php 

              include "reportes/comprodores.php"
 
              ?>

            </div>
            
            

         </div>        
  
        </div>

      </div>
      
    </div>

  </section>

</div>

