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

// === ROTAS DE CONTATO PÚBLICO ===
$routes->get("contato", "Home::contato");
$routes->post("contato/enviar", "Contato::enviar");

// === ROTAS DE AUTENTICAÇÃO ===
$routes->get("login", "Auth::login");
$routes->post("login/processar", "Auth::logarProcessar");
$routes->get("logout", "Auth::logout");
$routes->get("esqueci-senha", "Auth::esqueciSenha");
$routes->post("esqueci-senha/enviar", "Auth::enviarTokenRecuperacao");
$routes->get("redefinir-senha/(:any)", "Auth::redefinirSenha/$1");
$routes->post("redefinir-senha/processar", "Auth::redefinirSenhaProcessar");

// === ROTAS ADMINISTRATIVAS (PROTEGIDAS POR AUTENTICAÇÃO) ===
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    // Contatos - Área Administrativa
    $routes->group('contatos', static function ($routes) {
        $routes->get('/', 'ContatoAdmin::index');
        $routes->get('visualizar/(:num)', 'ContatoAdmin::visualizar/$1');
        $routes->get('toggle-lida/(:num)', 'ContatoAdmin::toggleLida/$1');
        $routes->post('delete', 'ContatoAdmin::delete');
    });
    
    // Trocar Senha (usuário logado)
    $routes->get('trocar-senha', 'Auth::trocarSenha');
    $routes->post('trocar-senha/processar', 'Auth::trocarSenhaProcessar');
});

//

$routes->group('Uf', static function ($routes) {
    $routes->get('/', 'Uf::index'); 
    $routes->get('index', 'Uf::index');
    $routes->get('form/(:alpha)/(:num)', 'Uf::form/$1/$2');
    $routes->post("store", "Uf::store");
    $routes->post("delete", "Uf::delete");
});
