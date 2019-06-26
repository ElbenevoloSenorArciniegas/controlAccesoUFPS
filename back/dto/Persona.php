<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Más delgado  \\


class Persona {

  private $codigo;
  private $nombre;
  private $img;

    /**
     * Constructor de Persona
    */
     public function __construct(){}

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
    /**
     * Devuelve el valor correspondiente a nombre
     * @return nombre
     */
  public function getNombre(){
      return $this->nombre;
  }

    /**
     * Modifica el valor correspondiente a nombre
     * @param nombre
     */
  public function setNombre($nombre){
      $this->nombre = $nombre;
  }
    /**
     * Devuelve el valor correspondiente a img
     * @return img
     */
  public function getImg(){
      return $this->img;
  }

    /**
     * Modifica el valor correspondiente a img
     * @param img
     */
  public function setImg($img){
      $this->img = $img;
  }


}
//That's all folks!