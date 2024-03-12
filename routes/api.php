<?php


use App\Core\Route;
use App\Core\RouteCollection;
use App\Controllers\ProductController;
use App\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Rutas API
|--------------------------------------------------------------------------
|
| Aquí es donde se registran las rutas API de la aplicación.
|
*/


$routes = new RouteCollection();
/**
 * AddRoute proviene del archivo Route Collection dobde url ira enviado ahi a almacenar array 
 * Route:: get del archivo get de Route
 * '/about' es la URL de la ruta que se va capturar o evaluar.El '/about' significa que la ruta estará disponible en la URL http://noc.com/about.
 *  
 */
$routes->addRoute(Route::get('/about', [ProductController::class, 'index']));// [ProductController::class, 'index'] la clase de product controller y su funcion

$routes->addRoute(Route::post('/insert', [UsersController::class, 'insert'])); //[ProductController::class, 'index'] la clase de product controller y su funcion

$routes->addRoute(Route::delete('/delete', [UsersController::class, 'delete']));

$routes->addRoute(Route::put('/update', [UsersController::class, 'update']));

return $routes;
/* llamar la url por localhost/about en ves index.php es una version recortada la idea */

/*
Cuando un cliente realice una solicitud GET a http://noc.com/about, el sistema de enrutamiento llamará al método index del controlador ProductController.

[ProductController::class, 'index'] indica que se debe llamar al método index del ProductController cuando se acceda a la URL http://noc.com/about. la cual en el metodo que tiene ProductController
llama a User::get
 */