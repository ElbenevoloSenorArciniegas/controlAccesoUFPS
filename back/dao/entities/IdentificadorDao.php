<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Si crees que las mujeres son difíciles, no conoces Anarchy  \\

include_once realpath('../dao/interfaz/IIdentificadorDao.php');
include_once realpath('../dto/Identificador.php');
include_once realpath('../dto/Persona.php');

class IdentificadorDao implements IIdentificadorDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Identificador en la base de datos.
     * @param identificador objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($identificador){
      $rfid=$identificador->getRfid();
$isAdmin=$identificador->getIsAdmin();
$codigo=$identificador->getCodigo()->getCodigo();

      try {
          $sql= "INSERT INTO `identificador`( `rfid`, `isAdmin`, `codigo`)"
          ."VALUES ('$rfid','$isAdmin','$codigo')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Identificador en la base de datos.
     * @param identificador objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($identificador){
      $rfid=$identificador->getRfid();

      try {
          $sql= "SELECT `rfid`, `isAdmin`, `codigo`"
          ."FROM `identificador`"
          ."WHERE `rfid`='$rfid'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $identificador->setRfid($data[$i]['rfid']);
          $identificador->setIsAdmin($data[$i]['isAdmin']);
           $persona = new Persona();
           $persona->setCodigo($data[$i]['codigo']);
           $identificador->setCodigo($persona);

          }
      return $identificador;      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function selectByPersona($persona){
      $codigo=$persona->getCodigo();
      $identificador = new Identificador();
      try {
          $sql= "SELECT `rfid` FROM `identificador` WHERE  `codigo` = '$codigo'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $identificador->setRfid($data[$i]['rfid']);
          }
      return $identificador;      
    } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Identificador en la base de datos.
     * @param identificador objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($identificador){
      $rfid=$identificador->getRfid();
$isAdmin=$identificador->getIsAdmin();
$codigo=$identificador->getCodigo()->getCodigo();

      try {
          $sql= "UPDATE `identificador` SET`rfid`='$rfid' ,`isAdmin`='$isAdmin' ,`codigo`='$codigo' WHERE `rfid`='$rfid' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Identificador en la base de datos.
     * @param identificador objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($identificador){
      $rfid=$identificador->getRfid();

      try {
          $sql ="DELETE FROM `identificador` WHERE `rfid`='$rfid'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Identificador en la base de datos.
     * @return ArrayList<Identificador> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `rfid`, `isAdmin`, `codigo`"
          ."FROM `identificador`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $identificador= new Identificador();
          $identificador->setRfid($data[$i]['rfid']);
          $identificador->setIsAdmin($data[$i]['isAdmin']);
           $persona = new Persona();
           $persona->setCodigo($data[$i]['codigo']);
           $identificador->setCodigo($persona);

          array_push($lista,$identificador);
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