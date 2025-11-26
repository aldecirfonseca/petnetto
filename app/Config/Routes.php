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

$routes->group('Usuario', static function ($routes) {
    $routes->get('criarNovaConta', 'Usuario::criar'); 
    $routes->post('store', 'Usuario::store');
    $routes->get('esqueciSenha', 'Usuario::esqueciSenha');
    $routes->post('enviarLink', 'Usuario::enviarLink');
    $routes->get('redefinirSenha/(:segment)', 'Usuario::redefinirSenha/$1');
    $routes->post('salvarNovaSenha', 'Usuario::salvarNovaSenha');
    $routes->get('trocarSenha', 'Usuario::trocarSenha');
    $routes->post('salvarSenha', 'Usuario::salvarSenha');
    $routes->get('perfil', 'Usuario::perfil');
    $routes->post('softDelete', 'Usuario::softDelete');
});

$routes->group('UsuarioAdm', static function ($routes) {
    $routes->get('/', 'UsuarioAdm::index');
    $routes->get('form/(:alpha)/(:num)', 'UsuarioAdm::form/$1/$2');
    $routes->post('store', 'UsuarioAdm::store');
    $routes->post('delete', 'UsuarioAdm::delete');
});

$routes->get('dev/loginAdmin', 'DevTools::loginAdmin');
$routes->group('Servico', static function ($routes) {
    $routes->get('/', 'Servicos::index'); 
    $routes->get('index', 'Servicos::index');
    $routes->get('form/(:alpha)/(:num)', 'Servicos::form/$1/$2');
    $routes->post("store", "Servicos::store");
    $routes->post("delete", "Servicos::delete");
});
