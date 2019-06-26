<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../dao/interfaz/IPersonaDao.php');
include_once realpath('../dto/Persona.php');

class PersonaDao implements IPersonaDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Persona en la base de datos.
     * @param persona objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($persona){
      $codigo=$persona->getCodigo();
$nombre=$persona->getNombre();
$img=$persona->getImg();

      try {
          $sql= "INSERT INTO `persona`( `codigo`, `nombre`, `img`)"
          ."VALUES ('$codigo','$nombre','$img')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Persona en la base de datos.
     * @param persona objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($persona){
      $codigo=$persona->getCodigo();
      $persona=null;
      try {
          $sql= "SELECT `codigo`, `nombre`, `img`"
          ."FROM `persona`"
          ."WHERE `codigo`='$codigo'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {

          $persona = new Persona();
          $persona->setCodigo($data[$i]['codigo']);
          $persona->setNombre($data[$i]['nombre']);
          $persona->setImg($data[$i]['img']);

          }
      return $persona;      
    } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Persona en la base de datos.
     * @param persona objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($persona){
      $codigo=$persona->getCodigo();
$nombre=$persona->getNombre();
$img=$persona->getImg();

      try {
          $sql= "UPDATE `persona` SET`codigo`='$codigo' ,`nombre`='$nombre' ,`img`='$img' WHERE `codigo`='$codigo' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Persona en la base de datos.
     * @param persona objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($persona){
      $codigo=$persona->getCodigo();

      try {
          $sql ="DELETE FROM `persona` WHERE `codigo`='$codigo'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Persona en la base de datos.
     * @return ArrayList<Persona> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `codigo`, `nombre`, `img`"
          ."FROM `persona`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $persona= new Persona();
          $persona->setCodigo($data[$i]['codigo']);
          $persona->setNombre($data[$i]['nombre']);
          $persona->setImg($data[$i]['img']);

          array_push($lista,$persona);
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