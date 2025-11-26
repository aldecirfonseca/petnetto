<?php
$this->extend('layout/layoutSistema');
$this->section('conteudo');
?>

<div class="container">
    <section>
        <div class="blog-banner">
            <div class="row">
                <div class="col-10 mt-5 mb-5 text-left">
                    <h1 style="color: #384aeb;">Usuários</h1>
                </div>
                <div class="col-2 mt-5 mb-5 text-right">
                    <a href="<?= base_url() ?>UsuarioAdm/form/new/0" 
                    class="btn btn-secondary btn-sm btn-icons-crud" 
                    title="Novo">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="table-responsive table_custom">
        <table class="table table-hover table-bordered table-striped table-sm" id="tbListaUsuario">
            <thead>
                <tr class="text-weight-bold">
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Nível</td>
                    <td>Status</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $value): ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['nome'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['nivel'] == 1 ? 'Usuário' : 'Administrador' ?></td>
                            <td><?= $value['status'] == 1 ? 'Ativo' : 'Inativo' ?></td>

                            <td>
                                <a href="<?= base_url() ?>/UsuarioAdm/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url() ?>/UsuarioAdm/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file"></i></a>
                                <a href="<?= base_url() ?>/UsuarioAdm/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash"></i></a>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum usuário encontrado...</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?= getDataTables("tbListaUsuario") ?>
</div>

<?php $this->endSection(); ?>
