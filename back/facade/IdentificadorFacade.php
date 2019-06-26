<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Únicamente cuando se pierde todo somos libres para actuar.  \\

require_once realpath('../facade/GlobalController.php');
require_once realpath('../dao/interfaz/IFactoryDao.php');
require_once realpath('../dto/Identificador.php');
require_once realpath('../dao/interfaz/IIdentificadorDao.php');
require_once realpath('../dto/Persona.php');

class IdentificadorFacade {

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
   * Crea un objeto Identificador a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param rfid
   * @param isAdmin
   * @param codigo
   */
  public static function insert( $rfid,  $isAdmin,  $codigo){
      $identificador = new Identificador();
      $identificador->setRfid($rfid); 
      $identificador->setIsAdmin($isAdmin); 
      $identificador->setCodigo($codigo); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $rtn = $identificadorDao->insert($identificador);
     $identificadorDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Identificador de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param rfid
   * @return El objeto en base de datos o Null
   */
  public static function select($rfid){
      $identificador = new Identificador();
      $identificador->setRfid($rfid); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $result = $identificadorDao->select($identificador);
     $identificadorDao->close();
     return $result;
  }

  public static function login($codigo,$pass){
      $identificador = new Identificador();
      $identificador->setCodigo($codigo); 
      $identificador->setPass($pass); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $result = $identificadorDao->login($identificador);
     $identificadorDao->close();
     return $result;
  }

  public static function selectByPersona($persona){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $result = $identificadorDao->selectByPersona($persona);
     $identificadorDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Identificador  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param rfid
   * @param isAdmin
   * @param codigo
   */
  public static function update($rfid, $codigo){
      $identificador = self::select($rfid);
      $identificador->setCodigo($codigo); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $identificadorDao->update($identificador);
     $identificadorDao->close();
  }

  /**
   * Elimina un objeto Identificador de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param rfid
   */
  public static function delete($rfid){
      $identificador = new Identificador();
      $identificador->setRfid($rfid); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $identificadorDao->delete($identificador);
     $identificadorDao->close();
  }

  /**
   * Lista todos los objetos Identificador de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Identificador en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $identificadorDao =$FactoryDao->getidentificadorDao(self::getDataBaseDefault());
     $result = $identificadorDao->listAll();
     $identificadorDao->close();
     return $result;
  }


}
//That's all folks!