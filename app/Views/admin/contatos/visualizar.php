<?php 
    $this->extend('layout/layoutSistema');
    $this->section('conteudo');
?>

<!-- Título -->
<?= exibeTitulo($titulo ?? 'Visualizar Mensagem', []) ?>

<!-- Botão Voltar -->
<div class="row mb-3">
    <div class="col-md-12">
        <a href="<?= base_url() ?>/admin/contatos" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i> Voltar para Lista
        </a>
    </div>
</div>

<!-- Card com Detalhes da Mensagem -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <?= esc($data['assunto']) ?>
            <?php if ($data['lida'] == 0): ?>
                <span class="badge badge-warning float-right">Nova Mensagem</span>
            <?php endif; ?>
        </h4>
    </div>
    <div class="card-body">
        <!-- Informações do Remetente -->
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong><i class="fa fa-user"></i> Nome:</strong> <?= esc($data['nome']) ?></p>
                <p>
                    <strong><i class="fa fa-envelope"></i> E-mail:</strong> 
                    <a href="mailto:<?= esc($data['email']) ?>">
                        <?= esc($data['email']) ?>
                    </a>
                </p>
            </div>
            <div class="col-md-6">
                <p><strong><i class="fa fa-calendar"></i> Data:</strong> <?= date('d/m/Y', strtotime($data['created_at'])) ?></p>
                <p><strong><i class="fa fa-clock-o"></i> Hora:</strong> <?= date('H:i:s', strtotime($data['created_at'])) ?></p>
                <p><strong><i class="fa fa-globe"></i> IP:</strong> <?= esc($data['ip']) ?></p>
            </div>
        </div>

        <hr>

        <!-- Conteúdo da Mensagem -->
        <div class="mb-4">
            <h5><strong>Mensagem:</strong></h5>
            <div class="alert alert-light p-3">
                <?= nl2br(esc($data['mensagem'])) ?>
            </div>
        </div>

        <hr>

        <!-- Botões de Ação -->
        <div class="row">
            <div class="col-md-12">
                <!-- Botão Marcar como Lida/Não Lida -->
                <a href="<?= base_url() ?>/admin/contatos/toggle-lida/<?= $data['id'] ?>" 
                   class="btn btn-warning">
                    <i class="fa fa-<?= $data['lida'] == 1 ? 'envelope-open' : 'envelope' ?>"></i>
                    <?= $data['lida'] == 1 ? 'Marcar como não lida' : 'Marcar como lida' ?>
                </a>
                
                <!-- Botão Deletar -->
                <button type="button" 
                        class="btn btn-danger"
                        onclick="confirmaDelete('<?= base_url() ?>/admin/contatos/delete', <?= $data['id'] ?>)">
                    <i class="fa fa-trash"></i> Excluir Mensagem
                </button>
                
                <!-- Botão Responder por E-mail -->
                <a href="mailto:<?= esc($data['email']) ?>?subject=Re: <?= rawurlencode($data['assunto']) ?>" 
                   class="btn btn-success float-right">
                    <i class="fa fa-reply"></i> Responder por E-mail
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
