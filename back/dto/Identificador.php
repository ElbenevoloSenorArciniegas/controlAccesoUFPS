<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¡Muerte a todos los humanos!  \\


class Identificador {

  private $rfid;
  private $isAdmin;
  private $codigo;
  private $pass;

    /**
     * Constructor de Identificador
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a rfid
     * @return rfid
     */
  public function getRfid(){
      return $this->rfid;
  }

    /**
     * Modifica el valor correspondiente a rfid
     * @param rfid
     */
  public function setRfid($rfid){
      $this->rfid = $rfid;
  }
    /**
     * Devuelve el valor correspondiente a isAdmin
     * @return isAdmin
     */
  public function getIsAdmin(){
      return $this->isAdmin;
  }

    /**
     * Modifica el valor correspondiente a isAdmin
     * @param isAdmin
     */
  public function setIsAdmin($isAdmin){
      $this->isAdmin = $isAdmin;
  }
    /**
     * Devuelve el valor correspondiente a codigo
     * @return codigo
     */
  public function getCodigo(){
      return $this->codigo;
  }

    /**
     * Modifica el valor correspondiente a codigo
     * @param codigo
     */
  public function setCodigo($codigo){
      $this->codigo = $codigo;
  }


public function getPass(){
      return $this->pass;
  }

    /**
     * Modifica el valor correspondiente a codigo
     * @param codigo
     */
  public function setPass($pass){
      $this->pass = $pass;
  }

}
//That's all folks!