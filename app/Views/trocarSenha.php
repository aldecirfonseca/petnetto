<?= $this->extend("layout/layoutSistema") ?>
<?= $this->section("conteudo") ?>

<section class="container mt-5 mb-5">
    <h2>Alterar Senha</h2>

    <div class="col-md-12 form-group">
        <?= mensagemSucesso() ?>
        <?= mensagemError() ?>
    </div>

    <form method="POST" action="<?= base_url('Usuario/salvarSenha') ?>">

        <div class="form-group mb-3">
            <label>Senha atual</label>
            <input type="password" name="senhaAtual" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Nova senha</label>
            <input type="password" name="senhaNova" class="form-control" minlength="6" required>
        </div>

        <div class="form-group mb-3">
            <label>Confirme a nova senha</label>
            <input type="password" name="senhaNova2" class="form-control" minlength="6" required>
        </div>
        <button class="btn btn-primary mt-3">Salvar nova senha</button>
    </form>
</section>

<?= $this->endSection() ?>
