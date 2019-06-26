<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Has encontrado la frase #1024 ¡Felicidades! Ahora tu proyecto funcionará a la primera  \\


interface IEntradaDao {

    /**
     * Guarda un objeto Entrada en la base de datos.
     * @param entrada objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($entrada);
    /**
     * Modifica un objeto Entrada en la base de datos.
     * @param entrada objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($entrada);
    /**
     * Elimina un objeto Entrada en la base de datos.
     * @param entrada objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($entrada);
    /**
     * Busca un objeto Entrada en la base de datos.
     * @param entrada objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($entrada);
    /**
     * Lista todos los objetos Entrada en la base de datos.
     * @return Array<Entrada> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That's all folks!