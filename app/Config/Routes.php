<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get("sobrenos", "SobreNos::exibeSobreNos");
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

$routes->group('SobreNos', static function ($routes) {
    $routes->get('/', 'SobreNos::listaSobreNos'); 
    $routes->get('listaSobreNos', 'SobreNos::listaSobreNos');
    $routes->get('form/(:alpha)/(:num)', 'SobreNos::form/$1/$2');
    $routes->get('form/(:alpha)', 'SobreNos::form/$1');
    $routes->post("store", "SobreNos::store");
    $routes->post("delete", "SobreNos::delete");
});
