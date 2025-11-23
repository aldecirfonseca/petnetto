<?php

$this->extend('layout/layoutSistema');
$this->section('conteudo');

?>

<?= exibeTitulo("Servicos", ['acao' => $action]) ?>

<?= form_open_multipart("Servicos/" . ($action == "delete" ? 'delete' : 'store')) ?>

<div class="row">
    <div class="form-group col-12 col-md-6">
        <label for="nome" class="form-label">Nome do Serviço</label>
        <input type="text" name="nome" id="nome" class="form-control"
            maxlength="255" value="<?= setaValor('nome', $data) ?>" required autofocus>
        <?= setaMsgErrorCampo('nome', $errors) ?>
    </div>

    <div class="form-group col-12 col-md-6">
        <label for="categoria" class="form-label">Categoria do Serviço</label>
        <input type="text" name="categoria" id="categoria" class="form-control"
            maxlength="100" value="<?= setaValor('categoria', $data) ?>">
        <?= setaMsgErrorCampo('categoria', $errors) ?>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 col-md-6">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4"
            maxlength="255"><?= setaValor('descricao', $data) ?></textarea>
        <?= setaMsgErrorCampo('descricao', $errors) ?>
    </div>

    <div class="form-group col-12 col-md-6">
        <label class="form-label">Imagem do Serviço</label>

        <!-- Upload de nova imagem -->
        <input type="file" name="img" id="img" class="form-control mb-2" accept="image/*">
        <?= setaMsgErrorCampo('img', $errors) ?>

        <!-- Imagem atual + opção de remover -->
        <?php if (setaValor('img', $data)): ?>
            <div class="mt-3 border p-3 rounded bg-light">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <small class="text-muted">Imagem atual:</small>
                    <button type="button" class="btn btn-sm btn-danger remover-img" data-img="<?= setaValor('img', $data) ?>">
                        <i class="fa fa-trash"></i> Remover
                    </button>
                </div>
                <img src="<?= base_url(setaValor('img', $data)) ?>" alt="Imagem atual"
                    class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                <input type="hidden" name="remover_img" id="remover_img" value="0">
            </div>
        <?php endif; ?>

        <small class="form-text text-muted">Apenas JPG, PNG e GIF (máx. 2MB)</small>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 col-md-6">
        <label for="statusRegistro" class="form-label">Status Ativo</label>
        <select name="statusRegistro" id="statusRegistro" class="form-control" required>
            <option value="1" <?= (setaValor('statusRegistro', $data) == 1) ? 'selected' : '' ?>>Ativo</option>
            <option value="0" <?= (setaValor('statusRegistro', $data) == 0) ? 'selected' : '' ?>>Inativo</option>
        </select>
        <?= setaMsgErrorCampo('statusRegistro', $errors) ?>
    </div>
</div>

<div class="row">
    <div class="form-group col-12">
        <a href="<?= base_url() ?>/Servicos" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary ml-3">Gravar</button>
    </div>
</div>

<input type="hidden" name="action" value="<?= $action ?>">
<input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

<?= form_close() ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const removerBtns = document.querySelectorAll('.remover-img');

        removerBtns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const container = this.closest('.border');

                const removerInput = container.querySelector('#remover_img');

                container.style.opacity = '0';
                container.style.transition = 'opacity 0.3s ease-out';

                removerInput.value = '1';

            });
        });
    });
</script>


<?= $this->endSection() ?>