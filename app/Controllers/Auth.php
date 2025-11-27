<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

/**
 * Controller de Autenticação
 * 
 * Gerencia o login e logout de usuários administradores.
 * Responsável por:
 * - Exibir formulário de login
 * - Validar credenciais
 * - Gerenciar sessões
 * - Logout
 * - Recuperação de senha (Esqueci minha senha)
 * - Troca de senha
 */
class Auth extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        helper(['form', 'url']);
    }

    /**
     * Exibe o formulário de login
     * 
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function login()
    {
        // Se já estiver logado, redireciona para o admin
        if (session()->get('usuario_logado')) {
            return redirect()->to('/admin/contatos');
        }

        return view('auth/login');
    }

    /**
     * Processa o login
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logarProcessar()
    {
        // Validação dos dados
        if (!$this->validate([
            'email' => 'required|valid_email',
            'senha' => 'required'
        ])) {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'Por favor, preencha todos os campos corretamente.');
        }

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        // Verifica as credenciais
        $usuario = $this->usuarioModel->verificarCredenciais($email, $senha);

        if ($usuario) {
            // Define a sessão
            session()->set([
                'usuario_logado' => true,
                'usuario_id'     => $usuario['id'],
                'usuario_nome'   => $usuario['nome'],
                'usuario_email'  => $usuario['email']
            ]);

            return redirect()->to('/admin/contatos')
                           ->with('msgSucess', 'Bem-vindo(a), ' . $usuario['nome'] . '!');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'E-mail ou senha incorretos.');
        }
    }

    /**
     * Realiza o logout
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout()
    {
        // Destrói a sessão
        session()->destroy();

        return redirect()->to('/login')
                       ->with('msgSucess', 'Logout realizado com sucesso.');
    }

    /**
     * Exibe formulário para solicitar recuperação de senha
     * 
     * @return string
     */
    public function esqueciSenha()
    {
        return view('auth/esqueci_senha');
    }

    /**
     * Processa a solicitação de recuperação de senha
     * Envia e-mail com token
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function enviarTokenRecuperacao()
    {
        if (!$this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'Digite um e-mail válido.');
        }

        $email = $this->request->getPost('email');
        $token = $this->usuarioModel->gerarTokenRecuperacao($email);

        if ($token) {
            // Envia e-mail com o link de recuperação
            $this->enviarEmailRecuperacao($email, $token);

            return redirect()->to('/login')
                           ->with('msgSucess', 'Instruções para recuperação de senha foram enviadas para seu e-mail.');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'E-mail não encontrado no sistema.');
        }
    }

    /**
     * Exibe formulário para redefinir senha
     * 
     * @param string $token
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function redefinirSenha($token)
    {
        $usuario = $this->usuarioModel->verificarToken($token);

        if (!$usuario) {
            return redirect()->to('/login')
                           ->with('msgError', 'Token inválido ou expirado.');
        }

        $this->dados['token'] = $token;
        return view('auth/redefinir_senha', $this->dados);
    }

    /**
     * Processa a redefinição de senha
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function redefinirSenhaProcessar()
    {
        if (!$this->validate([
            'token'      => 'required',
            'senha'      => 'required|min_length[6]',
            'confirma_senha' => 'required|matches[senha]'
        ])) {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'As senhas não coincidem ou são muito curtas (mínimo 6 caracteres).');
        }

        $token = $this->request->getPost('token');
        $usuario = $this->usuarioModel->verificarToken($token);

        if (!$usuario) {
            return redirect()->to('/login')
                           ->with('msgError', 'Token inválido ou expirado.');
        }

        $novaSenha = $this->request->getPost('senha');

        if ($this->usuarioModel->redefinirSenha($usuario['id'], $novaSenha)) {
            return redirect()->to('/login')
                           ->with('msgSucess', 'Senha redefinida com sucesso! Faça login com sua nova senha.');
        } else {
            return redirect()->back()
                           ->with('msgError', 'Erro ao redefinir senha. Tente novamente.');
        }
    }

    /**
     * Exibe formulário para trocar senha do usuário logado
     * 
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function trocarSenha()
    {
        if (!session()->get('usuario_logado')) {
            return redirect()->to('/login');
        }

        return view('auth/trocar_senha');
    }

    /**
     * Processa a troca de senha do usuário logado
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function trocarSenhaProcessar()
    {
        if (!session()->get('usuario_logado')) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'senha_atual'    => 'required',
            'senha_nova'     => 'required|min_length[6]',
            'confirma_senha' => 'required|matches[senha_nova]'
        ])) {
            return redirect()->back()
                           ->with('msgError', 'Preencha todos os campos corretamente. A nova senha deve ter no mínimo 6 caracteres.');
        }

        $usuarioId = session()->get('usuario_id');
        $usuario = $this->usuarioModel->find($usuarioId);

        // Verifica se a senha atual está correta
        $senhaAtual = $this->request->getPost('senha_atual');
        if (!password_verify($senhaAtual, $usuario['senha'])) {
            return redirect()->back()
                           ->with('msgError', 'Senha atual incorreta.');
        }

        // Atualiza para a nova senha
        $novaSenha = $this->request->getPost('senha_nova');
        if ($this->usuarioModel->update($usuarioId, ['senha' => $novaSenha])) {
            return redirect()->back()
                           ->with('msgSucess', 'Senha alterada com sucesso!');
        } else {
            return redirect()->back()
                           ->with('msgError', 'Erro ao alterar senha. Tente novamente.');
        }
    }

    /**
     * Envia e-mail com link para recuperação de senha
     * 
     * @param string $email
     * @param string $token
     * @return void
     */
    private function enviarEmailRecuperacao($email, $token)
    {
        $emailService = \Config\Services::email();

        $config['protocol']  = 'mail';
        $config['mailType']  = 'html';
        $config['charset']   = 'utf-8';
        $config['newline']   = "\r\n";

        $emailService->initialize($config);

        $emailService->setFrom('noreply@petnetto.com.br', 'Pet Netto');
        $emailService->setTo($email);
        $emailService->setSubject('Recuperação de Senha - Pet Netto');

        $link = base_url('redefinir-senha/' . $token);

        $mensagem = "
            <html>
            <body>
                <h2>Recuperação de Senha</h2>
                <p>Você solicitou a recuperação de senha do sistema Pet Netto.</p>
                <p>Clique no link abaixo para redefinir sua senha:</p>
                <p><a href='{$link}'>{$link}</a></p>
                <p>Este link expira em 1 hora.</p>
                <p>Se você não solicitou esta recuperação, ignore este e-mail.</p>
            </body>
            </html>
        ";

        $emailService->setMessage($mensagem);

        try {
            $emailService->send();
        } catch (\Exception $e) {
            log_message('error', 'Erro ao enviar e-mail de recuperação: ' . $e->getMessage());
        }
    }
}
