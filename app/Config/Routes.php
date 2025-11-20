<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get("sobrenos", "Home::sobrenos");
$routes->get("veterinarios", "Veterinarios::index");
$routes->get("servicos", "Home::servicos");
$routes->get("precos", "Home::precos");
$routes->get("blog", "Home::blog");
$routes->get("contato", "Home::contato");
$routes->get("login", "Home::login");
$routes->get("arearestrita", "Home::arearestrita");

//

$routes->group('Uf', static function ($routes) {
    $routes->get('/', 'Uf::index'); 
    $routes->get('index', 'Uf::index');
    $routes->get('form/(:alpha)/(:num)', 'Uf::form/$1/$2');
    $routes->post("store", "Uf::store");
    $routes->post("delete", "Uf::delete");
});

$routes->group('Veterinarios', static function ($routes) {
    $routes->get('/', 'Veterinarios::index');
    $routes->get('index', 'Veterinarios::index');
    $routes->get('form/(:alpha)/(:num)', 'Veterinarios::form/$1/$2');
    $routes->get('form/(:alpha)', 'Veterinarios::form/$1');
    $routes->post('store', 'Veterinarios::store');
    $routes->post('delete', 'Veterinarios::delete');
});
