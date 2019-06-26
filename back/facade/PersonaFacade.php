<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Somos los amish del software  \\

require_once realpath('../facade/GlobalController.php');
require_once realpath('../dao/interfaz/IFactoryDao.php');
require_once realpath('../dto/Persona.php');
require_once realpath('../dao/interfaz/IPersonaDao.php');

class PersonaFacade {

  /**
   * Para su comodidad, defina aquí el gestor de conexión predilecto para esta entidad
   * @return idGestor Devuelve el identificador del gestor de conexión
   */
  private static function getGestorDefault(){
      return DEFAULT_GESTOR;
  }
  /**
   * Para su comodidad, defina aquí el nombre de base de datos predilecto para esta entidad
   * @return dbName Devuelve el nombre de la base de datos a emplear
   */
  private static function getDataBaseDefault(){
      return DEFAULT_DBNAME;
  }
  /**
   * Crea un objeto Persona a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param codigo
   * @param nombre
   * @param img
   */
  public static function insert( $codigo,  $nombre,  $img){
      $persona = new Persona();
      $persona->setCodigo($codigo); 
      $persona->setNombre($nombre); 
      $persona->setImg($img); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $personaDao =$FactoryDao->getpersonaDao(self::getDataBaseDefault());
     $rtn = $personaDao->insert($persona);
     $personaDao->close();
     return $persona;
  }

  /**
   * Selecciona un objeto Persona de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param codigo
   * @return El objeto en base de datos o Null
   */
  public static function select($codigo){
      $persona = new Persona();
      $persona->setCodigo($codigo); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $personaDao =$FactoryDao->getpersonaDao(self::getDataBaseDefault());
     $result = $personaDao->select($persona);
     $personaDao->close();
     return $result;
  }


  /**
   * Modifica los atributos de un objeto Persona  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param codigo
   * @param nombre
   * @param img
   */
  public static function update($codigo, $nombre, $img){
      $persona = self::select($codigo);
      $persona->setNombre($nombre); 
      $persona->setImg($img); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $personaDao =$FactoryDao->getpersonaDao(self::getDataBaseDefault());
     $personaDao->update($persona);
     $personaDao->close();
     return $persona;
  }

  /**
   * Elimina un objeto Persona de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param codigo
   */
  public static function delete($codigo){
      $persona = new Persona();
      $persona->setCodigo($codigo); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $personaDao =$FactoryDao->getpersonaDao(self::getDataBaseDefault());
     $personaDao->delete($persona);
     $personaDao->close();
  }

  /**
   * Lista todos los objetos Persona de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Persona en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $personaDao =$FactoryDao->getpersonaDao(self::getDataBaseDefault());
     $result = $personaDao->listAll();
     $personaDao->close();
     return $result;
  }


}
//That's all folks!