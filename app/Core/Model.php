<?php

namespace App\Core;

use PDO;
use Database\Database;
use App\Utils\ValidateHttpMethod;

/**
 * Clase base para modelos que representan entidades en la base de datos.
 * Puede ser extendida para implementar funcionalidades específicas.
 */
class Model
{
  private const HTTP_METHOD_GET = "GET";
  private const HTTP_METHOD_POST = "POST";

  private const HTTP_METHOD_PUT = "PUT";

  private const HTTP_METHOD_DELETE = "DELETE";

  /**
   * @var int $id Identificador único de la entidad del modelo.
   */
  protected static int $id;

  protected static  $column;
  protected static  $value;

  /**
   * @var string $table Nombre de la tabla de la base de datos asociada al modelo.
   */
  protected static string $table;

  protected static array $data;


  /**
   * Retorna todas las filas de la tabla asociada al modelo en formato JSON.
   *
   * @return string Representación JSON de todas las filas de la tabla.
   */
  public static function get(): string
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_GET);

    $statement = database::getConnection()->query('SELECT * FROM ' . static::$table);

    return json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
  }






  public static function insert(array $data): string
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_POST);

    $columns = implode(', ', array_keys($data));
    $values = ':' . implode(', :', array_keys($data));

    $query = "INSERT INTO " . static::$table . " ($columns) VALUES ($values)";

    $statement = database::getConnection()->prepare($query);

    foreach ($data as $key => $value) {
      $statement->bindValue(":$key", $value);
    }

    $success = $statement->execute();

    if ($success) {
      return json_encode(['success' => 'Fila insertada correctamente a la tabla Users.']);
    } else {
      return json_encode(['error' => 'Error al insertar fila a la tabla Users.']);
    }
  }


       public static function update( int $id, $column, $value)
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_PUT);

    $query = "UPDATE " . static::$table . " SET $column = '$value'  WHERE id = $id";

    $statement = database::getConnection()->prepare($query);

    $success = $statement->execute();

    if ($success) {
      return json_encode(['success' => 'Fila eliminada.']);
    } else {
      return json_encode(['error' => 'Error al intentar eliminar fila.']);
    }
  }


  public static function delete(int $id)
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_DELETE);

    $query = "DELETE FROM " . static::$table . " WHERE id = $id";

    $statement = database::getConnection()->prepare($query);

    $success = $statement->execute();

    if ($success) {
      return json_encode(['success' => 'Fila eliminada.']);
    } else {
      return json_encode(['error' => 'Error al intentar eliminar fila.']);
    }
  }



}
