<?php 
    $this->extend('layout/layoutSistema');
    $this->section('conteudo');
?>

<!-- Título e Estatísticas -->
<?= exibeTitulo($titulo ?? 'Mensagens de Contato', []) ?>

<div class="row mb-3">
    <div class="col-md-12">
        <span class="badge badge-primary">Total: <?= count($data) ?></span>
        <span class="badge badge-warning">Não lidas: <?= $naoLidas ?? 0 ?></span>
    </div>
</div>

<!-- Tabela de Mensagens -->
<div class="table-responsive table_custom">
    <table class="table table-hover table-bordered table-striped table-sm" id="tbListaContatos">
        <thead>
            <tr class="text-weight-bold">
                <td width="5%">ID</td>
                <td width="20%">Nome</td>
                <td width="20%">E-mail</td>
                <td width="20%">Assunto</td>
                <td width="15%">Data</td>
                <td width="10%">Status</td>
                <td width="10%">Opções</td>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0): ?>
                <?php foreach ($data as $value): ?>
                    <tr class="<?= $value['lida'] == 0 ? 'font-weight-bold' : '' ?>">
                        <td><?= $value['id'] ?></td>
                        <td><?= esc($value['nome']) ?></td>
                        <td><?= esc($value['email']) ?></td>
                        <td><?= esc($value['assunto']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($value['created_at'])) ?></td>
                        <td>
                            <?php if ($value['lida'] == 1): ?>
                                <span class="badge badge-success">Lida</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Não lida</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Botão Visualizar -->
                            <a href="<?= base_url() ?>/admin/contatos/visualizar/<?= $value['id'] ?>" 
                               class="btn btn-info btn-sm btn-icons-crud" 
                               title="Visualizar">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            
                            <!-- Botão Toggle Lida/Não Lida -->
                            <a href="<?= base_url() ?>/admin/contatos/toggle-lida/<?= $value['id'] ?>" 
                               class="btn btn-warning btn-sm btn-icons-crud" 
                               title="<?= $value['lida'] == 1 ? 'Marcar como não lida' : 'Marcar como lida' ?>">
                                <i class="fa fa-<?= $value['lida'] == 1 ? 'envelope-open' : 'envelope' ?>" aria-hidden="true"></i>
                            </a>
                            
                            <!-- Botão Deletar -->
                            <button type="button" 
                                    class="btn btn-danger btn-sm btn-icons-crud" 
                                    title="Deletar"
                                    onclick="confirmaDelete('<?= base_url() ?>/admin/contatos/delete', <?= $value['id'] ?>)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhuma mensagem encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->endSection(); ?>
