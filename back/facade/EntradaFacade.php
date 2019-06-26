<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Quédate con quien te quiera por tu back-end, no por tu front-end  \\

require_once realpath('../facade/GlobalController.php');
require_once realpath('../dao/interfaz/IFactoryDao.php');
require_once realpath('../dto/Entrada.php');
require_once realpath('../dao/interfaz/IEntradaDao.php');

class EntradaFacade {

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
   * Crea un objeto Entrada a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param descripcion
   */
  public static function insert( $id,  $descripcion){
      $entrada = new Entrada();
      $entrada->setId($id); 
      $entrada->setDescripcion($descripcion); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $entradaDao =$FactoryDao->getentradaDao(self::getDataBaseDefault());
     $rtn = $entradaDao->insert($entrada);
     $entradaDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Entrada de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @return El objeto en base de datos o Null
   */
  public static function select($id){
      $entrada = new Entrada();
      $entrada->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $entradaDao =$FactoryDao->getentradaDao(self::getDataBaseDefault());
     $result = $entradaDao->select($entrada);
     $entradaDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Entrada  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @param descripcion
   */
  public static function update($id, $descripcion){
      $entrada = self::select($id);
      $entrada->setDescripcion($descripcion); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $entradaDao =$FactoryDao->getentradaDao(self::getDataBaseDefault());
     $entradaDao->update($entrada);
     $entradaDao->close();
  }

  /**
   * Elimina un objeto Entrada de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   */
  public static function delete($id){
      $entrada = new Entrada();
      $entrada->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $entradaDao =$FactoryDao->getentradaDao(self::getDataBaseDefault());
     $entradaDao->delete($entrada);
     $entradaDao->close();
  }

  /**
   * Lista todos los objetos Entrada de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Entrada en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $entradaDao =$FactoryDao->getentradaDao(self::getDataBaseDefault());
     $result = $entradaDao->listAll();
     $entradaDao->close();
     return $result;
  }


}
//That's all folks!