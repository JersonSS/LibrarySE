<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
  public function insert()
  {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data, true);
    $user = [
      "name" =>  $data['name'],
      "last_name" =>  $data['last_name'],
      "age" =>  $data['age'],
      "email" =>  $data['email']
    ];
    echo Users::insert($user);



  }

  public function delete()
  {

    
    $id = explode("/",$_SERVER['REQUEST_URI'])[5];
    var_dump($id);
    echo Users::delete($id);
  }



  public function update()
  {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    $id = explode("/",$_SERVER['REQUEST_URI'])[5];

    $response = Users::update($id, $data);

    echo $response;
  }
}
