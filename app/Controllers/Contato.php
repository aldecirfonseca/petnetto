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
        helper(['form', 'url', 'text']);
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
     * @return bool
     */
    private function enviarEmail($dados)
    {
        $email = \Config\Services::email();

        // Define remetente e destinatário usando variáveis do .env
        $email->setFrom(
            getenv('email.fromEmail') ?: 'petnetto@gmail.com',
            getenv('email.fromName') ?: 'Pet Netto - Clínica Veterinária'
        );
        $email->setReplyTo($dados['email'], $dados['nome']); // Para responder diretamente ao cliente
        $email->setTo(getenv('email.fromEmail') ?: 'petnetto@gmail.com');
        $email->setSubject('Contato pelo site - ' . $dados['assunto']);

        // Monta o corpo do e-mail em HTML
        $mensagemHtml = "
            <html>
            <head>
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container { 
                        max-width: 600px;
                        margin: 20px auto;
                        background-color: #ffffff;
                        border-radius: 8px;
                        overflow: hidden;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    }
                    .header { 
                        background-color: #4CAF50; 
                        color: white; 
                        padding: 20px;
                        text-align: center;
                    }
                    .header h2 {
                        margin: 0;
                        font-size: 24px;
                    }
                    .content { 
                        padding: 30px;
                        line-height: 1.6;
                    }
                    .field {
                        margin-bottom: 15px;
                    }
                    .field strong {
                        color: #333;
                        display: inline-block;
                        width: 100px;
                    }
                    .message-box {
                        background-color: #f9f9f9;
                        border-left: 4px solid #4CAF50;
                        padding: 15px;
                        margin-top: 10px;
                    }
                    .footer { 
                        padding: 15px;
                        background-color: #f4f4f4;
                        font-size: 12px;
                        color: #666;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>🐾 Nova mensagem de contato</h2>
                    </div>
                    <div class='content'>
                        <p style='color: #666; margin-bottom: 20px;'>Você recebeu uma nova mensagem através do formulário de contato do site:</p>
                        
                        <div class='field'>
                            <strong>Nome:</strong> {$dados['nome']}
                        </div>
                        <div class='field'>
                            <strong>E-mail:</strong> <a href='mailto:{$dados['email']}'>{$dados['email']}</a>
                        </div>
                        <div class='field'>
                            <strong>Assunto:</strong> {$dados['assunto']}
                        </div>
                        
                        <div class='field'>
                            <strong>Mensagem:</strong>
                            <div class='message-box'>
                                " . nl2br(esc($dados['mensagem'])) . "
                            </div>
                        </div>
                    </div>
                    <div class='footer'>
                        <p><strong>Informações técnicas:</strong></p>
                        <p>IP: {$dados['ip']} | Data: " . date('d/m/Y H:i:s') . "</p>
                        <p style='margin-top: 10px;'>Este e-mail foi enviado automaticamente pelo sistema Pet Netto.</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        $email->setMessage($mensagemHtml);

        // Tenta enviar o e-mail
        try {
            if ($email->send()) {
                log_message('info', 'E-mail de contato enviado com sucesso para: ' . $dados['email']);
                return true;
            } else {
                log_message('error', 'Falha ao enviar e-mail de contato. Debugger: ' . $email->printDebugger(['headers']));
                return false;
            }
        } catch (\Exception $e) {
            // Registra o erro no log caso falhe
            log_message('error', 'Erro ao enviar e-mail de contato: ' . $e->getMessage());
            return false;
        }
    }
}
