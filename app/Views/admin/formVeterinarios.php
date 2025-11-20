<?php 

$this->extend('layout/layoutSistema');
$this->section('conteudo');

?>

<?= exibeTitulo("Veterinários", ['acao' => $action]) ?>

<?= form_open_multipart("Veterinarios/". ($action == "delete" ? 'delete' : 'store')) ?>

    <div class="row">

        <div class="form-group col-12 col-md-4">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" name="nome" id="nome" class="form-control" maxlength="150" value="<?= setaValor('nome', $data) ?>" required autofocus>
            <?= setaMsgErrorCampo('nome', $errors) ?>
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="especialidade" class="form-label">Especialidade</label>
            <input type="text" name="especialidade" id="especialidade" class="form-control" maxlength="100" value="<?= setaValor('especialidade', $data) ?>" required>
            <?= setaMsgErrorCampo('especialidade', $errors) ?>
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">

            <?php if (!empty($data['foto'])): ?>
                <div class="mt-2">
                    <img src="<?= base_url('uploads/veterinarios/' . $data['foto']) ?>"  alt="Foto" width="120" class="img-thumbnail">
                </div>
            <?php endif; ?>

            <?= setaMsgErrorCampo('foto', $errors) ?>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-12 col-md-12">
            <label for="biografia" class="form-label">Biografia</label>
            <textarea name="biografia" id="biografia" class="form-control" rows="4" maxlength="1000" required><?= setaValor('biografia', $data) ?></textarea>
            <?= setaMsgErrorCampo('biografia', $errors) ?>
        </div>

    </div>

    <div class="row">

        <div class="form-group col-12 col-md-4">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" name="instagram" id="instagram" class="form-control" value="<?= setaValor('instagram', $data) ?>">
            <?= setaMsgErrorCampo('instagram', $errors) ?>
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="text" name="facebook" id="facebook" class="form-control" value="<?= setaValor('facebook', $data) ?>">
            <?= setaMsgErrorCampo('facebook', $errors) ?>
        </div>

        <div class="form-group col-12 col-md-4">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="text" name="twitter" id="twitter" class="form-control" value="<?= setaValor('twitter', $data) ?>">
            <?= setaMsgErrorCampo('twitter', $errors) ?>
        </div>

    </div>

    <input type="hidden" name="action" value="<?= $action ?>">
    <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

    <div class="row">
        <div class="form-group col-12 col-md-12">
            <a href="<?= base_url() ?>/Veterinarios">Voltar</a>
            <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
        </div>
    </div>

<?= form_close() ?>

<?= $this->endSection() ?>
