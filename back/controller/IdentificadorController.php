<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Generar buen código o poner frases graciosas? ¡La frase! ¡La frase!  \\
include_once realpath('../facade/IdentificadorFacade.php');

class IdentificadorController{

function __construct(){}


  public function insert(){
    $rfid = strip_tags($_POST['rfid']);
    $isAdmin = strip_tags($_POST['isAdmin']);
    $Persona_codigo = strip_tags($_POST['codigo']);
    $persona= new Persona();
    $persona->setCodigo($Persona_codigo);
    IdentificadorFacade::insert($rfid, $isAdmin, $persona);
    return "true";
  }

  public function listAll(){
    $list=IdentificadorFacade::listAll();
    $rta="";
    foreach ($list as $obj => $Identificador) {
      $rta.="{
         \"rfid\":\"{$Identificador->getrfid()}\",
        \"isAdmin\":\"{$Identificador->getisAdmin()}\",
        \"codigo_codigo\":\"{$Identificador->getcodigo()->getcodigo()}\"
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