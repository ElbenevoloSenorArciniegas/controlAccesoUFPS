<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Sabías que Anarchy se generó a sí mismo?  \\

require_once realpath('../facade/GlobalController.php');
require_once realpath('../dao/interfaz/IFactoryDao.php');
require_once realpath('../dto/Autorizacion.php');
require_once realpath('../dao/interfaz/IAutorizacionDao.php');
require_once realpath('../dto/Identificador.php');
require_once realpath('../dto/Identificador.php');
require_once realpath('../dto/Entrada.php');

class AutorizacionFacade {

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
   * Crea un objeto Autorizacion a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param persona
   * @param autorizadoPor
   * @param entrada
   * @param date
   * @param horaIni
   * @param horaFin
   */
  public static function insert( $persona,  $autorizadoPor,  $entrada,  $date,  $horaIni,  $horaFin){
      $autorizacion = new Autorizacion();
      $autorizacion->setPersona($persona); 
      $autorizacion->setAutorizadoPor($autorizadoPor); 
      $autorizacion->setEntrada($entrada); 
      $autorizacion->setDate($date); 
      $autorizacion->setHoraIni($horaIni); 
      $autorizacion->setHoraFin($horaFin); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $rtn = $autorizacionDao->insert($autorizacion);
     $autorizacionDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Autorizacion de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @return El objeto en base de datos o Null
   */
  public static function select($id){
      $autorizacion = new Autorizacion();
      $autorizacion->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $result = $autorizacionDao->select($autorizacion);
     $autorizacionDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Autorizacion  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param persona
   * @param autorizadoPor
   * @param entrada
   * @param date
   * @param horaIni
   * @param horaFin
   */
  public static function update($id, $persona, $autorizadoPor, $entrada, $date, $horaIni, $horaFin){
      $autorizacion = self::select($id);
      $autorizacion->setPersona($persona); 
      $autorizacion->setAutorizadoPor($autorizadoPor); 
      $autorizacion->setEntrada($entrada); 
      $autorizacion->setDate($date); 
      $autorizacion->setHoraIni($horaIni); 
      $autorizacion->setHoraFin($horaFin); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $autorizacionDao->update($autorizacion);
     $autorizacionDao->close();
  }

  /**
   * Elimina un objeto Autorizacion de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   */
  public static function delete($id){
      $autorizacion = new Autorizacion();
      $autorizacion->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $autorizacionDao->delete($autorizacion);
     $autorizacionDao->close();
  }

  /**
   * Lista todos los objetos Autorizacion de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Autorizacion en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $result = $autorizacionDao->listAll();
     $autorizacionDao->close();
     return $result;
  }

  public static function listByPersona($persona){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $result = $autorizacionDao->listByPersona($persona);
     $autorizacionDao->close();
     return $result;
  }

  public static function listByEntrada($entrada){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $autorizacionDao =$FactoryDao->getautorizacionDao(self::getDataBaseDefault());
     $result = $autorizacionDao->listByPersona($entrada);
     $autorizacionDao->close();
     return $result;
  }

}
//That's all folks!