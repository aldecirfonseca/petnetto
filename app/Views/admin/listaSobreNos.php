<?php 

    $this->extend('layout/layoutSistema');
    $this->section('conteudo');

    ?>

    <?= exibeTitulo("Sobre Nós", ['acao' => 'new', 'controller' => 'SobreNos']) ?>
    
    <div class="table-responsive table_custom">
        <table class="table table-hover table-bordered table-striped table-sm" id="tbListaSobreNos">
            <thead>
                <tr class="text-weight-bold">
                    <td>Título</td>
                    <td>Descrição Curta</td>
                    <td>Status</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $value): ?>
                        <tr>
                            <td><?= esc($value['title']) ?></td>
                            <td><?= esc($value['short_description']) ?></td>
                            <td><?= $value['status'] == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-secondary">Inativo</span>' ?></td>
                            <td>
                                <a href="<?= base_url() ?>/SobreNos/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>    
                                <a href="<?= base_url() ?>/SobreNos/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>    
                                <a href="<?= base_url() ?>/SobreNos/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>                               
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum registro localizado...</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?= getDataTables("tbListaSobreNos") ?>

<?= $this->endSection() ?>
