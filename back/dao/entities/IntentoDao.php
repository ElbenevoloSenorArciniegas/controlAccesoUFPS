<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Por desgracia, mi epitafio será una frase insulsa y vacía  \\

include_once realpath('../dao/interfaz/IIntentoDao.php');
include_once realpath('../dto/Intento.php');
include_once realpath('../dto/Identificador.php');
include_once realpath('../dto/Entrada.php');

class IntentoDao implements IIntentoDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Intento en la base de datos.
     * @param intento objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($intento){
      $id=$intento->getId();
$persona=$intento->getPersona()->getRfid();
$time=$intento->getTime();
$entrada=$intento->getEntrada()->getId();
$isAutorizado=$intento->getIsAutorizado();

      try {
          $sql= "INSERT INTO `intento`( `id`, `persona`, `time`, `entrada`, `isAutorizado`)"
          ."VALUES ('$id','$persona','$time','$entrada','$isAutorizado')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Intento en la base de datos.
     * @param intento objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($intento){
      $id=$intento->getId();

      try {
          $sql= "SELECT `id`, `persona`, `time`, `entrada`, `isAutorizado`"
          ."FROM `intento`"
          ."WHERE `id`='$id'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $intento->setId($data[$i]['id']);
           $identificador = new Identificador();
           $identificador->setRfid($data[$i]['persona']);
           $intento->setPersona($identificador);
          $intento->setTime($data[$i]['time']);
           $entrada = new Entrada();
           $entrada->setId($data[$i]['entrada']);
           $intento->setEntrada($entrada);
          $intento->setIsAutorizado($data[$i]['isAutorizado']);

          }
      return $intento;      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Intento en la base de datos.
     * @param intento objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($intento){
      $id=$intento->getId();
$persona=$intento->getPersona()->getRfid();
$time=$intento->getTime();
$entrada=$intento->getEntrada()->getId();
$isAutorizado=$intento->getIsAutorizado();

      try {
          $sql= "UPDATE `intento` SET`id`='$id' ,`persona`='$persona' ,`time`='$time' ,`entrada`='$entrada' ,`isAutorizado`='$isAutorizado' WHERE `id`='$id' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Intento en la base de datos.
     * @param intento objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($intento){
      $id=$intento->getId();

      try {
          $sql ="DELETE FROM `intento` WHERE `id`='$id'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Intento en la base de datos.
     * @return ArrayList<Intento> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          /*$sql ="SELECT `id`, `persona`, `time`, `entrada`, `isAutorizado`"
          ."FROM `intento`"
          ."WHERE 1";*/
          $sql="SELECT  id.`codigo`, `entrada`, `time`, `isAutorizado` FROM `intento` i INNER JOIN `identificador` id ON i.`persona` = id.`rfid` WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $intento= new Intento();
           /*$identificador = new Identificador();
           $identificador->setRfid($data[$i]['persona']);*/
           $persona = new Persona();
           $persona->setCodigo($data[$i]['codigo']);
           $intento->setPersona($persona);
          $intento->setTime($data[$i]['time']);
           $entrada = new Entrada();
           $entrada->setId($data[$i]['entrada']);
           $intento->setEntrada($entrada);
          $intento->setIsAutorizado($data[$i]['isAutorizado']);

          array_push($lista,$intento);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

      public function insertarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $sentencia = null;
          return $this->cn->lastInsertId();
    }
      public function ejecutarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $data = $sentencia->fetchAll();
          $sentencia = null;
          return $data;
    }
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close(){
      $cn=null;
  }
}
//That's all folks!