<?php
$this->extend('layout/layoutSistema');
$this->section('conteudo');
?>

<div class="container">
        <section>
        <div class="blog-banner">
            <div class="row">
                <div class="col-10 mt-5 text-left">
                    <h1 style="color: #384aeb;">Usuário</h1>
                </div>
            </div>
        </div>
    </section>

    <?= form_open("UsuarioAdm/" . ($action == "delete" ? 'delete' : 'store')) ?>

    <div class="row">

        <div class="form-group col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="<?= setaValor('nome', $data) ?>" required>
            <?= setaMsgErrorCampo('nome', $errors) ?>
        </div>

        <div class="form-group col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control"
                value="<?= setaValor('email', $data) ?>" required>
            <?= setaMsgErrorCampo('email', $errors) ?>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label for="nivel">Nível</label>
            <select name="nivel" id="nivel" class="form-control" required>
                <option value="1" <?= setaValor('nivel', $data) == 1 ? 'selected' : '' ?>>Usuário</option>
                <option value="3" <?= setaValor('nivel', $data) == 3 ? 'selected' : '' ?>>Administrador</option>
            </select>
            <?= setaMsgErrorCampo('nivel', $errors) ?>
        </div>

        <div class="form-group col-md-4">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" <?= setaValor('status', $data) == 1 ? 'selected' : '' ?>>Ativo</option>
                <option value="0" <?= setaValor('status', $data) == 0 ? 'selected' : '' ?>>Inativo</option>
            </select>
            <?= setaMsgErrorCampo('status', $errors) ?>
        </div>

    </div>

    <input type="hidden" name="id" value="<?= setaValor('id', $data) ?>">
    <input type="hidden" name="action" value="<?= $action ?>">

    <div class="row mt-3">
        <div class="form-group col-md-12">
            <a href="<?= base_url('/UsuarioAdm') ?>" class="btn btn-outline-secondary" >Voltar</a>

            <?php if ($action != "view"): ?>
                <button type="submit" class="btn btn-primary ml-3">Gravar</button>
            <?php endif; ?>
        </div>
    </div>

    <?= form_close() ?>
</div>

<?php $this->endSection(); ?>
