<?php

namespace App\Controllers;

use App\Models\ContatoModel;

/**
 * Controller de Contato - Área Pública
 * 
 * Gerencia o formulário de contato público do site.
 * Responsável por:
 * - Exibir o formulário de contato
 * - Validar e processar o envio
 * - Salvar no banco de dados
 * - Enviar e-mail de notificação
 */
class Contato extends BaseController
{
    protected $contatoModel;

    public function __construct()
    {
        $this->contatoModel = new ContatoModel();
        helper(['form', 'url']);
    }

    /**
     * Exibe o formulário de contato
     * 
     * @return string
     */
    public function index()
    {
        return view('contato');
    }

    /**
     * Processa o envio do formulário de contato
     * 
     * Fluxo:
     * 1. Valida os dados recebidos
     * 2. Salva no banco de dados
     * 3. Envia e-mail de notificação
     * 4. Redireciona com mensagem de sucesso/erro
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function enviar()
    {
        // Valida os dados do formulário
        if (!$this->validate([
            'nome'     => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|max_length[255]',
            'assunto'  => 'required|min_length[3]|max_length[255]',
            'mensagem' => 'required|min_length[10]',
        ])) {
            // Retorna com erros de validação
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Captura o IP do remetente
        $request = \Config\Services::request();
        $ip = $request->getIPAddress();

        // Prepara os dados para salvar
        $dados = [
            'nome'     => $this->request->getPost('nome'),
            'email'    => $this->request->getPost('email'),
            'assunto'  => $this->request->getPost('assunto'),
            'mensagem' => $this->request->getPost('mensagem'),
            'ip'       => $ip,
            'lida'     => 0, // Mensagem não lida
        ];

        // Salva no banco de dados
        if ($this->contatoModel->insert($dados)) {
            // Envia o e-mail
            $this->enviarEmail($dados);

            return redirect()->back()
                           ->with('msgSucess', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('msgError', 'Erro ao enviar mensagem. Tente novamente.');
        }
    }

    /**
     * Envia e-mail de notificação
     * 
     * Utiliza a biblioteca de e-mail do CodeIgniter 4 para
     * enviar uma notificação ao administrador sobre a nova mensagem.
     * 
     * @param array $dados Dados da mensagem
     * @return void
     */
    private function enviarEmail($dados)
    {
        $email = \Config\Services::email();

        // Configurações do e-mail
        $config['protocol']  = 'mail';
        $config['mailType']  = 'html';
        $config['charset']   = 'utf-8';
        $config['newline']   = "\r\n";
        $config['wordWrap']  = true;

        $email->initialize($config);

        // Define remetente e destinatário
        $email->setFrom($dados['email'], $dados['nome']);
        $email->setTo('contato@petnetto.com.br'); // E-mail da clínica
        $email->setSubject('Contato pelo site - ' . $dados['assunto']);

        // Monta o corpo do e-mail em HTML
        $mensagemHtml = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { padding: 20px; }
                    .header { background-color: #4CAF50; color: white; padding: 10px; }
                    .content { padding: 20px; background-color: #f9f9f9; }
                    .footer { padding: 10px; font-size: 12px; color: #666; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Nova mensagem de contato - Pet Netto</h2>
                    </div>
                    <div class='content'>
                        <p><strong>Nome:</strong> {$dados['nome']}</p>
                        <p><strong>E-mail:</strong> {$dados['email']}</p>
                        <p><strong>Assunto:</strong> {$dados['assunto']}</p>
                        <p><strong>Mensagem:</strong></p>
                        <p>" . nl2br(esc($dados['mensagem'])) . "</p>
                    </div>
                    <div class='footer'>
                        <p>IP: {$dados['ip']}</p>
                        <p>Data: " . date('d/m/Y H:i:s') . "</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        $email->setMessage($mensagemHtml);

        // Tenta enviar o e-mail
        try {
            $email->send();
        } catch (\Exception $e) {
            // Registra o erro no log caso falhe
            log_message('error', 'Erro ao enviar e-mail de contato: ' . $e->getMessage());
        }
    }
}
