<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Ahora con 25% menos groserías  \\
include_once realpath('../facade/EntradaFacade.php');

class EntradaController{

function __construct(){}


  public function insert(){
    $id = strip_tags($_POST['id']);
    $descripcion = strip_tags($_POST['descripcion']);
    EntradaFacade::insert($id, $descripcion);
    return "true";
  }

  public function listAll(){
    $list=EntradaFacade::listAll();
    $rta="";
    foreach ($list as $obj => $Entrada) {
      $rta.="{
         \"id\":\"{$Entrada->getid()}\",
        \"descripcion\":\"{$Entrada->getdescripcion()}\"
	  },";
    }

    if($rta!=""){
	  $rta = substr($rta, 0, -1);
	  $msg="{\"msg\":\"exito\"}";
    }else{
	  $msg="{\"msg\":\"exito\"}";
	  $rta="{\"result\":\"No se encontraron registros.\"}";	
    }
    return "[{$msg},{$rta}]";
  }

}
//That's all folks!