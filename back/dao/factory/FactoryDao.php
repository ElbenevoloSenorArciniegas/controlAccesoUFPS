<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    A vote for Bart is a vote for Anarchy!  \\

include_once realpath('../dao/conexion/Conexion.php');
include_once realpath('../dao/interfaz/IFactoryDao.php');

class FactoryDao implements IFactoryDao{
	
     private $conn;
     public static $NULL_GESTOR = -1;
    public static $MYSQL_FACTORY = 0;
    public static $POSTGRESQL_FACTORY = 1;
    public static $ORACLE_FACTORY = 2;
    public static $DERBY_FACTORY = 3;

     public function __construct($gestor){
        $this->conn=new Conexion($gestor);
     }
     /**
     * Devuelve una instancia de AutorizacionDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de AutorizacionDao
     */
     public function getAutorizacionDao($dbName){
        return new AutorizacionDao($this->conn->obtener($dbName));
    }
     /**
     * Devuelve una instancia de EntradaDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de EntradaDao
     */
     public function getEntradaDao($dbName){
        return new EntradaDao($this->conn->obtener($dbName));
    }
     /**
     * Devuelve una instancia de IdentificadorDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de IdentificadorDao
     */
     public function getIdentificadorDao($dbName){
        return new IdentificadorDao($this->conn->obtener($dbName));
    }
     /**
     * Devuelve una instancia de IntentoDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de IntentoDao
     */
     public function getIntentoDao($dbName){
        return new IntentoDao($this->conn->obtener($dbName));
    }
     /**
     * Devuelve una instancia de PersonaDao con una conexiÃ³n que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de PersonaDao
     */
     public function getPersonaDao($dbName){
        return new PersonaDao($this->conn->obtener($dbName));
    }

}
//That's all folks!