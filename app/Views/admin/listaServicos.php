<?php 

    $this->extend('layout/layoutSistema');
    $this->section('conteudo');

    ?>

    <?= exibeTitulo("Servico", ['acao' => 'new']) ?>
    
    <div class="table-responsive table_custom">
        <table class="table table-hover table-bordered table-striped table-sm" id="tbListaServicos">
            <thead>
                <tr class="text-weight-bold">
                    <td>Nome do Serviço</td>
                    <td>Descrição</td>
                    <td>Categoria do Serviço</td>
                    <td>Status Ativo</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $value): ?>
                        <tr>
                            <td><?= $value['nome'] ?? 'Nenhum dado inserido' ?></td>
                            <td><?= $value['descricao'] ?? 'Nenhum dado inserido' ?></td>
                            <td><?= $value['categoria'] ?? 'Nenhum dado inserido' ?></td>
                            <td><?= statusRegistro($value['statusRegistro']) ?? 'Status não definido' ?></td>
                            <td>
                                <a href="<?= base_url() ?>Servico/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>    
                                <a href="<?= base_url() ?>Servico/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>    
                                <a href="<?= base_url() ?>Servico/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>                               
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum registro localizado...</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?= getDataTables("tbListaServicos") ?>

<?= $this->endSection() ?>