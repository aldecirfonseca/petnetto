<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
        helper("utilits");
    }

    /**
    * Tela pública de criar conta
    */
    public function criar()
    {
        return view("criarNovaConta");
    }

    /**
    * Formulário Esqueci Senha
    */
    public function esqueciSenha()
    {
        return view("esqueciSenha");
    }

    /**
     * Formulário de troca de senha (usuário logado)
     */
    public function trocarSenha()
    {
        return view("trocarSenha");
    }

    /** 
     * Tela para o perfil logado
     */
    public function perfil()
    {
        $id = session()->get('usuario_id');
        $usuario = $this->model->find($id);

        return view('perfil', ['usuario' => $usuario]);
    }

    /**
    * Salvar usuário novo
    */
    public function store()
    {
        $post = $this->request->getPost();

        // Regra extra: confirmar senha
        if ($post["senha"] !== $post["senha2"]) {
            return redirect()->to('Usuario/criarNovaConta')->with('msgError', 'A confirmação de senha não confere!')->withInput();
            unset($post["senha2"]);
        }

        if (! $this->model->validate($post)) {
            return redirect()->to('Usuario/criarNovaConta')->with('msgError', 'Existem erros no formulário.')->with('errors', $this->model->errors())->withInput();
        }

        // Verificar e-mail duplicado
        if ($this->model->where("email", $post["email"])->first()) {
            return redirect()->to('Usuario/criarNovaConta')->with('msgError', 'Não foi possível criar sua conta. Verifique os dados e tente novamente.')->withInput();
        }

        // Tentar salvar
        if ($this->model->save([
            "nome"   => $post['nome'],
            "email"  => $post['email'],
            "senha"  => $post['senha'],
            "nivel"  => 1, // usuário comum
            "status" => 1
        ])){
            return redirect()->to('/login')->with('msgSucess', 'Conta criada com sucesso!');
        }

        // Se der erro de validação
        return redirect()->to('Usuario/criarNovaConta')->with('msgErro', 'Erro ao cadastratr usuário!')->withInput();
    }

    /**
     * Envia o link para redefinir senha
     */
    public function enviarLink()
    {
        $email = $this->request->getPost('email');
        $usuario = $this->model->where('email', $email)->first();

        if (! $usuario) {
            return redirect()->to('Usuario/esqueciSenha')->with('msgSucess', 'Se o e-mail informado existir em nosso sistema, você receberá um link para redefinir sua senha.')->withInput();
        }

        // Gerar token
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', time() + 3600); // 1 hora

        // Salvar no usuário
        $this->model->update($usuario['id'], [
            'token_recuperacao' => $token,
            'token_expiracao' => $expira
        ]);

        // Link enviado ao e-mail
        $link = base_url("Usuario/redefinirSenha/" . $token);

        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Recuperação de Senha');
        $emailService->setMessage("
            Olá {$usuario['nome']},<br><br>
            Clique no link para redefinir sua senha:<br>
            <a href='{$link}'>{$link}</a><br><br>
            Este link é válido por apenas 1 hora.
        ");
        $emailService->send();

        return redirect()->to('Usuario/esqueciSenha')->with('msgSucess', 'Se o e-mail informado existir em nosso sistema, você receberá um link para redefinir sua senha.');
    }

    /**
     * Formulário redefinir senha via token
     */
    public function redefinirSenha($token)
    {
        $usuario = $this->model->where('token_recuperacao', $token)->where('token_expiracao >=', date('Y-m-d H:i:s'))->first();

        if (! $usuario) {
            return redirect()->to('login')->with('msgError', 'Token inválido ou expirado!');
        }

        return view("redefinirSenha", ['usuario' => $usuario]);
    }

    /**
     * Salvar nova senha
     */
    public function salvarNovaSenha()
    {
        $id = $this->request->getPost('id');
        $senha = $this->request->getPost('senha');
        $senha2 = $this->request->getPost('senha2');

        if ($senha !== $senha2) {
            return redirect()->back()->with('msgError', 'As senhas novas não conferem!')->withInput();
        }

        $this->model->update($id, [
            'senha' => $senha,
            'token_recuperacao' => null,
            'token_expiracao'   => null,
        ]);

        return redirect()->to('login')->with('msgSucess', 'Senha redefinida com sucesso!');
    }

    /**
     * Salvar nova senha
     */
    public function salvarSenha()
    {
        $usuarioId = session()->get('usuario_id');
        $senhaAtual = $this->request->getPost('senhaAtual');
        $senhaNova = $this->request->getPost('senhaNova');
        $senhaNova2 = $this->request->getPost('senhaNova2');

        // Buscar usuário
        $usuario = $this->model->find($usuarioId);

        // Verificar se senha atual confere
        if (! password_verify($senhaAtual, $usuario['senha'])) {
            return redirect()->back()->with('msgError', 'A senha atual está incorreta!')->withInput();
        }

        // Verificar se senhas novas são iguais
        if ($senhaNova !== $senhaNova2) {
            return redirect()->back()->with('msgError', 'As senhas novas não conferem!')->withInput();
        }

        // Atualizar senha
        $this->model->update($usuarioId, [
            "senha" => $senhaNova
        ]);

        return redirect()->back()->with('msgSucess', 'Senha alterada com sucesso!');
    }

    public function softDelete()
    {
        $id = session()->get('usuario_id');

        if (! $id) {
            return redirect()->to('/login');
        }

        // Soft Delete usando o model
        $this->model->delete($id);

        // destruir sessão do usuário
        session()->destroy();

        return redirect()->to('/login')->with('msgSucess', 'Sua conta foi excluída com sucesso.');
    }

}
