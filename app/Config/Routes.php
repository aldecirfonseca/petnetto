<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get("login", "Home::login");
$routes->get("faleconosco", "Home::faleConosco");
$routes->get("produtodetalhes/(:num)/(:any)", "Home::produtoDetalhes/$1/$2");

$routes->group('Categoria', static function ($routes) {
    $routes->get('index', 'Categoria::index');
    $routes->get('form/(:alpha)/(:num)', 'Categoria::form/$1/$2');
    $routes->post("store", "Categoria::store");
    $routes->post("delete", "Categoria::delete");
});
