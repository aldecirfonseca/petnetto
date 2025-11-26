<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificando se o usuário está logado
        if ((bool)session()->getTempData("isLoggedIn") != true) {
            return redirect("login");
        }

        $nivel = (int)session()->getTempData("userNivel");

        // Descobre qual controller está sendo acessado
        $segments = $request->getUri()->getSegments();
        $controller = $segments[0] ?? '';

        // Se for nível 1, bloqueia apenas rotas administrativas
        if ($nivel === 1) {

            // BLOQUEAR APENAS UsuarioAdm
            if ($controller === "UsuarioAdm") {
                return redirect()
                    ->to("/login")
                    ->with("msgError", "Você não tem permissão para acessar essa área.");
            }

            // Usuário comum pode acessar normalmente suas rotas
            return; 
        }
    }

    public function after(RequestInterface $request, ? ResponseInterface $response, $arguments = null)
    {
    }
}