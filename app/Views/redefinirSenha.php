<?= $this->extend("layout/layoutHome") ?>
<?= $this->section("conteudo") ?>

<section class="container mt-5 mb-5">
    <h2>Redefinir Senha</h2>

    <?= session('msgError') ?>

    <form method="POST" action="<?= base_url() ?>Usuario/salvarNovaSenha">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

        <div class="form-group">
            <label>Nova senha</label>
            <input type="password" name="senha" class="form-control" required minlength="6">
        </div>

        <div class="form-group">
            <label>Repita a senha</label>
            <input type="password" name="senha2" class="form-control" required minlength="6">
        </div>

        <button class="btn btn-success mt-3">Salvar</button>
    </form>
</section>

<?= $this->endSection() ?>
