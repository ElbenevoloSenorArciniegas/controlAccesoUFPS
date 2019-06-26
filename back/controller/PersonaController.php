<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Un generador de código no basta. Ahora debo inventar también un generador de frases tontas  \\
include_once realpath('../facade/PersonaFacade.php');

class PersonaController{

function __construct(){}


  public function insert(){
    $codigo = strip_tags($_POST['codigo']);
    $nombre = strip_tags($_POST['nombre']);
    $img = strip_tags($_POST['img']);
    PersonaFacade::insert($codigo, $nombre, $img);
    return "true";
  }

  public function listAll(){
    $list=PersonaFacade::listAll();
    $rta="";
    foreach ($list as $obj => $Persona) {
      $rta.="{
         \"codigo\":\"{$Persona->getcodigo()}\",
        \"nombre\":\"{$Persona->getnombre()}\",
        \"img\":\"{$Persona->getimg()}\"
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

  public function select(){
    $codigo = strip_tags($_POST['codigo']);
    $persona = PersonaFacade::select($codigo);
    if($persona!=null){
      $rta="{
         \"codigo\":\"{$persona->getcodigo()}\",
        \"nombre\":\"{$persona->getnombre()}\",
        \"img\":\"{$persona->getimg()}\"
      }";
    }else{
      $rta="{
         \"codigo\":\"Error\",
        \"nombre\":\"No encontrado\",
        \"img\":\"noImg\"
      }";
    }
    $msg="{\"msg\":\"exito\"}";
    return "[{$msg},{$rta}]";
  }

}
//That's all folks!