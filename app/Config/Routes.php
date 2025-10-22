<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get("sobreNos", "Home::sobreNos");
$routes->get("veterinarios", "Home::veterinarios");
$routes->get("servicos", "Home::servicos");
$routes->get("precos", "Home::precos");
$routes->get("blog", "Home::blog");
$routes->get("contato", "Home::contato");
$routes->get("login", "Home::login");

//

$routes->group('Categoria', static function ($routes) {
    $routes->get('index', 'Categoria::index');
    $routes->get('form/(:alpha)/(:num)', 'Categoria::form/$1/$2');
    $routes->post("store", "Categoria::store");
    $routes->post("delete", "Categoria::delete");
});
