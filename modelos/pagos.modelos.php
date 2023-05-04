<?php

require_once "conexion.php";

class ModeloPagos{


  /*--=====================================
        MOSTRAR CATEGORIAS
  ======================================-->*/

  static public function mdlMostrarPagos($tabla, $item, $valor){

  	if($item != null){

  	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

  		}else{

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

  			$stmt -> execute();

  			return $stmt -> fetchAll();
  		}

  		$stmt -> close();

  		$stmt = null;


  }


  static public function mdlBorrarPago($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

  $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

  if ($stmt -> execute()) {
    
    return "ok";

  }else{

    return "error";
  }

  $stmt -> close();

  $stmt = null;

  }

  /*=============================================
  REGISTRO DE PAGOS
  =============================================*/

  static public function mdlIngresarPago($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(mes, cliente, servicio, importe, cambio, folio,vendedor, comentarios, sucursal, direccion, total) VALUES (:mes, :cliente, :servicio, :importe, :cambio, :folio,:vendedor, :comentarios, :sucursal, :direccion, :total)");


    $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_INT);
    $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
    $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
    $stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_INT);
    $stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
    $stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
    $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_INT);
    $stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
    $stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);


    if($stmt->execute()){

      return "ok";

    }else{

      return "error";
    
    }

    $stmt->close();
    $stmt = null;

  }

  
}