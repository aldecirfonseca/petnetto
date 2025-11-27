<?php 
    $this->extend('layout/layoutSistema');
    $this->section('conteudo');
?>

<!-- Título e Estatísticas -->
<?= exibeTitulo($titulo ?? 'Mensagens de Contato', []) ?>

<div class="row mb-3">
    <div class="col-12">
        <span class="badge badge-primary">Total: <?= count($data) ?></span>
        <span class="badge badge-warning">Não lidas: <?= $naoLidas ?? 0 ?></span>
    </div>
</div>

<!-- Tabela de Mensagens -->
<div class="table-responsive">
    <table class="table table-hover table-bordered table-striped table-sm" id="tbListaContatos">
        <thead class="thead-dark">
            <tr class="text-weight-bold">
                <th class="d-none d-md-table-cell" width="5%">ID</th>
                <th width="20%">Nome</th>
                <th class="d-none d-lg-table-cell" width="20%">E-mail</th>
                <th width="20%">Assunto</th>
                <th class="d-none d-md-table-cell" width="15%">Data</th>
                <th width="10%">Status</th>
                <th width="10%" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0): ?>
                <?php foreach ($data as $value): ?>
                    <tr class="<?= $value['lida'] == 0 ? 'font-weight-bold' : '' ?>">
                        <td class="d-none d-md-table-cell"><?= $value['id'] ?></td>
                        <td><?= esc($value['nome']) ?></td>
                        <td class="d-none d-lg-table-cell"><?= esc($value['email']) ?></td>
                        <td>
                            <?= esc($value['assunto']) ?>
                            <small class="d-block d-lg-none text-muted">
                                <i class="fa fa-envelope"></i> <?= esc($value['email']) ?>
                            </small>
                            <small class="d-block d-md-none text-muted">
                                <i class="fa fa-calendar"></i> <?= date('d/m/Y H:i', strtotime($value['created_at'])) ?>
                            </small>
                        </td>
                        <td class="d-none d-md-table-cell"><?= date('d/m/Y H:i', strtotime($value['created_at'])) ?></td>
                        <td>
                            <?php if ($value['lida'] == 1): ?>
                                <span class="badge badge-success">Lida</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Nova</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Botão Visualizar -->
                                <a href="<?= base_url() ?>/admin/contatos/visualizar/<?= $value['id'] ?>" 
                                   class="btn btn-info btn-sm" 
                                   title="Visualizar">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                
                                <!-- Botão Toggle Lida/Não Lida -->
                                <a href="<?= base_url() ?>/admin/contatos/toggle-lida/<?= $value['id'] ?>" 
                                   class="btn btn-warning btn-sm" 
                                   title="<?= $value['lida'] == 1 ? 'Marcar como não lida' : 'Marcar como lida' ?>">
                                    <i class="fa fa-<?= $value['lida'] == 1 ? 'envelope-open' : 'envelope' ?>" aria-hidden="true"></i>
                                </a>
                                
                                <!-- Botão Deletar -->
                                <button type="button" 
                                        class="btn btn-danger btn-sm" 
                                        title="Deletar"
                                        onclick="confirmaDelete('<?= base_url() ?>/admin/contatos/delete', <?= $value['id'] ?>)">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
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
