<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Core\Model;
use Database\Database;
use App\Utils\ValidateHttpMethod;

class Users extends Model
{
  protected static string $table = 'users';

  //protected static array $data= ['name' => 'Julia','last_name' =>'Perez','age' =>  ];

  private const HTTP_METHOD_GET = "GET";

}
/* 
  public static function show()
  {
    ValidateHttpMethod::validateHttpMethod(self::HTTP_METHOD_GET);

    $id = explode('/', $_SERVER['REQUEST_URI'])[2];

    if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
      return json_encode(["error" => "ID de producto no válido o faltante."]);
    }

    try {
      $query = "SELECT * FROM products WHERE id = :id";
      $statement = Database::getConnection()->prepare($query);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();

      return json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
      return json_encode(["error" => "Error al obtener el producto {$e->getMessage()}"]);
    }
  }

if (!isset($requestData['name']) || !preg_match('/^[a-zA-Z]+$/', $requestData['name'])) {
       ^: Indica que la coincidencia debe comenzar al principio de la cadena.
      [a-zA-Z]: Es una clase de caracteres que coincide con cualquier letra de la 'a' a la 'z' tanto en mayúsculas como en minúsculas.
      +: Indica que debe haber una o más ocurrencias del patrón anterior (letras de 'a' a 'z' tanto en mayúsculas como en minúsculas).
      $: Indica que la coincidencia debe terminar al final de la cadena. 
      return json_encode(["error" => "El campo 'name' debe contener solo letras."]);
    }
 */