<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Filtro de Autenticação
 * 
 * Verifica se o usuário está logado antes de permitir
 * acesso às áreas administrativas do sistema.
 */
class AuthFilter implements FilterInterface
{
    /**
     * Executa antes do controller
     * 
     * @param RequestInterface $request
     * @param array|null $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verifica se o usuário está logado
        if (!session()->get('usuario_logado')) {
            // Redireciona para o login com mensagem
            return redirect()->to('/login')
                           ->with('msgError', 'Você precisa estar logado para acessar esta área.');
        }
    }

    /**
     * Executa depois do controller
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não faz nada após o controller
    }
}
