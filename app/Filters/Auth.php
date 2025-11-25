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

        // está vericando o nível do login (nivel USUÁRIO)
        // Visantantes
        if ((int)session()->getTempData("userNivel") == 1) {

            $segments = $request->getUri()->getSegments(0);

            if (count($segments) > 0) {
                if (in_array($segments[0], ["Usuario", "Servicos", "Veterinario"])) {
                    return redirect()
                        ->to("sistema")
                        ->with("msgError", "Você não tem permissão para acessar essa página!   ");
                }
            }

            return redirect("login");
        }
    }

    public function after(RequestInterface $request, ? ResponseInterface $response, $arguments = null)
    {
    }
}