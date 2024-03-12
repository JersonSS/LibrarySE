<?php

namespace App\Controllers;

use App\Models\Users;

class ProductController
{
  public function index()
  {
    echo Users::get();

    //echo Users::insert($data);
  }
}