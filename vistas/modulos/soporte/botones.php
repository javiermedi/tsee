<?php 

  $msjElimina = 0;

  $msjReci = ControladorSoporte::ctrMostrarTickets("receptor", $_SESSION["id"]);

  $totalMsjRecib = 0;

  foreach ($msjReci as $key => $value) {
    
    if ($value["tipo"] == "papelera") {
      
        $papelera = json_decode($value["papelera"], true);

        if (count($papelera) == 1) {
          
            if ($papelera[0] == $_SESSION["id"]) {
              
                --$totalMsjRecib;            
                ++$msjElimina;

            }

        }    

          if (count($papelera) == 2) {
          
            if ($papelera[0] == $_SESSION["id"] || $papelera[1] == $_SESSION["id"]) {
              
                --$totalMsjRecib;            
                ++$msjElimina;

            }

          }

    }

    ++$totalMsjRecib;

  }


  $msjEnvia= ControladorSoporte::ctrMostrarTickets("remitente", $_SESSION["id"]);

  $totalMsjEnvia = 0;

  foreach ($msjEnvia as $key => $value) {
    
    if ($value["tipo"] == "papelera") {
      
        $papelera = json_decode($value["papelera"], true);

        if (count($papelera) == 1) {
          
            if ($papelera[0] == $_SESSION["id"]) {
              
                --$totalMsjEnvia;  
                ++$msjElimina;          

            }

        }    

        if (count($papelera) == 2) {
        
          if ($papelera[0] == $_SESSION["id"] || $papelera[1] == $_SESSION["id"]) {
            
              --$totalMsjEnvia; 
              ++$msjElimina;           

          }

        }

    }    

    ++$totalMsjEnvia;

  }

 ?>

<a href="chat" class="btn btn-primary btn-block margin-bottom" >Crear mensaje</a>    

  <div class="box box-solid">

    <div class="box-header with-border">

      <h3 class="box-title">Carpetas</h3>

      <div class="box-tools">

        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

      </div>

    </div>


    <div class="box-body no-padding">

      <ul class="nav nav-pills nav-stacked">
                                    
        <li class="menuReci"><a href="index.php?ruta=chat&soporte=recibidos"><i class="fa fa-inbox"></i> Recibidos
          <span class="label label-primary pull-right"><?php echo $totalMsjRecib; ?></span></a></li>

        <li class="menuEnvi"><a href="index.php?ruta=chat&soporte=enviados"><i class="fas fa-comment"></i> Enviados
          <span class="label label-success pull-right"><?php echo $totalMsjEnvia; ?></span></a></li>
        
        <li class="menuEli"><a href="index.php?ruta=chat&soporte=papelera"><i class="fas fa-trash-alt"></i> Papelera
        <span class="label label-danger pull-right"><?php echo $msjElimina; ?></span></a></li>

      </ul>

    </div>
    
  </div>

  