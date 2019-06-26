<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Bueno ¿y ahora qué?  \\


class Autorizacion {

  private $id;
  private $persona;
  private $autorizadoPor;
  private $entrada;
  private $date;
  private $horaIni;
  private $horaFin;

    /**
     * Constructor de Autorizacion
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
     * Devuelve el valor correspondiente a autorizadoPor
     * @return autorizadoPor
     */
  public function getAutorizadoPor(){
      return $this->autorizadoPor;
  }

    /**
     * Modifica el valor correspondiente a autorizadoPor
     * @param autorizadoPor
     */
  public function setAutorizadoPor($autorizadoPor){
      $this->autorizadoPor = $autorizadoPor;
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
     * Devuelve el valor correspondiente a date
     * @return date
     */
  public function getDate(){
      return $this->date;
  }

    /**
     * Modifica el valor correspondiente a date
     * @param date
     */
  public function setDate($date){
      $this->date = $date;
  }
    /**
     * Devuelve el valor correspondiente a horaIni
     * @return horaIni
     */
  public function getHoraIni(){
      return $this->horaIni;
  }

    /**
     * Modifica el valor correspondiente a horaIni
     * @param horaIni
     */
  public function setHoraIni($horaIni){
      $this->horaIni = $horaIni;
  }
    /**
     * Devuelve el valor correspondiente a horaFin
     * @return horaFin
     */
  public function getHoraFin(){
      return $this->horaFin;
  }

    /**
     * Modifica el valor correspondiente a horaFin
     * @param horaFin
     */
  public function setHoraFin($horaFin){
      $this->horaFin = $horaFin;
  }


}
//That's all folks!