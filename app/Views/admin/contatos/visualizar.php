<?php 
    $this->extend('layout/layoutSistema');
    $this->section('conteudo');
?>

<!-- Título -->
<?= exibeTitulo($titulo ?? 'Visualizar Mensagem', []) ?>

<!-- Botão Voltar -->
<div class="row mb-3">
    <div class="col-12">
        <a href="<?= base_url() ?>/admin/contatos" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<!-- Card com Detalhes da Mensagem -->
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="fa fa-envelope-open"></i> 
            <span class="d-none d-md-inline"><?= esc($data['assunto']) ?></span>
            <span class="d-inline d-md-none">Mensagem</span>
            <?php if ($data['lida'] == 0): ?>
                <span class="badge badge-warning float-right">Nova</span>
            <?php endif; ?>
        </h4>
        <small class="d-block d-md-none mt-2"><?= esc($data['assunto']) ?></small>
    </div>
    <div class="card-body">
        <!-- Informações do Remetente -->
        <div class="row mb-4">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <p class="mb-2"><strong><i class="fa fa-user"></i> Nome:</strong><br class="d-md-none"> <?= esc($data['nome']) ?></p>
                <p class="mb-2">
                    <strong><i class="fa fa-envelope"></i> E-mail:</strong><br class="d-md-none"> 
                    <a href="mailto:<?= esc($data['email']) ?>" class="text-break">
                        <?= esc($data['email']) ?>
                    </a>
                </p>
            </div>
            <div class="col-12 col-md-6">
                <p class="mb-2"><strong><i class="fa fa-calendar"></i> Data:</strong><br class="d-md-none"> <?= date('d/m/Y', strtotime($data['created_at'])) ?></p>
                <p class="mb-2"><strong><i class="fa fa-clock-o"></i> Hora:</strong><br class="d-md-none"> <?= date('H:i:s', strtotime($data['created_at'])) ?></p>
                <p class="mb-2"><strong><i class="fa fa-globe"></i> IP:</strong><br class="d-md-none"> <?= esc($data['ip']) ?></p>
            </div>
        </div>

        <hr>

        <!-- Conteúdo da Mensagem -->
        <div class="mb-4">
            <h5><strong>Mensagem:</strong></h5>
            <div class="alert alert-light p-3" style="word-wrap: break-word;">
                <?= nl2br(esc($data['mensagem'])) ?>
            </div>
        </div>

        <hr>

        <!-- Botões de Ação -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch">
                    <div class="mb-2 mb-md-0">
                        <!-- Botão Marcar como Lida/Não Lida -->
                        <a href="<?= base_url() ?>/admin/contatos/toggle-lida/<?= $data['id'] ?>" 
                           class="btn btn-warning btn-block btn-md-inline mb-2 mb-md-0 mr-md-2">
                            <i class="fa fa-<?= $data['lida'] == 1 ? 'envelope-open' : 'envelope' ?>"></i>
                            <span class="d-none d-sm-inline"><?= $data['lida'] == 1 ? 'Marcar como não lida' : 'Marcar como lida' ?></span>
                            <span class="d-inline d-sm-none"><?= $data['lida'] == 1 ? 'Não lida' : 'Lida' ?></span>
                        </a>
                        
                        <!-- Botão Deletar -->
                        <button type="button" 
                                class="btn btn-danger btn-block btn-md-inline"
                                onclick="confirmaDelete('<?= base_url() ?>/admin/contatos/delete', <?= $data['id'] ?>)">
                            <i class="fa fa-trash"></i> <span class="d-none d-sm-inline">Excluir Mensagem</span><span class="d-inline d-sm-none">Excluir</span>
                        </button>
                    </div>
                    
                    <!-- Botão Responder por E-mail -->
                    <a href="mailto:<?= esc($data['email']) ?>?subject=Re: <?= rawurlencode($data['assunto']) ?>" 
                       class="btn btn-success btn-block btn-md-inline">
                        <i class="fa fa-reply"></i> Responder
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
