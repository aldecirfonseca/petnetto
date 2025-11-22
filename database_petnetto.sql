-- ============================================
-- SCRIPT DE CRIAÇÃO DE TABELAS E DADOS
-- Projeto Pet Netto - Sistema de Contato e Autenticação
-- Desenvolvido por: Luiz Felipe e Luan
-- Data: 20/11/2025
-- ============================================

-- Criar o banco de dados (se ainda não existir)
CREATE DATABASE IF NOT EXISTS petnetto CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE petnetto;

-- ============================================
-- TABELA: usuarios
-- Armazena os usuários administradores do sistema
-- ============================================

CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL COMMENT 'Nome completo do usuário',
    `email` VARCHAR(255) NOT NULL COMMENT 'E-mail para login',
    `senha` VARCHAR(255) NOT NULL COMMENT 'Senha criptografada (hash)',
    `ativo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=Ativo, 0=Inativo',
    `token_recuperacao` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Token para recuperação de senha',
    `token_expiracao` DATETIME NULL DEFAULT NULL COMMENT 'Data de expiração do token',
    `created_at` DATETIME NULL DEFAULT NULL,
    `updated_at` DATETIME NULL DEFAULT NULL,
    `deleted_at` DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- TABELA: contatos
-- Armazena o histórico de mensagens do formulário de contato
-- ============================================

CREATE TABLE IF NOT EXISTS `contatos` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL COMMENT 'Nome completo do remetente',
    `email` VARCHAR(255) NOT NULL COMMENT 'E-mail do remetente',
    `assunto` VARCHAR(255) NOT NULL COMMENT 'Assunto da mensagem',
    `mensagem` TEXT NOT NULL COMMENT 'Conteúdo da mensagem',
    `ip` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Endereço IP do remetente',
    `lida` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0=Não lida, 1=Lida',
    `created_at` DATETIME NULL DEFAULT NULL,
    `updated_at` DATETIME NULL DEFAULT NULL,
    `deleted_at` DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- INSERIR USUÁRIO ADMINISTRADOR PADRÃO
-- ============================================
-- Email: admin@petnetto.com.br
-- Senha: password
-- IMPORTANTE: Altere a senha após o primeiro login!
-- ============================================

INSERT INTO `usuarios` (`nome`, `email`, `senha`, `ativo`, `created_at`) 
VALUES (
    'Administrador',
    'admin@petnetto.com.br',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    1,
    NOW()
);

-- ============================================
-- INSERIR DADOS DE TESTE (OPCIONAL)
-- ============================================
-- Alguns contatos de exemplo para testar o sistema
-- ============================================

INSERT INTO `contatos` (`nome`, `email`, `assunto`, `mensagem`, `ip`, `lida`, `created_at`) VALUES
('João Silva', 'joao@email.com', 'Consulta sobre atendimento', 'Gostaria de saber os horários de atendimento da clínica.', '192.168.1.100', 0, NOW()),
('Maria Santos', 'maria@email.com', 'Vacinação de cães', 'Preciso vacinar meu cachorro. Qual o valor?', '192.168.1.101', 1, DATE_SUB(NOW(), INTERVAL 1 DAY)),
('Pedro Costa', 'pedro@email.com', 'Emergência veterinária', 'Vocês atendem emergências 24 horas?', '192.168.1.102', 0, DATE_SUB(NOW(), INTERVAL 2 HOUR));

-- ============================================
-- CONSULTAS ÚTEIS PARA VERIFICAÇÃO
-- ============================================

-- Verificar usuários cadastrados
-- SELECT * FROM usuarios;

-- Verificar contatos recebidos
-- SELECT * FROM contatos ORDER BY created_at DESC;

-- Contar mensagens não lidas
-- SELECT COUNT(*) as nao_lidas FROM contatos WHERE lida = 0 AND deleted_at IS NULL;

-- ============================================
-- INFORMAÇÕES IMPORTANTES
-- ============================================
-- 
-- CREDENCIAIS DO ADMINISTRADOR PADRÃO:
-- Email: admin@petnetto.com.br
-- Senha: password
-- 
-- APÓS O PRIMEIRO LOGIN:
-- 1. Acesse: http://localhost:8080/admin/trocar-senha
-- 2. Altere a senha padrão por uma senha segura
-- 
-- PARA CRIAR NOVOS USUÁRIOS MANUALMENTE:
-- 1. Gere o hash da senha no PHP:
--    php -r "echo password_hash('suaSenha', PASSWORD_DEFAULT);"
-- 2. Execute o INSERT com o hash gerado:
--    INSERT INTO usuarios (nome, email, senha, ativo, created_at) 
--    VALUES ('Nome', 'email@exemplo.com', 'HASH_AQUI', 1, NOW());
-- 
-- ============================================

-- ============================================
-- INSERÇÃO DE USUÁRIO ADMINISTRADOR PADRÃO
-- ============================================
-- Usuário: admin@petnetto.com
-- Senha: admin123
-- IMPORTANTE: Troque a senha após o primeiro login!

INSERT INTO usuarios (nome, email, senha, ativo, created_at) 
VALUES ('Administrador', 'admin@petnetto.com', '$2y$12$lTr9tgaMcLtlV.EBXts3nudiEdHn9Cdxzl/HGlOSheRmrb8shIysa', 1, NOW());

-- ============================================
