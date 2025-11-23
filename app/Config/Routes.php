<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get("sobrenos", "Home::sobrenos");
$routes->get("veterinarios", "Home::veterinarios");
$routes->get("servicos", "Home::servicos");
$routes->get("precos", "Home::precos");
$routes->get("blog", "Home::blog");
$routes->get("contato", "Home::contato");
$routes->get("login", "Home::login");

//

$routes->group('Uf', static function ($routes) {
    $routes->get('/', 'Uf::index'); 
    $routes->get('index', 'Uf::index');
    $routes->get('form/(:alpha)/(:num)', 'Uf::form/$1/$2');
    $routes->post("store", "Uf::store");
    $routes->post("delete", "Uf::delete");
});

$routes->group('Servicos', static function ($routes) {
    $routes->get('/', 'Servicos::index'); 
    $routes->get('index', 'Servicos::index');
    $routes->get('form/(:alpha)/(:num)', 'Servicos::form/$1/$2');
    $routes->post("store", "Servicos::store");
    $routes->post("delete", "Servicos::delete");
});
