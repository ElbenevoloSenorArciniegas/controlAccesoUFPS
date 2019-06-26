<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Un generador de código no basta. Ahora debo inventar también un generador de frases tontas  \\
    require_once realpath('../dao/factory/FactoryDao.php');

/**
   * Para su comodidad, defina aquÃ­ el gestor de conexiÃ³n predilecto para su proyecto
   */
    define("DEFAULT_GESTOR", FactoryDao::$MYSQL_FACTORY);
  /**
   * Para su comodidad, defina aquÃ­ el nombre de base de datos predilecto para su proyecto
   */    
    //define("DEFAULT_DBNAME", "controlaccesoufps");
  define("DEFAULT_DBNAME", "controlaccesoufpsproduccion");

//That's all folks!