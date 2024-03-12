<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
  public function insert()
  {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data,true);
    $user = [
        "name" =>  $data['name'],
        "last_name" =>  $data['last_name'],
        "age" =>  $data['age'],
        "email" =>  $data['email']
    ];
    echo Users::insert($user);


    //echo Users::insert($data);
  }

  public function delete()
  {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data,true);
    
    echo Users::delete($data['id']);

  }

  public function update()
  {
    $json_data = file_get_contents('php://input');

    $data = json_decode($json_data,true);
    
    echo Users::update($data['id'], "name", "Loaiza");

  }





  


}