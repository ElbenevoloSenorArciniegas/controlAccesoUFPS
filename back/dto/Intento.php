<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Cansado de escribir bugs? tranquilo, los escribimos por ti  \\


class Intento {

  private $id;
  private $persona;
  private $time;
  private $entrada;
  private $isAutorizado;

    /**
     * Constructor de Intento
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a id
     * @return id
     */
  public function getId(){
      return $this->id;
  }

    /**
     * Modifica el valor correspondiente a id
     * @param id
     */
  public function setId($id){
      $this->id = $id;
  }
    /**
     * Devuelve el valor correspondiente a persona
     * @return persona
     */
  public function getPersona(){
      return $this->persona;
  }

    /**
     * Modifica el valor correspondiente a persona
     * @param persona
     */
  public function setPersona($persona){
      $this->persona = $persona;
  }
    /**
     * Devuelve el valor correspondiente a time
     * @return time
     */
  public function getTime(){
      return $this->time;
  }

    /**
     * Modifica el valor correspondiente a time
     * @param time
     */
  public function setTime($time){
      $this->time = $time;
  }
    /**
     * Devuelve el valor correspondiente a entrada
     * @return entrada
     */
  public function getEntrada(){
      return $this->entrada;
  }

    /**
     * Modifica el valor correspondiente a entrada
     * @param entrada
     */
  public function setEntrada($entrada){
      $this->entrada = $entrada;
  }
    /**
     * Devuelve el valor correspondiente a isAutorizado
     * @return isAutorizado
     */
  public function getIsAutorizado(){
      return $this->isAutorizado;
  }

    /**
     * Modifica el valor correspondiente a isAutorizado
     * @param isAutorizado
     */
  public function setIsAutorizado($isAutorizado){
      $this->isAutorizado = $isAutorizado;
  }


}
//That's all folks!