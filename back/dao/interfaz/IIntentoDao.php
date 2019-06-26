<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Bueno ¿y ahora qué?  \\


interface IIntentoDao {

    /**
     * Guarda un objeto Intento en la base de datos.
     * @param intento objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($intento);
    /**
     * Modifica un objeto Intento en la base de datos.
     * @param intento objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($intento);
    /**
     * Elimina un objeto Intento en la base de datos.
     * @param intento objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($intento);
    /**
     * Busca un objeto Intento en la base de datos.
     * @param intento objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($intento);
    /**
     * Lista todos los objetos Intento en la base de datos.
     * @return Array<Intento> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That's all folks!