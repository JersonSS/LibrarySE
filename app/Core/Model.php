<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;
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



  public static function update(int $id, array $columns): string
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_PUT);

    // Obtener el nombre de las columnas y valores a actualizar
    $columnUpdates = [];
    foreach ($columns as $columnName => $value) {
      // Verificar si la columna existe en la tabla
      if (in_array($columnName, self::getColumns())) {
        // Añadir la columna y su nuevo valor a la lista de actualizaciones
        $columnUpdates[] = "$columnName = :$columnName";
      }
    }

    // Verificar si hay columnas para actualizar
    if (empty($columnUpdates)) {
      return json_encode(['error' => 'No se proporcionaron columnas válidas para actualizar.']);
    }

    // Crear la consulta SQL despues de haber verificado las columnas existentes de la tabla
    $query = "UPDATE " . static::$table . " SET " . implode(', ', $columnUpdates) . " WHERE id = :id";

    // Preparar la consulta
    $statement = database::getConnection()->prepare($query);

    // Asignar valores a los parámetros
    foreach ($columns as $columnName => $value) {
      if (in_array($columnName, self::getColumns())) {
        $statement->bindValue(":$columnName", $value);
      }
    }
    $statement->bindValue(":id", $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $success = $statement->execute();

    if ($success) {
      return json_encode(['success' => 'Fila actualizada correctamente.']);
    } else {
      return json_encode(['error' => 'Error al intentar actualizar fila.']);
    }
  }

  private static function getColumns(): array
  {
    try {
      $sql = Database::getConnection()->prepare('DESCRIBE ' . static::$table);
      $sql->execute();
      return array_column($sql->fetchAll(PDO::FETCH_ASSOC), 'Field');
    } catch (PDOException $e) {
      throw new Exception("No se pudieron recuperar las columnas de la tabla: " . $e->getMessage());
    }
  }



  public static function delete(int $id)
  {


    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_DELETE);

    $query = "DELETE FROM " . static::$table . " WHERE id = :id";

    $statement = database::getConnection()->prepare($query);

    $statement->bindValue(":id", $id, PDO::PARAM_INT);

    $success = $statement->execute();

    if ($success) {
      return json_encode(['success' => 'Fila eliminada.']);
    } else {
      return json_encode(['error' => 'Error al intentar eliminar fila.']);
    }
  }
}
