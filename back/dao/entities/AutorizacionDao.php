<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Mátalos a todos, y que dios elija  \\

include_once realpath('../dao/interfaz/IAutorizacionDao.php');
include_once realpath('../dto/Autorizacion.php');
include_once realpath('../dto/Identificador.php');
include_once realpath('../dto/Identificador.php');
include_once realpath('../dto/Entrada.php');

class AutorizacionDao implements IAutorizacionDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
    public function insert($autorizacion){
$persona=$autorizacion->getPersona()->getRfid();
$autorizadoPor=$autorizacion->getAutorizadoPor()->getRfid();
$entrada=$autorizacion->getEntrada()->getId();
$date=$autorizacion->getDate();
$horaIni=$autorizacion->getHoraIni();
$horaFin=$autorizacion->getHoraFin();

      try {
          $sql= "INSERT INTO `autorizacion`(`persona`, `autorizadoPor`, `entrada`, `date`, `horaIni`, `horaFin`)"
          ."VALUES ('$persona','$autorizadoPor','$entrada','$date','$horaIni','$horaFin')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }


    /**
     * Busca un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($autorizacion){
      $id=$autorizacion->getId();

      try {
          $sql= "SELECT `id`, `persona`, `autorizadoPor`, `entrada`, `date`, `horaIni`, `horaFin`"
          ."FROM `autorizacion`"
          ."WHERE `id`='$id'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $autorizacion->setId($data[$i]['id']);
           $identificador = new Identificador();
           $identificador->setRfid($data[$i]['persona']);
           $autorizacion->setPersona($identificador);
           $identificador = new Identificador();
           $identificador->setRfid($data[$i]['autorizadoPor']);
           $autorizacion->setAutorizadoPor($identificador);
           $entrada = new Entrada();
           $entrada->setId($data[$i]['entrada']);
           $autorizacion->setEntrada($entrada);
          $autorizacion->setDate($data[$i]['date']);
          $autorizacion->setHoraIni($data[$i]['horaIni']);
          $autorizacion->setHoraFin($data[$i]['horaFin']);

          }
      return $autorizacion;      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($autorizacion){
      $id=$autorizacion->getId();
$persona=$autorizacion->getPersona()->getRfid();
$autorizadoPor=$autorizacion->getAutorizadoPor()->getRfid();
$entrada=$autorizacion->getEntrada()->getId();
$date=$autorizacion->getDate();
$horaIni=$autorizacion->getHoraIni();
$horaFin=$autorizacion->getHoraFin();

      try {
          $sql= "UPDATE `autorizacion` SET`id`='$id' ,`persona`='$persona' ,`autorizadoPor`='$autorizadoPor' ,`entrada`='$entrada' ,`date`='$date' ,`horaIni`='$horaIni' ,`horaFin`='$horaFin' WHERE `id`='$id' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($autorizacion){
      $id=$autorizacion->getId();

      try {
          $sql ="DELETE FROM `autorizacion` WHERE `id`='$id'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Autorizacion en la base de datos.
     * @return ArrayList<Autorizacion> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
    $where ="1";
    return $this->plantillaList($where);
  }

public function plantillaList($where){
  $lista = array();
      try {
          $sql ="SELECT `id`, id.`codigo`, idAuto.`codigo` as \"autorizadoPor\", `entrada`,  `date`, `horaIni`, `horaFin` "
          ."FROM `autorizacion` a "
          ."INNER JOIN `identificador` id ON a.`persona` = id.`rfid` "
          ."INNER JOIN `identificador` idAuto ON a.`persona` = idAuto.`rfid` WHERE ".$where;
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $autorizacion= new Autorizacion();
          $autorizacion->setId($data[$i]['id']);
           $persona = new Persona();
           $persona->setCodigo($data[$i]['codigo']);
           $autorizacion->setPersona($persona);
           $autorizadoPor = new Persona();
           $autorizadoPor->setCodigo($data[$i]['autorizadoPor']);
           $autorizacion->setAutorizadoPor($autorizadoPor);
           $entrada = new Entrada();
           $entrada->setId($data[$i]['entrada']);
           $autorizacion->setEntrada($entrada);
           $autorizacion->setDate($data[$i]['date']);
           $autorizacion->setHoraIni($data[$i]['horaIni']);
           $autorizacion->setHoraFin($data[$i]['horaFin']);

          array_push($lista,$autorizacion);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
}

  public function listByPersona($persona){
      $codigo = $persona->getCodigo();
      $where ="id.`codigo` = '$codigo'";
      return $this->plantillaList($where);
  }

  public function listByEntrada($entrada){
      $idEntrada = $entrada->getId();
      $where="`entrada` = '$idEntrada'";
      return $this->plantillaList($where);
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