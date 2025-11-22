# DOCUMENTAÇÃO - IMPLEMENTAÇÃO CONTATO E AUTENTICAÇÃO
## Projeto Pet Netto - CodeIgniter 4

**Desenvolvido por:** Luiz Felipe e Luan  
**Data:** 20 de Novembro de 2025  
**Branch:** luizfelipe_luan

---

## 📋 ÍNDICE

1. [Visão Geral](#visão-geral)
2. [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
3. [Migrations Criadas](#migrations-criadas)
4. [Models Criados](#models-criados)
5. [Controllers Criados](#controllers-criados)
6. [Views Criadas](#views-criadas)
7. [Rotas Configuradas](#rotas-configuradas)
8. [Sistema de Autenticação](#sistema-de-autenticação)
9. [Como Testar](#como-testar)
10. [Próximos Passos](#próximos-passos)

---

## 🎯 VISÃO GERAL

Esta implementação cobre **duas partes principais** do projeto Pet Netto:

### 1. Sistema de Contato
- Formulário público para envio de mensagens
- Salvamento no banco de dados (histórico)
- Envio de e-mail de notificação
- Área administrativa para gerenciar mensagens recebidas

### 2. Sistema de Login/Logout
- Autenticação de usuários administradores
- Gerenciamento de sessões
- Recuperação de senha (Esqueci minha senha)
- Troca de senha (usuário logado)
- Proteção de rotas administrativas

---

## 🗄️ ESTRUTURA DO BANCO DE DADOS

### Tabela: `usuarios`
Armazena os usuários administradores do sistema.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | INT(11) | Chave primária |
| nome | VARCHAR(255) | Nome completo |
| email | VARCHAR(255) | E-mail (único) |
| senha | VARCHAR(255) | Senha criptografada (hash) |
| ativo | TINYINT(1) | 1=Ativo, 0=Inativo |
| token_recuperacao | VARCHAR(100) | Token para recuperação de senha |
| token_expiracao | DATETIME | Validade do token |
| created_at | DATETIME | Data de criação |
| updated_at | DATETIME | Data de atualização |
| deleted_at | DATETIME | Data de exclusão (soft delete) |

### Tabela: `contatos`
Armazena o histórico de mensagens do formulário de contato.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | INT(11) | Chave primária |
| nome | VARCHAR(255) | Nome do remetente |
| email | VARCHAR(255) | E-mail do remetente |
| assunto | VARCHAR(255) | Assunto da mensagem |
| mensagem | TEXT | Conteúdo da mensagem |
| ip | VARCHAR(45) | IP do remetente |
| lida | TINYINT(1) | 0=Não lida, 1=Lida |
| created_at | DATETIME | Data de recebimento |
| updated_at | DATETIME | Data de atualização |
| deleted_at | DATETIME | Data de exclusão (soft delete) |

---

## 📦 MIGRATIONS CRIADAS

### 1. `2025-11-20-000001_Usuarios.php`
**Localização:** `app/Database/Migrations/`

```php
<?php
namespace App\Database\Migrations;

// Cria a tabela 'usuarios' com todos os campos necessários
// para autenticação e recuperação de senha
```

**Executar migration:**
```bash
php spark migrate
```

### 2. `2025-11-20-000002_Contatos.php`
**Localização:** `app/Database/Migrations/`

```php
<?php
namespace App\Database\Migrations;

// Cria a tabela 'contatos' para armazenar
// o histórico de mensagens recebidas
```

---

## 🔧 MODELS CRIADOS

### 1. `UsuarioModel.php`
**Localização:** `app/Models/`

**Principais Métodos:**
- `verificarCredenciais($email, $senha)` - Valida login
- `gerarTokenRecuperacao($email)` - Gera token para recuperação
- `verificarToken($token)` - Valida token de recuperação
- `redefinirSenha($id, $novaSenha)` - Redefine a senha

**Callbacks:**
- `hashSenha()` - Criptografa senha antes de salvar (beforeInsert/beforeUpdate)

**Validações:**
- Nome: obrigatório, mín 3 caracteres
- Email: obrigatório, válido, único
- Senha: opcional (update), mín 6 caracteres

### 2. `ContatoModel.php`
**Localização:** `app/Models/`

**Principais Métodos:**
- `marcarComoLida($id)` - Marca mensagem como lida
- `marcarComoNaoLida($id)` - Marca mensagem como não lida
- `getMensagensNaoLidas()` - Retorna mensagens não lidas
- `contarNaoLidas()` - Conta mensagens não lidas
- `getLista()` - Retorna todas mensagens ordenadas

**Validações:**
- Nome: obrigatório, mín 3 caracteres
- Email: obrigatório, válido
- Assunto: obrigatório, mín 3 caracteres
- Mensagem: obrigatório, mín 10 caracteres

---

## 🎮 CONTROLLERS CRIADOS

### 1. `Contato.php` (Área Pública)
**Localização:** `app/Controllers/`

**Métodos:**
- `index()` - Exibe formulário de contato
- `enviar()` - Processa envio do formulário
- `enviarEmail($dados)` - Envia e-mail de notificação (privado)

**Fluxo de Envio:**
1. Valida dados do formulário
2. Captura IP do remetente
3. Salva no banco de dados
4. Envia e-mail para administrador
5. Redireciona com mensagem de sucesso/erro

### 2. `ContatoAdmin.php` (Área Administrativa)
**Localização:** `app/Controllers/`

**Métodos:**
- `index()` - Lista todas as mensagens
- `visualizar($id)` - Visualiza mensagem individual (marca como lida)
- `toggleLida($id)` - Alterna status lida/não lida
- `delete()` - Exclui mensagem (soft delete)

### 3. `Auth.php` (Autenticação)
**Localização:** `app/Controllers/`

**Métodos de Login/Logout:**
- `login()` - Exibe formulário de login
- `logarProcessar()` - Processa autenticação
- `logout()` - Destrói sessão

**Métodos de Recuperação de Senha:**
- `esqueciSenha()` - Exibe formulário de recuperação
- `enviarTokenRecuperacao()` - Gera e envia token por e-mail
- `redefinirSenha($token)` - Exibe formulário de redefinição
- `redefinirSenhaProcessar()` - Processa nova senha

**Métodos de Troca de Senha:**
- `trocarSenha()` - Exibe formulário de troca (usuário logado)
- `trocarSenhaProcessar()` - Processa alteração

**Método Privado:**
- `enviarEmailRecuperacao($email, $token)` - Envia e-mail com link

### 4. `Home.php` (Atualizado)
**Localização:** `app/Controllers/`

**Alteração:**
- Método `contato()` agora retorna `view("contato")` ao invés de `view("blog")`

---

## 🎨 VIEWS CRIADAS

### ÁREA PÚBLICA

#### 1. `contato.php`
**Localização:** `app/Views/`

**Elementos:**
- Banner de topo (hero section)
- Informações de contato (endereço, telefone, e-mail, horário)
- Formulário de contato com validação
- Exibição de erros de validação
- Mensagens de sucesso/erro
- Imagem lateral decorativa

**Campos do Formulário:**
- Nome (obrigatório)
- E-mail (obrigatório)
- Assunto (obrigatório)
- Mensagem (obrigatória)

#### 2. `auth/login.php`
**Localização:** `app/Views/auth/`

**Elementos:**
- Formulário de login centralizado
- Link para recuperação de senha
- Mensagens de feedback

#### 3. `auth/esqueci_senha.php`
**Localização:** `app/Views/auth/`

**Elementos:**
- Campo de e-mail
- Botão para enviar link de recuperação
- Link para voltar ao login

#### 4. `auth/redefinir_senha.php`
**Localização:** `app/Views/auth/`

**Elementos:**
- Campo nova senha
- Campo confirmar senha
- Token hidden

### ÁREA ADMINISTRATIVA

#### 5. `admin/contatos/lista.php`
**Localização:** `app/Views/admin/contatos/`

**Elementos:**
- Título e badges de estatísticas (total, não lidas)
- Tabela responsiva com:
  - ID, Nome, E-mail, Assunto, Data, Status
  - Botões: Visualizar, Toggle Lida, Deletar
- Destaque visual para mensagens não lidas (negrito)

#### 6. `admin/contatos/visualizar.php`
**Localização:** `app/Views/admin/contatos/`

**Elementos:**
- Card com detalhes completos da mensagem
- Informações do remetente (nome, e-mail)
- Data, hora e IP
- Conteúdo da mensagem formatado
- Botões de ação:
  - Marcar como lida/não lida
  - Excluir
  - Responder por e-mail

#### 7. `auth/trocar_senha.php`
**Localização:** `app/Views/auth/`

**Elementos:**
- Formulário dentro do layout administrativo
- Campos: senha atual, nova senha, confirmar senha
- Botões: Alterar, Cancelar

---

## 🛣️ ROTAS CONFIGURADAS

**Arquivo:** `app/Config/Routes.php`

### Rotas Públicas (sem autenticação)

```php
// Contato
$routes->get("contato", "Home::contato");
$routes->post("contato/enviar", "Contato::enviar");

// Autenticação
$routes->get("login", "Auth::login");
$routes->post("login/processar", "Auth::logarProcessar");
$routes->get("logout", "Auth::logout");
$routes->get("esqueci-senha", "Auth::esqueciSenha");
$routes->post("esqueci-senha/enviar", "Auth::enviarTokenRecuperacao");
$routes->get("redefinir-senha/(:any)", "Auth::redefinirSenha/$1");
$routes->post("redefinir-senha/processar", "Auth::redefinirSenhaProcessar");
```

### Rotas Administrativas (protegidas com filtro 'auth')

```php
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    // Gestão de Contatos
    $routes->group('contatos', static function ($routes) {
        $routes->get('/', 'ContatoAdmin::index');
        $routes->get('visualizar/(:num)', 'ContatoAdmin::visualizar/$1');
        $routes->get('toggle-lida/(:num)', 'ContatoAdmin::toggleLida/$1');
        $routes->post('delete', 'ContatoAdmin::delete');
    });
    
    // Trocar Senha
    $routes->get('trocar-senha', 'Auth::trocarSenha');
    $routes->post('trocar-senha/processar', 'Auth::trocarSenhaProcessar');
});
```

---

## 🔐 SISTEMA DE AUTENTICAÇÃO

### Filter de Autenticação

**Arquivo:** `app/Filters/AuthFilter.php`

**Funcionalidade:**
- Verifica se existe sessão ativa (`usuario_logado`)
- Redireciona para login se não autenticado
- Protege rotas do grupo `admin/*`

**Configuração do Filter:**

**Arquivo:** `app/Config/Filters.php`

```php
public array $aliases = [
    // ... outros filters
    'auth' => \App\Filters\AuthFilter::class,
];
```

### Dados de Sessão

Quando um usuário faz login, os seguintes dados são armazenados na sessão:

```php
session()->set([
    'usuario_logado' => true,
    'usuario_id'     => $usuario['id'],
    'usuario_nome'   => $usuario['nome'],
    'usuario_email'  => $usuario['email']
]);
```

### Segurança

- **Senhas:** Criptografadas com `password_hash()` (bcrypt)
- **Tokens:** Gerados com `bin2hex(random_bytes(32))`
- **Expiração de Token:** 1 hora após geração
- **Soft Delete:** Dados não são removidos fisicamente do banco

---

## 🧪 COMO TESTAR

### 1. Executar as Migrations

```bash
php spark migrate
```

### 2. Criar Usuário Administrador

Acesse o banco de dados e insira manualmente o primeiro usuário:

```sql
INSERT INTO usuarios (nome, email, senha, ativo, created_at) 
VALUES (
    'Administrador', 
    'admin@petnetto.com.br', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    1, 
    NOW()
);
```

**Credenciais:**
- E-mail: `admin@petnetto.com.br`
- Senha: `password` (ou crie um hash com: `php -r "echo password_hash('suaSenha', PASSWORD_DEFAULT);"`)

### 3. Testar Formulário de Contato

1. Acesse: `http://localhost/contato`
2. Preencha o formulário
3. Clique em "Enviar Mensagem"
4. Verifique se salvou no banco (tabela `contatos`)

### 4. Testar Login

1. Acesse: `http://localhost/login`
2. Digite as credenciais do administrador
3. Deverá redirecionar para: `http://localhost/admin/contatos`

### 5. Testar Área Administrativa de Contatos

1. Acesse: `http://localhost/admin/contatos`
2. Visualize a lista de mensagens
3. Clique em "Visualizar" para ver detalhes
4. Teste marcar como lida/não lida
5. Teste deletar uma mensagem

### 6. Testar Recuperação de Senha

**Importante:** Configure o envio de e-mail no arquivo `app/Config/Email.php`

1. Acesse: `http://localhost/esqueci-senha`
2. Digite o e-mail cadastrado
3. Verifique o e-mail recebido
4. Clique no link de recuperação
5. Defina nova senha

### 7. Testar Troca de Senha

1. Faça login
2. Acesse: `http://localhost/admin/trocar-senha`
3. Digite senha atual e nova senha
4. Confirme

### 8. Testar Logout

1. Acesse: `http://localhost/logout`
2. Deverá redirecionar para a página de login

---

## 📧 CONFIGURAÇÃO DE E-MAIL

Para que o envio de e-mails funcione, configure:

**Arquivo:** `app/Config/Email.php`

```php
public string $fromEmail  = 'noreply@petnetto.com.br';
public string $fromName   = 'Pet Netto';
public string $protocol   = 'smtp'; // ou 'mail'
public string $SMTPHost   = 'smtp.seuservidor.com';
public string $SMTPUser   = 'seu@email.com';
public string $SMTPPass   = 'suaSenha';
public int $SMTPPort      = 587;
public string $SMTPCrypto = 'tls';
```

---

## 📂 ESTRUTURA DE ARQUIVOS CRIADOS/MODIFICADOS

```
app/
├── Controllers/
│   ├── Auth.php                    ✅ NOVO
│   ├── Contato.php                 ✅ NOVO
│   ├── ContatoAdmin.php            ✅ NOVO
│   └── Home.php                    ⚠️ MODIFICADO
│
├── Models/
│   ├── UsuarioModel.php            ✅ NOVO
│   └── ContatoModel.php            ✅ NOVO
│
├── Views/
│   ├── contato.php                 ✅ NOVO
│   ├── login.php                   ⚠️ MODIFICADO
│   ├── auth/
│   │   ├── login.php               ✅ NOVO
│   │   ├── esqueci_senha.php      ✅ NOVO
│   │   ├── redefinir_senha.php    ✅ NOVO
│   │   └── trocar_senha.php       ✅ NOVO
│   └── admin/
│       └── contatos/
│           ├── lista.php           ✅ NOVO
│           └── visualizar.php      ✅ NOVO
│
├── Database/
│   └── Migrations/
│       ├── 2025-11-20-000001_Usuarios.php    ✅ NOVO
│       └── 2025-11-20-000002_Contatos.php    ✅ NOVO
│
├── Filters/
│   └── AuthFilter.php              ✅ NOVO
│
└── Config/
    ├── Routes.php                  ⚠️ MODIFICADO
    └── Filters.php                 ⚠️ MODIFICADO
```

**Legenda:**
- ✅ NOVO - Arquivo criado
- ⚠️ MODIFICADO - Arquivo modificado

---

## 🚀 PRÓXIMOS PASSOS

### Para Você (Desenvolvedor)

1. **Testar Funcionalidades:**
   - Execute as migrations
   - Crie um usuário teste
   - Teste todos os fluxos

2. **Configurar E-mail:**
   - Configure SMTP no `Email.php`
   - Teste envio de e-mails

3. **Personalizar:**
   - Ajuste textos e mensagens
   - Adapte o visual conforme necessário
   - Adicione validações extras se precisar

### Para o Professor (Merge)

1. **Revisar o código**
2. **Fazer merge com outras branches**
3. **Resolver possíveis conflitos**
4. **Testar integração completa**

---

## 📝 OBSERVAÇÕES IMPORTANTES

1. **Senhas:** Sempre use senhas fortes em produção
2. **CSRF Protection:** Já implementado nos formulários com `<?= csrf_field() ?>`
3. **Soft Delete:** Os dados não são excluídos fisicamente, apenas marcados
4. **IP:** O sistema captura e armazena o IP do remetente
5. **Validações:** Todas as entradas são validadas antes de processar
6. **Sessões:** Use sessões seguras em produção (configure `app/Config/App.php`)

---

## 🐛 TROUBLESHOOTING

### Erro: "Token inválido ou expirado"
- Verifique se o token não expirou (1 hora)
- Gere um novo token

### Erro: "E-mail ou senha incorretos"
- Verifique se o usuário existe no banco
- Confirme que a senha foi hasheada corretamente

### Erro: "Você precisa estar logado"
- Limpe as sessões
- Faça login novamente

### E-mails não estão sendo enviados
- Verifique configurações em `Config/Email.php`
- Verifique logs em `writable/logs/`

---

## 📞 SUPORTE

Se houver dúvidas ou problemas:
1. Verifique os logs em `writable/logs/`
2. Revise a documentação do CodeIgniter 4
3. Entre em contato com o professor

---

## ✅ CHECKLIST FINAL

- [x] Migrations criadas
- [x] Models implementados
- [x] Controllers criados
- [x] Views desenvolvidas
- [x] Rotas configuradas
- [x] Autenticação implementada
- [x] Filtro de segurança aplicado
- [x] Documentação completa
- [x] Sistema de logout implementado
- [x] Menu dinâmico (mostra Admin/Sair quando logado)
- [ ] Testes realizados *(aguardando configuração do ambiente)*
- [ ] E-mail configurado *(depende do servidor SMTP)*

---

## 📚 RESUMO DIDÁTICO PARA ESTUDO

### O QUE FOI IMPLEMENTADO?

Este projeto implementou um **sistema completo de contato e autenticação** para a clínica veterinária Pet Netto. Imagine como um site de verdade funciona: visitantes podem enviar mensagens, e administradores podem fazer login para gerenciá-las.

### CONCEITOS IMPORTANTES DO CODEIGNITER 4

#### 1. **MVC (Model-View-Controller)**
É como dividir o trabalho em 3 partes:

- **Model (Modelo):** Conversa com o banco de dados
  - Exemplo: `ContatoModel.php` salva e busca mensagens
  - Exemplo: `UsuarioModel.php` valida login e gerencia senhas

- **View (Visão):** O que o usuário vê (HTML)
  - Exemplo: `contato.php` mostra o formulário de contato
  - Exemplo: `admin/contatos/lista.php` mostra a lista de mensagens

- **Controller (Controlador):** Faz a ponte entre Model e View
  - Exemplo: `Contato.php` recebe dados do formulário → salva no banco → mostra mensagem de sucesso

#### 2. **Migrations (Migrações)**
São "receitas" para criar tabelas no banco de dados.

**Vantagem:** Ao invés de criar tabelas manualmente, você escreve um código PHP que cria para você. Se alguém clonar o projeto, basta rodar `php spark migrate` e tudo é criado automaticamente!

**Criamos 2 migrations:**
- `Usuarios.php` → cria tabela de administradores
- `Contatos.php` → cria tabela de mensagens

#### 3. **Rotas (Routes)**
São os "caminhos" da aplicação. Quando você digita uma URL, a rota decide qual controller chamar.

**Exemplos práticos:**
```
http://localhost:8080/contato → vai para Home::contato()
http://localhost:8080/login → vai para Auth::login()
http://localhost:8080/admin/contatos → vai para ContatoAdmin::index()
```

#### 4. **Filtros (Filters)**
São "guardas de segurança". O `AuthFilter` verifica se você está logado antes de acessar páginas de administração.

**Exemplo:** Se você tentar acessar `/admin/contatos` sem estar logado, o filtro te redireciona para `/login`.

#### 5. **Validações**
Garantem que os dados estão corretos antes de salvar no banco.

**Exemplo do ContatoModel:**
- Nome: mínimo 3 caracteres
- Email: tem que ser válido (com @)
- Mensagem: mínimo 10 caracteres

Se alguém tentar enviar um email sem @, o CodeIgniter bloqueia e mostra erro!

#### 6. **Sessões (Sessions)**
É a "memória" da aplicação. Quando você faz login, o sistema guarda na sessão:
```php
'usuario_logado' => true
'usuario_nome' => 'Administrador'
```

Assim, enquanto você navega pelas páginas, o sistema "lembra" que você está logado.

#### 7. **Soft Delete**
Ao invés de deletar de verdade, apenas marca como deletado (`deleted_at`).

**Vantagem:** Se você deletar uma mensagem por engano, pode recuperar porque ela ainda está no banco!

---

### FLUXO COMPLETO - COMO TUDO FUNCIONA?

#### PARTE 1: Visitante envia mensagem

```
1. Visitante acessa: http://localhost:8080/contato
   └─> Rota chama: Home::contato()
       └─> Exibe view: contato.php (formulário)

2. Visitante preenche e clica "Enviar"
   └─> Formulário POST vai para: /contato/enviar
       └─> Rota chama: Contato::enviar()
           └─> Valida dados (nome, email, assunto, mensagem)
           └─> Salva no banco usando ContatoModel
           └─> Envia email para administrador
           └─> Redireciona com mensagem "Enviado com sucesso!"
```

#### PARTE 2: Administrador faz login

```
1. Admin clica em "Área Restrita"
   └─> Vai para: /admin/contatos
       └─> AuthFilter detecta: não está logado!
           └─> Redireciona para: /login

2. Admin digita email e senha
   └─> Formulário POST vai para: /login/processar
       └─> Rota chama: Auth::logarProcessar()
           └─> UsuarioModel::verificarCredenciais() busca no banco
           └─> Verifica senha com password_verify()
           └─> Se OK: cria sessão e redireciona para /admin/contatos
           └─> Se ERRADO: volta para login com erro
```

#### PARTE 3: Administrador vê mensagens

```
1. Admin acessa: /admin/contatos (já logado)
   └─> AuthFilter verifica: tem sessão? SIM!
       └─> Permite acesso
           └─> ContatoAdmin::index()
               └─> ContatoModel::getLista() busca todas mensagens
               └─> Exibe view: admin/contatos/lista.php
```

#### PARTE 4: Administrador visualiza mensagem

```
1. Admin clica em "Visualizar"
   └─> Vai para: /admin/contatos/visualizar/3 (ID da mensagem)
       └─> ContatoAdmin::visualizar(3)
           └─> ContatoModel::find(3) busca mensagem
           └─> ContatoModel::marcarComoLida(3) atualiza status
           └─> Exibe view: admin/contatos/visualizar.php
```

#### PARTE 5: Administrador deleta mensagem

```
1. Admin clica no botão de deletar
   └─> JavaScript confirmaDelete() pergunta: "Tem certeza?"
       └─> Se SIM: cria formulário e envia POST para /admin/contatos/delete
           └─> ContatoAdmin::delete()
               └─> ContatoModel::delete(id) marca como deleted_at
               └─> Redireciona com "Excluído com sucesso!"
```

#### PARTE 6: Administrador faz logout

```
1. Admin clica em "Sair"
   └─> Vai para: /logout
       └─> Auth::logout()
           └─> session()->destroy() apaga todos dados da sessão
           └─> Redireciona para /login
```

---

### SEGURANÇA IMPLEMENTADA

1. **Senhas Criptografadas:** Usamos `password_hash()` - impossível descriptografar
2. **CSRF Protection:** Cada formulário tem um token secreto que valida o envio
3. **Filter de Autenticação:** Ninguém acessa admin sem login
4. **Validação de Dados:** Tudo é verificado antes de salvar
5. **SQL Injection:** CodeIgniter usa prepared statements automaticamente
6. **Soft Delete:** Dados importantes não são perdidos

---

### ARQUIVOS MAIS IMPORTANTES PARA ESTUDAR

**Se você tem pouco tempo, estude nesta ordem:**

1. **Routes.php** - Entenda como as URLs funcionam
2. **ContatoModel.php** - Veja como trabalhar com banco de dados
3. **Contato.php (Controller)** - Veja como processar formulários
4. **AuthFilter.php** - Entenda proteção de rotas
5. **Auth.php (Controller)** - Aprenda autenticação completa

---

### COMANDOS ÚTEIS

```bash
# Iniciar servidor de desenvolvimento
php spark serve

# Executar migrations (criar tabelas)
php spark migrate

# Reverter última migration
php spark migrate:rollback

# Ver rotas configuradas
php spark routes

# Limpar cache
php spark cache:clear
```

---

### DICAS DE ESTUDO

1. **Leia o código na ordem:**
   - Routes.php → Controller → Model → View

2. **Teste modificando:**
   - Mude uma mensagem de erro
   - Adicione um campo no formulário
   - Crie uma nova validação

3. **Use o banco de dados:**
   - Abra o Workbench
   - Veja como os dados são salvos
   - Tente fazer queries manualmente

4. **Debugue com `dd()`:**
   ```php
   dd($variavel); // Mostra conteúdo e para execução
   ```

5. **Leia a documentação oficial:**
   - https://codeigniter.com/user_guide/

---

### PERGUNTAS FREQUENTES

**Q: Por que usar MVC?**  
R: Organização! Banco de dados, lógica e visual ficam separados. Mais fácil de manter.

**Q: Por que migrations ao invés de SQL direto?**  
R: Porque é versionado. Se você trabalha em equipe, todos rodam o mesmo código e criam as mesmas tabelas.

**Q: O que é CSRF?**  
R: É um ataque onde alguém tenta enviar dados falsos para seu site. O token CSRF previne isso.

**Q: Por que usar password_hash?**  
R: Porque se o banco for hackeado, as senhas estão protegidas. É impossível reverter o hash.

**Q: Soft delete é sempre melhor?**  
R: Depende! Para dados importantes (mensagens, pedidos) sim. Para dados temporários, pode deletar de verdade.

---

### MELHORIAS FUTURAS (IDEIAS PARA PRATICAR)

1. ✨ Adicionar paginação na lista de contatos
2. ✨ Criar filtro por status (lida/não lida)
3. ✨ Adicionar busca por nome ou email
4. ✨ Implementar resposta direta pelo sistema
5. ✨ Adicionar upload de arquivos ao contato
6. ✨ Criar dashboard com estatísticas
7. ✨ Implementar níveis de acesso (admin, moderador)
8. ✨ Adicionar logs de auditoria (quem deletou o quê)

---

**Desenvolvido com ❤️ para o Projeto Pet Netto**

*Luiz Felipe e Luan - Novembro 2025*

**Estude, pratique e boa sorte! 🚀**

