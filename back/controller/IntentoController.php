<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Un generador de código no basta. Ahora debo inventar también un generador de frases tontas  \\
include_once realpath('../facade/IntentoFacade.php');

class IntentoController{

function __construct(){}


  public function insert(){
    $id = strip_tags($_POST['id']);
    $Identificador_rfid = strip_tags($_POST['persona']);
    $identificador= new Identificador();
    $identificador->setRfid($Identificador_rfid);
    $time = strip_tags($_POST['time']);
    $Entrada_id = strip_tags($_POST['entrada']);
    $entrada= new Entrada();
    $entrada->setId($Entrada_id);
    $isAutorizado = strip_tags($_POST['isAutorizado']);
    IntentoFacade::insert($id, $identificador, $time, $entrada, $isAutorizado);
    return "true";
  }

  public function listAll(){
    $list=IntentoFacade::listAll();
    $rta="";
    foreach ($list as $obj => $Intento) {
      $rta.="{
        \"persona_codigo\":\"{$Intento->getpersona()->getCodigo()}\",
        \"time\":\"{$Intento->gettime()}\",
        \"entrada_id\":\"{$Intento->getentrada()->getid()}\",
        \"isAutorizado\":\"{$Intento->getisAutorizado()}\"
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