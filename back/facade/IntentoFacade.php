<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    El código es tuyo, modifícalo como quieras  \\

require_once realpath('../facade/GlobalController.php');
require_once realpath('../dao/interfaz/IFactoryDao.php');
require_once realpath('../dto/Intento.php');
require_once realpath('../dao/interfaz/IIntentoDao.php');
require_once realpath('../dto/Identificador.php');
require_once realpath('../dto/Entrada.php');

class IntentoFacade {

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
   * Crea un objeto Intento a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param persona
   * @param time
   * @param entrada
   * @param isAutorizado
   */
  public static function insert( $id,  $persona,  $time,  $entrada,  $isAutorizado){
      $intento = new Intento();
      $intento->setId($id); 
      $intento->setPersona($persona); 
      $intento->setTime($time); 
      $intento->setEntrada($entrada); 
      $intento->setIsAutorizado($isAutorizado); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $intentoDao =$FactoryDao->getintentoDao(self::getDataBaseDefault());
     $rtn = $intentoDao->insert($intento);
     $intentoDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Intento de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @return El objeto en base de datos o Null
   */
  public static function select($id){
      $intento = new Intento();
      $intento->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $intentoDao =$FactoryDao->getintentoDao(self::getDataBaseDefault());
     $result = $intentoDao->select($intento);
     $intentoDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Intento  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param persona
   * @param time
   * @param entrada
   * @param isAutorizado
   */
  public static function update($id, $persona, $time, $entrada, $isAutorizado){
      $intento = self::select($id);
      $intento->setPersona($persona); 
      $intento->setTime($time); 
      $intento->setEntrada($entrada); 
      $intento->setIsAutorizado($isAutorizado); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $intentoDao =$FactoryDao->getintentoDao(self::getDataBaseDefault());
     $intentoDao->update($intento);
     $intentoDao->close();
  }

  /**
   * Elimina un objeto Intento de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   */
  public static function delete($id){
      $intento = new Intento();
      $intento->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $intentoDao =$FactoryDao->getintentoDao(self::getDataBaseDefault());
     $intentoDao->delete($intento);
     $intentoDao->close();
  }

  /**
   * Lista todos los objetos Intento de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Intento en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $intentoDao =$FactoryDao->getintentoDao(self::getDataBaseDefault());
     $result = $intentoDao->listAll();
     $intentoDao->close();
     return $result;
  }


}
//That's all folks!