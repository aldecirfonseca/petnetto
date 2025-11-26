<?php 

    $this->extend('layout/layoutSistema');
    $this->section('conteudo');

    ?>
    
    <?= exibeTitulo("Sobre Nós", ['acao' => $action, 'controller' => 'SobreNos']) ?>

    <?= form_open_multipart("SobreNos/". ($action == "delete" ? 'delete' : 'store')) ?>

        <div class="row">

            <div class="form-group col-12 col-md-8">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" maxlength="75" value="<?= setaValor('title', $data) ?>" required autofocus>
                <?= setaMsgErrorCampo('title', $errors) ?>
            </div>

            <div class="form-group col-12 col-md-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1" <?= setaValor('status', $data) == 1 ? 'selected' : '' ?>>Ativo</option>
                    <option value="0" <?= setaValor('status', $data) == 0 ? 'selected' : '' ?>>Inativo</option>
                </select>
                <?= setaMsgErrorCampo('status', $errors) ?>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="short_description" class="form-label">Descrição Curta</label>
                <input type="text" name="short_description" id="short_description" class="form-control" maxlength="100" value="<?= setaValor('short_description', $data) ?>" required>
                <?= setaMsgErrorCampo('short_description', $errors) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="long_description" class="form-label">Descrição Longa</label>
                <textarea name="long_description" id="long_description" class="form-control" rows="5" maxlength="850" required><?= setaValor('long_description', $data) ?></textarea>
                <?= setaMsgErrorCampo('long_description', $errors) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <label for="valores_empresa" class="form-label">Valores da Empresa</label>
                <textarea name="valores_empresa" id="valores_empresa" class="form-control" rows="5"><?= setaValor('valores_empresa', $data) ?></textarea>
                <?= setaMsgErrorCampo('valores_empresa', $errors) ?>
                <small class="form-text text-muted">Descreva os valores e princípios da empresa</small>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="image_slogan" class="form-label">Imagem do Slogan</label>
                
                <?php if (!empty(setaValor('image_slogan', $data))): ?>
                    <div class="mb-2">
                        <img src="<?= base_url(setaValor('image_slogan', $data)) ?>" alt="Imagem Slogan" style="max-width: 200px; max-height: 150px;" class="img-thumbnail">
                        <input type="hidden" name="image_slogan" value="<?= setaValor('image_slogan', $data) ?>">
                    </div>
                <?php endif; ?>

                <div class="custom-file mb-2">
                    <input type="file" class="custom-file-input" id="image_slogan_file" name="image_slogan_file" accept="image/*">
                    <label class="custom-file-label" for="image_slogan_file">Escolher arquivo...</label>
                </div>
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="image_page" class="form-label">Imagem da Página</label>
                
                <?php if (!empty(setaValor('image_page', $data))): ?>
                    <div class="mb-2">
                        <img src="<?= base_url(setaValor('image_page', $data)) ?>" alt="Imagem Página" style="max-width: 200px; max-height: 150px;" class="img-thumbnail">
                        <input type="hidden" name="image_page" value="<?= setaValor('image_page', $data) ?>">
                    </div>
                <?php endif; ?>

                <div class="custom-file mb-2">
                    <input type="file" class="custom-file-input" id="image_page_file" name="image_page_file" accept="image/*">
                    <label class="custom-file-label" for="image_page_file">Escolher arquivo...</label>
                </div>
                
            </div>
        </div>

        <input type="hidden" name="action" value="<?= $action ?>">
        <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

        <div class="row">
            <div class="form-group col-12">
                <a href="<?= base_url() ?>/SobreNos" class="btn btn-secondary">Voltar</a>
                <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
            </div>
        </div>

    <?= form_close() ?>

    <script>
        // Atualizar label do input file quando arquivo for selecionado e feito upload
        document.querySelectorAll('.custom-file-input').forEach(function(input) {
            input.addEventListener('change', function(e) {
                var fileName = e.target.files[0]?.name || 'Escolher arquivo...';
                var label = e.target.nextElementSibling;
                label.textContent = fileName;
            });
        });
    </script>

<?= $this->endSection() ?>
