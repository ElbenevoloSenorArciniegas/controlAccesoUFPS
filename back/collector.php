<?php

function insertarConsulta($sql,$cn){
  $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sentencia=$cn->prepare($sql);
  $sentencia->execute(); 
  $sentencia = null;
  return $cn->lastInsertId();
}
function ejecutarConsulta($sql,$cn){
  $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sentencia=$cn->prepare($sql);
  $sentencia->execute(); 
  $data = $sentencia->fetchAll();
  $sentencia = null;
  return $data;
}


$rfid = $_GET["rfid"];
$entrada = $_GET["entrada"];

$isAutorizado=0;


date_default_timezone_set('America/Bogota');
$date = date('Y-m-d');
$time = date('H:i:s');

try {             
     $host = "localhost";
     $username = "root";
     $password = "C8Tl8JBm4OAjeMe1";
     $dbName="controlaccesoufpsproduccion";
     $cn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",$username,$password);
 }catch(Exception $e){
    die('Error : '.$e->getMessage());
}


try {

    $sql= "SELECT `rfid`, `isAdmin`, `codigo`"
          ."FROM `identificador`"
          ."WHERE `rfid`='$rfid'";
    $data = ejecutarConsulta($sql,$cn);
    if(count($data)>0) {
        $sql= "SELECT `id`, `persona`, `autorizadoPor`, `entrada`, `date`, `horaIni`, `horaFin`"
          ."FROM `autorizacion`"
          ."WHERE `persona` = '$rfid' AND `entrada` = '$entrada' AND `date`='$date' AND `horaIni`<='$time' AND '$time'<=`horaFin`";
        $data = ejecutarConsulta($sql,$cn);
        if(count($data)>0){
            $isAutorizado=1;
        }
    }else{
        $sql= "INSERT INTO `identificador`( `rfid`, `isAdmin`,`codigo`)"
          ."VALUES ('$rfid',0,0)";
        insertarConsulta($sql,$cn);
    }


    $sql= "INSERT INTO `intento`(`persona`,`entrada`, `isAutorizado`) VALUES ('$rfid','$entrada',$isAutorizado)";
    insertarConsulta($sql,$cn);
    /*$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia=$cn->prepare($sql);
    $sentencia->execute();*/
} catch (SQLException $e) {
    throw new Exception('Something is wrong. The best error message ever');
}

echo "respuesta".$isAutorizado;