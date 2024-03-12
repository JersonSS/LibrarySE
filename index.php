<?php

header('Content-Type: application/json');

require 'autoload.php';
require 'vendor/autoload.php';

use App\Core\Dispatcher;

(new Dispatcher(require 'routes/api.php'))->dispatch();

//use App\Models\Category;
//use App\Models\Users;

//echo Users::get();
// echo Category::update();



