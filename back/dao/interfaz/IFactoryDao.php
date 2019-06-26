<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Era más fácil crear un framework que aprender a usar uno existente  \\

include_once realpath('../dao/entities/AutorizacionDao.php');
include_once realpath('../dao/entities/EntradaDao.php');
include_once realpath('../dao/entities/IdentificadorDao.php');
include_once realpath('../dao/entities/IntentoDao.php');
include_once realpath('../dao/entities/PersonaDao.php');


interface IFactoryDao {
	
     /**
     * Devuelve una instancia de AutorizacionDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de AutorizacionDao
     */
     public function getAutorizacionDao($dbName);
     /**
     * Devuelve una instancia de EntradaDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de EntradaDao
     */
     public function getEntradaDao($dbName);
     /**
     * Devuelve una instancia de IdentificadorDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de IdentificadorDao
     */
     public function getIdentificadorDao($dbName);
     /**
     * Devuelve una instancia de IntentoDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de IntentoDao
     */
     public function getIntentoDao($dbName);
     /**
     * Devuelve una instancia de PersonaDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de PersonaDao
     */
     public function getPersonaDao($dbName);

}
//That's all folks!