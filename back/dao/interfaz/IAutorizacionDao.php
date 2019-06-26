<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Somos los amish del software  \\


interface IAutorizacionDao {

    /**
     * Guarda un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($autorizacion);
    /**
     * Modifica un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($autorizacion);
    /**
     * Elimina un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($autorizacion);
    /**
     * Busca un objeto Autorizacion en la base de datos.
     * @param autorizacion objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($autorizacion);
    /**
     * Lista todos los objetos Autorizacion en la base de datos.
     * @return Array<Autorizacion> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That's all folks!