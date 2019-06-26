<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Tu alma nos pertenece... Salve Mr. Arciniegas  \\
include_once realpath('../facade/AutorizacionFacade.php');

class AutorizacionController{

function __construct(){}


  public function insert(){
    //$id = strip_tags($_POST['id']);
    $persona = new Persona();
    $persona->setCodigo(strip_tags($_POST['codigo']));
    $persona = IdentificadorFacade::selectByPersona($persona);
    
    $autorizador = new Persona();
    $autorizador->setCodigo(strip_tags($_POST['autorizadoPor']));
    $autorizador = IdentificadorFacade::selectByPersona($autorizador);
    
    $Entrada_id = strip_tags($_POST['entrada']);
    $entrada= new Entrada();
    $entrada->setId($Entrada_id);
    $date = strip_tags($_POST['date']);
    $d = date_create($date);
    $date = date_format($d, 'Y-m-d');

    $horaIni = strip_tags($_POST['horaIni']).":00";
    $horaFin = strip_tags($_POST['horaFin']).":00";
    AutorizacionFacade::insert( $persona, $autorizador, $entrada, $date, $horaIni, $horaFin);
    return "true";
  }

  public function plantillaList($list){
    $rta="";
    foreach ($list as $obj => $Autorizacion) {
      $rta.="{
         \"id\":\"{$Autorizacion->getid()}\",
        \"persona_rfid\":\"{$Autorizacion->getpersona()->getCodigo()}\",
        \"entrada_id\":\"{$Autorizacion->getentrada()->getid()}\",
        \"date\":\"{$Autorizacion->getdate()}\",
        \"horaIni\":\"{$Autorizacion->gethoraIni()}\",
        \"horaFin\":\"{$Autorizacion->gethoraFin()}\",
        \"autorizadoPor_rfid\":\"{$Autorizacion->getautorizadoPor()->getCodigo()}\"
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

  public function listAll(){
    $list=AutorizacionFacade::listAll();
    return self::plantillaList($list);
  }

  public function listByPersona(){
    $codigo = strip_tags($_POST['codigo']);
    $persona = new Persona();
    $persona->setCodigo($codigo);
    $list=AutorizacionFacade::listByPersona($persona);
    return self::plantillaList($list);
  }

  public function listByEntrada(){
    $Entrada_id = strip_tags($_POST['entrada']);
    $entrada= new Entrada();
    $entrada->setId($Entrada_id);
    $list=AutorizacionFacade::listByEntrada($entrada);
    return self::plantillaList($list);
  }

}
//That's all folks!